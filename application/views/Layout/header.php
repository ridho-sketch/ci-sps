<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>
        <?= $judul; ?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="<?= base_url('assets/') ?>images/icon/logo.png">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>css/themify-icons.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>css/metisMenu.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>css/slicknav.min.css">
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css"
        media="all" />

    <!-- Start datatable css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">

    <!-- others css -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>css/typography.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>css/default-css.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>css/styles.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>css/responsive.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <!-- modernizr css -->
    <script src="<?= base_url('assets/') ?>js/vendor/modernizr-2.8.3.min.js"></script>

    <script src="<?= base_url('assets/') ?>js/vendor/jquery-2.2.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

    <!-- jQuery fungsi $.ajax -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css" />

    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script> -->

    <!-- date picker -->
    <link rel="stylesheet" type="text/css" href="Css/datepicker.css" />
<script src="../Js/bootstrap-datepicker.js"></script>

</head>


<body class="body-bg">
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <div class="horizontal-main-wrapper">
        <div class="mainheader-area">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-9">
                        <div class="logo">
                            <a href="<?php echo site_url('Home/'); ?>"><img
                                    src="<?= base_url('assets/') ?>images/icon/logo.png" alt="logo" style="width:45px">
                                <span style="color:#fff; font-size:20px; margin-left:5px;" class="text-uppercase">SPD
                                    ONLINE</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3 clearfix text-right">
                        <div class="clearfix d-md-inline-block d-block">
                            <div class="user-profile" style="margin: 0; padding: 10px; font-size: 16px;">
                                <h4 class="user-name dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-user" style="margin-right: 5px;"></i>
                                        <?php echo $this->session->userdata('userdata')['email']; ?>
                                    <i class="fa fa-angle-down"></i>
                                </h4>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="<?php echo site_url('Home/edit'); ?>">Edit Akun</a>
                                    <a class="dropdown-item" href="<?php echo site_url('Login/logout'); ?>">Keluar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- main header area end -->
        <!-- header area start -->
        <div class="header-area header-bottom">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-9  d-none d-lg-block">
                        <div class="horizontal-menu">
                            <nav>
                                <ul id="nav_menu">
                                    <li><a href="<?php echo site_url('Home'); ?>"><i
                                                class="ti-dashboard"></i><span>Home</span></a></li>
                                    <?php if ($this->session->userdata('access') == 'SuperAdmin') { ?>
                                        <li><a href="<?php echo site_url('Karyawan'); ?>"><i
                                                    class="ti-user"></i><span>Daftar Karyawan</span></a></li>
                                        <li><a href="<?php echo site_url('User'); ?>"><i class="ti-file"></i><span>Daftar
                                                    User</span></a></li>
                                        <li><a href="<?php echo site_url('SuratPengajuan'); ?>"><i
                                                    class="ti-agenda"></i><span>Daftar Surat Pengajuan</span></a></li>
                                    <?php } elseif ($this->session->userdata('access') == 'Pengaju') { ?>
                                        <li><a href="<?php echo site_url('SuratPengajuan'); ?>"><i
                                                    class="ti-agenda"></i><span>Daftar Surat Pengajuan</span></a></li>
                                    <?php } elseif ($this->session->userdata('access') == 'HCM') { ?>
                                        <li><a href="<?php echo site_url('SuratPengajuan'); ?>"><i
                                                    class="ti-agenda"></i><span>Daftar Surat Pengajuan</span></a></li>
                                    <?php } ?>

                                </ul>
                            </nav>
                        </div>
                    </div>
                    <!-- mobile_menu -->
                    <div class="col-12 d-block d-lg-none">
                        <div id="mobile_menu"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- header area end -->
        <!-- page title area end -->