(function( $ ) {
	'use strict';

	$('.meta-tabs .tab').click(function() {
		$('.meta-tabs .tab').removeClass('active').eq($(this).index()).addClass('active');
		$('.tab-item').hide().eq($(this).index()).fadeIn(500)
	}).eq(0).addClass('active');

	$('.hamburger').click(function() {
		$('.hamburger').toggleClass('active-burger');
		$('.menu-mobile').slideToggle();
	});

	$('.menu-item-has-children').append('<button class="arrow"><i class="fas fa-chevron-down"></i></button>');

	$('.menu-item-has-children .arrow').click(function(e) {
		$(this).prev('.sub-menu').slideToggle();
		$(this).toggleClass('arrow-up');
	});

	// Not Have Wishlist
	$('.single-courses .container .sidebar .not-have-wishlist span').click(function() {

		// Change style navbar.
		$('body').addClass('wishlist-active');

		// Add Cookie by id.
		if ( document.cookie.indexOf('MP-Wishlist') > -1 ) {

			let dataLama = Cookies.get('MP-Wishlist');
			let dataBaru = post_id_custom;
			let hasil    = dataLama.concat(', ', dataBaru);

			Cookies.set('MP-Wishlist', hasil, { expires: 365 });

		} else {
			let dataAwal = post_id_custom;
			Cookies.set('MP-Wishlist', dataAwal, { expires: 365 });
		}
	});

	// Have Wishlist
	$('.single-courses .container .sidebar .have-wishlist span').click(function() {

		// Change style navbar.
		$('body').removeClass('wishlist-active');

		// Remove Cookie by id.
		if ( document.cookie.indexOf('MP-Wishlist') > -1 ) {

			let getData = Cookies.get('MP-Wishlist').split(', ');
			let getID   = post_id_custom;

			// alert(getData.length);

			if ( getData.length != 1 ) {

				// Remove last coma
				getData = getData.toString().replace(/,\s*$/, "");

				// Parsing to JSON
				let parsing = JSON.parse("[" + getData + "]");

				// Filter unique data
				let unique = parsing.filter(function(itm, i, parsing) {
					return i == parsing.indexOf(itm);
				});
				
				// Conver unique value to String
				let convertString = unique.toString();

				// Remove last coma
				let removeComa = convertString.replace(getID, '').replace(/,\s*$/, "");

				// Convert to Objectk
				let akhirObj = removeComa.split(',');

				// Convert to String Anda add space
				let akhirStr = removeComa.toString().replace(/,/g, ", ");

				// Remove Cookie for request ID
				let final = akhirStr.replace(getID, ' ');

				// Execute update cookie
				Cookies.set('MP-Wishlist', final, { expires: 365 });

			}

			// Remove cookie count 1
			if ( getData.length == 1 ) {
				let dataCookie = Cookies.get('MP-Wishlist');
				let idPost     = post_id_custom;

				if ( dataCookie == idPost ) {
					Cookies.remove('MP-Wishlist');
				}
			}
			
		}
	});

	// Toggle change class wishlist
	$('.box-wishlist').click(function() {
		if ( $('.box-wishlist').hasClass('have-wishlist') ) {
			$('.have-wishlist').removeClass('have-wishlist').addClass('not-have-wishlist');
		} else if ( $('.box-wishlist').hasClass('not-have-wishlist') ) {
			$('.not-have-wishlist').removeClass('not-have-wishlist').addClass('have-wishlist');
		} else {
			return;
		}
	});

	// Toggle text wishlist
	$('.box-wishlist').click(function() {
		$('.box-wishlist span').text(function(i, oldText) {
			if (oldText === 'Add to Wishlist') {
				return 'Remove to Wishlist';
			} else if(oldText === 'Remove to Wishlist') {
				return 'Add to Wishlist';
			} else {
				return;
			}
		});
	});

	// Page wishlist remove all cookie
	$('.clear-all-wishlist').click(function() {
		if (confirm('Are you sure to delete all wishlists?') == true) {
			Cookies.remove('MP-Wishlist');
			location.reload();
		  } else {
			return false;
		  }
	});

	// Navigation Bottom
	var $navBar = $('.bottom-nav-bar');

	// find original navigation bar position
	var navPos = $navBar.offset().top;
  
	// on scroll
	$(window).scroll(function() {
  
		// get scroll position from top of the page
		var scrollPos = $(this).scrollTop();
  
		// check if scroll position is >= the nav position
		if ($(window).scrollTop() >= 330) {
			$navBar.addClass('nav-bottom-toggle');
		} else {
			$navBar.removeClass('nav-bottom-toggle');
		}
  
	});

})( jQuery );
