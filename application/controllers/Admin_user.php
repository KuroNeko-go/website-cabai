<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_user extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Cegah orang asing masuk
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
        $this->load->model('User_model');
    }

    public function index() {
        $data['title'] = 'Kelola User';
        $data['users'] = $this->User_model->get_all();
        
        $this->load->view('admin/template/header', $data);
        $this->load->view('admin/user/index', $data);
        $this->load->view('admin/template/footer');
    }

    public function create() {
        $data['title'] = 'Tambah User';
        $this->load->view('admin/template/header', $data);
        $this->load->view('admin/user/form', $data);
        $this->load->view('admin/template/footer');
    }

    public function store() {
        // Tarik inputan form
        $data = [
            'nama_lengkap' => $this->input->post('nama_lengkap'),
            'username'     => $this->input->post('username'),
            'email'        => $this->input->post('email'),
            'password'     => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'role'         => $this->input->post('role'),
            'is_active'    => $this->input->post('is_active'),
            'created_at'   => date('Y-m-d H:i:s')
        ];

        // Cek kalau username udah ada yang pakai
        if ($this->User_model->is_username_exists($data['username'])) {
            $this->session->set_flashdata('error', 'Username sudah dipakai! Cari yang lain.');
            redirect('admin_user/create');
            return;
        }

        // Kita insert manual pakai query builder, soalnya fungsi register bawaan lu maksa nge-set role="user"
        $this->db->insert('users', $data);
        $this->session->set_flashdata('success', 'User berhasil ditambahkan!');
        redirect('admin_user');
    }

    public function edit($id) {
        $data['title'] = 'Edit User';
        $data['user']  = $this->User_model->get_by_id($id);
        
        if (!$data['user']) {
            $this->session->set_flashdata('error', 'Data User tidak ditemukan!');
            redirect('admin_user');
        }

        $this->load->view('admin/template/header', $data);
        $this->load->view('admin/user/form', $data);
        $this->load->view('admin/template/footer');
    }

    public function update($id) {
        $data = [
            'nama_lengkap' => $this->input->post('nama_lengkap'),
            'username'     => $this->input->post('username'),
            'email'        => $this->input->post('email'),
            'role'         => $this->input->post('role'),
            'is_active'    => $this->input->post('is_active')
        ];

        // Ganti password CUMA kalau kotaknya diisi
        $password_baru = $this->input->post('password');
        if (!empty($password_baru)) {
            $data['password'] = password_hash($password_baru, PASSWORD_DEFAULT);
        }

        $this->User_model->update($id, $data);
        $this->session->set_flashdata('success', 'Data user berhasil diupdate!');
        redirect('admin_user');
    }

    public function delete($id) {
        // Fitur anti bunuh diri (Gak bisa hapus diri sendiri)
        $user_login = $this->session->userdata('id_user');
        if ($id == $user_login) {
            $this->session->set_flashdata('error', 'Woy! Lu gak bisa ngehapus akun lu sendiri!');
        } else {
            $this->User_model->delete($id);
            $this->session->set_flashdata('success', 'User berhasil dihapus!');
        }
        redirect('admin_user');
    }
}