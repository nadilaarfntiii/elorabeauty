<?php $this->extend('layouts/admin') ?>

<?php $this->section('content') ?>

<style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f9f9f9;
        margin: 0;
        padding: 0;
    }

    .container-fluid {
        background-color: white;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
        color: #b90056;
        font-weight: bold;
        text-align: center;
        margin-bottom: 20px;
    }

    .btn-pink, .btn-filter, .btn-print {
        background-color: #b90056;
        color: white;
        font-weight: bold;
        border: none;
        border-radius: 5px;
        padding: 8px 15px;
        cursor: pointer;
        transition: all 0.3s ease-in-out;
    }

    .btn-pink:hover, .btn-filter:hover, .btn-print:hover {
        background-color: #e83e8c;
    }

    .filter-container .btn-pink {
        margin-left: 10px;
    }

    .table-wrapper {
        overflow-x: auto;
        margin-top: 20px;
    }

    .table {
        width: 120%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    .table th {
        background-color: #b90056;
        color: white;
        text-align: center;
        padding: 12px;
        font-size: 14px;
        white-space: nowrap;
    }

    .table td {
        padding: 10px;
        text-align: center;
        font-size: 13px;
        vertical-align: middle;
        color: #333;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #fcd3e2;
    }

    .table-striped tbody tr:nth-of-type(even) {
        background-color: #f8d0d6;
    }

    .img-fluid {
        max-width: 100px;
        height: auto;
        border-radius: 5px;
    }

    .form-label {
        font-weight: bold;
        margin-bottom: 10px;
    }

    .form-select {
        border: 1px solid #b90056;
        border-radius: 5px;
        padding: 8px 10px;
        font-size: 14px;
        color: #333;
    }

    .form-select:focus {
        border-color: #e83e8c;
        outline: none;
        box-shadow: 0 0 5px rgba(232, 62, 140, 0.5);
    }

    .btn-print {
        margin-left: 10px;
        height: 40px;
    }

    .btn-filter i, .btn-pink i {
        margin-right: 5px;
    }

    .filter-container {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .filter-form {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .alert {
        background-color: #d4edda;
        border: 1px solid #c3e6cb;
        color: #155724;
        padding: 10px 15px;
        border-radius: 5px;
        font-size: 14px;
        margin-bottom: 20px;
    }

    @media print {
        .btn-filter, .btn-print, form {
            display: none;
        }

        .container-fluid {
            box-shadow: none;
        }

        .table th {
            background-color: #b90056 !important;
            -webkit-print-color-adjust: exact;
        }
    }
</style>

<div class="container-fluid">
    <?php if (session()->getFlashdata('new_product')): ?>
        <div class="alert">
            Produk baru telah berhasil ditambahkan!
        </div>
    <?php endif; ?>

    <h1>Data Produk</h1>

        <div class="filter-container">
        <form method="get" action="" class="filter-form">
            <label for="filter-kategori" class="form-label">Filter berdasarkan Kategori:</label>
            <select name="kategori" id="filter-kategori" class="form-select">
                <option value="">Semua Kategori</option>
                <?php foreach ($kategori as $category): ?>
                    <option value="<?= esc($category['id_kategori']); ?>" 
                        <?= isset($_GET['kategori']) && $_GET['kategori'] == $category['id_kategori'] ? 'selected' : ''; ?>>
                        <?= esc($category['nm_kategori']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button type="submit" class="btn-filter">
                <i class="fas fa-filter"></i> Filter
            </button>
            <a href="/laporan/cetak_produk?kategori=<?= isset($_GET['kategori']) ? $_GET['kategori'] : ''; ?>" 
                target="_blank" 
                class="btn-pink" 
                title="Cetak" 
                style="white-space: nowrap;">
                    <i class="fas fa-print"></i> Cetak
            </a>
        </form>
    </div>

    <div class="table-wrapper">
        <table class="table table-striped table-bordered">
            <thead>
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
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($products)): ?>
                    <?php foreach ($products as $pr): ?>
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
                        <td colspan="17" class="text-center">Tidak ada produk yang tersedia.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php $this->endSection() ?>
