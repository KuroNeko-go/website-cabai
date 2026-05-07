<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bibit_model extends CI_Model {

    protected $table = 'bibits';

    public function __construct()
    {
        parent::__construct();
    }

    // Get all with cabai data
    public function get_all_with_cabai()
    {
        $this->db->select('bibits.*, cabais.nama_varietas, cabais.tingkat_pedas, cabais.skala_pedas');
        $this->db->from($this->table);
        $this->db->join('cabais', 'cabais.id = bibits.cabai_id');
        $this->db->order_by('bibits.is_popular DESC, bibits.id ASC');
        return $this->db->get()->result_array();
    }

    // Get popular products
    public function get_popular($limit = 4)
    {
        $this->db->where('is_popular', 1);
        $this->db->limit($limit);
        return $this->db->get($this->table)->result_array();
    }

    // Get new products
    public function get_new($limit = 4)
    {
        $this->db->where('is_new', 1);
        $this->db->limit($limit);
        return $this->db->get($this->table)->result_array();
    }

    // Get by ID
    public function get_by_id($id)
    {
        $this->db->select('bibits.*, cabais.nama_varietas, cabais.tingkat_pedas');
        $this->db->from($this->table);
        $this->db->join('cabais', 'cabais.id = bibits.cabai_id');
        $this->db->where('bibits.id', $id);
        return $this->db->get()->row_array();
    }

    // Get by cabai ID
    public function get_by_cabai_id($cabai_id)
    {
        return $this->db->get_where($this->table, ['cabai_id' => $cabai_id])->result_array();
    }

    // Insert
    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    // Update
    public function update($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    // Delete
    public function delete($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }

    // Check stock
    public function check_stock($id, $qty = 1)
    {
        $bibit = $this->get_by_id($id);
        return ($bibit && $bibit['stok'] >= $qty);
    }

    // Reduce stock
    public function reduce_stock($id, $qty)
    {
        $this->db->set('stok', "stok - $qty", FALSE);
        $this->db->where('id', $id);
        return $this->db->update($this->table);
    }

    // Get low stock
    public function get_low_stock()
    {
        $this->db->where('stok <', 10);
        $this->db->order_by('stok', 'ASC');
        return $this->db->get($this->table)->result_array();
    }
}
?>