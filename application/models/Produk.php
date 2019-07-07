<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function getAllData($table) {
        $query = $this->db->get($table);
        return $query->result();
    }

    public function getAllDataWhere($table, $where, $escape = true) {
        foreach ($where as $key => $value) {
            $this->db->where($key, $value, $escape);
        }
        $query = $this->db->get($table);
        return $query->result();
    }

    public function countAllDataWhere($table, $where) {
        $this->db->where($where);
        $query = $this->db->get($table);
        return $query->num_rows();
    }

    public function selectDataWhere($table, $select, $where) {
        $this->db->select($select);
        $this->db->where($where);
        $query = $this->db->get($table);
        return $query->result();
    }

    public function insertData($table, $data) {
        $this->db->insert($table, $data);
        return ($this->db->affected_rows() > 0) ? true : false;
    }

    public function updateData($table, $where, $data, $escape = true) {
        foreach ($data as $key => $value) {
            $this->db->set($key, $value, $escape);
        }
        $this->db->where($where);
        $this->db->update($table);
        return ($this->db->affected_rows() > 0) ? true : false;
    }

    public function deleteData($table, $where) {
        $this->db->where($where);
        $this->db->delete($table, $where);
    }

    public function getRecipe($where) {
        $this->db->select('resep.*, bahan_jadi.*, bahan_baku.*');
        $this->db->from('resep');
        $this->db->join('bahan_jadi', 'resep.kode_bahan_jadi = bahan_jadi.kode_bahan_jadi');
        $this->db->join('bahan_baku', 'resep.kode_bahan_baku = bahan_baku.kode_bahan_baku');
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result();
    }

    public function getAllDataJoinWhere($select, $table1, $table2, $on, $where) {
        $this->db->select($select);
        $this->db->from($table1);
        $this->db->join($table2, $on);
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result();
    }
}