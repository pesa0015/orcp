<?php if ( ! empty ( $color_scheme['link'] ) ) : ?>
	<a href="<?php echo $color_scheme['link']; ?>" class="section section-link" <?php do_action( 'section_start_tag', $section, $color_scheme ); ?>>
<?php else : ?>
	<section class="section" <?php do_action( 'section_start_tag', $section, $color_scheme ); ?>>
<?php endif; ?>

		<div class="section-inner">

			<div class="row">
				<div class="small-24 columns">
					<?php echo $section->post_content; ?>
				</div>
			</div>

		</div>

<?php if ( ! empty ( get_field( 'section_link', $section ) ) ) : ?>
	</a>
<?php else : ?>
	</section>
<?php endif; ?>