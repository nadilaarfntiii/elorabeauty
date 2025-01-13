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
    <?php if (session()->getFlashdata('message')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('message'); ?>
        </div>
    <?php endif; ?>

    <h1 class="text-center mb-3" style="color: #b90056;">Kelola Pesanan</h1>
    
    <div class="order-info" style="color: #b90056;">
        <p>Total Pesanan: <?= count($pesanan); ?> pesanan</p>
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
                    <th>Aksi</th>
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
                        <td>
                        <div class="actions">
                            <a href="/pesanan/detail_pesanan/<?= esc($order['id_pesanan']); ?>" class="btn btn-pink" title="Lihat Detail">
                                <i class="fas fa-eye"></i> 
                            </a>
                        </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>

<?php $this->endSection() ?>
