<section class="section bg-white border-<?php the_sub_field( 'color_scheme_border_type' ); ?>" id="section-objects" <?php do_action( 'section_start_tag', $section, $color_scheme ); ?> data-anchor="objects">
	<?php orcp_the_project_nav( $active_project_no, $max_project_no ); ?>
	<div class="section-inner">
		<div id="products-section-inner"></div>
	</div>
</section>