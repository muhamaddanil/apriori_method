<?php

if ($this->session->userdata('id_grup') == '1') {

    $menus = array(
        array(
            'menuId' => "home",
            'menuName' => "Beranda",
            'menuPath' => site_url("home_page"),
            'menuIcon' => "fas fa-home nav-icon"
        ),

        array(
            'menuId' => "data_obat",
            'menuName' => "Data Obat",
            'menuPath' => site_url("data_obat"),
            'menuIcon' => 'fas fa-tablets nav-icon'
        ),

        array(
            'menuId' => "pemakaian_obat",
            'menuName' => "Data Pemakaian Obat",
            'menuPath' => site_url("data_pemakaian_obat"),
            'menuIcon' => 'fas fa-list-alt nav-icon'
        ),
        // array(
        //     'menuId' => "data_prediksi",
        //     'menuName' => "Prediksi",
        //     'menuPath' => site_url("data_prediksi"),
        //     'menuIcon' => 'fas fa-chart-line nav-icon'
        // ),
        array(
            'menuId' => "data_pengguna",
            'menuName' => "Pengguna",
            'menuPath' => site_url("data_pengguna"),
            'menuIcon' => 'fas fa-user-md nav-icon'
        ),
        array(
            'menuId' => "data_analisis",
            'menuName' => "Analisis",
            'menuPath' => site_url("data_analisis"),
            'menuIcon' => 'fas fa-chart-line nav-icon'
        ),
     //   array(
      //      'menuId' => "data_laporan",
      //      'menuName' => "Laporan Pemakaian Obat",
      //      'menuPath' => site_url("data_laporan"),
      //      'menuIcon' => 'fas fa-file-pdf nav-icon'
      //  ),
        array(
            'menuId' => "data_tentang",
            'menuName' => "Tentang",
            'menuPath' => site_url("data_tentang"),
            'menuIcon' => 'fas fa-tags nav-icon'
        ),
    );
} elseif ($this->session->userdata('id_grup') == '2') {
    $menus = array(
        array(
            'menuId' => "home",
            'menuName' => "Beranda",
            'menuPath' => site_url("home_page"),
            'menuIcon' => "fas fa-home nav-icon"
        ),
        array(
            'menuId' => "data_laporan",
            'menuName' => "Laporan Pemakaian Obat",
            'menuPath' => site_url("data_laporan"),
            'menuIcon' => 'fas fa-file-pdf nav-icon'
        ),
        array(
            'menuId' => "data_tentang",
            'menuName' => "Tentang",
            'menuPath' => site_url("data_tentang"),
            'menuIcon' => 'fas fa-tags nav-icon'
        ),
    );
}
?>

<style>
    .main-sidebar {
        /* background: linear-gradient(to bottom, #827FFE 20%, #4E9EB6 100%); */
        background: #827FFE;
    }

    .sidebar a {
        /* background: linear-gradient(to bottom, #827FFE 20%, #4E9EB6 100%); */
        color: white !important;
    }

    .nav-item .active {
        background-color: rgba(255, 255, 255, .4) !important;
    }
</style>

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <!-- <img src="<?php echo base_url(); ?>dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
        <span class="brand-text font-weight-bold pl-3">PUSKESMAS KANDAI</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <!-- <img src="<?php echo base_url(); ?>dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> -->
            </div>
            <div class="info">
                <a href="#" class="d-block">
                    <b><?php echo $this->session->userdata('nama_grup') ?></b>
                </a>
            </div>
        </div>



        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                <li class="nav-header text-light">MENU</li>
                <?php
                foreach ($menus as $menu) :
                ?>
                    <li class="nav-item menu-open">
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a id="<?php echo $menu['menuId']; ?>" href="<?php echo $menu['menuPath']; ?>" class="nav-link <?php if ($name == $menu['menuName']) echo "active"; ?>">
                                    <i class="<?php echo $menu['menuIcon']; ?>"></i>
                                    <p><?php echo $menu['menuName']; ?></p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php
                endforeach;
                ?>
                <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>