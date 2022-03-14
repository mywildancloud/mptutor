<section id="testimonials">
	<?php
	
	// Title
	$testimonialsTitle    = esc_html( get_theme_mod('testimonials_title', 'Testimonials') );
	$testimonialsSubTitle = esc_html( get_theme_mod('testimonials_sub_title', 'Trusted By 2,500 Student') );

	// Image

	$testimonialsImg1 = get_theme_mod('testimonials_image1');
	$testimonialsImg1 = ( empty( $testimonialsImg1 ) ? plugins_url() . '/mp-tutor-lms/public/assets/images/image1.jpg' : $testimonialsImg1 ); 

	$testimonialsImg2 = get_theme_mod('testimonials_image2');
	$testimonialsImg2 = ( empty( $testimonialsImg2 ) ? plugins_url() . '/mp-tutor-lms/public/assets/images/image2.png' : $testimonialsImg2 ); 

	$testimonialsImg3 = get_theme_mod('testimonials_image3');
	$testimonialsImg3 = ( empty( $testimonialsImg3 ) ? plugins_url() . '/mp-tutor-lms/public/assets/images/image3.png' : $testimonialsImg3 ); 

	// Pesan
	$testimonialsPesan1 = esc_html( get_theme_mod('testimonials_pesan1', '"Awesome Template Tutor LMS page mas Wildan"') );
	$testimonialsPesan2 = esc_html( get_theme_mod('testimonials_pesan2', '"Modern UI Design sih ini,, clean banget mas"') );
	$testimonialsPesan3 = esc_html( get_theme_mod('testimonials_pesan3', '"Sumpah sih ini ringan banget cocok buat bikin web LMS"') );

	// Nama User
	$testimonialsNama1 = esc_html( get_theme_mod('testimonials_nama1', 'John Doe') );
	$testimonialsNama2 = esc_html( get_theme_mod('testimonials_nama2', 'Bram Jhonson') );
	$testimonialsNama3 = esc_html( get_theme_mod('testimonials_nama3', 'Louis Serf') );	
	
	// Latar Belakang
	$testimonialsLbelakang1 = esc_html( get_theme_mod('testimonials_lbelakang1', 'Sr. Director, Social Media Strategy And Audience Engagement') );
	$testimonialsLbelakang2 = esc_html( get_theme_mod('testimonials_lbelakang2', 'Sr. Director, Social Media Strategy And Audience Engagement') );
	$testimonialsLbelakang3 = esc_html( get_theme_mod('testimonials_lbelakang3', 'Sr. Director, Social Media Strategy And Audience Engagement') );

	// Company User
	$testimonialsCompany1 = esc_html( get_theme_mod('testimonials_company1', 'Fake Company Inc') );
	$testimonialsCompany2 = esc_html( get_theme_mod('testimonials_company2', 'Fake Company Inc') );
	$testimonialsCompany3 = esc_html( get_theme_mod('testimonials_company3', 'Fake Company Inc') );

 	?>
	<div class="row">
		<div class="columns">
			<div class="image-left"></div>
			<div class="image-right"></div>
			<span class="txt-top"><?php echo $testimonialsSubTitle; ?></span>
			<h2><?php echo $testimonialsTitle; ?></h2>
			<div class="fadeOut owl-carousel owl-theme">
				<div class="item item1">
					<div class="box-image box-image1">
						<img src="<?php echo $testimonialsImg1; ?>" alt="tertimonials pertama">
					</div>
					<div class="box-text">
						<h3><?php echo $testimonialsPesan1; ?></h3>
						<strong><?php echo $testimonialsNama1; ?></strong>
						<span><?php echo $testimonialsLbelakang1; ?></span>
						<p><?php echo $testimonialsCompany1; ?></p>
					</div>
				</div>
				<div class="item item2">
					<div class="box-image box-image2">						
						<img src="<?php echo $testimonialsImg2; ?>" alt="tertimonials kedua">
					</div>
					<div class="box-text">
						<h3><?php echo $testimonialsPesan2; ?></h3>
						<strong><?php echo $testimonialsNama2; ?></strong>
						<span><?php echo $testimonialsLbelakang2; ?></span>
						<p><?php echo $testimonialsCompany2; ?></p>
					</div>					
				</div>
				<div class="item item3">
					<div class="box-image box-image3">
						<img src="<?php echo $testimonialsImg3; ?>" alt="tertimonials ketiga">
					</div>
					<div class="box-text">
						<h3><?php echo $testimonialsPesan3; ?></h3>
						<strong><?php echo $testimonialsNama3; ?></strong>
						<span><?php echo $testimonialsLbelakang3; ?></span>
						<p><?php echo $testimonialsCompany3; ?></p>
					</div>	
				</div>
			</div>
		</div>
	</div>
</section>
<section class="subscribe-wrap">
	<div class="subscribe">
		<div class="txt">
			<?php 

			$newsletterTitle    = get_theme_mod('newsletter_title', 'Join Our Newsletter We Will Send Coupun Disc Up To 80%');			
			$newsletterSubTitle = get_theme_mod('newsletter_sub_title', 'Newsletter');

			$newsletter_embed_html = get_theme_mod('newsletter_embed_html', '');

			?>
			<span><?php echo $newsletterSubTitle; ?></span>
			<h2><?php echo $newsletterTitle; ?></h2>
		</div>

			<?php 
			if ( !empty($newsletter_embed_html) ) :
				echo '<div class="container-form">';
					echo $newsletter_embed_html; 
				echo '</div>';	
			endif;
			?>
	</div>
</section>
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