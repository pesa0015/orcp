<?php
/**
 * WooCommerce Base Page
 **/

get_header(); ?>

<div class="main bg-white" data-colorscheme="dark">
	<div class="section-inner">
		<div class="row">
			<div class="small-24 columns">

				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

						<?php get_template_part( 'content', 'page' ); ?>

					<?php endwhile; ?>

				<?php else : ?>

					<?php get_template_part('content', '404'); ?>

				<?php endif; ?>

			</div>
		</div>
	</div>
</div>

<?php orcp_the_site_footer(); ?>

<?php get_footer(); ?>