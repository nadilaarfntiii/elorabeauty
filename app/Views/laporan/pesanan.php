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

    .filter-section {
        margin-bottom: 20px;
        display: flex;
        gap: 15px; /* Jarak antar filter */
        flex-wrap: wrap; /* Agar filter tidak terpotong pada layar kecil */
    }

    .filter-section select {
        padding: 5px 10px;
        border-radius: 5px;
        flex: 1 1 auto; /* Mengatur ukuran agar elemen dapat merenggang sesuai lebar kontainer */
        min-width: 150px; /* Memberikan lebar minimum untuk setiap filter */
    }

</style>

<div class="container-fluid">
    <?php if (session()->getFlashdata('message')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('message'); ?>
        </div>
    <?php endif; ?>

    <h1 class="text-center mb-3" style="color: #b90056;">Kelola Pesanan</h1>
    
    <div class="order-info" style="color: #b90056;">
        <p>Total Pesanan: <?= count($pesanan); ?> pesanan</p>
    </div>

    <!-- Filter Section -->
    <div class="filter-section">
        <form method="get" action="/laporan/pesanan">
            <!-- Filter by Month -->
            <select name="bulan" class="form-control">
                <option value="">-- Pilih Bulan --</option>
                <?php foreach (range(1, 12) as $bulan): ?>
                    <option value="<?= $bulan; ?>" <?= ($bulan == $selectedBulan ? 'selected' : ''); ?>>
                        <?= date('F', mktime(0, 0, 0, $bulan, 10)); ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <br>

            <!-- Filter by Year -->
            <select name="tahun" class="form-control">
                <option value="">-- Pilih Tahun --</option>
                <?php for ($year = 2020; $year <= date('Y'); $year++): ?>
                    <option value="<?= $year; ?>" <?= ($year == $selectedTahun ? 'selected' : ''); ?>>
                        <?= $year; ?>
                    </option>
                <?php endfor; ?>
            </select>

            <br>

            <!-- Filter by Ekspedisi -->
            <select name="ekspedisi" class="form-control">
                <option value="">-- Pilih Ekspedisi --</option>
                <?php foreach ($ekspedisi as $expedition): ?>
                    <option value="<?= esc($expedition['id_ekspedisi']); ?>" <?= ($expedition['id_ekspedisi'] == $selectedEkspedisi ? 'selected' : ''); ?>>
                        <?= esc($expedition['nama_ekspedisi']); ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <br>

            <!-- Filter by Status Pesanan -->
            <select name="status_pesanan" class="form-control">
                <option value="">-- Pilih Status Pesanan --</option>
                <option value="dikemas" <?= ('dikemas' == $selectedStatusPesanan ? 'selected' : ''); ?>>Dikemas</option>
                <option value="dikirim" <?= ('dikirim' == $selectedStatusPesanan ? 'selected' : ''); ?>>Dikirim</option>
                <option value="selesai" <?= ('selesai' == $selectedStatusPesanan ? 'selected' : ''); ?>>Selesai</option>
                <option value="dibatalkan" <?= ('dibatalkan' == $selectedStatusPesanan ? 'selected' : ''); ?>>Dibatalkan</option>
            </select>

            <br>

            <button type="submit" class="btn btn-pink">
                    <i class="fas fa-filter"></i> Filter
            </button>

            <!-- Print Button -->
            <a href="/laporan/cetak_pesanan?bulan=<?= $selectedBulan ?>&tahun=<?= $selectedTahun ?>&ekspedisi=<?= $selectedEkspedisi ?>&status_pesanan=<?= $selectedStatusPesanan ?>" 
            target="_blank" 
            class="btn btn-pink" 
            title="Cetak">
                <i class="fas fa-print"></i> Cetak
            </a>
            
        </form>
        
    </div>

    <!-- Wrapper for horizontally scrollable table -->
    <div class="table-wrapper">
        <table class="table table-striped table-bordered">
            <thead class="thead-pink">
                <tr>
                    <th>ID Pesanan</th>
                    <th>Nama Pelanggan</th>
                    <th>Tanggal Pesanan</th>
                    <th>Total Item</th>
                    <th>Total Pembayaran</th>
                    <th>Ekspedisi</th>
                    <th>Status Pesanan</th>
                    <th>No Resi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pesanan as $order): ?>
                    <tr>
                        <td><?= esc($order['id_pesanan']); ?></td>
                        <td><?= esc($order['nama_lengkap']); ?></td>
                        <td><?= esc($order['tanggal_pesanan']); ?></td>
                        <td><?= esc($order['total_item']); ?></td>
                        <td>Rp <?= number_format($order['total_bayar'], 0, ',', '.'); ?></td>
                        <td><?= esc($order['nama_ekspedisi']); ?></td>
                        <td>
                            <?= esc($order['status_pesanan']); ?>
                        </td>
                        <td>
                            <?= esc($order['no_resi']); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>

<?php $this->endSection() ?>
