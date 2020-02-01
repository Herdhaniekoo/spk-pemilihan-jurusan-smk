 <?php
    defined('BASEPATH') or exit('No direct script access allowed');

    class PSaw extends CI_Controller

    {
        public function __construct()
        {
            parent::__construct();
            $this->load->library('form_validation');
            $this->load->model('PSaw_model', 'ps');
            $this->load->model('Hitung_model', 'hitung');
        }

        public function dataSiswa()
        {
            $data['judul'] = 'Data Siswa';
            $data['namauser'] = 'Admin SPK';
            $data['user'] = $this->ps->getEmail();
            $data['datasiswa'] = $this->ps->getSiswa();
            $data['kode'] = $this->ps->cekKodeSiswa();
            $this->form_validation->set_rules('no_daftar', 'No daftar', 'required');
            $this->form_validation->set_rules('nama_siswa', 'Nama siswa', 'required');
            $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
            $this->form_validation->set_rules('asal_sekolah', 'Asal sekolah', 'required');
            $this->form_validation->set_rules('alamat', 'Alamat', 'required');
            if ($this->form_validation->run() == false) {
                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('templates/topbar', $data);
                $this->load->view('pSaw/dataSiswa', $data);
                $this->load->view('templates/footer');
                $this->load->view('pSaw/modal/modal_tambah_siswa');
                $this->load->view('pSaw/modal/modal_edit_siswa');
            } else {
                $this->ps->tambahSiswa();
                $this->session->set_flashdata('message', '<div <div align="center" class="alert alert-success" role="alert">
                                            Siswa baru berhasil ditambahkan
                                            </div>');
                redirect('pSaw/dataSiswa');
            }
        }

        public function editSiswa()
        {
            $this->ps->editSiswa();
            $this->session->set_flashdata('message', '<div align="center" class="alert alert-success" role="alert">
                                            Data siswa berhasil diubah!
                                            </div>');
            redirect('pSaw/dataSiswa');
        }
        public function hapusSiswa($id)
        {
            $this->ps->hapusSiswa($id);
            $this->session->set_flashdata('message', '<div align="center" class="alert alert-success" role="alert">
                                            Data siswa berhasil dihapus!
                                            </div>');
            redirect('pSaw/dataSiswa');
        }

        public function nilaiSiswa()
        {

            $data['judul'] = 'Data Nilai Siswa';
            $data['namauser'] = 'Admin SPK';

            $data['user'] = $this->ps->getEmail();
            $data['datasiswa'] = $this->ps->getSiswa();
            $data['kriteria'] = $this->ps->getKriteria();
            $data['nilai_siswa'] = $this->ps->getJoinNilaiSiswa();


            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('pSaw/nilaiSiswa', $data);
            $this->load->view('templates/footer');
            $this->load->view('pSaw/modal/modal_tambah_nilai');
            $this->load->view('pSaw/modal/modal_normalisasi');
        }
        public function tambahNilai()
        {
            $this->ps->inputNilai();
            $this->session->set_flashdata('message', '<div align="center" class="alert alert-success" role="alert">
                                            Nilai siswa berhasil ditambah!
                                            </div>');
            redirect('pSaw/nilaiSiswa');
        }

        public function hasilSAW()
        {

            $data['judul'] = 'Perhitungan SAW';
            $data['namauser'] = 'Admin SPK';
            $data['user'] = $this->ps->getEmail();
            $data['nilaijurusansiswa'] = $this->ps->getJoinNilaiJurusanSiswa();
            $data['nilai_jurusan'] = $this->ps->getNilaiJurusan();
            $data['hasil_seleksi'] = $this->hitung->HasilSeleksi();
            //panggil nilai max
            $data['maxC1'] = $this->hitung->maxC1();
            $data['maxC2'] = $this->hitung->maxC2();
            $data['maxC3'] = $this->hitung->maxC3();
            $data['maxC4'] = $this->hitung->maxC4();
            $data['maxC5'] = $this->hitung->maxC5();
            $data['maxC6'] = $this->hitung->maxC6();
            $data['maxC7'] = $this->hitung->maxC7();
            $data['maxC8'] = $this->hitung->maxC8();
            //panggil bobot kriteria
            $data['bobotC1'] = $this->hitung->bobotC1();
            $data['bobotC2'] = $this->hitung->bobotC2();
            $data['bobotC3'] = $this->hitung->bobotC3();
            $data['bobotC4'] = $this->hitung->bobotC4();
            $data['bobotC5'] = $this->hitung->bobotC5();
            $data['bobotC6'] = $this->hitung->bobotC6();
            $data['bobotC7'] = $this->hitung->bobotC7();
            $data['bobotC8'] = $this->hitung->bobotC8();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('pSaw/hasilSAW', $data);
            $this->load->view('templates/footer');
            $this->load->view('pSaw/modal/modal_selesai');
        }

        public function insertKonversi()
        {
            $this->ps->inputKonversi();
            redirect('pSaw/hasilSAW');
        }
        public function selesai()
        {
            $this->hitung->selesai();
            redirect('pSaw/Laporan');
        }
        public function Laporan()
        {
            $data['judul'] = 'Rekomendasi Jurusan Siswa';
            $data['namauser'] = 'Admin SPK';

            $data['user'] = $this->ps->getEmail();
            $data['laporan'] = $this->hitung->getLaporan();
            $data['hasil_akhir'] = $this->hitung->HasilAkhir();
            $data['cetak'] = $this->hitung->CetakMax();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('pSaw/Laporan', $data);
            $this->load->view('templates/footer');
            $this->load->view('pSaw/modal/modal_laporkan');
        }

        public function cetak()
        {
            $this->hitung->cetak();
            $this->session->set_flashdata('message', '<div align="center" class="alert alert-success" role="alert">
                                            Selesai dihitung
                                            </div>');
            redirect('pSaw/dataSiswa');
        }
    }
