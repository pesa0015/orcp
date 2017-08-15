<!-- Projects, Words, Colors -->
<section class="section" <?php do_action( 'section_start_tag', $section, $color_scheme ); ?> id="section-menu" data-anchor="menu">
	<div class="section-inner">

		<div class="nav-section-item small-24 medium-24 large-8 columns">
			<a href="#objects">
				<p class="nav-section-item-image"><img src="<?php echo THEME_IMAGES_URI; ?>/flex/circle.svg" alt="<?php _e( 'Projects', 'orcp' ); ?>" class="iconic" style="fill: <?php echo $color_scheme['text_color']; ?>;"></p>
				<p class="nav-section-item-title"><?php _e( 'Circle', 'orcp' ); ?></p>
			</a>
		</div>

		<div class="nav-section-item small-24 medium-24 large-8 columns">
			<a href="#grid">
				<p class="nav-section-item-image"><img src="<?php echo THEME_IMAGES_URI; ?>/flex/square.svg" alt="<?php _e( 'Words', 'orcp' ); ?>" class="iconic" style="fill: <?php echo $color_scheme['text_color']; ?>;"></p>
				<p class="nav-section-item-title"><?php _e( 'Square', 'orcp' ); ?></p>
			</a>
		</div>

		<div class="nav-section-item small-24 medium-24 large-8 columns">
			<a href="#project-image">
				<p class="nav-section-item-image triangle"><img src="<?php echo THEME_IMAGES_URI; ?>/flex/triangle.svg" alt="<?php _e( 'Colors', 'orcp' ); ?>" class="iconic" style="fill: <?php echo $color_scheme['text_color']; ?>;"></p>
				<p class="nav-section-item-title"><?php _e( 'Triangle', 'orcp' ); ?></p>
			</a>
		</div>

	</div>
</section>