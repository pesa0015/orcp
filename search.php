<?php
/**
 * Displays Search Results
 **/

get_header(); ?>

	<?php get_search_form(); ?>

	<?php if ( have_posts() ) : ?>

		<h1 class="page-title search-page-title">
			<?php printf( __( 'Search Results for: %s', 'orcp' ), '<span>' . get_search_query() . '</span>' ); ?>
		</h1>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', get_post_format() ); ?>

		<?php endwhile; ?>

		<?php
	   	if(function_exists('wp_pagenavi')) :
	   		wp_pagenavi(); // Add support for the WP-Pagenavi plugin if it is installed. Otherwise use the default.
	   	else :
	   		orcp_pagination();
	   	endif;
		?>

	<?php else : ?>

		<h1 class="page-title search-page-title"><?php _e( 'No Reults Found', 'orcp' ); ?></h1>

		<p><?php _e( 'Unfortuantely we could not find any results for your search query. Please try again with another query.', 'orcp' ); ?></p>

	<?php endif; ?>

<?php get_footer(); ?>