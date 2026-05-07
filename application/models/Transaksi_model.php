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
                'bibit_id' => $item['id'],
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
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }

    // Get statistics
    public function get_statistics()
    {
        $this->db->select_sum('grand_total');
        $this->db->where('status !=', 'cancelled');
        $total_pendapatan = $this->db->get($this->table)->row_array()['grand_total'] ?? 0;
        
        $total_transaksi = $this->db->count_all($this->table);
        $pending = $this->db->where('status', 'pending')->count_all_results($this->table);
        $completed = $this->db->where('status', 'completed')->count_all_results($this->table);
        
        return [
            'total_pendapatan' => $total_pendapatan,
            'total_transaksi' => $total_transaksi,
            'pending' => $pending,
            'completed' => $completed
        ];
    }

    // Get latest transactions
    public function get_latest($limit = 5)
    {
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit);
        return $this->db->get($this->table)->result_array();
    }
}
?>