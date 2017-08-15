<?php
/**
 * Page Template: Frontpage
 *
 * Adds a custom page template to display the frontpage.
 *
 * Template Name: Frontpage
 *
 **/

// Translatable page template name
__( 'Frontpage', 'orcp' );

/**
 * Load Options
 */
$default_project_obj = get_field( 'orcp_currently_active_project', 'option' );

// Set project number
if ( isset( $_GET['project'] ) ) {
	$active_project_id = intval( wp_strip_all_tags( $_GET['project'] ) );
	$active_project_obj = get_term( $active_project_id, 'orcp_projects' );
} else {
	$active_project_obj = $default_project_obj;
}

$project_image = get_field( 'project_image', $active_project_obj );
$project_image_mobile = get_field( 'project_image_mobile', $active_project_obj );
$active_project_no = get_field( 'project_number', $active_project_obj );

$taxonomy = 'orcp_projects';
$tax_terms = get_terms($taxonomy);

$max_project_no = intval(wp_count_terms( $taxonomy, $tax_terms ));

/**
 * Load the Site Header
 */
get_header();

	/**
	 * Get Color Schemes
	 */
	$color_schemes_query_args = array(
		'post_type'      => 'orcp_color_scheme',
		'posts_per_page' => 1,
		'orderby'        => 'rand',
		'tax_query'      => array(
			array(
				'taxonomy' => 'orcp_projects',
				'field'    => 'slug',
				'terms'    => 'project-' . $active_project_no,
			),
		),
	);

	$color_schemes_query = new WP_Query( $color_schemes_query_args );

	if ( $color_schemes_query->have_posts() ) :

		while ( $color_schemes_query->have_posts() ) : $color_schemes_query->the_post();

			if ( get_field( 'color_scheme_structure', $color_schemes_query->post ) ) :

				while ( the_repeater_field( 'color_scheme_structure', $color_schemes_query->post ) ) :

					$spacer   = get_sub_field( 'color_scheme_spacer', $color_schemes_query->post );

					$color_scheme = array(
						'bgcolor'            => get_sub_field( 'color_scheme_bgcolor', $color_schemes_query->post ),
						'text_color'         => get_sub_field( 'color_scheme_text_color', $color_schemes_query->post ),
						'header_style'       => get_sub_field( 'color_scheme_header_style', $color_schemes_query->post ),
						'header_links_color' => get_sub_field( 'color_scheme_header_links_color', $color_schemes_query->post ),
						'header_menu_sprite' => get_sub_field( 'color_scheme_header_menu_sprite', $color_schemes_query->post ),
						'logo_color'         => get_sub_field( 'color_scheme_logo_color', $color_schemes_query->post ),
						'link'				 => get_sub_field( 'color_scheme_section_link', $color_schemes_query->post ),
						'bg_images'			 => get_sub_field( 'color_scheme_background_images', $color_schemes_query->post ),
					);

					if ( $spacer ) {

						$section = get_sub_field( 'color_scheme_section', $color_schemes_query->post );

						include( THEME_DIR . '/position-templates/blank-section.php' );

					} else {

						$position = get_sub_field( 'color_scheme_position', $color_schemes_query->post );
						$section  = false;

						include( THEME_DIR . '/position-templates/' . $position->slug . '.php' );

					}

				endwhile;

			endif;

		endwhile;

	endif; wp_reset_postdata();

get_footer();
?>