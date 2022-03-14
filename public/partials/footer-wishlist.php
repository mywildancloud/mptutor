<footer id="footer" itemscope itemtype="http://schema.org/WPFooter">
	<div class="container-footer">
		<div class="box-footer-widgets">
			<div class="box-widget">
				<?php if ( is_active_sidebar( 'mp_tutor_lms_footer1' )  ) : ?>
					<div class="footer-widgets">
						<?php dynamic_sidebar( 'mp_tutor_lms_footer1' ); ?>
					</div>
				<?php endif; ?>
            </div>
			<div class="box-widget">
				<?php if ( is_active_sidebar( 'mp_tutor_lms_footer2' )  ) : ?>
					<div class="footer-widgets">
						<?php dynamic_sidebar( 'mp_tutor_lms_footer2' ); ?>
					</div>
				<?php endif; ?>
            </div>
			<div class="box-widget">
				<?php if ( is_active_sidebar( 'mp_tutor_lms_footer3' )  ) : ?>
					<div class="footer-widgets">
						<?php dynamic_sidebar( 'mp_tutor_lms_footer3' ); ?>
					</div>
				<?php endif; ?>
            </div>
        </div>
        <div class="copyright">
            <span><?php echo get_theme_mod('footer_txt_bottom', 'Copyright 2021 - Themes Mp Tutor Lms'); ?></span>
        </div>
	</div>
</footer>
<?php wp_footer(); ?>

</body>
</html>