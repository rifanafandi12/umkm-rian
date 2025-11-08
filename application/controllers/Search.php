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
                <div class='position-relative'>
                <div class='card-body'>
                    <h4 class='bg-danger'>Data Tidak Ditemukan</h4>
                </div>
                </div>
            ";
        }
        $this->load->view('home/scriptModal');
    }
}
