<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Data User</h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                </div>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-7 col-sm-7 col-xs-7">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><?= $judul; ?></h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <?= $this->session->flashdata('message'); ?>

                        <?= form_open_multipart('user/editUser'); ?>
                        <?= form_error('email'); ?>
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">
                                <i class="fa fa-fw fa-paper-plane" aria-hidden="true"></i>
                            </span>
                            <input type="text" id="email" name="email" class="form-control" placeholder="Email" value="<?= $user['email']; ?>" aria-describedby="basic-addon1">
                        </div>
                        <br>
                        <?= form_error('nama'); ?>
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">
                                <i class="fa fa-fw fa-user" aria-hidden="true"></i>
                            </span>
                            <input type="text" id="nama" name="nama" class="form-control" placeholder="Nama" value="<?= $user['nama']; ?>" aria-describedby="basic-addon1">
                        </div>
                        <br>

                        <div style="border: 1px solid gray;">
                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <img width="150px" src="<?= base_url('assets/images/') . $user['image']; ?>" class="img-circle profile_img">
                                </div>
                                <div class="col-sm-8">
                                    <div class="row">
                                        <div class="col-sm-9">
                                            <div class="custom-file">
                                                <br>
                                                <br>
                                                <br>
                                                <input type="file" class="custom-file-input" id="image" name="image" required>
                                                <label class="custom-file-label" for="image"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <br>
                            <button class="btn btn-primary" type="submit">
                                Edit
                            </button>
                        </div>

                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->