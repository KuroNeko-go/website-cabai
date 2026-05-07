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
        $data['title'] = 'Beranda - Pusat Bibit Cabai Nusantara';
        $data['featured_cabais'] = $this->Cabai_model->get_featured(6);
        $data['popular_bibits'] = $this->Bibit_model->get_popular(8);
        $data['new_bibits'] = $this->Bibit_model->get_new(4);
        
        $this->load->view('frontend/template/header', $data);
        $this->load->view('frontend/home/index', $data);
        $this->load->view('frontend/template/footer');
    }
}
?>