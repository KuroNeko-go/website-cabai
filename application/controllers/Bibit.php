<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bibit extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Bibit_model');
        $this->load->model('Cabai_model');
        $this->load->helper('text');
    }

    /**
     * Halaman utama toko - menampilkan semua bibit
     * URL: /bibit
     */
    public function index()
    {
        $data['title'] = 'Toko Bibit Cabai - Belanja Bibit Unggul Nusantara';
        $data['bibits'] = $this->Bibit_model->get_all_with_cabai();
        
        // Cek jika data kosong
        if (empty($data['bibits'])) {
            $data['bibits'] = [];
        }
        
        $this->load->view('frontend/template/header', $data);
        $this->load->view('shop/index', $data);
        $this->load->view('frontend/template/footer');
    }

    /**
     * Halaman detail produk bibit
     * URL: /bibit/detail/1
     */
    public function detail($id = null)
    {
        // Validasi ID
        if ($id === null || !is_numeric($id)) {
            show_404();
        }
        
        // Ambil data bibit berdasarkan ID
        $bibit = $this->Bibit_model->get_by_id($id);
        
        // Jika data tidak ditemukan, tampilkan 404
        if (!$bibit) {
            show_404();
        }
        
        // Ambil produk terkait (dari varietas yang sama)
        $related = $this->Bibit_model->get_by_cabai_id($bibit['cabai_id']);
        
        $data['title'] = $bibit['nama_produk'] . ' - Detail Produk';
        $data['bibit'] = $bibit;
        $data['related'] = $related;
        
        $this->load->view('frontend/template/header', $data);
        $this->load->view('shop/detail', $data);
        $this->load->view('frontend/template/footer');
    }

    /**
     * Halaman filter bibit berdasarkan kategori/varietas cabai
     * URL: /bibit/kategori/1
     */
    public function kategori($cabai_id = null)
    {
        // Validasi ID
        if ($cabai_id === null || !is_numeric($cabai_id)) {
            show_404();
        }
        
        // Ambil data cabai
        $cabai = $this->Cabai_model->get_by_id($cabai_id);
        
        // Jika cabai tidak ditemukan
        if (!$cabai) {
            show_404();
        }
        
        // Ambil bibit berdasarkan cabai_id
        $bibits = $this->Bibit_model->get_by_cabai_id($cabai_id);
        
        $data['title'] = 'Bibit ' . $cabai['nama_varietas'] . ' - Toko CabaiNusa';
        $data['cabai'] = $cabai;
        $data['bibits'] = $bibits;
        
        $this->load->view('frontend/template/header', $data);
        $this->load->view('shop/kategori', $data);
        $this->load->view('frontend/template/footer');
    }

    /**
     * API: Get all bibit (untuk AJAX)
     * URL: /bibit/api_get_all
     */
    public function api_get_all()
    {
        $bibits = $this->Bibit_model->get_all_with_cabai();
        echo json_encode($bibits);
    }

    /**
     * API: Get bibit by ID (untuk AJAX)
     * URL: /bibit/api_get/1
     */
    public function api_get($id)
    {
        $bibit = $this->Bibit_model->get_by_id($id);
        echo json_encode($bibit);
    }

    /**
     * API: Search bibit (untuk AJAX)
     * URL: /bibit/api_search?keyword=xxx
     */
    public function api_search()
    {
        $keyword = $this->input->get('keyword');
        
        if (empty($keyword)) {
            echo json_encode([]);
            return;
        }
        
        $this->db->select('bibits.*, cabais.nama_varietas');
        $this->db->from('bibits');
        $this->db->join('cabais', 'cabais.id = bibits.cabai_id');
        $this->db->group_start();
        $this->db->like('bibits.nama_produk', $keyword);
        $this->db->or_like('cabais.nama_varietas', $keyword);
        $this->db->group_end();
        $this->db->limit(10);
        
        $query = $this->db->get();
        echo json_encode($query->result_array());
    }
}
?>