<?php
/**
 * Grid Part
 */
?>
<section class="section grid-section" <?php do_action( 'section_start_tag', $section, $color_scheme ); ?> id="grid-section" data-anchor="grid" data-colorschemeid="<?php echo $color_schemes_query->post->ID; ?>">
	<div class="grid-section-inner">
		<div id="grid-output"></div>
	</div>
</section>