<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Success</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f7f7f7;
            font-family: 'Arial', sans-serif;
            color: #333;
        }

        .container {
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            padding: 40px;
            max-width: 600px;
            margin-top: 80px;
        }

        h1 {
            color: #d5006d;
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        p {
            color: #777;
            font-size: 18px;
            margin-bottom: 30px;
        }

        .btn {
            padding: 12px 30px;
            font-size: 18px;
            border-radius: 50px;
            transition: background-color 0.3s ease, transform 0.3s ease;
            margin: 10px;
        }

        .btn-primary {
            background-color: #d5006d;
            border-color: #d5006d;
        }

        .btn-primary:hover {
            background-color: #c40058;
            border-color: #c40058;
            transform: translateY(-2px);
        }

        .btn-primary:focus {
            box-shadow: 0 0 0 0.25rem rgba(213, 0, 109, 0.5);
        }

        .btn-secondary {
            background-color: #f7f7f7;
            border-color: #d5006d;
            color: #d5006d;
        }

        .btn-secondary:hover {
            background-color: #d5006d;
            color: #fff;
            transform: translateY(-2px);
        }

        .icon {
            font-size: 60px;
            color: #d5006d;
            margin-bottom: 20px;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container text-center">
        <div class="icon">
            <i class="fas fa-check-circle"></i>
        </div>
        <h1>Checkout Berhasil!</h1>
        <p>Terima kasih telah berbelanja bersama kami. Pesanan Anda sedang diproses.</p>
        <a href="/" class="btn btn-primary">
            <i class="fas fa-home"></i> Kembali ke Beranda
        </a>
        <a href="/orders" class="btn btn-primary">
            <i class="fas fa-box"></i> Lihat Pesanan
        </a>
    </div>

    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>
</html>
