<?php
defined('BASEPATH') or exit('No direct script access allowed');

class user_model extends CI_Model
{

    public function get_all_user()
    {
        return $this->db->get_where('tb_user', ['role' => 'user'])->result_array();
    }

    public function get_user_by_id($id_user)
    {
        return $this->db->get_where('tb_user', ['id_user' => $id_user])->row_array();
    }

    public function is_username($username)
    {
        $this->db->where('username', $username)->get('tb_user');

        return $this->db->affected_rows();
    }

    public function register($data)
    {
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

        return $this->db->insert('tb_user', $data);
    }

    public function login($username, $password)
    {
        $user = $this->db->where('username', $username)->get('tb_user')->row();
        if ($user && password_verify($password, $user->password)) {
            return $user;
        } else {
            return false;
        }
    }

    public function delete_user($id_user)
    {
        return $this->db->delete('tb_user', ['id_user' => $id_user]);
    }

    public function count_all_users()
    {
        return $this->db->get_where('tb_user', ['role' => 'user'])->num_rows();
    }

    public function get_latest_users($limit = 5)
    {
        $this->db->where('role', 'user');
        $this->db->order_by('created_at', 'DESC');
        $this->db->limit($limit);
        return $this->db->get('tb_user')->result_array();
    }
}
