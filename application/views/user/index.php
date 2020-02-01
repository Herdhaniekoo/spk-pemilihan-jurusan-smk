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

                        <div class="card mb-3" style="max-width: 540px;">
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img weight="175px" height="175px" src="<?= base_url('assets/images/') . $user['image']; ?>" class="card-img">
                                </div>
                                <div class=" col-md-8" style="left:20px">
                                    <div class="card-body">
                                        <h3 class="card-title"><?= $user['nama']; ?></h3>
                                        <h5 class="card-text"><?= $user['email']; ?></h5>
                                        <p class="card-text"><small class="text-muted">Terdaftar sejak <?= (new DateTime($user['date_created']))->format('d F Y'); ?></small></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->