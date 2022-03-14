/**
 * Scripts within the customizer controls window.
 *
 * Contextually shows the color hue control and informs the preview
 * when users open or close the front page sections section.
 */

(function() {
	wp.customize.bind( 'ready', function() {

		// =================== (Header Navigasi) ===================

		// Toggle MP Icon / Logo
		wp.customize( 'MP_toggle_icon_logo', function( setting ) {
			wp.customize.control( 'MP_icon', function( control ) {
				var visibility = function() {
					if ( 'yes' == setting.get() ) {
						control.container.slideDown( 200 );
					} else if ( 'no' == setting.get() ) {
						control.container.slideUp( 200 );
					}	
				};
				
				visibility();
				setting.bind( visibility );
			});

			// Title
			wp.customize.control( 'MP_title', function( control ) {
				var visibility = function() {
					if ( 'yes' == setting.get() ) {
						control.container.slideDown( 200 );
					} else if ( 'no' == setting.get() ) {
						control.container.slideUp( 200 );
					}	
				};
				
				visibility();
				setting.bind( visibility );
			});

			// Logo
			wp.customize.control( 'MP_logo', function( control ) {
				var visibility = function() {
					if ( 'no' == setting.get() ) {
						control.container.slideDown( 200 );
					} else if ( 'yes' == setting.get() ) {
						control.container.slideUp( 200 );
					}	
				};
				visibility();
				setting.bind( visibility );
			});

			// Icon Color
			wp.customize.control( 'header_logo_icon_color', function( control ) {
				var visibility = function() {
					if ( 'yes' == setting.get() ) {
						control.container.slideDown( 200 );
					} else if ( 'no' == setting.get() ) {
						control.container.slideUp( 200 );
					}	
				};
				visibility();
				setting.bind( visibility );
			});

			// Title Color
			wp.customize.control( 'header_logo_title_color', function( control ) {
				var visibility = function() {
					if ( 'yes' == setting.get() ) {
						control.container.slideDown( 200 );
					} else if ( 'no' == setting.get() ) {
						control.container.slideUp( 200 );
					}	
				};
				visibility();
				setting.bind( visibility );
			});
		});
	});
})();