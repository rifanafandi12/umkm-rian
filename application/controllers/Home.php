<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('barang_model');
        check_login();
    }

    public function index()
    {
        $user_id = $this->session->userdata('user_id');
        $data['barangs'] = $this->barang_model->get_all(); // tampilkan 8 produk dulu
        $data['count_cart'] = $this->cart_model->count_cart($user_id);
        $data['total_products'] = $this->barang_model->count_all();

        $this->load->view('home/header', $data);
        $this->load->view('home/index', $data);
        $this->load->view('home/footer');
    }

    public function beli()
    {
        $data = [
            "kode_pembelian" => generate_kode_pembelian(),
            "kode_barang" => $this->input->post('kode_barang'),
            'id_user' => $this->session->userdata('user_id'),
            "nama_barang" => $this->input->post('nama_barang'),
            "jumlah_barang" => $this->input->post('jumlah_barang'),
            "harga_barang" => $this->input->post('harga_barang'),
            "total_harga" => $this->input->post('total_harga')
        ];
        $this->db->insert('tb_pembelian', $data);   
        
        if($this->db->affected_rows() > 0){
            echo json_encode([
                "status" => 'success',
                "message" => 'Pembelian berhasil dibuat!'
            ]);
        }else{
            echo json_encode([
                "status" => 'error',
                "message" => 'Terjadi Kesalahan silahkan hubungi admin'
            ]);
        }

    }
}
