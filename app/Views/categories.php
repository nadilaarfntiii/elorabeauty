<!DOCTYPE html>
<html lang="en">
<head>
<title>Elora's Categories</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Colo Shop Template">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/styles/bootstrap4/bootstrap.min.css'); ?>">
<link href="<?= base_url('assets/plugins/font-awesome-4.7.0/css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/plugins/OwlCarousel2-2.2.1/owl.carousel.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/plugins/OwlCarousel2-2.2.1/owl.theme.default.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/plugins/OwlCarousel2-2.2.1/animate.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/plugins/jquery-ui-1.12.1.custom/jquery-ui.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/styles/categories_styles.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/styles/categories_responsive.css'); ?>">

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
								<li><a href="/index">Beranda</a></li>
								<li><a href="/categories">Kategori</a></li>
								<li><a href="/kontak">Kontak</a></li>
							</ul>
							<ul class="navbar_user">
								<li><a href="#"><i class="fa fa-search" aria-hidden="true"></i></a></li>
								<li>
									<a href="<?= site_url('orders'); ?>">
										<i class="fa fa-shopping-bag" aria-hidden="true"></i>
									</a>
								</li>
								<?php $session = session(); ?>
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
					<li><a href="/index">Beranda</a></li>
					<li><a href="/categories">Kategori</a></li>
					<li><a href="/kontak">Kontak</a></li>		
			</ul>
		</div>
	</div>

	<div class="container product_section_container">
		<div class="row">
			<div class="col product_section clearfix">

				<!-- Breadcrumbs -->

				<div class="breadcrumbs d-flex flex-row align-items-center">
					<ul>
						<li><a href="<?= site_url('index') ?>">Home</a></li>
						<?php if ($selected_category != 'all'): ?>
							<li class="active">
								<a href="<?= site_url('categories/' . $selected_category) ?>">
									<i class="fa fa-angle-right" aria-hidden="true"></i>
									<?= ucfirst($selected_category) ?> 
								</a>
							</li>
						<?php else: ?>
							<li class="active">
								<a href="#">
									<i class="fa fa-angle-right" aria-hidden="true"></i>
									All Products
								</a>
							</li>
						<?php endif; ?>
					</ul>
				</div>

				<!-- Sidebar -->

				<div class="sidebar">
					<div class="sidebar_section">
						<div class="sidebar_title">
							<h5>Product Category</h5>
						</div>
						<ul class="sidebar_categories">
							<li><a href="<?= site_url('categories/all') ?>" class="filter-category">All Products</a></li>
							<li><a href="<?= site_url('categories/makeup') ?>" class="filter-category">Makeup</a></li>
							<li><a href="<?= site_url('categories/skincare') ?>" class="filter-category">Skincare</a></li>
							<li><a href="<?= site_url('categories/hairnbody') ?>" class="filter-category">Hair & Body Care</a></li>
						</ul>
					</div>
				</div>


				<!-- Main Content -->

				<div class="main_content">

					<!-- Products -->

					<div class="products_iso">
						<div class="row">
							<div class="col">

								<!-- Product Sorting -->

								<div class="product_sorting_container product_sorting_container_top">
									<ul class="product_sorting">
										<li>
											<span class="type_sorting_text">Default Sorting</span>
											<i class="fa fa-angle-down"></i>
											<ul class="sorting_type">
												<li class="type_sorting_btn" data-isotope-option='{ "sortBy": "original-order" }'><span>Default Sorting</span></li>
												<li class="type_sorting_btn" data-isotope-option='{ "sortBy": "name" }'><span>Product Name</span></li>
											</ul>
										</li>
										<li>
											<span>Show</span>
											<span class="num_sorting_text">6</span>
											<i class="fa fa-angle-down"></i>
											<ul class="sorting_num">
												<li class="num_sorting_btn"><span>6</span></li>
												<li class="num_sorting_btn"><span>12</span></li>
												<li class="num_sorting_btn"><span>24</span></li>
											</ul>
										</li>
									</ul>
									<div class="pages d-flex flex-row align-items-center">
										<div class="page_current">
											<span>1</span>
											<ul class="page_selection">
												<li><a href="#">1</a></li>
												<li><a href="#">2</a></li>
												<li><a href="#">3</a></li>
											</ul>
										</div>
										<div class="page_total"><span>of</span> 3</div>
										<div id="next_page" class="page_next"><a href="#"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a></div>
									</div>

								</div>

								<!-- Product Grid -->

								<div class="product-grid">

									<!-- Product 1 -->

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
														<a href="/single/<?= $product['id_product']; ?>"><?= esc($product['nama_product']); ?></a>
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

								<!-- Product Sorting -->

								<div class="product_sorting_container product_sorting_container_bottom clearfix">
									<ul class="product_sorting">
										<li>
											<span>Show:</span>
											<span class="num_sorting_text">04</span>
											<i class="fa fa-angle-down"></i>
											<ul class="sorting_num">
												<li class="num_sorting_btn"><span>01</span></li>
												<li class="num_sorting_btn"><span>02</span></li>
												<li class="num_sorting_btn"><span>03</span></li>
												<li class="num_sorting_btn"><span>04</span></li>
											</ul>
										</li>
									</ul>
									<span class="showing_results">Showing 1–3 of 12 results</span>
									<div class="pages d-flex flex-row align-items-center">
										<div class="page_current">
											<span>1</span>
											<ul class="page_selection">
												<li><a href="#">1</a></li>
												<li><a href="#">2</a></li>
												<li><a href="#">3</a></li>
											</ul>
										</div>
										<div class="page_total"><span>of</span> 3</div>
										<div id="next_page_1" class="page_next"><a href="#"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a></div>
									</div>

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
					<div class="newsletter_form d-flex flex-md-row flex-column flex-xs-column align-items-center justify-content-lg-end justify-content-center">
						<input id="newsletter_email" type="email" placeholder="Your email" required="required" data-error="Valid email is required.">
						<button id="newsletter_submit" type="submit" class="newsletter_submit_btn trans_300" value="Submit">subscribe</button>
					</div>
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

<script src="<?= base_url('assets/js/jquery-3.2.1.min.js'); ?>"></script>
<script src="<?= base_url('assets/styles/bootstrap4/popper.js'); ?>"></script>
<script src="<?= base_url('assets/styles/bootstrap4/bootstrap.min.js'); ?>"></script>
<script src="<?= base_url('assets/plugins/Isotope/isotope.pkgd.min.js'); ?>"></script>
<script src="<?= base_url('assets/plugins/OwlCarousel2-2.2.1/owl.carousel.js'); ?>"></script>
<script src="<?= base_url('assets/plugins/easing/easing.js'); ?>"></script>
<script src="<?= base_url('assets/plugins/jquery-ui-1.12.1.custom/jquery-ui.js'); ?>"></script>
<script src="<?= base_url('assets/js/categories_custom.js'); ?>"></script>


</body>

</html>
