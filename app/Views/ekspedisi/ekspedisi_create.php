<?php $this->extend('/layouts/admin'); ?>
<?php $this->section('content'); ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Form Tambah Ekspedisi</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Form Tambah Ekspedisi</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow card-primary">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Tambah Ekspedisi</h6>
                            <?php if (session()->getFlashdata('errors')): ?>
                                <div class="alert alert-danger">
                                    <ul>
                                        <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                            <li><?= esc($error) ?></li>
                                        <?php endforeach ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="card-body">
                            <?php if (session()->getFlashdata('new_ekspedisi')): ?>
                                <div class="alert alert-success" role="alert">
                                    <?= session()->getFlashdata('new_ekspedisi'); ?>
                                </div>
                            <?php endif; ?>
                            
                            <form action="/ekspedisi/save" method="POST">
                                <?= csrf_field(); ?>

                                <div class="form-group">
                                    <label for="id_ekspedisi">ID Ekspedisi</label>
                                    <input type="text" class="form-control" id="id_ekspedisi" name="id_ekspedisi" required placeholder="Masukkan ID Ekspedisi">
                                </div>
                                
                                <div class="form-group">
                                    <label for="nama_ekspedisi">Nama Ekspedisi</label>
                                    <input type="text" class="form-control" id="nama_ekspedisi" name="nama_ekspedisi" required>
                                </div>

                                <div class="form-group">
                                    <label for="estimasi_pengiriman">Estimasi Pengiriman</label>
                                    <input type="text" class="form-control" id="estimasi_pengiriman" name="estimasi_pengiriman" required>
                                </div>

                                <div class="form-group">
                                    <label for="tarif_pengiriman">Tarif Pengiriman</label>
                                    <input type="number" class="form-control" id="tarif_pengiriman" name="tarif_pengiriman" required>
                                </div>

                                <div class="form-group">
                                    <label for="no_hp">No HP</label>
                                    <input type="text" class="form-control" id="no_hp" name="no_hp" required>
                                </div>

                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control" id="status" name="status" required>
                                        <option value="Aktif">Aktif</option>
                                        <option value="Nonaktif">Nonaktif</option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary btn-block">Simpan Ekspedisi</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->endSection(); ?>
