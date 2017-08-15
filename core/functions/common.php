<?php

if ( ! function_exists( 'orcp_get_project_objs' ) ) :

	function orcp_get_project_objs() {

		global $post;

		// What taxonomy should we use?
		$taxonomy = 'orcp_projects';

		// Get the taxonomy terms
		$terms = get_terms( $taxonomy );

		// Get the maximum number of projects
		$max_project_no = intval( wp_count_terms( $taxonomy, $terms ) );

		// Get the default project object from the settings
		$default_project_obj = get_field( 'orcp_currently_active_project', 'option' );

		// Check if we have a project set in the URL
		if ( isset( $_GET['project'] ) ) {
			$active_project_id = intval( wp_strip_all_tags( $_GET['project'] ) );
			$active_project_obj = get_term( $active_project_id, 'orcp_projects' );
		} else {
			$active_project_obj = $default_project_obj;
		}

		$active_project_no = get_field( 'project_number', $active_project_obj );

		// Return an array with the outputs
		return array(
			'max_project_no'    => $max_project_no,
			'active_project_no' => $active_project_no,
		);

	}

endif;

if ( ! function_exists( 'orcp_mime_types' ) ) :

	/**
	 * Add Support for SVG in media uploader
	 */
	function orcp_mime_types($mimes) {
	  $mimes['svg'] = 'image/svg+xml';
	  return $mimes;
	}

	add_filter('upload_mimes', 'orcp_mime_types');

endif;

function orcp_get_product_colors( $product_id = false ) {

	if ( ! $product_id ) {
		global $product;

		$product_id = $product->ID;
	}

	$product = wc_get_product( $product_id );

	$product_colors = array();

	$variations = get_posts( array(
		'post_type' 	=> 'product_variation',
		'post_parent'	=> $product_id,
	));

	if ( $variations ) {
		foreach ( $variations as $variation ) {

			$variation = wc_get_product( $variation->ID );

			$variation_attributes = $variation->get_variation_attributes();

			$color_slug = $variation_attributes['attribute_pa_color'];
			$color_obj = get_term_by( 'slug', $color_slug, 'pa_color' );

			$color_name = $color_obj->name;

			$product_colors[] = array(
				'name' => $color_name,
				'obj' => $color_obj,
			);

		}
	}

	return $product_colors;

}

function orcp_get_product_project( $product_id ) {

	$terms = get_the_terms( $product_id, 'orcp_projects' );

	$terms_output = array();

	if ( $terms ) {
		foreach ( $terms as $term ) {
			$terms_output[] = $term;
		}
	}

	return $terms_output[0];

}

/**
 * Check User Agent
 * @return bool
 */
function orcp_is_mobile() {
	return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}