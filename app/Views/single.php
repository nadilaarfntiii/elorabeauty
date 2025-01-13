<!DOCTYPE html>
<html lang="en">
<head>
<title>Single Product</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Colo Shop Template">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/styles/bootstrap4/bootstrap.min.css'); ?>">
<link href="<?= base_url('assets/plugins/font-awesome-4.7.0/css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/plugins/OwlCarousel2-2.2.1/owl.carousel.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/plugins/OwlCarousel2-2.2.1/owl.theme.default.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/plugins/OwlCarousel2-2.2.1/animate.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/plugins/themify-icons/themify-icons.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/plugins/jquery-ui-1.12.1.custom/jquery-ui.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/styles/single_styles.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/styles/single_responsive.css'); ?>">
<style>
    .stok-container {
        font-size: 14px; 
        color: #6c757d;
        font-weight: bold;
		margin-top: 15px; 
        margin-bottom: 15px; 
    }
    .stok-container span {
        color: #6c757d; 
    }
</style>
</head>

<body>

<div class="super_container">

	<!-- Header -->

	<header class="header trans_300">

		<!-- Top Navigation -->

		<div class="top_nav">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<div class="top_nav_left">BEBAS ONGKIR TANPA SYARAT UP TO 50K</div>
					</div>
					<div class="col-md-6 text-right">
						<div class="top_nav_right">
							<ul class="top_nav_menu">
							<li class="wa">
									<a href="#">
										<i class="fa fa-whatsapp" aria-hidden="true"></i>
										085727275037
									</a>
								</li>
								<li class="account">
									<?php if ($session->get('username')) : ?>
										<a href="#">
												<i class="fa fa-user" aria-hidden="true"></i> <?= $session->get('username'); ?>
												<i class="fa fa-angle-down"></i>
										</a>
										<ul class="account_selection">
											<li><a href="/logout"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a></li>
										</ul>
									<?php else : ?>
										<a href="#">
											<i class="fa fa-user" aria-hidden="true"></i> Sign In / Register
											<i class="fa fa-angle-down"></i>
										</a>
										<ul class="account_selection">
											<li><a href="/login"><i class="fa fa-sign-in" aria-hidden="true"></i> Sign In</a></li>
											<li><a href="/register"><i class="fa fa-user-plus" aria-hidden="true"></i> Register</a></li>
										</ul>
									<?php endif; ?>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Main Navigation -->

		<div class="main_nav_container">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 text-right">
						<div class="logo_container">
							<a href="index">Elo<span>ra's</span></a>
						</div>
						<nav class="navbar">
							<ul class="navbar_menu">
									<li><a href="/index">beranda</a></li>
									<li><a href="/kategori">kategori</a></li>
									<li><a href="/kontak">Kontak</a></li>
								</ul>
								<ul class="navbar_user">
									<li><a href="#"><i class="fa fa-search" aria-hidden="true"></i></a></li>
									<li><a href="#"><i class="fa fa-user" aria-hidden="true"></i></a></li>
									<?php $session = session(); ?>
									<li class="checkout">
										<a href="<?= site_url('cart'); ?>">
											<i class="fa fa-shopping-cart" aria-hidden="true"></i>
											<span id="checkout_items" class="checkout_items"><?= count($session->get('cart') ?? []); ?></span>
										</a>
									</li>
								</ul>
							<div class="hamburger_container">
								<i class="fa fa-bars" aria-hidden="true"></i>
							</div>
						</nav>
					</div>
				</div>
			</div>
		</div>

	</header>

	<div class="fs_menu_overlay"></div>

	<!-- Hamburger Menu -->

	<div class="hamburger_menu">
		<div class="hamburger_close"><i class="fa fa-times" aria-hidden="true"></i></div>
		<div class="hamburger_menu_content text-right">
		<ul class="menu_top_nav">
				<li class="menu_item has-children">
					<a href="#">
						<i class="fa fa-whatsapp" aria-hidden="true"></i>
							085727275037
					</a>
				</li>
				<li class="account">
					<?php if ($session->get('username')) : ?>
						<a href="#">
							<i class="fa fa-user" aria-hidden="true"></i> <?= $session->get('username'); ?>
							<i class="fa fa-angle-down"></i>
						</a>
						<ul class="account_selection">
							<li><a href="/logout"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a></li>
						</ul>
					<?php else : ?>
						<a href="#">
							<i class="fa fa-user" aria-hidden="true"></i> Sign In / Register
							<i class="fa fa-angle-down"></i>
						</a>
						<ul class="account_selection">
							<li><a href="/login"><i class="fa fa-sign-in" aria-hidden="true"></i> Sign In</a></li>
							<li><a href="/register"><i class="fa fa-user-plus" aria-hidden="true"></i> Register</a></li>
						</ul>
					<?php endif; ?>
				</li>
					<li><a href="/index">beranda</a></li>
					<li><a href="/kategori">kategori</a></li>
					<li><a href="/kontak">Kontak</a></li>		
			</ul>
		</div>
	</div>

	<div class="container single_product_container">
		<div class="row">
			<div class="col">
		<br>
		<br>
		<div class="row">
    <div class="col-lg-7">
        <div class="single_product_pics">
            <div class="row">
                <!-- Thumbnails -->
                <div class="col-lg-3 thumbnails_col order-lg-1 order-2">
                    <div class="single_product_thumbnails">
                        <ul>
						<li><img src="<?= base_url('uploads/' . esc($product['gambar_2'])); ?>" alt="Thumbnail" data-image="<?= base_url('uploads/' . esc($product['gambar_1'])); ?>"></li>
						<li><img src="<?= base_url('uploads/' . esc($product['gambar_3'])); ?>" alt="Thumbnail" data-image="<?= base_url('uploads/' . esc($product['gambar_2'])); ?>"></li>
						<li><img src="<?= base_url('uploads/' . esc($product['gambar_4'])); ?>" alt="Thumbnail" data-image="<?= base_url('uploads/' . esc($product['gambar_3'])); ?>"></li>
                        </ul>
                    </div>
                </div>
                <!-- Main Image -->
                <div class="col-lg-9 image_col order-lg-2 order-1">
                    <div class="single_product_image">
						<div class="single_product_image_background" style="background-image:url(<?= base_url('uploads/' . esc($product['gambar_1'])); ?>" alt="Thumbnail" data-image="<?= base_url('uploads/' . esc($product['gambar_1'])); ?>"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-5">
        <div class="product_details">
            <!-- Product Title -->
            <div class="product_details_title">
				<h2><?= $product['nama_product'] ?></h2>
                <p><?= $product['product_detail'] ?></p>
            </div>

            <!-- Delivery Info -->
            <div class="free_delivery d-flex flex-row align-items-center justify-content-center">
                <span class="ti-truck"></span><span>Free Delivery</span>
            </div>

			<br>

            <?php if ($product['diskon'] > 0): ?>
				<div class="original_price">Rp <?= number_format($product['harga'], 0, ',', '.'); ?></div>
			<?php endif; ?>
			<div class="product_price">
				Rp <?= number_format($product['harga'] - ($product['harga'] * $product['diskon'] / 100), 0, ',', '.'); ?>
			</div>

            <!-- Rating -->
            <ul class="star_rating">
                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
            </ul>

			<div class="stok-container">
				Stok: <span><?= $product['stok'] ?></span>
			</div>

            <!-- Quantity Selector -->
            <div class="quantity d-flex flex-column flex-sm-row align-items-sm-center">
				<span>Quantity:</span>
				<div class="quantity_selector">
					<span class="minus"><i class="fa fa-minus" aria-hidden="true"></i></span>
					<span id="quantity_value">1</span>
					<span class="plus"><i class="fa fa-plus" aria-hidden="true"></i></span>
				</div>
				<!-- Tombol Add to Cart -->
				<div class="red_button add_to_cart_button">
					<a href="#" 
					id="add_to_cart_btn" 
					data-id="<?= $product['id_product']; ?>" 
					data-stock="<?= $product['stok']; ?>" 
					data-base-url="<?= base_url('single/addToCart'); ?>">
					Add to Cart
					</a>
				</div>
			</div>
			<!-- Kotak pesan error -->
		<div id="error_message" style="display: none; color: red; font-size: 14px; margin-top: 5px;"></div>
    </div>
</div>


	</div>

	<!-- Tabs -->

	<div class="tabs_section_container">

		<div class="container">
			<div class="row">
				<div class="col">
					<div class="tabs_container">
						<ul class="tabs d-flex flex-sm-row flex-column align-items-left align-items-md-center justify-content-center">
							<li class="tab active" data-active-tab="tab_1"><span>Deskripsi</span></li>
							<li class="tab" data-active-tab="tab_2"><span>Detail Produk</span></li>
							<li class="tab" data-active-tab="tab_3"><span>Reviews (2)</span></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col">

					<!-- Tab Description -->

					<div id="tab_1" class="tab_container active">
						<div class="row">
							<!-- Kolom Kiri -->
							<div class="col-lg-5 desc_col">
								<div class="tab_title">
									<h4>Deskripsi</h4>
								</div>
								<div class="tab_text_block">
									<!-- Menampilkan nama produk -->
									<h2><?= esc($product['nama_product']); ?></h2>

									<!-- Menampilkan deskripsi produk -->
									<p>
										<?= esc($product['deskripsi']); ?>
									</p>
								</div>

								<div class="tab_text_block">
									<h2>Manfaat Produk</h2>
									<ul>
										<?php if (!empty($product['manfaat'])): ?>
											<?php $manfaat = explode("\n", $product['manfaat']); // Asumsi manfaat dipisahkan oleh baris baru ?>
											<?php foreach ($manfaat as $item): ?>
												<li><?= esc($item); ?></li>
											<?php endforeach; ?>
										<?php else: ?>
											<p>No manfaat available</p>
										<?php endif; ?>
									</ul>
								</div>
							</div>

							<!-- Kolom Kanan -->
							<div class="col-lg-5 offset-lg-2 desc_col">
								<!-- Menampilkan Kandungan Utama -->
								<div class="tab_text_block">
									<h2>Kandungan Utama</h2>
									<ul>
										<?php if (!empty($product['kandungan'])): ?>
											<?php $kandungan = explode("\n", $product['kandungan']); // Asumsi kandungan dipisahkan oleh baris baru ?>
											<?php foreach ($kandungan as $item): ?>
												<li><?= esc($item); ?></li>
											<?php endforeach; ?>
										<?php else: ?>
											<p>No kandungan available</p>
										<?php endif; ?>
									</ul>
								</div>

								<!-- Menampilkan Cara Penggunaan -->
								<div class="tab_text_block">
									<h2>Cara Penggunaan</h2>
									<p>
										<?= esc($product['cara_penggunaan']); ?>
									</p>
								</div>
							</div>
						</div>
					</div>


					<!-- Tab Additional Info -->

					<div id="tab_2" class="tab_container">
						<div class="row">
							<div class="col additional_info_col">
								<div class="tab_title additional_info_title">
									<h4>Detail Produk</h4>
								</div>
								<div class="tab_text_block">
									<!-- Menampilkan Ukuran Produk -->
									<p><strong>Ukuran :</strong> <?= esc($product['ukuran']); ?></p>
									
									<!-- Menampilkan No BPOM Produk -->
									<p><strong>No BPOM :</strong> <?= esc($product['no_bpom']); ?></p>
								</div>
							</div>
						</div>
					</div>

					<!-- Tab Reviews -->

					<div id="tab_3" class="tab_container">
						<div class="row">

							<!-- User Reviews -->

							<div class="col-lg-6 reviews_col">
								<div class="tab_title reviews_title">
									<h4>Reviews (2)</h4>
								</div>

								<!-- User Review -->

								<div class="user_review_container d-flex flex-column flex-sm-row">
									<div class="user">
										<div class="user_pic">
											<img src="assets/img/pp.jpg" alt="User Profile Picture">
										</div>
										<div class="user_rating">
											<ul class="star_rating">
												<li><i class="fa fa-star" aria-hidden="true"></i></li>
												<li><i class="fa fa-star" aria-hidden="true"></i></li>
												<li><i class="fa fa-star" aria-hidden="true"></i></li>
												<li><i class="fa fa-star" aria-hidden="true"></i></li>
												<li><i class="fa fa-star" aria-hidden="true"></i></li>
											</ul>
										</div>
									</div>
									<div class="review">
										<div class="review_date">27 Okt 2024</div>
										<div class="user_name">Nadila Arofanti</div>
										<p>Baguss bangett cocok dikulit akuu, dipake sebelum tidur besoknya langsung lembabb dan glowingg</p>
									</div>
								</div>

								<!-- User Review -->

								<div class="user_review_container d-flex flex-column flex-sm-row">
									<div class="user">
										<div class="user_pic">
											<img src="assets/img/pp.jpg" alt="User Profile Picture">
										</div>
										<div class="user_rating">
											<ul class="star_rating">
												<li><i class="fa fa-star" aria-hidden="true"></i></li>
												<li><i class="fa fa-star" aria-hidden="true"></i></li>
												<li><i class="fa fa-star" aria-hidden="true"></i></li>
												<li><i class="fa fa-star" aria-hidden="true"></i></li>
												<li><i class="fa fa-star" aria-hidden="true"></i></li>
											</ul>
										</div>
									</div>
									<div class="review">
										<div class="review_date">10 Okt 2024</div>
										<div class="user_name">Nadila Cantik</div>
										<p>Produknya skintific emang gapernah gagal, sukaa bgtt sama moisturizer nyaa</p>
									</div>
								</div>

							<!-- Add Review -->

							<div class="col-lg-6 add_review_col">

								<div class="add_review">
									<form id="review_form" action="post">
										<div>
											<h1>Add Review</h1>
											<input id="review_name" class="form_input input_name" type="text" name="name" placeholder="Name*" required="required" data-error="Name is required.">
											<input id="review_email" class="form_input input_email" type="email" name="email" placeholder="Email*" required="required" data-error="Valid email is required.">
										</div>
										<div>
											<h1>Your Rating:</h1>
											<ul class="user_star_rating">
												<li><i class="fa fa-star" aria-hidden="true"></i></li>
												<li><i class="fa fa-star" aria-hidden="true"></i></li>
												<li><i class="fa fa-star" aria-hidden="true"></i></li>
												<li><i class="fa fa-star" aria-hidden="true"></i></li>
												<li><i class="fa fa-star-o" aria-hidden="true"></i></li>
											</ul>
											<textarea id="review_message" class="input_review" name="message"  placeholder="Your Review" rows="4" required data-error="Please, leave us a review."></textarea>
										</div>
										<div class="text-left">
											<button id="review_submit" type="submit" class="red_button review_submit_btn trans_300" value="Submit">submit</button>
										</div>
									</form>
								</div>

							</div>

						</div>
					</div>

				</div>
			</div>
		</div>

	</div>

	<!-- Benefit -->

	<div class="benefit">
		<div class="container">
			<div class="row benefit_row">
				<div class="col-lg-3 benefit_col">
					<div class="benefit_item d-flex flex-row align-items-center">
						<div class="benefit_icon"><i class="fa fa-truck" aria-hidden="true"></i></div>
						<div class="benefit_content">
							<h6>free shipping</h6>
							<p>Suffered Alteration in Some Form</p>
						</div>
					</div>
				</div>
				<div class="col-lg-3 benefit_col">
					<div class="benefit_item d-flex flex-row align-items-center">
						<div class="benefit_icon"><i class="fa fa-money" aria-hidden="true"></i></div>
						<div class="benefit_content">
							<h6>cach on delivery</h6>
							<p>The Internet Tend To Repeat</p>
						</div>
					</div>
				</div>
				<div class="col-lg-3 benefit_col">
					<div class="benefit_item d-flex flex-row align-items-center">
						<div class="benefit_icon"><i class="fa fa-undo" aria-hidden="true"></i></div>
						<div class="benefit_content">
							<h6>45 days return</h6>
							<p>Making it Look Like Readable</p>
						</div>
					</div>
				</div>
				<div class="col-lg-3 benefit_col">
					<div class="benefit_item d-flex flex-row align-items-center">
						<div class="benefit_icon"><i class="fa fa-clock-o" aria-hidden="true"></i></div>
						<div class="benefit_content">
							<h6>opening all week</h6>
							<p>8AM - 09PM</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Newsletter -->

	<div class="newsletter">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="newsletter_text d-flex flex-column justify-content-center align-items-lg-start align-items-md-center text-center">
						<h4>Newsletter</h4>
						<p>Subscribe to our newsletter and get 20% off your first purchase</p>
					</div>
				</div>
				<div class="col-lg-6">
					<form action="post">
						<div class="newsletter_form d-flex flex-md-row flex-column flex-xs-column align-items-center justify-content-lg-end justify-content-center">
							<input id="newsletter_email" type="email" placeholder="Your email" required="required" data-error="Valid email is required.">
							<button id="newsletter_submit" type="submit" class="newsletter_submit_btn trans_300" value="Submit">subscribe</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- Footer -->

	<footer class="footer">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="footer_nav_container d-flex flex-sm-row flex-column align-items-center justify-content-lg-start justify-content-center text-center">
						<ul class="footer_nav">
							<li><a href="#">Blog</a></li>
							<li><a href="#">FAQs</a></li>
							<li><a href="contact.html">Contact us</a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="footer_social d-flex flex-row align-items-center justify-content-lg-end justify-content-center">
						<ul>
							<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
							<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
							<li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
							<li><a href="#"><i class="fa fa-skype" aria-hidden="true"></i></a></li>
							<li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="footer_nav_container">
						<div class="cr">©2018 All Rights Reserverd. This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="#">Colorlib</a> &amp; distributed by <a href="https://themewagon.com">ThemeWagon</a></div>
					</div>
				</div>
			</div>
		</div>
	</footer>

</div>

<script src="<?= base_url('assets/js/jquery-3.2.1.min.js'); ?>"></script>
<script src="<?= base_url('assets/styles/bootstrap4/popper.js'); ?>"></script>
<script src="<?= base_url('assets/styles/bootstrap4/bootstrap.min.js'); ?>"></script>
<script src="<?= base_url('assets/plugins/Isotope/isotope.pkgd.min.js'); ?>"></script>
<script src="<?= base_url('assets/plugins/OwlCarousel2-2.2.1/owl.carousel.js'); ?>"></script>
<script src="<?= base_url('assets/plugins/easing/easing.js'); ?>"></script>
<script src="<?= base_url('assets/plugins/jquery-ui-1.12.1.custom/jquery-ui.js'); ?>"></script>
<script src="<?= base_url('assets/js/single_custom.js'); ?>"></script>
</body>

</html>
