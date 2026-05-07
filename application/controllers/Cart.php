<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Bibit_model');
        $this->load->model('Transaksi_model');
        $this->load->library('form_validation');
        
        // Inisialisasi cart di session jika belum ada
        if (!$this->session->userdata('cart')) {
            $this->session->set_userdata('cart', []);
        }
    }

    public function index()
    {
        $data['title'] = 'Keranjang Belanja';
        $data['cart'] = $this->session->userdata('cart');
        
        // Hitung total
        $total = 0;
        foreach ($data['cart'] as $item) {
            $total += $item['price'] * $item['qty'];
        }
        $data['total'] = $total;
        
        $this->load->view('frontend/template/header', $data);
        $this->load->view('shop/cart', $data);
        $this->load->view('frontend/template/footer');
    }

    public function add()
    {
        $id = $this->input->post('id');
        $qty = $this->input->post('qty', 1);
        
        $bibit = $this->Bibit_model->get_by_id($id);
        
        if (!$bibit) {
            echo json_encode(['status' => 'error', 'message' => 'Produk tidak ditemukan']);
            return;
        }
        
        if ($bibit['stok'] < $qty) {
            echo json_encode(['status' => 'error', 'message' => 'Stok tidak mencukupi']);
            return;
        }
        
        $cart = $this->session->userdata('cart');
        
        if (isset($cart[$id])) {
            $cart[$id]['qty'] += $qty;
        } else {
            $cart[$id] = [
                'id' => $bibit['id'],
                'name' => $bibit['nama_produk'],
                'price' => $bibit['harga_diskon'] ?: $bibit['harga'],
                'original_price' => $bibit['harga'],
                'qty' => $qty,
                'gambar' => $bibit['gambar']
            ];
        }
        
        $this->session->set_userdata('cart', $cart);
        
        echo json_encode(['status' => 'success', 'message' => 'Produk ditambahkan ke keranjang']);
    }

    public function update()
    {
        $id = $this->input->post('id');
        $qty = $this->input->post('qty');
        
        $cart = $this->session->userdata('cart');
        
        if ($cart && isset($cart[$id])) {
            if ($qty <= 0) {
                unset($cart[$id]);
            } else {
                $cart[$id]['qty'] = $qty;
            }
            $this->session->set_userdata('cart', $cart);
        }
        
        echo json_encode(['status' => 'success']);
    }

    public function remove($id)
    {
        $cart = $this->session->userdata('cart');
        
        if ($cart && isset($cart[$id])) {
            unset($cart[$id]);
            $this->session->set_userdata('cart', $cart);
        }
        
        redirect('cart');
    }

    public function get_cart()
    {
        $cart = $this->session->userdata('cart');
        $total = 0;
        $total_items = 0;
        
        foreach ($cart as $item) {
            $total += $item['price'] * $item['qty'];
            $total_items += $item['qty'];
        }
        
        echo json_encode([
            'items' => array_values($cart),
            'total' => $total,
            'total_items' => $total_items,
            'total_formatted' => 'Rp ' . number_format($total, 0, ',', '.')
        ]);
    }

    public function checkout()
    {
        $cart = $this->session->userdata('cart');
        
        if (empty($cart)) {
            redirect('cart');
        }
        
        $data['title'] = 'Checkout - Selesaikan Pesanan';
        $data['cart'] = $cart;
        
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['qty'];
        }
        $data['subtotal'] = $total;
        $data['ongkir'] = 15000; // biaya kirim flat
        $data['grand_total'] = $total + $data['ongkir'];
        
        $this->load->view('frontend/template/header', $data);
        $this->load->view('shop/checkout', $data);
        $this->load->view('frontend/template/footer');
    }

    public function process()
    {
        $cart = $this->session->userdata('cart');
        
        if (empty($cart)) {
            redirect('cart');
        }
        
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('telepon', 'Telepon', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $this->checkout();
            return;
        }
        
        // Validasi stok ulang
        foreach ($cart as $item) {
            if (!$this->Bibit_model->check_stock($item['id'], $item['qty'])) {
                $this->session->set_flashdata('error', 'Stok untuk ' . $item['name'] . ' tidak mencukupi!');
                redirect('cart/checkout');
            }
        }
        
        // Hitung total
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['qty'];
        }
        $ongkir = 15000;
        $grand_total = $subtotal + $ongkir;
        
        // Simpan transaksi
        $transaksi_data = [
            'kode_transaksi' => $this->Transaksi_model->generate_kode(),
            'nama_pelanggan' => $this->input->post('nama'),
            'email' => $this->input->post('email'),
            'telepon' => $this->input->post('telepon'),
            'alamat' => $this->input->post('alamat'),
            'catatan' => $this->input->post('catatan'),
            'total_harga' => $subtotal,
            'ongkir' => $ongkir,
            'grand_total' => $grand_total,
            'status' => 'pending',
            'created_at' => date('Y-m-d H:i:s')
        ];
        
        $transaksi_id = $this->Transaksi_model->save_transaksi($transaksi_data, $cart);
        
        if ($transaksi_id) {
            // Kurangi stok
            foreach ($cart as $item) {
                $this->Bibit_model->reduce_stock($item['id'], $item['qty']);
            }
            
            // Kosongkan keranjang
            $this->session->unset_userdata('cart');
            
            $this->session->set_flashdata('success', 'Pesanan berhasil dibuat! Kode transaksi: ' . $transaksi_data['kode_transaksi']);
            redirect('cart/success');
        } else {
            $this->session->set_flashdata('error', 'Gagal memproses pesanan!');
            redirect('cart/checkout');
        }
    }

    public function success()
    {
        $data['title'] = 'Pesanan Berhasil - CabaiNusa';
        
        $this->load->view('frontend/template/header', $data);
        $this->load->view('shop/success', $data);
        $this->load->view('frontend/template/footer');
    }
}
?>