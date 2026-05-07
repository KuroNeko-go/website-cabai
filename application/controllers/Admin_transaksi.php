<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_transaksi extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
        
        $this->load->model('Transaksi_model');
    }

    public function index()
    {
        $data['title'] = 'Data Transaksi';
        $data['transaksis'] = $this->Transaksi_model->get_all();
        
        $this->load->view('admin/template/header', $data);
        $this->load->view('admin/transaksi/index', $data);
        $this->load->view('admin/template/footer');
    }

    public function detail($id)
    {
        $data['title'] = 'Detail Transaksi';
        $data['transaksi'] = $this->Transaksi_model->get_by_id($id);
        
        if (!$data['transaksi']) {
            show_404();
        }
        
        $this->load->view('admin/template/header', $data);
        $this->load->view('admin/transaksi/detail', $data);
        $this->load->view('admin/template/footer');
    }

    public function update_status($id, $status)
    {
        $allowed_status = ['pending', 'paid', 'processing', 'shipped', 'completed', 'cancelled'];
        
        if (!in_array($status, $allowed_status)) {
            show_404();
        }
        
        if ($this->Transaksi_model->update_status($id, $status)) {
            $this->session->set_flashdata('success', 'Status transaksi berhasil diupdate!');
        } else {
            $this->session->set_flashdata('error', 'Gagal mengupdate status!');
        }
        
        redirect('admin_transaksi/detail/' . $id);
    }
}
?>