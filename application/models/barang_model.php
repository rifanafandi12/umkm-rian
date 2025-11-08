<?php
defined('BASEPATH') or exit('No direct script access allowed');

class barang_model extends CI_Model
{
    public function get_all()
    {
        return $this->db->get('tb_barang')->result_array();
    }

    public function count_all()
    {
        return $this->db->count_all('tb_barang');
    }

    public function insert_barang($data)
    {
        return $this->db->insert('tb_barang', $data);
    }

    public function cek_kode($kode)
    {
        return $this->db->get_where('tb_barang', ['kode_barang' => $kode])->num_rows() > 0;
    }

    public function get_barang_by_kode($kode_barang)
    {
        return $this->db->get_where('tb_barang', ['kode_barang' => $kode_barang])->row_array();
    }

    public function update_barang($kode_barang, $data)
    {
        $this->db->where('kode_barang', $kode_barang);
        return $this->db->update('tb_barang', $data);
    }

    public function delete_barang($kode)
    {
        return $this->db->delete('tb_barang', ['kode_barang' => $kode]);
    }

    public function get_latest_barang($limit = 5)
    {
        $this->db->order_by('created_at', 'DESC');
        $this->db->limit($limit);
        return $this->db->get('tb_barang')->result_array();
    }
}
