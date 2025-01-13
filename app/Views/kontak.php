<!DOCTYPE html>
<html lang="en">
<head>
<title>Contact Us</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Colo Shop Template">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="assets/styles/bootstrap4/bootstrap.min.css">
<link href="assets/plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="assets/plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="assets/plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="assets/plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" href="assets/plugins/themify-icons/themify-icons.css">
<link rel="stylesheet" type="text/css" href="assets/plugins/jquery-ui-1.12.1.custom/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="assets/styles/contact_styles.css">
<link rel="stylesheet" type="text/css" href="assets/styles/contact_responsive.css">
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
							<a href="/">Elo<span>ra's</span></a>
						</div>
						<nav class="navbar">
							<ul class="navbar_menu">
								<li><a href="/index">beranda</a></li>
								<li><a href="/categories">kategori</a></li>
								<li><a href="/kontak">Kontak</a></li>
							</ul>
							<ul class="navbar_user">
								<li><a href="#"><i class="fa fa-search" aria-hidden="true"></i></a></li>
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


	<div class="container contact_container">
		<div class="row">
			<div class="col">

				<!-- Breadcrumbs -->

				<div class="breadcrumbs d-flex flex-row align-items-center">
					<ul>
						<li><a href="/">Home</a></li>
						<li class="active"><a href="/kontak"><i class="fa fa-angle-right" aria-hidden="true"></i>Contact</a></li>
					</ul>
				</div>

			</div>
		</div>

		<div class="row">

			<div class="col-lg-6 contact_col">
				<div class="contact_contents">
					<h1>Contact Us</h1>
					<p> Hubungi kami untuk memberikan kritik & saran</p>
					<div>
						<p>0857-2727-5037</p>
						<p>nadila4313@gmail.com</p>
					</div>
				</div>

				<!-- Follow Us -->

				<div class="follow_us_contents">
					<h1>Follow Us</h1>
					<ul class="social d-flex flex-row">
						<li><a href="#" style="background-color: #3a61c9"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
						<li><a href="#" style="background-color: #41a1f6"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
						<li><a href="#" style="background-color: #fb4343"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
						<li><a href="#" style="background-color: #8f6247"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
					</ul>
				</div>

			</div>

			<div class="col-lg-6 get_in_touch_col">
				<div class="get_in_touch_contents">
					<h1>Get In Touch With Us!</h1>
					<p>Fill out the form below to recieve a free and confidential.</p>
					<form action="post">
						<div>
							<input id="input_name" class="form_input input_name input_ph" type="text" name="name" placeholder="Name" required="required" data-error="Name is required.">
							<input id="input_email" class="form_input input_email input_ph" type="email" name="email" placeholder="Email" required="required" data-error="Valid email is required.">
							<input id="input_website" class="form_input input_website input_ph" type="url" name="name" placeholder="Website" required="required" data-error="Name is required.">
							<textarea id="input_message" class="input_ph input_message" name="message"  placeholder="Message" rows="3" required data-error="Please, write us a message."></textarea>
						</div>
						<div>
							<button id="review_submit" type="submit" class="red_button message_submit_btn trans_300" value="Submit">send message</button>
						</div>
					</form>
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

<script src="assets/js/jquery-3.2.1.min.js"></script>
<script src="assets/styles/bootstrap4/popper.js"></script>
<script src="assets/styles/bootstrap4/bootstrap.min.js"></script>
<script src="assets/plugins/Isotope/isotope.pkgd.min.js"></script>
<script src="assets/plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="assets/plugins/easing/easing.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyCIwF204lFZg1y4kPSIhKaHEXMLYxxuMhA"></script>
<script src="assets/plugins/jquery-ui-1.12.1.custom/jquery-ui.js"></script>
<script src="assets/js/contact_custom.js"></script>
</body>

</html>
