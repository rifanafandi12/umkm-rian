<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{


    public function index()
    {
        $this->load->view('auth/login');
        check_sudahlogin();
    }

    public function go_login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $user = $this->user_model->login($username, $password);

        if ($user) {
            // ambil identitas user
            $this->session->set_userdata([
                'logged_in' => true,
                'user_id' => $user->id_user,
                'nama' => $user->nama,
                'username' => $user->username,
                'password' => $user->password,
                'no_hp' => $user->no_hp,
                'alamat' => $user->alamat,
                'role' => $user->role
            ]);

            $this->session->set_flashdata('success', 'Welcome ' . $siswa->nama);

            if ($user->role === 'admin') {
                redirect('admin');
            } elseif ($user->role === 'user') {
                redirect('home');
            }
        } else {
            $this->session->set_flashdata('error', 'username belum terdaftar');
        }

        redirect('auth');
    }

    public function register()
    {
        $this->load->view('auth/register');
        check_sudahlogin();
    }

    public function go_register()
    {

        // ambil data dari $_POST
        $nama = $this->input->post('nama');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $no_hp = $this->input->post('no_hp');
        $alamat = $this->input->post('alamat');

        $data = [
            'nama' => $nama,
            'username' => $username,
            'password' => $password,
            'no_hp' => $no_hp,
            'alamat' => $alamat
        ];

        // cek username belum terdaftar 
        if ($this->user_model->is_username($data['username']) === 1) {
            $this->session->set_flashdata('error', 'Username sudah terdaftar');
            redirect('auth/register');
            exit;
        }


        if ($this->user_model->register($data)) {
            $this->session->set_flashdata('success', 'Selamat akun kamu berhasil terdaftar.');
        } else {
            $this->session->set_flashdata('error', 'Terjadi kesalahan. coba lagi');
        }

        redirect('auth');
    }

    public function logout()
    {
        check_login();
        // hapus session userdata
        $this->session->unset_userdata('logged_in', 'nama', 'username', 'password', 'no_hp', 'alamat', 'role');

        // beri pesan anda berhasil logout
        $this->session->set_flashdata('success', 'Anda berhasil logout.');
        redirect('auth');
    }
}
