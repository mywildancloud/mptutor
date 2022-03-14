<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://brandmarketers.id
 * @since      1.0.0
 *
 * @package    MP_Customize_Testimonials
 * @subpackage MP_Customize_Testimonials/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    MP_Customize_Testimonials
 * @subpackage MP_Customize_Testimonials/admin
 * @author     brandmarketers.id <wildan@brandmarketers.id>
 */
class MP_Customize_Testimonials_Admin {

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

    public function MP_Customize_Testimonials( $wp_customize ) { 

        // Section
        $wp_customize->add_section( 'MP_testimonials', 
            array(
                'title'           => __( 'Testimonials', 'mp-tutor-lms' ),
                'priority'        => 250,
            ) 
        );

        // =================== Title ===================
        // Setting
        $wp_customize->add_setting( 'testimonials_title',
            array(
                'default'           => 'Trusted By 2,500 Student',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_text_field'
            )
        );
    
        // Control
        $wp_customize->add_control( 'testimonials_title',
            array(
                'label'           => __( 'Title', 'mp-tutor-lms' ),
                'section'         => 'MP_testimonials',
                'type'            => 'input',
                'class'           => 'mp-icon',
            )
        );

        // =================== Sub Title ===================
        // Setting
        $wp_customize->add_setting( 'testimonials_sub_title',
            array(
                'default'           => 'Testimonials',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_text_field'
            )
        );
    
        // Control
        $wp_customize->add_control( 'testimonials_sub_title',
            array(
                'label'           => __( 'Sub Title', 'mp-tutor-lms' ),
                'section'         => 'MP_testimonials',
                'type'            => 'input',
                'class'           => 'mp-icon',
            )
        );        

        // =================== Logo Image 1 ===================
        // Setting
        $wp_customize->add_setting( 'testimonials_image1',
        array(
            'default'           => '',
            'transport'         => 'refresh',
            'sanitize_callback' => 'esc_url_raw',
            )
        );
 
        // Control
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'testimonials_image1',
            array(
                'label'         => __( 'Image 1', 'mp-tutor-lms' ),
                'section'       => 'MP_testimonials',
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
            'testimonials_image1',
            array(
                'selector'            => '.columns',
                'container_inclusive' => false,
                'render_callback'     => 'customize_refresh_callback_testimonials1',
            )
        );

        function customize_refresh_callback_testimonials1() {
        ?>
            <section id="testimonials">
                <?php
                
                // Title
                $testimonialsTitle    = esc_html( get_theme_mod('testimonials_title', 'Testimonials') );
                $testimonialsSubTitle = esc_html( get_theme_mod('testimonials_sub_title', 'Trusted By 2,500 Student') );

                // Image

                $testimonialsImg1 = get_theme_mod('testimonials_image1');
                $testimonialsImg1 = ( empty( $testimonialsImg1 ) ? plugins_url() . '/mp-tutor-lms/public/assets/images/image1.jpg' : $testimonialsImg1 ); 

                $testimonialsImg2 = get_theme_mod('testimonials_image2');
                $testimonialsImg2 = ( empty( $testimonialsImg2 ) ? plugins_url() . '/mp-tutor-lms/public/assets/images/image2.png' : $testimonialsImg2 ); 

                $testimonialsImg3 = get_theme_mod('testimonials_image3');
                $testimonialsImg3 = ( empty( $testimonialsImg3 ) ? plugins_url() . '/mp-tutor-lms/public/assets/images/image3.png' : $testimonialsImg3 ); 

                // Pesan
                $testimonialsPesan1 = esc_html( get_theme_mod('testimonials_pesan1', '"Awesome Template Tutor LMS page mas Wildan"') );
                $testimonialsPesan2 = esc_html( get_theme_mod('testimonials_pesan2', '"Modern UI Design sih ini,, clean banget mas"') );
                $testimonialsPesan3 = esc_html( get_theme_mod('testimonials_pesan3', '"Sumpah sih ini ringan banget cocok buat bikin web LMS"') );

                // Nama User
                $testimonialsNama1 = esc_html( get_theme_mod('testimonials_nama1', 'John Doe') );
                $testimonialsNama2 = esc_html( get_theme_mod('testimonials_nama2', 'Bram Jhonson') );
                $testimonialsNama3 = esc_html( get_theme_mod('testimonials_nama3', 'Louis Serf') );	
                
                // Latar Belakang
                $testimonialsLbelakang1 = esc_html( get_theme_mod('testimonials_lbelakang1', 'Sr. Director, Social Media Strategy And Audience Engagement') );
                $testimonialsLbelakang2 = esc_html( get_theme_mod('testimonials_lbelakang2', 'Sr. Director, Social Media Strategy And Audience Engagement') );
                $testimonialsLbelakang3 = esc_html( get_theme_mod('testimonials_lbelakang3', 'Sr. Director, Social Media Strategy And Audience Engagement') );

                // Company User
                $testimonialsCompany1 = esc_html( get_theme_mod('testimonials_company1', 'Fake Company Inc') );
                $testimonialsCompany2 = esc_html( get_theme_mod('testimonials_company2', 'Fake Company Inc') );
                $testimonialsCompany3 = esc_html( get_theme_mod('testimonials_company3', 'Fake Company Inc') );

                ?>
                <div class="row">
                    <div class="columns">
                        <div class="image-left"></div>
                        <div class="image-right"></div>
                        <span class="txt-top"><?php echo $testimonialsSubTitle; ?></span>
                        <h2><?php echo $testimonialsTitle; ?></h2>
                        <div class="fadeOut owl-carousel owl-theme">
                            <div class="item item1">
                                <div class="box-image box-image1">
                                    <img src="<?php echo $testimonialsImg1; ?>" alt="tertimonials pertama">
                                </div>
                                <div class="box-text">
                                    <h3><?php echo $testimonialsPesan1; ?></h3>
                                    <strong><?php echo $testimonialsNama1; ?></strong>
                                    <span><?php echo $testimonialsLbelakang1; ?></span>
                                    <p><?php echo $testimonialsCompany1; ?></p>
                                </div>
                            </div>
                            <div class="item item2">
                                <div class="box-image box-image2">						
                                    <img src="<?php echo $testimonialsImg2; ?>" alt="tertimonials kedua">
                                </div>
                                <div class="box-text">
                                    <h3><?php echo $testimonialsPesan2; ?></h3>
                                    <strong><?php echo $testimonialsNama2; ?></strong>
                                    <span><?php echo $testimonialsLbelakang2; ?></span>
                                    <p><?php echo $testimonialsCompany2; ?></p>
                                </div>					
                            </div>
                            <div class="item item3">
                                <div class="box-image box-image3">
                                    <img src="<?php echo $testimonialsImg3; ?>" alt="tertimonials ketiga">
                                </div>
                                <div class="box-text">
                                    <h3><?php echo $testimonialsPesan3; ?></h3>
                                    <strong><?php echo $testimonialsNama3; ?></strong>
                                    <span><?php echo $testimonialsLbelakang3; ?></span>
                                    <p><?php echo $testimonialsCompany3; ?></p>
                                </div>	
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        <?php }

        // =================== Pesan User 1 ===================
        // Setting
        $wp_customize->add_setting( 'testimonials_pesan1',
            array(
                'default'           => '"Awesome Template Tutor LMS page mas Wildan"',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_text_field'
            )
        );
    
        // Control
        $wp_customize->add_control( 'testimonials_pesan1',
            array(
                'label'           => __( 'Pesan User 1', 'mp-tutor-lms' ),
                'section'         => 'MP_testimonials',
                'type'            => 'input',
                'class'           => 'mp-icon',
            )
        );

        // =================== Nama User 1 ===================
        // Setting
        $wp_customize->add_setting( 'testimonials_nama1', 
        array(
            'default'           => 'John Doe',
            'transport'         => 'postMessage',
            'sanitize_callback' => 'sanitize_text_field',
            ) 
        );
        
        // Control
        $wp_customize->add_control( 'testimonials_nama1',
        array(
            'label'      => __( 'Nama User 1', 'mp-tutor-lms' ),
            'section'    => 'MP_testimonials',
            'type'       => 'input',
            'class'      => 'mp-icon',
            )
        );

        // =================== Latar Belakang User 1 ===================
        // Setting
        $wp_customize->add_setting( 'testimonials_lbelakang1', 
        array(
            'default'           => 'Sr. Director, Social Media Strategy And Audience Engagement',
            'transport'         => 'postMessage',
            'sanitize_callback' => 'sanitize_text_field',
            ) 
        );
        
        // Control
        $wp_customize->add_control( 'testimonials_lbelakang1',
        array(
            'label'      => __( 'Latar Belakang User 1', 'mp-tutor-lms' ),
            'section'    => 'MP_testimonials',
            'type'       => 'input',
            'class'      => 'mp-icon',
            )
        );

        // =================== Company User 1 ===================
        // Setting
        $wp_customize->add_setting( 'testimonials_company1', 
        array(
            'default'           => 'Fake Company Inc',
            'transport'         => 'postMessage',
            'sanitize_callback' => 'sanitize_text_field',
            ) 
        );
        
        // Control
        $wp_customize->add_control( 'testimonials_company1',
        array(
            'label'      => __( 'Company User 1', 'mp-tutor-lms' ),
            'section'    => 'MP_testimonials',
            'type'       => 'input',
            'class'      => 'mp-icon',
            )
        );

        // =================== Logo Image 2 ===================
        // Setting
        $wp_customize->add_setting( 'testimonials_image2',
        array(
            'default'           => '',
            'transport'         => 'refresh',
            'sanitize_callback' => 'esc_url_raw',
            )
        );
 
        // Control
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'testimonials_image2',
            array(
                'label'         => __( 'Image 2', 'mp-tutor-lms' ),
                'section'       => 'MP_testimonials',
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
            'testimonials_image2',
            array(
                'selector'            => '.columns',
                'container_inclusive' => false,
                'render_callback'     => 'customize_refresh_callback_testimonials1',
            )
        );

        // =================== Pesan User 2 ===================
        // Setting
        $wp_customize->add_setting( 'testimonials_pesan2',
            array(
                'default'           => '"Modern UI Design sih ini,, clean banget mas"',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_text_field'
            )
        );
    
        // Control
        $wp_customize->add_control( 'testimonials_pesan2',
            array(
                'label'           => __( 'Pesan User 2', 'mp-tutor-lms' ),
                'section'         => 'MP_testimonials',
                'type'            => 'input',
                'class'           => 'mp-icon',
            )
        );

        // =================== Nama User 2 ===================
        // Setting
        $wp_customize->add_setting( 'testimonials_nama2', 
        array(
            'default'           => 'John Doe',
            'transport'         => 'postMessage',
            'sanitize_callback' => 'sanitize_text_field',
            ) 
        );
        
        // Control
        $wp_customize->add_control( 'testimonials_nama2',
        array(
            'label'      => __( 'Nama User 2', 'mp-tutor-lms' ),
            'section'    => 'MP_testimonials',
            'type'       => 'input',
            'class'      => 'mp-icon',
            )
        );

        // =================== Latar Belakang User 2 ===================
        // Setting
        $wp_customize->add_setting( 'testimonials_lbelakang2', 
        array(
            'default'           => 'Sr. Director, Social Media Strategy And Audience Engagement',
            'transport'         => 'postMessage',
            'sanitize_callback' => 'sanitize_text_field',
            ) 
        );
        
        // Control
        $wp_customize->add_control( 'testimonials_lbelakang2',
        array(
            'label'      => __( 'Latar Belakang User 2', 'mp-tutor-lms' ),
            'section'    => 'MP_testimonials',
            'type'       => 'input',
            'class'      => 'mp-icon',
            )
        );

        // =================== Company User 2 ===================
        // Setting
        $wp_customize->add_setting( 'testimonials_company2', 
        array(
            'default'           => 'Fake Company Inc',
            'transport'         => 'postMessage',
            'sanitize_callback' => 'sanitize_text_field',
            ) 
        );
        
        // Control
        $wp_customize->add_control( 'testimonials_company2',
        array(
            'label'      => __( 'Company User 2', 'mp-tutor-lms' ),
            'section'    => 'MP_testimonials',
            'type'       => 'input',
            'class'      => 'mp-icon',
            )
        );

        // =================== Logo Image 3 ===================
        // Setting
        $wp_customize->add_setting( 'testimonials_image3',
        array(
            'default'           => '',
            'transport'         => 'refresh',
            'sanitize_callback' => 'esc_url_raw',
            )
        );
 
        // Control
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'testimonials_image3',
            array(
                'label'         => __( 'Image 3', 'mp-tutor-lms' ),
                'section'       => 'MP_testimonials',
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
            'testimonials_image3',
            array(
                'selector'            => '.columns',
                'container_inclusive' => false,
                'render_callback'     => 'customize_refresh_callback_testimonials1',
            )
        );

        // =================== Pesan User 3 ===================
        // Setting
        $wp_customize->add_setting( 'testimonials_pesan3',
            array(
                'default'           => '"Sumpah sih ini ringan banget cocok buat bikin web LMS"',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_text_field'
            )
        );
    
        // Control
        $wp_customize->add_control( 'testimonials_pesan3',
            array(
                'label'           => __( 'Pesan User 3', 'mp-tutor-lms' ),
                'section'         => 'MP_testimonials',
                'type'            => 'input',
                'class'           => 'mp-icon',
            )
        );

        // =================== Nama User 3 ===================
        // Setting
        $wp_customize->add_setting( 'testimonials_nama3', 
        array(
            'default'           => 'John Doe',
            'transport'         => 'postMessage',
            'sanitize_callback' => 'sanitize_text_field',
            ) 
        );
        
        // Control
        $wp_customize->add_control( 'testimonials_nama3',
        array(
            'label'      => __( 'Nama User 3', 'mp-tutor-lms' ),
            'section'    => 'MP_testimonials',
            'type'       => 'input',
            'class'      => 'mp-icon',
            )
        );

        // =================== Latar Belakang User 3 ===================
        // Setting
        $wp_customize->add_setting( 'testimonials_lbelakang3', 
        array(
            'default'           => 'Sr. Director, Social Media Strategy And Audience Engagement',
            'transport'         => 'postMessage',
            'sanitize_callback' => 'sanitize_text_field',
            ) 
        );
        
        // Control
        $wp_customize->add_control( 'testimonials_lbelakang3',
        array(
            'label'      => __( 'Latar Belakang User 3', 'mp-tutor-lms' ),
            'section'    => 'MP_testimonials',
            'type'       => 'input',
            'class'      => 'mp-icon',
            )
        );

        // =================== Company User 3 ===================
        // Setting
        $wp_customize->add_setting( 'testimonials_company3', 
        array(
            'default'           => 'Fake Company Inc',
            'transport'         => 'postMessage',
            'sanitize_callback' => 'sanitize_text_field',
            ) 
        );
        
        // Control
        $wp_customize->add_control( 'testimonials_company3',
        array(
            'label'      => __( 'Company User 3', 'mp-tutor-lms' ),
            'section'    => 'MP_testimonials',
            'type'       => 'input',
            'class'      => 'mp-icon',
            )
        );
    }
}
