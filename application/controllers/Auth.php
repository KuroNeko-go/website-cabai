<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('form_validation');
    }

    // Halaman Login
    public function login()
    {
        // Jika sudah login, redirect ke dashboard
        if ($this->session->userdata('logged_in')) {
            redirect('dashboard');
        }

        $data['title'] = 'Login Admin - CabaiNusa';
        $this->load->view('admin/auth/login', $data);
    }

    public function register()
    {
        $data['title'] = 'Register Akun - CabaiNusa';
        $this->load->view('admin/auth/register', $data); // Pastikan path-nya sesuai lokasi file lu
    }

    // Proses Login
    // --- PERBAIKAN FUNGSI LOGIN ---
    public function do_login()
    {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->login();
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $user = $this->User_model->login($username, $password);

            if ($user) {
                $session_data = [
                    'logged_in' => TRUE,
                    'user_id' => $user['id'],
                    'username' => $user['username'],
                    'role' => $user['role']
                ];
                $this->session->set_userdata($session_data);
                
                // Arahkan berdasarkan Role
                if ($user['role'] == 'admin' || $user['role'] == 'staff') {
                    redirect('dashboard'); 
                } else {
                    redirect('home'); 
                }
            } else {
                $this->session->set_flashdata('error', 'Username atau password salah!');
                redirect('auth/login');
            }
        }
    }

    // --- PERBAIKAN FUNGSI REGISTER ---
    public function do_register()
    {
        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required|min_length[3]');
        $this->form_validation->set_rules('username', 'Username', 'required|min_length[4]|callback_username_check');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_email_check');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('confirm_password', 'Konfirmasi Password', 'required|matches[password]');

        if ($this->form_validation->run() == FALSE) {
            $this->register();
        } else {
            $data = [
                'nama_lengkap' => $this->input->post('nama_lengkap'),
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),
                // PENTING: Password harus di-hash biar aman!
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT), 
                'role' => 'user', // SEKARANG PASTI JADI 'user'
                'is_active' => 1
            ];

            if ($this->User_model->register($data)) {
                $this->session->set_flashdata('success', 'Registrasi berhasil! Silakan login.');
                redirect('auth/register');
            } else {
                $this->session->set_flashdata('error', 'Registrasi gagal!');
                redirect('auth/register');
            }
        }
    }

    // Callback: Cek username sudah ada
    public function username_check($username)
    {
        if ($this->User_model->is_username_exists($username)) {
            $this->form_validation->set_message('username_check', 'Username sudah terdaftar!');
            return FALSE;
        }
        return TRUE;
    }

    // Callback: Cek email sudah ada
    public function email_check($email)
    {
        if ($this->User_model->is_email_exists($email)) {
            $this->form_validation->set_message('email_check', 'Email sudah terdaftar!');
            return FALSE;
        }
        return TRUE;
    }

    // Logout
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('admin/auth/login');
    }

    // Lupa Password (halaman)
    public function forgot_password()
    {
        $data['title'] = 'Lupa Password - CabaiNusa';
        $this->load->view('admin/auth/forgot_password', $data);
    }

    // Proses Lupa Password (reset link)
    public function do_forgot_password()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        
        if ($this->form_validation->run() == FALSE) {
            $this->forgot_password();
        } else {
            $email = $this->input->post('email');
            $user = $this->User_model->get_by_email($email);
            
            if ($user) {
                // Kirim email reset password (implementasi sederhana)
                $this->session->set_flashdata('success', 'Link reset password telah dikirim ke email Anda.');
                redirect('admin/auth/login');
            } else {
                $this->session->set_flashdata('error', 'Email tidak terdaftar!');
                redirect('admin/auth/forgot_password');
            }
        }
    }
}
?>