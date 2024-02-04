<div class="products-catagories-area clearfix">
    <div class="clearfix padding-bottom-10 ">
        <div class="container">
            <div class="row">
                <div class="col">
                    <?php if (!isset($_SESSION['items']) && @count($_SESSION['items']) <= 0) : ?>
                        <div class='text-center'>
                            <br /><br />
                            <h2 class='fweight-600'>OPPSSS</h2>
                            <img src="<?= base_url('assets/img/undraw-book.svg') ?>" width=600>
                            <div class='margin-top-7 text-md-2'>Anda belum memilih buku</div>
                            <a href="<?= base_url() ?>" class='btn btn-warning text-white rounded-pill margin-top-3'>Koleksi Buku</a>
                        </div>
                    <?php
                    else : ?>
                        <div class="d-flex justify-content-between flex-wrap">
                            <a href="<?= base_url() ?>">
                                <h4 class='hover-pointer'> <i class="lni lni-chevron-left "></i> Keranjang Buku</h4>
                            </a>

                            <div class='d-flex align-items-end text-muted fweight-600'>
                                <div class='margin-left-1'>Maksimal peminjaman 3 Buku</div>
                            </div>
                        </div>
                        <table class='table margin-top-4'>
                            <?php foreach ($_SESSION['items'] as $key => $list) :
                                $deskripsi = $list['deskripsi'];
                                if (strlen($deskripsi) > 500)
                                    $deskripsi = substr($deskripsi, 0, 500) . '...';
                            ?>
                                <tr>
                                    <td class='text-center'><img src="<?= base_url('admin/assets/uploads/files/buku/cover/' . $list['cover']) ?>" style="width:100px; height:150px; object-fit:cover"></td>
                                    <td style="vertical-align:center" width="70%">
                                        <div class='d-flex flex-column'>
                                            <a href="<?= base_url('buku/' . $list['slug_nama_buku']) ?>">
                                                <h6>
                                                    <?= $list['nama_buku'] ?>
                                                </h6>
                                            </a>
                                            <div class="text-muted d-none d-xs-none d-sm-none d-md-none d-lg-block d-xl-block text-justify text-sm-4"><?= strip_tags($deskripsi) ?? 'Tidak ada sinopsis' ?></div>
                                            <div></div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class='d-flex align-content-center'>
                                            <?= $list['waktu_pinjam'] ?> Hari
                                        </div>
                                    </td>

                                    <td>
                                        <a href="<?= base_url('pinjam/remove/' . $list['id']) ?>" onclick="return confirm('apakah anda yakin?')">
                                            <i class="lni lni-close icon-secondary text-muted"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                        <div class='d-flex justify-content-end padding-bottom-10'>
                            <a href="<?= base_url('checkout_proses') ?>" class='btn btn-warning rounded-pill text-white padding-x-4'>Checkout</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    </div>
</div>