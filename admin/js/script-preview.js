/**
 * File customize-preview.js.
 *
 * Instantly live-update customizer settings in the preview for improved user experience.
 */

/* =========================================
============ TABLE OF CONTENTS: ============
* Header Navigasi
* Header Hero
* Featured
* Populer Courses
* Testimonials
* Newsletter
* Footer
========================================= */
(function( $ ) {

	// =================== (Header Navigasi) ===================

	// Title
	wp.customize('MP_title', function (value) {
		value.bind(function (to) {
			$('.title-nav').text(to);
		});
	});

	// Icon
	wp.customize('MP_icon', function (value) {
		value.bind(function (to) {
			$('.icon-nav').html(to);
		});
	});

	// Background Color
	wp.customize('header_bk', function (value) {
		value.bind(function (to) {
			$('.primary1 .container-primary1').css('backgroundColor', to);
		});
	});

	// Logo Icon Color
	wp.customize('header_logo_icon_color', function (value) {
		value.bind(function (to) {
			$('.primary1 .box-menu .logo-icon i').css('color', to);
		});
	});

	// Logo Title Color
	wp.customize('header_logo_title_color', function (value) {
		value.bind(function (to) {
			$('.primary1 .box-menu .logo-icon span').css('color', to);
		});
	});
	
	// Color Link
	wp.customize('header_color_link', function (value) {
		value.bind(function (to) {
			$('.box-menu li a').css('color', to);
		});
	});	

	// Color Wishlist
	wp.customize('header_color_wishlist', function (value) {
		value.bind(function (to) {
			$('.primary1 .box-menu .box-icon .wishlist i').css('color', to);
			$('.primary1 .box-menu .box-icon .wishlist a').css('color', to);
		});
	});

	// Color Cart Icon
	wp.customize('header_color_cart_icon', function (value) {
		value.bind(function (to) {
			$('.primary1 .box-menu .box-icon .cart i').css('color', to);
			$('.primary1 .box-menu .box-icon .cart a').css('color', to);
			$('.primary1 .box-menu .cart-number').css('color', to);
		});
	});

	// Color Cart Item
	wp.customize('header_color_cart_item', function (value) {
		value.bind(function (to) {
			$('.primary1 .box-menu .cart-number').css('backgroundColor', to);
		});
	});

	// =================== (Header Hero) ===================

	// Title Top
	wp.customize('header_title_top', function (value) {
		value.bind(function (to) {
			$('.header-home .txt span').text(to);
		});
	});

	// Title
	wp.customize('header_title', function (value) {
		value.bind(function (to) {
			$('.header-home .txt h1').html(to);
		});
	});

	// Sub Title
	wp.customize('header_sub_title', function (value) {
		value.bind(function (to) {
			$('.header-home .txt p').text(to);
		});
	});

	// Background Color
	wp.customize('header_hero_bk', function (value) {
		value.bind(function (to) {
			$('.header-home-wrap').css('backgroundColor', to);
		});
	});

	// Title Color
	wp.customize('header_title_color', function (value) {
		value.bind(function (to) {
			$('.header-home .txt h1').css('color', to);
		});
	});
	
	// Sub Title Color
	wp.customize('header_sub_title_color', function (value) {
		value.bind(function (to) {
			$('.header-home .txt p').css('color', to);
			$('.header-home .txt span').css('color', to);
		});
	});

	// Background Search
	wp.customize('header_search_bk', function (value) {
		value.bind(function (to) {
			$('.header-home .box-search input').css('backgroundColor', to);
			$('.header-home .box-search input').css('borderColor', to);
			$('.header-home .box-search button').css('backgroundColor', to);
		});
	});

	// Color Icon Search
	wp.customize('header_icon_search_color', function (value) {
		value.bind(function (to) {
			$('.header-home .box-search button').css('color', to);
		});
	});

	// =================== (Featured) ===================

	// Title Top
	wp.customize('featured_sub_title', function (value) {
		value.bind(function (to) {
			$('.featured-home .title').text(to);
		});
	});

	// Title
	wp.customize('featured_title', function (value) {
		value.bind(function (to) {
			$('.featured-home h2').html(to);
		});
	});

	// Background Color
	wp.customize('featured_hero_bk', function (value) {
		value.bind(function (to) {
			$('.featured-home-wrap').css('backgroundColor', to);
		});
	});

	// Title Color
	wp.customize('featured_title_color', function (value) {
		value.bind(function (to) {
			$('.featured-home h2').css('color', to);
			$('.featured-home .boxes-item .item strong').css('color', to);
		});
	});
	
	// Text Color
	wp.customize('featured_text_color', function (value) {
		value.bind(function (to) {
			$('.featured-home .title').css('color', to);
			$('.featured-home .boxes-item .item p').css('color', to);
		});
	});

	// Background Icon
	wp.customize('featured_icon_bk', function (value) {
		value.bind(function (to) {
			$('.featured-home .boxes-item .item i').css('backgroundColor', to);
		});
	});

	// Color Icon
	wp.customize('featured_icon_color', function (value) {
		value.bind(function (to) {
			$('.featured-home .boxes-item .item i').css('color', to);
		});
	});

	// =================== (Populer Courses) ===================

	// Title
	wp.customize('populer_courses_title', function (value) {
		value.bind(function (to) {
			$('.posts-home h2').html(to);
		});
	});

	// Sub Title
	wp.customize('populer_courses_sub_title', function (value) {
		value.bind(function (to) {
			$('.posts-home > .title').text(to);
		});
	});

	// Background
	wp.customize('populer_courses_hero_bk', function (value) {
		value.bind(function (to) {
			$('.posts-home-wrap').css('backgroundColor', to);
		});
	});

	// Title
	wp.customize('populer_courses_title_color', function (value) {
		value.bind(function (to) {
			$('.posts-home h2').css('color', to);
			$('.posts-home .boxes-item a .title').css('color', to);
		});
	});

	// Sub Title
	wp.customize('populer_courses_sub_title_color', function (value) {
		value.bind(function (to) {
			$('.posts-home > .title').css('color', to);
			$('.posts-home .boxes-item a .category').css('color', to);
			$('.posts-home .boxes-item a .info .durasi i').css('color', to);
			$('.posts-home .boxes-item a .info .durasi span').css('color', to);
		});
	});

	// Color Harga & Link
	wp.customize('populer_courses_harga_link', function (value) {
		value.bind(function (to) {
			$('.posts-home .boxes-item a .info .harga span').css('color', to);
		});
	});

	// BTN Text
	wp.customize('populer_courses_btn_txt', function (value) {
		value.bind(function (to) {
			$('.browse-all-course button').text(to);
		});
	});

	// Border Color
	wp.customize('populer_courses_color_and_border', function (value) {
		value.bind(function (to) {
			$('.browse-all-course button').css('borderColor', to);
			$('.browse-all-course button').css('color', to);
		});
	});

	// =================== (Testimonials) ===================

	// Title
	wp.customize('testimonials_title', function (value) {
		value.bind(function (to) {
			$('#testimonials h2').text(to);
		});
	});

	// Sub Title
	wp.customize('testimonials_sub_title', function (value) {
		value.bind(function (to) {
			$('#testimonials .txt-top').text(to);
		});
	});

	// === Data User 1 ===

	// Pesan User 1
	wp.customize('testimonials_pesan1', function (value) {
		value.bind(function (to) {
			$('#testimonials .item1 .box-text h3').text(to);
		});
	});

	// Nama User 1
	wp.customize('testimonials_nama1', function (value) {
		value.bind(function (to) {
			$('#testimonials .item1 .box-text strong').text(to);
		});
	});

	// Latar Belakang User 1
	wp.customize('testimonials_lbelakang1', function (value) {
		value.bind(function (to) {
			$('#testimonials .item1 .box-text span').text(to);
		});
	});

	// Company User 1
	wp.customize('testimonials_company1', function (value) {
		value.bind(function (to) {
			$('#testimonials .item1 .box-text p').text(to);
		});
	});	

	// === Data User 2 ===

	// Pesan User 2
	wp.customize('testimonials_pesan2', function (value) {
		value.bind(function (to) {
			$('#testimonials .item2 .box-text h3').text(to);
		});
	});

	// Nama User 2
	wp.customize('testimonials_nama2', function (value) {
		value.bind(function (to) {
			$('#testimonials .item2 .box-text strong').text(to);
		});
	});

	// Latar Belakang User 2
	wp.customize('testimonials_lbelakang2', function (value) {
		value.bind(function (to) {
			$('#testimonials .item2 .box-text span').text(to);
		});
	});

	// Company User 2
	wp.customize('testimonials_company2', function (value) {
		value.bind(function (to) {
			$('#testimonials .item2 .box-text p').text(to);
		});
	});	

	// === Data User 3 ===

	// Pesan User 3
	wp.customize('testimonials_pesan3', function (value) {
		value.bind(function (to) {
			$('#testimonials .item3 .box-text h3').text(to);
		});
	});

	// Nama User 3
	wp.customize('testimonials_nama3', function (value) {
		value.bind(function (to) {
			$('#testimonials .item3 .box-text strong').text(to);
		});
	});

	// Latar Belakang User 3
	wp.customize('testimonials_lbelakang3', function (value) {
		value.bind(function (to) {
			$('#testimonials .item3 .box-text span').text(to);
		});
	});

	// Company User 3
	wp.customize('testimonials_company3', function (value) {
		value.bind(function (to) {
			$('#testimonials .item3 .box-text p').text(to);
		});
	});		

	// =================== (Newsletter) ===================

	// Title
	wp.customize('newsletter_title', function (value) {
		value.bind(function (to) {
			$('.subscribe h2').html(to);
		});
	});

	// Sub Title
	wp.customize('newsletter_sub_title', function (value) {
		value.bind(function (to) {
			$('.subscribe .txt span').text(to);
		});
	});

	// Embed HTML
	wp.customize('newsletter_embed_html', function (value) {
		value.bind(function (to) {
			$('.subscribe').html(to);
			$('.subscribe input').css('display', 'none');
			$('.subscribe input[type=email]').css('display', 'block');
			$('.subscribe input[type=submit]').css('display', 'block');
		});
	});

	// Background
	wp.customize('newsletter_hero_bk', function (value) {
		value.bind(function (to) {
			$('.subscribe-wrap').css('backgroundColor', to);
		});
	});

	// Color Title
	wp.customize('newsletter_title_color', function (value) {
		value.bind(function (to) {
			$('.subscribe h2').css('color', to);
		});
	});

	// Color Sub Title
	wp.customize('newsletter_sub_title_color', function (value) {
		value.bind(function (to) {
			$('.subscribe .txt span').css('color', to);
		});
	});

	// Color BTN
	wp.customize('newsletter_btn_color', function (value) {
		value.bind(function (to) {
			$('.container-form button').css('color', to);
			$('.container-form input[type=submit]').css('color', to);
		});
	});

	// Background BTN
	wp.customize('newsletter_btn_bk', function (value) {
		value.bind(function (to) {
			$('.container-form button').css('backgroundColor', to);
			$('.container-form input[type=submit]').css('backgroundColor', to);
			$('.container-form button').css('borderColor', to);
			$('.container-form input[type=submit]').css('borderColor', to);
		});
	});

	// Border Input
	wp.customize('newsletter_border_color', function (value) {
		value.bind(function (to) {
			$('.container-form input[type=email]').css('borderColor', to);
		});
	});

	// =================== (Footer) ===================

	// Background
	wp.customize('footer_bk', function (value) {
		value.bind(function (to) {
			$('#footer').css('backgroundColor', to);
		});
	});

	// Title Color
	wp.customize('footer_title_color', function (value) {
		value.bind(function (to) {
			$('.container-footer h4').css('color', to);
		});
	});

	// Title HTML
	wp.customize('footer_txt_bottom', function (value) {
		value.bind(function (to) {
			$('.container-footer .copyright span').html(to);
		});
	});

	// Txt Color
	wp.customize('footer_txt_color', function (value) {
		value.bind(function (to) {
			$('.container-footer .copyright span').css('color', to);
		});
	});


})( jQuery );
