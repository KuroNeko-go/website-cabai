<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Cabai_model');
        $this->load->model('Bibit_model');
    }

    public function index()
{
    $data['title'] = 'Beranda | DuaPutra';

    // 1. Ambil 4 produk dengan jumlah qty terjual paling banyak
    // MANGGIL TABEL TRANSAKSI_DETAIL SESUAI DATABASE LU
    $this->db->select('product_id, tipe_produk, SUM(qty) as total_terjual');
    $this->db->from('transaksi_detail'); // <--- INI UDAH GW GANTI JADI BENER
    $this->db->group_by(array('product_id', 'tipe_produk'));
    $this->db->order_by('total_terjual', 'DESC');
    $this->db->limit(4);
    $best_sellers_query = $this->db->get()->result_array();

    $produk_bestseller = [];

    // 2. Tarik detail produk asli dari tabel cabais atau bibits
    foreach ($best_sellers_query as $bs) {
        if ($bs['tipe_produk'] == 'cabai') {
            $p = $this->db->get_where('cabais', ['id' => $bs['product_id']])->row_array();
            if ($p) {
                $p['tipe_asli'] = 'cabai';
                $p['nama_tampil'] = $p['nama_varietas']; 
                $produk_bestseller[] = $p;
            }
        } else {
            $p = $this->db->get_where('bibits', ['id' => $bs['product_id']])->row_array();
            if ($p) {
                $p['tipe_asli'] = 'bibit';
                $p['nama_tampil'] = $p['nama_produk']; 
                $produk_bestseller[] = $p;
            }
        }
    }

    // 3. Lempar datanya ke View
    $data['best_seller'] = $produk_bestseller;

    $this->load->view('frontend/template/header', $data);
    $this->load->view('frontend/home/index', $data);
    $this->load->view('frontend/template/footer');
}
}
?>