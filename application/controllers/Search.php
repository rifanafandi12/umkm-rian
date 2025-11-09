<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Search extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Search_model');
        check_login();
    }

    public function index()
    {
        $keyword = $this->input->post('keyword');
        $data = $this->Search_model->cari_barang($keyword);
        $i = 1;

        if (!empty($data)) {
            foreach ($data as $brg) {
                echo "
                <div class='col-lg-3 col-md-4 col-sm-6'> 
                    <div class='position-relative'>
                <img class='img-fluid rounded-top' src='" . base_url('uploads/barang/') . $brg['gambar_barang'] . "' alt='gambar" . $brg['nama_barang'] . "'>
                <span class='badge-category'>" . $brg['jenis'] . "</span>
            </div>
            <div class='card-body'>
                <h5 class='card-title'>" . $brg['nama_barang']  . "</h5>
                <p class='card-text'>" . $brg['deskripsi'] . "</p>
                <div class='d-flex justify-content-between align-items-center'>
                    <span class='price'>" . rupiah($brg['harga_barang']) . "</span>
                    <button class='btn btn-primary btn-sm btnShow'
                        data-kode='" . $brg['kode_barang'] . "'
                        data-bs-toggle='modal'
                        data-bs-target='#productModal'>
                        <i class='fas fa-shopping-cart me-1'></i> Beli
                    </button>
                </div>
            </div>
            </div>
                ";
            }
        }else{
            echo "
                <div class='text-center py-5'>
          <div class='empty-icon mb-4'>
            <i class='fas fa-cookie-bite fa-4x text-muted'></i>
          </div>
          <h5 class='text-brown mb-3'>Kue yang anda cari Belum ada nih</h5>
          <p class='text-muted mb-4'>Coba cari kue lain yuk.</p>
          <a href=". base_url('home') ." class='btn btn-bakery-success btn-lg'>
            <i class='fas fa-search me-2'></i> Lihat yang lain
          </a>
        </div>
            ";
        }
    }
}
