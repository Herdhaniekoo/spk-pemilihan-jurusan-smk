<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller

{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', 'user');
    }

    public function index()
    {
        $data['judul'] = 'Profil Saya';
        $data['namauser'] = 'Admin SPK';

        $data['user'] = $this->user->getEmail();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }

    public function ubahPassword()
    {
        $data['judul'] = 'Ubah Password';
        $data['namauser'] = 'Admin SPK';

        $data['user'] = $this->user->getEmail();

        $this->form_validation->set_rules(
            'password_lama',
            'password lama',
            'required|trim'
        );
        $this->form_validation->set_rules(
            'password1_baru',
            'Password baru',
            'required|trim|min_length[3]|matches[password2_baru]'
        );
        $this->form_validation->set_rules(
            'password2_baru',
            'Konfirmasi password baru',
            'required|trim|min_length[3]|matches[password1_baru]'
        );

        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/ubahPassword', $data);
            $this->load->view('templates/footer');
        } else {
            //cek password lama sama tidak dengan db
            $password_lama = $this->input->post('password_lama');
            $password1_baru = $this->input->post('password1_baru');
            if (!password_verify($password_lama, $data['user']['password'])) {

                $this->session->set_flashdata('message', '<div align="center" class="alert alert-danger" role="alert">
                                            Password lama tidak cocok!
                                            </div>');
                redirect('user/ubahPassword');
            } else {
                //cek password lama sama tidak dengan password baru
                if ($password_lama == $password1_baru) {
                    $this->session->set_flashdata('message', '<div align="center" class="alert alert-danger" role="alert">
                                            Password tidak boleh sama dengan password lama!
                                            </div>');
                    redirect('user/ubahPassword');
                } else {
                    //password OK
                    $this->user->ubahPassword();
                    $this->session->set_flashdata('message', '<div align="center" class="alert alert-success" role="alert">
                                            Password berhasil diubah!
                                            </div>');
                    redirect('user/ubahPassword');
                }
            }
        }
    }


    public function editUser()
    {
        $data['judul'] = 'Edit Profil';
        $data['namauser'] = 'Admin SPK';

        $data['user'] = $this->user->getEmail();

        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');

        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/editUser', $data);
            $this->load->view('templates/footer');
        } else {

            //jika ada gambar yg diupload
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {

                //syarat image  
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']     = '4096';
                $config['upload_path'] = './assets/images/';

                $this->load->library('upload', $config);

                //bila loloas, maka upload
                if ($this->upload->do_upload('image')) {
                    $old_image = $data['user']['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/images/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }
            $this->user->editUser();
            $this->session->set_flashdata('message', '<div align="center" class="alert alert-success" role="alert">
                                            Data user berhasil diubah!
                                            </div>');
            redirect('user');
        }
    }

    public function frontend()
    {
        $data['judul'] = 'SPK SMK';
        $this->load->view('user/frontend', $data);
    }
}
