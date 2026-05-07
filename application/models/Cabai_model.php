<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cabai_model extends CI_Model {

    protected $table = 'cabais';

    public function __construct()
    {
        parent::__construct();
    }

    // Get all cabai
    public function get_all()
    {
        return $this->db->get($this->table)->result_array();
    }

    // Get all with bibit count
    public function get_all_with_count()
    {
        $this->db->select('cabais.*, COUNT(bibits.id) as total_bibit');
        $this->db->from($this->table);
        $this->db->join('bibits', 'bibits.cabai_id = cabais.id', 'left');
        $this->db->group_by('cabais.id');
        return $this->db->get()->result_array();
    }

    // Get featured cabai (limit)
    public function get_featured($limit = 6)
    {
        $this->db->limit($limit);
        return $this->db->get($this->table)->result_array();
    }

    // Get by ID
    public function get_by_id($id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->row_array();
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

    // Search
    public function search($keyword)
    {
        $this->db->like('nama_varietas', $keyword);
        $this->db->or_like('nama_latin', $keyword);
        return $this->db->get($this->table)->result_array();
    }
}
?>