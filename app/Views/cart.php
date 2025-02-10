<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elora's Cart</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <style>
        /* Wrapper styling */
        .col {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-delete {
            background: none;
            border: none;
            color: red;
            cursor: pointer;
            padding: 0;
            font-size: 20px; /* Ukuran normal untuk ikon */
        }

        .btn-delete:hover {
            color: #c20c4d; /* Warna merah lebih gelap saat hover */
        }

        .btn-delete i {
            margin-left: 15px; 
            margin-right: 0;
        }

        button:focus {
            outline: none;
            box-shadow: none;
        }

        /* Button styling */
        .update-qty {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 30px; /* Lebih kecil */
            height: 30px; /* Lebih kecil */
            background-color: #f46292; /* Warna pink */
            color: #fff;
            font-size: 14px; /* Lebih kecil */
            font-weight: bold;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Button hover effect */
        .update-qty:hover {
            background-color: #e14e7f; /* Warna pink lebih gelap */
            transform: scale(1.1);
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
        }

        /* Button active effect */
        .update-qty:active {
            transform: scale(0.95);
            box-shadow: 0 3px 5px rgba(0, 0, 0, 0.2);
        }

        /* Quantity display styling */
        .qty {
            display: inline-block;
            width: 40px; /* Lebih kecil */
            text-align: center;
            font-size: 14px; /* Lebih kecil */
            font-weight: bold;
            color: #333;
            margin: 0 5px; /* Lebih kecil */
            padding: 2px; /* Lebih kecil */
            border: 2px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .title {
            margin-bottom: 5vh;
        }
        .card {
            margin: auto;
            margin-top: 50px;
            margin-bottom: 50px;
            max-width: 950px;
            width: 90%;
            box-shadow: 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            border-radius: 1rem;
            border: transparent;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 2vh;
        }
        .cart {
            background-color: #fff;
            padding: 4vh 5vh;
            border-bottom-left-radius: 1rem;
            border-top-left-radius: 1rem;
        }
        .summary {
            background-color: #f8f8f8;
            border-top-right-radius: 1rem;
            border-bottom-right-radius: 1rem;
            padding: 3vh;
            color: rgb(65, 65, 65);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            position: sticky;  /* Added sticky positioning */
            top: 0; /* Sticks to the top of the screen */
            height: auto; /* Let the height adjust as needed */
            max-height: 100vh; /* Prevent overflow when content is too tall */
            overflow-y: auto;
        }

        .summary h5 {
            font-weight: bold;
            margin-bottom: 1rem;
            color: #f46292;
        }

        .main {
            margin: 0;
            padding: 2vh 0;
            width: 100%;
        }
        .col-2, .col {
            padding: 0 1vh;
        }
        .back-to-shop {
            margin-top: 20px;
            padding: 10px;
            display: inline-flex;
            align-items: center;
            font-size: 1.1rem;
            color: #333;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .back-to-shop a {
            color: #d42f6e; /* Warna pink yang menarik */
            font-weight: bold;
            text-decoration: none;
            margin-right: 10px;
        }

        .back-to-shop a:hover {
            color: #c20c4d; /* Warna merah tua saat hover */
        }

        .back-to-shop span {
            font-size: 1rem;
            color: #777;
            font-weight: 500;
        }

        /* Tambahan efek hover untuk keseluruhan */
        .back-to-shop:hover {
            background-color: #f0f0f0;
            border-radius: 5px;
            padding: 10px 20px;
        }
        .btn {
            background-color: #f46292; /* Warna pink */
            border-color: #f46292; /* Border pink */
            color: white;
            width: 100%;
            font-size: 0.7rem;
            margin-top: 4vh;
            padding: 1vh;
            border-radius: 0;
        }
        .btn:focus {
            box-shadow: none;
            outline: none;
            box-shadow: none;
            color: white;
        }
        .btn:hover {
            color: white;
            background-color: #e14e7f; /* Warna pink yang lebih gelap ketika hover */
            border-color: #e14e7f;
        }
        a {
            color: #f46292; /* Mengubah warna link menjadi pink */
        }
        a:hover {
            color: #e14e7f; /* Warna lebih gelap saat hover */
            text-decoration: none;
        }

        /* Styling Summary */
        .summary h5 {
            font-weight: bold;
            margin-bottom: 1rem;
            color: #f46292; /* Mengubah warna judul menjadi pink */
        }

        .summary select,
        .summary input {
            margin-top: 10px;
        }

        .summary .btn {
            background-color: #f46292; /* Warna pink */
            border-color: #f46292; /* Border pink */
            color: white;
            padding: 1rem;
            border-radius: 0;
            font-size: 1rem;
            margin-top: 1rem;
        }

        .summary .btn:hover {
            color: white;
            background-color: #e14e7f; /* Warna lebih gelap saat hover */
            border-color: #e14e7f;
        }

        .summary .row {
            margin-bottom: 1rem;
        }

        /* Mengubah warna teks di bagian keranjang */
        .text-muted {
            color: #f46292; /* Mengubah warna teks yang muted menjadi pink */
        }

        .title h4 {
            color: #f46292; /* Mengubah warna judul Shopping Cart menjadi pink */
        }

        .back-to-shop a {
            color: #f46292; /* Mengubah warna link kembali ke toko menjadi pink */
        }

        .back-to-shop a:hover {
            color: #e14e7f; /* Warna lebih gelap saat hover */
        }

        .transfer-info {
        color: red; /* Mengatur warna teks menjadi merah */
        margin-bottom: 5px; /* Mengurangi jarak antara elemen */
        }

        .form-text.text-muted {
            margin-bottom: 5px; /* Mengurangi jarak antara keterangan */
        }
        
    </style>
</head>
<body>
    
<form method="post" action="/store_order" enctype="multipart/form-data">
    <div class="card">
        <div class="row">
            <!-- Keranjang Belanja -->
            <div class="col-md-8 cart">
                <div class="title">
                    <div class="row">
                        <div class="col">
                            <?php if (!empty($products)): ?>
                                <h4><b>Shopping Cart</b></h4>
                            </div>
                            <div class="col align-self-center text-right text-muted">
                                <?php
                                $total_qty = 0;
                                foreach ($products as $product) {
                                    $total_qty += $product['qty'];
                                }
                                echo $total_qty . ' Items';
                                ?>
                            </div>
                        <?php else: ?>
                            <p>0 Items</p>
                        <?php endif; ?>
                    </div>
                </div>    

                <!-- Produk List -->
                <?php if (!empty($products)): ?>
                    <?php foreach ($products as $product): ?>
                        <div class="row border-top border-bottom">
                            <div class="row main align-items-center">
                                <div class="col-2">
                                    <img class="img-fluid" src="<?= base_url('uploads/' . esc($product['gambar_1'])); ?>" alt="<?= esc($product['nama_product']); ?>">
                                </div>
                                <div class="col ml-auto">
                                    <div class="row pl-3">
                                        <span class="text-muted d-block"><?= esc($product['nm_kategori']); ?></span>
                                        <span class="d-block"><?= esc($product['nama_product']); ?></span>
                                    </div>
                                </div>
                                <div class="col ml-4">
                                    <button class="update-qty btn-decrease" data-id="<?= $product['id_product']; ?>">-</button>
                                    <span class="border qty"><?= $product['qty']; ?></span>
                                    <button class="update-qty btn-increase" data-id="<?= $product['id_product']; ?>">+</button>
                                </div>
                                <div class="col">
                                    <?php if ($product['diskon']): ?>
                                        <?php
                                        $harga_diskon = $product['harga'] - ($product['harga'] * $product['diskon'] / 100);
                                        ?>
                                        <span>Rp <?= number_format($harga_diskon, 0, ',', '.'); ?></span>
                                    <?php else: ?>
                                        Rp <?= number_format($product['harga'], 0, ',', '.'); ?>
                                    <?php endif; ?>
                                    <button class="btn-delete" data-id="<?= $product['id_cart']; ?>">
                                        <i class="fa fa-trash" style="color: red; font-size: 20px;"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No products available.</p>
                <?php endif; ?>

                <div class="back-to-shop">
                    <a href="/" class="text-muted">← Back to shop</a>
                </div>
            </div>

            <!-- Summary / Rangkuman -->
            <div class="col-md-4 summary">
                <div>
                    <h5><b>Summary</b></h5>
                </div>

                <!-- Flash Messages -->
                <?php if(session()->getFlashdata('message')): ?>
                    <div class="alert alert-success">
                        <?= session()->getFlashdata('message') ?>
                    </div>
                <?php endif; ?>

                <?php if(session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>

                <!-- Total Item -->
                <div class="row" style="padding: 1vh 0;">
                    <?php if (!empty($products)): ?>
                        <div class="col-12 d-flex justify-content-between">
                            <span>Total Item</span>
                            <span>
                            <?php
                                $total_qty = 0;
                                foreach ($products as $product) {
                                    $total_qty += $product['qty'];
                                }
                                echo $total_qty . ' Items';
                            ?>
                            </span>
                    <?php else: ?>
                        <p>0 Items</p>
                    <?php endif; ?>
                    </div>
                </div>

                <!-- Pilih Pengiriman -->
                <p style="padding-left: 2px;">Pilih Pengiriman</p>
                <select class="form-control" id="shipping-select" name="id_ekspedisi" style="margin-left: 2px;">
                    <option value="" disabled selected>Pilih Pengiriman</option>

                    <?php foreach ($ekspedisi as $ekspedisi_item): ?>
                        <option value="<?= esc($ekspedisi_item['id_ekspedisi']); ?>" data-tarif="<?= esc($ekspedisi_item['tarif_pengiriman']); ?>">
                            <?= esc($ekspedisi_item['nama_ekspedisi']); ?> - Rp <?= number_format($ekspedisi_item['tarif_pengiriman'], 0, ',', '.'); ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <br>

                
                <p style="padding-left: 2px; border-top: 1px solid rgba(0,0,0,.1); padding: 1vh 2px;">Alamat Pengiriman</p>
                <div class="form-group" style="margin-left: 2px;">
                    <textarea name="alamat_pengiriman" class="form-control" id="alamat_pengiriman" rows="3" required></textarea>
                    <small class="form-text text-muted">Masukkan alamat pengiriman lengkap Anda.</small>
                </div>

                <!-- Form Upload Bukti Pembayaran -->
                <p style="padding-left: 2px; border-top: 1px solid rgba(0,0,0,.1); padding: 1vh 2px;">Upload Bukti Pembayaran</p>
                    <small>Transfer ke Bank BRI <b>1234 5678 9012 3456</b></small> <br>
                    <small> a.n. Nadila Arofanti</small>
                <div class="form-group" style="margin-left: 2px;">
                    <input type="file" name="bukti_pembayaran" class="form-control-file" id="bukti_pembayaran" accept="image/*" required>
                    <small class="form-text text-muted">Unggah file dalam format gambar (JPG, PNG, atau JPEG). Maksimal ukuran 2MB.</small>
                </div>

                <br>

                <!-- Subtotal Produk -->
                <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 1vh 2px;">
                    <div class="col-12 d-flex justify-content-between">
                        <span>Subtotal Produk</span>
                        <span id="total">Rp <?= number_format($total_harga_produk, 0, ',', '.'); ?></span>
                    </div>
                </div>

                <?php if ($potongan > 0): ?>
                    <div class="row" style="padding: 1vh 2px;" id="potongan-qty">
                        <div class="col-12 d-flex justify-content-between">
                            <span>Potongan</span>
                            <span style="color: red;">- Rp <?= number_format($potongan, 0, ',', '.'); ?></span>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Tarif Pengiriman -->
                <div class="row" style="padding: 1vh 2px;">
                    <div class="col-12 d-flex justify-content-between">
                        <span>Tarif Pengiriman</span>
                        <span id="shipping-cost">Rp <?= number_format($shipping_cost, 0, ',', '.'); ?></span>
                    </div>
                </div>

                <!-- Total Bayar -->
                <div class="row" style="padding: 1vh 2px;">
                    <div class="col-12 d-flex justify-content-between">
                        <span>Total Bayar</span>
                        <span id="total-price">Rp <?= number_format($total_bayar, 0, ',', '.'); ?></span>
                    </div>
                </div>

                <button type="submit" class="btn btn-pink btn-block mt-4">CHECKOUT</button>
            </div>
        </div>
    </div>
</form>
            
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
    const shippingSelect = document.getElementById('shipping-select');
    const shippingCostElement = document.getElementById('shipping-cost'); 
    const totalPriceElement = document.getElementById('total-price');
    const initialTotalPrice = <?= $total_harga_produk; ?>; 
    const potongan = <?= $potongan; ?>; // Tambahkan variabel potongan dari PHP

    function updateTotalPrice() {
        const selectedOption = shippingSelect.options[shippingSelect.selectedIndex];
        const shippingCost = parseInt(selectedOption.getAttribute('data-tarif')) || 0; 
        const totalPrice = (initialTotalPrice - potongan) + shippingCost; // Perhitungan baru

        shippingCostElement.textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(shippingCost);
        totalPriceElement.textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(totalPrice);
    }

    updateTotalPrice();
    shippingSelect.addEventListener('change', updateTotalPrice);
});

</script>


<script>
    document.addEventListener('DOMContentLoaded', function () {
    const buttons = document.querySelectorAll('.update-qty');

    buttons.forEach(button => {
        button.addEventListener('click', function () {
            const productId = this.getAttribute('data-id');
            const isIncrease = this.classList.contains('btn-increase');
            const qtyElement = this.parentElement.querySelector('.qty');
            let currentQty = parseInt(qtyElement.textContent);

            // Update quantity value
            const newQty = isIncrease ? currentQty + 1 : currentQty - 1;

            if (newQty < 1) {
                alert("Quantity tidak bisa kurang dari 1.");
                return;
            }

            // Send AJAX request to update quantity
            fetch('/cart/updateQuantity/' + productId, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest', // For CI4 AJAX detection
                },
                body: JSON.stringify({ quantity: newQty }),
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {

                        window.location.reload();
                        // Update the quantity in the DOM
                        qtyElement.textContent = newQty;

                        // Update the number of items and total item count
                        const totalItemsElement = document.querySelector('.col.align-self-center.text-right.text-muted');
                        const totalItemRowElement = document.querySelector('.row .col-12.d-flex.justify-content-between span:nth-child(2)');

                        // Update total items
                        let totalItems = 0;
                        const qtyElements = document.querySelectorAll('.qty');
                        qtyElements.forEach(qtyElement => {
                            totalItems += parseInt(qtyElement.textContent);
                        });

                        // Update the display for total items
                        totalItemsElement.textContent = `${totalItems} Items`;
                        totalItemRowElement.textContent = totalItems + ' Items'; // Update total item row as well

                        // Update the Subtotal Produk dynamically
                        const subtotalElement = document.querySelector('#total');
                        let subtotal = 0;
                        data.products.forEach(product => {
                            const productPrice = product.diskon ? product.harga - (product.harga * product.diskon / 100) : product.harga;
                            subtotal += productPrice * product.qty; // Multiply price with quantity for each product
                        });

                        // Update subtotal display
                        subtotalElement.textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(subtotal);

                        // Update the total price dynamically
                        const shippingCost = document.getElementById('shipping-cost').textContent.replace('Rp ', '').replace('.', '');
                        const totalPrice = subtotal + parseInt(shippingCost);
                        const totalPriceElement = document.getElementById('total-price');
                        totalPriceElement.textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(totalPrice);

                    } else {
                        alert(data.message || 'Gagal update quantity.');
                    }
                })
        });
    });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.btn-delete');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
            const cartId = this.getAttribute('data-id');  // Get the cart ID

            if (confirm('Apakah kamu ingin menghapus item ini dari keranjang?')) {
                // Send request to controller to delete the product
                fetch('/cart/clearCart/' + cartId, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest', 
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ id: cartId }) // Send cart ID in the request body
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Item dihapus dari keranjang');
                        location.reload();  // Reload to update the cart view
                    } else {
                        alert('Gagal menghapus item.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while removing the item.');
                });
            }
        });
    });
});
</script>


</body>
</html>
