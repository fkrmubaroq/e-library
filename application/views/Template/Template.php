<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <meta name="<?= $this->security->get_csrf_token_name() ?>" content="<?= $this->security->get_csrf_hash() ?>" id="csrf">

    <!-- Title  -->
    <title>Perpustakaan Digital | <?= $title ?></title>

    <!-- Favicon  -->
    <link rel="icon" href="img/core-img/favicon.ico">

    <!-- Core Style CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/core-style.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/style.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/custom.css') ?>">
    <link rel="stylesheet" href="https://cdn.lineicons.com/2.0/LineIcons.css">
    <link rel="stylesheet" href="<?= base_url('assets/plugin/snackbar/snackbar.min.css') ?>">

    <!-- ##### jQuery (Necessary for All JavaScript Plugins) ##### -->
    <script src="<?= base_url('assets/js/jquery/jquery.min.js') ?>"></script>

    <script src="<?= base_url('assets/plugin/snackbar/snackbar.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/Config.js') ?>"></script>

    <!-- Popper js -->
    <script src="<?= base_url('assets/js/popper.min.js') ?>"></script>
    <!-- Bootstrap js -->
    <script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>


    <?php
    if (isset($css)) {
        foreach ($css as $list) : ?>
            <link rel="stylesheet" href="<?= $list ?>">

    <?php endforeach;
    }

    ?>
</head>

<body>
    <!-- ##### Main Content Wrapper Start ##### -->
    <div class="main-content-wrapper d-flex clearfix">

        <!-- Header Area Start -->
        <div class="d-none d-xs-none d-sm-none d-md-none d-lg-block d-xl-block" style="margin-bottom:100px">
            <nav class="navbar navbar-expand-lg navbar-light bg-light w-100 box-shadow d-flex justify-content-between fixed-top" id='header-web'>
                <a class="navbar-brand d-flex" href="<?=base_url()?>">
                    <img class="margin-top-1" src="<?= base_url('assets/img/logo.png') ?>" style="width:35px; height:45px">
                    <div class='d-flex flex-column margin-left-2 text-md-1 padding-top-1'>
                        <div>Perpustakaan</div>
                        <div>Digital</div>
                    </div>
                </a>

                <div class="collapse navbar-collapse">
                    <div class="input-group">
                        <input type=" text" class='form-control' placeholder="Cari buku">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary bg-warning no-border" type="button" style='height:35px'>
                                <i class="lni lni-search-alt text-white fweight-600"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="collapse navbar-collapse d-flex justify-content-end">

                    <div class="navbar-nav">
                        <?php
                        if ($this->credential->cekCredential() == false) :
                        ?>
                            <a class="nav-item nav-link active" href="<?= base_url() ?>"><i class="lni icon-secondary lni-book"></i> Koleksi Buku</span></a>
                            <a class="nav-item nav-link active" href="<?= base_url('pinjam') ?>"><i class="lni icon-secondary lni-cart"></i> Keranjang (<?= @count($_SESSION['items']) ?? '' ?>)</span></a>
                            <a class="nav-item nav-link active" href="<?= base_url('login') ?>">Masuk</a>

                        <?php
                        else : ?>
                            <a class="nav-item nav-link active" href="<?= base_url('riwayat') ?>"><i class="lni icon-secondary lni-customer"></i> Riwayat</span></a>
                            <a class="nav-item nav-link active" href="<?= base_url('pinjam') ?>"><i class="lni icon-secondary lni-cart"></i> Keranjang (<?= @count($_SESSION['items']) ?? '' ?>)</span></a>

                            <div class="dropdown">
                                <a class="nav-item nav-link active" href="#" data-toggle="dropdown"><i class="lni icon-secondary lni-user"></i> <?= $this->credential->userdata('nama_user') ?> <i class="lni lni-chevron-down"></i></a>
                                <div class="dropdown-menu" style="margin-left:-50px">
                                    <a class="dropdown-item" href="<?= base_url('profil') ?>">Profil Saya</a>
                                    <a class="dropdown-item" href="<?= base_url('logout') ?>">Keluar</a>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </nav>
        </div>
        <!-- Header Area End -->
        <div class=" d-xs-block d-sm-block d-md-block d-lg-none d-xl-none" style="margin-bottom:50px">
            <nav class="navbar navbar-expand-lg navbar-light bg-light w-100 box-shadow d-flex justify-content-between fixed-top " id='header-mobile'>
                <a class="navbar-brand d-flex" href="#">
                    <img class="margin-top-1" src="<?= base_url('assets/img/logo.png') ?>" style="width:35px; height:45px">
                    <div class='d-flex flex-column margin-left-2 text-md-1 padding-top-1'>
                        <div>Perpustakaan Digital</div>
                        <div>SMK Merdeka</div>
                    </div>
                </a>

            </nav>

            <nav class="navbar navbar-expand-lg navbar-light bg-light w-100 box-shadow d-flex no-wrap fixed-bottom ">
                <div class="d-flex padding-y-1">
                    <di class='text-center'>
                        <a class="d-flex flex-column" href="<?= base_url() ?>">
                            <i class=" lni lni-home icon-primary"></i>
                            <div class='margin-top-1'>
                                Beranda
                            </div>
                        </a>
                </div>
                <div class="d-flex padding-y-1">
                    <di class='text-center'>
                        <a class="d-flex flex-column">
                            <i class="lni lni-customer icon-primary"></i>
                            <div class='margin-top-1'>Riwayat</div>
                        </a>
                </div>

                <div class="d-flex padding-y-1">
                    <di class='text-center'>
                        <a class="d-flex flex-column" href="<?= base_url('pinjam') ?>">
                            <i class="lni lni-cart icon-primary"></i>
                            <div class='margin-top-1'>
                                Keranjang
                            </div>
                        </a>
                </div>

                <div class="d-flex padding-y-1">
                    <di class='text-center'>
                        <a href="<?= base_url('profil') ?>" class="d-flex flex-column">
                            <i class="lni lni-user icon-primary"></i>
                            <div class='margin-top-1'>Profil Saya</div>
                        </a>
                </div>

                <!-- <a class="nav-item nav-link active" href="<?= base_url('pinjam') ?>"><i class="lni lni-book"></i> Koleksi Saya</span></a>
                    <a class="nav-item nav-link active" href="<?= base_url('pinjam') ?>"><i class="lni lni-cart"></i> Keranjang</span></a> -->


        </div>

        </nav>

    </div>


    <?php $this->load->view($content); ?>
    <!-- ##### Footer Area Start ##### -->
    <?php

    if (isset($js)) {
        foreach ($js as $list) : ?>
            <script src="<?= $list ?>"></script>

    <?php endforeach;
    } ?>
    <?= $this->session->flashdata('pesan') ?>
</body>

</html>