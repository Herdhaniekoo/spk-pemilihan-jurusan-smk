 <?php
    defined('BASEPATH') or exit('No direct script access allowed');

    class Admin extends CI_Controller

    {
        public function __construct()
        {
            parent::__construct();
            sudah_login();
            $this->load->library('form_validation');
            $this->load->model('Admin_model', 'admin');
            $this->load->model('Menu_model', 'menu');
        }


        public function index()
        {
            $data['judul'] = 'Dashboard';
            $data['namauser'] = 'Admin SPK';

            $data['user'] = $this->admin->getEmail();


            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/index', $data);
            $this->load->view('templates/footer');
        }


        public function pengguna()
        {
            $data['judul'] = 'Admin SPK';
            $data['namauser'] = 'Admin SPK';
            $data['namatabel'] = 'Data Pengguna';

            $data['pengguna'] = $this->admin->getUser();
            $data['role'] = $this->admin->getRole();

            $data['user'] = $this->admin->getEmail();


            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/pengguna', $data);
            $this->load->view('templates/footer');
            $this->load->view('admin/modal/modal_tambah_pengguna');
            $this->load->view('admin/modal/modal_edit_pengguna');
        }
        public function tambahPengguna()
        {
            $gambar = $_FILES['image']['name'];
            if ($gambar = '') {
                # code...
            } else {
                $config['upload_path']          = './assets/images/';
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
                $config['max_size']             = 2048;
                $config['max_width']            = 8000;
                $config['max_height']           = 9000;
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('image')) {
                    echo "Gagal";
                } else {
                    $this->admin->tambahPengguna();
                    $this->session->set_flashdata('message', '<div align="center" class="alert alert-success" role="alert">Pengguna berhasil ditambahkan!</div>');
                    redirect('admin/pengguna');
                }
            }
        }

        public function hapusPengguna($id)
        {
            $this->admin->hapusPengguna($id);
            $this->session->set_flashdata('message', '<div align="center" class="alert alert-success" role="alert">
                                            Pengguna berhasil dihapus!
                                            </div>');
            redirect('admin/pengguna');
        }

        public function editPengguna()
        {
            $data['user'] = $this->admin->getEmail();

            // cek jika ada gambar yang akan diupload
            $upload_image = $_FILES['image']['name'];
            if ($upload_image) {
                $config['upload_path']          = './assets/images/';
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
                $config['max_size']             = 2048;
                $config['max_width']            = 8000;
                $config['max_height']           = 9000;

                $this->load->library('upload', $config);
                if ($this->upload->do_upload('image')) {
                    $old_image = $data['user']['image'];
                    if ($old_image != 'user.png') {
                        unlink(FCPATH . '/assets/images/' . $old_image);
                    }
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->dispay_errors();
                }
            }

            $this->admin->editPengguna();
            $this->session->set_flashdata('message', '<div align="center" class="alert alert-success" role="alert">
                                            Pengguna berhasil diubah!
                                            </div>');
            redirect('admin/pengguna');
        }

        // ROLE

        public function role()
        {
            $data['judul'] = 'Role dan Menu Manajemen';
            $data['namauser'] = 'Admin SPK';

            $data['user'] = $this->admin->getEmail();
            $data['role'] = $this->admin->getRole();
            $data['menu'] = $this->menu->getMenu();
            $data['submenu'] = $this->menu->getSubmenu();

            $data['submenu'] = $this->menu->getJoin();

            $this->form_validation->set_rules('role', 'Role', 'required');
            if ($this->form_validation->run() == false) {
                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('templates/topbar', $data);
                $this->load->view('admin/role', $data);
                $this->load->view('templates/footer');
                $this->load->view('admin/modal/modal_tambah_submenu');
                $this->load->view('admin/modal/modal_edit_submenu');
            } else {

                $this->menu->tambahRole();
                $this->session->set_flashdata('message', '<div align="center" class="alert alert-success" role="alert">
                                            Role baru berhasil ditambahkan
                                            </div>');
                redirect('admin/role');
            }
        }

        public function editRole()
        {
            $this->menu->editRole();
            $this->session->set_flashdata('message', '<div align="center" class="alert alert-success" role="alert">
                                            Role berhasil diubah!
                                            </div>');
            redirect('admin/role');
        }

        public function hapusRole($id)
        {
            $this->menu->hapusRole($id);
            $this->session->set_flashdata('message', '<div align="center" class="alert alert-success" role="alert">
                                            Role berhasil dihapus!
                                            </div>');
            redirect('admin/role');
        }



        public function roleakses($role_id)
        {
            $data['judul'] = 'Role akses';
            $data['namauser'] = 'Admin SPK';

            $data['user'] = $this->admin->getEmail();
            $data['role'] = $this->db->get_where('role', ['id' => $role_id])->row_array();

            $this->db->where('id !=', 1);
            $data['menu'] = $this->admin->getMenu_user();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/roleakses', $data);
            $this->load->view('templates/footer');
        }


        public function ubah_akses()
        {
            $id_menu = $this->input->post('menuId');
            $role_id = $this->input->post('roleId');

            $data = [
                'role_id' => $role_id,
                'id_menu' => $id_menu
            ];
            $result = $this->db->get_where('akses_menu_user', $data);

            if ($result->num_rows() < 1) {
                $this->db->insert('akses_menu_user', $data);
            } else {
                $this->db->delete('akses_menu_user', $data);
            }
            $this->session->set_flashdata('message', '<div align="center" class="alert alert-success" role="alert">
                                            Akses berhasil diubah!
                                            </div>');
        }


        // MENU MANAJEMEN

        public function menu()
        {
            $data['judul'] = 'Menu Manajemen';
            $data['namauser'] = 'Admin SPK';

            $data['user'] = $this->menu->getEmail();
            $data['menu'] = $this->menu->getMenu();

            $this->form_validation->set_rules('menu', 'Menu', 'required');

            if ($this->form_validation->run() == false) {
                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('templates/topbar', $data);
                $this->load->view('admin/role', $data);
                $this->load->view('templates/footer');
            } else {

                $this->menu->tambahMenu();

                $this->session->set_flashdata('message', '<div align="center" class="alert alert-success" role="alert">
                                            Menu baru berhasil ditambahkan
                                            </div>');
                redirect('admin/role');
            }
        }

        public function editMenu()
        {
            $this->menu->editMenu();
            $this->session->set_flashdata('message', '<div align="center" class="alert alert-success" role="alert">
                                            Menu berhasil diubah!
                                            </div>');
            redirect('admin/role');
        }

        public function hapusMenu($id)
        {
            $this->menu->hapusMenu($id);
            $this->session->set_flashdata('message', '<div align="center" class="alert alert-success" role="alert">
                                            Menu berhasil dihapus!
                                            </div>');
            redirect('admin/role');
        }

        public function submenu()
        {
            $data['judul'] = 'Submenu Manajemen';
            $data['namauser'] = 'Admin SPK';

            $data['user'] = $this->menu->getEmail();
            $data['menu'] = $this->menu->getMenu();

            $data['submenu'] = $this->menu->getSubmenu();

            $data['submenu'] = $this->menu->getJoin();

            $this->form_validation->set_rules('title', 'Title', 'required');
            $this->form_validation->set_rules('menu_id', 'Menu', 'required');
            $this->form_validation->set_rules('url', 'URL', 'required');
            $this->form_validation->set_rules('icon', 'icon', 'required');

            if ($this->form_validation->run() == false) {
                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('templates/topbar', $data);
                $this->load->view('admin/role', $data);
                $this->load->view('templates/footer');
                $this->load->view('admin/modal/modal_tambah_submenu');
                $this->load->view('admin/modal/modal_edit_submenu');
            } else {
                $this->menu->tambahSubmenu();
                $this->session->set_flashdata('message', '<div <div align="center" class="alert alert-success" role="alert">
                                            Submenu baru berhasil ditambahkan
                                            </div>');
                redirect('admin/role');
            }
        }

        public function editSubmenu()
        {
            $this->menu->editSubmenu();
            $this->session->set_flashdata('message', '<div align="center" class="alert alert-success" role="alert">
                                            Submenu berhasil diubah!
                                            </div>');
            redirect('admin/role');
        }

        public function hapusSubmenu($id)
        {
            $this->menu->hapusSubmenu($id);
            $this->session->set_flashdata('message', '<div align="center" class="alert alert-success" role="alert">
                                            Submenu berhasil dihapus!
                                            </div>');
            redirect('admin/role');
        }
    }
