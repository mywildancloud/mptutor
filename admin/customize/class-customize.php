<?php
/**
 * Add Class TinyMCE Editor.
 * @link              https://brandmarketers.id
 * @since             1.0.0
 * @package           Mp_Tutor_Lms
 */

include_once ABSPATH . 'wp-includes/class-wp-customize-control.php';

if ( class_exists( 'WP_Customize_Control' ) ) {

	class MP_Tutor_Lms_TinyMCE extends WP_Customize_Control {
		/**
		 * The type of control being rendered
		 */
		public $type = 'tinymce_editor';
		/**
		 * Enqueue our scripts and styles
		 */
		public function enqueue(){
			wp_enqueue_script( 'mp-js-cstomizer-tinymce', plugins_url() . '/mp-tutor-lms/admin/js/customizer.js', array( 'jquery' ), '1.0', true );
			wp_enqueue_editor();
		}
		/**
		 * Pass our TinyMCE toolbar string to JavaScript
		 */
		public function to_json() {
			parent::to_json();
			$this->json['tinymcetoolbar1'] = isset( $this->input_attrs['toolbar1'] ) ? esc_attr( $this->input_attrs['toolbar1'] ) : 'bold italic bullist numlist alignleft aligncenter alignright link';
			$this->json['tinymcetoolbar2'] = isset( $this->input_attrs['toolbar2'] ) ? esc_attr( $this->input_attrs['toolbar2'] ) : '';
			$this->json['mediabuttons'] = isset( $this->input_attrs['mediaButtons'] ) && ( $this->input_attrs['mediaButtons'] === true ) ? true : false;
		}
		/**
		 * Render the control in the customizer
		 */
		public function render_content(){
		?>
			<div class="tinymce-control">
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php if( !empty( $this->description ) ) { ?>
					<span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php } ?>
				<textarea id="<?php echo esc_attr( $this->id ); ?>" class="customize-control-tinymce-editor" <?php $this->link(); ?>><?php echo esc_html( $this->value() ); ?></textarea>
			</div>
		<?php
		}
	}

} // End Check class_exists