<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('barang_model');
        $this->load->model('pembelian_model');
        check_login();
        check_role(['admin']);
    }

    public function index()
    {
        // Data statistik untuk dashboard
        $data['stats'] = [
            'total_users' => $this->user_model->count_all_users(),
            'total_barang' => $this->barang_model->count_all(),
            'total_pembelian' => $this->count_all_pembelian(),
            'total_pendapatan' => $this->get_total_pendapatan()
        ];

        // Data terbaru
        $data['barang_terbaru'] = $this->barang_model->get_latest_barang(5);
        $data['pembelian_terbaru'] = $this->pembelian_model->get_latest_pembelian(5);
        $data['users_terbaru'] = $this->user_model->get_latest_users(5);

        // Data chart (contoh sederhana)
        $data['chart_data'] = $this->get_chart_data();

        $this->load->view('admin/header');
        $this->load->view('admin/dashboard', $data);
        $this->load->view('admin/footer');
    }

    private function count_all_pembelian()
    {
        $this->db->from('tb_pembelian');
        return $this->db->count_all_results();
    }

    private function get_total_pendapatan()
    {
        $this->db->select_sum('total_harga');
        $result = $this->db->get('tb_pembelian')->row_array();
        return $result['total_harga'] ?? 0;
    }

    private function get_chart_data()
    {
        // Data dummy untuk chart - dalam implementasi real bisa dari database
        return [
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
            'data' => [65, 59, 80, 81, 56, 55]
        ];
    }

    
    public function manajement_user()
    {
        $data['users'] = $this->user_model->get_all_user();

        $this->load->view('admin/header');
        $this->load->view('admin/manajement_user', $data);
        $this->load->view('admin/footer');
    }

    public function hapus_user($id_user)
    {
        // Cek apakah user exists
        $user = $this->user_model->get_user_by_id($id_user);
        if (!$user) {
            $this->session->set_flashdata('error', 'User tidak ditemukan!');
            redirect('admin/manajement_user');
        }

        // Hapus user
        if ($this->user_model->delete_user($id_user)) {
            $this->session->set_flashdata('success', 'User berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus user.');
        }

        redirect('admin/manajement_user');
    }
   
}