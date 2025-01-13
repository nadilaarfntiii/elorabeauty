/* JS Document */

/******************************

[Table of Contents]

1. Vars and Inits
2. Set Header
3. Init Menu
4. Init Thumbnail
5. Init Quantity
6. Init Star Rating
7. Init Favorite
8. Init Tabs



******************************/

jQuery(document).ready(function($)
{
	"use strict";

	/* 

	1. Vars and Inits

	*/

	var header = $('.header');
	var topNav = $('.top_nav')
	var hamburger = $('.hamburger_container');
	var menu = $('.hamburger_menu');
	var menuActive = false;
	var hamburgerClose = $('.hamburger_close');
	var fsOverlay = $('.fs_menu_overlay');

	setHeader();

	$(window).on('resize', function()
	{
		setHeader();
	});

	$(document).on('scroll', function()
	{
		setHeader();
	});

	initMenu();
	initThumbnail();
	initQuantity();
	initStarRating();
	initFavorite();
	initTabs();

	/* 

	2. Set Header

	*/

	function setHeader()
	{
		if(window.innerWidth < 992)
		{
			if($(window).scrollTop() > 100)
			{
				header.css({'top':"0"});
			}
			else
			{
				header.css({'top':"0"});
			}
		}
		else
		{
			if($(window).scrollTop() > 100)
			{
				header.css({'top':"-50px"});
			}
			else
			{
				header.css({'top':"0"});
			}
		}
		if(window.innerWidth > 991 && menuActive)
		{
			closeMenu();
		}
	}

	/* 

	3. Init Menu

	*/

	function initMenu()
	{
		if(hamburger.length)
		{
			hamburger.on('click', function()
			{
				if(!menuActive)
				{
					openMenu();
				}
			});
		}

		if(fsOverlay.length)
		{
			fsOverlay.on('click', function()
			{
				if(menuActive)
				{
					closeMenu();
				}
			});
		}

		if(hamburgerClose.length)
		{
			hamburgerClose.on('click', function()
			{
				if(menuActive)
				{
					closeMenu();
				}
			});
		}

		if($('.menu_item').length)
		{
			var items = document.getElementsByClassName('menu_item');
			var i;

			for(i = 0; i < items.length; i++)
			{
				if(items[i].classList.contains("has-children"))
				{
					items[i].onclick = function()
					{
						this.classList.toggle("active");
						var panel = this.children[1];
					    if(panel.style.maxHeight)
					    {
					    	panel.style.maxHeight = null;
					    }
					    else
					    {
					    	panel.style.maxHeight = panel.scrollHeight + "px";
					    }
					}
				}	
			}
		}
	}

	function openMenu()
	{
		menu.addClass('active');
		// menu.css('right', "0");
		fsOverlay.css('pointer-events', "auto");
		menuActive = true;
	}

	function closeMenu()
	{
		menu.removeClass('active');
		fsOverlay.css('pointer-events', "none");
		menuActive = false;
	}

	/* 

	4. Init Thumbnail

	*/

	function initThumbnail()
	{
		if($('.single_product_thumbnails ul li').length)
		{
			var thumbs = $('.single_product_thumbnails ul li');
			var singleImage = $('.single_product_image_background');

			thumbs.each(function()
			{
				var item = $(this);
				item.on('click', function()
				{
					thumbs.removeClass('active');
					item.addClass('active');
					var img = item.find('img').data('image');
					singleImage.css('background-image', 'url(' + img + ')');
				});
			});
		}	
	}

	/* 

	5. Init Quantity

	*/

	/* function initQuantity()
	{
		if($('.plus').length && $('.minus').length)
		{
			var plus = $('.plus');
			var minus = $('.minus');
			var value = $('#quantity_value');

			plus.on('click', function()
			{
				var x = parseInt(value.text());
				value.text(x + 1);
			});

			minus.on('click', function()
			{
				var x = parseInt(value.text());
				if(x > 1)
				{
					value.text(x - 1);
				}
			});
		}
	} */

	function initQuantity() {
		if ($('.plus').length && $('.minus').length) {
			var plus = $('.plus');
			var minus = $('.minus');
			var value = $('#quantity_value');
			var addToCartBtn = $('#add_to_cart_btn'); // Tombol Add to Cart
			var errorMessage = $('#error_message'); // Kotak pesan error
			var maxStock = parseInt(addToCartBtn.data('stock')); // Ambil stok maksimum dari atribut data-stock
	
			// Fungsi untuk menampilkan pesan error
			function showError(message) {
				errorMessage.text(message).show(); // Tampilkan pesan error
			}
	
			// Fungsi untuk menyembunyikan pesan error
			function hideError() {
				errorMessage.hide(); // Sembunyikan pesan error
			}
	
			// Fungsi untuk menambah quantity
			plus.on('click', function () {
				var x = parseInt(value.text());
				if (x + 1 > maxStock) {
					showError(`Maksimal stok tersedia adalah ${maxStock}.`);
				} else {
					value.text(x + 1);
					hideError(); // Sembunyikan pesan jika jumlah valid
				}
			});
	
			// Fungsi untuk mengurangi quantity
			minus.on('click', function () {
				var x = parseInt(value.text());
				if (x > 1) {
					value.text(x - 1);
					hideError(); // Sembunyikan pesan jika jumlah valid
				}
			});
	
			// Fungsi ketika tombol Add to Cart diklik
			addToCartBtn.on('click', function (event) {
				event.preventDefault();
	
				// Ambil data ID produk dari tombol
				var productId = $(this).data('id'); // Ambil productId dari data-id
				var quantity = parseInt(value.text()); // Ambil nilai quantity sebagai angka
				var baseUrl = $(this).data('base-url'); // Ambil base URL dari data-base-url
	
				// Validasi data
				if (!baseUrl || !productId || isNaN(quantity) || quantity <= 0) {
					alert("Terjadi kesalahan: Base URL, ID produk, atau quantity tidak valid.");
					return;
				}
	
				// Validasi stok sebelum mengirimkan permintaan
				if (quantity > maxStock) {
					showError(`Maksimal stok tersedia adalah ${maxStock}.`);
					return;
				}
	
				// Debugging untuk memastikan nilai productId, quantity, dan baseUrl
				console.log("Base URL: " + baseUrl);
				console.log("Product ID: " + productId + ", Quantity: " + quantity);
	
				// Buat URL Add to Cart
				var addToCartUrl = `${baseUrl}/${productId}/${quantity}`;
	
				// Debugging untuk memastikan URL benar
				console.log("Redirecting to: " + addToCartUrl);
	
				// Redirect ke URL tersebut
				window.location.href = addToCartUrl;
			});
		}
	}
	
	
	
	
	
	
	
	

	/* 

	6. Init Star Rating

	*/

	function initStarRating()
	{
		if($('.user_star_rating li').length)
		{
			var stars = $('.user_star_rating li');

			stars.each(function()
			{
				var star = $(this);

				star.on('click', function()
				{
					var i = star.index();

					stars.find('i').each(function()
					{
						$(this).removeClass('fa-star');
						$(this).addClass('fa-star-o');
					});
					for(var x = 0; x <= i; x++)
					{
						$(stars[x]).find('i').removeClass('fa-star-o');
						$(stars[x]).find('i').addClass('fa-star');
					};
				});
			});
		}
	}

	/* 

	7. Init Favorite

	*/

	function initFavorite()
	{
		if($('.product_favorite').length)
		{
			var fav = $('.product_favorite');

			fav.on('click', function()
			{
				fav.toggleClass('active');
			});
		}
	}

	/* 

	8. Init Tabs

	*/

	function initTabs()
	{
		if($('.tabs').length)
		{
			var tabs = $('.tabs li');
			var tabContainers = $('.tab_container');

			tabs.each(function()
			{
				var tab = $(this);
				var tab_id = tab.data('active-tab');

				tab.on('click', function()
				{
					if(!tab.hasClass('active'))
					{
						tabs.removeClass('active');
						tabContainers.removeClass('active');
						tab.addClass('active');
						$('#' + tab_id).addClass('active');
					}
				});
			});
		}
	}
});