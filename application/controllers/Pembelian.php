<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembelian extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('pembelian_model');
        $this->load->model('cart_model');
        check_login();
    }

    public function index()
    {
        check_role(['admin']);
        $data['pembelians'] = $this->pembelian_model->get_all_with_join();
        $data['grouped_pembelians'] = $this->group_pembelians_by_date_user($data['pembelians']);

        $this->load->view('admin/header');
        $this->load->view('pembelian/index', $data);
        $this->load->view('admin/footer');
    }

    public function riwayatPembelian()
    {
        $id_user = $this->session->userdata('user_id');
        $data['count_cart'] = $this->cart_model->count_cart($id_user);

        $data['title'] = 'Riwayat Pembelian';
        $pembelians = $this->pembelian_model->get_all_byUser($id_user);
        $data['grouped_pembelians'] = $this->group_pembelians_by_date_user($pembelians);

        $this->load->view('home/header', $data);
        $this->load->view('home/riwayat_pembelian', $data);
        $this->load->view('home/footer');
    }

    public function detail($kode_pembelian)
    {
        $data['pembelian'] = $this->pembelian_model->get_by_kode($kode_pembelian);
        if (!$data['pembelian']) {
            show_404();
        }

        if ($this->session->userdata('role') == 'admin') {
            $this->load->view('admin/header');
            $this->load->view('pembelian/detail', $data);
            $this->load->view('admin/footer');
        } else {
            $id_user = $this->session->userdata('user_id');
            $data['count_cart'] = $this->cart_model->count_cart($id_user);
            $data['title'] = 'Detail Pembelian';

            $this->load->view('home/header', $data);
            $this->load->view('pembelian/detail', $data);
            $this->load->view('home/footer');
        }
    }

    public function hapus($kode_pembelian)
    {
        if ($this->session->userdata('role') != 'admin') {
            show_404();
        }

        if ($this->pembelian_model->delete_pembelian($kode_pembelian)) {
            $this->session->set_flashdata('success', 'Pembelian berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus pembelian.');
        }

        redirect('pembelian');
    }

    private function group_pembelians_by_date_user($pembelians)
    {
        $grouped = [];
        foreach ($pembelians as $pembelian) {
            $key = $pembelian['tgl_pembelian'] . '_' . $pembelian['id_user'];
            if (!isset($grouped[$key])) {
                $grouped[$key] = [
                    'tanggal' => $pembelian['tgl_pembelian'],
                    'user' => $pembelian['nama_user'],
                    'id_user' => $pembelian['id_user'],
                    'items' => [],
                    'total_transaksi' => 0
                ];
            }
            $grouped[$key]['items'][] = $pembelian;
            $grouped[$key]['total_transaksi'] += $pembelian['total_harga'];
        }
        return $grouped;
    }
}
