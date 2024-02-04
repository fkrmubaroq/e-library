<?php
if ($status_code != 200) :  ?>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class='text-center'>
                    <br /><br />
                    <h2 class='fweight-600'>OPPSSS</h2>
                    <img src="<?= base_url('assets/img/undraw-book.svg') ?>" width=600>
                    <div class='margin-top-7 text-md-2'><?= $message ?></div>
                    <a href="<?= base_url() ?>" class='btn btn-warning text-white rounded-pill margin-top-3'>Kembali</a>
                </div>
            </div>
        </div>
    </div>

<?php exit(1);
endif;

$namaUser = ($collection->gelar_depan ?? '') . ($collection->nama_user ?? '') . ($collection->gelar_belakang ?? '');
?>


<div class="container margin-y-10">
    <div class="row">


        <!-- INFO -->
        <div class="col-lg-8 offset-2">
            <div class="card box-shadow no-border">
                <div class="card-header bg-warning text-white">
                    <div class="text-md-2">Profil</div>
                </div>
                <div class="card-body">
                    <div class=' d-flex align-items-center'>

                        <div class='margin-left-3 text-center'>
                            <div class='w-100 text-center'>
                                <i class="lni lni-user icon-xxl-title"></i>
                            </div>
                        </div>
                        <div class='w-100'>

                            <div class='row padding-3'>
                                <div class="col-lg-3 fweight-700 text-right">NO INDUK</div>
                                <div class="col-lg-8"><?= $collection->no_induk ?></div>
                            </div>

                            <div class='row padding-3'>
                                <div class="col-lg-3 fweight-700 text-right">Nama</div>
                                <div class="col-lg-8"><?= $namaUser ?></div>
                            </div>

                            <div class='row padding-3'>
                                <div class="col-lg-3 fweight-700 text-right">Alamat </div>
                                <div class="col-lg-8"><?= $collection->alamat ?></div>
                            </div>

                            <div class='row padding-3'>
                                <div class="col-lg-3 fweight-700 text-right">Telepon</div>
                                <div class="col-lg-8"><?= $collection->telp ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card box-shadow no-border margin-top-3">
                <div class="card-header bg-warning text-white">
                    <div class="text-md-2">Akun</div>
                </div>
                <div class="card-body">

                    <div class='row padding-3'>
                        <div class="col-lg-3 fweight-700 text-right">Username</div>
                        <div class="col-lg-8"><?= $collection->username ?></div>
                    </div>

                    <div class='row padding-3'>
                        <div class="col-lg-3 fweight-700 text-right">Status Akun</div>
                        <div class="col-lg-8"><?= $collection->is_aktif == '1' ? "<span class='text-success fweight-500'>AKTIF</span>" : 'BANNED' ?></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- INFO -->

    </div>
</div>