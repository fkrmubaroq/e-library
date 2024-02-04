<style>
    table tr {
        border: 1px solid transparent;
        border-collapse: collapse;
    }

    td {
        border: none;
    }
</style>
<?php

$qrCode = $this->qrcodelibrary->QRCode($transaksi->no_transaksi) ?>
<div class="container-fluid padding-bottom-7">

    <div class="row margin-top-5">
        <div class="col">
            <a href="<?= base_url('pinjam') ?>" class='text-dark' style="text-decoration:none">
                <h4><i class="fas fa-chevron-left"></i> Detail Peminjam</h4>
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-5">

            <div>

                <div class="card box-shadow border-radius no-border margin-top-3">
                    <div class="card-body">
                        <div class='d-flex margin-top-2 flex-column'>
                            <div class='d-flex flex-column'>
                                <img class="mx-auto" src="<?= $qrCode ?>" width=200>
                                <tt class='fweight-600 text-center font-italic' style='font-size:26px'><?= $transaksi->no_transaksi ?></tt>
                            </div>

                            <div class='margin-left-3'>
                                <table class='table'>
                                    <tr>
                                        <td class='fweight-600'>Nomor Transaksi</td>
                                        <td>:</td>
                                        <td><?= $transaksi->no_transaksi ?></td>
                                    </tr>
                                    <tr>
                                        <td class='fweight-600'>Nomor induk</td>
                                        <td>:</td>
                                        <td><?= $user['no_induk'] ?></td>
                                    </tr>
                                    <tr>
                                        <td class='fweight-600'>Nama Peminjam</td>
                                        <td>:</td>

                                        <td><?= $user['nama_user'] ?></td>
                                    </tr>
                                    <tr>
                                        <td class='fweight-600'>Hp/Telepon</td>
                                        <td>:</td>
                                        <td><?= $user['telp'] ?? "<span class='text-muted'>Belum diisi</span>" ?></td>
                                    </tr>
                                    <tr>
                                        <td class='fweight-600'>Total Pinjam Buku</td>
                                        <td>:</td>
                                        <td><?= $transaksi->total_pinjam_buku ?> Buku</td>
                                    </tr>

                                    <tr>
                                        <td class='fweight-600'>Tanggal Pinjam</td>
                                        <td>:</td>
                                        <td><?= $this->librari->TanggalToText($transaksi->tgl_transaksi) ?></td>
                                    </tr>
                                    <tr>
                                        <td class='fweight-600'>Status Pinjam</td>
                                        <td>:</td>
                                        <td><?= $transaksi->status == '2' ? "<span class='text-success'><i class='fas fa-check-circle'></i> ACC</span>" : "<i class='fas fa-sync-alt'></i> PROSES" ?></td>
                                    </tr>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-lg-7">
            <div class="margin-left-10">
                <div class="row padding-top-3">
                    <div class="col">
                        <h4>Buku yang dipinjam</h4>
                    </div>
                </div>
                <div class="row padding-y-3">
                    <?php foreach ($collections as $list) :
                        $date = strtotime($list['tgl_transaksi']);
                        $tglTransaksi = strtotime(date('Y-m-d', $date));
                        $status = $list['status'] == '1' ? "<div class='btn btn-primary btn-sm'><i class='lni lni-reload'></i> Proses</div>" : "<div class='btn btn-success btn-sm'><i class='text-white lni lni-checkmark-circle'></i> <span class='text-white'>Disetujui</span></div>";

                        // qrcode

                        $tglBerakhir = strtotime($list['tgl_berakhir']);
                        $lamaPinjam = ($tglBerakhir - $tglTransaksi) / 60 / 60 / 24;
                        $now = strtotime(date('Y-m-d'));

                        $sisaHari = ($tglBerakhir - $now) / 60 / 60 / 24;
                        $viewSisa = "<div class='badge text-right text-muted fweight-400' style='width:85px'>{$sisaHari} Hari lagi</div>";
                        // kalo waktu pinjam buku habis
                        if ($sisaHari == 0) {
                            $tglBerakhirJam =  strtotime($list['tgl_berakhir'] . ' 24:00:00');
                            $nowWithJam = strtotime(date('Y-m-d H:i:s'));

                            // kalo sisa tinggal beberapa jam
                            $sisaJam = ceil(abs($tglBerakhirJam - $nowWithJam) / (60 * 60));
                            $viewSisa = "<div class='text-muted'> <i class='lni lni-timer'></i> <div class='badge badge-pill' >{$sisaJam} jam lagi</div> </div>";


                            // kalo sisa tinggal beberapa menit
                            if ($sisaJam == 1) {
                                $sisaJam = ceil(abs($tglBerakhirJam - $nowWithJam) / 60);
                                $viewSisa = "<div class='text-muted'> <i class='lni lni-timer'></i> <div class='badge badge-pill' >{$sisaJam} menit lagi</div> </div>";

                                if (($tglBerakhirJam - $nowWithJam) <= 0) {
                                    $viewSisa = "<div class='text-success'> <i class='lni lni-timer'></i> <div class='badge badge-pill' >Waktu telah habis</div> </div>";
                                    $timeup = true;
                                }
                            }
                        }
                    ?>
                        <div class="col-lg-12 margin-bottom-2">
                            <div class='d-flex'>
                                <div>
                                    <img src="<?= base_url('assets/uploads/files/buku/cover/' . $list['cover']) ?>" width=100>
                                </div>
                                <div class='margin-bottom-2 margin-left-5'>
                                    <div class='text-md-1 fweight-600'><?= $list['nama_buku'] ?></div>
                                    <div class='text-sm-4 text-muted'><?= $list['penulis'] ?></div>

                                    <div class='d-flex '>
                                        <div class='d-flex flex-column margin-top-2'>
                                            <div class='fweight-600'>Lama Pinjam</div>
                                            <div class='text-muted'><?= $lamaPinjam ?> Hari</div>
                                        </div>
                                        <div class='d-flex flex-column margin-top-2 margin-left-7'>
                                            <div class='fweight-600'>Hangus Sampai</div>
                                            <div class='text-muted'><?= $this->librari->TanggalToText($list['tgl_berakhir'], false) ?></div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

            </div>
        </div>

        <div class='w-100 text-right margin-right-3'>
            <?php if ($transaksi->status == '2') : ?>
                <a href="<?= base_url('pinjam/batalacc/' . $this->secure->encode([$transaksi->no_transaksi, $transaksi->id])) ?>" class='btn btn-danger btn-md'>BATAL ACC</a>
            <?php else : ?>
                <a href="<?= base_url('pinjam/acc/' . $this->secure->encode([$transaksi->no_transaksi, $transaksi->id])) ?>" class='btn btn-primary btn-md'>ACC PINJAM</a>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    $('#TitleContent').html('&nbsp; Data Peminjaman Buku')
</script>