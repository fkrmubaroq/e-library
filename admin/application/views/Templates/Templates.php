<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <!--IE Compatibility modes-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--Mobile first-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>ADMIN PERPUSTAKAAN DIGITAL</title>

    <meta name="description" content="Free Admin Template Based On Twitter Bootstrap 3.x">
    <meta name="author" content="">

    <meta name="msapplication-TileColor" content="#5bc0de" />
    <meta name="msapplication-TileImage" content="assets/img/metis-tile.png" />
    <link rel="stylesheet" href="https://cdn.lineicons.com/2.0/LineIcons.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- animate.css stylesheet -->
    <link rel="stylesheet" href="<?= base_url('assets/template/') ?>lib/animate.css/animate.css">
    <script src="<?= base_url('assets/template/js/jquery-3.6.0.min.js') ?>"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <?php
    if (isset($crud) && $crud != null) {
        foreach ($crud->css_files as $file) : ?>
            <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
        <?php endforeach; ?>

        <?php foreach ($crud->js_files as $file) : ?>
            <script src="<?php echo $file; ?>"></script>
        <?php endforeach;
    }
    if (isset($css)) {
        foreach ($css as $list) : ?>
            <link rel="stylesheet" href="<?= $list ?>">
    <?php endforeach;
    } ?>

    <!-- Bootstrap -->
    <!-- <link rel="stylesheet" href="<?= base_url('assets/template/') ?>lib/bootstrap/css/bootstrap.css">
     -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous" <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('assets/template/') ?>lib/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="<?= base_url('assets/plugin/snackbar/snackbar.min.css') ?>">
    <!-- Metis core stylesheet -->
    <link rel="stylesheet" href="<?= base_url('assets/template/') ?>css/main.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>css/custom.css">

    <!-- metisMenu stylesheet -->
    <link rel="stylesheet" href="<?= base_url('assets/template/') ?>lib/metismenu/metisMenu.css">

    <!-- onoffcanvas stylesheet -->
    <link rel="stylesheet" href="<?= base_url('assets/template/') ?>lib/onoffcanvas/onoffcanvas.css">

    <link rel="stylesheet/less" type="text/css" href="<?= base_url('assets/template/') ?>less/theme.less">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/less.js/2.7.1/less.js"></script>

</head>

<body class="  ">
    <div class="bg-dark dk" id="wrap">
        <div id="top">
            <header class="head">
                <div class="search-bar">

                    <h4>Admin Perpustakaan</h4>
                    <!-- /.main-search -->
                </div>
                <!-- /.search-bar -->
                <div class="main-bar">
                    <h3 id="TitleContent"></h3>
                </div>
                <!-- /.main-bar -->
            </header>
            <!-- /.head -->
        </div>
        <!-- /#top -->
        <div id="left">
            <div class="media user-media bg-dark dker">
                <div class="user-media-toggleHover">
                    <span class="fa fa-user"></span>
                </div>
                <div class="user-wrapper bg-dark d-flex padding-y-2">
                    <div class="user-link padding-x-3 d-flex align-items-start padding-top-3">
                        <i class="fas fa-user-alt icon-xl-title"></i>
                        <!-- <span class="label label-danger user-label">16</span> -->
                    </div>

                    <div class="media-body">
                        <h5 class="media-heading">Admin</h5>
                        <ul class="list-unstyled user-info">
                            <li><a href="">Administrator</a></li>
                            <li>Last Access : <br>
                                <small><i class="fa fa-calendar"></i>&nbsp;16 Mar 16:32</small>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #menu -->
            <ul id="menu" class="bg-dark dker">


                <li class="nav-header">MASTER</li>
                <li class="nav-divider"></li>
                <li class="">
                    <a href="<?= base_url('dashboard') ?>">
                        <i class="fa fa-dashboard"></i>&nbsp;Dashboard</span>
                    </a>
                </li>
                <li class="">
                    <a href="javascript:;">
                        <i class="fas fa-users micon"></i>&nbsp;
                        <span class="link-title">Akun</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="collapse">
                        <li>
                            <a href="<?= base_url('UserSiswa') ?>">Siswa </a>
                        </li>
                        <li>
                            <a href="<?= base_url('UserGuru') ?>">Guru </a>
                        </li>

                    </ul>
                </li>


                <li class="">
                    <a href="<?= base_url('buku') ?>">
                        <i class="fas fa-swatchbook micon"></i>&nbsp;Buku
                    </a>
                </li>
                <li class="">
                    <a href="<?= base_url('siswa') ?>">
                        <i class="fas fa-user-friends micon"></i>&nbsp;Siswa
                    </a>
                </li>
                <li class="">
                    <a href="<?= base_url('guru') ?>">
                        <i class="fas fa-user-friends micon"></i>&nbsp;Guru
                    </a>
                </li>

                <li class="">
                    <a href="<?= base_url('jurusan') ?>">
                        <i class="fas fa-clipboard-list micon"></i>&nbsp;Jurusan
                    </a>
                </li>

                <li class="">
                    <a href="<?= base_url('buku') ?>">
                        <i class="fas fa-swatchbook micon"></i>&nbsp;Buku
                    </a>
                </li>
                <li class="">
                    <a href="<?= base_url('kategori') ?>">
                        <i class="fas fa-bars micon"></i>&nbsp;Kategori Buku
                    </a>
                </li>
                <li class="">
                    <a href="<?= base_url('waktu') ?>">
                        <i class="fas fa-bars micon"></i>&nbsp;Waktu Pinjam
                    </a>
                </li>
                <li class="nav-header">Transaksi</li>
                <li class="nav-divider"></li>
                <li>
                    <a href="<?= base_url('pinjam') ?>">
                        <i class="fa fa-map-marker"></i>
                        Peminjaman Buku
                        </span>
                    </a>
                </li>

                <li class="nav-header">Laporan</li>
                <li class="nav-divider"></li>
                <li>
                    <a href="maps.html">
                        <i class="fa fa-map-marker"></i>
                        Laporan Peminjaman Buku
                        </span>
                    </a>
                </li>
            </ul>
            <!-- /#menu -->
        </div>
        <!-- /#left -->
        <div id="content">
            <div class="outer">
                <div class="inner bg-light lter" style=u-rn ''>
                    <?php $this->load->view($page) ?>
                </div>
            </div>
        </div>
    </div>
    <!-- /#content -->

    <div id="right" class="onoffcanvas is-right is-fixed bg-light" aria-expanded=false>
        <a class="onoffcanvas-toggler" href="#right" data-toggle=onoffcanvas aria-expanded=false></a>
        <br>
        <br>
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Warning!</strong> Best check yo self, you're not looking too good.
        </div>
        <!-- .well well-small -->
        <div class="well well-small dark">
            <ul class="list-unstyled">
                <li>Visitor <span class="inlinesparkline pull-right">1,4,4,7,5,9,10</span></li>
                <li>Online Visitor <span class="dynamicsparkline pull-right">Loading..</span></li>
                <li>Popularity <span class="dynamicbar pull-right">Loading..</span></li>
                <li>New Users <span class="inlinebar pull-right">1,3,4,5,3,5</span></li>
            </ul>
        </div>
        <!-- /.well well-small -->
        <!-- .well well-small -->

        <!-- /.well well-small -->
        <!-- .well well-small -->
        <div class="well well-small dark">
            <span>Default</span><span class="pull-right"><small>20%</small></span>

            <div class="progress xs">
                <div class="progress-bar progress-bar-info" style="width: 20%"></div>
            </div>
            <span>Success</span><span class="pull-right"><small>40%</small></span>

            <div class="progress xs">
                <div class="progress-bar progress-bar-success" style="width: 40%"></div>
            </div>
            <span>warning</span><span class="pull-right"><small>60%</small></span>

            <div class="progress xs">
                <div class="progress-bar progress-bar-warning" style="width: 60%"></div>
            </div>
            <span>Danger</span><span class="pull-right"><small>80%</small></span>

            <div class="progress xs">
                <div class="progress-bar progress-bar-danger" style="width: 80%"></div>
            </div>
        </div>
    </div>
    <!-- /#right -->
    </div>
    <!-- /#wrap -->
    <footer class="Footer bg-dark dker">
        <p>2017 &copy; Metis Bootstrap Admin Template v2.4.2</p>
    </footer>
    <!-- /#footer -->
    <!-- #helpModal -->
    <div id="helpModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Modal title</h4>
                </div>
                <div class="modal-body">
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore
                        et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                        aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
                        culpa qui officia deserunt mollit anim id est laborum.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <!-- /#helpModal -->


    <!--Bootstrap -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <!-- MetisMenu -->
    <script src="<?= base_url('assets/template/') ?>lib/metismenu/metisMenu.js"></script>
    <!-- onoffcanvas -->
    <script src="<?= base_url('assets/template/') ?>lib/onoffcanvas/onoffcanvas.js"></script>
    <!-- Screenfull -->
    <script src="<?= base_url('assets/template/') ?>lib/screenfull/screenfull.js"></script>
    <script src="<?= base_url('assets/plugin/snackbar/snackbar.min.js') ?>"></script>

    <!-- Metis core scripts -->
    <script src="<?= base_url('assets/template/') ?>js/core.js"></script>
    <!-- Metis demo scripts -->
    <script src="<?= base_url('assets/template/') ?>js/app.js"></script>
    <?php
    if (isset($js)) {
        foreach ($js as $list) : ?>
            <script src="<?= $list ?>"></script>
    <?php endforeach;
    } ?>
    <script>
        <?= $this->session->flashdata('pesan') ?>
    </script>
</body>

</html>