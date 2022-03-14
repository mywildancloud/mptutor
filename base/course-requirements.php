<?php
/**
 * Template for displaying course requirements
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

do_action('tutor_course/single/before/requirements');

$course_requirements = tutor_course_requirements();

if ( empty($course_requirements)){
	return;
}

if (is_array($course_requirements) && count($course_requirements)){
	?>

	<div class="requirements">
		<h2 class="title-requirements"><?php _e('Requirements', 'mp-tutor-lms'); ?></h2>
		<ul>
			<?php
			foreach ($course_requirements as $requirement){
				echo "<li>{$requirement}</li>";
			}
			?>
		</ul>
	</div>

<?php } ?>

<?php do_action('tutor_course/single/after/requirements'); ?>
