<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pesanan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        hr {
            border: 0;
            border-top: 1px solid #ccc; /* Warna abu-abu yang sama */
            margin: 0;
        }

        h2 {
            text-align: center;
            color: #d5006d;
            margin-bottom: 20px;
            font-size: 32px;
        }

        /* Filter section */
        .filter-buttons {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .filter-button {
            padding: 12px 25px;
            margin: 0 5px; /* Menjaga jarak antar tombol */
            background-color: #fff;
            color: #d5006d;
            border: 2px solid #d5006d; /* Border berwarna pink muda */
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .filter-button:hover {
            background-color: #d5006d;
            color: white; /* Teks menjadi putih saat hover */
            border-color: #d5006d; /* Border tetap pink */
        }

        .filter-button.active {
            background-color: #d5006d;
            color: white;
            transform: scale(1.05); /* Menambah efek zoom saat tombol aktif */
        }

        .filter-button.active:hover {
            background-color: #9e0041; /* Warna lebih gelap ketika aktif dan di-hover */
        }

        /* Garis tipis abu-abu di bawah filter buttons */
        .filter-buttons + hr {
            border: 0;
            border-top: 1px solid #ccc; /* Garis tipis warna abu-abu */
            margin-bottom: 20px;
        }

        /* Order details */
        .order-details {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(255, 0, 104, 0.3);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            margin-bottom: 20px;
        }

        .order-details:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 20px rgba(255, 0, 104, 0.5);
        }

        .buyer-info {
            font-size: 16px;
            margin-bottom: 20px;
        }

        .buyer-info div {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .buyer-info strong {
            color: #333;
            flex-shrink: 0;
            width: 180px;
        }

        .buyer-info span {
            font-weight: bold;
            color: #333;
        }

        .btn-group {
            display: flex;
            justify-content: flex-end;
        }

        .btn {
            display: inline-block;
            padding: 10px 15px;
            background-color: #c40058;
            color: #fff;
            text-align: center;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
            transition: background-color 0.3s ease;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.2);
        }

        .btn:hover {
            background-color: #9e0041;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.3);
        }

        .footer {
            margin-top: 30px;
            text-align: center;
        }

        .footer a {
            color: #fff;
            background-color: #d5006d;
            padding: 12px 25px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .footer a:hover {
            background-color: #c40058;
        }

        /* Pesan jika tidak ada pesanan */
        #no-orders-message {
            text-align: center;
            color: #666;
            display: none;
            margin-top: 20px;
            font-size: 18px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Riwayat Pesanan Anda</h2>

        <!-- Filter buttons -->
        <div class="filter-buttons">
            <button class="filter-button active" onclick="filterOrders('all')">All</button>
            <button class="filter-button" onclick="filterOrders('dikemas')">Dikemas</button>
            <button class="filter-button" onclick="filterOrders('dikirim')">Dikirim</button>
            <button class="filter-button" onclick="filterOrders('dibatalkan')">Dibatalkan</button>
            <button class="filter-button" onclick="filterOrders('selesai')">Selesai</button>
        </div>

        <!-- Garis tipis abu-abu -->
        <hr>

        <!-- Pesan jika tidak ada pesanan -->
        <p id="no-orders-message">Tidak ada pesanan yang cocok dengan filter ini.</p>

        <!-- Loop Orders -->
        <?php if (!empty($orders)): ?>
            <?php foreach ($orders as $order): ?>
                <div class="order-details <?= strtolower($order['status_pesanan']); ?>">
                    <div class="buyer-info">
                        <div><strong>Nomor Pesanan</strong> <span><?= htmlspecialchars($order['id_pesanan']); ?></span></div>
                        <div><strong>Tanggal Pesanan</strong> <span><?= htmlspecialchars($order['tanggal_pesanan']); ?></span></div>
                        <div><strong>Alamat</strong> <span><?= htmlspecialchars($order['alamat_pengiriman']); ?></span></div>
                        <div><strong>Total Item</strong> <span><?= number_format($order['total_item']); ?></span></div>
                        <div><strong>Tarif Pengiriman</strong> <span>Rp <?= number_format($order['tarif_pengiriman'], 0, ',', '.'); ?></span></div>
                        <div><strong>Total Bayar</strong> <span>Rp <?= number_format($order['total_bayar'], 0, ',', '.'); ?></span></div>
                        <div><strong>Status</strong> <span><?= htmlspecialchars($order['status_pesanan']); ?></span></div>
                        <div><strong>No Resi</strong> <span><?= htmlspecialchars($order['no_resi']); ?></span></div>
                    </div>
                    <div class="btn-group">
                        <a href="/detail_orders/<?= $order['id_pesanan']; ?>" class="btn">Detail Pesanan</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p style="text-align: center; color: #666;">Tidak ada riwayat pesanan untuk ditampilkan.</p>
        <?php endif; ?>

        <hr>

        <div class="footer">
            <a href="index">Kembali ke Beranda</a>
        </div>
    </div>

    <script>
        function filterOrders(status) {
            var orders = document.querySelectorAll('.order-details');
            var filteredOrders = 0; // Variabel untuk menghitung jumlah pesanan yang cocok

            orders.forEach(function(order) {
                if (status === 'all' || order.classList.contains(status)) {
                    order.style.display = 'block';
                    filteredOrders++; // Pesanan cocok, tambahkan ke jumlah
                } else {
                    order.style.display = 'none';
                }
            });

            // Menandai tombol yang dipilih
            var buttons = document.querySelectorAll('.filter-button');
            buttons.forEach(function(button) {
                button.classList.remove('active');
            });

            // Menandai tombol yang aktif
            document.querySelector(`[onclick="filterOrders('${status}')"]`).classList.add('active');

            // Menampilkan pesan jika tidak ada pesanan yang cocok
            var messageContainer = document.querySelector('#no-orders-message');
            if (filteredOrders === 0) {
                messageContainer.style.display = 'block';
                messageContainer.innerText = `Tidak ada pesanan yang ${status === 'all' ? 'ditemukan' : status === 'dikemas' ? 'dalam proses dikemas' : status === 'dikirim' ? 'dikirim' : status === 'dibatalkan' ? 'dibatalkan' : 'selesai'}.`;
            } else {
                messageContainer.style.display = 'none';
            }
        }
    </script>
</body>
</html>
