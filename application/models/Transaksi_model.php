<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_model extends CI_Model {

    protected $table = 'transaksi';

    public function __construct()
    {
        parent::__construct();
    }

    // Generate transaction code
    public function generate_kode()
    {
        $this->db->select_max('id');
        $query = $this->db->get($this->table);
        $last_id = $query->row_array()['id'] ?? 0;
        $new_id = $last_id + 1;
        return 'TRX' . date('Ymd') . str_pad($new_id, 4, '0', STR_PAD_LEFT);
    }

    // Save transaction
    public function save_transaksi($data, $cart)
    {
        $this->db->trans_start();
        
        $this->db->insert($this->table, $data);
        $transaksi_id = $this->db->insert_id();
        
        foreach ($cart as $item) {
            $detail = [
                'transaksi_id' => $transaksi_id,
                'product_id' => $item['id'],          
                'tipe_produk' => $item['tipe'],       
                'nama_produk' => $item['name'],
                'harga' => $item['price'],
                'qty' => $item['qty'],
                'subtotal' => $item['price'] * $item['qty']
            ];
            $this->db->insert('transaksi_detail', $detail);
        }
        
        $this->db->trans_complete();
        return $this->db->trans_status() ? $transaksi_id : false;
    }

    // Get all transactions
    public function get_all()
    {
        $this->db->order_by('id', 'DESC');
        return $this->db->get($this->table)->result_array();
    }

    // Get by ID with details
    public function get_by_id($id)
    {
        $transaksi = $this->db->get_where($this->table, ['id' => $id])->row_array();
        if ($transaksi) {
            $this->db->where('transaksi_id', $id);
            $transaksi['details'] = $this->db->get('transaksi_detail')->result_array();
        }
        return $transaksi;
    }

    // Update status
    public function update_status($id, $status)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->table, [
            'status' => $status,
            
        ]);
    }

    // Get statistics
    // Get statistics
    public function get_statistics()
    {
        // 1. Total Pendapatan All-Time (Hanya hitung yang statusnya LUNAS / 'paid')
        $this->db->select_sum('grand_total');
        $this->db->where('status', 'paid'); 
        $total_pendapatan = $this->db->get($this->table)->row_array()['grand_total'] ?? 0;
        
        // 2. Total Pendapatan KHUSUS HARI INI
        $this->db->select_sum('grand_total');
        $this->db->where('status', 'paid');
        $this->db->where('DATE(created_at)', date('Y-m-d')); // Cek tanggal hari ini aja
        $pendapatan_hari_ini = $this->db->get($this->table)->row_array()['grand_total'] ?? 0;
        
        $total_transaksi = $this->db->count_all($this->table);
        $pending = $this->db->where('status', 'Pending')->count_all_results($this->table);
        $paid = $this->db->where('status', 'paid')->count_all_results($this->table);
        
        return [
            'total_pendapatan' => $total_pendapatan,
            'pendapatan_hari_ini' => $pendapatan_hari_ini, // <--- Data baru yang kita suntik
            'total_transaksi' => $total_transaksi,
            'pending' => $pending,
            'paid' => $paid
        ];
    }

    // Get latest transactions
    public function get_latest($limit = 5)
    {
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit);
        return $this->db->get($this->table)->result_array();
    }

    public function get_detail_pesanan($id_transaksi)
    {
        // Narik data dari tabel transaksi_detail berdasarkan ID Transaksi
        $this->db->where('transaksi_id', $id_transaksi);
        return $this->db->get('transaksi_detail')->result_array();
    }

    // Fungsi untuk narik data grafik 7 hari terakhir
    public function get_grafik_pendapatan()
    {
        $this->db->select('DATE(created_at) as tanggal, SUM(grand_total) as pendapatan');
        $this->db->where('status', 'paid');
        // Filter cuma ambil 7 hari ke belakang
        $this->db->where('created_at >=', date('Y-m-d', strtotime('-7 days')));
        $this->db->group_by('DATE(created_at)');
        $this->db->order_by('DATE(created_at)', 'ASC');
        
        return $this->db->get($this->table)->result_array();
    }

    // Fungsi untuk nyari 5 produk paling laris (Gabungan Bibit & Cabai)
    public function get_produk_terlaris()
    {
        $this->db->select('transaksi_detail.nama_produk, transaksi_detail.tipe_produk, SUM(transaksi_detail.qty) as total_terjual');
        $this->db->from('transaksi_detail');
        $this->db->join('transaksi', 'transaksi.id = transaksi_detail.transaksi_id');
        $this->db->where('transaksi.status', 'paid');
        $this->db->group_by('transaksi_detail.nama_produk, transaksi_detail.tipe_produk');
        $this->db->order_by('total_terjual', 'DESC');
        
        return $this->db->get()->result_array();
    }

    public function riwayat()
{
    // 1. TAMBAHIN BARIS INI BIAR NGGAK ERROR (Load model dulu)
    $this->load->model('Transaksi_model');

    // 2. Baru deh lanjutin kodingan lu yang tadi
    $user_id = $this->session->userdata('id_user');
    
    // (Pastiin juga fungsi get_riwayat_user ini udah lu bikin di Transaksi_model.php ya)
    $data['riwayat'] = $this->Transaksi_model->get_riwayat_user($user_id);
    
    // 3. Lempar ke View
    $this->load->view('frontend/user/riwayat', $data);
    }

    public function get_riwayat_user($id_user) 
    {
        // Cari data di tabel transaksi yang 'id_user'-nya sama dengan punya user yang lagi login
        $this->db->where('id_user', $id_user);
        
        // Urutin dari yang paling baru belanjanya (paling atas)
        $this->db->order_by('created_at', 'DESC');
        
        // Ambil datanya
        return $this->db->get('transaksi')->result_array();
    }

    
    public function get_transaksi_by_kode($kode_transaksi, $id_user) 
    {
        $this->db->where('kode_transaksi', $kode_transaksi);
        $this->db->where('id_user', $id_user);
        return $this->db->get('transaksi')->row_array();
    }

    // Narik daftar barang apa aja yang dibeli di transaksi itu
    public function get_detail_transaksi($transaksi_id) 
    {
        $this->db->where('transaksi_id', $transaksi_id);
        return $this->db->get('transaksi_detail')->result_array();
    }
}
?>