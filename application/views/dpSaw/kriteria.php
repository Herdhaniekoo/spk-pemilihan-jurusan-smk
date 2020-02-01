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
                    <?= $this->session->flashdata('message'); ?>
                    <div class="x_panel">

                        <!-- <div class="x_title">
                            <a href="" class="btn btn-round btn-primary mb-3" data-toggle="modal" data-target="#modalTambahKriteria"> Tambah Kriteria</a>
                            <div class="clearfix"></div>
                        </div> -->

                        <div class="x_content">

                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Kode</th>
                                        <th>Kriteria</th>
                                        <th>Atribut</th>
                                        <th>Bobot</th>
                                        <!-- <th>Aksi</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($kriteria as $k) : ?>

                                        <?php
                                        if ($k['atribut_kriteria'] == 1) {
                                            $k['atribut_kriteria'] = 'Benefit';
                                        } else {
                                            $k['atribut_kriteria'] = 'Cost';
                                        }
                                        ?>

                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><?= $k['kode_kriteria']; ?></td>
                                            <td><?= $k['nama_kriteria']; ?></td>
                                            <td><?= $k['atribut_kriteria']; ?></td>
                                            <td><?= $k['bobot_kriteria']; ?></td>
                                            <!-- <td>
                                                <a href="" class="label btn-round btn-success" data-toggle="modal" data-target="#modalEditKriteria<?= $k['id']; ?>">edit</a>
                                                <a href="<?= base_url('DpSaw/hapusKriteria/') . $k['id']; ?>" class="label btn-round btn-danger" onclick="return confirm ('Yakin?');">hapus</a>
                                            </td> -->
                                        </tr>
                                        <?php $i++; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->

    <!-- modal -->

    <!-- Modal Tambah -->
    <div class="modal fade" id="modalTambahKriteria" tabindex="-1" role="dialog" aria-labelledby="modalTambahKriteriaLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="modal-title" id="modalTambahKriteria">Tambah Kriteria</h5>
                </div>
                <?= form_open_multipart('dpSaw/kriteria'); ?>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="kode_kriteria" name="kode_kriteria" placeholder="Kode kriteria" value="<?= $kode; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="nama_kriteria" name="nama_kriteria" placeholder="Nama kriteria" required>
                    </div>
                    <div class="form-group">
                        <select name="atribut_kriteria" id="atribut_kriteria" class="form-control">
                            <optionvalue="<?= $k['atribut_kriteria']; ?>">Pilih kriteria</option>
                                <?php
                                if ($r['atribut_kriteria'] == 1) {
                                    $r['atribut_kriteria'] = 'Benefit';
                                } else {
                                    $r['atribut_kriteria'] = 'Cost';
                                }
                                ?>

                                <option value="1">Benefit</option>
                                <option value="2">Cost</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="bobot_kriteria" name="bobot_kriteria" placeholder="Bobot kriteria" required>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-round btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-round btn-primary">Tambah</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <?php foreach ($kriteria as $k) : ?>
        <div class="modal fade" id="modalEditKriteria<?= $k['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="modalEditKriteriaLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h5 class="modal-title" id="modalEditKriteria">Edit Menu</h5>
                    </div>
                    <?= form_open_multipart('dpSaw/editKriteria'); ?>
                    <input type="hidden" name="id" value="<?= $k['id']; ?>">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" id="kode_kriteria" name="kode_kriteria" placeholder="Kode kriteria" value="<?= $k['kode_kriteria']; ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="nama_kriteria" name="nama_kriteria" placeholder="Nama kriteria" value="<?= $k['nama_kriteria']; ?>" required>
                        </div>

                        <div class="form-group">
                            <select class="form-control" name="atribut_kriteria" id="atribut_kriteria">
                                <option value="<?= $k['atribut_kriteria']; ?>"> Atribiut =
                                    <?php
                                    if ($k['atribut_kriteria'] == 1) {
                                        $k['atribut_kriteria'] = 'Benefit';
                                    } elseif ($k['atribut_kriteria'] == 2) {
                                        $k['atribut_kriteria'] = 'Cost';
                                    }
                                    ?>
                                    <?= $k['atribut_kriteria']; ?>
                                </option>
                                <option value="1">Benefit</option>
                                <option value="2">Cost</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" id="bobot_kriteria" name="bobot_kriteria" placeholder="Bobot kriteria" value="<?= $k['bobot_kriteria']; ?>" required>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-round btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-round btn-primary">Edit</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach; ?>