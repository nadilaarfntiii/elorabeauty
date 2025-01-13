<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan</title>
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
            max-width: 900px;
            margin: 20px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #d5006d;
            margin-bottom: 20px;
            font-size: 32px;
        }

        .order-items {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .order-item {
            display: flex;
            align-items: center;
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 12px rgba(255, 0, 104, 0.3);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .order-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 20px rgba(255, 0, 104, 0.5);
        }

        .order-item img {
            max-width: 120px;
            border-radius: 8px;
            margin-right: 20px;
        }

        .order-item-details {
            font-size: 14px;
            line-height: 1.6;
            flex: 1;
        }

        .order-item-details div {
            margin-bottom: 10px;
        }

        .order-item-details strong {
            color: #333;
            font-weight: bold;
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

        .order-item-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .order-item-header .product-name {
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }

        .order-item-header .product-price {
            color: #d5006d;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Detail Pesanan</h2>

        <?php if (!empty($order_details)): ?>
            <div class="order-items">
                <?php foreach ($order_details as $item): ?>
                    <div class="order-item">
                        <img src="<?= base_url('uploads/' . esc($item['gambar_1'])); ?>" alt="<?= esc($item['nama_product']); ?>">
                        <div class="order-item-details">
                            <div class="order-item-header">
                                <div class="product-name"><?= esc($item['nama_product']); ?></div>
                                <div class="product-price">Rp <?= number_format($item['harga'], 0, ',', '.'); ?></div>
                            </div>
                            <div><strong>ID Produk:</strong> <?= htmlspecialchars($item['id_product']); ?></div>
                            <div><strong>Jumlah:</strong> <?= htmlspecialchars($item['qty']); ?></div>
                            <div><strong>Total:</strong> Rp <?= number_format($item['total'], 0, ',', '.'); ?></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p style="text-align: center; color: #666;">Detail pesanan tidak ditemukan.</p>
        <?php endif; ?>

        <div class="footer">
            <a href="riwayat_pesanan">Kembali ke Riwayat Pesanan</a>
        </div>
    </div>
</body>
</html>
