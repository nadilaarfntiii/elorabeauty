<?php $this->extend('layouts/admin') ?>

<?php $this->section('content') ?>

<style>
    /* Button Styling */
    .btn-pink {
        background-color: #e83e8c;  /* Light pink */
        color: white;
        font-weight: bold;
        border-radius: 5px;
        padding: 8px 15px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        transition: background-color 0.3s ease;
    }

    .btn-pink:hover {
        background-color: #b90056;  /* Darker pink on hover */
        color: white;
    }

    .btn-pink i {
        margin-right: 5px;
    }

    /* Table Styling */
    .table {
        table-layout: fixed;
        width: 100%;
        margin-top: 20px;
    }

    .table th, .table td {
        white-space: nowrap;
        padding: 12px 15px;
        vertical-align: middle;
        text-align: center;
    }

    /* Table Header Styling */
    .table thead.thead-pink {
        background-color: #e83e8c;  /* Pink color */
        color: white;
    }

    /* Alternating Row Colors */
    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #f5c6d5;  /* Light pink for odd rows */
    }

    .table-striped tbody tr:nth-of-type(even) {
        background-color: #f8d7e3;  /* Lighter pink for even rows */
    }

    /* Table Header Cell Styling */
    .table th {
        font-weight: bold;
        color: white;
        background-color: #d6336c;  /* Dark pink background for headers */
    }

    /* Table Data Cell Styling */
    .table td {
        color: black;
        border-top: 1px solid #ddd;
    }

    /* Filter Section Styling */
    .filter-status {
        display: flex;
        align-items: center;
        justify-content: flex-start;
        margin-bottom: 20px;
        gap: 15px;
    }

    .filter-status form {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .filter-status select {
        width: 250px;
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

    /* Wrapper for the table to allow horizontal scrolling */
    .table-wrapper {
        overflow-x: auto;
        margin-bottom: 20px;
    }
</style>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Data Ekspedisi</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Data Ekspedisi</li>
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
                            <h6 class="m-0 font-weight-bold text-primary">Data Ekspedisi</h6>
                            <?php if (session()->getFlashdata('new_ekspedisi')): ?>
                                <div class="alert alert-success">
                                    Ekspedisi baru telah berhasil ditambahkan!
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="card-body">
                            <!-- Filter dan Cetak -->
                            <div class="filter-status">
                                <form method="get" action="/laporan/ekspedisi">
                                    <label for="status">Filter berdasarkan Status:</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="">Semua</option>
                                        <option value="Aktif" <?= $selectedStatus === 'Aktif' ? 'selected' : '' ?>>Aktif</option>
                                        <option value="Nonaktif" <?= $selectedStatus === 'Nonaktif' ? 'selected' : '' ?>>Nonaktif</option>
                                    </select>
                                    <button type="submit" class="btn btn-pink">
                                        <i class="fas fa-filter"></i> Filter
                                    </button>
                                    <a href="/laporan/cetak_ekspedisi?status=<?= isset($_GET['status']) ? $_GET['status'] : ''; ?>" 
                                        target="_blank" 
                                        class="btn-pink" 
                                        title="Cetak" 
                                        style="white-space: nowrap;">
                                        <i class="fas fa-print"></i> Cetak
                                    </a>
                                </form>
                            </div>

                            <!-- Tabel Data Ekspedisi -->
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
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($ekspedisi)): ?>
                                            <?php foreach ($ekspedisi as $exp): ?>
                                                <tr>
                                                    <td><?= esc($exp['id_ekspedisi']); ?></td>
                                                    <td><?= esc($exp['nama_ekspedisi']); ?></td>
                                                    <td><?= esc($exp['estimasi_pengiriman']); ?></td>
                                                    <td>Rp <?= number_format($exp['tarif_pengiriman'], 0, ',', '.'); ?></td>
                                                    <td><?= esc($exp['no_hp']); ?></td>
                                                    <td><?= esc($exp['status']); ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="6" class="text-center">Tidak ada data ekspedisi yang tersedia.</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->endSection() ?>
