<?php $this->extend('layouts/admin') ?>

<?php $this->section('content') ?>

<style>
    /* Same style as before */
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

    /* Table styling */
    .table {
        table-layout: auto;
        width: 100%;
    }

    .table th, .table td {
        white-space: nowrap;
        padding: 12px;
    }

    .table thead.thead-pink {
        background-color: #b90056;
        color: white;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #fcd3e2;
    }

    .table-striped tbody tr:nth-of-type(even) {
        background-color: #f8d0d6;
    }

    .table td, .table th {
        text-align: center;
        vertical-align: middle;
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

    .table-wrapper {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        margin-bottom: 20px;
    }
</style>

<div class="container-fluid">
    <h1 class="text-center mb-4" style="color: #b90056;">Produk Arsip</h1>

    <div class="order-info" style="color: #b90056;">
        <p>Total Produk Arsip: <?= count($archived_products); ?> produk</p>
    </div>

    <div class="table-wrapper">
        <table class="table table-striped table-bordered">
            <thead class="thead-pink">
                <tr>
                    <th>ID Produk</th>
                    <th>Nama Produk</th>
                    <th>Detail Produk</th>
                    <th>Harga</th>
                    <th>Diskon (%)</th>
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
                    <th>Aksi</th> <!-- New Action Column -->
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($archived_products)): ?>
                    <?php foreach($archived_products as $pr): ?>
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
                            <td>
                                <a href="<?= site_url('product/activate/' . esc($pr['id_product']) . '/' . esc($pr['nm_kategori'])); ?>" class="btn btn-pink" title="Aktifkan Produk">
                                    <i class="fas fa-sync-alt"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="17" class="text-center">Tidak ada produk yang tersedia di arsip.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php $this->endSection() ?>
