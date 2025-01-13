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

    .table thead.thead-pink {
        background-color: #b90056;  /* Darker pink background for table header */
        color: white;  /* Set font color to white for header */
    }

    .table-striped tbody tr:nth-of-type(odd) {
    background-color: #f4a6c1; /* Soft dark pink for odd rows */
    }

    .table-striped tbody tr:nth-of-type(even) {
        background-color: #f9d4dd; /* Soft light pink for even rows */
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

    
</style>

<div class="container-fluid">
    <!-- Flash message for success or errors -->
    <?php if (session()->getFlashdata('message')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('message'); ?>
        </div>
    <?php endif; ?>

    <h1 class="text-center text-pink mb-4" style="color: #b90056;">Kategori Produk</h1>

    <!-- Add Category Button -->
    <div class="d-flex justify-content-end mb-4">
        <a href="/kategori/kategori_create" class="btn btn-pink">+ Tambah Kategori</a>
    </div>

    <!-- Category Table -->
    <table class="table table-striped table-bordered">
        <thead class="thead-pink">
            <tr>
                <th>ID Kategori</th>
                <th>Kategori</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php if (isset($kategori)): ?>
            <?php foreach ($kategori as $kat): ?>
                <tr>
                    <td><?= esc($kat['id_kategori']); ?></td>
                    <td><?= esc($kat['nm_kategori']); ?></td>
                    <td class="actions">
                        <a href="/kategori/kategori_update<?= esc($kat['id_kategori']); ?>" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="/kategori/delete/<?= esc($kat['id_kategori']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="3" class="text-center">Kategori tidak ditemukan</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

<?php $this->endSection() ?>
