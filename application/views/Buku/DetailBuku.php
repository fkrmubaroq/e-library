<div class="products-catagories-area clearfix">
    <div class="clearfix padding-bottom-10 ">
        <?php

        // kalo bukunya kosong
        if ($count_buku <= 0) : ?>
            <div class="row">
                <div class="col text-center">
                    <h3>Buku tidak ditemukan</h3>
                </div>
            </div>
        <?php else : ?>
            <div class="container margin-top-5">
                <div class="row margin-bottom-2">
                    <div class="col">
                        <a href="<?= base_url() ?>">
                            <h4 class='hover-pointer'> <i class="lni lni-chevron-left "></i> Daftar Buku</h4>
                        </a>
                    </div>
                </div>
                <div class="row">

                    <!-- COVER -->
                    <div class="col-lg-5 col-sm-12 col-xs-12 col-md-6">
                        <img class="box-shadow" src="<?= base_url('admin/assets/uploads/files/buku/cover/' . $collections_buku->cover) ?>" style="width:12.7cm; height:20.32cm;">
                    </div>
                    <!-- COVER -->

                    <!-- DESCRIPTION -->
                    <div class="col-lg-7 padding-right-5">
                        <div class='d-flex flex-column'>
                            <h2><?= $collections_buku->nama_buku ?></h2>
                            <div id='IdBuku' data-id="<?= $this->secure->encode($collections_buku->id) ?>"></div>
                            <!-- DESC -->
                            <div class=' margin-top-2 text-justify'>
                                <div class='text-sm-4 text-muted'>
                                    <?= strip_tags($collections_buku->deskripsi) ?>
                                </div>
                            </div>
                            <!-- /DESC -->

                            <!-- INFO -->
                            <div class='margin-top-4'>
                                <div class="row margin-top-1">
                                    <div class="col-lg-3 fweight-600">PENULIS</div>
                                    <div class="col-lg-6"><?= $collections_buku->penulis ?></div>
                                </div>
                                <div class="row margin-top-1">
                                    <div class="col-lg-3 fweight-600">HALAMAN</div>
                                    <div class="col-lg-6"><?= $this->librari->CountPagesPdf("admin/assets/uploads/files/buku/{$collections_buku->file}") ?> Lembar</div>
                                </div>

                                <div class="row margin-top-1">
                                    <div class="col-lg-3 fweight-600">TAHUN TERBIT</div>
                                    <div class="col-lg-6"><?= $collections_buku->tahun ?></div>
                                </div>

                                <div class="row margin-top-1">
                                    <div class="col-lg-3 fweight-600">BAHASA</div>
                                    <div class="col-lg-6"><?= $collections_buku->bahasa ?></div>
                                </div>
                                <div class="row margin-top-1">
                                    <div class="col-lg-3 fweight-600">DIPINJAM</div>
                                    <div class="col-lg-6">0 dari <?= $collections_buku->stok ?></div>
                                </div>
                                <div class="row margin-top-2">
                                    <div class="col-lg-3 fweight-600">LAMA PINJAM</div>
                                    <div class="col-lg-7">
                                        <?php foreach ($collections_waktupinjam as $list) : ?>
                                            <span class='hover-pointer badge badge-pill bg-muted padding-y-1 padding-x-3 lama-pinjam' data-value="<?= $list['hari'] ?>"><?= $list['hari'] ?> Hari</span>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <div class="row margin-top-3">
                                    <div class="col-lg-3 fweight-600">EDISI</div>
                                    <div class="col-lg-6"><span class='hover-pointer badge badge-pill badge-info padding-y-1 padding-x-2'>Buku Digital</span></div>
                                </div>

                                <div class="row margin-top-2">
                                    <div class="col-lg-6 ">
                                        <a class='text-info fweight-600' href="<?= base_url('baca/' . $collections_buku->slug_nama_buku) ?>">Lihat buku</a>
                                    </div>
                                </div>
                            </div>
                            <!-- /INFO -->

                            <!-- RATING -->
                            <div class='margin-top-5 d-flex justify-content-between'>
                                <div>
                                    <h5 class='fweight-600'>Rating <span id='rate'><?= number_format($rating / 10, 1) ?></span>/10</h5>
                                    <div class="pl-0 rate-book"></div>
                                </div>

                                <div>

                                </div>
                            </div>
                            <!-- /RATING -->

                            <!-- BUTTON -->
                            <div class='margin-top-7'>
                                <div class='d-flex flex-wrap'>
                                    <a class='btn btn-warning text-white rounded-pill padding-x-5 margin-right-2 fweight-600' href="#" id="PinjamBuku" data-slug="<?= $collections_buku->slug_nama_buku ?>">Pinjam Buku</a>
                                    <button class='btn btn-outline-dark rounded-pill padding-x-5 margin-right-2 tool-tip' id='BeriRating'>
                                        <i class="lni lni-star"></i>
                                        Beri Rating
                                        <span class="tooltiptext">
                                            <div class="pl-0 rating-book"></div>
                                        </span>
                                    </button>

                                </div>
                            </div>
                            <!-- /BUTTON -->


                        </div>
                    </div>
                    <!-- DESCRIPTION -->

                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

</div>