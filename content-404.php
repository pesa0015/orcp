<?php
/**
 * 'Not Found Content'
 *
 * Included on the 404 page as well as when post content is not found.
 **/
?>

<section id="error-404-page">

	<h1 class="page-title"><?php _e( 'Content Cannot Be Found', 'orcp' ); ?></h1>

    <div class="page-content">

    	<p><?php _e( 'Unfortunately the content you were looking for could not be found. Please check that the URL is correct or do a search using the form below.', 'orcp' ); ?></p>
    	<?php get_search_form(); ?>

    </div>

</section>