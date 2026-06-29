<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Satpam: Tolak kalau belum login!
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
        // Load model user yang udah kita pake di Admin_user kemarin
        $this->load->model('User_model'); 
    }

    // Nampilin halaman profil
    public function profile() {
        $data['title'] = 'Profil Saya';
        
        // Ambil data user yang lagi login langsung dari database biar fresh
        $id_user = $this->session->userdata('id_user');
        $data['user'] = $this->User_model->get_by_id($id_user);

        $this->load->view('frontend/template/header', $data);
        // Pastikan lu bikin folder 'user' di dalem 'frontend' ya
        $this->load->view('frontend/user/profile', $data); 
        $this->load->view('frontend/template/footer');
    }

    // Proses pas tombol "Simpan" diklik
    // Proses pas tombol "Simpan" diklik
    public function update_profile() {
        $id_user = $this->session->userdata('id_user');
        
        $data = [
            'nama_lengkap' => $this->input->post('nama_lengkap'),
            'username'     => $this->input->post('username'),
            'email'        => $this->input->post('email'),
        ];

        // 1. Cek Ganti Password
        $password_baru = $this->input->post('password');
        if (!empty($password_baru)) {
            $data['password'] = password_hash($password_baru, PASSWORD_DEFAULT);
        }

        // 2. Cek Upload Foto Profil Baru
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] !== UPLOAD_ERR_NO_FILE) {
            if (!empty($_FILES['foto']['name'])) {
                
                // PAKE FCPATH! Ini jalan pintas absolut anti nyasar
                $upload_dir = FCPATH . 'uploads/profile/'; 
                
                // Bikin foldernya otomatis kalau belum ada
                if (!is_dir($upload_dir)) {
                    mkdir($upload_dir, 0777, true); 
                }

                $config['upload_path']   = $upload_dir; 
                $config['allowed_types'] = 'gif|jpg|jpeg|png|webp';
                $config['max_size']      = 2048; 
                $config['file_name']     = 'user_' . $id_user . '_' . time(); 

                // Initialize ulang library upload biar gak bentrok
                if (isset($this->upload)) {
                    $this->upload->initialize($config);
                } else {
                    $this->load->library('upload', $config);
                }

                if ($this->upload->do_upload('foto')) {
                    $upload_data = $this->upload->data();
                    // Simpan ke database tanpa FCPATH biar gambarnya bisa diload di HTML
                    $data['foto'] = 'uploads/profile/' . $upload_data['file_name'];

                    // Hapus foto lama pakai FCPATH biar file aslinya kehapus dari Laragon
                    $user_lama = $this->User_model->get_by_id($id_user);
                    if (!empty($user_lama['foto']) && file_exists(FCPATH . $user_lama['foto'])) {
                        unlink(FCPATH . $user_lama['foto']);
                    }
                } else {
                    $this->session->set_flashdata('error', $this->upload->display_errors('',''));
                    redirect('user/profile');
                    return;
                }
            }
        }

        // 3. Eksekusi update ke database
        $this->User_model->update($id_user, $data);

        // 4. Update session
        $this->session->set_userdata('nama_lengkap', $data['nama_lengkap']);
        $this->session->set_userdata('username', $data['username']);
        if (isset($data['foto'])) {
            $this->session->set_userdata('foto_profil', $data['foto']);
        }

        $this->session->set_flashdata('success', 'Profil dan foto berhasil diupdate!');
        redirect('user/profile');
    }
}