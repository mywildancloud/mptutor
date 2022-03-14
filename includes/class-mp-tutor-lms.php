<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://brandmarketers.id
 * @since      1.0.0
 *
 * @package    Mp_Tutor_Lms
 * @subpackage Mp_Tutor_Lms/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Mp_Tutor_Lms
 * @subpackage Mp_Tutor_Lms/includes
 * @author     brandmarketers.id <wildan@brandmarketers.id>
 */
class Mp_Tutor_Lms {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Mp_Tutor_Lms_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'MP_TUTOR_LMS_VERSION' ) ) {
			$this->version = MP_TUTOR_LMS_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'mp-tutor-lms';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
		

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Mp_Tutor_Lms_Loader. Orchestrates the hooks of the plugin.
	 * - Mp_Tutor_Lms_i18n. Defines internationalization functionality.
	 * - Mp_Tutor_Lms_Admin. Defines all hooks for the admin area.
	 * - Mp_Tutor_Lms_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-mp-tutor-lms-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-mp-tutor-lms-i18n.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * class TinyMCE Editor.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/customize/class-customize.php';

		/**
		 * The class responsible for defining all actions that occur in the customize header navigasi.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/customize/header-navigasi.php';

		/**
		 * The class responsible for defining all actions that occur in the customize header hero.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/customize/header-hero.php';

		/**
		 * The class responsible for defining all actions that occur in the customize featured.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/customize/featured.php';

		/**
		 * The class responsible for defining all actions that occur in the customize populer courses.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/customize/populer-courses.php';

		/**
		 * The class responsible for defining all actions that occur in the customize testimonials.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/customize/testimonials.php';

		/**
		 * The class responsible for defining all actions that occur in the customize newsletter.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/customize/newsletter.php';

		/**
		 * The class responsible for defining all actions that occur in the customize footer.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/customize/footer.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-mp-tutor-lms-admin.php';

		/**
		 * The class responsible for widgets follow us.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/widgets/follow-us.php';

		/**
		 * The class responsible for widgets payment.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/widgets/payment.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		if (!class_exists('EDD_SL_Plugin_Updater')) {
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/EDD_SL_Plugin_Updater.php';
		}

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-mp-tutor-lms-page.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-mp-tutor-lms-public.php';

		$this->loader = new Mp_Tutor_Lms_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Mp_Tutor_Lms_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Mp_Tutor_Lms_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Mp_Tutor_Lms_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'customize_controls_print_styles', $plugin_admin, 'enqueue_style_preview' );
		$this->loader->add_action( 'customize_preview_init', $plugin_admin, 'enqueue_scripts_preview' );
		$this->loader->add_action( 'customize_controls_enqueue_scripts', $plugin_admin, 'enqueue_scripts_controls' );
		
		// $this->loader->add_filter( 'theme_page_templates', $plugin_admin, 'custom_template' );
		// $this->loader->add_filter( 'theme_page_templates', $plugin_admin, 'custom_template_wishlist' );
		// $this->loader->add_filter( 'theme_page_templates', $plugin_admin, 'custom_template_inner_page' );
		
		// $this->loader->add_filter( 'template_include', $plugin_admin, 'load_template', 999 );
		$this->loader->add_action( 'after_setup_theme', $plugin_admin, 'register_menu', 999 );
		$this->loader->add_action( 'widgets_init', $plugin_admin, 'Mp_Tutor_Lms_Widgets_Register' );

		


		// Specially for EDD plugin
		if ( class_exists('Easy_Digital_Downloads') ){
			$this->loader->add_filter( 'edd_currencies', $plugin_admin, 'register_edd_currencies' );
			$this->loader->add_filter( 'edd_sanitize_amount_decimals', $plugin_admin, 'set_edd_decimals' );
			$this->loader->add_filter( 'edd_format_amount_decimals', $plugin_admin, 'set_edd_decimals' );
		}

		// Call Object For Customize
		$header_navigasi = new MP_Customize_Header_Navigasi_Admin( $this->get_plugin_name(), $this->get_version() );
		$header_hero     = new MP_Customize_Header_Hero_Admin( $this->get_plugin_name(), $this->get_version() );
		$featured        = new MP_Customize_Featured_Admin( $this->get_plugin_name(), $this->get_version() );
		$populer_courses = new MP_Customize_Populer_Courses_Admin( $this->get_plugin_name(), $this->get_version() );
		$testimonials    = new MP_Customize_Testimonials_Admin( $this->get_plugin_name(), $this->get_version() );
		$newsletter      = new MP_Customize_Newsletter_Admin( $this->get_plugin_name(), $this->get_version() );
		$footer          = new MP_Customize_Footer_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'customize_register', $header_navigasi, 'MP_Customize_Header_Navigasi' );
		$this->loader->add_action( 'customize_register', $header_hero, 'MP_Customize_Header_Hero' );
		$this->loader->add_action( 'customize_register', $featured, 'MP_Customize_Featured' );
		$this->loader->add_action( 'customize_register', $populer_courses, 'MP_Customize_Populer_Courses' );
		$this->loader->add_action( 'customize_register', $testimonials, 'MP_Customize_Testimonials' );
		$this->loader->add_action( 'customize_register', $newsletter, 'MP_Customize_Newsletter' );
		$this->loader->add_action( 'customize_register', $footer, 'MP_Customize_Footer' );
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Mp_Tutor_Lms_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles', 999 );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts', 999 );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'clean_styles_and_scripts', 9999 );
		$this->loader->add_action( 'wp_head', $plugin_public, 'get_post_id_custom', 999 );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'customize_style_header_navigasi', 999 );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'customize_style_header_hero', 999 );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'customize_style_featured', 999 );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'customize_style_populer_post', 999 );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'customize_style_newsletter', 999 );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'customize_style_footer', 999 );
		$this->loader->add_action( 'wp_ajax_action_ajax_courses', $plugin_public, 'courses_action_ajax' );
		$this->loader->add_action( 'wp_ajax_nopriv_action_ajax_courses', $plugin_public, 'courses_action_ajax' );
		$this->loader->add_action( 'wp_footer', $plugin_public, 'courses_js_ajax_execute' );
		$this->loader->add_action( 'wp_footer', $plugin_public, 'search_box_ajax_fetch' );
		$this->loader->add_action( 'wp_ajax_data_fetch_ajax_search_box', $plugin_public, 'data_fetch_ajax_search_box' );
		$this->loader->add_action( 'wp_ajax_nopriv_data_fetch_ajax_search_box', $plugin_public, 'data_fetch_ajax_search_box' );
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}


	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Mp_Tutor_Lms_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}


}
