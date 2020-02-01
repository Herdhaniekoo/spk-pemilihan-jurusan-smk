<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PSaw_model extends CI_Model
{
    public function getEmail()
    {
        return $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    }

    public function getSiswa()
    {
        return $this->db->get('data_siswa')->result_array();
    }

    public function getKriteria()
    {
        return $this->db->get('kriteria')->result_array();
    }

    public function getNilaisiswa()
    {
        return $this->db->get('nilai_siswa')->result_array();
    }

    public function getNilai()
    {
        return $this->db->get('nilai')->result_array();
    }

    public function getNilaiJurusan()
    {
        return $this->db->get('nilai_jurusan')->result_array();
    }
    

    //fungsi yang digunakan untuk mengambil id jurusan dari tabel jurusan, yang nantinya id jurusan digunakan untuk mengkonversi nilai - nilai yang dimasukkan.
    public function jurus()
    {
        $this->db->select('id_jurusan');
        $this->db->from('jurusan');
        $query = $this->db->get();
        if ($query->num_rows()) {
            $jurusam = $query->result_array();
            foreach ($jurusam as $row => $author) {
                $this->db->insert("konversi_nilai", $author);
            }
        }
    }

    //fungsi yang digunakan untuk mengambil id siswa yang terkahir yang di inputkan, yang digunakan untuk mengkonversi nilai yang ada juga.
    public function ID()
    {
        $query = "SELECT `id_siswa` FROM `data_siswa` ORDER BY `id_siswa` DESC LIMIT 1";
        return $this->db->query($query)->result();
    }

    //fungsi tambah siswa baru
    public function tambahSiswa()
    {
        $kode = $this->cekKodeSiswa();
        $data = [
            'no_daftar' => $kode,
            'nama_siswa' => $this->input->post('nama_siswa', true),
            'jenis_kelamin' => $this->input->post('jenis_kelamin', true),
            'asal_sekolah' => $this->input->post('asal_sekolah', true),
            'alamat' => $this->input->post('alamat', true)
        ];
        $this->db->insert('data_siswa', $data);
        $this->jurus();
        //insert_id digunakan untuk mengambil id yang dimasukkan, tapi hanya id nya saja.
        $id_siswa = $this->db->insert_id();
        $data2 = [
            'id_siswa' => $id_siswa
        ];
        $this->db->insert('konversi_nilai', $data2);
        $query = $this->ID();
        //foreach yang digunakan untuk mengulangi id yang dimasukan sebanyak row yang ada.
        foreach ($query as $row) {
            $id = $row->id_siswa;
        }
        $dataN = [
            'id_siswa' => $id
        ];
        $this->db->insert('nilai', $dataN);
        $this->db->set('id_siswa', $id);
        $this->db->where('id_siswa', 0);
        $this->db->update('konversi_nilai');
        //untuk menghapus id jurusan yang saat dimasukkan 0, karena di sistem ini tidak ada id jurusan 0.
        $this->db->where('id_jurusan',  0);
        $this->db->delete('konversi_nilai');
    }

    public function hapusSiswa($id)
    {
        $this->db->where('id_siswa', $id);
        $this->db->delete('data_siswa');
    }

    public function editSiswa()
    {
        $no_daftar = $this->input->post('no_daftar');
        $nama_siswa = $this->input->post('nama_siswa');
        $jenis_kelamin = $this->input->post('jenis_kelamin');
        $asal_sekolah = $this->input->post('asal_sekolah');
        $alamat = $this->input->post('alamat');

        $data = [
            'no_daftar' => $no_daftar,
            'nama_siswa' => $nama_siswa,
            'jenis_kelamin' => $jenis_kelamin,
            'asal_sekolah' => $asal_sekolah,
            'alamat' => $alamat
        ];

        $this->db->where('id_siswa', $this->input->post('id_siswa'));
        $this->db->update('data_siswa', $data);
    }

    public function getJoinNilaiSiswa()
    {
        $queryNilaisiswa = "SELECT `data_siswa`.`id_siswa` ,`data_siswa`.`nama_siswa`, `data_siswa`.`no_daftar`, `nilai`.* 
        FROM `nilai` JOIN `data_siswa` ON `nilai`.`id_siswa` = `data_siswa`.`id_siswa` 
        WHERE `nilai`.`id_siswa` = `data_siswa`.`id_siswa`
        ";
        return $this->db->query($queryNilaisiswa)->result_array();
    }

    //fungsi yang digunakan untuk memasukkan nilai-nilai setiap siswa.
    public function inputNilai()
    {
        $c1 = $this->input->post('c1');
        $c2 = $this->input->post('c2');
        $c3 = $this->input->post('c3');
        $c4 = $this->input->post('c4');
        $c5 = $this->input->post('c5');
        $c6 = $this->input->post('c6');
        $c7 = $this->input->post('c7');
        $c8 = $this->input->post('c8');

        $data = [
            'C1' => $c1,
            'C2' => $c2,
            'C3' => $c3,
            'C4' => $c4,
            'C5' => $c5,
            'C6' => $c6,
            'C7' => $c7,
            'C8' => $c8
        ];

        $this->db->where('id_siswa', $this->input->post('id_siswa'));
        $this->db->update('nilai', $data);
        $this->db->set($data);
        $this->db->where('id_siswa', $this->input->post('id_siswa'));
        //ke tabel konversi nilai
        $this->db->update('konversi_nilai');

        $data2 = [
            'id_siswa' => $this->input->post('id_siswa'),
            'C1' => $c1,
            'C2' => $c2,
            'C3' => $c3,
            'C4' => $c4,
            'C5' => $c5,
            'C6' => $c6,
            'C7' => $c7,
            'C8' => $c8
        ];
        $this->db->set($data2);
        //dan ke tabel nilai jurusan
        $this->db->insert('nilai_jurusan');
    }


    //fungsi yang digunakan untuk mengkonversi dari nilai siswa menjadi nilai - nilai di matriks kecocokan
    public function inputKonversi()
    {

        //TEKNIK PERMESINAN
        $c1mesin = $this->C1mesin();
        $c2mesin = $this->C2mesin();
        $c3mesin = $this->C3mesin();
        $c4mesin = $this->C4mesin();
        $c5mesin = $this->C5mesin();
        $c6mesin = $this->C6mesin();
        $c7mesin = $this->C7mesin();
        $c8mesin = $this->C8mesin();

        //NILAI MTK
        if ($c1mesin <= 30) {
            $c1mesin = 1;
        } elseif ($c1mesin > 30 && $c1mesin <= 40) {
            $c1mesin = 2;
        } elseif ($c1mesin > 40 && $c1mesin <= 60) {
            $c1mesin = 3;
        } elseif ($c1mesin > 60 && $c1mesin <= 80) {
            $c1mesin = 4;
        } elseif ($c1mesin > 80 && $c1mesin <= 100) {
            $c1mesin = 5;
        }
        //NILAI IPA
        if ($c2mesin <= 30) {
            $c2mesin = 1;
        } elseif ($c2mesin > 30 && $c2mesin <= 40) {
            $c2mesin = 2;
        } elseif ($c2mesin > 40 && $c2mesin <= 60) {
            $c2mesin = 3;
        } elseif ($c2mesin > 60 && $c2mesin <= 80) {
            $c2mesin = 4;
        } elseif ($c2mesin > 80 && $c2mesin <= 100) {
            $c2mesin = 5;
        }
        //NILAI BAHASA INDONESIA
        if ($c3mesin <= 35) {
            $c3mesin = 1;
        } elseif ($c3mesin > 35 && $c3mesin <= 45) {
            $c3mesin = 2;
        } elseif ($c3mesin > 45 && $c3mesin <= 65) {
            $c3mesin = 3;
        } elseif ($c3mesin > 65 && $c3mesin <= 85) {
            $c3mesin = 4;
        } elseif ($c3mesin > 85 && $c3mesin <= 100) {
            $c3mesin = 5;
        }
        //NILAI BAHASA INGGRIS
        if ($c4mesin <= 35) {
            $c4mesin = 1;
        } elseif ($c4mesin > 35 && $c4mesin <= 45) {
            $c4mesin = 2;
        } elseif ($c4mesin > 45 && $c4mesin <= 65) {
            $c4mesin = 3;
        } elseif ($c4mesin > 65 && $c4mesin <= 85) {
            $c4mesin = 4;
        } elseif ($c4mesin > 85 && $c4mesin <= 100) {
            $c4mesin = 5;
        }
        //NILAI TES FISIK
        if ($c5mesin <= 35) {
            $c5mesin = 1;
        } elseif ($c5mesin > 35 && $c5mesin <= 45) {
            $c5mesin = 2;
        } elseif ($c5mesin > 45 && $c5mesin <= 65) {
            $c5mesin = 3;
        } elseif ($c5mesin > 65 && $c5mesin <= 85) {
            $c5mesin = 4;
        } elseif ($c5mesin > 85 && $c5mesin <= 100) {
            $c5mesin = 5;
        }
        //NILAI TES PSIKOLOGI
        if ($c6mesin <= 35) {
            $c6mesin = 1;
        } elseif ($c6mesin > 35 && $c6mesin <= 45) {
            $c6mesin = 2;
        } elseif ($c6mesin > 45 && $c6mesin <= 65) {
            $c6mesin = 3;
        } elseif ($c6mesin > 65 && $c6mesin <= 85) {
            $c6mesin = 4;
        } elseif ($c6mesin > 85 && $c6mesin <= 100) {
            $c6mesin = 5;
        }
        //NILAI TES WAWANCARA
        if ($c7mesin <= 35) {
            $c7mesin = 1;
        } elseif ($c7mesin > 35 && $c7mesin <= 45) {
            $c7mesin = 2;
        } elseif ($c7mesin > 45 && $c7mesin <= 65) {
            $c7mesin = 3;
        } elseif ($c7mesin > 65 && $c7mesin <= 85) {
            $c7mesin = 4;
        } elseif ($c7mesin > 85 && $c7mesin <= 100) {
            $c7mesin = 5;
        }
        //NILAI TES TULIS
        if ($c8mesin <= 35) {
            $c8mesin = 1;
        } elseif ($c8mesin > 35 && $c8mesin <= 55) {
            $c8mesin = 2;
        } elseif ($c8mesin > 55 && $c8mesin <= 75) {
            $c8mesin = 3;
        } elseif ($c8mesin > 75 && $c8mesin <= 85) {
            $c8mesin = 4;
        } elseif ($c8mesin > 85 && $c8mesin <= 100) {
            $c8mesin = 5;
        }

        //TEKNIK PENGELASAN
        $c1las = $this->C1las();
        $c2las = $this->C2las();
        $c3las = $this->C3las();
        $c4las = $this->C4las();
        $c5las = $this->C5las();
        $c6las = $this->C6las();
        $c7las = $this->C7las();
        $c8las = $this->C8las();

        //NILAI MTK
        if ($c1las <= 40) {
            $c1las = 1;
        } elseif ($c1las > 40 && $c1las <= 69) {
            $c1las = 2;
        } elseif ($c1las > 69 && $c1las <= 88) {
            $c1las = 3;
        } elseif ($c1las > 88 && $c1las <= 94) {
            $c1las = 4;
        } elseif ($c1las > 94 && $c1las <= 100) {
            $c1las = 5;
        }
        //NILAI IPA
        if ($c2las <= 37) {
            $c2las = 1;
        } elseif ($c2las > 37 && $c2las <= 64) {
            $c2las = 2;
        } elseif ($c2las > 64 && $c2las <= 76) {
            $c2las = 3;
        } elseif ($c2las > 76 && $c2las <= 84) {
            $c2las = 4;
        } elseif ($c2las > 84 && $c2las <= 100) {
            $c2las = 5;
        }
        //NILAI BAHASA INDONESIA
        if ($c3las <= 43) {
            $c3las = 1;
        } elseif ($c3las > 43 && $c3las <= 65) {
            $c3las = 2;
        } elseif ($c3las > 65 && $c3las <= 78) {
            $c3las = 3;
        } elseif ($c3las > 78 && $c3las <= 87) {
            $c3las = 4;
        } elseif ($c3las > 87 && $c3las <= 100) {
            $c3las = 5;
        }
        //NILAI BAHASA INGGRIS
        if ($c4las <= 25) {
            $c4las = 1;
        } elseif ($c4las > 25 && $c4las <= 56) {
            $c4las = 2;
        } elseif ($c4las > 56 && $c4las <= 77) {
            $c4las = 3;
        } elseif ($c4las > 77 && $c4las <= 86) {
            $c4las = 4;
        } elseif ($c4las > 86 && $c4las <= 100) {
            $c4las = 5;
        }
        //NILAI TES FISIK
        if ($c5las <= 40) {
            $c5las = 1;
        } elseif ($c5las > 40 && $c5las <= 67) {
            $c5las = 2;
        } elseif ($c5las > 67 && $c5las <= 77) {
            $c5las = 3;
        } elseif ($c5las > 77 && $c5las <= 84) {
            $c5las = 4;
        } elseif ($c5las > 84 && $c5las <= 100) {
            $c5las = 5;
        }
        //NILAI TES PSIKOLOGI
        if ($c6las <= 30) {
            $c6las = 1;
        } elseif ($c6las > 30 && $c6las <= 48) {
            $c6las = 2;
        } elseif ($c6las > 48 && $c6las <= 66) {
            $c6las = 3;
        } elseif ($c6las > 66 && $c6las <= 79) {
            $c6las = 4;
        } elseif ($c6las > 79 && $c6las <= 100) {
            $c6las = 5;
        }
        //NILAI TES WAWANCARA
        if ($c7las <= 30) {
            $c7las = 1;
        } elseif ($c7las > 30 && $c7las <= 49) {
            $c7las = 2;
        } elseif ($c7las > 49 && $c7las <= 60) {
            $c7las = 3;
        } elseif ($c7las > 60 && $c7las <= 87) {
            $c7las = 4;
        } elseif ($c7las > 87 && $c7las <= 100) {
            $c7las = 5;
        }
        //NILAI TES TULIS
        if ($c8las <= 33) {
            $c8las = 1;
        } elseif ($c8las > 33 && $c8las <= 45) {
            $c8las = 2;
        } elseif ($c8las > 45 && $c8las <= 68) {
            $c8las = 3;
        } elseif ($c8las > 68 && $c8las <= 87) {
            $c8las = 4;
        } elseif ($c8las > 87 && $c8las <= 100) {
            $c8las = 5;
        }

        //TEKNIK KENDARAAN RINGAN
        $c1tkr = $this->C1tkr();
        $c2tkr = $this->C2tkr();
        $c3tkr = $this->C3tkr();
        $c4tkr = $this->C4tkr();
        $c5tkr = $this->C5tkr();
        $c6tkr = $this->C6tkr();
        $c7tkr = $this->C7tkr();
        $c8tkr = $this->C8tkr();

        //NILAI MTK
        if ($c1tkr <= 25) {
            $c1tkr = 1;
        } elseif ($c1tkr > 25 && $c1tkr <= 45) {
            $c1tkr = 2;
        } elseif ($c1tkr > 45 && $c1tkr <= 65) {
            $c1tkr = 3;
        } elseif ($c1tkr > 65 && $c1tkr <= 85) {
            $c1tkr = 4;
        } elseif ($c1tkr > 85 && $c1tkr <= 100) {
            $c1tkr = 5;
        }
        //NILAI IPA
        if ($c2tkr <= 20) {
            $c2tkr = 1;
        } elseif ($c2tkr > 20 && $c2tkr <= 58) {
            $c2tkr = 2;
        } elseif ($c2tkr > 58 && $c2tkr <= 70) {
            $c2tkr = 3;
        } elseif ($c2tkr > 70 && $c2tkr <= 88) {
            $c2tkr = 4;
        } elseif ($c2tkr > 88 && $c2tkr <= 100) {
            $c2tkr = 5;
        }
        //NILAI BAHASA INDONESIA
        if ($c3tkr <= 30) {
            $c3tkr = 1;
        } elseif ($c3tkr > 30 && $c3tkr <= 50) {
            $c3tkr = 2;
        } elseif ($c3tkr > 50 && $c3tkr <= 70) {
            $c3tkr = 3;
        } elseif ($c3tkr > 70 && $c3tkr <= 80) {
            $c3tkr = 4;
        } elseif ($c3tkr > 80 && $c3tkr <= 100) {
            $c3tkr = 5;
        }
        //NILAI BAHASA INGGRIS
        if ($c4tkr <= 25) {
            $c4tkr = 1;
        } elseif ($c4tkr > 25 && $c4tkr <= 55) {
            $c4tkr = 2;
        } elseif ($c4tkr > 55 && $c4tkr <= 75) {
            $c4tkr = 3;
        } elseif ($c4tkr > 75 && $c4tkr <= 90) {
            $c4tkr = 4;
        } elseif ($c4tkr > 90 && $c4tkr <= 100) {
            $c4tkr = 5;
        }
        //NILAI TES FISIK
        if ($c5tkr <= 35) {
            $c5tkr = 1;
        } elseif ($c5tkr > 35 && $c5tkr <= 65) {
            $c5tkr = 2;
        } elseif ($c5tkr > 65 && $c5tkr <= 80) {
            $c5tkr = 3;
        } elseif ($c5tkr > 80 && $c5tkr <= 90) {
            $c5tkr = 4;
        } elseif ($c5tkr > 90 && $c5tkr <= 100) {
            $c5tkr = 5;
        }
        //NILAI TES PSIKOLOGI
        if ($c6tkr <= 45) {
            $c6tkr = 1;
        } elseif ($c6tkr > 45 && $c6tkr <= 65) {
            $c6tkr = 2;
        } elseif ($c6tkr > 65 && $c6tkr <= 70) {
            $c6tkr = 3;
        } elseif ($c6tkr > 70 && $c6tkr <= 80) {
            $c6tkr = 4;
        } elseif ($c6tkr > 80 && $c6tkr <= 100) {
            $c6tkr = 5;
        }
        //NILAI TES WAWANCARA
        if ($c7tkr <= 47) {
            $c7tkr = 1;
        } elseif ($c7tkr > 47 && $c7tkr <= 60) {
            $c7tkr = 2;
        } elseif ($c7tkr > 60 && $c7tkr <= 77) {
            $c7tkr = 3;
        } elseif ($c7tkr > 77 && $c7tkr <= 87) {
            $c7tkr = 4;
        } elseif ($c7tkr > 87 && $c7tkr <= 100) {
            $c7tkr = 5;
        }
        //NILAI TES TULIS
        if ($c8tkr <= 30) {
            $c8tkr = 1;
        } elseif ($c8tkr > 30 && $c8tkr <= 60) {
            $c8tkr = 2;
        } elseif ($c8tkr > 60 && $c8tkr <= 72) {
            $c8tkr = 3;
        } elseif ($c8tkr > 72 && $c8tkr <= 82) {
            $c8tkr = 4;
        } elseif ($c8tkr > 82 && $c8tkr <= 100) {
            $c8tkr = 5;
        }

        //TEKNIK PERBAIKAN BODI KENDARAAN
        $c1pbk = $this->C1pbk();
        $c2pbk = $this->C2pbk();
        $c3pbk = $this->C3pbk();
        $c4pbk = $this->C4pbk();
        $c5pbk = $this->C5pbk();
        $c6pbk = $this->C6pbk();
        $c7pbk = $this->C7pbk();
        $c8pbk = $this->C8pbk();

        //NILAI MTK
        if ($c1pbk <= 40) {
            $c1pbk = 1;
        } elseif ($c1pbk > 40 && $c1pbk <= 70) {
            $c1pbk = 2;
        } elseif ($c1pbk > 70 && $c1pbk <= 84) {
            $c1pbk = 3;
        } elseif ($c1pbk > 84 && $c1pbk <= 90) {
            $c1pbk = 4;
        } elseif ($c1pbk > 90 && $c1pbk <= 100) {
            $c1pbk = 5;
        }
        //NILAI IPA
        if ($c2pbk <= 33) {
            $c2pbk = 1;
        } elseif ($c2pbk > 33 && $c2pbk <= 53) {
            $c2pbk = 2;
        } elseif ($c2pbk > 53 && $c2pbk <= 63) {
            $c2pbk = 3;
        } elseif ($c2pbk > 63 && $c2pbk <= 83) {
            $c2pbk = 4;
        } elseif ($c2pbk > 83 && $c2pbk <= 100) {
            $c2pbk = 5;
        }
        //NILAI BAHASA INDONESIA
        if ($c3pbk <= 30) {
            $c3pbk = 1;
        } elseif ($c3pbk > 30 && $c3pbk <= 50) {
            $c3pbk = 2;
        } elseif ($c3pbk > 50 && $c3pbk <= 60) {
            $c3pbk = 3;
        } elseif ($c3pbk > 60 && $c3pbk <= 80) {
            $c3pbk = 4;
        } elseif ($c3pbk > 80 && $c3pbk <= 100) {
            $c3pbk = 5;
        }
        //NILAI BAHASA INGGRIS
        if ($c4pbk <= 45) {
            $c4pbk = 1;
        } elseif ($c4pbk > 45 && $c4pbk <= 65) {
            $c4pbk = 2;
        } elseif ($c4pbk > 65 && $c4pbk <= 75) {
            $c4pbk = 3;
        } elseif ($c4pbk > 75 && $c4pbk <= 85) {
            $c4pbk = 4;
        } elseif ($c4pbk > 85 && $c4pbk <= 100) {
            $c4pbk = 5;
        }
        //NILAI TES FISIK
        if ($c5pbk <= 42) {
            $c5pbk = 1;
        } elseif ($c5pbk > 42 && $c5pbk <= 62) {
            $c5pbk = 2;
        } elseif ($c5pbk > 62 && $c5pbk <= 72) {
            $c5pbk = 3;
        } elseif ($c5pbk > 72 && $c5pbk <= 82) {
            $c5pbk = 4;
        } elseif ($c5pbk > 82 && $c5pbk <= 100) {
            $c5pbk = 5;
        }
        //NILAI TES PSIKOLOGI
        if ($c6pbk <= 45) {
            $c6pbk = 1;
        } elseif ($c6pbk > 45 && $c6pbk <= 55) {
            $c6pbk = 2;
        } elseif ($c6pbk > 55 && $c6pbk <= 65) {
            $c6pbk = 3;
        } elseif ($c6pbk > 65 && $c6pbk <= 75) {
            $c6pbk = 4;
        } elseif ($c6pbk > 75 && $c6pbk <= 100) {
            $c6pbk = 5;
        }
        //NILAI TES WAWANCARA
        if ($c7pbk <= 46) {
            $c7pbk = 1;
        } elseif ($c7pbk > 46 && $c7pbk <= 66) {
            $c7pbk = 2;
        } elseif ($c7pbk > 66 && $c7pbk <= 76) {
            $c7pbk = 3;
        } elseif ($c7pbk > 76 && $c7pbk <= 86) {
            $c7pbk = 4;
        } elseif ($c7pbk > 86 && $c7pbk <= 100) {
            $c7pbk = 5;
        }
        //NILAI TES TULIS
        if ($c8pbk <= 40) {
            $c8pbk = 1;
        } elseif ($c8pbk > 40 && $c8pbk <= 60) {
            $c8pbk = 2;
        } elseif ($c8pbk > 60 && $c8pbk <= 70) {
            $c8pbk = 3;
        } elseif ($c8pbk > 70 && $c8pbk <= 80) {
            $c8pbk = 4;
        } elseif ($c8pbk > 80 && $c8pbk <= 100) {
            $c8pbk = 5;
        }

        //TEKNIK MEKATRONIKA
        $c1meka = $this->C1meka();
        $c2meka = $this->C2meka();
        $c3meka = $this->C3meka();
        $c4meka = $this->C4meka();
        $c5meka = $this->C5meka();
        $c6meka = $this->C6meka();
        $c7meka = $this->C7meka();
        $c8meka = $this->C8meka();

        //NILAI MTK
        if ($c1meka <= 50) {
            $c1meka = 1;
        } elseif ($c1meka > 50 && $c1meka <= 70) {
            $c1meka = 2;
        } elseif ($c1meka > 70 && $c1meka <= 80) {
            $c1meka = 3;
        } elseif ($c1meka > 80 && $c1meka <= 90) {
            $c1meka = 4;
        } elseif ($c1meka > 90 && $c1meka <= 100) {
            $c1meka = 5;
        }
        //NILAI IPA
        if ($c2meka <= 50) {
            $c2meka = 1;
        } elseif ($c2meka > 50 && $c2meka <= 70) {
            $c2meka = 2;
        } elseif ($c2meka > 70 && $c2meka <= 80) {
            $c2meka = 3;
        } elseif ($c2meka > 80 && $c2meka <= 90) {
            $c2meka = 4;
        } elseif ($c2meka > 90 && $c2meka <= 100) {
            $c2meka = 5;
        }
        //NILAI BAHASA INDONESIA
        if ($c3meka <= 41) {
            $c3meka = 1;
        } elseif ($c3meka > 41 && $c3meka <= 61) {
            $c3meka = 2;
        } elseif ($c3meka > 61 && $c3meka <= 71) {
            $c3meka = 3;
        } elseif ($c3meka > 71 && $c3meka <= 81) {
            $c3meka = 4;
        } elseif ($c3meka > 81 && $c3meka <= 100) {
            $c3meka = 5;
        }
        //NILAI BAHASA INGGRIS
        if ($c4meka <= 45) {
            $c4meka = 1;
        } elseif ($c4meka > 45 && $c4meka <= 65) {
            $c4meka = 2;
        } elseif ($c4meka > 65 && $c4meka <= 75) {
            $c4meka = 3;
        } elseif ($c4meka > 75 && $c4meka <= 85) {
            $c4meka = 4;
        } elseif ($c4meka > 85 && $c4meka <= 100) {
            $c4meka = 5;
        }
        //NILAI TES FISIK
        if ($c5meka <= 33) {
            $c5meka = 1;
        } elseif ($c5meka > 33 && $c5meka <= 43) {
            $c5meka = 2;
        } elseif ($c5meka > 43 && $c5meka <= 53) {
            $c5meka = 3;
        } elseif ($c5meka > 53 && $c5meka <= 73) {
            $c5meka = 4;
        } elseif ($c5meka > 73 && $c5meka <= 100) {
            $c5meka = 5;
        }
        //NILAI TES PSIKOLOGI
        if ($c6meka <= 38) {
            $c6meka = 1;
        } elseif ($c6meka > 38 && $c6meka <= 48) {
            $c6meka = 2;
        } elseif ($c6meka > 48 && $c6meka <= 58) {
            $c6meka = 3;
        } elseif ($c6meka > 58 && $c6meka <= 78) {
            $c6meka = 4;
        } elseif ($c6meka > 78 && $c6meka <= 100) {
            $c6meka = 5;
        }
        //NILAI TES WAWANCARA
        if ($c7meka <= 32) {
            $c7meka = 1;
        } elseif ($c7meka > 32 && $c7meka <= 42) {
            $c7meka = 2;
        } elseif ($c7meka > 42 && $c7meka <= 62) {
            $c7meka = 3;
        } elseif ($c7meka > 62 && $c7meka <= 82) {
            $c7meka = 4;
        } elseif ($c7meka > 82 && $c7meka <= 100) {
            $c7meka = 5;
        }
        //NILAI TES TULIS
        if ($c8meka <= 25) {
            $c8meka = 1;
        } elseif ($c8meka > 25 && $c8meka <= 45) {
            $c8meka = 2;
        } elseif ($c8meka > 45 && $c8meka <= 65) {
            $c8meka = 3;
        } elseif ($c8meka > 65 && $c8meka <= 85) {
            $c8meka = 4;
        } elseif ($c8meka > 85 && $c8meka <= 100) {
            $c8meka = 5;
        }

        //TEKNIK RPL
        $c1rpl = $this->C1rpl();
        $c2rpl = $this->C2rpl();
        $c3rpl = $this->C3rpl();
        $c4rpl = $this->C4rpl();
        $c5rpl = $this->C5rpl();
        $c6rpl = $this->C6rpl();
        $c7rpl = $this->C7rpl();
        $c8rpl = $this->C8rpl();

        //NILAI MTK
        if ($c1rpl <= 50) {
            $c1rpl = 1;
        } elseif ($c1rpl > 50 && $c1rpl <= 70) {
            $c1rpl = 2;
        } elseif ($c1rpl > 70 && $c1rpl <= 80) {
            $c1rpl = 3;
        } elseif ($c1rpl > 80 && $c1rpl <= 90) {
            $c1rpl = 4;
        } elseif ($c1rpl > 90 && $c1rpl <= 100) {
            $c1rpl = 5;
        }
        //NILAI IPA
        if ($c2rpl <= 57) {
            $c2rpl = 1;
        } elseif ($c2rpl > 57 && $c2rpl <= 77) {
            $c2rpl = 2;
        } elseif ($c2rpl > 77 && $c2rpl <= 77) {
            $c2rpl = 3;
        } elseif ($c2rpl > 77 && $c2rpl <= 87) {
            $c2rpl = 4;
        } elseif ($c2rpl > 87 && $c2rpl <= 100) {
            $c2rpl = 5;
        }
        //NILAI BAHASA INDONESIA
        if ($c3rpl <= 43) {
            $c3rpl = 1;
        } elseif ($c3rpl > 43 && $c3rpl <= 63) {
            $c3rpl = 2;
        } elseif ($c3rpl > 63 && $c3rpl <= 73) {
            $c3rpl = 3;
        } elseif ($c3rpl > 73 && $c3rpl <= 83) {
            $c3rpl = 4;
        } elseif ($c3rpl > 83 && $c3rpl <= 100) {
            $c3rpl = 5;
        }
        //NILAI BAHASA INGGRIS
        if ($c4rpl <= 49) {
            $c4rpl = 1;
        } elseif ($c4rpl > 49 && $c4rpl <= 59) {
            $c4rpl = 2;
        } elseif ($c4rpl > 59 && $c4rpl <= 69) {
            $c4rpl = 3;
        } elseif ($c4rpl > 69 && $c4rpl <= 79) {
            $c4rpl = 4;
        } elseif ($c4rpl > 79 && $c4rpl <= 100) {
            $c4rpl = 5;
        }
        //NILAI TES FISIK
        if ($c5rpl <= 10) {
            $c5rpl = 1;
        } elseif ($c5rpl > 10 && $c5rpl <= 30) {
            $c5rpl = 2;
        } elseif ($c5rpl > 30 && $c5rpl <= 50) {
            $c5rpl = 3;
        } elseif ($c5rpl > 50 && $c5rpl <= 70) {
            $c5rpl = 4;
        } elseif ($c5rpl > 70 && $c5rpl <= 100) {
            $c5rpl = 5;
        }
        //NILAI TES PSIKOLOGI
        if ($c6rpl <= 20) {
            $c6rpl = 1;
        } elseif ($c6rpl > 20 && $c6rpl <= 40) {
            $c6rpl = 2;
        } elseif ($c6rpl > 40 && $c6rpl <= 60) {
            $c6rpl = 3;
        } elseif ($c6rpl > 60 && $c6rpl <= 80) {
            $c6rpl = 4;
        } elseif ($c6rpl > 80 && $c6rpl <= 100) {
            $c6rpl = 5;
        }
        //NILAI TES WAWANCARA
        if ($c7rpl <= 24) {
            $c7rpl = 1;
        } elseif ($c7rpl > 24 && $c7rpl <= 44) {
            $c7rpl = 2;
        } elseif ($c7rpl > 44 && $c7rpl <= 64) {
            $c7rpl = 3;
        } elseif ($c7rpl > 64 && $c7rpl <= 84) {
            $c7rpl = 4;
        } elseif ($c7rpl > 84 && $c7rpl <= 100) {
            $c7rpl = 5;
        }
        //NILAI TES TULIS
        if ($c8rpl <= 30) {
            $c8rpl = 1;
        } elseif ($c8rpl > 30 && $c8rpl <= 50) {
            $c8rpl = 2;
        } elseif ($c8rpl > 50 && $c8rpl <= 70) {
            $c8rpl = 3;
        } elseif ($c8rpl > 70 && $c8rpl <= 90) {
            $c8rpl = 4;
        } elseif ($c8rpl > 90 && $c8rpl <= 100) {
            $c8rpl = 5;
        }

        //TEKNIK TKJ
        $c1tkj = $this->C1tkj();
        $c2tkj = $this->C2tkj();
        $c3tkj = $this->C3tkj();
        $c4tkj = $this->C4tkj();
        $c5tkj = $this->C5tkj();
        $c6tkj = $this->C6tkj();
        $c7tkj = $this->C7tkj();
        $c8tkj = $this->C8tkj();

        //NILAI MTK
        if ($c1tkj <= 58) {
            $c1tkj = 1;
        } elseif ($c1tkj > 58 && $c1tkj <= 68) {
            $c1tkj = 2;
        } elseif ($c1tkj > 68 && $c1tkj <= 78) {
            $c1tkj = 3;
        } elseif ($c1tkj > 78 && $c1tkj <= 88) {
            $c1tkj = 4;
        } elseif ($c1tkj > 88 && $c1tkj <= 100) {
            $c1tkj = 5;
        }
        //NILAI IPA
        if ($c2tkj <= 52) {
            $c2tkj = 1;
        } elseif ($c2tkj > 52 && $c2tkj <= 62) {
            $c2tkj = 2;
        } elseif ($c2tkj > 62 && $c2tkj <= 72) {
            $c2tkj = 3;
        } elseif ($c2tkj > 72 && $c2tkj <= 82) {
            $c2tkj = 4;
        } elseif ($c2tkj > 82 && $c2tkj <= 100) {
            $c2tkj = 5;
        }
        //NILAI BAHASA INDONESIA
        if ($c3tkj <= 38) {
            $c3tkj = 1;
        } elseif ($c3tkj > 38 && $c3tkj <= 58) {
            $c3tkj = 2;
        } elseif ($c3tkj > 58 && $c3tkj <= 68) {
            $c3tkj = 3;
        } elseif ($c3tkj > 68 && $c3tkj <= 78) {
            $c3tkj = 4;
        } elseif ($c3tkj > 78 && $c3tkj <= 100) {
            $c3tkj = 5;
        }
        //NILAI BAHASA INGGRIS
        if ($c4tkj <= 49) {
            $c4tkj = 1;
        } elseif ($c4tkj > 49 && $c4tkj <= 69) {
            $c4tkj = 2;
        } elseif ($c4tkj > 69 && $c4tkj <= 79) {
            $c4tkj = 3;
        } elseif ($c4tkj > 79 && $c4tkj <= 89) {
            $c4tkj = 4;
        } elseif ($c4tkj > 89 && $c4tkj <= 100) {
            $c4tkj = 5;
        }
        //NILAI TES FISIK
        if ($c5tkj <= 28) {
            $c5tkj = 1;
        } elseif ($c5tkj > 28 && $c5tkj <= 48) {
            $c5tkj = 2;
        } elseif ($c5tkj > 48 && $c5tkj <= 68) {
            $c5tkj = 3;
        } elseif ($c5tkj > 68 && $c5tkj <= 78) {
            $c5tkj = 4;
        } elseif ($c5tkj > 78 && $c5tkj <= 100) {
            $c5tkj = 5;
        }
        //NILAI TES PSIKOLOGI
        if ($c6tkj <= 20) {
            $c6tkj = 1;
        } elseif ($c6tkj > 20 && $c6tkj <= 40) {
            $c6tkj = 2;
        } elseif ($c6tkj > 40 && $c6tkj <= 60) {
            $c6tkj = 3;
        } elseif ($c6tkj > 60 && $c6tkj <= 80) {
            $c6tkj = 4;
        } elseif ($c6tkj > 80 && $c6tkj <= 100) {
            $c6tkj = 5;
        }
        //NILAI TES WAWANCARA
        if ($c7tkj <= 23) {
            $c7tkj = 1;
        } elseif ($c7tkj > 23 && $c7tkj <= 43) {
            $c7tkj = 2;
        } elseif ($c7tkj > 43 && $c7tkj <= 63) {
            $c7tkj = 3;
        } elseif ($c7tkj > 63 && $c7tkj <= 83) {
            $c7tkj = 4;
        } elseif ($c7tkj > 83 && $c7tkj <= 100) {
            $c7tkj = 5;
        }
        //NILAI TES TULIS
        if ($c8tkj <= 28) {
            $c8tkj = 1;
        } elseif ($c8tkj > 28 && $c8tkj <= 48) {
            $c8tkj = 2;
        } elseif ($c8tkj > 48 && $c8tkj <= 68) {
            $c8tkj = 3;
        } elseif ($c8tkj > 68 && $c8tkj <= 78) {
            $c8tkj = 4;
        } elseif ($c8tkj > 78 && $c8tkj <= 100) {
            $c8tkj = 5;
        }

        //TEKNIK MULTIMEDIA
        $c1mmd = $this->C1mmd();
        $c2mmd = $this->C2mmd();
        $c3mmd = $this->C3mmd();
        $c4mmd = $this->C4mmd();
        $c5mmd = $this->C5mmd();
        $c6mmd = $this->C6mmd();
        $c7mmd = $this->C7mmd();
        $c8mmd = $this->C8mmd();

        //NILAI MTK
        if ($c1mmd <= 20) {
            $c1mmd = 1;
        } elseif ($c1mmd > 20 && $c1mmd <= 40) {
            $c1mmd = 2;
        } elseif ($c1mmd > 40 && $c1mmd <= 60) {
            $c1mmd = 3;
        } elseif ($c1mmd > 60 && $c1mmd <= 80) {
            $c1mmd = 4;
        } elseif ($c1mmd > 80 && $c1mmd <= 100) {
            $c1mmd = 5;
        }
        //NILAI IPA
        if ($c2mmd <= 20) {
            $c2mmd = 1;
        } elseif ($c2mmd > 20 && $c2mmd <= 40) {
            $c2mmd = 2;
        } elseif ($c2mmd > 40 && $c2mmd <= 60) {
            $c2mmd = 3;
        } elseif ($c2mmd > 60 && $c2mmd <= 80) {
            $c2mmd = 4;
        } elseif ($c2mmd > 80 && $c2mmd <= 100) {
            $c2mmd = 5;
        }
        //NILAI BAHASA INDONESIA
        if ($c3mmd <= 25) {
            $c3mmd = 1;
        } elseif ($c3mmd > 25 && $c3mmd <= 45) {
            $c3mmd = 2;
        } elseif ($c3mmd > 45 && $c3mmd <= 65) {
            $c3mmd = 3;
        } elseif ($c3mmd > 65 && $c3mmd <= 85) {
            $c3mmd = 4;
        } elseif ($c3mmd > 85 && $c3mmd <= 100) {
            $c3mmd = 5;
        }
        //NILAI BAHASA INGGRIS
        if ($c4mmd <= 30) {
            $c4mmd = 1;
        } elseif ($c4mmd > 30 && $c4mmd <= 50) {
            $c4mmd = 2;
        } elseif ($c4mmd > 50 && $c4mmd <= 70) {
            $c4mmd = 3;
        } elseif ($c4mmd > 70 && $c4mmd <= 90) {
            $c4mmd = 4;
        } elseif ($c4mmd > 90 && $c4mmd <= 100) {
            $c4mmd = 5;
        }
        //NILAI TES FISIK
        if ($c5mmd <= 25) {
            $c5mmd = 1;
        } elseif ($c5mmd > 25 && $c5mmd <= 45) {
            $c5mmd = 2;
        } elseif ($c5mmd > 45 && $c5mmd <= 65) {
            $c5mmd = 3;
        } elseif ($c5mmd > 65 && $c5mmd <= 75) {
            $c5mmd = 4;
        } elseif ($c5mmd > 75 && $c5mmd <= 100) {
            $c5mmd = 5;
        }
        //NILAI TES PSIKOLOGI
        if ($c6mmd <= 27) {
            $c6mmd = 1;
        } elseif ($c6mmd > 27 && $c6mmd <= 47) {
            $c6mmd = 2;
        } elseif ($c6mmd > 47 && $c6mmd <= 67) {
            $c6mmd = 3;
        } elseif ($c6mmd > 67 && $c6mmd <= 87) {
            $c6mmd = 4;
        } elseif ($c6mmd > 87 && $c6mmd <= 100) {
            $c6mmd = 5;
        }
        //NILAI TES WAWANCARA
        if ($c7mmd <= 21) {
            $c7mmd = 1;
        } elseif ($c7mmd > 21 && $c7mmd <= 41) {
            $c7mmd = 2;
        } elseif ($c7mmd > 41 && $c7mmd <= 61) {
            $c7mmd = 3;
        } elseif ($c7mmd > 61 && $c7mmd <= 81) {
            $c7mmd = 4;
        } elseif ($c7mmd > 81 && $c7mmd <= 100) {
            $c7mmd = 5;
        }
        //NILAI TES TULIS
        if ($c8mmd <= 35) {
            $c8mmd = 1;
        } elseif ($c8mmd > 35 && $c8mmd <= 55) {
            $c8mmd = 2;
        } elseif ($c8mmd > 55 && $c8mmd <= 75) {
            $c8mmd = 3;
        } elseif ($c8mmd > 75 && $c8mmd <= 85) {
            $c8mmd = 4;
        } elseif ($c8mmd > 85 && $c8mmd <= 100) {
            $c8mmd = 5;
        }

        //PERBANKAN
        $c1bank = $this->C1bank();
        $c2bank = $this->C2bank();
        $c3bank = $this->C3bank();
        $c4bank = $this->C4bank();
        $c5bank = $this->C5bank();
        $c6bank = $this->C6bank();
        $c7bank = $this->C7bank();
        $c8bank = $this->C8bank();

        //NILAI MTK
        if ($c1bank <= 52) {
            $c1bank = 1;
        } elseif ($c1bank > 52 && $c1bank <= 72) {
            $c1bank = 2;
        } elseif ($c1bank > 72 && $c1bank <= 82) {
            $c1bank = 3;
        } elseif ($c1bank > 82 && $c1bank <= 92) {
            $c1bank = 4;
        } elseif ($c1bank > 92 && $c1bank <= 100) {
            $c1bank = 5;
        }
        //NILAI IPA
        if ($c2bank <= 42) {
            $c2bank = 1;
        } elseif ($c2bank > 42 && $c2bank <= 62) {
            $c2bank = 2;
        } elseif ($c2bank > 62 && $c2bank <= 72) {
            $c2bank = 3;
        } elseif ($c2bank > 72 && $c2bank <= 82) {
            $c2bank = 4;
        } elseif ($c2bank > 82 && $c2bank <= 100) {
            $c2bank = 5;
        }
        //NILAI BAHASA INDONESIA
        if ($c3bank <= 47) {
            $c3bank = 1;
        } elseif ($c3bank > 47 && $c3bank <= 67) {
            $c3bank = 2;
        } elseif ($c3bank > 67 && $c3bank <= 77) {
            $c3bank = 3;
        } elseif ($c3bank > 77 && $c3bank <= 87) {
            $c3bank = 4;
        } elseif ($c3bank > 87 && $c3bank <= 100) {
            $c3bank = 5;
        }
        //NILAI BAHASA INGRRIS
        if ($c4bank <= 37) {
            $c4bank = 1;
        } elseif ($c4bank > 37 && $c4bank <= 57) {
            $c4bank = 2;
        } elseif ($c4bank > 57 && $c4bank <= 67) {
            $c4bank = 3;
        } elseif ($c4bank > 67 && $c4bank <= 77) {
            $c4bank = 4;
        } elseif ($c4bank > 77 && $c4bank <= 100) {
            $c4bank = 5;
        }
        //NILAI TES FISIK
        if ($c5bank <= 33) {
            $c5bank = 1;
        } elseif ($c5bank > 33 && $c5bank <= 53) {
            $c5bank = 2;
        } elseif ($c5bank > 53 && $c5bank <= 63) {
            $c5bank = 3;
        } elseif ($c5bank > 63 && $c5bank <= 73) {
            $c5bank = 4;
        } elseif ($c5bank > 73 && $c5bank <= 100) {
            $c5bank = 5;
        }
        //NILAI TES PSIKOLOGI
        if ($c6bank <= 20) {
            $c6bank = 1;
        } elseif ($c6bank > 20 && $c6bank <= 40) {
            $c6bank = 2;
        } elseif ($c6bank > 40 && $c6bank <= 60) {
            $c6bank = 3;
        } elseif ($c6bank > 60 && $c6bank <= 80) {
            $c6bank = 4;
        } elseif ($c6bank > 80 && $c6bank <= 100) {
            $c6bank = 5;
        }
        //NILAI TES WAWANCARA
        if ($c7bank <= 30) {
            $c7bank = 1;
        } elseif ($c7bank > 30 && $c7bank <= 48) {
            $c7bank = 2;
        } elseif ($c7bank > 48 && $c7bank <= 68) {
            $c7bank = 3;
        } elseif ($c7bank > 68 && $c7bank <= 78) {
            $c7bank = 4;
        } elseif ($c7bank > 78 && $c7bank <= 100) {
            $c7bank = 5;
        }
        //NILAI TES TULIS
        if ($c8bank <= 30) {
            $c8bank = 1;
        } elseif ($c8bank > 30 && $c8bank <= 52) {
            $c8bank = 2;
        } elseif ($c8bank > 52 && $c8bank <= 62) {
            $c8bank = 3;
        } elseif ($c8bank > 62 && $c8bank <= 82) {
            $c8bank = 4;
        } elseif ($c8bank > 82 && $c8bank <= 100) {
            $c8bank = 5;
        }


        //TEKNIK OTOTRONIK
        $c1to = $this->C1to();
        $c2to = $this->C2to();
        $c3to = $this->C3to();
        $c4to = $this->C4to();
        $c5to = $this->C5to();
        $c6to = $this->C6to();
        $c7to = $this->C7to();
        $c8to = $this->C8to();

        //NILAI MTK
        if ($c1to <= 58) {
            $c1to = 1;
        } elseif ($c1to > 58 && $c1to <= 68) {
            $c1to = 2;
        } elseif ($c1to > 68 && $c1to <= 78) {
            $c1to = 3;
        } elseif ($c1to > 78 && $c1to <= 88) {
            $c1to = 4;
        } elseif ($c1to > 88 && $c1to <= 100) {
            $c1to = 5;
        }
        //NILAI IPA
        if ($c2to <= 52) {
            $c2to = 1;
        } elseif ($c2to > 52 && $c2to <= 72) {
            $c2to = 2;
        } elseif ($c2to > 72 && $c2to <= 82) {
            $c2to = 3;
        } elseif ($c2to > 82 && $c2to <= 92) {
            $c2to = 4;
        } elseif ($c2to > 92 && $c2to <= 100) {
            $c2to = 5;
        }
        //NILAI BAHASA INDONESIA
        if ($c3to <= 48) {
            $c3to = 1;
        } elseif ($c3to > 48 && $c3to <= 58) {
            $c3to = 2;
        } elseif ($c3to > 58 && $c3to <= 68) {
            $c3to = 3;
        } elseif ($c3to > 68 && $c3to <= 78) {
            $c3to = 4;
        } elseif ($c3to > 78 && $c3to <= 100) {
            $c3to = 5;
        }
        //NILAI BAHASA INGGRIS
        if ($c4to <= 45) {
            $c4to = 1;
        } elseif ($c4to > 45 && $c4to <= 55) {
            $c4to = 2;
        } elseif ($c4to > 55 && $c4to <= 65) {
            $c4to = 3;
        } elseif ($c4to > 65 && $c4to <= 75) {
            $c4to = 4;
        } elseif ($c4to > 75 && $c4to <= 100) {
            $c4to = 5;
        }
        //NILAI TES FISIK
        if ($c5to <= 42) {
            $c5to = 1;
        } elseif ($c5to > 42 && $c5to <= 52) {
            $c5to = 2;
        } elseif ($c5to > 52 && $c5to <= 62) {
            $c5to = 3;
        } elseif ($c5to > 62 && $c5to <= 72) {
            $c5to = 4;
        } elseif ($c5to > 72 && $c5to <= 100) {
            $c5to = 5;
        }
        //NILAI TES PSIKOLOGI
        if ($c6to <= 48) {
            $c6to = 1;
        } elseif ($c6to > 48 && $c6to <= 58) {
            $c6to = 2;
        } elseif ($c6to > 58 && $c6to <= 68) {
            $c6to = 3;
        } elseif ($c6to > 68 && $c6to <= 78) {
            $c6to = 4;
        } elseif ($c6to > 78 && $c6to <= 100) {
            $c6to = 5;
        }
        //NILAI TES WAWANCARA
        if ($c7to <= 40) {
            $c7to = 1;
        } elseif ($c7to > 40 && $c7to <= 51) {
            $c7to = 2;
        } elseif ($c7to > 51 && $c7to <= 61) {
            $c7to = 3;
        } elseif ($c7to > 61 && $c7to <= 71) {
            $c7to = 4;
        } elseif ($c7to > 71 && $c7to <= 100) {
            $c7to = 5;
        }
        //NILAI TES TULIS
        if ($c8to <= 20) {
            $c8to = 1;
        } elseif ($c8to > 20 && $c8to <= 40) {
            $c8to = 2;
        } elseif ($c8to > 40 && $c8to <= 60) {
            $c8to = 3;
        } elseif ($c8to > 60 && $c8to <= 80) {
            $c8to = 4;
        } elseif ($c8to > 80 && $c8to <= 100) {
            $c8to = 5;
        }

        $data1 = [
            'id_siswa' => $this->input->post('id_siswa'),
            'id_jurusan' => 1,
            'C1' => $c1mesin,
            'C2' => $c2mesin,
            'C3' => $c3mesin,
            'C4' => $c4mesin,
            'C5' => $c5mesin,
            'C6' => $c6mesin,
            'C7' => $c7mesin,
            'C8' => $c8mesin
        ];
        $data2 = [
            'id_siswa' => $this->input->post('id_siswa'),
            'id_jurusan' => 2,
            'C1' => $c1las,
            'C2' => $c2las,
            'C3' => $c3las,
            'C4' => $c4las,
            'C5' => $c5las,
            'C6' => $c6las,
            'C7' => $c7las,
            'C8' => $c8las
        ];
        $data3 = [
            'id_siswa' => $this->input->post('id_siswa'),
            'id_jurusan' => 3,
            'C1' => $c1tkr,
            'C2' => $c2tkr,
            'C3' => $c3tkr,
            'C4' => $c4tkr,
            'C5' => $c5tkr,
            'C6' => $c6tkr,
            'C7' => $c7tkr,
            'C8' => $c8tkr
        ];
        $data4 = [
            'id_siswa' => $this->input->post('id_siswa'),
            'id_jurusan' => 4,
            'C1' => $c1pbk,
            'C2' => $c2pbk,
            'C3' => $c3pbk,
            'C4' => $c4pbk,
            'C5' => $c5pbk,
            'C6' => $c6pbk,
            'C7' => $c7pbk,
            'C8' => $c8pbk
        ];
        $data5 = [
            'id_siswa' => $this->input->post('id_siswa'),
            'id_jurusan' => 5,
            'C1' => $c1meka,
            'C2' => $c2meka,
            'C3' => $c3meka,
            'C4' => $c4meka,
            'C5' => $c5meka,
            'C6' => $c6meka,
            'C7' => $c7meka,
            'C8' => $c8meka
        ];
        $data6 = [
            'id_siswa' => $this->input->post('id_siswa'),
            'id_jurusan' => 6,
            'C1' => $c1rpl,
            'C2' => $c2rpl,
            'C3' => $c3rpl,
            'C4' => $c4rpl,
            'C5' => $c5rpl,
            'C6' => $c6rpl,
            'C7' => $c7rpl,
            'C8' => $c8rpl
        ];
        $data7 = [
            'id_siswa' => $this->input->post('id_siswa'),
            'id_jurusan' => 7,
            'C1' => $c1tkj,
            'C2' => $c2tkj,
            'C3' => $c3tkj,
            'C4' => $c4tkj,
            'C5' => $c5tkj,
            'C6' => $c6tkj,
            'C7' => $c7tkj,
            'C8' => $c8tkj
        ];
        $data8 = [
            'id_siswa' => $this->input->post('id_siswa'),
            'id_jurusan' => 8,
            'C1' => $c1mmd,
            'C2' => $c2mmd,
            'C3' => $c3mmd,
            'C4' => $c4mmd,
            'C5' => $c5mmd,
            'C6' => $c6mmd,
            'C7' => $c7mmd,
            'C8' => $c8mmd
        ];
        $data9 = [
            'id_siswa' => $this->input->post('id_siswa'),
            'id_jurusan' => 9,
            'C1' => $c1bank,
            'C2' => $c2bank,
            'C3' => $c3bank,
            'C4' => $c4bank,
            'C5' => $c5bank,
            'C6' => $c6bank,
            'C7' => $c7bank,
            'C8' => $c8bank
        ];
        $data10 = [
            'id_siswa' => $this->input->post('id_siswa'),
            'id_jurusan' => 10,
            'C1' => $c1to,
            'C2' => $c2to,
            'C3' => $c3to,
            'C4' => $c4to,
            'C5' => $c5to,
            'C6' => $c6to,
            'C7' => $c7to,
            'C8' => $c8to
        ];
        //$this->db->set($data1);
        $this->db->insert('nilai_jurusan', $data1);
        $this->db->insert('nilai_jurusan', $data2);
        $this->db->insert('nilai_jurusan', $data3);
        $this->db->insert('nilai_jurusan', $data4);
        $this->db->insert('nilai_jurusan', $data5);
        $this->db->insert('nilai_jurusan', $data6);
        $this->db->insert('nilai_jurusan', $data7);
        $this->db->insert('nilai_jurusan', $data8);
        $this->db->insert('nilai_jurusan', $data9);
        $this->db->insert('nilai_jurusan', $data10);
        $this->db->where('id_jurusan', 0);
        $this->db->delete('nilai_jurusan');
        //$this->db->where('id_siswa', $this->input->post('id_siswa'));
        //$this->db->update('nilai_jurusan');
    }

    public function C1to()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_jurusan', 10);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c1to = $row->C1;
        }
        return $c1to;
    }
    public function C2to()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_jurusan', 10);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c2to = $row->C2;
        }
        return $c2to;
    }
    public function C3to()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_jurusan', 10);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c3to = $row->C3;
        }
        return $c3to;
    }
    public function C4to()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_jurusan', 10);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c4to = $row->C4;
        }
        return $c4to;
    }
    public function C5to()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_jurusan', 10);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c5to = $row->C5;
        }
        return $c5to;
    }
    public function C6to()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_jurusan', 10);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c6to = $row->C6;
        }
        return $c6to;
    }
    public function C7to()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_jurusan', 10);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c7to = $row->C7;
        }
        return $c7to;
    }
    public function C8to()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_jurusan', 10);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c8to = $row->C8;
        }
        return $c8to;
    }

    public function C1bank()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_jurusan', 9);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c1bank = $row->C1;
        }
        return $c1bank;
    }
    public function C2bank()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_jurusan', 9);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c2bank = $row->C2;
        }
        return $c2bank;
    }
    public function C3bank()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_jurusan', 9);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c3bank = $row->C3;
        }
        return $c3bank;
    }
    public function C4bank()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_jurusan', 9);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c4bank = $row->C4;
        }
        return $c4bank;
    }
    public function C5bank()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_jurusan', 9);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c5bank = $row->C5;
        }
        return $c5bank;
    }
    public function C6bank()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_jurusan', 9);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c6bank = $row->C6;
        }
        return $c6bank;
    }
    public function C7bank()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_jurusan', 9);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c7bank = $row->C7;
        }
        return $c7bank;
    }
    public function C8bank()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_jurusan', 9);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c8bank = $row->C8;
        }
        return $c8bank;
    }

    public function C1mmd()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_jurusan', 8);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c1mmd = $row->C1;
        }
        return $c1mmd;
    }
    public function C2mmd()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_jurusan', 8);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c2mmd = $row->C2;
        }
        return $c2mmd;
    }
    public function C3mmd()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_jurusan', 8);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c3mmd = $row->C3;
        }
        return $c3mmd;
    }
    public function C4mmd()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_jurusan', 8);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c4mmd = $row->C4;
        }
        return $c4mmd;
    }
    public function C5mmd()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_jurusan', 8);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c5mmd = $row->C5;
        }
        return $c5mmd;
    }
    public function C6mmd()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_jurusan', 8);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c6mmd = $row->C6;
        }
        return $c6mmd;
    }
    public function C7mmd()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_jurusan', 8);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c7mmd = $row->C7;
        }
        return $c7mmd;
    }
    public function C8mmd()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_jurusan', 8);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c8mmd = $row->C8;
        }
        return $c8mmd;
    }
    public function C1tkj()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_jurusan', 7);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c1tkj = $row->C1;
        }
        return $c1tkj;
    }
    public function C2tkj()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_jurusan', 7);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c2tkj = $row->C2;
        }
        return $c2tkj;
    }
    public function C3tkj()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_jurusan', 7);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c3tkj = $row->C3;
        }
        return $c3tkj;
    }
    public function C4tkj()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_jurusan', 7);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c4tkj = $row->C4;
        }
        return $c4tkj;
    }
    public function C5tkj()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_jurusan', 7);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c5tkj = $row->C5;
        }
        return $c5tkj;
    }
    public function C6tkj()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_jurusan', 7);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c6tkj = $row->C6;
        }
        return $c6tkj;
    }
    public function C7tkj()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_jurusan', 7);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c7tkj = $row->C7;
        }
        return $c7tkj;
    }
    public function C8tkj()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_jurusan', 7);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c8tkj = $row->C8;
        }
        return $c8tkj;
    }
    public function C1rpl()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_jurusan', 6);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c1rpl = $row->C1;
        }
        return $c1rpl;
    }
    public function C2rpl()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_jurusan', 6);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c2rpl = $row->C2;
        }
        return $c2rpl;
    }
    public function C3rpl()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_jurusan', 6);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c3rpl = $row->C3;
        }
        return $c3rpl;
    }
    public function C4rpl()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_jurusan', 6);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c4rpl = $row->C4;
        }
        return $c4rpl;
    }
    public function C5rpl()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_jurusan', 6);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c5rpl = $row->C5;
        }
        return $c5rpl;
    }
    public function C6rpl()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_jurusan', 6);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c6rpl = $row->C6;
        }
        return $c6rpl;
    }
    public function C7rpl()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_jurusan', 6);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c7rpl = $row->C7;
        }
        return $c7rpl;
    }
    public function C8rpl()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_jurusan', 6);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c8rpl = $row->C8;
        }
        return $c8rpl;
    }

    public function C1meka()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_jurusan', 5);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c1meka = $row->C1;
        }
        return $c1meka;
    }
    public function C2meka()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_jurusan', 5);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c2meka = $row->C2;
        }
        return $c2meka;
    }
    public function C3meka()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_jurusan', 5);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c3meka = $row->C3;
        }
        return $c3meka;
    }
    public function C4meka()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_jurusan', 5);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c4meka = $row->C4;
        }
        return $c4meka;
    }
    public function C5meka()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_jurusan', 5);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c5meka = $row->C5;
        }
        return $c5meka;
    }
    public function C6meka()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_jurusan', 5);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c6meka = $row->C6;
        }
        return $c6meka;
    }
    public function C7meka()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_jurusan', 5);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c7meka = $row->C7;
        }
        return $c7meka;
    }
    public function C8meka()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_jurusan', 5);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c8meka = $row->C8;
        }
        return $c8meka;
    }

    public function C1pbk()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_jurusan', 4);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c1pbk = $row->C1;
        }
        return $c1pbk;
    }
    public function C2pbk()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_jurusan', 4);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c2pbk = $row->C2;
        }
        return $c2pbk;
    }
    public function C3pbk()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_jurusan', 4);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c3pbk = $row->C3;
        }
        return $c3pbk;
    }
    public function C4pbk()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_jurusan', 4);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c4pbk = $row->C4;
        }
        return $c4pbk;
    }
    public function C5pbk()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_jurusan', 4);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c5pbk = $row->C5;
        }
        return $c5pbk;
    }
    public function C6pbk()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_jurusan', 4);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c6pbk = $row->C6;
        }
        return $c6pbk;
    }
    public function C7pbk()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_jurusan', 4);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c7pbk = $row->C7;
        }
        return $c7pbk;
    }
    public function C8pbk()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_jurusan', 4);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c8pbk = $row->C8;
        }
        return $c8pbk;
    }
    public function C1tkr()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_jurusan', 3);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c1tkr = $row->C1;
        }
        return $c1tkr;
    }
    public function C2tkr()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_jurusan', 3);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c2tkr = $row->C2;
        }
        return $c2tkr;
    }
    public function C3tkr()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_jurusan', 3);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c3tkr = $row->C3;
        }
        return $c3tkr;
    }
    public function C4tkr()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_jurusan', 3);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c4tkr = $row->C4;
        }
        return $c4tkr;
    }
    public function C5tkr()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_jurusan', 3);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c5tkr = $row->C5;
        }
        return $c5tkr;
    }
    public function C6tkr()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_jurusan', 3);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c6tkr = $row->C6;
        }
        return $c6tkr;
    }
    public function C7tkr()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_jurusan', 3);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c7tkr = $row->C7;
        }
        return $c7tkr;
    }
    public function C8tkr()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_jurusan', 3);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c8tkr = $row->C8;
        }
        return $c8tkr;
    }
    public function C1las()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_jurusan', 2);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c1las = $row->C1;
        }
        return $c1las;
    }
    public function C2las()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_jurusan', 2);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c2las = $row->C2;
        }
        return $c2las;
    }
    public function C3las()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_jurusan', 2);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c3las = $row->C3;
        }
        return $c3las;
    }
    public function C4las()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_jurusan', 2);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c4las = $row->C4;
        }
        return $c4las;
    }
    public function C5las()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_jurusan', 2);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c5las = $row->C5;
        }
        return $c5las;
    }
    public function C6las()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_jurusan', 2);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c6las = $row->C6;
        }
        return $c6las;
    }
    public function C7las()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_jurusan', 2);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c7las = $row->C7;
        }
        return $c7las;
    }
    public function C8las()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_jurusan', 2);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c8las = $row->C8;
        }
        return $c8las;
    }

    public function C1mesin()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_jurusan', 1);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c1mesin = $row->C1;
        }
        return $c1mesin;
    }

    public function C2mesin()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_jurusan', 1);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c2mesin = $row->C2;
        }
        return $c2mesin;
    }
    public function C3mesin()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_jurusan', 1);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c3mesin = $row->C3;
        }
        return $c3mesin;
    }
    public function C4mesin()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_jurusan', 1);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c4mesin = $row->C4;
        }
        return $c4mesin;
    }
    public function C5mesin()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_jurusan', 1);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c5mesin = $row->C5;
        }
        return $c5mesin;
    }
    public function C6mesin()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_jurusan', 1);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c6mesin = $row->C6;
        }
        return $c6mesin;
    }
    public function C7mesin()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_jurusan', 1);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c7mesin = $row->C7;
        }
        return $c7mesin;
    }
    public function C8mesin()
    {
        $this->db->select('*');
        $this->db->from('konversi_nilai');
        $this->db->where('id_jurusan', 1);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $c8mesin = $row->C8;
        }
        return $c8mesin;
    }

    public function getJoinNilaiJurusanSiswa()
    {
        $queryNilaiJurusanSiswa = "SELECT `data_siswa`.`nama_siswa`, `data_siswa`.`no_daftar`, `nilai_jurusan`.* 
        FROM `data_siswa` JOIN `nilai_jurusan` ON `data_siswa`.`id_siswa` = `nilai_jurusan`.`id_siswa` 
        WHERE `data_siswa`.`id_siswa` = `nilai_jurusan`.`id_siswa`
        ";
        return $this->db->query($queryNilaiJurusanSiswa)->result_array();
    }

    public function getNormalisasi()
    {
        return $this->db->get('normalisasi')->result_array();
    }

    public function inputNormalisasi()
    {
        $c1 = $this->input->post('C1');
        $c2 = $this->input->post('C2');
        $c3 = $this->input->post('C3');
        $c4 = $this->input->post('C4');
        $c5 = $this->input->post('C5');
        $c6 = $this->input->post('C6');
        $c7 = $this->input->post('C7');
        $c8 = $this->input->post('C8');

        $data = [
            'C1' => $c1,
            'C2' => $c2,
            'C3' => $c3,
            'C4' => $c4,
            'C5' => $c5,
            'C6' => $c6,
            'C7' => $c7,
            'C8' => $c8
        ];

        $this->db->truncate('normalisasi');
        $this->db->where('id_siswa', $this->input->post('id_siswa'));
        $this->db->update('normalisasi', $data);
    }

    public function cekKodeSiswa()
    {
        $query = $this->db->query("SELECT MAX(no_daftar) as max_id from data_siswa");
        $rows = $query->row();
        $kode = $rows->max_id;
        $noUrut = (int) substr($kode, 3, 2);
        $noUrut++;
        $char = "SIS";
        $kode = $char . sprintf("%02s", $noUrut);
        return $kode;
    }
}
