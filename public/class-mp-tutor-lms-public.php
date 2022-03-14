<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://brandmarketers.id
 * @since      1.0.0
 *
 * @package    Mp_Tutor_Lms
 * @subpackage Mp_Tutor_Lms/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Mp_Tutor_Lms
 * @subpackage Mp_Tutor_Lms/public
 * @author     brandmarketers.id <wildan@brandmarketers.id>
 */
class Mp_Tutor_Lms_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function clean_styles_and_scripts(){
		$home = 'page' == get_option( 'show_on_front' );
		if ( is_page_template( 'public/partials/wishlist.php' ) || is_page_template( 'public/partials/inner-page.php' ) || is_page_template( 'public/partials/front-page.php' ) || is_singular('courses') || is_home() ) {
			$wp_scripts = wp_scripts();
			$wp_styles  = wp_styles();
			$themes_uri = get_theme_root_uri();

			foreach ( $wp_scripts->registered as $wp_script ) {
				if ( strpos( $wp_script->src, $themes_uri ) !== false ) {
					wp_deregister_script( $wp_script->handle );
				}
			}
			
			foreach ( $wp_styles->registered as $wp_style ) {
				if ( strpos( $wp_style->src, $themes_uri ) !== false ) {
					wp_deregister_style( $wp_style->handle );
				}
			}
		}
	}
	
	public function enqueue_styles() {

		// Style
		wp_enqueue_style( 'mp-style', plugin_dir_url( __FILE__ ) . 'css/style.css', array(), $this->version, 'all' );

		// Style Carousel
		wp_enqueue_style( 'mp-carousel', plugin_dir_url( __FILE__ ) . 'css/owl-carousel.min.css', array(), $this->version, 'all' );

		// Font Awesome
		wp_enqueue_style( 'mp-font-awesome', plugin_dir_url( __FILE__ ) . 'assets/fonts/fontawesome/css/all.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( 'mp-cookie', plugin_dir_url( __FILE__ ) . 'js/cookie.js', array(), $this->version, true );

		wp_enqueue_script( 'mp-carousel-jquery', plugin_dir_url( __FILE__ ) . 'js/script.js', array( 'jquery' ), $this->version, true );

		wp_enqueue_script( 'mp-carousel', plugin_dir_url( __FILE__ ) . 'js/owl-carousel.min.js', array(), $this->version, true );

		wp_enqueue_script( 'mp-carousel-action', plugin_dir_url( __FILE__ ) . 'js/owl-carousel-action.js', array(), $this->version, true );

	}

	/**
	 * Execute ajax courses
	 *
	 * @since    1.0.0
	 */
	public function courses_js_ajax_execute() { ?>
		<script type="text/javascript">
		jQuery(document).ready(function($) {

			var page_count = '<?php echo ceil(wp_count_posts($post_type = 'courses')->publish / 4); ?>';

			var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';

			var page = 2;

			jQuery('#load_more').click(function(){		

			var data = {
				'action': 'action_ajax_courses',
				'page': page
			};

			
			jQuery.post(ajaxurl, data, function(response) {

				jQuery('#container').append(response);

				if(page_count == page){

					jQuery('#load_more').hide();

				}

				page = page + 1;
			});

		});

		}); // ready
		</script> 
		<?php
	}

	/**
	 * Action ajax courses
	 *
	 * @since    1.0.0
	 */
	public function courses_action_ajax() {

		$post = array(
			'post_status'         => 'publish',
			'post_type'           => 'courses',
			'posts_per_page'      => 4,
			'paged' 			  => $_POST['page'],
		);

		$posting = new WP_Query( $post ); 

		if ( $posting->have_posts() ) : 
			?>
			<section class="posts-home-wrap">
				<div class="posts-home">
					<span class="title"><?php echo $popCoursesSubTitle; ?></span>
					<h2><?php echo $popCoursesTitle; ?></h2>
					<div class="boxes-item">
						<?php while( $posting->have_posts() ): $posting->the_post(); ?>      
							<a href="<?php the_permalink(); ?>">
								<div class="item">
									<div class="image">
										<?php the_post_thumbnail(); ?>
									</div>
									<div class="meta">
										<div class="category">
											<?php
											$course_categories       = get_tutor_course_categories();
											if( is_array($course_categories) && count($course_categories) ) :                                
												foreach ($course_categories as $course_category){
													$category_name = $course_category->name;
													$category_link = get_term_link($course_category->term_id);
													echo esc_html($category_name);
												}
											endif; 
											?>
										</div>
										<div class="title">
											<?php the_title(); ?>
										</div>
										<div class="info">
											<div class="durasi">
												<i class="far fa-clock"></i>
												<span><?php echo esc_html( get_tutor_course_duration_context() ); ?></span>
											</div>
											<div class="harga">
												<span><?php esc_html( tutor_course_price() ); ?></span>
											</div>
										</div>
									</div>             
								</div>
							</a> 
						<?php endwhile; ?>
						<?php wp_reset_postdata(); ?>
						<?php wp_die(); ?>
					</div> <!-- /boxes-item -->
				</div>
			</section>
		<?php endif;
	}

	/**
	 * Ajax js fetch
	 *
	 * @since    1.0.0
	 */
	public function search_box_ajax_fetch() {
		?>
		<script type="text/javascript">
		function fetch_results_ajax_search_box(){
			var keyword = jQuery('#searchInput').val();
			if(keyword == '' ){
				jQuery('#dataFetch').html('');
			} else {
				jQuery.ajax({
					url: '<?php echo admin_url('admin-ajax.php'); ?>',
					type: 'post',
					data: { action: 'data_fetch_ajax_search_box', keyword: keyword  },
					success: function(data) {
						if (keyword.length > 2) {
							jQuery('#dataFetch').html( data );
						}
					}
				});
			}
		}
		</script>
		
		<?php
	}

	/**
	 * Ajax data fetch
	 *
	 * @since    1.0.0
	 */
	public function data_fetch_ajax_search_box(){

		$post = array(
			'post_status'    => 'publish',
			'post_type'      => 'courses',
			'posts_per_page' => -1,
			's' 	         => esc_attr( $_POST['keyword'] ),
		);

		$posting = new WP_Query( $post ); 

		if ( $posting->have_posts() ) :
			echo '<div class="box-hasil-ajax">';
				echo '<ul>';
				echo '<span class="hasil-pencarian">Hasil Pencarian:</span>';
			while( $posting->have_posts() ): $posting->the_post(); ?>      
					<li>
						<div class="box-image">
							<a href="<?php the_permalink(); ?>">
								<?php the_post_thumbnail(); ?>
							</a>
						</div>
						<div class="box-meta">
							<div class="box-link-title">
								<a href="<?php the_permalink(); ?>">
									<?php the_title(); ?>
								</a>
							</div>
							<div class="box-link-cat">
								<?php
								$course_categories       = get_tutor_course_categories();
								if( is_array($course_categories) && count($course_categories) ) :                                
									foreach ($course_categories as $course_category){
										$category_name = $course_category->name;
										$category_link = get_term_link($course_category->term_id);

										echo '<a href="'.$category_link.'">'.$category_name.'</a>';
									}
								endif; 
								?>
							</div>
						</div><!-- // box-meta  -->
					</li> 
				
			<?php endwhile; 
				echo '</ul>';
			echo '</div>';
			wp_reset_postdata();
			wp_die();
		else: 
			echo '<span>NO results Found!</span>';
		endif;

	}

	/**
	 * Get post ID.
	 *
	 * @since    1.0.0
	 */
	public function get_post_id_custom() {
		global $post;

    	echo '<script type="text/javascript">';
    	echo 'let post_id_custom = ' . $post->ID;
    	echo '</script>';

	}

	/**
	 * Style Customize.
	 *
	 * @since    1.0.0
	 */
	function customize_style_header_navigasi() {

		wp_enqueue_style( 'mp-style', plugin_dir_url( __FILE__ ) . 'css/style.css', array(), $this->version, 'all' );

		$header_logo_icon_color  = get_theme_mod('header_logo_icon_color');
		$header_logo_title_color = get_theme_mod('header_logo_title_color');
		$header_bk 				 = get_theme_mod('header_bk');
		$header_color_link 	 	 = get_theme_mod('header_color_link');
		$header_color_wishlist   = get_theme_mod('header_color_wishlist');
		$header_color_cart_icon  = get_theme_mod('header_color_cart_icon');
		$header_color_cart_item  = get_theme_mod('header_color_cart_item');

		$headerNavigasi = "
			.primary1 .box-menu .logo-icon i {color:{$header_logo_icon_color};}
			.primary1 .box-menu .logo-icon span {color:{$header_logo_title_color};}
			.primary1 .container-primary1 { background:{$header_bk};}
			.box-menu>ul>li>a {color:{$header_color_link};}
			div.hamburger .bar {background:{$header_color_link};}
			div.wishlist-mobile-top a {color:{$header_color_link};}
			div.cart-mobile-top a {color:{$header_color_link};}
			.primary1 .box-menu .box-icon .wishlist i {color:{$header_color_wishlist};}
			.primary1 .box-menu .box-icon .wishlist a {color:{$header_color_wishlist};}
			.primary1 .box-menu .box-icon .cart i {color:{$header_color_cart_icon};}
			.primary1 .box-menu .box-icon .cart a {color:{$header_color_cart_icon};}
			.primary1 .box-menu .cart-number {background:{$header_color_cart_item};}
		";

		wp_add_inline_style( 'mp-style', $headerNavigasi );
	}

	/**
	 * Style Customize.
	 *
	 * @since    1.0.0
	 */	
	function customize_style_header_hero() {

		wp_enqueue_style( 'mp-style', plugin_dir_url( __FILE__ ) . 'css/style.css', array(), $this->version, 'all' );

		$header_title_top  		  = get_theme_mod('header_title_top');
		$header_title 			  = get_theme_mod('header_title');
		$header_sub_title 		  = get_theme_mod('header_sub_title');
		$header_hero_bk 	 	  = get_theme_mod('header_hero_bk');
		$header_title_color   	  = get_theme_mod('header_title_color');
		$header_sub_title_color   = get_theme_mod('header_sub_title_color');
		$header_search_bk  		  = get_theme_mod('header_search_bk');
		$header_icon_search_color = get_theme_mod('header_icon_search_color');

		$headerHero = "
			.header-home-wrap {background-color:{$header_hero_bk};}
			.header-home .txt h1 {color:{$header_title_color};}
			.header-home .txt p {color:{$header_sub_title_color};}
			.header-home .txt span {color:{$header_sub_title_color};}
			.header-home .box-search input {background-color:{$header_search_bk};}
			.header-home .box-search input {border-color:{$header_search_bk};}
			.header-home .box-search button {background-color:{$header_search_bk};}
			.header-home .box-search button {color:{$header_icon_search_color};}
		";

		wp_add_inline_style( 'mp-style', $headerHero );
	}

	/**
	 * Style Customize.
	 *
	 * @since    1.0.0
	 */	
	function customize_style_featured() {

		wp_enqueue_style( 'mp-style', plugin_dir_url( __FILE__ ) . 'css/style.css', array(), $this->version, 'all' );

		$featured_hero_bk 	  = get_theme_mod('featured_hero_bk');
		$featured_title_color = get_theme_mod('featured_title_color');
		$featured_text_color  = get_theme_mod('featured_text_color');
		$featured_icon_bk     = get_theme_mod('featured_icon_bk');
		$featured_icon_color  = get_theme_mod('featured_icon_color');

		$featured = "
			.featured-home-wrap {background:{$featured_hero_bk};}
			.featured-home h2 {color:{$featured_title_color};}
			.featured-home .title {color:{$featured_text_color};}
			.featured-home .boxes-item .item p {color:{$featured_text_color};}
			.featured-home .boxes-item .item i {background-color:{$featured_icon_bk};}
			.featured-home .boxes-item .item i {color:{$featured_icon_color};}
		";

		wp_add_inline_style( 'mp-style', $featured );
	}

	/**
	 * Style Customize.
	 *
	 * @since    1.0.0
	 */	
	function customize_style_populer_post() {

		wp_enqueue_style( 'mp-style', plugin_dir_url( __FILE__ ) . 'css/style.css', array(), $this->version, 'all' );

		$populer_courses_hero_bk 	  	  = get_theme_mod('populer_courses_hero_bk');
		$populer_courses_title_color 	  = get_theme_mod('populer_courses_title_color');
		$populer_courses_sub_title_color  = get_theme_mod('populer_courses_sub_title_color');
		$populer_courses_harga_dan_link   = get_theme_mod('populer_courses_harga_link');
		$populer_courses_color_and_border = get_theme_mod('populer_courses_color_and_border');

		$populerCourses = "
			.posts-home-wrap {background:{$populer_courses_hero_bk};}
			.posts-home h2 {color:{$populer_courses_title_color};}
			.posts-home .boxes-item a .title {color:{$populer_courses_title_color};}
			.posts-home .title {color:{$populer_courses_sub_title_color};}
			.posts-home .boxes-item a .category {color:{$populer_courses_sub_title_color};}
			.posts-home .boxes-item a .info .durasi i {color:{$populer_courses_sub_title_color};}
			.posts-home .boxes-item a .info .durasi span {color:{$populer_courses_sub_title_color};}
			.posts-home .boxes-item a .info .harga span {color:{$populer_courses_harga_dan_link};}
			.browse-all-course button {color:{$populer_courses_color_and_border};}
			.browse-all-course button {border-color:{$populer_courses_color_and_border};}
		";

		wp_add_inline_style( 'mp-style', $populerCourses );
	}

	/**
	 * Style Customize.
	 *
	 * @since    1.0.0
	 */	
	function customize_style_newsletter() {

		wp_enqueue_style( 'mp-style', plugin_dir_url( __FILE__ ) . 'css/style.css', array(), $this->version, 'all' );

		$newsletter_hero_bk 	  	= get_theme_mod('newsletter_hero_bk');
		$newsletter_title_color 	= get_theme_mod('newsletter_title_color');
		$newsletter_sub_title_color = get_theme_mod('newsletter_sub_title_color');
		$newsletter_btn_color       = get_theme_mod('newsletter_btn_color');
		$newsletter_btn_bk 			= get_theme_mod('newsletter_btn_bk');
		$newsletter_border_color    = get_theme_mod('newsletter_border_color');

		$newsletter = "
			.subscribe-wrap {background:{$newsletter_hero_bk};}
			.subscribe h2 {color:{$newsletter_title_color};}
			.subscribe .txt span {color:{$newsletter_sub_title_color};}
			.container-form button,
			.container-form input[type=submit] {color:{$newsletter_btn_color};}
			.container-form button,
			.container-form input[type=submit] {background:{$newsletter_btn_bk};}
			.container-form input[type=submit] {border-color:{$newsletter_btn_bk};}
			.container-form button {border-color:{$newsletter_btn_bk};}
			.container-form input {border-color:{$newsletter_border_color};}
		";

		wp_add_inline_style( 'mp-style', $newsletter );
	}

	/**
	 * Style Customize.
	 *
	 * @since    1.0.0
	 */	
	function customize_style_footer() {

		wp_enqueue_style( 'mp-style', plugin_dir_url( __FILE__ ) . 'css/style.css', array(), $this->version, 'all' );

		$footer_bk 	  	    = get_theme_mod('footer_bk');
		$footer_title_color = get_theme_mod('footer_title_color');
		$footer_txt_color   = get_theme_mod('footer_txt_color');

		$footer = "
			#footer {background:{$footer_bk};}
			.container-footer h4 {color:{$footer_title_color};}
			.container-footer .copyright span {color:{$footer_txt_color};}
		";

		wp_add_inline_style( 'mp-style', $footer );
	}
}
