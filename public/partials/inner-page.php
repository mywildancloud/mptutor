<?php
/* 
Template Name: MP Inner Page
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

<article>
	<section class="the-content-inner-page">
		<?php the_content(); ?>
	</section>
</article>

<?php
ob_start();
include_once(MP_TUTOR_LMS_DIR_PATH . 'public/partials/footer-wishlist.php');
$template = ob_get_contents();
ob_end_clean();
echo $template;
?>