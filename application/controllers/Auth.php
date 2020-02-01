<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Auth_model', 'auth');
    }

    public function index()
    {
        if ($this->session->userdata('email')) {
            redirect('admin');
        }

        $this->form_validation->set_rules('email', 'email', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['judul'] = 'Halaman Login';
            $this->load->view('auth/login', $data);
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        //ambil data dari tabel user
        $user = $this->auth->getUser($email);
        //cek ada tidaknya user
        if ($user) {
            //usernya ada(aktif)
            if ($user['is_active'] == 1) {
                //cek passwordnya benar tidaknya
                if (password_verify($password, $user['password'])) {
                    //benar
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id']
                    ];
                    $this->session->set_userdata($data);
                    if ($user['role_id'] == 1) {
                        redirect('admin');
                    } elseif ($user['role_id'] == 2) {
                        redirect('user');
                    } elseif ($user['role_id'] == 3) {
                        redirect('siswa');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                                            Password salah!
                                            </div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div align="center" class="alert alert-danger" role="alert">
                                            Email belum aktif!
                                            </div>');
                redirect('auth');
            }
        } else {
            //jika tidak ada
            $this->session->set_flashdata('message', '<div align="center" class="alert alert-danger" role="alert">
                                            Email belum terdaftar!
                                            </div>');
            redirect('auth');
        }
    }

    public function daftar()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|is_unique[user.email]', [
            'is_unique' => 'Email ini sudah terdaftar!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', ['matches=> Password tidak sesuai!', 'min_length=>Password kurang panjang!']);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        //kalo syarat mendaftar kurang atau salah
        if ($this->form_validation->run() == false) {
            $data['judul'] = 'Halaman Daftar';
            $this->load->view('auth/daftar', $data);
        } else {
            $data  = [
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'image' => 'default.png',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 2,
                'is_active' => 1,
                'date_created' => date('Y-m-d')
            ];

            //insert ke db
            $this->db->insert('user', $data);
            $this->session->set_flashdata('message', '<div align="center" class="alert alert-success" role="alert">
                                            Anda sudah terdaftar, silahkan login!
                                            </div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');

        $this->session->set_flashdata('message', '<div align="center" class="alert alert-success" role="alert">
                                            Anda telah berhasil keluar.
                                            </div>');
        redirect('auth');
    }
    public function block()
    {
        $data['judul'] = 'Akses ditolak';


        $data['user'] = $this->auth->getEmail();

        $this->load->view('auth/block', $data);
    }
}
