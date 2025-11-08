<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cart_model extends CI_Model
{
    // Ambil semua item keranjang berdasarkan user
    public function get_cart($user_id)
    {
        $this->db->select('cart.*, barang.nama_barang, barang.gambar_barang, barang.deskripsi, barang.harga_barang');
        $this->db->from('cart');
        $this->db->join('tb_barang barang', 'barang.kode_barang = cart.kode_barang');
        $this->db->where('cart.user_id', $user_id);
        return $this->db->get()->result();
    }

    // Tambahkan item ke keranjang
    public function add_to_cart($user_id, $kode_barang, $quantity = 1)
    {
        $this->db->where('user_id', $user_id);
        $this->db->where('kode_barang', $kode_barang);
        $item = $this->db->get('cart')->row();

        if ($item) {
            // Jika sudah ada, tambahkan quantity
            $this->db->set('quantity', 'quantity + ' . (int)$quantity, FALSE);
            $this->db->where('id', $item->id);
            $this->db->update('cart');
        } else {
            // Jika belum ada, insert baru
            $data = [
                'user_id' => $user_id,
                'kode_barang' => $kode_barang,
                'quantity' => $quantity,
                'created_at' => date('Y-m-d H:i:s')
            ];
            $this->db->insert('cart', $data);
        }
    }

    // 🔹 Fungsi tambahan untuk update jumlah via AJAX
    public function update_quantity($user_id, $kode_barang, $quantity)
    {
        $this->db->where('user_id', $user_id);
        $this->db->where('kode_barang', $kode_barang);
        return $this->db->update('cart', ['quantity' => $quantity]);
    }

    // Hapus item tertentu
    public function remove_item($id)
    {
        $this->db->delete('cart', ['id' => $id]);
    }

    public function remove_all_item($user_id){
        $this->db->delete('cart', ['user_id' => $user_id]);
    }

    // Hapus semua item user
    public function clear_cart($user_id)
    {
        $this->db->delete('cart', ['user_id' => $user_id]);
    }

    public function count_cart($user_id){
        $this->db->where('user_id', $user_id);
        return $this->db->count_all_results('cart');
    }
    
}
