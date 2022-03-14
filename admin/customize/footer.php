<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://brandmarketers.id
 * @since      1.0.0
 *
 * @package    MP_Customize_Footer
 * @subpackage MP_Customize_Footer/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    MP_Customize_Footer
 * @subpackage MP_Customize_Footer/admin
 * @author     brandmarketers.id <wildan@brandmarketers.id>
 */
class MP_Customize_Footer_Admin {

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

    public function MP_Customize_Footer( $wp_customize ) { 

        // Section
        $wp_customize->add_section( 'MP_footer', 
            array(
                'title'           => __( 'Footer', 'mp-tutor-lms' ),
                'priority'        => 260,
            ) 
        );

        // =================== Background Color ===================
        // Setting
        $wp_customize->add_setting( 'footer_bk', 
            array(
                'default'           => '#f9f9f9',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_hex_color',
            ) 
        );

        // Control
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_bk', 
            array(
                'label'    => __( 'Background Color', 'mp-tutor-lms' ),
                'section'  => 'MP_footer',
                'settings' => 'footer_bk',
            ) 
        ));

        // =================== Title Color ===================
        // Setting
        $wp_customize->add_setting( 'footer_title_color', 
            array(
                'default'           => '#131b42',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_hex_color',
            ) 
        );

        // Control
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_title_color', 
            array(
                'label'    => __( 'Title Color', 'mp-tutor-lms' ),
                'section'  => 'MP_footer',
                'settings' => 'footer_title_color',
            ) 
        ));

        // =================== Text Footer ===================
        // Setting
        $wp_customize->add_setting( 'footer_txt_bottom',
            array(
                'default'           => 'Copyright 2021 - Themes Mp Tutor Lms',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'wp_kses_post',
            )
        );

        // Control
        $wp_customize->add_control( new MP_Tutor_Lms_TinyMCE( $wp_customize, 'footer_txt_bottom',
            array(
                'label'       => __( 'Text Footer', 'mp-tutor-lms' ),
                'section'     => 'MP_footer',
                'input_attrs'      => array(
                    'toolbar1'     => 'bold italic link',
                    'mediaButtons' => false,
                )
            )
        ) );

        // =================== Text Color ===================
        // Setting
        $wp_customize->add_setting( 'footer_txt_color', 
            array(
                'default'           => '#474747',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_hex_color',
            ) 
        );

        // Control
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_txt_color', 
            array(
                'label'    => __( 'Text Color', 'mp-tutor-lms' ),
                'section'  => 'MP_footer',
                'settings' => 'footer_txt_color',
            ) 
        ));
    }
}
