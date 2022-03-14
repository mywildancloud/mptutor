<?php
/* 
Template Name: MP Wishlist
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

ob_start();
include_once(MP_TUTOR_LMS_DIR_PATH . 'public/partials/header.php');
$template = ob_get_contents();
ob_end_clean();
echo $template;
?>

<section class="wishlist">
    <div class="title-wishlist">
        <h1>Your Wishlist</h1>
    </div>
    <div class="breadcrumbs-wishlist">
        <?php if ( ! empty( $_COOKIE['MP-Wishlist'] ) ) : ?>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a><span> / Wishlist</span>
        <?php endif; ?>
    </div>

    <?php 
    if ( ! empty( $_COOKIE['MP-Wishlist'] ) ) {
        $getCookie = explode(' ', $_COOKIE['MP-Wishlist']);
    } else {
        $getCookie = '';
    }
    $post = array(
        'post_status' => 'publish',
        'post__in'    => $getCookie,
        'post_type'   => 'courses',
    );
    $posting = new WP_Query( $post ); 
    
    if ( $posting->have_posts() && ! empty( $_COOKIE['MP-Wishlist'] ) ) : ?>
        <div class="content-wishlist">
            <table>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
                <?php 
                while( $posting->have_posts() ): $posting->the_post(); ?>
                    <tr>
                        <td class="dua">
                            <a href="<?php the_permalink(); ?>" target="_blank"><?php the_post_thumbnail(); ?></a>
                            <a href="<?php the_permalink(); ?>" target="_blank" class="title"><?php the_title(); ?></a>
                        </td>
                        <td class="price"><?php tutor_course_price(); ?></td>
                        <td class="add-to-cart">
                            <?php 
                            $monetize_by = tutils()->get_option('monetize_by');
                            if( class_exists('Easy_Digital_Downloads') && $monetize_by == 'edd' ) {
                                $product_id = tutor_utils()->get_course_product_id();
                                echo edd_get_purchase_link( 
                                    array( 'download_id' => $product_id,
                                        'price'  => false,
                                        'direct' => false,
                                        'text'   => __('+ Add to Cart', 'mp-tutor-lms'),
                                        'class'  => 'cart-edd-custom' 
                                    ) 
                                );
                            } 
                            ?>
                        </td>
                    </tr>
                <?php endwhile;
                wp_reset_postdata();
                ?>
            </table>
            <span class="clear-all-wishlist">X Clear all wishlist</span>
        </div>
    <?php else: ?>
        <div class="not-found">
            <div class="breadcrumb-wishlist-not-found">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a><span> / Wishlist</span>
            </div>
            <h2>Sorry, Wishlist not found!</h2>
        </div>
    <?php endif; ?>
</section>


<?php
ob_start();
include_once(MP_TUTOR_LMS_DIR_PATH . 'public/partials/footer-wishlist.php');
$template = ob_get_contents();
ob_end_clean();
echo $template;
?>