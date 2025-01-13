<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<style>
    .btn-pink {
        background-color: #e83e8c;
        color: white;
        font-weight: bold;
        border-radius: 5px;
        padding: 8px 15px;
    }

    .btn-pink:hover {
        background-color: #b90056;
        color: white;
        text-decoration: none;
    }

    .table thead.thead-pink {
        background-color: #e83e8c;
        color: white;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #f5c6d5;
    }

    .table-striped tbody tr:nth-of-type(even) {
        background-color: #f8d7e3;
    }

    .table td, .table th {
        text-align: center;
        vertical-align: middle;
        padding: 12px 15px;
    }

    .table th {
        color: white;
        background-color: #d6336c;
        font-weight: bold;
    }

    .table td {
        color: black;
        border-top: 1px solid #ddd;
    }

    .filter-status {
        display: flex;
        align-items: center;
        justify-content: flex-start; /* Susun elemen ke kiri */
        margin-bottom: 20px;
        gap: 15px; /* Jarak antar elemen */
    }

    .filter-status form {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .filter-status select {
        width: 250px; /* Lebar select box */
        padding: 5px;
    }

    .filter-status button, .filter-status a {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .filter-status .fa-filter, .filter-status .fa-print {
        margin-right: 5px;
    }
</style>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Data Pelanggan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/dashboard">Dasbor</a></li>
                        <li class="breadcrumb-item active">Data Pelanggan</li>
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
                        <div class="card-header py-3 d-flex align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Data Pelanggan</h6>
                            <?php if (session()->getFlashdata('pesan')): ?>
                                <div class="alert alert-success">
                                    <?= session()->getFlashdata('pesan'); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="card-body">
                            <!-- Filter dan Cetak -->
                            <div class="filter-status">
                                <form method="get" action="/laporan/pelanggan">
                                    <label for="status">Filter berdasarkan Status:</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="">Semua</option>
                                        <option value="Aktif" <?= $selectedStatus === 'Aktif' ? 'selected' : '' ?>>Aktif</option>
                                        <option value="Nonaktif" <?= $selectedStatus === 'Nonaktif' ? 'selected' : '' ?>>Nonaktif</option>
                                    </select>
                                    <button type="submit" class="btn btn-pink">
                                        <i class="fas fa-filter"></i> Filter
                                    </button>
                                    <a href="/laporan/cetak_pelanggan?status=<?= isset($_GET['status']) ? $_GET['status'] : ''; ?>" 
                                        target="_blank" 
                                        class="btn-pink" 
                                        title="Cetak" 
                                        style="white-space: nowrap;">
                                        <i class="fas fa-print"></i> Cetak
                                    </a>
                                </form>
                            </div>

                            <!-- Tabel Data Pelanggan -->
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead class="thead-pink">
                                        <tr>
                                            <th>ID</th>
                                            <th>Username</th>
                                            <th>Nama Lengkap</th>
                                            <th>Email</th>
                                            <th>No HP</th>
                                            <th>Alamat</th>
                                            <th>Pesanan</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($pelanggan as $pelangganItem): ?>
                                        <tr>
                                            <td><?= $pelangganItem['id_user']; ?></td>
                                            <td><?= $pelangganItem['username']; ?></td>
                                            <td><?= $pelangganItem['nama_lengkap']; ?></td>
                                            <td><?= $pelangganItem['email']; ?></td>
                                            <td><?= $pelangganItem['no_hp']; ?></td>
                                            <td><?= $pelangganItem['alamat_lengkap']; ?>, <?= $pelangganItem['kota']; ?>, <?= $pelangganItem['provinsi']; ?></td>
                                            <td><?= $pelangganItem['jumlah_pesanan']; ?></td>
                                            <td><?= $pelangganItem['status'] === 'Nonaktif' ? 'Nonaktif' : 'Aktif'; ?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div> <!-- Akhir table-responsive -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
