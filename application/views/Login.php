<style>
    .box-shadow {
        box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px !important;
    }
</style>
<div class="products-catagories-area clearfix" style="margin-top:7rem">
    <div class="clearfix padding-bottom-10 ">
        <div class="container-fluid margin-top-9">
            <div class="row">
                <div class="offset-1 col-lg-5 d-none d-xs-none d-sm-none d-md-none d-lg-block d-xl-block">
                    <img src="<?= base_url('assets/img/undraw-login.svg') ?>" width=600>
                </div>
                <div class="col-lg-4 col-xs-12 col-sm-12 col-md-12 col-xl-4 d-flex align-items-center">
                    <div class="card no-border border-radius box-shadow w-100">
                        <div class="card-body padding-x-8 padding-top-5 padding-bottom-9">
                            <h5 class="card-title fweight-600 text-center">Masuk</h5>
                            <form method='POST' autocomplete="off" id='StoreLogin' class='margin-top-5'>

                                <!-- USERNAME -->
                                <div class="form-group margin-bottom-5">
                                    <label for="username" class="placeholder text-muted fweight-600">NISN</label>
                                    <input id="username" name="username" type="text" class="form-control" required placeholder="Masukan NISN">
                                </div>
                                <!-- /USERNAME -->

                                <!-- PASSWORD -->
                                <div class="form-group">
                                    <label for="password" class="placeholder text-muted fweight-600">Password</label>
                                    <div class="position-relative">
                                        <input id="password" placeholder='Masukan password' name="password" type="password" class="form-control" required>
                                        <div class="show-password">
                                            <i class="flaticon-interface"></i>
                                        </div>
                                    </div>
                                </div>
                                <!-- /PASSWORD -->
                                <i class='text-danger' id='error-message'></i>
                                <div class="form-group form-action-d-flex mt-2">
                                    <div class='d-flex justify-content-between'>
                                        <div class="custom-control custom-checkbox margin-bottom-3">
                                            <input type="checkbox" class="custom-control-input" id="rememberme">
                                            <label class="custom-control-label m-0" for="rememberme">Ingatkan saya</label>
                                        </div>

                                        <div>
                                            <a href="" class='text-info'>Daftar Akun</a>
                                        </div>
                                    </div>
                                    <button name='login' class="btn btn-warning text-white btn-block fweight-600">Masuk</button>

                                </div>


                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>