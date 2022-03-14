<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://brandmarketers.id
 * @since      1.0.0
 *
 * @package    MP_Customize_Header_Navigasi
 * @subpackage MP_Customize_Header_Navigasi/admin
 */
/**
 * Sanitize input key2
 *
 * @since    1.0.0
 */

function sanitize_key2( $key ) {

    $key = str_replace('<i class="', '', $key);

    $key = str_replace('"></i>', '', $key);
    
    $key = preg_replace( '/[^a-z0-9_\- ]/', '', $key );

    return $key;

}
/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    MP_Customize_Header_Navigasi
 * @subpackage MP_Customize_Header_Navigasi/admin
 * @author     brandmarketers.id <wildan@brandmarketers.id>
 */
class MP_Customize_Header_Navigasi_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

    }
    
    /**
     * MP Tutor LMS Add Customize Header.
     *
     * @subpackage MP Tutor LMS
     * @since 1.0
     */

    public function MP_Customize_Header_Navigasi( $wp_customize ) { 

        // Section
        $wp_customize->add_section( 'MP_header', 
            array(
                'title'           => __( 'Header Navigasi', 'mp-tutor-lms' ),
                'priority'        => 210,
            ) 
        );

        // =================== Toogle Radio Icon Or Logo ===================
        // Setting
        $wp_customize->add_setting( 'MP_toggle_icon_logo', 
            array(
                'default'           => 'yes',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_key2',
            ) 
        );

        // Control
        $wp_customize->add_control( 'MP_toggle_icon_logo',
            array(
                'label'      => __( 'Display Logo (Icon / Image)', 'mp-tutor-lms' ),
                'section'    => 'MP_header',
                'type'       => 'radio',
                'choices'    => array( 
                    'yes'    => __( 'Icon', 'mp-tutor-lms' ),
                    'no'     => __( 'Image', 'mp-tutor-lms' ),
                )
            )
        );

        // Partial
        $wp_customize->selective_refresh->add_partial(
            'MP_toggle_icon_logo',
            array(
                'selector'            => '.logo-icon',
                'container_inclusive' => true,
                'render_callback'     => 'customize_refresh_callback_toggle_header',
            )
        );

    
        function customize_refresh_callback_toggle_header() { ?>
            <?php 
            $headerNavToggle = get_theme_mod('MP_toggle_icon_logo');
            $headerNavIcon   = get_theme_mod('MP_icon');
            $headerNaTitle   = get_theme_mod('MP_title');
            $headerNavLogo    = wp_get_attachment_url( get_theme_mod( 'MP_logo' ) );
            $headerNavLogo    = ( empty( $headerNavLogo ) ? plugins_url() . '/mp-tutor-lms/public/assets/images/logo.png' : $headerNavLogo );
            ?>
            <?php if ( $headerNavToggle == 'yes' ) : ?>
                <div class="logo-icon">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <span class="icon-nav"><?php echo '<i class="' . $headerNavIcon . '"></i>'; ?></span>
                        <span class="title-nav"><?php echo $headerNaTitle; ?></span>
                    </a>                        
                </div>
            <?php else: ?>
                <div class="logo-icon logo-image"> 
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <img src="<?php echo $headerNavLogo; ?>" alt="Logo" width="150" height="60">
                    </a>                        
                </div>
            <?php endif; ?> 
        <?php }
        // =================== Input Icon ===================
        // Setting
        $wp_customize->add_setting( 'MP_icon', 
        array(
            'default'           => 'fas fa-graduation-cap',
            'transport'         => 'postMessage',
            'sanitize_callback' => 'sanitize_key2',
            ) 
        );
        
        // Control
        $wp_customize->add_control( 'MP_icon',
        array(
            'label'      => __( 'Logo Icon (Font Awesome)', 'mp-tutor-lms' ),
            'section'    => 'MP_header',
            'type'       => 'input',
            'class'      => 'mp-icon',
            )
        );

        // Partial
        $wp_customize->selective_refresh->add_partial(
            'MP_icon',
            array(
                'selector'            => '.logo-icon',
                'container_inclusive' => true,
                'render_callback'     => 'customize_refresh_callback_nav_icon',
            )
        );
            
        function customize_refresh_callback_nav_icon() { ?>
            <?php 
            $headerNavToggle = get_theme_mod('MP_toggle_icon_logo');
            $headerNavIcon   = get_theme_mod('MP_icon');
            $headerNaTitle   = get_theme_mod('MP_title');
            $headerNavLogo    = wp_get_attachment_url( get_theme_mod( 'MP_logo' ) );
            $headerNavLogo    = ( empty( $headerNavLogo ) ? plugins_url() . '/mp-tutor-lms/public/assets/images/logo.png' : $headerNavLogo );
            ?>
            <?php if ( $headerNavToggle == 'yes' ) : ?>
                <div class="logo-icon">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <span class="icon-nav"><?php echo '<i class="' . $headerNavIcon . '"></i>'; ?></span>
                        <span class="title-nav"><?php echo $headerNaTitle; ?></span>
                    </a>                        
                </div>
            <?php else: ?>
                <div class="logo-icon logo-image"> 
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <img src="<?php echo $headerNavLogo; ?>" alt="Logo" width="150" height="60">
                    </a>                        
                </div>
            <?php endif; ?> 
        <?php }
        // =================== Input Title ===================
        // Setting
        $wp_customize->add_setting( 'MP_title', 
        array(
            'default'           => 'Courses',
            'transport'         => 'postMessage',
            'sanitize_callback' => 'sanitize_text_field',
            ) 
        );
        
        // Control
        $wp_customize->add_control( 'MP_title',
        array(
            'label'      => __( 'Logo Title', 'mp-tutor-lms' ),
            'section'    => 'MP_header',
            'type'       => 'input',
            'class'      => 'mp-icon',
            )
        );  
        // =================== Logo Image ===================
        // Setting
        $wp_customize->add_setting( 'MP_logo',
        array(
            'default'           => '',
            'transport'         => 'postMessage',
            'sanitize_callback' => 'absint'
            )
        );
 
        // Control
        $wp_customize->add_control( new WP_Customize_Cropped_Image_Control( 
            $wp_customize, 
                'MP_logo',
                array(
                    'label'       => __( 'Logo Image (Size 150 x 60)', 'mp-tutor-lms' ),
                    'section'     => 'MP_header',
                    'flex_width'  => false,
                    'flex_height' => true,
                    'width'       => 150, // Optional. Default: 150
                    'height'      => 60, // Optional. Default: 150
                    'button_labels' => array(
                        'select'       => __( 'Select Image', 'mp-tutor-lms' ),
                        'change'       => __( 'Change Image', 'mp-tutor-lms' ),
                        'remove'       => __( 'Remove', 'mp-tutor-lms' ),
                        'default'      => __( 'Default', 'mp-tutor-lms' ),
                        'placeholder'  => __( 'No Image Selected', 'mp-tutor-lms' ),
                        'frame_title'  => __( 'Select Image', 'mp-tutor-lms' ),
                        'frame_button' => __( 'Choose Image', 'mp-tutor-lms' ),
                    )
                )
        ) );

        // Partial
        $wp_customize->selective_refresh->add_partial(
            'MP_logo',
            array(
                'selector'            => '.logo-icon',
                'container_inclusive' => true,
                'render_callback'     => 'customize_refresh_callback_logo',
            )
        );

        function customize_refresh_callback_logo() {
            $logo = wp_get_attachment_url( get_theme_mod( 'MP_logo' ) );
            echo '<img src="'.$logo.'" alt="Logo" width="150" height="60">';
        }

        // =================== Logo Icon Color ===================
        // Setting
        $wp_customize->add_setting( 'header_logo_icon_color', 
            array(
                'default'           => '#7d88ff',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_hex_color',
            ) 
        );

        // Control
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_logo_icon_color', 
            array(
                'label'    => __( 'Logo Icon Color', 'mp-tutor-lms' ),
                'section'  => 'MP_header',
                'settings' => 'header_logo_icon_color',
            ) 
        ));

        // =================== Logo Title Color ===================
        // Setting
        $wp_customize->add_setting( 'header_logo_title_color', 
            array(
                'default'           => '#131b42',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_hex_color',
            ) 
        );

        // Control
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_logo_title_color', 
            array(
                'label'    => __( 'Logo Title Color', 'mp-tutor-lms' ),
                'section'  => 'MP_header',
                'settings' => 'header_logo_title_color',
            ) 
        ));

        // =================== Link Wishlist ===================
        // Setting
        $wp_customize->add_setting( 'header_link_wishlist',
            array(
                'default'           => '',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw'
            )
        );
        
        $wp_customize->add_control( 'header_link_wishlist',
            array(
                'label'   => __( 'URL Wishlist', 'mp-tutor-lms' ),
                'section' => 'MP_header',
                'type'    => 'text', 
                'input_attrs' => array( 
                    'class' => 'input-wishlist',
                    'placeholder' => __( 'https://example.com/wishlist/', 'mp-tutor-lms' ),
                 ),
            )
        );

        // =================== Link Account ===================
        // Setting
        $wp_customize->add_setting( 'header_link_account_mobile',
            array(
                'default'           => '',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw'
            )
        );
        
        $wp_customize->add_control( 'header_link_account_mobile',
            array(
                'label'   => __( 'URL Account from Mobile', 'mp-tutor-lms' ),
                'section' => 'MP_header',
                'type'    => 'text', 
                'input_attrs' => array( 
                    'class' => 'input-wishlist',
                    'placeholder' => __( 'https://example.com/account/', 'mp-tutor-lms' ),
                 ),
            )
        );

        // =================== Background Color ===================
        // Setting
        $wp_customize->add_setting( 'header_bk', 
            array(
                'default'           => '#fff',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_hex_color',
            ) 
        );

        // Control
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_bk', 
            array(
                'label'    => __( 'Background Color', 'mp-tutor-lms' ),
                'section'  => 'MP_header',
                'settings' => 'header_bk',
            ) 
        ));

        // =================== Color Link ===================
        // Setting
        $wp_customize->add_setting( 'header_color_link', 
            array(
                'default'           => '#333',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_hex_color',
            ) 
        );

        // Control
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_color_link', 
            array(
                'label'    => __( 'Color Link', 'mp-tutor-lms' ),
                'section'  => 'MP_header',
                'settings' => 'header_color_link',
            ) 
        ));

        // =================== Color Wishlist ===================
        // Setting
        $wp_customize->add_setting( 'header_color_wishlist', 
            array(
                'default'           => '#333',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_hex_color',
            ) 
        );

        // Control
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_color_wishlist', 
            array(
                'label'    => __( 'Color Wishlist', 'mp-tutor-lms' ),
                'section'  => 'MP_header',
                'settings' => 'header_color_wishlist',
            ) 
        ));        

        // =================== Color Cart Icon ===================
        // Setting
        $wp_customize->add_setting( 'header_color_cart_icon', 
            array(
                'default'           => '#333',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_hex_color',
            ) 
        );

        // Control
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_color_cart_icon', 
            array(
                'label'    => __( 'Color Cart Icon', 'mp-tutor-lms' ),
                'section'  => 'MP_header',
                'settings' => 'header_color_cart_icon',
            ) 
        ));         

        // =================== Color Cart Item ===================
        // Setting
        $wp_customize->add_setting( 'header_color_cart_item', 
            array(
                'default'           => '#656ed4',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_hex_color',
            ) 
        );

        // Control
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_color_cart_item', 
            array(
                'label'    => __( 'Color Cart Item', 'mp-tutor-lms' ),
                'section'  => 'MP_header',
                'settings' => 'header_color_cart_item',
            ) 
        ));         

    }
}
