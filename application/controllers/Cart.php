<?php

use Soap\Url;

defined('BASEPATH') or exit('No direct script access allowed');

class Cart extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_login();
        $this->load->model('cart_model');
        $this->load->model('barang_model');
        $this->load->helper(['url', 'rupiah']);
    }

    // 🛒 Halaman keranjang
    public function index()
    {
        $user_id = $this->session->userdata('user_id') ?? session_id();
        $data['cart'] = $this->cart_model->get_cart($user_id);
        $data['count_cart'] = $this->cart_model->count_cart($user_id);
        $this->load->view('home/header', $data);
        $this->load->view('home/cart', $data);
        $this->load->view('home/footer');
    }

    // ➕ Tambah produk ke keranjang
    public function add()
    {
        $kode_barang = $this->input->post('kode_barang');
        $quantity = $this->input->post('quantity') ?? 1;
        $user_id = $this->session->userdata('user_id') ?? session_id();

        $this->cart_model->add_to_cart($user_id, $kode_barang, $quantity);

        // Jika request dari AJAX, kirim response JSON
        if ($this->input->is_ajax_request()) {
            echo json_encode(['status' => 'success']);
        } else {
            redirect('cart');
        }
    }

    // 🗑️ Hapus 1 item dari keranjang
    public function remove($id)
    {
        $this->cart_model->remove_item($id);
        redirect('cart');
    }

    // 🔁 Update jumlah produk (dipanggil dari jQuery AJAX)
    public function update_quantity()
    {
        $kode_barang = $this->input->post('kode_barang');
        $quantity = (int)$this->input->post('quantity');
        $user_id = $this->session->userdata('user_id') ?? session_id();

        if (!$kode_barang || $quantity < 1) {
            echo json_encode(['status' => 'error', 'message' => 'Data tidak valid']);
            return;
        }

        $this->cart_model->update_quantity($user_id, $kode_barang, $quantity);
        echo json_encode(['status' => 'success']);
    }

    // ❌ Kosongkan seluruh keranjang user
    public function clear()
    {
        $user_id = $this->session->userdata('user_id') ?? session_id();
        $this->cart_model->clear_cart($user_id);
        redirect('cart');
    }

    public function checkout()
    {
        $user_id = $this->session->userdata('user_id');
        $nama_user = $this->session->userdata('nama');
        $alamat_user = $this->session->userdata('alamat');
        $dataKeranjang = $this->cart_model->get_cart($user_id);

        $i = 1;
        $grand_total = 0;
        $jumlah_total = 0;
        $pesan = "";
        $data = [];
        $kode_pembelian = generate_kode_pembelian();
        foreach ($dataKeranjang as $keranjang) {
            $subtotal = $keranjang->harga_barang * $keranjang->quantity;
            $jumlah_total += $keranjang->quantity;
            $grand_total += $subtotal;

            $produk = "\nProduk " . $i++ . ":\n" .
                "Nama Produk: " . $keranjang->nama_barang . "\n" .
                "Jumlah: " . $keranjang->quantity . "\n" .
            "---------------------------------------------------------------";

            $pesan .= $produk;
            $data[] = [
                "kode_pembelian" => $kode_pembelian,
                "kode_barang" => $keranjang->kode_barang,
                "id_user" => $keranjang->user_id,
                "jumlah_barang" => $keranjang->quantity,
                "nama_barang" => $keranjang->nama_barang,
                "harga_barang" => $keranjang->harga_barang,
                "total_harga" => $subtotal
            ];
        }

        $wa_admin = '6281269766179';
        $send_message = "Hello, saya *". $nama_user . "* ingin memesan:\n" .
        "Kode Pembelian: *". $kode_pembelian . "*".
            $pesan . "\n".
            "Jumlah Seluruh Item: *" . $jumlah_total . "* \n" .
            "Total: *" . rupiah($grand_total) . "* \n" .
            "Alamat: *" . $alamat_user . "* \n\n" .
            "Terima kasih.";

        // Encode pesan agar sesuai format URL WhatsApp
        $url = "https://wa.me/" . $wa_admin . "?text=" . urlencode($send_message);
        $this->db->insert_batch('tb_pembelian', $data);
        $this->cart_model->remove_all_item($user_id);
        redirect($url);
    }
}
