<?php
/**
 * @package TutorLMS/Templates
 * @version 1.4.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$product_id = tutor_utils()->get_course_product_id();
$download = new EDD_Download( $product_id );

if ($download->ID) {

	echo edd_get_purchase_link( 
		array( 'download_id' => $download->ID,
			'price'  => false,
			'direct' => false,
			'text'   => __('Add to Cart', 'mp-tutor-lms'),
			'class'  => 'cart-edd-custom' 
		) 
	);

} else {
	?>
    <p class="tutor-alert-warning">
		<?php _e('Please make sure that your EDD product exists and valid for this course', 'mp-tutor-lms'); ?>
    </p>
	<?php
}