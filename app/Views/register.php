<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Elora's</title>
    <!-- MATERIAL DESIGN ICONIC FONT -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="assets/fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">
    <!-- STYLE CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .login-link {
            display: block;
            text-align: center;
            margin-top: 2px;
            color: #e83e8c; 
            text-decoration: none;
            font-size: 14px;
        }

        .login-link:hover {
            text-decoration: underline; 
            color: #e4006b;
        }
    </style>
</head>
<body>

<div class="wrapper" style="background-image: url('assets/img/bg1.jpg');">
    <div class="inner">
        <div class="image-holder">
            <img src="<?= base_url('assets/img/logo4.jpg') ?>" alt="Logo Elora's">
        </div>
        <form action="<?= base_url('register/store') ?>" method="post">
            <h3>Registration Form</h3>

            <!-- Menampilkan kesalahan global (jika ada) -->
            <?php if (session()->getFlashdata('errors')) : ?>
                <div class="error">
                    <ul>
                        <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach ?>
                    </ul>
                </div>
            <?php endif ?>

            <div class="form-group">
                <input type="text" name="username" placeholder="Username" required pattern=".{3,20}" title="Username harus terdiri dari 3-20 karakter." value="<?= old('username') ?>" class="form-control">
                <input type="text" name="fullname" placeholder="Nama Lengkap" required pattern="[a-zA-Z ]+" title="Nama lengkap hanya boleh mengandung huruf dan spasi." value="<?= old('fullname') ?>" class="form-control">
            </div>

            <div class="form-wrapper">
                <input type="email" name="email" placeholder="Email Address" required pattern=".+@gmail\.com" title="Masukkan email yang valid dengan domain gmail.com, contoh: user@gmail.com." value="<?= old('email') ?>" class="form-control">
                <i class="fas fa-envelope"></i>
            </div>

            <div class="form-wrapper">
                <input type="text" name="no_hp" placeholder="Nomor HP" required pattern="\d+" title="Nomor HP hanya boleh berisi angka." value="<?= old('no_hp') ?>" class="form-control">
                <i class="fas fa-phone"></i>
            </div>

            <div class="form-wrapper">
                <input type="text" name="alamat_lengkap" placeholder="Alamat Lengkap" required title="Masukkan alamat lengkap Anda." value="<?= old('alamat_lengkap') ?>" class="form-control">
            </div>

            <div class="form-group">
                <input type="text" name="kota" placeholder="Kota" required title="Masukkan nama kota Anda." value="<?= old('kota') ?>" class="form-control">
                <input type="text" name="provinsi" placeholder="Provinsi" required title="Masukkan nama provinsi Anda." value="<?= old('provinsi') ?>" class="form-control">
            </div>

            <div class="form-group">
                <input type="text" name="kode_pos" placeholder="Kode Pos" required pattern="\d+" title="Kode pos hanya boleh berisi angka." value="<?= old('kode_pos') ?>" class="form-control">
                <input type="text" name="negara" placeholder="Negara" required title="Masukkan nama negara Anda." value="<?= old('negara') ?>" class="form-control">
            </div>

            <div class="form-wrapper">
                <input type="password" name="password" placeholder="Password" required pattern=".{8,}" title="Password harus memiliki minimal 8 karakter." value="<?= old('password') ?>" class="form-control">
                <i class="fas fa-lock"></i>
            </div>

            <div class="form-wrapper">
                <input type="password" name="password_confirm" placeholder="Confirm Password" required pattern=".{8,}" title="Konfirmasi password harus memiliki minimal 8 karakter." class="form-control">
                <i class="fas fa-lock"></i>
            </div>

            <button type="submit" class="btn-register">Register <i class="fas fa-arrow-right"></i></button>
            <br>

            <a href="<?= base_url('/login') ?>" class="login-link">Sudah punya akun? Login</a>
        </form>
    </div>
</div>

</body>
</html>
