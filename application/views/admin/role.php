<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><?= $judul; ?></h3>
            </div>

            <!-- ROLE -->
            <div class="clearfix"></div>
            <div class="row">

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <?= $this->session->flashdata('message'); ?>
                    <div class="x_panel">

                        <div class="x_title">
                            <a href="" class="btn btn-round btn-primary mb-3" data-toggle="modal" data-target="#modalTambahRole"> Tambah Role</a>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">

                            <table id="datatable-responsive1" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Role</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($role as $r) : ?>

                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><?= $r['role']; ?></td>
                                            <td>
                                                <a href="<?= base_url('admin/roleakses/') . $r['id']; ?>" class="label btn-round btn-warning">akses</a>
                                                <a href="" class="label btn-round btn-success" data-toggle="modal" data-target="#modalEditRole<?= $r['id']; ?>">edit</a>
                                                <a href="<?= base_url('admin/hapusRole/') . $r['id']; ?>" class="label btn-round btn-danger" onclick="return confirm ('Yakin?');">hapus</a>
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

            <!-- MENU -->
            <div class="clearfix"></div>
            <div class="row">

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">

                        <div class="x_title">
                            <a href="" class="btn btn-round btn-primary mb-3" data-toggle="modal" data-target="#modalTambahMenu"> Tambah Menu</a>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">

                            <table id="datatable-responsive2" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Menu</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($menu as $m) : ?>

                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><?= $m['menu']; ?></td>
                                            <td>
                                                <a href="" class="label btn-round btn-success" data-toggle="modal" data-target="#modalEditMenu<?= $m['id']; ?>">edit</a>
                                                <a href="<?= base_url('admin/hapusMenu/') . $m['id']; ?>" class="label btn-round btn-danger" onclick="return confirm ('Yakin?');">hapus</a>
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

            <!-- SEBMENU -->
            <div class="clearfix"></div>
            <div class="row">

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">

                        <div class="x_title">
                            <a href="" class="btn btn-round btn-primary mb-3" data-toggle="modal" data-target="#modalTambahSubmenu"> Tambah Submenu</a>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">

                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Submenu</th>
                                        <th>Menu</th>
                                        <th>Url</th>
                                        <th>Ikon</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($submenu as $sm) : ?>

                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><?= $sm['title']; ?></td>
                                            <td><?= $sm['menu']; ?></td>
                                            <td><?= $sm['url']; ?></td>
                                            <td><?= $sm['icon']; ?></td>
                                            <td><?= $sm['is_active']; ?></td>
                                            <td>
                                                <a href="" class="label btn-round btn-success" data-toggle="modal" data-target="#modalEditSubmenu<?= $sm['id']; ?>">edit</a>
                                                <a href="<?= base_url('admin/hapusSubmenu/') . $sm['id']; ?>" class="label btn-round btn-danger" onclick="return confirm ('Yakin?');">hapus</a>
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
</div>


<!-- /page content -->

<!-- modal -->

<!-- Modal Tambah Role -->
<div class="modal fade" id="modalTambahRole" tabindex="-1" role="dialog" aria-labelledby="modalTambahRoleLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="modalTambahRole">Tambah Role</h5>
            </div>
            <?= form_open_multipart('admin/role'); ?>
            <div class="modal-body">
                <div class="form-group">
                    <input type="text" class="form-control" id="role" name="role" placeholder="Nama role" required>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-round btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-round btn-primary">Tambah</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Role -->
<?php foreach ($role as $r) : ?>
    <div class="modal fade" id="modalEditRole<?= $r['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="modalEditRoleLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="modal-title" id="modalEditRole">Edit Role</h5>
                </div>
                <?= form_open_multipart('admin/editRole'); ?>
                <input type="hidden" name="id" value="<?= $r['id']; ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="role" name="role" placeholder="Nama role" value="<?= $r['role']; ?>" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-round btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-round btn-primary">Edit</button>
                </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>


<!-- Modal Tambah Menu-->
<div class="modal fade" id="modalTambahMenu" tabindex="-1" role="dialog" aria-labelledby="modalTambahMenuLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="modalTambahMenu">Tambah Menu</h5>
            </div>
            <?= form_open_multipart('admin/menu'); ?>
            <div class="modal-body">
                <div class="form-group">
                    <input type="text" class="form-control" id="menu" name="menu" placeholder="Nama menu" required>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-round btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-round btn-primary">Tambah</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Menu-->
<?php foreach ($menu as $m) : ?>
    <div class="modal fade" id="modalEditMenu<?= $m['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="modalEditMenuLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="modal-title" id="modalEditMenu">Edit Menu</h5>
                </div>
                <?= form_open_multipart('admin/editMenu'); ?>
                <input type="hidden" name="id" value="<?= $m['id']; ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="menu" name="menu" placeholder="Nama menu" value="<?= $m['menu']; ?>" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-round btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-round btn-primary">Edit</button>
                </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>