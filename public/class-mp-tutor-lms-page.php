<?php


class Mp_Tutor_Lms_Page {

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

	private static $instance;

	public static function get_instance() {
		return null === self::$instance ? ( self::$instance = new self ) : self::$instance;
	}

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since      1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct() {

		$this->plugin_name = 'mp-tutor-lms';
		$this->version = MP_TUTOR_LMS_VERSION;

		add_action( 'admin_init', array( $this, 'register_option' ));
		add_action( 'admin_init', array( $this, 'license_action' ), 20 );
		add_action( 'admin_menu', array( $this, 'license_menu' ));
		add_action( 'add_option_mptutorlms_license_key', array( $this, 'activate_license' ), 20, 2 );
		add_action( 'admin_notices', array( $this, 'admin_license_details' ));
		
		$status = get_option( 'mptutorlms_license_key_status', false );
		if ( 'valid' == $status ) {
			add_action( 'admin_init', array( $this, 'updater' ));
			add_filter( 'theme_page_templates', array( $this, 'custom_template' ));
			add_filter( 'theme_page_templates', array( $this, 'custom_template_wishlist' ));
			add_filter( 'theme_page_templates', array( $this, 'custom_template_inner_page' ));
			add_filter( 'template_include', array( $this, 'load_template'), 999);
		}

	}

	/**
	 * Create custom template Wishlist.
	 *
	 * @since    1.0.0
	 */
	public $templates_wishlist = array( 'public/partials/wishlist.php' => 'MP Wishlist' );
	public function custom_template_wishlist( $templates_wishlist ) {

		$templates_wishlist = array_merge( $templates_wishlist, $this->templates_wishlist );

		return $templates_wishlist;

	}

	/**
	 * Create custom template MP Inner Page
	 *
	 * @since    1.0.0
	 */
	public $templates_innner_page = array( 'public/partials/inner-page.php' => 'MP Inner Page' );
	public function custom_template_inner_page( $templates_innner_page ) {

		$templates_innner_page = array_merge( $templates_innner_page, $this->templates_innner_page );

		return $templates_innner_page;
		
	}

	/**
	 * Create custom template Home.
	 *
	 * @since    1.0.0
	 */
	public $templates = array( 'public/partials/front-page.php' => 'MP Front Page' );
	public function custom_template( $templates ) {

		$templates = array_merge( $templates, $this->templates );

		return $templates;

	}

	/**
	 * Load template single courses.
	 *
	 * @since    1.0.0
	 */
	public function load_template( $template ) {

		global $post;

		if ( ! $post ) {
			return $template;
		}

		// Post Courses
		if ( is_singular('courses') ) {
			$file = MP_TUTOR_LMS_DIR_PATH . 'public/partials/single.php';

			if ( file_exists( $file ) ) {
				return $file;
			}
		}

		// Page Wishlist
		if ( is_page_template( 'public/partials/wishlist.php' ) ) {
			$file = MP_TUTOR_LMS_DIR_PATH . 'public/partials/wishlist.php';

			if ( file_exists( $file ) ) {
				return $file;
			}
		}

		// Inner Page
		if ( is_page_template( 'public/partials/inner-page.php' ) ) {
			$file = MP_TUTOR_LMS_DIR_PATH . 'public/partials/inner-page.php';

			if ( file_exists( $file ) ) {
				return $file;
			}
		}

		$template_name = get_post_meta( $post->ID, '_wp_page_template', true );

		if ( ! isset( $this->templates[$template_name] ) ) {
			return $template;
		}

		$file = MP_TUTOR_LMS_DIR_PATH . $template_name;
		
		if ( file_exists( $file ) ) {
			return $file;
		}

		return $template;
	}


		/**
	 * Adds a menu item for the theme license under the appearance menu.
	 *
	 * since 1.0.0
	 */
	public function license_menu() {

		add_menu_page(
			'MP Tutor LMS',
			'MP Tutor LMS',
			'manage_options',
			'mptutorlms',
			array( $this, 'license_page' ),
			'',
			
		);

		
	}

	/**
	 * Outputs the markup used on the theme license page.
	 *
	 * since 1.0.0
	 */
	/**
	 * Credits: Agus Muhammad, LandingPress
	 * @link https://agusmu.com
	 *
	 */
	public function license_page() {

		$license = trim( get_option( 'mptutorlms_license_key' ) );

		// Checks license status to display under license key
		if ( ! $license ) {
			$license_error = 'Silakan masukkan kode lisensi Anda.';
		} 
		else {
			$license_error = $this->check_license();
		}

		$status = get_option( 'mptutorlms_license_key_status', false );
		if ( empty( $status ) ) {
			$status = 'unknown';
		}
		$status_label = strtoupper( str_replace( '_', ' ', $status ) );

		$license_data = get_option( 'mptutorlms_license_data' );
		$license_error = get_option( 'mptutorlms_license_error' );
		if ( isset( $_GET['mptutorlms_license'] ) && $_GET['mptutorlms_license'] == 'false' && isset( $_GET['license_error'] ) && ! empty( $_GET['license_error'] ) ) {
			$license_error = urldecode( stripslashes( $_GET['license_error'] ) );
		}
		?>
		<style>
			.mptutorlms-license-window {
			    margin-right: 20px;
			}
			.mptutorlms-license-brand {
			    margin-bottom: 26px;
			}
			.mptutorlms-license-alert-success {
			    background: #F5FBF7;
			    color: #075A2A;
			    border: 1px solid #CBE9D5;
			}
			.mptutorlms-license-alert-success, .mptutorlms-license-alert-error {
			    position: relative;
			    box-sizing: border-box;
			    padding: 17px 17px 17px 78px;
			    margin: 0px -32px 34px;
			    border-radius: 6px;
			}
			.mptutorlms-license-fieldset {
			    display: flex;
			    margin-bottom: 30px;
			}
			.mptutorlms-license-fieldset-label {
			    width: 160px;
			    flex: 0 0 160px;
			    font-weight: normal;
			    color: #353535;
			}
			.mptutorlms-license-fieldset-label, .mptutorlms-license-fieldset-content {
			    font-size: 16px;
			    line-height: 26px;
			}
			.mptutorlms-license-alert-icon {
			    position: absolute;
			    top: 20px;
			    left: 20px;
			}
			.mptutorlms-license-actions {
			    padding-top: 20px;
			    text-align: left;
			    margin-bottom: 20px;
			}
			.mptutorlms-license-alert-title {
			    font-style: normal;
			    font-weight: bold;
			    font-size: 20px;
			    line-height: 30px;
			    margin: 0 0 10px 0;
			}
			.mptutorlms-license-fieldset-content {
			    font-weight: 500;
			    color: #161616;
			    flex-grow: 1;
			}
			.mptutorlms-license-actions .button {
			    padding: 6px 13px;
			}
			.mptutorlms-license-fieldset-content {
			    font-weight: 500;
			    color: #161616;
			    flex-grow: 1;
			}
			.mptutorlms-license-fieldset-label, .mptutorlms-license-fieldset-content {
			    font-size: 16px;
			    line-height: 26px;
			}
			.mptutorlms-license-fieldset-content input[type="text"] {
			    display: block;
			    padding: 9px 12px;
			    width: 100%;
			}
			.mptutorlms-license-active {
			    width: 730px;
			    max-width: 100%;
			    background: #FFFFFF;
			    padding: 30px 56px;
			    margin: 100px auto;
			    box-sizing: border-box;
			    box-shadow: 0px 2px 2px rgb(0 0 0 / 5%);
			    border-radius: 10px;
			}
			.mptutorlms-license-help-text {
			    font-weight: normal;
			    font-size: 13px;
			    line-height: 18px;
			    color: #7A7A7A;
			    margin-top: -20px;
			}

		</style>
		<div class="wrap mptutorlms-license-window">
			<form method="post" action="options.php" class="elementor-license-box">
				<?php settings_fields( 'mptutorlms_license' ); ?>
				<?php wp_nonce_field( 'mptutorlms_pro_nonce', 'mptutorlms_pro_nonce' ); ?>
				<?php if ( empty( $license ) || ( ! empty( $license ) && in_array( $status, array( 'item_name_mismatch', 'invalid_item_id', 'missing', 'invalid', 'disabled' ) ) ) ) : ?>
				<div class="mptutorlms-license-active">
				<h3>
					<?php _e( 'MP Tutor LMS License' ); ?>
						
				</h3>
	                    <p><?php _e( 'Masukkan kode lisensi, untuk mengaktifkan <strong>MP Tutor LMS</strong>, untuk auto update, premium support dan akses MP Tutor LMS.' ); ?></p>
	                    <ol>
	                        <li><?php printf( __( 'Masuk <a href="%s" target="_blank">Member Area</a> untuk mendapatkan kode lisensi.' ), 'https://user.brandmarketers.id' ); ?></li>
	                        <li><?php _e( __( ' Masukan lisensi anda pada kolom license keys di bawah ini.' ) ); ?></li>
	                        <li><?php _e( __( 'Klik tombol <strong>"Activate License"</strong>.' ) ); ?></li>
	                    </ol>
					
					<div class="mptutorlms-license-fieldset">
					<div class="mptutorlms-license-fieldset-content">
					<input id="mptutorlms_license_key" name="mptutorlms_license_key" type="text" value="" placeholder="<?php esc_attr_e( 'input license keys here'); ?>" />
					</div>
					</div>
					<div class="mptutorlms-license-help-text">
					<?php if ( $license ) : ?>
							Lisensi: <strong><span><?php echo $this->get_hidden_license( $license ); ?></span></strong>,
					<?php endif; ?>
					<?php if ( ! empty( $license ) &&  ( $license_error ) ) : ?>
							Status: <span style="color: #ff0000;"><?php echo esc_html( $license_error ); ?></span>
					<?php endif; ?>
					</div>
					<div class="mptutorlms-license-actions">
					<input type="submit" class="button button-primary" name="submit" value="<?php esc_attr_e( 'Activate License'); ?>"/>
					</div>

				</div>	

			<?php else : ?>
				<div class="mptutorlms-license-window">
				<div class="mptutorlms-license-active">

      			<div class="mptutorlms-license-brand">
      				<h2>MP Tutor LMS <span style="color: blue; font-style: italic;">by brandmarketers.id</span></h2>
            	</div>

            <div class="mptutorlms-license-alert-success">
                    <div class="mptutorlms-license-alert-icon">
                        <svg width="48" height="48" fill="none" xmlns="http://www.w3.org/2000/svg"><defs></defs><path fill-rule="evenodd" clip-rule="evenodd" d="M24 41c9.389 0 17-7.611 17-17S33.389 7 24 7 7 14.611 7 24s7.611 17 17 17zm-8.434-16.145a.928.928 0 00.19.29l6.023 6c.08.093.178.168.288.22a.97.97 0 00.74 0 .852.852 0 00.29-.22l10.666-10.61a.928.928 0 00.189-.289 1.066 1.066 0 000-.74.887.887 0 00-.19-.289l-1.34-1.303a.842.842 0 00-.629-.289.906.906 0 00-.37.074.975.975 0 00-.3.215l-8.678 8.678-4.043-4.05a.985.985 0 00-.307-.215.878.878 0 00-.71 0 .806.806 0 00-.29.215l-1.34 1.284a.89.89 0 00-.189.29 1.067 1.067 0 000 .74z" fill="#24A148"></path></svg>
                    </div>
                    <div class="mptutorlms-license-alert-title">
                        Selamat!
                    </div>
                    <div class="mptutorlms-license-alert-message">
                        Lisensi MP Tutor LMS telah terhubung sistem lisensi Brandmarketers.id dan mendapatkan auto update.
                    </div>
                </div>

						<?php if ( in_array( $status, array( 'valid', 'inactive', 'site_inactive', 'expired' ) ) ) : ?>

							<div class="mptutorlms-license-fieldset">
			                    <div class="mptutorlms-license-fieldset-label">
			                        License Status :
			                    </div>
			                    <div class="mptutorlms-license-fieldset-content">
			                        <?php if ( in_array( $status, array( 'expired' ) ) ) : ?>
										<span style="color: #ff0000; font-style: italic;"><?php _e( 'Expired' ); ?></span>
									<?php elseif ( in_array( $status, array( 'inactive' ) ) ) : ?>
										<span style="color: #ff0000; font-style: italic;"><?php _e( 'Mismatch' ); ?></span>
									<?php elseif ( in_array( $status, array( 'invalid' ) ) ) : ?>
										<span style="color: #ff0000; font-style: italic;"><?php _e( 'Invalid' ); ?></span>
									<?php elseif ( in_array( $status, array( 'disabled' ) ) ) : ?>
										<span style="color: #ff0000; font-style: italic;"><?php _e( 'Disabled' ); ?></span>
									<?php else : ?>
										<span style="color: #008000; font-style: italic;"><?php _e( 'Active' ); ?></span>
									<?php endif; ?>                   
			                    </div>
			                </div>

			                <div class="mptutorlms-license-fieldset">
			                    <div class="mptutorlms-license-fieldset-label">
			                        Expires on :
			                    </div>
			                    <div class="mptutorlms-license-fieldset-content">
			                        <?php if ( isset( $license_data->expires ) && $license_data->expires ) : ?>
										<?php if ( $license_data->expires == 'lifetime' ) : ?>  
											<?php echo esc_html( strtoupper( $license_data->expires ) ); ?>
										<?php else : ?>
											<?php echo date_i18n( get_option( 'date_format' ), strtotime( $license_data->expires, current_time( 'timestamp' ) ) ); ?>
										<?php endif; ?>
									<?php endif; ?>                   
			                    </div>
			                </div>

			                <div class="mptutorlms-license-fieldset">
			                    <div class="mptutorlms-license-fieldset-label">
			                        License Activation :
			                    </div>
			                    <div class="mptutorlms-license-fieldset-content">
			                        <?php $site_count = $license_data->site_count; $license_limit = $license_data->license_limit;
									if ( 0 == $license_limit ) {
										$license_limit = '∞ Unlimited Sites';
									}
									elseif ( $license_limit >= 1 ) {
										$license_limit = ''.$site_count.' / '.$license_limit.' Site';
									}
									?> 
									<?php echo $license_limit; ?>                 
			                    </div>
			                </div>
							
						<?php endif; ?>

				<div class="mptutorlms-license-actions">
                <input type="submit" class="button button-primary" name="Deactivate" value="Deactivate License"/>
            	</div>
				
			</div>
			</div>

			<?php endif; ?>
			</form>
		<?php
	
	}
	

	/**
	 * Hidden License Key
	 * 
	 * since 1.0.0
	 */

	public static function get_hidden_license() {
		$input_string = get_option( 'mptutorlms_license_key' );

		$start = 5;
		$length = mb_strlen( $input_string ) - $start - 5;

		$mask_string = preg_replace( '/\S/', '*', $input_string );
		$mask_string = mb_substr( $mask_string, $start, $length );
		$input_string = substr_replace( $input_string, $mask_string, $start, $length );

		return $input_string;
	}


	/**
	 * Registers the option used to store the license key in the options table.
	 *
	 * since 1.0.0
	 */
	public function register_option() {
		register_setting(
			'mptutorlms_license',
			'mptutorlms_license_key',
			array( $this, 'sanitize_license' )
		);
	}


	/**
	 * Sanitizes the license key.
	 *
	 * since 1.0.0
	 *
	 * @param string $new License key that was submitted.
	 * @return string $new Sanitized license key.
	 */
	public function sanitize_license( $new ) {
		$old = get_option( 'mptutorlms_license_key' );
		if ( $old && $old != $new ) {
			// New license has been entered, so must reactivate
			delete_option( 'mptutorlms_license_key_status' );
			delete_option( 'mptutorlms_license_data' );
			delete_option( 'mptutorlms_license_error' );
		}
		return $new;
	}


	/**
	 * Makes a call to the API.
	 *
	 * @since 1.0.0
	 *
	 * @param array $api_params to be used for wp_remote_get.
	 * @return array $response decoded JSON response.
	 */
	public function get_api_response( $api_params ) {
		$response = wp_remote_post( MP_TUTOR_LMS_MEMBER, array( 'timeout' => 15, 'sslverify' => false, 'body' => $api_params ) );
		return $response;
	 }


	/**
	 * Activates the license key.
	 *
	 * @since 1.0.0
	 */
	public function activate_license() {
		$license = trim( get_option( 'mptutorlms_license_key' ) );
		$api_params = array(
			'edd_action' => 'activate_license',
			'license'    => $license,
			'item_id'    => MP_TUTOR_LMS_ID, 
			'url'        => home_url()
		);
		$response = $this->get_api_response( $api_params );
		$error = '';
		if ( is_wp_error( $response ) ) {
			$error = $response->get_error_message();
		}
		elseif ( 200 !== wp_remote_retrieve_response_code( $response ) ) {
			$code = wp_remote_retrieve_response_code( $response );
			$message = wp_remote_retrieve_response_message( $response );
			if ( empty( $message ) ) {
				$message = __( 'An error occurred, please try again.', 'mptutorlms' );
			}
			$error = $message.' (CODE '.$code.')';
		}
		else {
			$license_data = json_decode( wp_remote_retrieve_body( $response ) );
			if ( 'valid' != $license_data->license ) {
				switch( $license_data->license ) {
					case 'expired' :
						$error = sprintf(
							__( 'Kode lisensi Anda telah kadaluarsa pada %s.', 'mptutorlms' ),
							date_i18n( get_option( 'date_format' ), strtotime( $license_data->expires, current_time( 'timestamp' ) ) )
						);
						break;
					case 'revoked' :
						$error = __( 'Kode lisensi Anda telah dinonaktifkan dan tidak dapat dipergunakan lagi.', 'mptutorlms' );
						break;
					case 'missing' :
						$error = __( 'Lisensi tidak valid.', 'mptutorlms' );
						break;
					case 'invalid' :
						$error = __( 'Lisensi tidak valid.', 'mptutorlms' );
						break;
					case 'site_inactive' :
						$error = __( 'Lisensi Anda sedang tidak aktif di website ini.', 'mptutorlms' );
						break;
					case 'item_name_mismatch' :
						$error = sprintf( __( 'Kode lisensi tidak valid untuk %s, silakan ganti dengan kode lisensi yang valid.', 'mptutorlms' ), MP_TUTOR_LMS_NAME );
						break;
					case 'invalid_item_id' :
						$error = sprintf( __( 'Kode lisensi tidak valid untuk %s, silakan ganti dengan kode lisensi yang valid.', 'mptutorlms' ), MP_TUTOR_LMS_NAME );
						break;
					case 'no_activations_left':
						$error = __( 'Kode lisensi Anda telah mencapai batas limit aktivasi lisensi.', 'mptutorlms' );
						break;
					default :
						$error = __( 'An error occurred, please try again.', 'mptutorlms' );
						break;
				}
			}
		}
		if ( ! empty( $error ) ) {
			if ( strpos( $error, 'resolve host' ) !== false ) {
				$error = esc_html__( 'Tidak dapat terhubung ke server lisensi MP Tutor LMS!', 'mptutorlms' );
			}
			update_option( 'mptutorlms_license_error', $error );
		}
		else {
			delete_option( 'mptutorlms_license_error' );
		}
		if ( isset( $license_data ) && $license_data && isset( $license_data->license ) ) {
			update_option( 'mptutorlms_license_key_status', $license_data->license );
			update_option( 'mptutorlms_license_data', $license_data );
		}
		wp_redirect( admin_url( 'admin.php?page=mptutorlms' ) );
		exit();
	}


	/**
	 * Deactivates the license key.
	 *
	 * @since 1.0.0
	 */
	public function deactivate_license() {
		$license = trim( get_option( 'mptutorlms_license_key' ) );
		$api_params = array(
			'edd_action' => 'deactivate_license',
			'license'    => $license,
			'item_id'    => MP_TUTOR_LMS_ID,
			'url'        => home_url()
		);
		$response = $this->get_api_response( $api_params );
		$error = '';
		if ( is_wp_error( $response ) ) {
			$error = $response->get_error_message();
		}
		elseif ( 200 !== wp_remote_retrieve_response_code( $response ) ) {
			$code = wp_remote_retrieve_response_code( $response );
			$message = wp_remote_retrieve_response_message( $response );
			if ( empty( $message ) ) {
				$message = __( 'An error occurred, please try again.', 'mptutorlms' );
			}
			$error = $message.' (CODE '.$code.')';
		}
		else {
			$license_data = json_decode( wp_remote_retrieve_body( $response ) );
			if ( $license_data && ( $license_data->license == 'deactivated' ) ) {
				delete_option( 'mptutorlms_license_key' );
				delete_option( 'mptutorlms_license_key_status' );
				delete_option( 'mptutorlms_license_data' );
				delete_option( 'mptutorlms_license_error' );
			}
			else {
				$error = __( 'An error occurred, please try again.', 'mptutorlms' );
			}
		}
		if ( ! empty( $error ) ) {
			if ( strpos( $error, 'resolve host' ) !== false ) {
				$error = esc_html__( 'Tidak dapat terhubung ke server lisensi MP Tutor LMS!', 'mptutorlms' );
			}
			$error = __( 'License deactivation failed!', 'mptutorlms' ).' '.$error;
			$base_url = admin_url( 'admin.php?page=mptutorlms' );
			$redirect = add_query_arg( array( 'mptutorlms_license' => 'false', 'license_error' => urlencode( $error ) ), $base_url );
			wp_redirect( $redirect );
			exit();
		}
		wp_redirect( admin_url( 'admin.php?page=mptutorlms' ) );
		exit();
	}


	/**
	 * Checks if a license action was submitted.
	 *
	 * @since 1.0.0
	 */
	public function license_action() {

		if ( isset( $_POST[ 'mptutorlms_license_activate' ] ) ) {
			if ( check_admin_referer( 'mptutorlms_pro_nonce', 'mptutorlms_pro_nonce' ) ) {
				$this->activate_license();
			}
		}

		if ( isset( $_POST['mptutorlms_license_deactivate'] ) ) {
			if ( check_admin_referer( 'mptutorlms_pro_nonce', 'mptutorlms_pro_nonce' ) ) {
				$this->deactivate_license();
			}
		}


	}


	/**
	 * Checks if license is valid and gets expire date.
	 *
	 * @since 1.0.0
	 *
	 * @return string $message License status message.
	 */
	public function check_license() {
		$license = trim( get_option( 'mptutorlms_license_key' ) );
		$api_params = array(
			'edd_action' => 'check_license',
			'license'    => $license,
			'item_id'    => MP_TUTOR_LMS_ID, 
			'url'        => home_url()
		);
		$response = $this->get_api_response( $api_params );
		$error = '';
		if ( is_wp_error( $response ) ) {
			$error = $response->get_error_message();
		}
		elseif ( 200 !== wp_remote_retrieve_response_code( $response ) ) {
			$code = wp_remote_retrieve_response_code( $response );
			$message = wp_remote_retrieve_response_message( $response );
			if ( empty( $message ) ) {
				$message = __( 'An error occurred, please try again.', 'mptutorlms' );
			}
			$error = $message.' (CODE '.$code.')';
		}
		else {
			$license_data = json_decode( wp_remote_retrieve_body( $response ) );
			if ( 'valid' != $license_data->license ) {
				switch( $license_data->license ) {
					case 'expired' :
						$error = sprintf(
							__( 'Kode lisensi Anda telah kadaluarsa pada %s.', 'mptutorlms' ),
							date_i18n( get_option( 'date_format' ), strtotime( $license_data->expires, current_time( 'timestamp' ) ) )
						);
						break;
					case 'revoked' :
						$error = __( 'Kode lisensi Anda telah dinonaktifkan dan tidak dapat dipergunakan lagi.', 'mptutorlms' );
						break;
					case 'missing' :
						$error = __( 'Lisensi tidak valid.', 'mptutorlms' );
						break;
					case 'invalid' :
						$error = __( 'Lisensi tidak valid.', 'mptutorlms' );
						break;
					case 'site_inactive' :
						$error = __( 'Lisensi Anda sedang tidak aktif di website ini.', 'mptutorlms' );
						break;
					case 'item_name_mismatch' :
						$error = sprintf( __( 'Kode lisensi tidak valid untuk %s, silakan ganti dengan kode lisensi yang valid.', 'mptutorlms' ), MP_TUTOR_LMS_NAME );
						break;
					case 'invalid_item_id' :
						$error = sprintf( __( 'Kode lisensi tidak valid untuk %s, silakan ganti dengan kode lisensi yang valid.', 'mptutorlms' ), MP_TUTOR_LMS_NAME );
						break;
					case 'no_activations_left':
						$error = __( 'Kode lisensi Anda telah mencapai batas limit aktivasi lisensi.', 'mptutorlms' );
						break;
					default :
						$error = __( 'An error occurred, please try again.', 'mptutorlms' );
						break;
				}
			}
		}
		if ( ! empty( $error ) ) {
			if ( strpos( $error, 'resolve host' ) !== false ) {
				$error = esc_html__( 'Tidak dapat terhubung ke server lisensi MP Tutor LMS!', 'mptutorlms' );
			}
			update_option( 'mptutorlms_license_error', $error );
		}
		else {
			delete_option( 'mptutorlms_license_error' );
		}
		if ( isset( $license_data ) && $license_data && isset( $license_data->license ) ) {
			update_option( 'mptutorlms_license_key_status', $license_data->license );
			update_option( 'mptutorlms_license_data', $license_data );
		}
		return $error;
	}


	/**
	 * Plugin upgrader
	 *
	 * @since v1.0.0
	 */
	public function updater() {

		// To support auto-updates, this needs to run during the wp_version_check cron job for privileged users.
		$doing_cron = defined( 'DOING_CRON' ) && DOING_CRON;
		if ( ! current_user_can( 'manage_options' ) && ! $doing_cron ) {
			return;
		}

	    // Disable SSL verification
	    add_filter('edd_sl_api_request_verify_ssl', '__return_false');

	    // Setup the updater
	    $license_key = get_option( 'mptutorlms_license_key' );

	   	if ( ! $license_key ) {
			return;
		}

			$status = get_option( 'mptutorlms_license_key_status', false );
		    if ( 'valid' == $status ) {

			    // setup the updater
				$edd_updater = new EDD_SL_Plugin_Updater(
			            MP_TUTOR_LMS_MEMBER,
			            MP_TUTOR_LMS_PLUGIN_FILE,
			            [
						'version' => MP_TUTOR_LMS_VERSION,                   
						'license' => $license_key,          
						'item_id' => MP_TUTOR_LMS_ID, 
						'author'  => 'brandmarketers.id', 
						'beta'    => false,
						]
				);
			}

	}

	public function admin_license_details() {
		if ( ! current_user_can( 'manage_options' ) ) {
		return;
		}

	    $screen = get_current_screen();
	    $allowed_screens = array(
	        'update-core',
	        'themes',
	        'plugins'
	    );
	    if ( !isset( $screen->id ) ) {
	        return;
	    }
	    if ( ! in_array( $screen->id, $allowed_screens ) ) {
	        return;
	    }
	    $status = get_option( 'mptutorlms_license_key_status', false );
	    if ( in_array( $status, array( 'valid' ) ) ) {
	        return;
	    }
        $class = 'notice notice-error';
        $message = sprintf(__( ' Silahkan %s Aktivasi Lisensi %s untuk mendapatkan update otomatis dan support teknis.'), " <a href='".admin_url('admin.php?page=mptutorlms')."'>", '</a>');

        printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), $message );
    
	}


}
Mp_Tutor_Lms_Page::get_instance();