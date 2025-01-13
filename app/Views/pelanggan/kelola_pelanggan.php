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
        background-color: #b90056; 
        color: white;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #f4a6c1; 
    }

    .table-striped tbody tr:nth-of-type(even) {
        background-color: #f9d4dd; 
    }

    .table td, .table th {
        text-align: center;
        vertical-align: middle;
        white-space: nowrap; /* Prevent text from wrapping */
    }

    .table th {
        padding: 15px;
        color: white;  
    }

    .table td {
        padding: 10px;
        color: black;  
    }

    .img-fluid {
        max-width: 100px;
        height: auto;
        border-radius: 5px;
    }

    .d-flex a {
        margin-right: 5px;
    }

    .table td.actions {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px; 
        flex-wrap: wrap; 
    }

    .table td.actions a {
        margin: 0;
    }

    .table-responsive {
        overflow-x: auto; /* Add horizontal scroll if needed */
    }
</style>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Kelola Pelanggan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Kelola Pelanggan</li>
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
                            <h6 class="m-0 font-weight-bold text-primary">Data Pelanggan</h6>
                            <?php if (session()->getFlashdata('pesan')): ?>
                                <div class="alert alert-success">
                                    <?= session()->getFlashdata('pesan'); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="card-body">
                            <!-- Add table-responsive to enable horizontal scrolling -->
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
                                            <th>Aksi</th>
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
                                            <td>
                                                <?= $pelangganItem['status'] === 'Nonaktif' ? 'Nonaktif' : 'Aktif'; ?>
                                            </td>
                                            <td class="actions">
                                                <?php if ($pelangganItem['status'] !== 'Nonaktif'): ?>
                                                    <a href="/kelola_pelanggan/deactivate/<?= $pelangganItem['id_user']; ?>" 
                                                    class="btn btn-danger btn-sm" 
                                                    onclick="return confirm('Apakah Anda yakin ingin menonaktifkan akun ini?');">
                                                        Nonaktifkan
                                                    </a>
                                                <?php else: ?>
                                                    <a href="/kelola_pelanggan/activate/<?= $pelangganItem['id_user']; ?>" 
                                                    class="btn btn-success btn-sm" 
                                                    onclick="return confirm('Apakah Anda yakin ingin mengaktifkan kembali akun ini?');">
                                                        Aktifkan
                                                    </a>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div> <!-- End of table-responsive -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
