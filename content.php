<?php
/**
 * Content Template for General Posts
 **/
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

	<ul class="post-meta">
		<li>Posted by <?php the_author(); ?> on <?php the_time('F j, Y'); ?></li>
		<li><?php the_category(' / '); ?></li>
		<li>
		<?php
			comments_popup_link( __('No Comments', 'orcp'), __('1 Comment', 'orcp'), __('% Comments', 'orcp'), 'comments-link', __('Comments Closed', 'orcp') );
		?>
		</li>
	</ul>

	<div class="post-body">
		<?php the_content( __('Continue Reading &raquo;', 'orcp') ); ?>
	</div>

</article>