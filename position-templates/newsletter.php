<!-- Newsletter -->
<section class="section" <?php do_action( 'section_start_tag', $section, $color_scheme ); ?> id="section-newsletter" data-anchor="newsletter">
	<div class="section-inner">
		<div class="row">

			<div id="orcp-newsletter-subscribe-notices" class="alert-box" style="display: none;"></div>

			<form action="" metod="post" id="orcp-newsletter-subscribe">

				<input type="submit" class="orcp-newsletter-submit" value="<?php _e( 'Submit', 'orcp' ); ?>">

				<label id="orcp-newsletter-subscribe-box">
					<input type="email" name="email" id="orcp-newsletter-subscribe-email" placeholder="<?php _e( 'email address + enter', 'orcp' ); ?>">
				</label>

				<input type="submit" class="orcp-newsletter-submit" id="right-submit" value="<?php _e( 'Submit', 'orcp' ); ?>">

				<?php wp_nonce_field( 'newsletter_nonce', 'newsletter_nonce' ); ?>

			</form>

		</div>
	</div>
</section>