<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #ffe6f2;
            display: flex;
            justify-content: center;
            padding: 20px;
        }

        .checkout-container {
            max-width: 600px;
            width: 100%;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border: 2px solid #ff99cc;
        }

        h2 {
            color: #ff66b2;
            margin-bottom: 20px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #ff66b2;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ff99cc;
            border-radius: 4px;
            background-color: #ffe6f2;
            color: #333;
        }

        .cart-items {
            margin-bottom: 20px;
        }

        .cart-items h3 {
            color: #ff66b2;
            margin-bottom: 10px;
        }

        .cart-items ul {
            list-style: none;
            padding: 0;
        }

        .cart-items li {
            margin-bottom: 10px;
            padding: 10px;
            background-color: #ffccdd;
            border-radius: 4px;
            display: flex;
            justify-content: space-between;
            color: #333;
        }

        .total-price, .shipping-price, .total-pay {
            font-size: 18px;
            font-weight: bold;
            margin-top: 10px;
            text-align: right;
            color: #ff66b2;
        }

        .checkout-button {
            display: block;
            width: 100%;
            padding: 12px;
            border: none;
            background-color: #ff66b2;
            color: #fff;
            font-size: 16px;
            font-weight: bold;
            border-radius: 4px;
            cursor: pointer;
            text-align: center;
        }

        .checkout-button:hover {
            background-color: #ff4da6;
        }

        .shipping-selection {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .shipping-button {
            background-color: #ff99cc;
            color: #fff;
            padding: 8px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            font-weight: bold;
            text-align: center;
            flex-grow: 1;
            margin-right: 10px;
        }

        .shipping-button:hover {
            background-color: #ff4da6;
        }

        .selected-shipping {
            font-size: 14px;
            color: #ff66b2;
        }
    </style>
</head>
<body>
    <div class="checkout-container">
        <h2>Checkout</h2>
        
        <div class="cart-items">
            <h3>Produk</h3>
            <ul>
                <?php foreach ($cart as $item): ?>
                    <li>
                        <span><?= $item['name']; ?> x <?= $item['quantity']; ?></span>
                        <span>Rp <?= number_format($item['price'] * $item['quantity']); ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <p class="total-price">Total Pesanan: Rp <?= number_format(array_sum(array_map(function($item) { return $item['price'] * $item['quantity']; }, $cart))); ?></p>

        <?php
            $shippingCosts = [
                'JNE' => 10000,
                'POS' => 15000,
                'TIKI' => 12000,
                'SiCepat' => 8000
            ];

            $shippingPrice = isset($selectedShipping) ? $shippingCosts[$selectedShipping] : 0;
        ?>

        <?php if ($shippingPrice > 0): ?>
            <p class="shipping-price">Harga Ongkir (<?= htmlspecialchars($selectedShipping); ?>): Rp <?= number_format($shippingPrice); ?></p>
        <?php endif; ?>

        <p class="total-pay">Total Bayar: Rp <?= number_format(array_sum(array_map(function($item) { return $item['price'] * $item['quantity']; }, $cart)) + $shippingPrice); ?></p>

        <form action="/proses_checkout" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="shipping">Ekspedisi Pengiriman</label>
                <div class="shipping-selection">
                    <?php if (!isset($selectedShipping)): ?>
                        <a href="/ekspedisi" class="shipping-button">
                            Pilih Ekspedisi
                        </a>
                    <?php else: ?>
                        <span class="selected-shipping"><?= htmlspecialchars($selectedShipping); ?></span>
                        <input type="hidden" name="shipping" value="<?= htmlspecialchars($selectedShipping); ?>">
                    <?php endif; ?>
                </div>
            </div>

            <div class="form-group">
                <label for="name">Nama Pembeli</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="phone">Nomor Telepon</label>
                <input type="tel" id="phone" name="phone" required>
            </div>

            <div class="form-group">
                <label for="address">Alamat</label>
                <input type="text" id="address" name="address" required>
            </div>

            <div class="form-group">
                <label for="payment">Unggah Bukti Pembayaran</label>
                <input type="file" id="payment" name="payment" accept="image/jpeg, image/jpg" required>
                <p>Unggah Foto Bukti Pembayaran (JPG/JPEG)</p>
            </div>

            <button type="submit" class="checkout-button">Pesan Sekarang</button>
        </form>
    </div>
</body>
</html>
