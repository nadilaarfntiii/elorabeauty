<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan Pelanggan</title>
    <style>
        body {
            font-family: 'Calibri', sans-serif;
            background-color: #ffffff;
            color: #333;
            margin: 0;
            padding: 0;
            line-height: 1.5;
        }

        h1 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 5px;
            font-size: 28px;
            font-weight: bold;
            text-transform: uppercase;
        }

        h2 {
            text-align: center;
            color: #2c3e50;
            font-size: 20px;
            font-weight: normal;
            margin-bottom: 15px;
        }

        .user-info {
            text-align: left;
            font-size: 14px;
            margin-bottom: 20px;
            color: #555;
        }

        .user-info p {
            margin: 0;
            font-size: 14px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        .table th, .table td {
            border: 1px solid #ddd;
            padding: 10px;
            font-size: 14px;
            text-align: center; /* Semua teks di tengah */
        }

        .table th {
            background-color: #2c3e50;
            color: white;
            font-weight: bold;
            text-transform: uppercase;
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

        .signature {
            text-align: center;
            margin-top: 40px;
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

        @page {
            size: F4 landscape;
            margin: 10mm 20mm;
        }
    </style>
</head>
<body>
    <h1>PT. ELORA'S BEAUTY COSMETIC</h1>
    <h2>Laporan Data Pelanggan</h2>

    <div class="user-info">
        <p>Dicetak oleh: <?= esc($nama_lengkap); ?></p>
        <p>Tanggal: <?= date('d-m-Y'); ?></p>
    </div>
    
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>ID Pelanggan</th>
                <th>Nama Lengkap</th>
                <th>Username</th>
                <th>Email</th>
                <th>No. HP</th>
                <th>Pesanan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($pelanggan)): ?>
                <?php $no = 1; ?>
                <?php foreach ($pelanggan as $pl): ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= esc($pl['id_user']); ?></td>
                        <td><?= esc($pl['nama_lengkap']); ?></td>
                        <td><?= $pl['username']; ?></td>
                        <td><?= esc($pl['email']); ?></td>
                        <td><?= esc($pl['no_hp']); ?></td>
                        <td><?= $pl['jumlah_pesanan']; ?></td>
                        <td><?= esc($pl['status']); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8" class="text-center">Tidak ada data pelanggan.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="signature">
        <p>Tanda Tangan</p>
        <br><br><br>
        <p>____________________</p>
        <p><?= esc($nama_lengkap); ?></p>
    </div>
</body>
</html>
