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

}
