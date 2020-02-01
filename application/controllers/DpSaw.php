 <?php
    defined('BASEPATH') or exit('No direct script access allowed');

    class DpSaw extends CI_Controller

    {
        public function __construct()
        {
            parent::__construct();
            $this->load->library('form_validation');
            $this->load->model('DpSaw_model', 'dps');
        }

        public function jurusan()
        {
            $data['judul'] = 'Data Jurusan';
            $data['namauser'] = 'Admin SPK';

            $data['user'] = $this->dps->getEmail();
            $data['jurusan'] = $this->dps->getJurusan();

            $this->form_validation->set_rules('nama_jurusan', 'Nama Jurusan', 'required');

            if ($this->form_validation->run() == false) {
                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('templates/topbar', $data);
                $this->load->view('dpSaw/jurusan', $data);
                $this->load->view('templates/footer');
                $this->load->view('templates/footer');
                $this->load->view('dpSaw/modal/modal_input_nilai_jurusan');
            } else {
                $this->dps->tambahJurusan();
                $this->session->set_flashdata('message', '<div align="center" class="alert alert-success" role="alert">
                                            Jurusan baru berhasil ditambahkan
                                            </div>');
                redirect('dpSaw/jurusan');
            }
        }

        public function editJurusan()
        {
            $this->dps->editJurusan();
            $this->session->set_flashdata('message', '<div align="center" class="alert alert-success" role="alert">
                                            Jurusan berhasil diubah!
                                            </div>');
            redirect('dpSaw/jurusan');
        }

        public function hapusJurusan($id)
        {
            $this->dps->hapusJurusan($id);
            $this->session->set_flashdata('message', '<div align="center" class="alert alert-success" role="alert">
                                            Jurusan berhasil dihapus!
                                            </div>');
            redirect('dpSaw/jurusan');
        }

        public function nilaijurusan()
        {
            $this->dps->inputNilaiJurusan();
            $this->session->set_flashdata('message', '<div align="center" class="alert alert-success" role="alert">
                                            Nilai jurusan berhasil ditambah!
                                            </div>');
            redirect('dpSaw/jurusan');
        }


        public function kriteria()
        {
            $data['judul'] = 'Data Kriteria';
            $data['namauser'] = 'Admin SPK';

            $data['user'] = $this->dps->getEmail();
            $data['kriteria'] = $this->dps->getKriteria();
            $data['kode'] = $this->dps->cekKodeKriteria();

            $this->form_validation->set_rules('nama_kriteria', 'Nama kriteria', 'required');
            $this->form_validation->set_rules('atribut_kriteria', 'Atribut kriteria', 'required');
            $this->form_validation->set_rules('bobot_kriteria', 'Bobot kriteria', 'required');

            if ($this->form_validation->run() == false) {
                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('templates/topbar', $data);
                $this->load->view('dpSaw/kriteria', $data);
                $this->load->view('templates/footer');
            } else {
                $this->dps->tambahKriteria();
                $this->session->set_flashdata('message', '<div align="center" class="alert alert-success" role="alert">
                                            Kriteria baru berhasil ditambahkan
                                            </div>');
                redirect('dpSaw/kriteria');
            }
        }

        public function editKriteria()
        {
            $this->dps->editKriteria();
            $this->session->set_flashdata('message', '<div align="center" class="alert alert-success" role="alert">
                                            Kriteria berhasil diubah!
                                            </div>');
            redirect('dpSaw/kriteria');
        }

        public function hapusKriteria($id)
        {
            $this->dps->hapusKriteria($id);
            $this->session->set_flashdata('message', '<div align="center" class="alert alert-success" role="alert">
                                            Kriteria berhasil dihapus!
                                            </div>');
            redirect('dpSaw/kriteria');
        }
    }
