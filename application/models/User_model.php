<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    public function getEmail()
    {
        return $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    }

    public function getUser()
    {
        return $this->db->get('user')->result_array();
    }

    public function getRole()
    {
        return $this->db->get('role')->result_array();
    }

    public function ubahPassword()
    {
        $password1_baru = $this->input->post('password1_baru');
        $password_hash = password_hash($password1_baru, PASSWORD_DEFAULT);
        $this->db->set('password', $password_hash);
        $this->db->where('email', $this->session->userdata('email'));
        $this->db->update('user');
    }

    public function editUser()
    {
        $nama = $this->input->post('nama');
        $email = $this->input->post('email');

        $this->db->set('nama', $nama);
        $this->db->where('email', $email);
        $this->db->update('user');
    }
}
