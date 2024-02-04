<style>
    table {
        border-collapse: unset;
    }
</style>
<?php
$status = "<span class='badge badge-pill bg-warning text-white padding-x-3'>PROSES</span>";
if ($collections->status == '2')
    $status = "<span class='badge badge-pill bg-success text-white padding-x-3'>ACC</span>";

?>
<div class="products-catagories-area clearfix">
    <div class="container">
        <div class="clearfix padding-bottom-10 ">
            <div class="row">
                <div class="col-lg-4  margin-top-3">
                    <div class="card box-shadow no-border border-radius">
                        <div class="card-body">
                            <img src="<?= $qrcode ?>" alt="">
                        </div>
                    </div>

                    <a id='beranda' href="<?= base_url() ?>" class='btn btn-primary btn-block margin-top-3 d-none d-xs-none d-sm-none d-md-block d-lg-block d-xl-block'>
                        <i class="lni lni-chevron-left"></i>
                        Beranda
                    </a>
                </div>
                <div class="col-lg-8  margin-top-3">
                    <div class="card box-shadow no-border border-radius">
                        <div class="card-header bg-white  border-radius-top">
                            <div class='d-flex justify-content-between flex-wrap'>
                                <div class='d-flex align-items-center'>
                                    <div>
                                        <img src="<?= base_url('assets/img/logo.png') ?>" width="40" alt="">
                                    </div>
                                    <div class='margin-left-3'>
                                        <h5 class=' text-dark'>
                                            Nomor Pinjam
                                        </h5>
                                        <div class='text-md-1 text-muted fweight-600'><?= $collections->no_transaksi ?></div>
                                    </div>
                                </div>
                                <div>
                                    <div class='text-md-1 text-dark'><?= $status ?></div>
                                    <div class='margin-top-3 float-right margin-right-1'>
                                        <a href="<?= base_url('print/' . $no_transaksi) ?>" class='rounded-pill padding-x-3 padding-y-1 text-sm-3 btn btn-outline-primary'><i class="lni lni-printer"></i> Print</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-body d-flex flex-column">

                            <div class='d-none d-xs-none d-sm-none d-md-block d-lg-block d-xl-block'>
                                <div class="row padding-2">
                                    <div class="col-lg-4 text-right fweight-600">Nomor Induk</div>
                                    <div class='col-lg-8'><?= $collections->no_induk ?></div>
                                </div>
                                <div class="row padding-2">
                                    <div class="col-lg-4 text-right fweight-600">Nama Peminjam</div>
                                    <div class='col-lg-8'><?= $collections->nama_user ?></div>
                                </div>
                                <div class="row padding-2">
                                    <div class="col-lg-4 text-right fweight-600">Total Pinjam</div>
                                    <div class='col-lg-8'><?= $collections->total_pinjam_buku ?> Buku</div>
                                </div>
                                <div class="row padding-2">
                                    <div class="col-lg-4 text-right fweight-600">Tanggal Pinjam</div>
                                    <div class='col-lg-8'><?= $this->librari->TanggalToText($collections->tgl_transaksi) ?></div>
                                </div>
                            </div>

                            <div class='d-xs-block d-sm-block d-md-none d-lg-none d-xl-none'>
                                <div class="row padding-2">
                                    <div class="col-lg-4 text-left fweight-600">Nomor Induk</div>
                                    <div class='col-lg-8'><?= $collections->no_induk ?></div>
                                </div>
                                <div class="row padding-2">
                                    <div class="col-lg-4 text-left fweight-600">Nama Peminjam</div>
                                    <div class='col-lg-8'><?= $collections->nama_siswa ?></div>
                                </div>
                                <div class="row padding-2">
                                    <div class="col-lg-4 text-left fweight-600">Total Pinjam</div>
                                    <div class='col-lg-8'><?= $collections->total_pinjam_buku ?> Buku</div>
                                </div>
                                <div class="row padding-2">
                                    <div class="col-lg-4 text-left fweight-600">Tanggal Pinjam</div>
                                    <div class='col-lg-8'><?= $this->librari->TanggalToText($collections->tgl_transaksi) ?></div>
                                </div>
                            </div>
                            <div class="row padding-2">
                                <div class="col">
                                    <div style='border-top:1px solid #ddd'></div>
                                </div>
                            </div>
                            <div class="row padding-2">
                                <div class="col-lg-4 d-none d-xs-none d-sm-none d-md-block d-lg-block d-xl-block text-right ">
                                    <div class="fweight-600">Buku Pinjam</div>
                                </div>
                                <div class='col-lg-4 d-xs-block d-sm-block d-md-none d-lg-none d-xl-none text-left'>
                                    <div class=" fweight-600">Buku Pinjam</div>
                                </div>
                                <div class='col-lg-8'>
                                    <table class='table borderless'>
                                        <?php
                                        foreach ($pinjam as $list) :
                                        ?>
                                            <tr>
                                                <td colspan=2 class='pt-0 pl-0  d-flex flex-column'>
                                                    <div>
                                                        <a class='text-info fweight-600 text-sm-4' href="<?= base_url('buku/' . $list['slug_nama_buku']) ?>">
                                                            <?= $list['nama_buku'] ?>
                                                        </a>
                                                    </div>
                                                    <div class='text-muted text-sm-3'>Berakhir pada <?= $this->librari->TanggalToText($list['tgl_berakhir'], false) ?></div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>

                                    </table>

                                </div>
                            </div>
                            <div class="row padding-bottom-4">
                                <div class="col text-center font-italic text-muted">
                                    Buku yang dipinjam akan hangus otomatis sesuai waktu lama pinjam buku

                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div style='border-top:1px solid #ddd'></div>
                                </div>
                            </div>

                            <div class="row margin-top-2">
                                <div class="col">
                                    <b>Keterangan</b> <br />
                                    <ol>
                                        <li class='text-muted margin-top-2'>
                                            Simpan atau screenshoot halaman ini untuk di serahkan ke perpustakaan SMK Merdeka
                                        </li>
                                    </ol>

                                </div>
                            </div>

                        </div>
                    </div>
                    <a href="<?= base_url() ?>" class='btn btn-primary btn-block margin-top-3 d-xs-block d-sm-block d-md-none d-lg-none d-xl-none'>
                        <i class="lni lni-chevron-left"></i>
                        Beranda
                    </a>
                </div>
            </div>
        </div>
        <br /><br /><br /><br />
    </div>
</div>
</div>