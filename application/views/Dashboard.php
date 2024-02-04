<div class="products-catagories-area clearfix">
    <div class="container">
        <div class='row'>
            <div class="col">
                <h4>Koleksi Buku</h4>
                <div class="amado-pro-catagory clearfix">

                    <div class="row">
                        <?php
                        $duration = 300;
                        $multiply = 1;
                        $counter = 0;
                        foreach ($collections as $list) :
                        ?>
                            <div class="col-lg-4 margin-bottom-4">
                                <div class="card h-100 box-shadow border-radius" data-aos="zoom-in" data-aos-anchor="#cover" data-aos-duration="<?= ($duration * $multiply++) ?>">
                                    <img class="card-img-top border-radius-top " src=" <?= base_url('admin/assets/uploads/files/buku/cover/' . $list['cover']) ?>" style="height:300px; object-fit:cover; border-">
                                    <div class="card-body pb-0" style="opacity:0.8">
                                        <a href="<?= base_url('buku/' . $list['slug_nama_buku']) ?>">
                                            <div class="card-title fweight-600 text-md-1 text-dark" style="line-height:1.2;"><?= $list['nama_buku'] ?></div>
                                        </a>
                                        <div class="card-subtitle text-muted"><?= $list['penulis'] ?></div>
                                    </div>
                                    <div class="card-footer padding-bottom-4 padding-top-3 no-border bg-white border-radius d-flex justify-content-between flex-wrap" style="opacity:0.8">
                                        <div class=' d-flex' style='margin-top:3px'>
                                            <i class="lni lni-users icon-secondary"></i>
                                            <div class='text-sm-3 margin-left-1'>1.900 pembaca</div>
                                        </div>
                                        <div class='margin-left-3'>
                                            <i class="lni lni-star-filled icon-secondary text-warning"></i>
                                            <span class='text-sm-3 fweight-600'>Rating <?= number_format($list['rating'] / 10, 1) ?>/10</span>
                                        </div>

                                    </div>
                                </div>
                            </div>


                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Product Catagories Area End -->
</div>