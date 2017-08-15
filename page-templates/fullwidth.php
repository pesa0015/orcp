<?php
/**
 * Page Template: Fullwidth Page
 *
 * Fullwidth page template to create pages that does not include the sidebar.
 *
 * @since Ilmenite Framework 1.0
 * @author XLD Studios
 * @version 1.0
 * @package Ilmenite Framework
 *
 * Template Name: Fullwidth Page
 *
 **/

get_header(); ?>

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<?php if (is_page(array('cart','checkout'))): ?>
		
			<?php the_content(); ?>

		<?php else : ?>

			<h1 class="page-title"><?php the_title(); ?></h1>
			<?php the_content(); ?>
		<?php endif; ?>

	<?php endwhile; ?>

	<?php else : ?>

		<?php get_template_part('content', '404'); ?>

	<?php endif; ?>

<?php get_footer(); ?>