<div class="container-fluid">
    <h3 class="mt-4">Posting Lowongan</h3>
    <ol class="breadcrumb mb-4 d-flex justify-content-between align-content-center">
        <div class='d-flex'>
            <li class="breadcrumb-item pt-2"><a href="<?= base_url() ?>">Dashboard</a></li>
            <li class="breadcrumb-item pt-2 active"> Posting Lowongan</li>
        </div>
        <li class='f'>
            <span>
                <a href="<?= base_url('posting/add') ?>" class='btn btn-primary'>Tambah Lowongan</a>
            </span>
        </li>
    </ol>
    <table id="tableposting" class="display cards" style="width:100%">
    </table>
    <div style="height: 100vh;"></div>

</div>