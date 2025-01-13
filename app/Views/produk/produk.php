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

    .img-fluid {
        max-width: 100px;
        height: auto;
        border-radius: 5px;
    }

    .d-flex a {
        margin-right: 5px;
    }

    /* Ensure actions column has flex display for centering */
    .table td.actions {
        display: flex;  /* Use flexbox */
        justify-content: center;  /* Center horizontally */
        align-items: center;  /* Center vertically */
        gap: 10px;  /* Add space between buttons */
    }

    /* Make the table horizontally scrollable */
    .table-wrapper {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        margin-bottom: 20px;
    }
</style>

<div class="container-fluid">
    <?php if (session()->getFlashdata('new_product')): ?>
        <div class="alert alert-success">
            Produk baru telah berhasil ditambahkan!
        </div>
    <?php endif; ?>

    <h1 class="text-center mb-4" style="color: #b90056;">Semua Produk</h1>

    <div class="order-info" style="color: #b90056;">
        <p>Total Produk: <?= count($products); ?> produk</p>
    </div>

    <!-- Wrapper for horizontally scrollable table -->
    <div class="table-wrapper">
        <table class="table table-striped table-bordered">
            <thead class="thead-pink">
                <tr>
                    <th>ID Produk</th>
                    <th>Nama Produk</th>
                    <th>Detail Produk</th>
                    <th>Harga</th>
                    <th>Diskon (%)</th>  <!-- New column for Discount -->
                    <th>Stok</th>
                    <th>Kategori</th>
                    <th>Gambar 1</th>
                    <th>Gambar 2</th>
                    <th>Gambar 3</th>
                    <th>Gambar 4</th>
                    <th>Deskripsi</th>
                    <th>Manfaat</th>
                    <th>Kandungan</th>
                    <th>Cara Penggunaan</th>
                    <th>Ukuran</th>
                    <th>No BPOM</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($products)): ?>
                    <?php foreach($products as $pr): ?>
                        <tr>
                            <td><?= esc($pr['id_product']); ?></td>
                            <td><?= strlen($pr['nama_product']) > 50 ? esc(substr($pr['nama_product'], 0, 50)) . '...' : esc($pr['nama_product']); ?></td>
                            <td><?= strlen($pr['product_detail']) > 50 ? esc(substr($pr['product_detail'], 0, 50)) . '...' : esc($pr['product_detail']); ?></td>
                            <td>Rp <?= number_format($pr['harga'], 0, ',', '.'); ?></td>
                            <td><?= esc($pr['diskon']); ?>%</td>
                            <td><?= esc($pr['stok']); ?></td>
                            <td><?= esc($pr['nm_kategori']); ?></td>
                            <td><img src="<?= base_url('uploads/' . esc($pr['gambar_1'])); ?>" class="img-fluid" alt="<?= esc($pr['nama_product']); ?>"></td>
                            <td><img src="<?= base_url('uploads/' . esc($pr['gambar_2'])); ?>" class="img-fluid" alt="<?= esc($pr['nama_product']); ?>"></td>
                            <td><img src="<?= base_url('uploads/' . esc($pr['gambar_3'])); ?>" class="img-fluid" alt="<?= esc($pr['nama_product']); ?>"></td>
                            <td><img src="<?= base_url('uploads/' . esc($pr['gambar_4'])); ?>" class="img-fluid" alt="<?= esc($pr['nama_product']); ?>"></td>
                            <td><?= strlen($pr['deskripsi']) > 50 ? esc(substr($pr['deskripsi'], 0, 50)) . '...' : esc($pr['deskripsi']); ?></td>
                            <td><?= strlen($pr['manfaat']) > 50 ? esc(substr($pr['manfaat'], 0, 50)) . '...' : esc($pr['manfaat']); ?></td>
                            <td><?= strlen($pr['kandungan']) > 50 ? esc(substr($pr['kandungan'], 0, 50)) . '...' : esc($pr['kandungan']); ?></td>
                            <td><?= strlen($pr['cara_penggunaan']) > 50 ? esc(substr($pr['cara_penggunaan'], 0, 50)) . '...' : esc($pr['cara_penggunaan']); ?></td>
                            <td><?= esc($pr['ukuran']); ?></td>
                            <td><?= esc($pr['no_bpom']); ?></td>
                            <td><?= esc($pr['status']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="16" class="text-center">Tidak ada produk yang tersedia.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php $this->endSection() ?>
