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
                        </div>
                        <div class="x_content">
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
                            <table id="datatable-buttons" class="table table-striped table-bordered">
                                <thead>

                                    <tr>
                                        <th>#</th>
                                        <th>No Pendaftaran</th>
                                        <th>Nama</th>
                                        <?php foreach ($kriteria as $k) : ?>
                                            <th><?= $k['nama_kriteria']; ?></th>
                                        <?php endforeach; ?>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php $i = 1; ?>
                                    <?php foreach ($nilai_siswa as $ns) : ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><?= $ns['no_daftar']; ?></td>
                                            <td><?= $ns['nama_siswa']; ?></td>
                                            <td><?= $ns['C1']; ?></td>
                                            <td><?= $ns['C2']; ?></td>
                                            <td><?= $ns['C3']; ?></td>
                                            <td><?= $ns['C4']; ?></td>
                                            <td><?= $ns['C5']; ?></td>
                                            <td><?= $ns['C6']; ?></td>
                                            <td><?= $ns['C7']; ?></td>
                                            <td><?= $ns['C8']; ?></td>
                                            <td>
                                                <a href="" class="label btn-round btn-warning" data-toggle="modal" data-target="#modalTambahNilai<?= $ns['id_siswa']; ?>">nilai</a>
                                                <a href="" class="label btn-round btn-primary" data-toggle="modal" data-target="#modalNormalisasi<?= $ns['id_siswa']; ?>">hitung</a>
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