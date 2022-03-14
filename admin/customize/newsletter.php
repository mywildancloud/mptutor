<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://brandmarketers.id
 * @since      1.0.0
 *
 * @package    MP_Customize_Newsletter
 * @subpackage MP_Customize_Newsletter/admin
 */
function sanitize_newsletter( $key ) {

    $key = str_replace('<scrip>', '', $key);

    $key = str_replace('</script>', '', $key);

    $key = str_replace('<?php', '', $key);

    $key = str_replace('?>', '', $key);
    
    return $key;

}

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    MP_Customize_Newsletter
 * @subpackage MP_Customize_Newsletter/admin
 * @author     brandmarketers.id <wildan@brandmarketers.id>
 */
class MP_Customize_Newsletter_Admin {

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

    public function MP_Customize_Newsletter( $wp_customize ) { 

        // Section
        $wp_customize->add_section( 'MP_newsletter', 
            array(
                'title'           => __( 'Newsletter', 'mp-tutor-lms' ),
                'priority'        => 260,
            ) 
        );

        // =================== Title ===================
        // Setting
        $wp_customize->add_setting( 'newsletter_title',
            array(
                'default'           => 'Join Our Newsletter We Will Send Coupun Disc Up To 80%',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'wp_kses_post',
            )
        );

        // Control
        $wp_customize->add_control( new MP_Tutor_Lms_TinyMCE( $wp_customize, 'newsletter_title',
            array(
                'label'       => __( 'Title', 'mp-tutor-lms' ),
                'section'     => 'MP_newsletter',
                'input_attrs'      => array(
                    // 'toolbar1'     => 'bold italic bullist numlist alignleft aligncenter alignright link',
                    'toolbar1'     => 'bold italic link',
                    'mediaButtons' => false,
                )
            )
        ) );

        // =================== Sub Title ===================
        // Setting
        $wp_customize->add_setting( 'newsletter_sub_title', 
        array(
            'default'           => 'Newsletter',
            'transport'         => 'postMessage',
            'sanitize_callback' => 'sanitize_text_field',
            ) 
        );
        
        // Control
        $wp_customize->add_control( 'newsletter_sub_title',
        array(
            'label'      => __( 'Sub Title', 'mp-tutor-lms' ),
            'section'    => 'MP_newsletter',
            'type'       => 'input',
            'class'      => 'mp-icon',
            )
        );

        // =================== Embed HTML ===================
        // Setting
        $wp_customize->add_setting( 'newsletter_embed_html',
            array(
                'default'           => '',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_newsletter',
            )
        );
 
        // Control
        $wp_customize->add_control( 'newsletter_embed_html',
            array(
                'label'           => __( 'Embed HTML', 'mp-tutor-lms' ),
                'section'         => 'MP_newsletter',
                'type'            => 'textarea',
            )
        ); 

        // Partial
        $wp_customize->selective_refresh->add_partial(
            'newsletter_embed_html',
            array(
                'selector'            => '.container-form',
                'container_inclusive' => true,
                'render_callback'     => 'customize_refresh_callback_subscribe',
            )
        );

        function customize_refresh_callback_subscribe() {
            $newsletter_embed_html = get_theme_mod('newsletter_embed_html');
           
            echo '<div class="container-form">';
                echo $newsletter_embed_html; 
            echo '</div>';	
        }

        // =================== Background Color ===================
        // Setting
        $wp_customize->add_setting( 'newsletter_hero_bk', 
            array(
                'default'           => '#fff',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_hex_color',
            ) 
        );

        // Control
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'newsletter_hero_bk', 
            array(
                'label'    => __( 'Background Color', 'mp-tutor-lms' ),
                'section'  => 'MP_newsletter',
                'settings' => 'newsletter_hero_bk',
            ) 
        )); 

        // =================== Title Color ===================
        // Setting
        $wp_customize->add_setting( 'newsletter_title_color', 
            array(
                'default'           => '#131b42',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_hex_color',
            ) 
        );

        // Control
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'newsletter_title_color', 
            array(
                'label'    => __( 'Title Color', 'mp-tutor-lms' ),
                'section'  => 'MP_newsletter',
                'settings' => 'newsletter_title_color',
            ) 
        )); 

        // =================== Sub Title Color ===================
        // Setting
        $wp_customize->add_setting( 'newsletter_sub_title_color', 
            array(
                'default'           => '#686868',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_hex_color',
            ) 
        );

        // Control
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'newsletter_sub_title_color', 
            array(
                'label'    => __( 'Sub Title Color', 'mp-tutor-lms' ),
                'section'  => 'MP_newsletter',
                'settings' => 'newsletter_sub_title_color',
            ) 
        ));

        // =================== Button Color ===================
        // Setting
        $wp_customize->add_setting( 'newsletter_btn_color', 
            array(
                'default'           => '#fff',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_hex_color',
            ) 
        );

        // Control
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'newsletter_btn_color', 
            array(
                'label'    => __( 'Button Color', 'mp-tutor-lms' ),
                'section'  => 'MP_newsletter',
                'settings' => 'newsletter_btn_color',
            ) 
        ));

        // =================== Button Background Color ===================
        // Setting
        $wp_customize->add_setting( 'newsletter_btn_bk', 
            array(
                'default'           => '#4352f9',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_hex_color',
            ) 
        );

        // Control
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'newsletter_btn_bk', 
            array(
                'label'    => __( 'Button Background Color', 'mp-tutor-lms' ),
                'section'  => 'MP_newsletter',
                'settings' => 'newsletter_btn_bk',
            ) 
        ));

        // =================== Border Color ===================
        // Setting
        $wp_customize->add_setting( 'newsletter_border_color', 
            array(
                'default'           => '#ced4da',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_hex_color',
            ) 
        );

        // Control
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'newsletter_border_color', 
            array(
                'label'    => __( 'Border Color', 'mp-tutor-lms' ),
                'section'  => 'MP_newsletter',
                'settings' => 'newsletter_border_color',
            ) 
        ));
    }
}
