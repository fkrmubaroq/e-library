<div class="container-fluid">
    <h3 class="mt-4">Tambah Lowongan</h3>
    <ol class="breadcrumb mb-4 d-flex justify-content-between align-content-center">
        <div class='d-flex'>
            <li class="breadcrumb-item pt-2"><a href="<?= base_url() ?>">Dashboard</a></li>
            <li class="breadcrumb-item pt-2 active"> Tambah Lowongan</li>
        </div>
        <li class='f'>
            <span>
                <a href="<?= base_url('posting/add') ?>" class='btn btn-primary'>
                    <i class="fas fa-bullhorn"></i>
                    Posting
                </a>
            </span>
        </li>
    </ol>

    <div class="row">
        <div class="col-lg-3">
            <div class="card card-shadow no-border padding-y-3 padding-x-4  border-radius">
                <div class="card-body paddding-x-4">
                    <h5 class="card-title fweight-600">
                        Partner Perusahaan
                    </h5>
                    <h6 class="card-subtitle mb-2 text-muted">isi kolom partner perusahaan dibawah dengan benar </h6>
                    <div class="row">
                        <div class="col d-flex flex-column margin-top-4">
                            <div class='d-flex justify-content-center  margin-top-4'>
                                <i class="fas fa-city text-muted" style="font-size:150px"></i>
                            </div>

                            <label class='text-muted fweight-500 margin-top-5'>Partner</label>
                            <select class='partner-select2 w-100' name="id_partner">
                                <option value="">- Pilih Partner - </option>
                                <?php
                                foreach ($partner as $list) : ?>
                                    <option value="<?= $list['id'] ?>" data-image='<?= $list['logo'] ?>'><?= $list['nama_partner'] ?></option>
                                <?php endforeach;
                                ?>
                            </select>


                            <div class='margin-top-4'>
                                <div class="form-group">
                                    <label class='text-muted fweight-500'>Untuk jurusan</label>
                                    <select class='jurusan-select2 w-100' name="id_jurusan">
                                        <option value="">- Pilih Jurusan - </option>
                                        <?php
                                        foreach ($jurusan as $list) : ?>
                                            <option value="<?= $list['id'] ?>"><?= $list['nama_jurusan'] ?></option>
                                        <?php endforeach;
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class='margin-top-2'>
                                <div class="form-group">
                                    <label class='text-muted fweight-500'>Posisi</label>
                                    <input type="text" class='form-control' name='possisi' placeholder="IT Support">
                                </div>
                            </div>
                            <div class='margin-top-2'>
                                <div class="form-group">
                                    <label class='text-muted fweight-500'>Lokasi</label>
                                    <input type="text" class='form-control' name='lokasi' placeholder="Bandung">
                                </div>
                            </div>

                            <div class='margin-top-2'>
                                <div class="form-group">
                                    <label class='text-muted fweight-500'>Range Gaji</label>
                                    <input type="text" class="js-range-slider" name="my_range" value="" />
                                </div>
                            </div>

                            <div class='margin-top-2'>
                                <div class="form-group">
                                    <label class='text-muted fweight-500'>Tanggal pendaftaran</label>
                                    <input type="text" name="tanggal_pendaftaran" class='form-control' placeholder="<?= date('d/m/Y') . ' - ' . date('d/m/Y') ?>" id="datepicker" />
                                </div>
                            </div>
                            <div class='margin-top-2'>
                                <div class="form-group">
                                    <label class='text-muted fweight-500'>Jenis Pekerjaan</label>
                                    <select class='form-control w-100' name="id_jurusan">
                                        <option value="">- Jenis Pekerjaan - </option>

                                        <option value="FULLTIME">FULLTIME</option>
                                        <option value="PARTIME">PART TIME</option>
                                        <option value="REMOTE">REMOTE</option>

                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- COLUMN 2 -->
        <div class="col-lg-9">

            <div class="row">
                <div class="col-lg-6">
                    <div class="card card-shadow no-border padding-y-3 padding-x-4  border-radius">
                        <div class="card-body">
                            <h5 class="card-title fweight-600">Kualifikasi / Persyaratan</h5>
                            <div id="persyaratan">
                                <ol>
                                    <li>Maksimal Usia 30 Tahun</li>
                                    <li>Fresh Graduate are Welcome</li>
                                    <li>Memiliki Kemampuan Komunikasi yang Baik</li>
                                    <li>Mampu Bekerja Dalam Tim</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card card-shadow no-border padding-y-3 padding-x-4  border-radius">
                        <div class="card-body">
                            <h5 class="card-title fweight-600">Tugas / --------------Tanggung jawab</h5>
                            <div id="description">
                                <ul>
                                    <li>Membangun hubungan yang baik dengan seluruh Customer Orderonline.id</li>
                                    <li>Menjaga Customer agar tetap menggunakan OrderOnline.id</li>
                                    <li>Memberikan solusi dari masalah-masalah yang dihadapi Customer</li>
                                    <li>Mengumpulkan feedback dari Customer dalam bentuk kuisioner dan phone call</li>

                                </ul>

                            </div>

                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

    <div style="height: 100vh;"></div>

</div>