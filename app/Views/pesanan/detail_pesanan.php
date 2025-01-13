<?php $this->extend('layouts/admin') ?>

<?php $this->section('content') ?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<style>
    /* Button Styles */
    .btn-pink {
        background-color: #e83e8c;
        color: white;
        font-weight: bold;
        border-radius: 5px;
        padding: 8px 15px;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .btn-pink:hover {
        background-color: #b90056;
        color: white;
        text-decoration: none;
        transform: scale(1.05);
    }

    /* Table Styles */
    .table {
        width: 100%;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        margin-top: 40px;
        margin-bottom: 40px;
        background-color: #ffffff;
    }

    .table th {
        padding: 12px;
        font-size: 14px;
        text-align: center;
        vertical-align: middle;
        color: white;  /* Set text color for header to white */
        background-color: #b90056;
        text-transform: uppercase;
        font-weight: bold;
    }

    .table td {
        padding: 12px;
        font-size: 14px;
        text-align: center;
        vertical-align: middle;
        color: black;  /* Set text color for data cells to black */
    }

    .table-striped tbody tr:nth-child(odd) {
        background-color: #f8d0d6;
    }

    .table-striped tbody tr:nth-child(even) {
        background-color: #fcd3e2;
    }

    .table td img {
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.15);
        max-width: 120px;  /* Increased image size */
        max-height: 120px; /* Increased image size */
        object-fit: cover;
    }

   /* Order Summary Table Styles */
    .table-summary {
        width: 30%;
        border-collapse: collapse;
        margin-top: 15px;
    }

    .table-summary td {
        padding: 4px 8px; /* Reduced padding to make the table more compact */
        font-size: 16px;  /* Increased font size */
        text-align: left; /* Align text to the left */
        color: black; /* Set text color to black */
    }

    .table-summary td:first-child {
        text-align: left; /* Align the first column to the right to make colons line up */
        padding-right: 10px; /* Add some space between text and colon */
    }

    .table-summary td strong {
        font-weight: bold;
    }

    .table-summary tr:nth-child(odd) {
        background-color: #f8f9fa;
    }


    /* Page Title */
    .page-title {
        color: #b90056;
        font-size: 28px;
        font-weight: bold;
        text-align: center;
        margin-bottom: 40px;  /* Increased margin bottom */
    }

    /* Back Button Section */
    .back-button {
        margin-top: 40px;
        text-align: left; /* Align the button to the left */
    }

    .back-button a {
        font-size: 16px;
        padding: 12px 25px;
        background-color: #b90056;
        color: white;
        border-radius: 5px;
        font-weight: bold;
        text-decoration: none;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .back-button a:hover {
        background-color: #e83e8c;
        transform: scale(1.05);
    }

    /* Container */
    .container-fluid {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 15px;
    }

    h3 {
        color: #b90056;
        font-weight: bold;
    }
</style>

<br>

<div class="container-fluid">
    <h1 class="page-title">Detail Pesanan - ID: <?= esc($order['id_pesanan']); ?></h1>

    <!-- Order Summary -->
    <div class="order-summary">
    <h3>Informasi Pesanan</h3>
    <table class="table-summary">
        <tr>
            <td><strong>Nama Pelanggan</strong></td>
            <td>:   <?= esc($order['nama_lengkap']); ?></td>
        </tr>
        <tr>
            <td><strong>Tanggal Pesanan</strong></td>
            <td>:   <?= esc($order['tanggal_pesanan']); ?></td>
        </tr>
        <tr>
            <td><strong>Total Item</strong></td>
            <td>:   <?= esc($order['total_item']); ?></td>
        </tr>
        <tr>
            <td><strong>Total Pembayaran</strong></td>
            <td>:   Rp <?= number_format($order['total_bayar'], 0, ',', '.'); ?></td>
        </tr>
        <tr>
            <td><strong>Ekspedisi</strong></td>
            <td>:   <?= esc($order['nama_ekspedisi']); ?></td>
        </tr>
        <tr>
            <td><strong>Status Pesanan</strong></td>
            <td>:   <?= esc($order['status_pesanan']); ?></td>
        </tr>
        <tr>
            <td><strong>No Resi</strong></td>
            <td>:   <?= esc($order['no_resi']); ?></td>
        </tr>
    </table>

    <br>

     <!-- Action Buttons -->
    <div class="action-buttons text-left">
        <?php if ($order['status_pesanan'] == 'dikemas'): ?>
            <a href="<?= site_url('kelola_pesanan/update_status/'.$order['id_pesanan'].'/dikirim') ?>" class="btn btn-pink">
                <i class="fa fa-truck" style="margin-right: 8px;"></i> Kirim Pesanan
            </a>
            <a href="<?= site_url('kelola_pesanan/update_status/'.$order['id_pesanan'].'/dibatalkan') ?>" class="btn btn-pink">
                <i class="fa fa-times" style="margin-right: 8px;"></i> Batalkan Pesanan
            </a>
        <?php elseif ($order['status_pesanan'] == 'dikirim'): ?>
            <a href="<?= site_url('kelola_pesanan/update_status/'.$order['id_pesanan'].'/selesai') ?>" class="btn btn-pink">
                <i class="fa fa-check" style="margin-right: 8px;"></i> Pesanan Selesai
            </a>
        <?php endif; ?>
    </div>
</div>


    <h3 class="text-center mt-4">Detail Produk</h3>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Gambar</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orderDetails as $detail): ?>
                <tr>
                    <td><img src="<?= base_url('uploads/' . esc($detail['gambar_1'])); ?>" alt="<?= esc($detail['nama_product']); ?>"></td>
                    <td><?= esc($detail['nama_product']); ?></td>
                    <td>Rp <?= number_format($detail['harga'], 0, ',', '.'); ?></td>
                    <td><?= esc($detail['qty']); ?></td>
                    <td>Rp <?= number_format($detail['total'], 0, ',', '.'); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="back-button">
        <a href="/kelola_pesanan" class="btn btn-pink">Back</a>
    </div>
    <br>
    <br>
    <br>
</div>

<?php $this->endSection() ?>
