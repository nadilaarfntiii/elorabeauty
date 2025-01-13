<!DOCTYPE html>
<html lang="en">
<head>
<title>Elora's</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Colo Shop Template">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="<?= base_url('/public/assets/styles/bootstrap4/bootstrap.min.css'); ?>">
<link href="<?= base_url('/public/assets/plugins/font-awesome-4.7.0/css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="<?= base_url('/public/assets/plugins/OwlCarousel2-2.2.1/owl.carousel.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?= base_url('/public/assets/plugins/OwlCarousel2-2.2.1/owl.theme.default.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?= base_url('/public/assets/plugins/OwlCarousel2-2.2.1/animate.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?= base_url('/public/assets/styles/main_styles.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?= base_url('/public/assets/styles/responsive.css'); ?>">
<style>

</style>
</head>

<body>

<div class="super_container">

	<!-- Header -->

	<header class="header trans_300">
	<?php $session = session(); ?>

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
								<!-- whatsapp -->
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
								<li><a href="/categories">kategori</a></li>
								<li><a href="/kontak">Kontak</a></li>
							</ul>
							<ul class="navbar_user">
								<li><a href="#"><i class="fa fa-search" aria-hidden="true"></i></a></li>
								<!-- <li><a href="#"><i class="fa fa-user" aria-hidden="true"></i></a></li> -->
								<li>
									<a href="<?= site_url('orders'); ?>">
										<i class="fa fa-shopping-bag" aria-hidden="true"></i>
									</a>
								</li>
								<li class="checkout">
									<a href="<?= site_url('cart'); ?>">
										<i class="fa fa-shopping-cart" aria-hidden="true"></i>
										<span id="checkout_items" class="checkout_items"><?= htmlspecialchars($cart_count ?? 0, ENT_QUOTES, 'UTF-8'); ?></span>
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
					<li><a href="/categories">kategori</a></li>
					<li><a href="/kontak">Kontak</a></li>		
			</ul>
		</div>
	</div>

	<!-- Slider -->

	<div class="main_slider">
    <div id="carouselExample" class="carousel slide" data-ride="carousel" style="max-width: 70%; margin: auto;">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div style="background-image:url(/public/assets/img/1.png); height: 90vh; background-size: contain; background-position: center; background-repeat: no-repeat; display: flex; justify-content: center; align-items: center;">
                </div>
            </div>
            <div class="carousel-item">
                <div style="background-image:url(/public/assets/img/2.png); height: 90vh; background-size: contain; background-position: center; background-repeat: no-repeat; display: flex; justify-content: center; align-items: center;">
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev" style="position: absolute; top: 50%; transform: translateY(-50%); left: 10px;">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExample" role="button" data-slide="next" style="position: absolute; top: 50%; transform: translateY(-50%); right: 10px;">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>




	<!-- Banner -->

	<div class="banner">
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<div class="banner_item align-items-center" style="background-image:url(assets/img/skincare.avif)">
						<div class="banner_category">
							<a href="categories/skincare">Skincare</a>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="banner_item align-items-center" style="background-image:url(assets/img/makeup.jpg)">
						<div class="banner_category">
							<a href="categories/makeup">Make Up</a>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="banner_item align-items-center" style="background-image:url(assets/img/bodycare.jpg)">
						<div class="banner_category">
							<a href="categories/hairnbody">Hair & Bodycare</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- New Arrivals -->

	<div class="new_arrivals">
		<div class="container">
			<div class="row">
				<div class="col text-center">
					<div class="section_title new_arrivals_title">
						<h2>Produk</h2>
					</div>
				</div>
			</div>
			<div class="row align-items-center">
				<div class="col text-center">
					<div class="new_arrivals_sorting">
						<ul class="arrivals_grid_sorting clearfix button-group filters-button-group">
							<li class="grid_sorting_button button d-flex flex-column justify-content-center align-items-center active is-checked" data-filter="*" onclick="filterProducts('all')">all</li>
							<li class="grid_sorting_button button d-flex flex-column justify-content-center align-items-center" data-filter=".skincare" onclick="filterProducts('skincare')">skincare</li>
							<li class="grid_sorting_button button d-flex flex-column justify-content-center align-items-center" data-filter=".makeup" onclick="filterProducts('makeup')">makeup</li>
							<li class="grid_sorting_button button d-flex flex-column justify-content-center align-items-center" data-filter=".hairnbody" onclick="filterProducts('hairnbody')">hair & bodycare</li>
						</ul>
					</div>
				</div>
			</div>

			<<div class="row">
			<!-- <div class="col"> -->
				<?php if (!empty($products)): ?>
					<?php foreach ($products as $product): ?>
						<!-- Product 1 -->
						<div class="product-item <?= strtolower($product['nm_kategori']); ?>">
							<div class="product product_filter">
								<div class="product_image">
									<img src="<?= base_url('uploads/' . esc($product['gambar_1'])); ?>" alt="<?= esc($product['nama_product']); ?>">
								</div>
								<div class="favorite"></div>
								<?php if ($product['diskon']): ?>
									<div class="product_bubble product_bubble_left product_bubble_red d-flex flex-column align-items-center">
										<span>-<?= $product['diskon']; ?>%</span>
									</div>
								<?php endif; ?>
								<div class="product_info">
									<h6 class="product_name">
										<a href="/single/<?= $product['id_product']; ?>">
											<?= esc(strlen($product['nama_product']) > 25 ? substr($product['nama_product'], 0, 25) . '...' : $product['nama_product']); ?>	
										</a>
									</h6>
									<div class="product_price">
										<?php if ($product['diskon']): ?>
											<?php
											$harga_diskon = $product['harga'] - ($product['harga'] * $product['diskon'] / 100);
											?>
											Rp <?= number_format($harga_diskon, 0, ',', '.'); ?> <!-- Harga setelah diskon -->
											<span>Rp <?= number_format($product['harga'], 0, ',', '.'); ?></span> <!-- Harga asli -->
										<?php else: ?>
											Rp <?= number_format($product['harga'], 0, ',', '.'); ?> <!-- Harga tanpa diskon -->
										<?php endif; ?>
									</div>
									<div class="product_stok">
										Stok : <?= $product['stok'] > 0 ? $product['stok'] : 'Out of stock'; ?>
									</div>
								</div>
							</div>
							<div class="red_button add_to_cart_button">
								<a href="<?= site_url('cart/addToCart/'.$product['id_product']); ?>">add to cart</a>
							</div>
						</div>
					<?php endforeach; ?>
				<?php else: ?>
					<p>No products available.</p>
				<?php endif; ?>
			</div>
		<!-- </div> -->

	<div class="best_sellers">
		<div class="container">
			<div class="row">
				<div class="col text-center">
					<div class="section_title new_arrivals_title">
						<h2>Best Sellers</h2>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<div class="product_slider_container">
						<div class="owl-carousel owl-theme product_slider">

							<!-- Slide 1 -->

							<?php if (!empty($products) && is_array($products)) : ?>
								<?php foreach ($products as $product) : ?>
									<div class="owl-item product_slider_item">
										<div class="product-item <?= strtolower($product['nm_kategori']) ?>">
											<div class="product discount">
												<div class="product_image">
													<img src="<?= base_url('uploads/' . esc($product['gambar_1'])); ?>" alt="<?= esc($product['nama_product']); ?>">
												</div>
												<?php if ($product['diskon'] > 0) : ?>
													<div class="product_bubble product_bubble_right product_bubble_red d-flex flex-column align-items-center">
														<span>-<?= esc($product['diskon']) ?>%</span>
													</div>
												<?php endif; ?>
												<div class="product_info">
													<h6 class="product_name">
													<a href="/single/<?= $product['id_product']; ?>">
														<?= esc(strlen($product['nama_product']) > 25 ? substr($product['nama_product'], 0, 25) . '...' : $product['nama_product']); ?>	
													</a>
													</h6>
													<div class="product_price">
														Rp <?= number_format($product['harga'] * (1 - $product['diskon'] / 100), 0, ',', '.') ?>
														<?php if ($product['diskon'] > 0) : ?>
															<span>Rp <?= number_format($product['harga'], 0, ',', '.') ?></span>
														<?php endif; ?>
													</div>
												</div>
											</div>
										</div>
									</div>
								<?php endforeach; ?>
							<?php else : ?>
								<p>Produk tidak ditemukan.</p>
							<?php endif; ?>
						</div>

						<!-- Slider Navigation -->

						<div class="product_slider_nav_left product_slider_nav d-flex align-items-center justify-content-center flex-column">
							<i class="fa fa-chevron-left" aria-hidden="true"></i>
						</div>
						<div class="product_slider_nav_right product_slider_nav d-flex align-items-center justify-content-center flex-column">
							<i class="fa fa-chevron-right" aria-hidden="true"></i>
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

	<!-- Blogs -->

	<div class="blogs">
		<div class="container">
			<div class="row">
				<div class="col text-center">
					<div class="section_title">
						<h2>Latest Blogs</h2>
					</div>
				</div>
			</div>
			<div class="row blogs_container">
				<div class="col-lg-4 blog_item_col">
					<div class="blog_item">
						<div class="blog_background" style="background-image:url(assets/img/blog1.jpg)"></div>
						<div class="blog_content d-flex flex-column align-items-center justify-content-center text-center">
							<h4 class="blog_title">4 Toner Skintific yang Bantu Kulit Jadi Glowing To The Max!</h4>
							<span class="blog_meta">by BeautyHaul | 1 Oktober 2024</span>
							<a class="blog_more" href="https://www.beautyhaul.com/blog/4-toner-skintific-yang-bantu-kulit-jadi-glowing-to-the-max">Read more</a>
						</div>
					</div>
				</div>
				<div class="col-lg-4 blog_item_col">
					<div class="blog_item">
						<div class="blog_background" style="background-image:url(assets/img/blog2.jpg)"></div>
						<div class="blog_content d-flex flex-column align-items-center justify-content-center text-center">
							<h4 class="blog_title">Foundation Terbaik untuk Kulit Berminyak dan Tahan Lama Seharian</h4>
							<span class="blog_meta">by BeautyHaul | 18 September 2024</span>
							<a class="blog_more" href="https://www.beautyhaul.com/blog/foundation-terbaik-untuk-kulit-berminyak-dan-tahan-lama-seharian">Read more</a>
						</div>
					</div>
				</div>
				<div class="col-lg-4 blog_item_col">
					<div class="blog_item">
						<div class="blog_background" style="background-image:url(assets/img/blog3.jpg)"></div>
						<div class="blog_content d-flex flex-column align-items-center justify-content-center text-center">
							<h4 class="blog_title">5 Rekomendasi Acne Patch untuk Hempas Jerawat dengan Maksimal!</h4>
							<span class="blog_meta">by BeautyHaul | 24 September 2024</span>
							<a class="blog_more" href="https://www.beautyhaul.com/blog/5-rekomendasi-acne-patch-untuk-hempas-jerawat-dengan-maksimal">Read more</a>
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
						<div class="cr">Elora's | NADILA AROFANTI | 22.230.0072 <i class="fa fa-heart-o" aria-hidden="true"></i></div>
					</div>
				</div>
			</div>
		</div>
	</footer>

</div>

<script src="<?= base_url('/public/assets/js/jquery-3.2.1.min.js'); ?>"></script>
<script src="<?= base_url('/public/assets/styles/bootstrap4/popper.js'); ?>"></script>
<script src="<?= base_url('/public/assets/styles/bootstrap4/bootstrap.min.js'); ?>"></script>
<script src="<?= base_url('/public/assets/plugins/Isotope/isotope.pkgd.min.js'); ?>"></script>
<script src="<?= base_url('/public/assets/plugins/OwlCarousel2-2.2.1/owl.carousel.js'); ?>"></script>
<script src="<?= base_url('/public/assets/plugins/easing/easing.js'); ?>"></script>
<script src="<?= base_url('/public/assets/js/custom.js'); ?>"></script>

<script>
    function filterProducts(category) {
        if (category == 'all') {
            $(".product-item").show();
        } else {
            $(".product-item").hide();
            $("." + category).show();
        }
        $(".grid_sorting_button").removeClass("active is-checked");
        $('[data-filter=".' + category + '"]').addClass("active is-checked");
    }
</script>
</body>

</html>
