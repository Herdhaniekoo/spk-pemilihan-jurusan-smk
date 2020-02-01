<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
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

    public function getMenu_user()
    {
        return $this->db->get('menu_user')->result_array();
    }
    public function getRoleId()
    {
        //return $this->db->get_where('role', ['role_id' => $role_id])->row_array();
    }

    public function tambahPengguna()
    {

        $data = [
            'nama' => $this->input->post('nama', true),
            'email' => $this->input->post('email', true),
            'role_id' => $this->input->post('role_id', true),
            'is_active' => $this->input->post('is_active', true),
            'password' => password_hash('123', PASSWORD_DEFAULT),
            'image' => $this->upload->data('file_name'),
            'date_created' => $this->input->post('date_created', true)
        ];
        $this->db->insert('user', $data);
    }

    public function hapusPengguna($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user');
    }

    public function editPengguna()
    {
        $nama = $this->input->post('nama');
        $email = $this->input->post('email');
        $role_id = $this->input->post('role_id');
        $is_active = $this->input->post('is_active');

        $data = [
            'nama' => $nama,
            'email' => $email,
            'role_id' => $role_id,
            'is_active' => $is_active
        ];

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('user', $data);
    }
    
}
