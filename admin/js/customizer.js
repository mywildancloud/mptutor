jQuery( document ).ready(function($) {
	"use strict";

	/**
	 * Add Class TinyMCE Editor.
	 * @link              https://brandmarketers.id
	 * @since             1.0.0
	 * @package           Mp_Tutor_Lms
	 */
	$('.customize-control-tinymce-editor').each(function(){
		// Get the toolbar strings that were passed from the PHP Class
		var tinyMCEToolbar1String = _wpCustomizeSettings.controls[$(this).attr('id')].tinymcetoolbar1;
		var tinyMCEToolbar2String = _wpCustomizeSettings.controls[$(this).attr('id')].tinymcetoolbar2;
		var tinyMCEMediaButtons   = _wpCustomizeSettings.controls[$(this).attr('id')].mediabuttons;

		wp.editor.initialize( $(this).attr('id'), {
			tinymce: {
				wpautop: true,
				toolbar1: tinyMCEToolbar1String,
				toolbar2: tinyMCEToolbar2String
			},
			quicktags: true,
			mediaButtons: tinyMCEMediaButtons
		});
	});
	$(document).on( 'tinymce-editor-init', function( event, editor ) {
		editor.on('change', function(e) {
			tinyMCE.triggerSave();
			$('#'+editor.id).trigger('change');
		});
	});

} )( jQuery, wp.customize );
