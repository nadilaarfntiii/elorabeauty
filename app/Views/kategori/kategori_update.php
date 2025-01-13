<?php $this->extend('layouts/admin') ?>

<?php $this->section('content') ?>

<style>
        /* Namespace untuk styling form di dalam container-fluid */
        .container-fluid form .form-control {
        border-radius: 8px;
        padding: 15px;
        font-size: 1.1rem;
        border: 1px solid #ddd;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
        background-color: #f9f9f9;
    }

    .container-fluid form .form-control:focus {
        border-color: #e83e8c;
        box-shadow: 0 0 8px rgba(232, 62, 140, 0.5);
        background-color: #fff;
    }

    /* Khusus untuk input type="search" agar tidak membesar */
    .container-fluid form input[type="search"] {
        border-radius: 8px;
        padding: 10px;
        font-size: 1rem;
        border: 1px solid #ddd;
        background-color: #f9f9f9;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .container-fluid form input[type="search"]:focus {
        border-color: #e83e8c;
        box-shadow: 0 0 6px rgba(232, 62, 140, 0.5);
        background-color: #fff;
    }

    /* Tombol dengan warna pink */
    .container-fluid form .btn-pink {
        background-color: #e83e8c;
        color: white;
        font-weight: bold;
        border-radius: 30px;
        padding: 12px 30px;
        width: 100%;
        transition: transform 0.3s ease, background-color 0.3s ease;
    }

    .container-fluid form .btn-pink:hover {
        background-color: #b90056;
        transform: scale(1.05);
    }

    .container-fluid form .btn-pink:focus {
        outline: none;
        box-shadow: 0 0 10px rgba(232, 62, 140, 0.8);
    }

    /* Placeholder styling untuk select */
    .container-fluid form select.form-control {
        width: 100%;
        padding: 12px 15px;
        font-size: 1.1rem;
        background-color: #f9f9f9;
        border: 1px solid #ddd;
        border-radius: 8px;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
        line-height: 1.5;
        height: auto; /* Tinggi otomatis agar tidak fixed */
    }

    .container-fluid form select.form-control:focus {
        border-color: #e83e8c;
        box-shadow: 0 0 8px rgba(232, 62, 140, 0.5);
    }

    /* Placeholder styling untuk opsi default */
    .container-fluid form select.form-control option[value=""] {
        color: #aaa; /* Abu-abu terang untuk placeholder */
    }

    /* Form container styling */
    .container-fluid {
        max-width: 700px;
        margin: auto;
        padding: 30px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0px 4px 15px rgba(232, 62, 140, 0.5);
        margin-bottom: 50px;
        margin-top: 50px;
    }

    .container-fluid h1 {
        color: #e83e8c;
        font-size: 2rem;
        margin-bottom: 20px;
        text-align: center;
    }

    .alert {
        margin-top: 20px;
        text-align: center;
        padding: 15px;
        background-color: #d4edda;
        border: 1px solid #c3e6cb;
        color: #155724;
        border-radius: 8px;
    }
</style>

<div class="container-fluid">
    <!-- Flash message for errors or success -->
    <?php if (session()->getFlashdata('message')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('message'); ?>
        </div>
    <?php endif; ?>

    <h1>Edit Kategori</h1>

    <!-- Form for editing a category -->
    <form action="/kategori/update/<?= $kategori['id_kategori']; ?>" method="POST">
        <?= csrf_field(); ?>
        <input type="hidden" name="_method" value="PUT">

        <div class="form-group">
            <label for="id_kategori">ID Kategori</label>
            <input type="text" class="form-control" id="id_kategori" name="id_kategori" value="<?= $kategori['id_kategori']; ?>" readonly>
        </div>

        <div class="form-group">
            <label for="nm_kategori">Nama Kategori</label>
            <input type="text" class="form-control" id="nm_kategori" name="nm_kategori" value="<?= $kategori['nm_kategori']; ?>" required>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-pink">Update Kategori</button>
            <a href="/kategori/kategori" class="btn btn-secondary mt-3">Batal</a>
        </div>
    </form>
</div>

<?php $this->endSection() ?>
