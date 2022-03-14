<?php

// Adds widget Payment
class Mp_Tutor_Lms_Payment extends WP_Widget {

    public function __construct() {
        $box = array( 
            'classname'                   => 'mp-tutor-lms-widget-payment',
            'description'                 => esc_html__( 'This is a widget for displaying Type Payment.', 'mp-tutor-lms' ),
            'customize_selective_refresh' => true, 
        );

        parent::__construct( 'mp_tutor_lms_payment', esc_html__( 'MP Tutor LMS Payment', 'mp-tutor-lms' ), $box );    
        
    } 

    // Front-end 
	public function widget( $args, $instance ) {
        $master_card = ! empty( $instance['master_card'] ) ? sanitize_key( $instance['master_card'] ) : '';
        $visa        = ! empty( $instance['visa'] ) ? sanitize_key( $instance['visa'] ) : '';
        $paypal      = ! empty( $instance['paypal'] ) ? sanitize_key( $instance['paypal'] ) : '';
        $stripe      = ! empty( $instance['stripe'] ) ? sanitize_key( $instance['stripe'] ) : '';

		echo $args['before_widget'];

		if ( ! empty( $instance['title'] ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
        } else {
            echo '<h4 class="widget-title-footer">Payment</h4>';
        }
?>

        <div class="container-icon-payment-widget">
            <?php if ( $master_card ) : ?>
                <i class="fab fa-cc-mastercard"></i>
            <?php endif; ?>
            
            <?php if ( $visa ) : ?>
                <i class="fab fa-cc-visa"></i>
            <?php endif; ?>
            
            <?php if ( $paypal ) : ?>
                <i class="fab fa-cc-paypal"></i>
            <?php endif; ?>

            <?php if ( $stripe  ) : ?>
                <i class="fab fa-cc-stripe"></i>
            <?php endif; ?>
        </div>
<?php

		echo $args['after_widget'];
	}        
    
    // Form Widget
    function form( $instance ) {
        $master_card = isset( $instance['master_card'] ) ? (bool) $instance['master_card'] : true;
        $visa        = isset( $instance['visa'] ) ? (bool) $instance['visa'] : true;
        $paypal      = isset( $instance['paypal'] ) ? (bool) $instance['paypal'] : true;
        $stripe      = isset( $instance['stripe'] ) ? (bool) $instance['stripe'] : true;
?>
        <!-- Title -->
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
                <?php esc_html_e( 'Title:', 'mp-tutor-lms' ); ?>
            </label>
            <input class="widefat" value="<?php echo esc_attr( $title ); ?>" type="text" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" placeholder="Payment" />
        </p> 
                

        <!-- Master Card -->
        <p>
            <input class="checkbox" type="checkbox" <?php checked( $master_card ); ?> id="<?php echo esc_attr( $this->get_field_id( 'master_card' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'master_card' ) ); ?>" />
            <label for="<?php echo esc_attr( $this->get_field_id( 'master_card' ) ); ?>">
                <?php esc_html_e( "Show Master Card?", 'mp-tutor-lms' ); ?>
            </label>
        </p>

        <!-- Visa -->
        <p>
            <input class="checkbox" type="checkbox" <?php checked( $visa ); ?> id="<?php echo esc_attr( $this->get_field_id( 'visa' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'visa' ) ); ?>" />
            <label for="<?php echo esc_attr( $this->get_field_id( 'visa' ) ); ?>">
                <?php esc_html_e( "Show Visa?", 'mp-tutor-lms' ); ?>
            </label>
        </p>

        <!-- Paypal -->
        <p>
            <input class="checkbox" type="checkbox" <?php checked( $paypal ); ?> id="<?php echo esc_attr( $this->get_field_id( 'paypal' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'paypal' ) ); ?>" />
            <label for="<?php echo esc_attr( $this->get_field_id( 'paypal' ) ); ?>">
                <?php esc_html_e( "Show Paypal?", 'mp-tutor-lms' ); ?>
            </label>
        </p>

        <!-- Stripe -->
        <p>
            <input class="checkbox" type="checkbox" <?php checked( $stripe ); ?> id="<?php echo esc_attr( $this->get_field_id( 'stripe' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'stripe' ) ); ?>" />
            <label for="<?php echo esc_attr( $this->get_field_id( 'stripe' ) ); ?>">
                <?php esc_html_e( "Show Strip?", 'mp-tutor-lms' ); ?>
            </label>
        </p>

    <?php
    }

    // Update Widget
    public function update( $new_instance, $old_instance ) {

        $instance = $old_instance;

        $instance['title']       = sanitize_text_field( $new_instance['title'] );
        $instance['master_card'] = sanitize_key( $new_instance['master_card'] );
        $instance['visa']        = sanitize_key( $new_instance['visa'] );
        $instance['paypal']      = sanitize_key( $new_instance['paypal'] );
        $instance['stripe']      = sanitize_key( $new_instance['stripe'] );

        return $instance;
    }  

}