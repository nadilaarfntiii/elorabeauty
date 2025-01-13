<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Elora's</title>
    <link rel="icon" type="image/png" href="assets/images/icons/favicon.ico"/>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" type="text/css" href="assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/util.css">
    <link rel="stylesheet" type="text/css" href="assets/css/main.css">
    <style>
        .container-login100 {
            width: 100%;  
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 15px;
            background-image: url('assets/img/bg1.jpg'); 
            background-size: cover; 
            background-position: center center; 
            background-repeat: no-repeat;
        }
    </style>
</head>
<body>

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <div class="login100-pic js-tilt" data-tilt>
                <img src="<?= base_url('assets/img/logo5.jpg') ?>" alt="Logo Elora's">
            </div>

            <form class="login100-form validate-form" action="<?= base_url('login/authenticate') ?>" method="post">
                <span class="login100-form-title">
                    Login Form
                </span>

                <!-- Menampilkan kesalahan global (jika ada) -->
                <?php if (session()->getFlashdata('error')) : ?>
                    <div class="error" style="color: red; margin-bottom: 10px;">
                        <?= esc(session()->getFlashdata('error')) ?>
                    </div>
                <?php endif; ?>

                <div class="wrap-input100 validate-input" data-validate="Username harus diisi">
                    <input class="input100" type="text" name="username" placeholder="Username" required title="Username harus diisi." >
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <i class="fa fa-user" aria-hidden="true"></i>
                    </span>
                </div>

                <div class="wrap-input100 validate-input" data-validate="Password harus diisi">
                    <input class="input100" type="password" name="password" placeholder="Password" required title="Password harus diisi." >
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <i class="fa fa-lock" aria-hidden="true"></i>
                    </span>
                </div>

                <div class="container-login100-form-btn">
                    <button class="login100-form-btn">
                        Login
                    </button>
                </div>

                <div class="text-center p-t-12">
                    <span class="txt1">
                        Forgot
                    </span>
                    <a class="txt2" href="#">
                        Username / Password?
                    </a>
                </div>

                <div class="text-center p-t-136">
                    <a class="txt2" href="<?= base_url('/register') ?>">
                        Buat Akun
                        <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- jQuery and Bootstrap JS -->
<script src="assets/vendor/jquery/jquery-3.2.1.min.js"></script>
<script src="assets/vendor/bootstrap/js/popper.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<!-- Custom JS -->
<script src="assets/vendor/select2/select2.min.js"></script>
<script src="assets/vendor/tilt/tilt.jquery.min.js"></script>
<script>
    $('.js-tilt').tilt({
        scale: 1.1
    })
</script>
<script src="assets/js/main.js"></script>

</body>
</html>
