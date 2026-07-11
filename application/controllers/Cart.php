<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Bibit_model');
        $this->load->model('Transaksi_model');
        $this->load->library('form_validation');
        // Library 'cart' bawaan CI udah gak dipake karena kita pindah ke Database
    }

    // --- FUNGSI MESIN PENCARI KERANJANG DARI DATABASE ---
    private function _get_user_cart()
    {
        $user_id = $this->session->userdata('id_user');
        if (!$user_id) return [];

        // Tarik data dari tabel keranjang
        $this->db->where('user_id', $user_id);
        $keranjang = $this->db->get('keranjang')->result_array();

        $cart = [];
        foreach ($keranjang as $k) {
            $id = $k['product_id'];
            $tipe = $k['tipe_produk'];
            $cart_key = $k['id']; // Pake ID dari tabel keranjang sebagai rowid

            // Ambil info produk asli buat nampilin nama, harga, dan gambar
            if ($tipe == 'cabai') {
                $produk = $this->db->get_where('cabais', ['id' => $id])->row_array();
                if(!$produk) continue;
                $name = isset($produk['nama_varietas']) ? $produk['nama_varietas'] : 'Cabai';
                $price = isset($produk['harga_diskon']) && $produk['harga_diskon'] > 0 ? $produk['harga_diskon'] : $produk['harga'];
                $gambar = isset($produk['gambar']) ? $produk['gambar'] : '';
            } else {
                $produk = $this->db->get_where('bibits', ['id' => $id])->row_array();
                if(!$produk) continue;
                $name = isset($produk['nama_produk']) ? $produk['nama_produk'] : 'Bibit';
                $price = isset($produk['harga_diskon']) && $produk['harga_diskon'] > 0 ? $produk['harga_diskon'] : $produk['harga'];
                $gambar = isset($produk['gambar']) ? $produk['gambar'] : '';
            }

            // Susun datanya biar persis kayak format session lama lu
            $cart[$cart_key] = [
                'rowid'  => $k['id'], 
                'id'     => $id,
                'tipe'   => $tipe,
                'name'   => $name,
                'price'  => $price,
                'qty'    => $k['qty'],
                'gambar' => $gambar
            ];
        }
        return $cart;
    }

    public function index()
    {
        // Tolak kalau belum login
        if (!$this->session->userdata('id_user')) {
            $this->session->set_flashdata('error', 'Silakan login terlebih dahulu!');
            redirect('auth/login');
            return;
        }

        $this->session->unset_userdata('mode_langsung'); 
        $data['title'] = 'Keranjang Belanja';
        
        // 1. Tarik Keranjang dari Database
        $data['cart'] = $this->_get_user_cart();
        
        // 2. Hitung total uang
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
        // AJAX Satpam Login
        if (!$this->session->userdata('id_user')) {
            echo json_encode(['status' => 'error', 'message' => 'Silakan login terlebih dahulu!']);
            return;
        }

        $user_id = $this->session->userdata('id_user');
        $id      = $this->input->post('id');
        $qty     = $this->input->post('qty', 1);
        $tipe    = $this->input->post('tipe');
        
        // 1. Ambil Data & Cek Stok
        if ($tipe == 'cabai') {
            $this->load->model('Cabai_model');
            $produk = $this->Cabai_model->get_by_id($id);
            $stok_produk = isset($produk['stok']) ? $produk['stok'] : 999; 
        } else {
            $this->load->model('Bibit_model');
            $produk = $this->Bibit_model->get_by_id($id);
            $stok_produk = isset($produk['stok']) ? $produk['stok'] : 0;
        }
        
        if (!$produk) {
            echo json_encode(['status' => 'error', 'message' => 'Produk tidak ditemukan']);
            return;
        }
        
        // 2. Eksekusi Keranjang (Database)
        $this->db->where(['user_id' => $user_id, 'product_id' => $id, 'tipe_produk' => $tipe]);
        $existing = $this->db->get('keranjang')->row_array();

        if ($existing) {
            // Kalau barang udah ada di keranjang, tambahin jumlahnya
            $new_qty = $existing['qty'] + $qty;
            if ($stok_produk < $new_qty) {
                echo json_encode(['status' => 'error', 'message' => 'Stok tidak mencukupi untuk jumlah tersebut']);
                return;
            }
            $this->db->where('id', $existing['id']);
            $this->db->update('keranjang', ['qty' => $new_qty]);
        } else {
            // Kalau barang baru, masukin baris baru
            if ($stok_produk < $qty) {
                echo json_encode(['status' => 'error', 'message' => 'Stok tidak mencukupi']);
                return;
            }
            $this->db->insert('keranjang', [
                'user_id'     => $user_id,
                'product_id'  => $id,
                'tipe_produk' => $tipe,
                'qty'         => $qty
            ]);
        }
        
        echo json_encode(['status' => 'success', 'message' => 'Produk berhasil masuk keranjang!']);
    }

    public function update()
    {
        if (!$this->session->userdata('id_user')) redirect('auth/login');

        $rowid   = $this->input->post('rowid'); 
        $qty     = $this->input->post('qty');
        $user_id = $this->session->userdata('id_user');
        
        // Pastikan keranjang ini asli milik user yang login
        $this->db->where(['id' => $rowid, 'user_id' => $user_id]);
        $cek = $this->db->get('keranjang')->row_array();

        if ($cek) {
            if ($qty > 0) {
                $this->db->where('id', $rowid)->update('keranjang', ['qty' => $qty]);
                $this->session->set_flashdata('success', 'Jumlah barang berhasil diperbarui!');
            } else {
                $this->db->where('id', $rowid)->delete('keranjang');
                $this->session->set_flashdata('success', 'Barang dihapus dari keranjang.');
            }
        }
        redirect('cart');
    }

    public function remove($rowid = null)
    {
        if ($rowid && $this->session->userdata('id_user')) {
            $user_id = $this->session->userdata('id_user');
            
            // Hapus dari database
            $this->db->where(['id' => $rowid, 'user_id' => $user_id]);
            $this->db->delete('keranjang');
            
            $this->session->set_flashdata('success', 'Produk berhasil dihapus dari keranjang.');
        }
        redirect('cart');
    }

    public function get_cart()
    {
        // Diambil via AJAX biar angka di lonceng header update
        $cart = $this->_get_user_cart();
        $total = 0;
        $total_items = 0;
        
        foreach ($cart as $item) {
            $total += $item['price'] * $item['qty'];
            $total_items += 1; // Hitung jenis barangnya
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
        if (!$this->session->userdata('id_user')) {
            $this->session->set_flashdata('error', 'Silakan login terlebih dahulu sebelum melakukan checkout!');
            redirect('auth/login');
            return;
        }
 
        if ($this->session->userdata('mode_langsung')) {
            $cart = $this->session->userdata('cart_langsung') ? $this->session->userdata('cart_langsung') : [];
        } else {
            // TARIK DARI DATABASE
            $cart = $this->_get_user_cart(); 
            
            // --- INI OBATNYA ---
            // Suntik ulang data dari DB ke session sementara, biar file view checkout.php lu tetep bisa ngebaca!
            $this->session->set_userdata('cart', $cart);
        }

        if (empty($cart)) {
            $this->session->set_flashdata('error', 'Keranjang Anda kosong!');
            redirect('cart');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['qty'];
        }

        $data['cart_items'] = $cart;
        $data['total'] = $total;

        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('telepon', 'Telepon', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('frontend/template/header');
            $this->load->view('shop/checkout', $data);
            $this->load->view('frontend/template/footer');
        } else {
            $transaksi_data = [
                'kode_transaksi' => $this->Transaksi_model->generate_kode(),
                'nama_pelanggan' => $this->input->post('nama'),
                'telepon'        => $this->input->post('telepon'),
                'alamat'         => $this->input->post('alamat'),
                'catatan'        => $this->input->post('catatan', ''),
                'total_harga'    => $total,
                'grand_total'    => $total, // <--- TAMBAHIN BARIS INI JOD!
                'status'         => 'Pending',
                'created_at'     => date('Y-m-d H:i:s')
            ];

            $transaksi_id = $this->Transaksi_model->save_transaksi($transaksi_data, $cart);
            
            if (!$transaksi_id) {
                echo "Gagal simpan transaksi!"; die();
            }

            $server_key = $_ENV['MIDTRANS_SERVER_KEY']; // Ambil dari .env

            $transaction_details = array(
                'order_id' => $transaksi_id . '-' . time(), 
                'gross_amount' => (int)$total,
            );

            $customer_details = array(
                'first_name' => $this->input->post('nama'),
                'phone'      => $this->input->post('telepon'),
                'shipping_address' => $this->input->post('alamat')
            );

            $midtrans_params = array(
                'transaction_details' => $transaction_details,
                'customer_details'    => $customer_details
            );

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://app.sandbox.midtrans.com/snap/v1/transactions");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($midtrans_params));
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Accept: application/json',
                'Authorization: Basic ' . base64_encode($server_key . ':')
            ));
            $response = curl_exec($ch);
            curl_close($ch);

            $snap_response = json_decode($response);
            
            if (!isset($snap_response->token)) {
                echo "Error dari Midtrans: ";
                print_r($snap_response);
                die();
            }
            
            $snap_token = $snap_response->token; 

            // HAPUS KERANJANG DI DB SETELAH SUKSES JADI TRANSAKSI
            if ($this->session->userdata('mode_langsung')) {
                $this->session->unset_userdata('cart_langsung');
                $this->session->unset_userdata('mode_langsung');
            } else {
                $this->db->where('user_id', $this->session->userdata('id_user'))->delete('keranjang');
            }

            $this->session->set_userdata('snap_token', $snap_token);
            $this->session->set_userdata('order_total', $total);
            redirect('cart/pay');
        }
    }

    public function process()
    {
        if (!$this->session->userdata('id_user')) redirect('auth/login');

        if ($this->session->userdata('mode_langsung')) {
            $cart = $this->session->userdata('cart_langsung');
        } else {
            $cart = $this->_get_user_cart();
        }

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
        
        foreach ($cart as $item) {
            if (!$this->Bibit_model->check_stock($item['id'], $item['qty'])) {
                $this->session->set_flashdata('error', 'Stok untuk ' . $item['name'] . ' tidak mencukupi!');
                redirect('cart/checkout');
            }
        }
        
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['qty'];
        }
        $ongkir = 15000;
        $grand_total = $subtotal + $ongkir;
        
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
            foreach ($cart as $item) {
                if ($item['tipe'] == 'cabai') {
                    $this->Cabai_model->reduce_stock($item['id'], $item['qty']);
                } else {
                    $this->Bibit_model->reduce_stock($item['id'], $item['qty']);
                }
            }
            
            // HAPUS KERANJANG DI DB
            if ($this->session->userdata('mode_langsung')) {
                $this->session->unset_userdata('cart_langsung');
                $this->session->unset_userdata('mode_langsung');
            } else {
                $this->db->where('user_id', $this->session->userdata('id_user'))->delete('keranjang');
            }
            
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

    public function set_langsung()
    {
        $id   = $this->input->post('id');
        $qty  = $this->input->post('qty');
        $tipe = $this->input->post('tipe');

        // Pastikan QTY aman
        if (empty($qty) || $qty < 1) {
            $qty = 1;
        }

        // Ambil Nama Asli dan Harga Asli Langsung dari Database!
        if ($tipe == 'cabai') {
            $this->load->model('Cabai_model');
            $produk = $this->Cabai_model->get_by_id($id);
            $stok_tersedia = isset($produk['stok']) ? $produk['stok'] : 999;
            $nama_produk = isset($produk['nama_varietas']) ? $produk['nama_varietas'] : 'Cabai';
            
            // INI DIA YANG BIKIN ERROR TADI! Sekarang harganya ditarik dari Database!
            $harga_asli = (isset($produk['harga_diskon']) && $produk['harga_diskon'] > 0) ? $produk['harga_diskon'] : (isset($produk['harga']) ? $produk['harga'] : 0);
            
        } else {
            $this->load->model('Bibit_model');
            $produk = $this->Bibit_model->get_by_id($id);
            $stok_tersedia = isset($produk['stok']) ? $produk['stok'] : 0;
            $nama_produk = isset($produk['nama_produk']) ? $produk['nama_produk'] : 'Bibit';
            
            $harga_asli = (isset($produk['harga_diskon']) && $produk['harga_diskon'] > 0) ? $produk['harga_diskon'] : (isset($produk['harga']) ? $produk['harga'] : 0);
        }

        // Validasi Stok
        if (!$produk || $stok_tersedia < $qty) {
            $this->session->set_flashdata('error', 'Stok tidak mencukupi untuk jumlah yang diminta!');
            redirect($_SERVER['HTTP_REFERER']); 
            return;
        }

        // Susun Koper Barang
        $item = [
            'id'    => $id,
            'qty'   => $qty,
            'price' => $harga_asli, // Udah aman narik harga DB
            'name'  => $nama_produk, 
            'tipe'  => $tipe
        ];
        
        // Simpan ke Session dan Terbang ke Checkout
        $this->session->set_userdata('cart_langsung', [$item]);
        $this->session->set_userdata('mode_langsung', true);
        
        redirect('cart/checkout');
    }

    public function pay() {
        if (!$this->session->userdata('snap_token')) {
            redirect('cart'); 
        }
        $data['snap_token'] = $this->session->userdata('snap_token');
        $data['total'] = $this->session->userdata('order_total');
        $this->load->view('frontend/template/header');
        $this->load->view('shop/bayar', $data); 
        $this->load->view('frontend/template/footer');
    }

    public function notification()
    {
        $json = file_get_contents('php://input');
        $result = json_decode($json, true);

        file_put_contents('log_midtrans.txt', print_r($result, true) . PHP_EOL, FILE_APPEND);

        if ($result) {
            $order_id = $result['order_id'];
            $status   = $result['transaction_status'];
            $id_transaksi = explode('-', $order_id)[0];

            if ($status == 'settlement') {
                $this->Transaksi_model->update_status($id_transaksi, 'paid');
                $detail_barang = $this->Transaksi_model->get_detail_pesanan($id_transaksi);
                $this->load->model('Cabai_model');
                $this->load->model('Bibit_model');

                if (!empty($detail_barang)) {
                    foreach ($detail_barang as $item) {
                        // WAJIB GANTI JADI BIBIT:
                        if ($item['tipe_produk'] == 'bibit') {
                            $this->Bibit_model->reduce_stock($item['product_id'], $item['qty']);
                        } 
                    }
                }

            } else if ($status == 'expire' || $status == 'cancel' || $status == 'deny') {

                $this->Transaksi_model->update_status($id_transaksi, 'cancelled');
            
                }
            http_response_code(200);
            echo "OK";
        } else {

            http_response_code(400);
            echo "Bad Request";
        }
    }

    // --- FUNGSI BUAT MELANJUTKAN PEMBAYARAN TRX LAMA ---
    public function lanjut_bayar($kode_transaksi)
    {
        if (!$this->session->userdata('id_user')) {
            redirect('auth/login');
        }

        $id_user = $this->session->userdata('id_user');
        
        // 1. Cari transaksi lama di database
        $this->db->where('kode_transaksi', $kode_transaksi);
        $this->db->where('id_user', $id_user); 
        $transaksi = $this->db->get('transaksi')->row_array();

        // 2. Keamanan: Kalau datanya gak ada atau statusnya udah dibayar, tolak!
        if (!$transaksi || $transaksi['status'] != 'pending') {
            $this->session->set_flashdata('error', 'Pesanan tidak valid atau sudah dibayar.');
            redirect('user/riwayat');
            return;
        }

        // 3. Bangkitkan ulang token Midtrans
        $server_key = $_ENV['MIDTRANS_SERVER_KEY'];
        $total = $transaksi['grand_total'];

        $transaction_details = array(
            // Pake format order_id yang sama kayak di fungsi checkout lu
            'order_id' => $transaksi['id'] . '-' . time(), 
            'gross_amount' => (int)$total,
        );

        $customer_details = array(
            'first_name' => $transaksi['nama_pelanggan'],
            'phone'      => $transaksi['telepon'],
            'shipping_address' => $transaksi['alamat']
        );

        $midtrans_params = array(
            'transaction_details' => $transaction_details,
            'customer_details'    => $customer_details
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://app.sandbox.midtrans.com/snap/v1/transactions");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($midtrans_params));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Accept: application/json',
            'Authorization: Basic ' . base64_encode($server_key . ':')
        ));
        $response = curl_exec($ch);
        curl_close($ch);

        $snap_response = json_decode($response);
        
        if (!isset($snap_response->token)) {
            $this->session->set_flashdata('error', 'Gagal menghubungi server Midtrans.');
            redirect('user/riwayat');
            return;
        }

        // 4. Set session token baru dan lempar ke halaman bayar
        $this->session->set_userdata('snap_token', $snap_response->token);
        $this->session->set_userdata('order_total', $total);
        
        redirect('cart/pay');
    }
}
?>