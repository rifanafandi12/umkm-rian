<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Search_model extends CI_Model
{

    public function cari_barang($keyword = null){
        if($keyword){
            $this->db->like('nama_barang', $keyword);
        }elseif($keyword = ''){
            $this->db->limit(10);
        }

        $this->db->order_by('nama_barang', 'ASC');
        return $this->db->get('tb_barang')->result_array();
    }

}
