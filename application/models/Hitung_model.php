<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Hitung_model extends CI_Model
{
    //Pilih yang terbesar karena ini merupakan atribut benefit
    public function maxC1()
    {
        $maxC1 = "SELECT max(`C1`) as C1 FROM `nilai_jurusan`";
        return $this->db->query($maxC1)->row_array();
    }
    public function maxC2()
    {
        $maxC2 = "SELECT max(`C2`) as C2 FROM `nilai_jurusan`";
        return $this->db->query($maxC2)->row_array();
    }
    public function maxC3()
    {
        $maxC3 = "SELECT max(`C3`) as C3 FROM `nilai_jurusan`";
        return $this->db->query($maxC3)->row_array();
    }
    public function maxC4()
    {
        $maxC4 = "SELECT max(`C4`) as C4 FROM `nilai_jurusan`";
        return $this->db->query($maxC4)->row_array();
    }
    public function maxC5()
    {
        $maxC5 = "SELECT max(`C5`) as C5 FROM `nilai_jurusan`";
        return $this->db->query($maxC5)->row_array();
    }
    public function maxC6()
    {
        $maxC6 = "SELECT max(`C6`) as C6 FROM `nilai_jurusan`";
        return $this->db->query($maxC6)->row_array();
    }
    public function maxC7()
    {
        $maxC7 = "SELECT max(`C7`) as C7 FROM `nilai_jurusan`";
        return $this->db->query($maxC7)->row_array();
    }
    public function maxC8()
    {
        $maxC8 = "SELECT max(`C8`) as C8 FROM `nilai_jurusan`";
        return $this->db->query($maxC8)->row_array();
    }


    //ambil bobot tiap kriteria
    public function bobotC1()
    {
        return $this->db->get_where('kriteria', ['id' => 1])->row_array();
    }
    public function bobotC2()
    {
        return $this->db->get_where('kriteria', ['id' => 2])->row_array();
    }
    public function bobotC3()
    {
        return $this->db->get_where('kriteria', ['id' => 3])->row_array();
    }
    public function bobotC4()
    {
        return $this->db->get_where('kriteria', ['id' => 4])->row_array();
    }
    public function bobotC5()
    {
        return $this->db->get_where('kriteria', ['id' => 5])->row_array();
    }
    public function bobotC6()
    {
        return $this->db->get_where('kriteria', ['id' => 6])->row_array();
    }
    public function bobotC7()
    {
        return $this->db->get_where('kriteria', ['id' => 7])->row_array();
    }
    public function bobotC8()
    {
        return $this->db->get_where('kriteria', ['id' => 8])->row_array();
    }

    public function HasilSeleksi()
    {
        $query = "SELECT `data_siswa`.`no_daftar`, `data_siswa`.`nama_siswa`,`data_siswa`.`asal_sekolah`,`data_siswa`.`alamat`,
        `nilai_jurusan`.*
        FROM `data_siswa` JOIN `nilai_jurusan` 
        ON `data_siswa`.`id_siswa` = `nilai_jurusan`.`id_siswa` 
        WHERE `data_siswa`.`id_siswa` = `nilai_jurusan`.`id_siswa`
        ";
        return $this->db->query($query)->result_array();
    }

    public function jurus()
    {
        $this->db->select('id_jurusan');
        $this->db->from('nilai_jurusan');
        $query = $this->db->get();
        if ($query->num_rows()) {
            $jurusam = $query->result_array();
            foreach ($jurusam as $row => $author) {
                $this->db->insert("laporan", $author);
            }
        }
    }

    public function ID()
    {
        $query = "SELECT `id_siswa` FROM `data_siswa` ORDER BY `id_siswa` DESC LIMIT 1";
        return $this->db->query($query)->result();
    }

    //fungsi yang digunakan untuk memasukkan hasil SAW ke tabel laporan, dalam bentuk array karena satu siswa memiliki nilai - nilai nya sendiri di setiap jurusan, nantinya yang terbesar lah yang cocok dengan nilai siswa tersebut.
    public function selesai()
    {
        $this->db->truncate('nilai_jurusan');
        $this->db->truncate('konversi_nilai');
        $id_siswa = $this->input->post('id_jurusan');
        $result = array();
        foreach ($id_siswa as $key => $val) {
            $result[] = array(
                "id_jurusan" => $_POST['id_jurusan'][$key],
                "id_siswa" => $_POST['id_siswa'][$key],
                "no_daftar" => $_POST['no_daftar'][$key],
                "nama_siswa" => $_POST['nama_siswa'][$key],
                "alamat" => $_POST['alamat'][$key],
                "asal_sekolah" => $_POST['asal_sekolah'][$key],
                "total" => $_POST['total'][$key]
            );
        }
        $this->db->insert_batch('laporan', $result);
    }

    public function getEmail()
    {
        return $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    }

    public function getLaporan()
    {
        return $this->db->get('laporan')->result_array();
    }

    public function HasilAkhir()
    {
        $query = "SELECT `laporan`.* , `jurusan`.`nama_jurusan` FROM `laporan` JOIN `jurusan` ON `laporan`.`id_jurusan` = `jurusan`.`id_jurusan` 
        WHERE `laporan`.`id_jurusan` = `jurusan`.`id_jurusan` 
        GROUP BY `laporan`.`total` 
        ORDER BY `laporan`.`total` DESC
        ";
        return $this->db->query($query)->result_array();
    }

    public function CetakMax()
    {
        $query = "SELECT `laporan`.* , `jurusan`.`nama_jurusan` FROM `laporan` 
        JOIN `jurusan` ON `laporan`.`id_jurusan` = `jurusan`.`id_jurusan` 
        WHERE `laporan`.`id_jurusan` = `jurusan`.`id_jurusan` 
        GROUP BY `laporan`.`total` 
        ORDER BY `laporan`.`total` DESC LIMIT 1
        ";
        return $this->db->query($query)->result_array();
    }
    public function cetak()
    {

        $data = [
            'id_siswa' => $this->input->post('id_siswa', true),
            'nama_siswa' => $this->input->post('nama_siswa', true),
            'asal_sekolah' => $this->input->post('asal_sekolah', true),
            'alamat' => $this->input->post('alamat', true),
            'id_jurusan' => $this->input->post('id_jurusan', true),
            'nama_jurusan' => $this->input->post('nama_jurusan', true),
            'total' => $this->input->post('total', true),
        ];
        $this->db->insert('cetak', $data);
        $this->db->truncate('laporan');
    }
}
