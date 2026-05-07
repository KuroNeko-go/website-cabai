<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
        
        $this->load->model('Cabai_model');
        $this->load->model('Bibit_model');
        $this->load->model('Transaksi_model');
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['statistics'] = $this->Transaksi_model->get_statistics();
        $data['total_cabai'] = count($this->Cabai_model->get_all());
        $data['total_bibit'] = count($this->Bibit_model->get_all_with_cabai());
        $data['low_stock'] = $this->Bibit_model->get_low_stock();
        $data['latest_transaksi'] = $this->Transaksi_model->get_latest(5);
        
        $this->load->view('admin/template/header', $data);
        $this->load->view('admin/dashboard/index', $data);
        $this->load->view('admin/template/footer');
    }
}
?>