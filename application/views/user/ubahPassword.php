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

                        <?= form_open_multipart('user/ubahPassword'); ?>
                        <?= form_error('password_lama'); ?>
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">
                                <i class="fa fa-fw fa-key" aria-hidden="true"></i>
                            </span>
                            <input type="password" id="password_lama" name="password_lama" class="form-control" placeholder="Password lama" aria-describedby="basic-addon1">
                        </div>
                        <br>
                        <?= form_error('password1_baru'); ?>
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">
                                <i class="fa fa-fw fa-lock" aria-hidden="true"></i>
                            </span>
                            <input type="password" id="password1_baru" name="password1_baru" class="form-control" placeholder="Password baru" aria-describedby="basic-addon1">
                        </div>
                        <br>
                        <?= form_error('password2_baru'); ?>
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">
                                <i class="fa fa-fw fa-unlock-alt" aria-hidden="true"></i>
                            </span>
                            <input type="password" id="password2_baru" name="password2_baru" class="form-control" placeholder="Konfirmasi password baru" aria-describedby="basic-addon1">
                        </div>

                        <div>
                            <br>
                            <button class="btn btn-primary" type="submit">
                                Ubah password
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