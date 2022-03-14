<?php
/**
 * Template for displaying course audience
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

do_action('tutor_course/single/before/audience');

$target_audience = tutor_course_target_audience();

if ( empty($target_audience)){
	return;
}

if (is_array($target_audience) && count($target_audience)){
	?>

	<div class="audience">
		<h2 class="title-audience"><?php _e('Target Audience', 'mp-tutor-lms'); ?></h2>
		<ul>
			<?php
			foreach ($target_audience as $audience){
				echo "<li>{$audience}</li>";
			}
			?>
		</ul>
	</div>

<?php } ?>

<?php do_action('tutor_course/single/after/audience'); ?>

