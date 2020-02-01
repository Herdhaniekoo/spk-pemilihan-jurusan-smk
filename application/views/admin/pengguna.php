<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><?= $namatabel; ?></h3>
            </div>


            <div class="clearfix"></div>

            <div class="row">

                <?= $this->session->flashdata('message'); ?>

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">

                        <div class="x_title">
                            <a href="" class="btn btn-round btn-primary mb-3" data-toggle="modal" data-target="#modalTambah"> Tambah Pengguna</a>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">

                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Role ID</th>
                                        <th>Status</th>
                                        <th>Tanggal Registrasi</th>
                                        <th>Foto profil</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($pengguna as $p) : ?>
                                        <?php
                                            if ($p['is_active'] == 1) {
                                                $p['is_active'] = 'Aktif';
                                            } else {
                                                $p['is_active'] = 'Tidak Aktif';
                                            }
                                            ?>

                                        <?php
                                            if ($p['role_id'] == 1) {
                                                $p['role_id'] = 'Admin';
                                            } else {
                                                $p['role_id'] = 'User';
                                            }
                                            ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><?= $p['nama']; ?></td>
                                            <td><?= $p['email']; ?></td>
                                            <td><?= $p['role_id']; ?></td>
                                            <td><?= $p['is_active']; ?></td>
                                            <td><?= (new DateTime($p['date_created']))->format('d F Y'); ?></td>
                                            <td><img width="140px" src="<?= base_url('assets/images/') . $p['image']; ?>" alt=""></td>
                                            <td>
                                                <a href="" class="label btn-round btn-success" data-toggle="modal" data-target="#modalEditPengguna<?= $p['id']; ?>">edit</a>
                                                <a href="<?= base_url('admin/hapusPengguna/') . $p['id']; ?>" class="label btn-round btn-danger" onclick="return confirm ('Yakin?');">hapus</a>
                                            </td>
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