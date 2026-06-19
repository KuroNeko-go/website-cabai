<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    protected $table = 'users';

    public function __construct()
    {
        parent::__construct();
    }

    // Login dengan verifikasi password hash
    public function login($username, $password)
    {
        $this->db->where('username', $username);
        $this->db->where('is_active', 1);
        $user = $this->db->get($this->table)->row_array();
        
        if ($user && password_verify($password, $user['password'])) {
            // Update last login
            $this->db->where('id', $user['id']);
            $this->db->update($this->table, ['last_login' => date('Y-m-d H:i:s')]);
            return $user;
        }
        
        return false;
    }

    // Cek username sudah dipakai atau belum
    public function is_username_exists($username)
    {
        $this->db->where('username', $username);
        $query = $this->db->get($this->table);
        return $query->num_rows() > 0;
    }

    // Cek email sudah dipakai atau belum
    public function is_email_exists($email)
    {
        $this->db->where('email', $email);
        $query = $this->db->get($this->table);
        return $query->num_rows() > 0;
    }

    // Register user baru
    public function register($data)
    {
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['is_active'] = 1;
        $data['role'] = 'user'; // Default role staff untuk user baru
        
        return $this->db->insert($this->table, $data);
    }

    // Get user by ID
    public function get_by_id($id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->row_array();
    }

    // Get user by username
    public function get_by_username($username)
    {
        return $this->db->get_where($this->table, ['username' => $username])->row_array();
    }

    // Get all users (untuk admin)
    public function get_all()
    {
        $this->db->order_by('id', 'DESC');
        return $this->db->get($this->table)->result_array();
    }

    // Update user
    public function update($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    // Delete user
    public function delete($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }

    // Update status user (aktif/nonaktif)
    public function update_status($id, $is_active)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->table, ['is_active' => $is_active]);
    }

    // Change password
    public function change_password($id, $new_password)
    {
        $hashed = password_hash($new_password, PASSWORD_DEFAULT);
        $this->db->where('id', $id);
        return $this->db->update($this->table, ['password' => $hashed]);
    }

    // Count total users
    public function count_all()
    {
        return $this->db->count_all($this->table);
    }

    /**
     * Mengambil data user berdasarkan email
     * Digunakan untuk fitur forgot password / reset password
     */
    public function get_by_email($email)
    {
        // Mencari data ke tabel 'users' yang kolom email-nya cocok
        $this->db->where('email', $email);
        $query = $this->db->get('users');
        
        // Kalau datanya ketemu, balikin dalam bentuk array satu baris
        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
        
        // Kalau gak ada, balikin false
        return FALSE;
    }

    /**
     * Update password baru di database berdasarkan email
     */
    public function update_password($email, $new_password)
    {
        $this->db->set('password', $new_password);
        $this->db->where('email', $email);
        $this->db->update('users');
    }
}
?>