<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= $judul; ?></title>

    <!-- Bootstrap -->
    <link href="<?= base_url('assets'); ?>/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?= base_url('assets'); ?>/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?= base_url('assets'); ?>/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="<?= base_url('assets'); ?>/vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?= base_url('assets'); ?>/build/css/custom.min.css" rel="stylesheet">
</head>

<body class="login">
    <div>

        <div class="login_wrapper">
            <div class="animate form login_form">
                <section class="login_content">
                    <form action="<?= base_url('auth'); ?>" method="POST">
                        <h1>Login</h1>

                        <?= $this->session->flashdata('message'); ?>

                        <div>
                            <small>
                                <?= form_error('email'); ?>
                            </small>
                            <input name="email" type="text" class="form-control" placeholder="Email" value="<?= set_value('email'); ?>" />
                        </div>
                        <div>
                            <small>
                                <?= form_error('password'); ?>
                            </small>
                            <input name="password" type="password" class="form-control" placeholder="Password" />
                        </div>
                        <div>
                            <button type="submit" class="btn btn-default submit">Masuk</button>
                        </div>

                        <div class="clearfix"></div>

                        <div class="separator">
                            <a href="<?= base_url('auth/daftar'); ?>" class="to_register"> Buat akun </a>
                            </p>

                            <div class="clearfix"></div>
                            <br />

                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</body>

</html>