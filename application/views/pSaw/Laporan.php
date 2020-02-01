<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><?= $judul; ?></h3>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Rekomendasi</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <table id="datatable-buttons" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nama siswa</th>
                                        <th>Asal sekolah</th>
                                        <th>Alamat</th>
                                        <th>Nama jurusan</th>
                                        <th>Nilai jurusan</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    <?php foreach ($hasil_akhir as $ha) : ?>
                                        <tr>
                                            <td><?= $ha['nama_siswa']; ?></td>
                                            <td><?= $ha['asal_sekolah']; ?></td>
                                            <td><?= $ha['alamat']; ?></td>
                                            <td><?= $ha['nama_jurusan']; ?></td>
                                            <td><?= round($ha['total'], 2); ?></td>
                                        <?php endforeach; ?>
                                        </tr>
                                </tbody>
                            </table>
                        </div>
                        <a href="" class="btn btn-round btn-success mb-3" data-toggle="modal" data-target="#modalCetak">Laporkan</a>
                    </div>
                </div>
            </div>
        </div>
    </div>