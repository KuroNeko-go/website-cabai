<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_bibit extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
        
        $this->load->model('Bibit_model');
        $this->load->model('Cabai_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = 'Data Bibit Cabai';
        $data['bibits'] = $this->Bibit_model->get_all_with_cabai();
        
        $this->load->view('admin/template/header', $data);
        $this->load->view('admin/bibit/index', $data);
        $this->load->view('admin/template/footer');
    }

    public function create()
    {
        $data['title'] = 'Tambah Bibit Cabai';
        $data['cabais'] = $this->Cabai_model->get_all();
        
        $this->load->view('admin/template/header', $data);
        $this->load->view('admin/bibit/form', $data);
        $this->load->view('admin/template/footer');
    }

    public function store()
    {
        $this->form_validation->set_rules('cabai_id', 'Varietas Cabai', 'required');
        $this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric');
        $this->form_validation->set_rules('stok', 'Stok', 'required|numeric');
        
        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = [
                'cabai_id' => $this->input->post('cabai_id'),
                'nama_produk' => $this->input->post('nama_produk'),
                'harga' => $this->input->post('harga'),
                'harga_diskon' => $this->input->post('harga_diskon') ?: null,
                'stok' => $this->input->post('stok'),
                'berat' => $this->input->post('berat') ?: 10,
                'deskripsi' => $this->input->post('deskripsi'),
                'is_popular' => $this->input->post('is_popular') ? 1 : 0,
                'is_new' => $this->input->post('is_new') ? 1 : 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
            
            if (!empty($_FILES['gambar']['name'])) {
                $config['upload_path'] = './uploads/bibit/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
                $config['max_size'] = 2048;
                $config['encrypt_name'] = true;
                
                if (!is_dir('./uploads/bibit/')) {
                    mkdir('./uploads/bibit/', 0777, true);
                }
                
                $this->load->library('upload', $config);
                
                if ($this->upload->do_upload('gambar')) {
                    $upload_data = $this->upload->data();
                    $data['gambar'] = 'uploads/bibit/' . $upload_data['file_name'];
                }
            }
            
            if ($this->Bibit_model->insert($data)) {
                $this->session->set_flashdata('success', 'Data bibit berhasil ditambahkan!');
                redirect('admin_bibit');
            } else {
                $this->session->set_flashdata('error', 'Gagal menambahkan data!');
                redirect('admin_bibit/create');
            }
        }
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Bibit Cabai';
        $data['bibit'] = $this->Bibit_model->get_by_id($id);
        $data['cabais'] = $this->Cabai_model->get_all();
        
        if (!$data['bibit']) {
            show_404();
        }
        
        $this->load->view('admin/template/header', $data);
        $this->load->view('admin/bibit/form', $data);
        $this->load->view('admin/template/footer');
    }

    public function update($id)
    {
        $this->form_validation->set_rules('cabai_id', 'Varietas Cabai', 'required');
        $this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric');
        $this->form_validation->set_rules('stok', 'Stok', 'required|numeric');
        
        if ($this->form_validation->run() == FALSE) {
            $this->edit($id);
        } else {
            $data = [
                'cabai_id' => $this->input->post('cabai_id'),
                'nama_produk' => $this->input->post('nama_produk'),
                'harga' => $this->input->post('harga'),
                'harga_diskon' => $this->input->post('harga_diskon') ?: null,
                'stok' => $this->input->post('stok'),
                'berat' => $this->input->post('berat') ?: 10,
                'deskripsi' => $this->input->post('deskripsi'),
                'is_popular' => $this->input->post('is_popular') ? 1 : 0,
                'is_new' => $this->input->post('is_new') ? 1 : 0,
                'updated_at' => date('Y-m-d H:i:s')
            ];
            
            if (!empty($_FILES['gambar']['name'])) {
                $config['upload_path'] = './uploads/bibit/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
                $config['max_size'] = 2048;
                $config['encrypt_name'] = true;
                
                $this->load->library('upload', $config);
                
                if ($this->upload->do_upload('gambar')) {
                    $old = $this->Bibit_model->get_by_id($id);
                    if ($old['gambar'] && file_exists('./' . $old['gambar'])) {
                        unlink('./' . $old['gambar']);
                    }
                    
                    $upload_data = $this->upload->data();
                    $data['gambar'] = 'uploads/bibit/' . $upload_data['file_name'];
                }
            }
            
            if ($this->Bibit_model->update($id, $data)) {
                $this->session->set_flashdata('success', 'Data berhasil diupdate!');
                redirect('admin_bibit');
            } else {
                $this->session->set_flashdata('error', 'Gagal mengupdate data!');
                redirect('admin_bibit/edit/' . $id);
            }
        }
    }

    public function delete($id)
    {
        $bibit = $this->Bibit_model->get_by_id($id);
        if ($bibit['gambar'] && file_exists('./' . $bibit['gambar'])) {
            unlink('./' . $bibit['gambar']);
        }
        
        if ($this->Bibit_model->delete($id)) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus data!');
        }
        
        redirect('admin_bibit');
    }
}
?>