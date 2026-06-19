<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart_model extends CI_Model {

    // 1. Cek apakah barang udah ada di keranjang user (biar qty-nya nambah, bukan bikin baris baru)
    public function cek_barang_ada($user_id, $product_id, $tipe_produk)
    {
        $this->db->where('user_id', $user_id);
        $this->db->where('product_id', $product_id);
        $this->db->where('tipe_produk', $tipe_produk);
        return $this->db->get('keranjang')->row_array();
    }

    // 2. Tambah barang ke keranjang
    public function tambah_keranjang($data)
    {
        $cek = $this->cek_barang_ada($data['user_id'], $data['product_id'], $data['tipe_produk']);
        
        if ($cek) {
            // Kalau udah ada, update QTY-nya aja
            $this->db->where('id', $cek['id']);
            $this->db->update('keranjang', ['qty' => $cek['qty'] + $data['qty']]);
        } else {
            // Kalau belum ada, insert data baru
            $this->db->insert('keranjang', $data);
        }
    }

    // 3. Ambil isi keranjang user yang lagi login
    public function get_keranjang_user($user_id)
    {
        $this->db->where('user_id', $user_id);
        $keranjang = $this->db->get('keranjang')->result_array();

        // Trik nge-loop buat ngambil detail nama dan harga produk dari tabel yang beda
        foreach ($keranjang as &$item) {
            if ($item['tipe_produk'] == 'cabai') {
                $produk = $this->db->get_where('cabai', ['id' => $item['product_id']])->row_array();
            } else {
                $produk = $this->db->get_where('bibit', ['id' => $item['product_id']])->row_array();
            }
            
            // Gabungin data produk ke array keranjang
            $item['nama_produk'] = $produk['nama_cabai']; // Sesuaikan ama nama kolom di tabel lu
            $item['harga'] = $produk['harga'];
            $item['gambar'] = $produk['gambar'];
            $item['subtotal'] = $produk['harga'] * $item['qty'];
        }

        return $keranjang;
    }

    // 4. Hapus barang dari keranjang
    public function hapus_item($cart_id)
    {
        $this->db->where('id', $cart_id);
        $this->db->delete('keranjang');
    }
}