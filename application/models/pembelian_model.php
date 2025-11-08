<?php
defined('BASEPATH') or exit('No direct script access allowed');

class pembelian_model extends CI_Model
{
    public function get_all_with_join()
    {
        $this->db->select('
            pembelian.*,
            user.nama as nama_user,
            barang.nama_barang,
            barang.gambar_barang
        ');
        $this->db->from('tb_pembelian pembelian');
        $this->db->join('tb_user user', 'user.id_user = pembelian.id_user', 'left');
        $this->db->join('tb_barang barang', 'barang.kode_barang = pembelian.kode_barang', 'left');
        $this->db->order_by('pembelian.tgl_pembelian', 'DESC');
        $this->db->order_by('pembelian.id_user', 'ASC');

        return $this->db->get()->result_array();
    }

    public function get_all_byUser($id_user)
    {
        $this->db->select('
            pembelian.*,
            user.nama as nama_user,
            barang.nama_barang,
            barang.gambar_barang
        ');
        $this->db->from('tb_pembelian pembelian');
        $this->db->join('tb_user user', 'user.id_user = pembelian.id_user', 'left');
        $this->db->join('tb_barang barang', 'barang.kode_barang = pembelian.kode_barang', 'left');
        $this->db->where('pembelian.id_user', $id_user);
        $this->db->order_by('pembelian.tgl_pembelian', 'DESC');

        return $this->db->get()->result_array();
    }

    public function get_by_kode($kode_pembelian)
    {
        $this->db->select('
            pembelian.*,
            user.nama as nama_user,
            user.no_hp,
            barang.nama_barang,
            barang.gambar_barang,
            barang.jenis
        ');
        $this->db->from('tb_pembelian pembelian');
        $this->db->join('tb_user user', 'user.id_user = pembelian.id_user', 'left');
        $this->db->join('tb_barang barang', 'barang.kode_barang = pembelian.kode_barang', 'left');
        $this->db->where('pembelian.kode_pembelian', $kode_pembelian);

        return $this->db->get()->row_array();
    }

    public function delete_pembelian($kode_pembelian)
    {
        return $this->db->delete('tb_pembelian', ['kode_pembelian' => $kode_pembelian]);
    }

    public function get_items_by_transaction($tgl_pembelian, $id_user)
    {
        $this->db->select('
            pembelian.*,
            barang.nama_barang,
            barang.gambar_barang
        ');
        $this->db->from('tb_pembelian pembelian');
        $this->db->join('tb_barang barang', 'barang.kode_barang = pembelian.kode_barang', 'left');
        $this->db->where('pembelian.tgl_pembelian', $tgl_pembelian);
        $this->db->where('pembelian.id_user', $id_user);

        return $this->db->get()->result_array();
    }

    public function get_latest_pembelian($limit = 5)
    {
        $this->db->select('pembelian.*, user.nama, barang.nama_barang');
        $this->db->from('tb_pembelian pembelian');
        $this->db->join('tb_user user', 'user.id_user = pembelian.id_user', 'left');
        $this->db->join('tb_barang barang', 'barang.kode_barang = pembelian.kode_barang', 'left');
        $this->db->order_by('pembelian.tgl_pembelian', 'DESC');
        $this->db->limit($limit);
        return $this->db->get()->result_array();
    }
}
