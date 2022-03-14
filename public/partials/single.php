<?php

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

ob_start();
include_once(MP_TUTOR_LMS_DIR_PATH . 'public/partials/header.php');
$template = ob_get_contents();
ob_end_clean();
echo $template;

do_action('tutor_course/single/before/wrap'); 

include_once(MP_TUTOR_LMS_DIR_PATH . 'base/breadcrumbs.php');

global $post, $authordata;
$profile_url = tutor_utils()->profile_url($authordata->ID);
?>

<section <?php tutor_post_class('container'); ?>>
    <article class="article">
        <div class="info-meta">
            <?php do_action('tutor_course/single/before/inner-wrap'); ?>
            <div class="breadcrumbs">
                <?php echo esc_html( mp_tutor_lms_breadcrumb() ); ?>
            </div>
            <h1><?php the_title(); ?></h1>
            <?php
            $disable_course_author   = get_tutor_option('disable_course_author');
            $disable_course_level    = get_tutor_option('disable_course_level');
            $disable_course_share    = get_tutor_option('disable_course_share');
            $disable_course_duration = get_tutor_option('disable_course_duration');
            $disable_total_enrolled  = get_tutor_option('disable_course_total_enrolled');
            $disable_update_date     = get_tutor_option('disable_course_update_date');
            $course_duration         = get_tutor_course_duration_context();
            ?>

            <div class="meta-top">
                <!-- Author -->
                <?php if( !$disable_course_author ): ?>
                    <div class="author">                  
                        <?php echo get_avatar( get_the_author_meta( 'ID' ), 48 ); ?>
                        <span><?php echo esc_html( get_the_author() ); ?></span>
                    </div>  
                <?php endif; ?>

                <!-- Enrolled -->
                <?php if( !$disable_total_enrolled ): ?>
                    <div class="enrolled">                  
                        <i class="far fa-user-circle"></i>
                        <span class="count"><?php echo (int) tutor_utils()->count_enrolled_users_by_course(); ?></span>
                        <span class="txt"><?php esc_html_e(' Enrolled', 'mp-tutor-lms'); ?></span>
                    </div>  
                <?php endif; ?>
            </div> <!-- /meta-top -->

            <div class="meta-video">
                <?php tutor_course_video(); ?>  
            </div> <!-- /meta-video -->

            <div class="meta-tabs">
                <div class="tabs">
                    <span class="tab"><?php echo __('Overview', 'mp-tutor-lms'); ?></span>
                    <span class="tab"><?php echo __('Curriculum', 'mp-tutor-lms'); ?></span>      
                </div>
                <div class="tab-content">
                    <div class="tab-item">
                        <div class="the-content">
                            <?php the_content(); ?>
                        </div>
                        <?php 
                        include_once(MP_TUTOR_LMS_DIR_PATH . 'base/course-requirements.php');
                        include_once(MP_TUTOR_LMS_DIR_PATH . 'base/course-benefits.php');
                        include_once(MP_TUTOR_LMS_DIR_PATH . 'base/course-target-audience.php');
                        ?>
                    </div>
                    <div class="tab-item">
                    <?php 
                    include_once(MP_TUTOR_LMS_DIR_PATH . 'base/course-topics.php'); 
                    wp_reset_postdata();
                    ?>
                    </div>
                </div>
            </div> <!-- /meta-tabs -->
            <?php do_action('tutor_course/single/after/inner-wrap'); ?>
        </div> <!-- /info-meta -->
    </article> <!-- /article -->

    <?php if ( is_plugin_active('easy-digital-downloads/easy-digital-downloads.php') ) : ?>
        <aside class="sidebar">
            <?php 
            // Enroll Box (info courses)
            do_action('tutor_course/single/before/sidebar');
            include_once(MP_TUTOR_LMS_DIR_PATH . 'base/course-enroll-box.php');
            
            // Course Categories
            $args = array(
                'taxonomy' => 'course-category',
            );
            if ( !empty($args) ) :    
                echo '<div class="courses-category">';
                    $cats = get_categories($args);
                    echo '<h2>'.__('Course Categories', 'mp-tutor-lms').'</h2>';
                    foreach($cats as $cat) {

                    echo '<ul>';
                        echo '<li>';
                            echo '<a href="' . esc_url(get_category_link( $cat->term_id ) ) . '">';
                                echo esc_html($cat->name);
                            echo '</a>';
                        echo '</li>';
                    echo '</ul>';  

                    }
                echo '</div>';
            endif;

            // Related Course
            $args = array(
                'post_type' => array( 'courses' )
            );
            $the_query = new WP_Query( $args );
            echo '<div class="post-courses">'; 
            echo '<h2>'.__('Related Course', 'mp-tutor-lms').'</h2>';
            if ( $the_query->have_posts() ) {
                echo '<div class="box-content">';
                    while ( $the_query->have_posts() ) {
                        $the_query->the_post();
                        echo '<div class="content-gambar">'; 
                            echo '<a href="' . esc_url( get_the_permalink() ) . '">'; 
                                the_post_thumbnail(); 
                            echo '</a>';
                        echo '</div>';

                        echo '<div class="content-title">'; 
                            echo '<a href="' . esc_url( get_the_permalink() ) . '">'; 
                                echo esc_html(get_the_title()); 
                            echo '</a>';
                        echo '</div>';
                    }
                echo '</div>';
            } else {
                echo __('no posts found', 'mp-tutor-lms');
            }
            echo '</div>';
            /* Restore original Post Data */
            wp_reset_postdata();

            do_action('tutor_course/single/after/sidebar'); 
            ?>
        </aside>
    <?php endif; // is active plugin EDD ?>
</section>

<?php 	

do_action('tutor_course/single/after/wrap'); 

ob_start();
include_once(MP_TUTOR_LMS_DIR_PATH . 'public/partials/footer.php');
$template = ob_get_contents();
ob_end_clean();
echo $template;
?>