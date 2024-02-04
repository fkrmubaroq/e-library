<div class="container padding-y-10">
    <?php
    if ($status_code != 200) : ?>
        <div class="row">
            <div class="col">
                <div class='text-center'>
                    <br /><br />
                    <img src="<?= base_url('assets/img/undraw-book.svg') ?>" width=600>
                    <div class='margin-top-7 text-md-2'>Anda belum melakukan transaksi</div>
                </div>
            </div>
        </div>

    <?php
        exit(1);
    endif; ?>
    <div class="row">
        <div class="col">

            <h4>Riwayat Transaksi</h4>
            <div class="accordion" id="accordionExample">
                <?php
                foreach ($collections as $list) :
                    $date = strtotime($list['tgl_transaksi']);
                    $tglTransaksi = strtotime(date('Y-m-d', $date));
                    $status = $list['status'] == '1' ? "<div class='btn btn-primary btn-sm'><i class='lni lni-reload'></i> Proses</div>" : "<div class='btn btn-success btn-sm'><i class='text-white lni lni-checkmark-circle'></i> <span class='text-white'>Disetujui</span></div>";

                    // qrcode
                    $qrCode = $this->qrcodelibrary->QRCode($list['no_transaksi']);

                ?>


                    <div class="card  no-border box-shadow">
                        <div class="card-header bg-warning no-border text-white hover-pointer" data-toggle="collapse" data-target="#collapse<?= $list['no_transaksi'] ?>">

                            <div class='d-flex justify-content-between'>
                                <div class='d-flex'>
                                    <div class='d-flex flex-column text-center  fweight-600'>
                                        <div class='text-md-1'><?= date('d') ?></div>
                                        <div class='text-md-1'> <?= substr(date('M'), 0, 3) ?></div>
                                    </div>
                                    <div class='margin-left-5' style="border-left:2px solid black; opacity:0.6"></div>

                                    <div class='d-flex w-100 margin-left-4 flex-column'>
                                        <div class='text-sm-4 text-muted fweight-500'>No.Transaksi</div>
                                        <div class='text-md-2 fweight-700'> <?= $list['no_transaksi'] ?></div>
                                    </div>

                                </div>

                                <div class='d-none d-xs-none d-sm-none d-md-block d-lg-block d-xl-block'>
                                    <div class='d-flex  align-items-center margin-top-2'>
                                        <div class='text-md-1 fweight-600 text-dark margin-top-1'><?= $status ?></div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div id="collapse<?= $list['no_transaksi'] ?>" class="collapse show">
                            <div class="card-body px-0">

                                <?php
                                foreach ($list['detail_pinjam'] as $detailList) :

                                    $timeup = false;
                                    $tglBerakhir = strtotime($detailList['tgl_berakhir']);
                                    $lamaPinjam = ($tglBerakhir - $tglTransaksi) / 60 / 60 / 24;
                                    $now = strtotime(date('Y-m-d'));

                                    $selisihHari = round(($tglBerakhir - $now) / (60 * 60 * 24));

                                    if ($selisihHari <= 0)
                                        $timeup = true;

                                ?>
                                    <div class="media hover-pointer-bg padding-y-2 padding-x-4">
                                        <img src="<?= base_url('admin/assets/uploads/files/buku/cover/' . $detailList['cover']) ?>" class="align-self-start" width=100>
                                        <div class="media-body margin-left-7">
                                            <div class='d-flex justify-content-between flex-wrap'>
                                                <div>
                                                    <h6 class='fweight-600 mb-0'><?= $detailList['nama_buku'] ?></h6>
                                                    <h6 class='text-muted margin-top-1 '><?= $detailList['penulis'] ?></h6>

                                                    <div class='d-flex flex-column margin-top-2'>
                                                        <div class="margin-top-3">
                                                            <span class='fweight-600'>Hangus sampai</span> <br />
                                                            <div class='text-muted  '>
                                                                <i class="lni lni-calendar"></i> <?= $this->librari->TanggalToText($detailList['tgl_berakhir'], false) ?>
                                                            </div>
                                                        </div>

                                                        <div class='margin-top-2'>
                                                            <?= $timeup == true ? "<span class='text-danger'>Waktu pinjam telah berakhir</span>" : ""; ?>
                                                        </div>

                                                    </div>


                                                </div>

                                                <div class='d-flex flex-column justify-content-center'>
                                                    <div class='text-center text-muted'><?= $lamaPinjam ?> Hari</div>

                                                    <?php if ($timeup == false && $list['status'] == '2') : ?>
                                                        <div class='margin-top-2 text-center'>
                                                            <a class='btn btn-warning btn-sm text-light fweight-600' href="<?= base_url("baca/{$detailList['slug_nama_buku']}") ?>">Baca buku</a>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>

                                            </div>
                                        </div>

                                    </div>

                                <?php endforeach; ?>
                                <hr class='margin-x-3'>
                                <div class='d-flex justify-content-center'>
                                    <div class='padding-right-3 d-flex flex-column justify-content-center text-center'>
                                        <h5>Scan ME</h5>
                                        <img src="<?= $qrCode ?>" width='150'>
                                        <tt class='text-md-2'><?= $list['no_transaksi'] ?></tt>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                <?php endforeach;
                ?>
            </div>

        </div>
    </div>
</div>
<br /><br /><br />