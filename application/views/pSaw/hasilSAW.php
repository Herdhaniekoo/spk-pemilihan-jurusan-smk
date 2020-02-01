<!-- page content -->
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
                            <h2>Matriks Kecocokan</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">
                            <table id="datatable11" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>C1</th>
                                        <th>C2</th>
                                        <th>C3</th>
                                        <th>C4</th>
                                        <th>C5</th>
                                        <th>C6</th>
                                        <th>C7</th>
                                        <th>C8</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($nilai_jurusan as $ns) : ?>
                                        <tr>
                                            <td><?= $ns['C1']; ?></td>
                                            <td><?= $ns['C2']; ?></td>
                                            <td><?= $ns['C3']; ?></td>
                                            <td><?= $ns['C4']; ?></td>
                                            <td><?= $ns['C5']; ?></td>
                                            <td><?= $ns['C6']; ?></td>
                                            <td><?= $ns['C7']; ?></td>
                                            <td><?= $ns['C8']; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Normalisasi</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <table id="datatable-checkbox11" class="table table-striped table-bordered bulk_action">
                                <thead>

                                    <tr>
                                        <th>C1</th>
                                        <th>C2</th>
                                        <th>C3</th>
                                        <th>C4</th>
                                        <th>C5</th>
                                        <th>C6</th>
                                        <th>C7</th>
                                        <th>C8</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php foreach ($nilai_jurusan as $ns) : ?>
                                        <tr>
                                            <td><?= round($ns['C1'] / $maxC1['C1'], 2); ?></td>
                                            <td><?= round($ns['C2'] / $maxC2['C2'], 2); ?></td>
                                            <td><?= round($ns['C3'] / $maxC3['C3'], 2); ?></td>
                                            <td><?= round($ns['C4'] / $maxC4['C4'], 2); ?></td>
                                            <td><?= round($ns['C5'] / $maxC5['C5'], 2); ?></td>
                                            <td><?= round($ns['C6'] / $maxC6['C6'], 2); ?></td>
                                            <td><?= round($ns['C7'] / $maxC7['C7'], 2); ?></td>
                                            <td><?= round($ns['C8'] / $maxC8['C8'], 2); ?></td>
                                        </tr>

                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Matriks Preferensi</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <table id="datatable-buttons11" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>C1</th>
                                        <th>C2</th>
                                        <th>C3</th>
                                        <th>C4</th>
                                        <th>C5</th>
                                        <th>C6</th>
                                        <th>C7</th>
                                        <th>C8</th>
                                        <th>Total Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($nilai_jurusan as $ns) : ?>
                                        <tr>
                                            <?php
                                            $jumlahC1 = ($ns['C1'] / $maxC1['C1']) * $bobotC1['bobot_kriteria']
                                            ?>
                                            <?php
                                            $jumlahC2 = ($ns['C2'] / $maxC2['C2']) * $bobotC2['bobot_kriteria']
                                            ?>
                                            <?php
                                            $jumlahC3 = ($ns['C3'] / $maxC3['C3']) * $bobotC3['bobot_kriteria']
                                            ?>
                                            <?php
                                            $jumlahC4 = ($ns['C4'] / $maxC4['C4']) * $bobotC4['bobot_kriteria']
                                            ?>
                                            <?php
                                            $jumlahC5 = ($ns['C5'] / $maxC5['C5']) * $bobotC5['bobot_kriteria']
                                            ?>
                                            <?php
                                            $jumlahC6 = ($ns['C6'] / $maxC6['C6']) * $bobotC6['bobot_kriteria']
                                            ?>
                                            <?php
                                            $jumlahC7 = ($ns['C7'] / $maxC7['C7']) * $bobotC7['bobot_kriteria']
                                            ?>
                                            <?php
                                            $jumlahC8 = ($ns['C8'] / $maxC8['C8']) * $bobotC8['bobot_kriteria']
                                            ?>

                                            <?php
                                            $sum = [$jumlahC1, $jumlahC2, $jumlahC3, $jumlahC4, $jumlahC5, $jumlahC6, $jumlahC7, $jumlahC8];
                                            $total = array_sum($sum);
                                            ?>
                                            <td><?= round($jumlahC1, 2); ?></td>
                                            <td><?= round($jumlahC2, 2); ?></td>
                                            <td><?= round($jumlahC3, 2); ?></td>
                                            <td><?= round($jumlahC4, 2); ?></td>
                                            <td><?= round($jumlahC5, 2); ?></td>
                                            <td><?= round($jumlahC6, 2); ?></td>
                                            <td><?= round($jumlahC7, 2); ?></td>
                                            <td><?= round($jumlahC8, 2); ?></td>
                                            <td><?= round($total, 2); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <a href="<?= base_url('hitung/cetak') ?>" class="btn btn-round btn-success mb-3" data-toggle="modal" data-target="#modalSelesai">Selesai</a>
                        </br>
                        </br>
                        </br>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->