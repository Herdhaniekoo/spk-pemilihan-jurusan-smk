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

                        <div class="x_title">
                            <!-- <a href="" class="btn btn-round btn-primary mb-3" data-toggle="modal" data-target="#modalTambahJurusan"> Tambah Jurusan</a> -->
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">

                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Jurusan</th>
                                        <!-- <th>Aksi</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($jurusan as $j) : ?>

                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><?= $j['nama_jurusan']; ?></td>
                                            <!-- <td>
                                                <a href="" class="label btn-round btn-success" data-toggle="modal" data-target="#modalEditJurusan<?= $j['id_jurusan']; ?>">edit</a>
                                                <a href="<?= base_url('DpSaw/hapusJurusan/') . $j['id_jurusan']; ?>" class="label btn-round btn-danger" onclick="return confirm ('Yakin?');">hapus</a>
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
    <div class="modal fade" id="modalTambahJurusan" tabindex="-1" role="dialog" aria-labelledby="modalTambahJurusanLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="modal-title" id="modalTambahJurusan">Tambah Jurusan</h5>
                </div>
                <?= form_open_multipart('dpSaw/jurusan'); ?>

                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="nama_jurusan" name="nama_jurusan" placeholder="Nama jurusan" required>
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
    <?php foreach ($jurusan as $j) : ?>
        <div class="modal fade" id="modalEditJurusan<?= $j['id_jurusan']; ?>" tabindex="-1" role="dialog" aria-labelledby="modalEditJurusanLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h5 class="modal-title" id="modalEditJurusan">Edit Jurusan</h5>
                    </div>
                    <?= form_open_multipart('dpSaw/editJurusan'); ?>
                    <input type="hidden" name="id_jurusan" value="<?= $j['id_jurusan']; ?>">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" id="nama_jurusan" name="nama_jurusan" placeholder="Nama jurusan" value="<?= $j['nama_jurusan']; ?>" required>
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