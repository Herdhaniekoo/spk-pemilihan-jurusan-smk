<div class="container body">
  <div class="main_container">
    <div class="col-md-3 left_col">
      <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
          <a href="index.html" class="site_title"><i class="fa fa-graduation-cap"></i> <span><?= $namauser; ?></span></a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">
          <div class="profile_pic">
            <img src="<?= base_url('assets/images/') . $user['image']; ?>" class="img-circle profile_img">
          </div>
          <div class="profile_info">
            <span>Welcome,</span>
            <h2><?= $user['nama']; ?></h2>
          </div>
          <div class="clearfix"></div>
        </div>
        <!-- /menu profile quick info -->

        <br />


        <!-- Query menu -->

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

          <?php
          $role_id = $this->session->userdata('role_id');

          $queryMenu = "SELECT    `menu_user`.`id`,`menu`
                            FROM  `menu_user` JOIN `akses_menu_user`
                            ON    `menu_user`.`id` = `akses_menu_user`.`id_menu`
                            WHERE `akses_menu_user`.`role_id` = $role_id
                         ORDER BY `akses_menu_user`.`id_menu` ASC
                                ";
          $menu = $this->db->query($queryMenu)->result_array();

          ?>
          <!-- LOOPING MENU -->

          <div class="menu_section">

            <?php foreach ($menu as $m) : ?>
              <hr class="sidebar-divider">
              <h3><?= $m['menu']; ?></h3>

              <!-- SUB MENU -->
              <?php
                $menuId = $m['id'];
                $querySubmenu = " SELECT * FROM `submenu_user`
                                    WHERE `menu_id` = $menuId
                                    AND `is_active` = 1
                    ";

                //KUMPULAN MENU BERDASARKAN HAK AKSES
                $submenu = $this->db->query($querySubmenu)->result_array();
                ?>

              <?php foreach ($submenu as $sm) : ?>
                <ul class="nav side-menu">
                  <li><a href="<?= base_url($sm['url']); ?>">
                      <i class="<?= $sm['icon']; ?>"></i>
                      <span class=""><?= $sm['title']; ?></span></a>
                  </li>
                </ul>

              <?php endforeach; ?>
            <?php endforeach; ?>
            <hr class="sidebar-divider">
            <ul class="nav side-menu">
              <li><a href="<?= base_url('auth/logout'); ?>"><i class="fa fa-fw fa-sign-out"></i> Keluar <span class=""></span></a></li>
            </ul>
          </div>
        </div>



      </div>
      <!-- /sidebar menu -->
    </div>
  </div>