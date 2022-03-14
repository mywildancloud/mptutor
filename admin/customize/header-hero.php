<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://brandmarketers.id
 * @since      1.0.0
 *
 * @package    MP_Customize_Header_Hero
 * @subpackage MP_Customize_Header_Hero/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    MP_Customize_Header_Hero
 * @subpackage MP_Customize_Header_Hero/admin
 * @author     brandmarketers.id <wildan@brandmarketers.id>
 */
class MP_Customize_Header_Hero_Admin {

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

    public function MP_Customize_Header_Hero( $wp_customize ) { 

        // Section
        $wp_customize->add_section( 'MP_header_hero', 
            array(
                'title'           => __( 'Header Hero', 'mp-tutor-lms' ),
                'priority'        => 220,
            ) 
        );

        // =================== Image Right ===================
        // Setting
        $wp_customize->add_setting( 'header_image_right',
            array(
                'default'           => '',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw'
            )
        );
 
        // Control
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'header_image_right',
            array(
                'label'         => __( 'Image', 'mp-tutor-lms' ),
                'section'       => 'MP_header_hero',
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
            'header_image_right',
            array(
                'selector'            => '.header-home .image',
                'container_inclusive' => true,
                'render_callback'     => 'customize_refresh_callback_heaader_image_right',
            )
        );

        function customize_refresh_callback_heaader_image_right() {
            $headerHeroImage  = get_theme_mod('header_image_right');
            $headerHeroImage  = ( empty( $headerHeroImage ) ? plugins_url() . '/mp-tutor-lms/public/assets/images/image-hero.png' : $headerHeroImage ); 
            echo '<div class="image">';
                echo '<img src="'.$headerHeroImage.'" alt="header image hero" >';
            echo '</div>';
        }


        // =================== Title Top ===================
        // Setting
        $wp_customize->add_setting( 'header_title_top', 
        array(
            'default'           => 'Learning Platform',
            'transport'         => 'postMessage',
            'sanitize_callback' => 'sanitize_text_field',
            ) 
        );
        
        // Control
        $wp_customize->add_control( 'header_title_top',
        array(
            'label'      => __( 'Title Top', 'mp-tutor-lms' ),
            'section'    => 'MP_header_hero',
            'type'       => 'input',
            'class'      => 'mp-icon',
            )
        );

        // =================== Title ===================
        // Setting
        $wp_customize->add_setting( 'header_title',
            array(
                'default'           => 'Learning From <strong>Zero</strong> To <strong>Hero</strong>',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'wp_kses_post',
            )
        );

        // Control
        $wp_customize->add_control( new MP_Tutor_Lms_TinyMCE( $wp_customize, 'header_title',
            array(
                'label'       => __( 'Title', 'mp-tutor-lms' ),
                'section'     => 'MP_header_hero',
                'input_attrs'      => array(
                    // 'toolbar1'     => 'bold italic bullist numlist alignleft aligncenter alignright link',
                    'toolbar1'     => 'bold italic link',
                    'mediaButtons' => false,
                )
            )
        ) );

        // =================== Sub Title ===================
        // Setting
        $wp_customize->add_setting( 'header_sub_title',
            array(
                'default'           => 'Kelas Belajar Online Dengan Metode 10% Materi + 90% Praktek ! Sehingga Goals Nya Setelah Anda Menyelesaikan Kelas Minimal Punya Portofolio Baru',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_text_field'
            )
        );
 
        // Control
        $wp_customize->add_control( 'header_sub_title',
            array(
                'label'           => __( 'Sub Title', 'mp-tutor-lms' ),
                'section'         => 'MP_header_hero',
                'type'            => 'textarea',
            )
        );

        // =================== Background Color ===================
        // Setting
        $wp_customize->add_setting( 'header_hero_bk', 
            array(
                'default'           => '#fff',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_hex_color',
            ) 
        );

        // Control
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_hero_bk', 
            array(
                'label'    => __( 'Background Color', 'mp-tutor-lms' ),
                'section'  => 'MP_header_hero',
                'settings' => 'header_hero_bk',
            ) 
        )); 

        // =================== Title Color ===================
        // Setting
        $wp_customize->add_setting( 'header_title_color', 
            array(
                'default'           => '#131b42',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_hex_color',
            ) 
        );

        // Control
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_title_color', 
            array(
                'label'    => __( 'Title Color', 'mp-tutor-lms' ),
                'section'  => 'MP_header_hero',
                'settings' => 'header_title_color',
            ) 
        )); 

        // =================== Sub Title Color ===================
        // Setting
        $wp_customize->add_setting( 'header_sub_title_color', 
            array(
                'default'           => '#686868',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_hex_color',
            ) 
        );

        // Control
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_sub_title_color', 
            array(
                'label'    => __( 'Sub Title Color', 'mp-tutor-lms' ),
                'section'  => 'MP_header_hero',
                'settings' => 'header_sub_title_color',
            ) 
        ));

        // =================== Background Color Search  ===================
        // Setting
        $wp_customize->add_setting( 'header_search_bk', 
            array(
                'default'           => '#efefef',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_hex_color',
            ) 
        );

        // Control
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_search_bk', 
            array(
                'label'    => __( 'Background Color Search', 'mp-tutor-lms' ),
                'section'  => 'MP_header_hero',
                'settings' => 'header_search_bk',
            ) 
        ));

        // =================== Color Icon Search  ===================
        // Setting
        $wp_customize->add_setting( 'header_icon_search_color', 
            array(
                'default'           => '#7d88ff',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_hex_color',
            ) 
        );

        // Control
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_icon_search_color', 
            array(
                'label'    => __( 'Color Icon Search', 'mp-tutor-lms' ),
                'section'  => 'MP_header_hero',
                'settings' => 'header_icon_search_color',
            ) 
        )); 
    }
}
