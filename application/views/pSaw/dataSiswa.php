<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><?= $judul; ?></h3>
            </div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <?= $this->session->flashdata('message'); ?>
                    <div class="x_panel">

                        <div class="x_title">
                            <!-- <a href="" class="btn btn-round btn-primary mb-3" data-toggle="modal" data-target="#modalTambahSubmenu"> Upload file</a> -->
                            <a href="" class="btn btn-round btn-primary mb-3" data-toggle="modal" data-target="#modalTambahSiswa"> Tambah siswa</a>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                    <ul class="dropdown-menu" role="menu">
                                    </ul>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                        </div>
                        <div class="x_content">
                            <table id="datatable-buttons" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>No Pendaftaran</th>
                                        <th>Nama</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Asal Sekolah</th>
                                        <th>Alamat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($datasiswa as $ds) : ?>
                                        <?php
                                        if ($ds['jenis_kelamin'] == 1) {
                                            $ds['jenis_kelamin'] = 'Laki - Laki';
                                        } else {
                                            $ds['jenis_kelamin'] = 'Perempuan';
                                        }
                                        ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><?= $ds['no_daftar']; ?></td>
                                            <td><?= $ds['nama_siswa']; ?></td>
                                            <td><?= $ds['jenis_kelamin']; ?></td>
                                            <td><?= $ds['asal_sekolah']; ?></td>
                                            <td><?= $ds['alamat']; ?></td>
                                            <td>
                                                <a href="" class="label btn-round btn-success" data-toggle="modal" data-target="#modalEditSiswa<?= $ds['id_siswa']; ?>">edit</a>
                                                <a href="<?= base_url('pSaw/hapusSiswa/') . $ds['id_siswa']; ?>" class="label btn-round btn-danger" onclick="return confirm ('Yakin?');">hapus</a>
                                            </td>
                                        </tr>
                                        <?php $i++; ?>
                                    <?php endforeach; ?>
                                </tbody>
                        </div>

                    </div>
                </div>
            </div>


            <!-- /page content -->