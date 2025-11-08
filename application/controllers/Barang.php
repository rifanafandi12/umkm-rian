<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_login();
        $this->load->model('barang_model');
        if (!is_dir(FCPATH . 'uploads/barang')) {
            mkdir(FCPATH . 'uploads/barang', 0777, TRUE);
        }
    }

    public function index()
    {
        $data['barangs'] = $this->barang_model->get_all();

        $this->load->view('admin/header');
        $this->load->view('barang/index', $data);
        $this->load->view('admin/footer');
        check_role(['admin']);
    }

    public function tambah()
    {
        check_role(['admin']);

        $this->load->library('form_validation');
        $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required|trim');
        $this->form_validation->set_rules('jenis', 'Jenis', 'required|trim');
        $this->form_validation->set_rules('harga_barang', 'Harga Barang', 'required|trim|numeric|greater_than[0]');

        if ($this->form_validation->run() == FALSE) {
            // Tampilkan form dengan error
            $this->load->view('admin/header');
            $this->load->view('barang/tambah');
            $this->load->view('admin/footer');
        } else {
            // Proses upload gambar (jika ada)
            $gambar = '';
            if (!empty($_FILES['gambar_barang']['name'])) {
                $config['upload_path']   = './uploads/barang/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['max_size']      = 2048; // 2MB
                $config['encrypt_name']  = TRUE;

                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('gambar_barang')) {
                    $error = $this->upload->display_errors('', '');
                    $this->session->set_flashdata('error', $error);
                    redirect('barang/tambah');
                } else {
                    $upload_data = $this->upload->data();
                    $gambar = $upload_data['file_name'];
                }
            }

            $data = [
                'kode_barang' => generate_kode_barang(),
                'nama_barang' => $this->input->post('nama_barang', TRUE),
                'jenis'       => $this->input->post('jenis', TRUE),
                'harga_barang' => $this->input->post('harga_barang', TRUE),
                'gambar_barang' => $gambar
            ];

            if ($this->barang_model->insert_barang($data)) {
                $this->session->set_flashdata('success', 'Barang berhasil ditambahkan!');
                redirect('barang');
            } else {
                $this->session->set_flashdata('error', 'Gagal menyimpan data.');
                redirect('barang/tambah');
            }
        }
    }

    public function edit($kode_barang)
    {
        // Get data barang berdasarkan kode
        $data['barang'] = $this->barang_model->get_barang_by_kode($kode_barang);
        // Load form helper
        $this->load->helper('form');
        if (!$data['barang']) {
            show_404();
        }

        $this->load->view('admin/header');
        $this->load->view('barang/edit', $data);
        $this->load->view('admin/footer');
    }

    public function update($kode_barang)
    {
        // Set validation rules
        $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required');
        $this->form_validation->set_rules('jenis', 'Jenis', 'required');
        $this->form_validation->set_rules('harga_barang', 'Harga Barang', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            // Jika validasi gagal, tampilkan form edit lagi
            $this->edit($kode_barang);
        } else {
            // Prepare data untuk update
            $data = [
                'nama_barang' => $this->input->post('nama_barang'),
                'jenis' => $this->input->post('jenis'),
                'harga_barang' => $this->input->post('harga_barang'),
                'deskripsi' => $this->input->post('deskripsi')
            ];

            // Handle image upload
            if (!empty($_FILES['gambar_barang']['name'])) {
                $config['upload_path'] = './uploads/barang/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['max_size'] = 2048; // 2MB
                $config['file_name'] = uniqid();

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('gambar_barang')) {
                    $upload_data = $this->upload->data();
                    $data['gambar_barang'] = $upload_data['file_name'];

                    // Hapus gambar lama jika ada
                    $old_image = $this->barang_model->get_barang_by_kode($kode_barang)['gambar_barang'];
                    if (!empty($old_image) && file_exists('./uploads/barang/' . $old_image)) {
                        unlink('./uploads/barang/' . $old_image);
                    }
                }
            }

            // Handle delete image request
            if ($this->input->post('hapus_gambar')) {
                $old_image = $this->barang_model->get_barang_by_kode($kode_barang)['gambar_barang'];
                if (!empty($old_image) && file_exists('./uploads/barang/' . $old_image)) {
                    unlink('./uploads/barang/' . $old_image);
                }
                $data['gambar_barang'] = null;
            }

            // Update data
            if ($this->barang_model->update_barang($kode_barang, $data)) {
                $this->session->set_flashdata('success', 'Kue berhasil diupdate!');
            } else {
                $this->session->set_flashdata('error', 'Gagal mengupdate kue!');
            }

            redirect('barang');
        }
    }
    public function hapus($kode_barang)
    {
        check_role(['admin']);

        $barang = $this->barang_model->get_barang_by_kode($kode_barang);
        if (!$barang) {
            $this->session->set_flashdata('error', 'Barang tidak ditemukan!');
            redirect('barang');
        }

        // Hapus gambar jika ada
        if (!empty($barang['gambar_barang']) && file_exists('./uploads/barang/' . $barang['gambar_barang'])) {
            unlink('./uploads/barang/' . $barang['gambar_barang']);
        }

        if ($this->barang_model->delete_barang($kode_barang)) {
            $this->session->set_flashdata('success', 'Barang berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus data.');
        }

        redirect('barang');
    }

    public function getBarangById()
    {
        echo json_encode($this->barang_model->get_barang_by_kode($this->input->post('kode')));
    }
}
