<?php
class Laporanpdf extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('pdf');
    }

    function index()
    {
        $pdf = new FPDF('l', 'mm', 'A5');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial', 'B', 16);
        // mencetak string 
        $pdf->Cell(190, 7, 'SEKOLAH MENENGAH KEJURUSAN NEGERI 1 SEYEGAN', 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(190, 7, 'DAFTAR REKOMENDASI JURUSAN SISWA BARU', 0, 1, 'C');
        // Memberikan space kebawah agar tidak terlalu rapat

        $pdf->Cell(190, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(35, 6, 'NAMA SISWA', 1, 0, 'C');
        $pdf->Cell(35, 6, 'ASAL SEKOLAH', 1, 0, 'C');
        $pdf->Cell(35, 6, 'NAMA JURUSAN', 1, 0, 'C');
        $pdf->Cell(35, 6, 'TOTAL NILAI', 1, 1, 'C');
        $pdf->SetFont('Arial', '', 10);
        $cetak = $this->db->get('cetak')->result();
        foreach ($cetak as $row) {
            $pdf->Cell(35, 6, $row->nama_siswa, 1, 0);
            $pdf->Cell(35, 6, $row->asal_sekolah, 1, 0);
            $pdf->Cell(35, 6, $row->nama_jurusan, 1, 0);
            $pdf->Cell(35, 6, $row->total, 1, 1);
        }
        $pdf->Output();
    }
}
