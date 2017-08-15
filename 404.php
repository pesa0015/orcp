<?php
/**
 * Template for the 404 page
 **/

get_header(); ?>
	<section class="section" id="notfound" data-colorscheme="light">
		<div class="row">
			<div class="small-24 columns">
				<?php get_template_part( 'content', '404' ); ?>
			</div>
		</div>
	</section>
<?php get_footer(); ?>