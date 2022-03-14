<?php
/* 
Template Name: MP Front Page
*/

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

if ( is_plugin_active('easy-digital-downloads/easy-digital-downloads.php') ) {
    $isActiveEdd = true;
} else {
    $isActiveEdd = false;
}

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

ob_start();
include_once(MP_TUTOR_LMS_DIR_PATH . 'public/partials/header.php');
$template = ob_get_contents();
ob_end_clean();
echo $template;
?>

<section class="header-home-wrap">
    <div class="header-home">
        <div class="txt">
        <?php 

        $headerHeroImage  = get_theme_mod('header_image_right');
        $headerHeroImage  = ( empty( $headerHeroImage ) ? plugins_url() . '/mp-tutor-lms/public/assets/images/image-hero.png' : $headerHeroImage ); 

        $headerHeroTitleTop  = get_theme_mod('header_title_top');
        $headerHeroTitleTop  = ( empty( $headerHeroTitleTop ) ? 'Learning Platform' : $headerHeroTitleTop ); 

        $headerHeroTitle      = get_theme_mod('header_title');
        $headerHeroTitle      = ( empty( $headerHeroTitle ) ? 'Learning From <strong>Zero</strong> To <strong>Hero</strong>' : $headerHeroTitle ); 

        $headerHeroSubTitle  = get_theme_mod('header_sub_title');
        $headerHeroSubTitle  = ( empty( $headerHeroSubTitle ) ? 'Kelas Belajar Online Dengan Metode 10% Materi + 90% Praktek ! Sehingga Goals Nya Setelah Anda Menyelesaikan Kelas Minimal Punya Portofolio Baru' : $headerHeroSubTitle ); 

        ?>
            <span><?php echo esc_html($headerHeroTitleTop); ?></span>
            <h1><?php echo $headerHeroTitle; ?></h1>
            <p><?php echo esc_html($headerHeroSubTitle); ?></p>
            <div class="box-search">
                <form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" autocomplete="off">
                    <input id="searchInput" onkeyup="fetch_results_ajax_search_box()" type="search" name="s" value="" placeholder="Search Course..." required="">
                    <button type="submit"><i class="fas fa-search"></i></button>
                </form>
                <div id="dataFetch" class="dataFetch">
                </div>
            </div>
        </div>
        <div class="image">
            <img src="<?php echo esc_url( $headerHeroImage ); ?>" alt="header image hero">
        </div>
    </div>
</section>

<section class="featured-home-wrap">
    <div class="featured-home">
        <div class="txt">
            <?php 

            $featuredTitleTop  = get_theme_mod('featured_sub_title');
            $featuredTitleTop  = ( empty( $featuredTitleTop ) ? 'Featured' : $featuredTitleTop ); 

            $featuredTitle      = get_theme_mod('featured_title');
            $featuredTitle      = ( empty( $featuredTitle ) ? 'Access Your Course Any Time And Any Where' : $featuredTitle ); 

            ?>
            <span class="title"><?php echo esc_html($featuredTitleTop); ?></span>
            <h2><?php echo $featuredTitle; ?></h2>
            <div class="boxes-item">
                <div class="item">
                    <i class="fas fa-book"></i>
                    <strong>Online Learning</strong>
                    <p>akses materi online selama ada koneksi internet</p>            
                </div>
                <div class="item">
                    <i class="fas fa-certificate"></i>
                    <strong>Get A Certificate</strong>
                    <p>dapat sertifikat setelah menyelesaikan kelas dengan baik</p>
                </div>
                <div class="item">
                    <i class="fas fa-calendar-alt"></i>
                    <strong>Your Schedule</strong>
                    <p>jadwalkan waktu belajar sesuai dengan waktu luang anda</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php 

$popCoursesTitle  = get_theme_mod('populer_courses_title');
$popCoursesTitle  = ( empty( $popCoursesTitle ) ? 'Popular Course' : $popCoursesTitle ); 

$popCoursesSubTitle  = get_theme_mod('populer_courses_sub_title');
$popCoursesSubTitle  = ( empty( $popCoursesSubTitle ) ? 'Better Learning' : $popCoursesSubTitle ); 

$popCoursesBtn  = get_theme_mod('populer_courses_btn_txt');
$popCoursesBtn  = ( empty( $popCoursesBtn ) ? 'Browse All Course' : $popCoursesBtn ); 

$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
$post = array(
    'post_status'         => 'publish',
    'post_type'           => 'courses',
    'posts_per_page'      => 4,
    'paged'               => $paged,
);
$posting = new WP_Query( $post ); 

if ( $posting->have_posts() ) : 
?>
<section class="posts-home-wrap">
    <div id="container" class="posts-home">
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
                                if ( $isActiveEdd ) {
                                    $course_categories       = get_tutor_course_categories();
                                    if( is_array($course_categories) && count($course_categories) ) :                                
                                        foreach ($course_categories as $course_category){
                                            $category_name = $course_category->name;
                                            $category_link = get_term_link($course_category->term_id);
                                            echo esc_html($category_name);
                                        }
                                    endif; 
                                }
                                ?>
                            </div>
                            <div class="title">
                                <?php the_title(); ?>
                            </div>
                            <div class="info">
                                <div class="durasi">
                                    <i class="far fa-clock"></i>
                                    <span>
                                    <?php 
                                    if ( $isActiveEdd ) {
                                        echo esc_html( get_tutor_course_duration_context() ); 
                                    }
                                    ?>
                                    </span>
                                </div>
                                <div class="harga">
                                    <span>
                                    <?php 
                                    if ( $isActiveEdd ) {
                                        echo esc_html( tutor_course_price() );
                                    }                     
                                    ?>
                                    </span>
                                </div>
                            </div>
                        </div>             
                    </div>
                </a> 
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
        </div> <!-- /boxes-item -->
    </div>
    <div class="browse-all-course">
        <button id="load_more"><?php echo $popCoursesBtn; ?></button>
    </div>
</section>
<?php endif; ?>


<?php
ob_start();
include_once(MP_TUTOR_LMS_DIR_PATH . 'public/partials/footer.php');
$template = ob_get_contents();
ob_end_clean();
echo $template;
?>