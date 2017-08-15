<section class="section border-<?php the_sub_field( 'color_scheme_border_type' ); ?>" <?php do_action( 'section_start_tag', $section, $color_scheme ); ?> id="section-colors" data-anchor="colors">

	<?php orcp_the_project_nav( $active_project_no, $max_project_no ); ?>

	<div class="section-inner">
		<div id="paintingsoutput"></div>
	</div>
</section>