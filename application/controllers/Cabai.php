<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cabai extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Cabai_model');
        $this->load->model('Bibit_model');
    }

    public function index()
    {
        $data['title'] = 'Jenis-Jenis Cabai Unggul Nusantara';
        $data['cabais'] = $this->Cabai_model->get_all();
        
        $this->load->view('frontend/template/header', $data);
        $this->load->view('frontend/cabai/index', $data);
        $this->load->view('frontend/template/footer');
    }

    public function detail($id)
    {
        $cabai = $this->Cabai_model->get_by_id($id);
        
        if (!$cabai) {
            show_404();
        }
        
        $data['title'] = $cabai['nama_varietas'] . ' - Detail Varietas';
        $data['cabai'] = $cabai;
        $data['bibits'] = $this->Bibit_model->get_by_cabai_id($id);
        
        $this->load->view('frontend/template/header', $data);
        $this->load->view('frontend/cabai/detail', $data);
        $this->load->view('frontend/template/footer');
    }
}
?>