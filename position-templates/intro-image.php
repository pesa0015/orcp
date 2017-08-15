<?php
if ( ! empty ( $color_scheme['link'] ) ) : ?>
	<a href="http://www.o-r-c-p.com/wp-content/uploads/2015/09/1.jpg" class="section section-link swipebox" <?php do_action( 'section_start_tag', $section, $color_scheme ); ?> id="section-intro" data-anchor="intro"></a>
<?php else : ?>
	<section class="section" <?php do_action( 'section_start_tag', $section, $color_scheme ); ?> id="section-intro" data-anchor="intro"></section>
<?php endif; ?>
<?php // <?php echo $color_scheme['link']; ?>