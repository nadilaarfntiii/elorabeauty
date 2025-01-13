<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan Produk</title>
    <style>
        body {
            font-family: 'Calibri', sans-serif;
            background-color: #ffffff;
            color: #333;
            margin: 0;
            padding: 0;
            line-height: 1.4; /* Mengurangi spasi antar teks */
        }

        h1 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 15px; /* Mengurangi margin bawah */
            font-size: 36px;
            font-weight: bold;
            text-transform: uppercase;
        }

        h2 {
            text-align: center;
            color: #2c3e50;
            font-size: 24px;
            font-weight: normal;
            margin-bottom: 20px; /* Mengurangi margin bawah */
        }

        .user-info {
            text-align: left;
            font-size: 14px;
            margin-top: 10px; /* Mengurangi margin atas */
            margin-bottom: 20px; /* Mengurangi margin bawah */
            color: #555;
        }

        .user-info p {
            margin: 0;
            font-size: 14px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px; /* Mengurangi margin atas */
        }

        .table th, .table td {
            border: 1px solid #ddd;
            padding: 10px 15px; /* Mengurangi padding */
            text-align: left;
            font-size: 14px;
        }

        .table th {
            background-color: #34495e;
            color: white;
            font-weight: bold;
            text-transform: uppercase;
            text-align: center;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f9f9f9;
        }

        .table-striped tbody tr:nth-of-type(even) {
            background-color: #f1f1f1;
        }

        .table tbody tr:hover {
            background-color: #e0e0e0;
            cursor: pointer;
        }

        .table td {
            vertical-align: middle;
        }

        .table td:nth-child(4), .table td:nth-child(5) {
            text-align: center;
        }

        .table td:nth-child(6), .table td:nth-child(7) {
            text-align: center;
        }

        .table td:nth-child(8) {
            font-style: italic;
        }

        /* Signature style */
        .signature {
            text-align: center;
            margin-top: 40px; /* Mengurangi margin atas */
            font-size: 16px;
            color: #333;
        }

        .signature p {
            margin: 0;
        }

        .signature p.position {
            font-size: 18px;
            font-weight: bold;
            text-transform: uppercase;
        }

        /* Styling for the page */
        @media print {
            body {
                background-color: white;
                color: #333;
            }

            h1 {
                font-size: 32px;
                color: #2c3e50;
            }

            .table th, .table td {
                padding: 10px 15px;
            }

            .table {
                margin-top: 20px; /* Mengurangi margin atas */
            }

            .signature {
                margin-top: 20px;
                font-size: 14px;
            }

            .user-info {
                font-size: 12px;
            }
        }

        /* Centering the page when printed */
        @page {
            size: F4 landscape;
            margin: 10mm 20mm;
        }
    </style>
</head>
<body>
    <h1>PT. ELORA'S BEAUTY COSMETIC</h1>
    <h2>Laporan Data Produk</h2>

    <!-- User Information -->
    <div class="user-info">
        <p>Dicetak oleh: <?= esc($nama_lengkap); ?></p>
        <p>Tanggal: <?= date('d-m-Y'); ?></p>
    </div>
    
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>ID Produk</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Diskon (%)</th>
                <th>Stok</th>
                <th>Kategori</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($products)): ?>
                <?php $no = 1; ?>
                <?php foreach ($products as $pr): ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= esc($pr['id_product']); ?></td>
                        <td><?= esc($pr['nama_product']); ?></td>
                        <td>Rp <?= number_format($pr['harga'], 0, ',', '.'); ?></td>
                        <td><?= esc($pr['diskon']); ?>%</td>
                        <td><?= esc($pr['stok']); ?></td>
                        <td><?= esc($pr['nm_kategori']); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="9" class="text-center">Tidak ada produk yang tersedia.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Signature Section -->
    <div class="signature">
        <p>Tanda Tangan</p>
        <br><br><br>
        <p>____________________</p>
        <p><?= esc($nama_lengkap); ?></p>
    </div>
</body>
</html>
