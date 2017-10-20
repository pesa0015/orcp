<?php
if ( ! empty ( $color_scheme['link'] ) ) : ?>
<div id="section-intro" data-anchor="intro" class="section section-link">
    <div class="flexslider">
        <ul class="slides"></ul>
    </div>
</div>
<?php else : ?>
	<section class="section" <?php do_action( 'section_start_tag', $section, $color_scheme ); ?> id="section-intro" data-anchor="intro"></section>
<?php endif; ?>
