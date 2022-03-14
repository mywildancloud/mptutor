<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://brandmarketers.id
 * @since      1.0.0
 *
 * @package    MP_Customize_Featured
 * @subpackage MP_Customize_Featured/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    MP_Customize_Featured
 * @subpackage MP_Customize_Featured/admin
 * @author     brandmarketers.id <wildan@brandmarketers.id>
 */
class MP_Customize_Featured_Admin {

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

    public function MP_Customize_Featured( $wp_customize ) { 

        // Section
        $wp_customize->add_section( 'MP_featured', 
            array(
                'title'           => __( 'Featured', 'mp-tutor-lms' ),
                'priority'        => 230,
            ) 
        );

        // =================== Title ===================
        // Setting
        $wp_customize->add_setting( 'featured_title',
            array(
                'default'           => 'Access Your Course Any Time And Any Where',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'wp_kses_post',
            )
        );

        // Control
        $wp_customize->add_control( new MP_Tutor_Lms_TinyMCE( $wp_customize, 'featured_title',
            array(
                'label'       => __( 'Title', 'mp-tutor-lms' ),
                'section'     => 'MP_featured',
                'input_attrs'      => array(
                    // 'toolbar1'     => 'bold italic bullist numlist alignleft aligncenter alignright link',
                    'toolbar1'     => 'bold italic link',
                    'mediaButtons' => false,
                )
            )
        ) );

        // =================== Sub Title ===================
        // Setting
        $wp_customize->add_setting( 'featured_sub_title', 
        array(
            'default'           => 'Featured',
            'transport'         => 'postMessage',
            'sanitize_callback' => 'sanitize_text_field',
            ) 
        );
        
        // Control
        $wp_customize->add_control( 'featured_sub_title',
        array(
            'label'      => __( 'Sub Title', 'mp-tutor-lms' ),
            'section'    => 'MP_featured',
            'type'       => 'input',
            'class'      => 'mp-icon',
            )
        );

        // =================== Background Color ===================
        // Setting
        $wp_customize->add_setting( 'featured_hero_bk', 
            array(
                'default'           => '#fff',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_hex_color',
            ) 
        );

        // Control
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'featured_hero_bk', 
            array(
                'label'    => __( 'Background Color', 'mp-tutor-lms' ),
                'section'  => 'MP_featured',
                'settings' => 'featured_hero_bk',
            ) 
        )); 

        // =================== Title Color ===================
        // Setting
        $wp_customize->add_setting( 'featured_title_color', 
            array(
                'default'           => '#131b42',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_hex_color',
            ) 
        );

        // Control
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'featured_title_color', 
            array(
                'label'    => __( 'Title Color', 'mp-tutor-lms' ),
                'section'  => 'MP_featured',
                'settings' => 'featured_title_color',
            ) 
        )); 

        // =================== Text Color ===================
        // Setting
        $wp_customize->add_setting( 'featured_text_color', 
            array(
                'default'           => '#686868',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_hex_color',
            ) 
        );

        // Control
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'featured_text_color', 
            array(
                'label'    => __( 'Text Color', 'mp-tutor-lms' ),
                'section'  => 'MP_featured',
                'settings' => 'featured_text_color',
            ) 
        ));

        // =================== Background Color Icon ===================
        // Setting
        $wp_customize->add_setting( 'featured_icon_bk', 
            array(
                'default'           => '#f0eded',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_hex_color',
            ) 
        );

        // Control
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'featured_icon_bk', 
            array(
                'label'    => __( 'Background Color Icon', 'mp-tutor-lms' ),
                'section'  => 'MP_featured',
                'settings' => 'featured_icon_bk',
            ) 
        ));

        // =================== Color Icon ===================
        // Setting
        $wp_customize->add_setting( 'featured_icon_color', 
            array(
                'default'           => '#7d88ff',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_hex_color',
            ) 
        );

        // Control
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'featured_icon_color', 
            array(
                'label'    => __( 'Color Icon', 'mp-tutor-lms' ),
                'section'  => 'MP_featured',
                'settings' => 'featured_icon_color',
            ) 
        )); 
    }
}
