<?php
/**
 * Template for displaying course content
 *
 * @since v.1.0.0
 *
 * @author Themeum
 * @url https://themeum.com
 *
 * @package TutorLMS/Templates
 * @version 1.4.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$disable_course_level    = esc_html( get_tutor_option('disable_course_level') );
$disable_course_duration = esc_html(  get_tutor_option('disable_course_duration') );
$course_duration         = esc_html( get_tutor_course_duration_context() );
$course_categories       = get_tutor_course_categories();

?>
<div class="box-top">
	<?php tutor_course_price(); ?>
	<?php if (!$disable_course_level) : ?>
		<div class="left level"><i class="fas fa-user-graduate"></i><?php _e('Level:', 'mp-tutor-lms'); ?></div>
		<div class="right level-txt"><?php echo esc_html(get_tutor_course_level()); ?></div>		
	<?php endif; ?>
	<?php if( !empty($course_duration) && !$disable_course_duration) : ?>
		<div class="left duration"><i class="far fa-clock"></i><?php _e('Duration:', 'mp-tutor-lms'); ?></div>
		<div class="right duration-txt"><?php echo esc_html($course_duration); ?></div>
	<?php endif; ?>
	<?php if( is_array($course_categories) && count($course_categories) ) : ?>
		<div class="left subject"><i class="fas fa-tag"></i><?php _e('Subject:', 'mp-tutor-lms'); ?></div>
		<div class="right subject-txt">
		<?php
		foreach ($course_categories as $course_category){
			$category_name = $course_category->name;
			$category_link = get_term_link($course_category->term_id);
			echo "<a href='".esc_url($category_link)."'>".esc_html($category_name)."</a>";
		}
		?>
		</div>
	<?php endif; ?>
	<div class="materials">
		<?php tutor_course_material_includes_html(); ?>
	</div>
	<?php 
	// Check Link Cart / Start Courses
	$mp_enrolled = tutor_utils()->is_enrolled();

	if ( $mp_enrolled ) : ?>

		<a class="start-courses" href="<?php echo esc_url( home_url( '/' ) ); ?>dashboard/enrolled-courses/">Start Courses</a>

	<?php else : ?>
		<div class="cart-custom">
			<?php 
			$monetize_by = tutils()->get_option('monetize_by');
			if( class_exists('Easy_Digital_Downloads') && $monetize_by == 'edd' ) {
				include_once(MP_TUTOR_LMS_DIR_PATH . 'base/add-to-cart-edd.php'); 
			} else {
				include_once(MP_TUTOR_LMS_DIR_PATH . 'base/add-to-cart.php'); 
			}

			// Check box wishlist
			if ( ! empty( $_COOKIE['MP-Wishlist'] ) ) {

				$getCookie = explode(' ', $_COOKIE['MP-Wishlist']);

				if ( in_array(get_the_ID(), $getCookie) ) {
					echo '<div class="box-wishlist have-wishlist">';
						echo '<span class="wishlist">Remove to Wishlist</span>';
					echo '</div>';
				} else {
					echo '<div class="box-wishlist not-have-wishlist">';
						echo '<span class="wishlist">Add to Wishlist</span>';
					echo '</div>';
				}

			} else {
				echo '<div class="box-wishlist not-have-wishlist">';
					echo '<span class="wishlist">Add to Wishlist</span>';
				echo '</div>';
			}
			// echo $_COOKIE['MP-Wishlist'];
			?>
		</div>
	<?php endif; ?>
</div>
