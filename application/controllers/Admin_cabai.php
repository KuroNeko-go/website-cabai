<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_cabai extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
        
        $this->load->model('Cabai_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = 'Data Varietas Cabai';
        $data['cabais'] = $this->Cabai_model->get_all_with_count();
        
        $this->load->view('admin/template/header', $data);
        $this->load->view('admin/cabai/index', $data);
        $this->load->view('admin/template/footer');
    }

    public function create()
    {
        $data['title'] = 'Tambah Varietas Cabai';
        
        $this->load->view('admin/template/header', $data);
        $this->load->view('admin/cabai/form', $data);
        $this->load->view('admin/template/footer');
    }

    public function store()
    {
        $this->form_validation->set_rules('nama_varietas', 'Nama Varietas', 'required');
        $this->form_validation->set_rules('tingkat_pedas', 'Tingkat Pedas', 'required');
        $this->form_validation->set_rules('umur_panen', 'Umur Panen', 'required|numeric');
        $this->form_validation->set_rules('stok', 'Stok', 'required|numeric');
        
        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = [
                'nama_varietas' => $this->input->post('nama_varietas'),
                'nama_latin' => $this->input->post('nama_latin'),
                'tingkat_pedas' => $this->input->post('tingkat_pedas'),
                'skala_pedas' => $this->input->post('skala_pedas'),
                'umur_panen' => $this->input->post('umur_panen'),
                'stok' => $this->input->post('stok'),
                'cocok_ditanam' => $this->input->post('cocok_ditanam'),
                'keunggulan' => $this->input->post('keunggulan'),
                'deskripsi' => $this->input->post('deskripsi'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
            
            // Upload gambar
            if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] !== UPLOAD_ERR_NO_FILE) {
                if (!empty($_FILES['gambar']['name'])) {
                    $upload_dir = FCPATH . 'uploads/cabai/';
                    $config['upload_path'] = $upload_dir;
                    $config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
                    $config['max_size'] = 2048;
                    $config['encrypt_name'] = true;
                    
                    if (!is_dir($upload_dir)) {
                        mkdir($upload_dir, 0777, true);
                    }
                    
                    if (isset($this->upload)) {
                        $this->upload->initialize($config);
                    } else {
                        $this->load->library('upload', $config);
                    }
                    
                    if ($this->upload->do_upload('gambar')) {
                        $upload_data = $this->upload->data();
                        $data['gambar'] = 'uploads/cabai/' . $upload_data['file_name'];
                    } else {
                        $this->session->set_flashdata('error', $this->upload->display_errors('', ''));
                        redirect('admin_cabai/create');
                    }
                } else {
                    $this->session->set_flashdata('error', 'Gagal mengunggah gambar. Periksa ukuran file dan pengaturan PHP upload.');
                    redirect('admin_cabai/create');
                }
            }
            
            if ($this->Cabai_model->insert($data)) {
                $this->session->set_flashdata('success', 'Data cabai berhasil ditambahkan!');
                redirect('admin_cabai');
            } else {
                $this->session->set_flashdata('error', 'Gagal menambahkan data!');
                redirect('admin_cabai/create');
            }
        }
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Varietas Cabai';
        $data['cabai'] = $this->Cabai_model->get_by_id($id);
        
        if (!$data['cabai']) {
            show_404();
        }
        
        $this->load->view('admin/template/header', $data);
        $this->load->view('admin/cabai/form', $data);
        $this->load->view('admin/template/footer');
    }

    public function update($id)
    {
        $this->form_validation->set_rules('nama_varietas', 'Nama Varietas', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $this->edit($id);
        } else {
            $data = [
                'nama_varietas' => $this->input->post('nama_varietas'),
                'nama_latin' => $this->input->post('nama_latin'),
                'tingkat_pedas' => $this->input->post('tingkat_pedas'),
                'skala_pedas' => $this->input->post('skala_pedas'),
                'umur_panen' => $this->input->post('umur_panen'),
                'stok' => $this->input->post('stok'),
                'cocok_ditanam' => $this->input->post('cocok_ditanam'),
                'keunggulan' => $this->input->post('keunggulan'),
                'deskripsi' => $this->input->post('deskripsi'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
            
            if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] !== UPLOAD_ERR_NO_FILE) {
                if (!empty($_FILES['gambar']['name'])) {
                    $upload_dir = FCPATH . 'uploads/cabai/';
                    $config['upload_path'] = $upload_dir;
                    $config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
                    $config['max_size'] = 2048;
                    $config['encrypt_name'] = true;
                    
                    if (!is_dir($upload_dir)) {
                        mkdir($upload_dir, 0777, true);
                    }
                    
                    if (isset($this->upload)) {
                        $this->upload->initialize($config);
                    } else {
                        $this->load->library('upload', $config);
                    }
                    
                    if ($this->upload->do_upload('gambar')) {
                        $old = $this->Cabai_model->get_by_id($id);
                        if ($old['gambar'] && file_exists('./' . $old['gambar'])) {
                            unlink('./' . $old['gambar']);
                        }
                        
                        $upload_data = $this->upload->data();
                        $data['gambar'] = 'uploads/cabai/' . $upload_data['file_name'];
                    } else {
                        $this->session->set_flashdata('error', $this->upload->display_errors('', ''));
                        redirect('admin_cabai/edit/' . $id);
                    }
                } else {
                    $this->session->set_flashdata('error', 'Gagal mengunggah gambar. Periksa ukuran file dan pengaturan PHP upload.');
                    redirect('admin_cabai/edit/' . $id);
                }
            }
            
            if ($this->Cabai_model->update($id, $data)) {
                $this->session->set_flashdata('success', 'Data berhasil diupdate!');
                redirect('admin_cabai');
            } else {
                $this->session->set_flashdata('error', 'Gagal mengupdate data!');
                redirect('admin_cabai/edit/' . $id);
            }
        }
    }

    public function delete($id)
    {
        $cabai = $this->Cabai_model->get_by_id($id);
        if ($cabai['gambar'] && file_exists('./' . $cabai['gambar'])) {
            unlink('./' . $cabai['gambar']);
        }
        
        if ($this->Cabai_model->delete($id)) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus data!');
        }
        
        redirect('admin_cabai');
    }
}
?>