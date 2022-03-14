<?php
/**
 * Template for displaying course benefits
 *
 * @since v.1.0.0
 *
 * @author Themeum
 * @url https://themeum.com
 *
 *
 * @package TutorLMS/Templates
 * @version 1.4.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action('tutor_course/single/before/benefits');

$course_benefits = tutor_course_benefits();
if ( empty($course_benefits)){
	return;
}

if (is_array($course_benefits) && count($course_benefits)){
	?>

	<div class="benefits">
		<h2 class="title-benefits"><?php _e('Learning Objectives', 'mp-tutor-lms'); ?></h2>
		<ul>
			<?php
			foreach ($course_benefits as $benefit){
				echo "<li>{$benefit}</li>";
			}
			?>
		</ul>
	</div>

<?php } ?>

<?php do_action('tutor_course/single/after/benefits'); ?>

