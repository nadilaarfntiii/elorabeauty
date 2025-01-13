<?php $this->extend('layouts/admin') ?>

<?php $this->section('content') ?>

<style>
    .btn-pink {
        background-color: #e83e8c;  /* Pink color */
        color: white;
        font-weight: bold;
        border-radius: 4px;
        padding: 10px 20px;
        transition: background-color 0.3s ease;
        display: inline-flex;
        align-items: center;
    }

    .btn-pink i {
        margin-right: 8px;  /* Add margin to the right of the icon */
    }

    .btn-pink:hover {
        background-color: #b90056;  /* Darker pink on hover */
        color: white;
        text-decoration: none;
    }

    /* Table styling */
    .table {
        width: 100%;
        border-collapse: collapse; /* Ensures borders collapse into single line */
    }

    .table th, .table td {
        padding: 12px;
        text-align: center;
        vertical-align: middle;
    }

    .table th {
        background-color: #b90056;  /* Pink color for table header */
        color: white;
        font-weight: bold;
        text-transform: uppercase;  /* Makes header text uppercase for a formal look */
        border-bottom: 2px solid #b90056;
    }

    .table td {
        color: #333;  /* Darker text color for readability */
        border-bottom: 1px solid #ddd;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #f9f0f6; /* Lighter pink for odd rows */
    }

    .table-striped tbody tr:nth-of-type(even) {
        background-color: #fce3f0; /* Lighter pink for even rows */
    }

    .table-wrapper {
        overflow-x: auto;
        margin-bottom: 30px;
    }

    /* Filter Section Styling */
    .filter-section {
        margin-bottom: 25px;
        display: flex;
        gap: 20px;
        align-items: center; /* Align vertically to the middle */
        justify-content: flex-start;
    }

    .filter-section select {
        padding: 8px 15px;
        border-radius: 4px;
        border: 1px solid #ccc;
        font-size: 14px;
        width: 220px; /* Slightly increased width for better readability */
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Subtle shadow to make the dropdowns look elevated */
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .filter-section select:focus {
        border-color: #b90056; /* Highlight border when focused */
        box-shadow: 0 0 5px rgba(185, 0, 86, 0.6); /* Add focus effect */
    }

    .filter-section button {
        padding: 10px 20px;
        font-size: 16px;
        border-radius: 4px;
        width: auto;
        min-width: 120px;
    }

    /* Style for the total row */
    .total-row {
        background-color: #f8d0d6;
        font-weight: normal;
        font-size: 16px;
    }

    .total-row td {
        text-align: center;
        font-size: 18px;
        background-color: #fcd3e2;
    }

    /* Heading style */
    h1 {
        color: #b90056;
        font-size: 30px;
        font-weight: bold;
        margin-bottom: 30px;
        text-align: center;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border-color: #c3e6cb;
        border-radius: 5px;
        padding: 10px;
        font-size: 16px;
        margin-bottom: 20px;
    }
</style>

<div class="container-fluid">
    <?php if (session()->getFlashdata('message')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('message'); ?>
        </div>
    <?php endif; ?>

    <h1>Laporan Pendapatan</h1>

    <!-- Filter Section -->
    <div class="filter-section">
        <form method="get" action="/laporan/pendapatan">
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

            <button type="submit" class="btn btn-pink">
                <i class="fas fa-filter"></i> Filter
            </button>

            <!-- Print Button -->
            <a href="/laporan/cetak_pendapatan?bulan=<?= $selectedBulan ?>&tahun=<?= $selectedTahun ?>" 
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
                    <th>Total Pembayaran</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pesanan as $order): ?>
                    <tr>
                        <td><?= esc($order['id_pesanan']); ?></td>
                        <td><?= esc($order['nama_lengkap']); ?></td>
                        <td><?= esc($order['tanggal_pesanan']); ?></td>
                        <td>Rp <?= number_format($order['total_bayar'], 0, ',', '.'); ?></td>
                    </tr>
                <?php endforeach; ?>
                <!-- Total Pendapatan row -->
                <tr class="total-row">
                    <td colspan="3"><strong>Total Pendapatan</strong></td>
                    <td>Rp <?= number_format($totalPendapatan, 0, ',', '.'); ?></td>
                </tr>
            </tbody>
        </table>
    </div>

</div>

<?php $this->endSection() ?>
