<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Aplikasi Broadcast E-mail" />
    <meta name="author" content="CV DIAN GLOBAL TECH" />
    <meta name="url" content="<?= base_url() ?>" />

    <title>Login - Aplikasi Broadcast Email </title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>

    <link href="<?= base_url('assets/template/css/styles.css') ?>" rel="stylesheet" />
    <link rel="stylesheet" href="<?= base_url('assets/plugin/toastr/toastr.css') ?>">

    <style>
        .bg-hideng {
            background-image: linear-gradient(to right, #434343 0%, black 100%);
        }
    </style>
</head>

<body class="bg-hideng">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <br /><br />

                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <br /><br />

                            <img src="<?= base_url('assets/images/sesko.png') ?>" alt="">
                        </div>
                        <div class="col-lg-5">
                            <h3 class="text-center font-weight-light text-white">APLIKASI BROADCAST EMAIL</h3>
                            <h5 class="text-center font-weight-light text-white">SESKO TNI</h5>
                            <div class="card shadow-lg border-0 rounded-lg mt-4">
                                <div class="card-header" style="border:1px solid transparent;">
                                    <h3 class="text-center font-weight-light ">Login</h3>
                                    <div class='text-center text-size--1 text-muted'>masukan username dan password</div>
                                </div>
                                <div class="card-body">
                                    <form method='POST' action="<?= base_url('login/action') ?>">
                                        <div class="form-group">
                                            <label class="small mb-1" for="inputUsername">Username</label>
                                            <input class="form-control py-4" id="inputUsername" name="username" type="text" placeholder="Masukan Username" />
                                        </div>
                                        <div class="form-group">
                                            <label class="small mb-1" for="inputPassword">Password</label>
                                            <input class="form-control py-4" id="inputPassword" type="password" name="password" placeholder="Enter password" />
                                        </div>

                                        <div class="form-group d-flex align-items-center justify-content-end mt-4 mb-0">
                                            <button type='submit' class="btn btn-primary">Login</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-3 bg-light mt-auto">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">COPYRIGHT &copy; SESKO TNI - APLIKASI BROADCAST EMAIL 2020</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="<?= base_url('assets/grocery_crud/js/jquery-1.11.1.min.js') ?>"></script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="<?= base_url('assets/template/js/script.js') ?>"></script>
    <?= $this->session->flashdata('pesan') ?>

</body>

</html>