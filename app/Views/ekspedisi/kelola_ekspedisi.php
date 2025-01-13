<?php $this->extend('layouts/admin') ?>

<?php $this->section('content') ?>

<style>
    /* Custom pink color for buttons */
    .btn-pink {
        background-color: #e83e8c;  /* Pink color */
        color: white;
        font-weight: bold;
        border-radius: 5px;
        padding: 8px 15px;
    }

    .btn-pink:hover {
        background-color: #b90056;  /* Darker pink on hover */
        color: white;
        text-decoration: none;
    }

    /* Table styling */
    .table {
        table-layout: auto;
        width: 100%;
    }

    .table th, .table td {
        white-space: nowrap;
        padding: 12px;
    }

    /* Pink background for table header */
    .table thead.thead-pink {
        background-color: #b90056;  /* Darker pink background for table header */
        color: white;  /* Set font color to white for header */
    }

    /* Table row colors */
    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #fcd3e2; /* Soft dark pink for odd rows */
    }

    .table-striped tbody tr:nth-of-type(even) {
        background-color: #f8d0d6; /* Soft light pink for even rows */
    }

    .table td, .table th {
        text-align: center;
        vertical-align: middle;
    }

    .table th {
        padding: 15px;
        color: white;  /* Ensure the header font color is white */
    }

    .table td {
        padding: 10px;
        color: black;  /* Set font color to black for table contents */
    }

    .table-wrapper {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        margin-bottom: 20px;
    }

    /* Action buttons styling */
    .actions {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
    }
</style>

<div class="container-fluid">
    <?php if (session()->getFlashdata('new_ekspedisi')): ?>
        <div class="alert alert-success">
            Ekspedisi baru telah berhasil ditambahkan!
        </div>
    <?php endif; ?>

    <h1 class="text-center mb-4" style="color: #b90056;">Kelola Ekspedisi</h1>

    <div class="d-flex justify-content-end mb-4">
        <a href="<?= base_url('/ekspedisi/ekspedisi_create') ?>"
        class="btn btn-pink">+ Tambah Ekspedisi</a>
    </div>

    <!-- Wrapper for horizontally scrollable table -->
    <div class="table-wrapper">
        <table class="table table-striped table-bordered">
            <thead class="thead-pink">
                <tr>
                    <th>ID Ekspedisi</th>
                    <th>Nama Ekspedisi</th>
                    <th>Estimasi Pengiriman</th>
                    <th>Tarif Pengiriman</th>
                    <th>No HP</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($ekspedisi)): ?>
                    <?php foreach($ekspedisi as $exp): ?>
                        <tr>
                            <td><?= esc($exp['id_ekspedisi']); ?></td>
                            <td><?= esc($exp['nama_ekspedisi']); ?></td>
                            <td><?= esc($exp['estimasi_pengiriman']); ?></td>
                            <td>Rp <?= number_format($exp['tarif_pengiriman'], 0, ',', '.'); ?></td>
                            <td><?= esc($exp['no_hp']); ?></td>
                            <td><?= esc($exp['status']); ?></td>
                            <td>
                                <div class="actions">
                                    <a href="<?= base_url('/ekspedisi/ekspedisi_update' . esc($exp['id_ekspedisi'])); ?>" class="btn btn-pink btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="<?= base_url('/ekspedisi/delete/' . esc($exp['id_ekspedisi'])); ?>" class="btn btn-pink btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus ekspedisi ini?')">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center">Tidak ada data ekspedisi yang tersedia.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php $this->endSection() ?>
