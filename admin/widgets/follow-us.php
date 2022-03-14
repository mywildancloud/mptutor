<?php

// Adds widget Follow Us
class Mp_Tutor_Lms_Follow_Us extends WP_Widget {

    public function __construct() {
        $box = array( 
            'classname'                   => 'mp-tutor-lms-widget-follow-us',
            'description'                 => esc_html__( 'This is a widget for displaying Follow Us.', 'mp-tutor-lms' ),
            'customize_selective_refresh' => true, 
        );

        parent::__construct( 'mp_tutor_lms_follow_us', esc_html__( 'MP Tutor LMS Follow Us', 'mp-tutor-lms' ), $box );    
        
    } 

    // Front-end 
	public function widget( $args, $instance ) {
        $fb  = ! empty( $instance['fb'] ) ? esc_url( $instance['fb'] ) : '';
        $tw  = ! empty( $instance['tw'] ) ? esc_url( $instance['tw'] ) : '';
        $ig  = ! empty( $instance['ig'] ) ? esc_url( $instance['ig'] ) : '';
        $yt  = ! empty( $instance['yt'] ) ? esc_url( $instance['yt'] ) : '';

		echo $args['before_widget'];

		if ( ! empty( $instance['title'] ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
        } else {
            echo '<h4 class="widget-title-footer">Follow Us</h4>';
        }
?>

        <div class="container-icon-payment-widget">
            <?php if ( $fb ) : ?>
            <a target="_blank" href="<?php echo esc_url($fb); ?>"><i class="fab fa-facebook-square"></i></a>
            <?php endif; ?>
            
            <?php if ( $tw ) : ?>
                <a target="_blank" href="<?php echo esc_url($tw); ?>"><i class="fab fa-twitter-square"></i></a>
            <?php endif; ?>
            
            <?php if ( $ig ) : ?>
                <a target="_blank" href="<?php echo esc_url($ig); ?>"><i class="fab fa-instagram"></i></a>
            <?php endif; ?>

            <?php if ( $yt  ) : ?>
                <a target="_blank" href="<?php echo esc_url($yt); ?>"><i class="fab fa-youtube"></i></a>
            <?php endif; ?>
        </div>
<?php

		echo $args['after_widget'];
	}        
    
    // Form Widget
    function form( $instance ) {
        $title = isset( $instance['title'] ) ? sanitize_text_field( $instance['title'] ) : '';
        $fb    = isset( $instance['fb'] ) ? esc_url( $instance['fb'] ) : '';
        $tw    = isset( $instance['tw'] ) ? esc_url( $instance['tw'] ) : '';
        $ig    = isset( $instance['ig'] ) ? esc_url( $instance['ig'] ) : '';
        $yt    = isset( $instance['yt'] ) ? esc_url( $instance['yt'] ) : '';
?>
        <!-- Title -->
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
                <?php esc_html_e( 'Title:', 'mp-tutor-lms' ); ?>
            </label>
            <input class="widefat" value="<?php echo esc_attr( $title ); ?>" type="text" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" placeholder="Follow Us" />
        </p> 
                
		<!-- Facebook -->
		<p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'fb' ) ); ?>">
                <?php esc_html_e( 'Link Facebook:', 'mp-tutor-lms' ); ?>
            </label>
            <input class="widefat" value="<?php echo esc_attr( $fb ); ?>" type="text" id="<?php echo esc_attr( $this->get_field_id( 'fb' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'fb' ) ); ?>" placeholder="<?php esc_attr_e( 'https://facebook.com/', 'mp-tutor-lms' ); ?>" />
		</p>

		<!-- Twitter -->
		<p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'tw' ) ); ?>">
                <?php esc_html_e( 'Link Twitter:', 'mp-tutor-lms' ); ?>
            </label>
            <input class="widefat" value="<?php echo esc_attr( $tw ); ?>" type="text" id="<?php echo esc_attr( $this->get_field_id( 'tw' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'tw' ) ); ?>" placeholder="<?php esc_attr_e( 'https://twitter.com/', 'mp-tutor-lms' ); ?>" />
		</p>

        <!-- Instagram -->
		<p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'ig' ) ); ?>">
                <?php esc_html_e( 'Link Instagram:', 'mp-tutor-lms' ); ?>
            </label>
            <input class="widefat" value="<?php echo esc_attr( $ig ); ?>" type="text" id="<?php echo esc_attr( $this->get_field_id( 'ig' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'ig' ) ); ?>" placeholder="<?php esc_attr_e( 'https://instagram.com/', 'mp-tutor-lms' ); ?>" />
		</p>

		<!-- Youtube -->
		<p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'yt' ) ); ?>">
                <?php esc_html_e( 'Link Youtube:', 'mp-tutor-lms' ); ?>
            </label>
            <input class="widefat" value="<?php echo esc_attr( $yt ); ?>" type="text" id="<?php echo esc_attr( $this->get_field_id( 'yt' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'yt' ) ); ?>" placeholder="<?php esc_attr_e( 'https://youtube.com/', 'mp-tutor-lms' ); ?>" />
		</p>

    <?php
    }

    // Update Widget
    public function update( $new_instance, $old_instance ) {

        $instance = $old_instance;

        $instance['title']       = sanitize_text_field( $new_instance['title'] );

		$instance['fb'] = esc_url_raw( $new_instance['fb'] );
		$instance['tw'] = esc_url_raw( $new_instance['tw'] );
		$instance['ig'] = esc_url_raw( $new_instance['ig'] );
		$instance['yt'] = esc_url_raw( $new_instance['yt'] );

        return $instance;
    }  

}