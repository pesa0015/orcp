<?php
/**
 * AJAX Function Calls
 *
 * The same processes several things over AJAX which are all
 * kept contained in this file.
 */

if ( ! function_exists( 'orcp_prefix_load_changeproject' ) ) :

	function orcp_prefix_load_changeproject () {}

	add_action( 'wp_ajax_nopriv_load-filter', 'orcp_prefix_load_changeproject' );
	add_action( 'wp_ajax_load-filter', 'orcp_prefix_load_changeproject' );

endif;

if ( ! function_exists( 'orcp_change_cart_qty' ) ) :

	function orcp_change_cart_qty () {

		global $woocommerce;

		// Get Product Cart ID
		$product_cart_id = filter_var( $_POST['cartItemKey'], FILTER_SANITIZE_STRING);

		// Get the Product ID
		$product_id = (int) wp_strip_all_tags( $_POST['productID'] );

		// Get current quantity
		$current_quantity = filter_var( $_POST['currentQuantity'], FILTER_SANITIZE_STRING );

		// Get action
		$action = wp_strip_all_tags( $_POST['cartAction'] );

		switch ( $action ) {
			case 'add':
				$new_quantity = intval( $current_quantity ) + 1;
				WC()->cart->set_quantity( $product_cart_id, $new_quantity );
				break;

			case 'remove':
				$new_quantity = $current_quantity - 1;
				WC()->cart->set_quantity( $product_cart_id, $new_quantity );
				break;

			default:
				break;
		}

		echo $new_quantity;
		die(1);

	}

	add_action( 'wp_ajax_nopriv_orcp_change_cart_qty', 'orcp_change_cart_qty' );
	add_action( 'wp_ajax_orcp_change_cart_qty', 'orcp_change_cart_qty' );

endif;

if ( ! function_exists( 'orcp_prefix_load_productgrid' ) ) :

	function orcp_prefix_load_productgrid () {

		ob_start ();

		$active_productgrid_project_no = $_POST[ 'productgrid' ];
		//$active_productgrid_project_obj = get_term( $active_product_projectgrid_id, 'orcp_projects' );
		$active_project_obj = get_term_by( 'slug', 'project-' . $active_productgrid_project_no, 'orcp_projects' );

		$products_query_args = array(
			'post_type' => 'product',
			'posts_per_page' => '-1',
			'tax_query' => array(
				array(
					'taxonomy' => 'orcp_projects',
					'field'    => 'slug',
					'terms'    => 'project-' . $active_productgrid_project_no,

				),
			),
		);

		$products_query = new WP_Query( $products_query_args );

		if ( $products_query->have_posts() ) : ?>
			<div class="row">
				<div class="section-heading small-24 columns">
					<?php /*<h2 class="section-title"><?php _e( 'Objects', 'orcp' ); ?></h2>*/ ?>
					<p class="section-subtitle"><?php the_field( 'project_objects_section_title', $active_project_obj ); ?></p>
					<p class="section-description"><?php printf( __( 'Project No.%s', 'orcp' ), $active_productgrid_project_no ); ?></p>

				</div>
			</div>

			<div class="row">
				<div class="section-content small-24 columns">

					<section class="products-listing">

						<?php while ( $products_query->have_posts() ) : $products_query->the_post(); ?>

							<?php
							$product_obj = $products_query->post;
							$product_id = get_the_ID();
							?>

							<div class="products-listing-item border-<?php the_field( 'product_thumb_border_type' ); ?>">

								<div class="products-listing-heading">

									<?php if ( has_post_thumbnail() ) : ?>
										<div class="products-listing-icon">
											<a href="#product-<?php echo get_the_ID(); ?>"><?php the_post_thumbnail( 'medium' ); ?></a>
										</div>
									<?php endif; ?>

									<h3 class="products-listing-name"><?php the_title(); ?></h3>

									<p class="products-listing-subtitle"><?php the_field( 'product_subtitle' ); ?></p>

								</div>

								<?php
									$variations_query_args = array(
										'post_type'   => 'product_variation',
										'post_parent' => $product_id,
									);

									$variations_query = new WP_Query( $variations_query_args );
								?>

								<?php if ( $variations_query->have_posts() ) : $vi = 0; ?>

									<div class="products-listing-variations">
										<ul class="listings-grid">

											<?php while ( $variations_query->have_posts() ) : $variations_query->the_post(); ?>

												<?php
												$variation_image_id = get_post_meta( get_the_ID(), '_thumbnail_id', true );

												$variation_image = wp_get_attachment_image_src( $variation_image_id, 'medium' );
												?>

												<li id="product-<?php the_ID(); ?>" class="listings-item">
													<a href="#" data-product="<?php echo $product_id; ?>" data-variation="<?php echo $vi; ?>" class="product-item-nav-trigger">
														<img src="<?php echo $variation_image[0]; ?>" alt="<?php the_title(); ?>" class="listings-image">
													</a>
												</li>

											<?php $vi++; endwhile; ?>

										</ul>
									</div>
								<?php endif; wp_reset_postdata(); ?>

							</div>

						<?php endwhile; ?>

					</section>

				</div>
			</div>

		<?php endif; wp_reset_postdata();

	   $productgrid = ob_get_contents();
	   ob_end_clean();

	   echo $productgrid;
	   die(1);
	}

	add_action( 'wp_ajax_nopriv_load-filter1', 'orcp_prefix_load_productgrid' );
	add_action( 'wp_ajax_load-filter1', 'orcp_prefix_load_productgrid' );

endif;

if ( ! function_exists( 'orcp_prefix_load_products' ) ) :

	function orcp_prefix_load_products () {

		$active_product_project_no = $_POST[ 'products' ];

		$product_query_args = array(
			'post_type' => 'product',
			'posts_per_page' => '-1',
			'tax_query' => array(
				array(
					'taxonomy' => 'orcp_projects',
					'field'    => 'slug',
					'terms'    => 'project-' . $active_product_project_no,
				),
			),
		);

		$product_query = new WP_Query( $product_query_args );

		ob_start ();

		if ( $product_query->have_posts() ) :

			while ( $product_query->have_posts() ) : $product_query->the_post(); ?>

				<section data-colorscheme="light" itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class( 'section product-item flexslider' ); ?>>

					<?php
						$product_id = $product_query->post->ID;

						$available_variations = $product->get_available_variations();

						$variations_query_args = array(
							'post_type' => 'product_variation',
							'post_parent' => $product_id,
						);

						$variations_query = new WP_Query( $variations_query_args );


					if ( $variations_query->have_posts() ) : ?>

						<div class="product-item-colors slides">

							<?php while ( $variations_query->have_posts() ) : $variations_query->the_post(); ?>

								<?php
								$variation_image_id = get_post_meta( $variations_query->post->ID, '_thumbnail_id', true );

								$variation_image = wp_get_attachment_image_src( $variation_image_id, 'large' );

								$variation_attributes = $product->get_variation_attributes();

								$color_slug = $variation_attributes['attribute_pa_color'];
								$color_obj = get_term_by( 'slug', $color_slug, 'pa_color' );
								$color_name = $color_obj->name;
								?>

								<li class="product-item-color">

									<div class="row">

										<div class="small-24 medium-12 large-17 columns product-item-images">
											<img src="<?php echo $variation_image[0]; ?>" alt="<?php the_title(); ?>">
										</div>

										<div class="small-24 medium-12 large-6 columns">

											<p class="product-item-project-title"><?php printf( __( 'Project No.%s', 'orcp' ), get_field( 'project_number', $active_project_obj ) ); ?></p>
											<p class="product-item-project-name"><?php the_field( 'project_objects_section_title', $active_project_obj ); ?></p>

											<?php if ( has_post_thumbnail() ) : ?>
												<div class="product-item-thumbnail">
													<?php echo get_the_post_thumbnail( $product_id, 'thumbnail' ); ?>
												</div>
											<?php endif; ?>

											<h3 class="product-item-title"><?php echo get_the_title( $product_id ); ?></h3>

											<p class="products-listing-subtitle"><?php the_field( 'product_subtitle', 'product-' . $product_id ); ?></p>

											<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>

											<form class="variations_form cart" method="post" enctype='multipart/form-data' data-product_id="<?php echo $post->ID; ?>" data-product_variations="<?php echo esc_attr( json_encode( $available_variations ) ) ?>">
												<?php if ( ! empty( $available_variations ) ) : ?>
												<ul class="product-item-actions">
													<li>
														<?php
														$sizes = get_terms( 'pa_size' );

														if ( $sizes ) : ?>

															<select id="pa_size" name="attribute_pa_size">

																<option value=""><?php echo __( 'Select Size', 'orcp' ) ?></option>

																<?php foreach ( $sizes as $size ) : ?>

																	<option value="<?php echo $size->slug; ?>"><?php echo $size->name; ?></option>
																<?php endforeach; ?>

															</select>

														<?php endif; ?>
													</li>

													<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

													<li>

														<?php do_action( 'woocommerce_before_single_variation' ); ?>

														<!--<?php woocommerce_quantity_input(); ?>-->
														<button type="submit" class="single_add_to_cart_button button alt product-item-actions-cart"><?php echo $product->single_add_to_cart_text(); ?></button>

														<input type="hidden" name="add-to-cart" value="<?php echo $product->id; ?>" />
														<input type="hidden" name="product_id" value="<?php echo esc_attr( $variations_query->post->ID ); ?>" />
														<input type="hidden" name="variation_id" value="" />

														<?php do_action( 'woocommerce_after_single_variation' ); ?>
													</li>
												</ul>

													<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>

												<?php else : ?>

													<p class="stock out-of-stock"><?php _e( 'This product is currently out of stock and unavailable.', 'woocommerce' ); ?></p>

												<?php endif; ?>

											</form>

											<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

											<p class="product-item-variation-title"><?php echo $color_name; ?></p>

											<?php woocommerce_template_single_price(); ?>

											<div class="product-item-facts">
												<h4>Facts</h4>
												<?php the_content(); ?>
											</div>

										</div>

									</div>


								</li>

							<?php endwhile; ?>

						</div>

					<?php endif;

					wp_reset_postdata(); ?>

				</section>

			<?php endwhile;

		endif; wp_reset_postdata();

	   $products = ob_get_contents();
	   ob_end_clean();

	   echo $products;
	   die(1);

	}

	add_action( 'wp_ajax_nopriv_load-filter2', 'orcp_prefix_load_products' );
	add_action( 'wp_ajax_load-filter2', 'orcp_prefix_load_products' );

endif;

if ( ! function_exists( 'orcp_prefix_load_paintings' ) ) :

	function orcp_prefix_load_paintings () {

		$active_paintings_project_no = $_POST[ 'paintings' ];

		//$active_paintings_project_obj = get_term( $active_paintings_project_id, 'orcp_projects' );
		$active_project_obj = get_term_by( 'slug', 'project-' . $active_paintings_project_no, 'orcp_projects' );

		$paintings_query_args = array(
			'post_type' => 'orcp_paintings',
			'posts_per_page' => '-1',
			'order' => 'ASC',
			'tax_query' => array(
				array(
					'taxonomy' => 'orcp_projects',
					'field'    => 'slug',
					'terms'    => 'project-' . $active_paintings_project_no,
				),
			),
		);

		$paintings_query = new WP_Query( $paintings_query_args );

		ob_start ();

		if ( $paintings_query->have_posts() ) : ?>

			<div class="row">
				<div class="section-heading small-24 columns">

					<h2 class="section-title"><?php _e( 'Paintings', 'orcp' ); ?></h2>
					<p class="section-subtitle"><?php the_field( 'project_paintings_section_title', $active_project_obj ); ?></p>
					<p class="section-description"><?php printf( __( 'Series No.%s', 'orcp' ), get_field( 'project_number', $active_project_obj ) ); ?></p>

				</div>
			</div>

			<div class="row">
				<div class="section-content small-24 columns">

					<ul id="paintings-listning" class="listings-grid">

						<?php while ( $paintings_query->have_posts() ) : $paintings_query->the_post(); ?>

							<?php $painting_image = get_field( 'painting_image' ); ?>

							<li id="painting-<?php the_ID(); ?>" class="listings-item">
								<a href="<?php echo $painting_image['url']; ?>" class="swipebox">
									<img src="<?php echo $painting_image['sizes']['medium']; ?>" alt="<?php the_title(); ?>" class="listings-image">
								</a>
							</li>

						<?php endwhile; ?>

					</ul>

				</div>
			</div>

		<?php endif; wp_reset_postdata();

		$paintingsgrid = ob_get_contents();
	   	ob_end_clean();

		echo $paintingsgrid;
		die(1);
	}

	add_action( 'wp_ajax_nopriv_load-filter3', 'orcp_prefix_load_paintings' );
	add_action( 'wp_ajax_load-filter3', 'orcp_prefix_load_paintings' );

endif;

if ( ! function_exists( 'orcp_prefix_load_books' ) ) :

	function orcp_prefix_load_books () {

		$active_books_project_no = $_POST[ 'books' ];
		//$active_books_project_obj = get_term( $active_books_project_id, 'orcp_projects' );
		//$projno = get_field( 'project_number', $active_books_project_obj);
		$active_project_obj = get_term_by( 'slug', 'project-' . $active_books_project_no, 'orcp_projects' );

		$books_query_args = array(
			'post_type' => 'orcp_books',
			'posts_per_page' => '-1',
			'order' => 'ASC',
			'tax_query' => array(
				array(
					'taxonomy' => 'orcp_projects',
					'field'    => 'slug',
					'terms'    => 'project-' . $active_books_project_no,
				),
			),
		);

		$books_query = new WP_Query( $books_query_args );

		ob_start ();

		if ( $books_query->have_posts() ) : ?>

			<div class="row">
				<div class="section-heading small-24 columns">

					<h2 class="section-title"><?php _e( 'Books', 'orcp' ); ?></h2>
					<p class="section-subtitle"><?php the_field( 'project_books_section_title', $active_project_obj ); ?></p>
					<p class="section-description"><?php printf( __( 'Batch No.%s', 'orcp' ), get_field( 'project_number', $active_project_obj ) ); ?></p>

				</div>
			</div>

			<div class="row">
				<div class="section-content small-24 columns">

					<ul id="books-listning" class="listings-grid">

						<?php while ( $books_query->have_posts() ) : $books_query->the_post(); ?>

							<?php $book_image = get_field( 'book_image' ); ?>

							<li id="book-<?php the_ID(); ?>" class="listings-item">
								<a href="<?php echo $book_image['url']; ?>" class="swipebox">
									<img src="<?php echo $book_image['sizes']['medium']; ?>" alt="<?php the_title(); ?>" class="listings-image">
								</a>
							</li>

						<?php endwhile; ?>

					</ul>

				</div>
			</div>
		<?php endif;

		wp_reset_postdata();

	   $booksgrid = ob_get_contents();
	   ob_end_clean();

	   echo $booksgrid;
	   die(1);
	}

	add_action( 'wp_ajax_nopriv_load-filter4', 'orcp_prefix_load_books' );
	add_action( 'wp_ajax_load-filter4', 'orcp_prefix_load_books' );

endif;

if ( ! function_exists( 'orcp_prefix_load_grid' ) ) :

	function orcp_prefix_load_grid () {

		$active_grid_project_no = wp_kses( $_POST[ 'project' ], '' );
		//$active_books_project_obj = get_term( $active_books_project_id, 'orcp_projects' );
		//$projno = get_field( 'project_number', $active_books_project_obj);
		$active_project_obj = get_term_by( 'slug', 'project-' . $active_grid_project_no, 'orcp_projects' );

		$color_scheme_id = wp_kses( $_POST['colorScheme'], '' );

		// Get video URL
		$video_url = get_field( 'project_video', $active_project_obj );

		// Get Floating Illusions
		$image_gallery = get_field( 'project_floating_illusions', $active_project_obj );

		ob_start (); ?>

			<div class="fullwidth-row row collapse">

				<div class="small-12 columns">
					<a href="<?php echo $image_gallery[0]['url']; ?>" id="intro-image-nr-2" class="swipebox">
						<section class="grid-section-item" style="background: <?php the_field( 'color_scheme_floating_illusions_bg', $color_scheme_id ); ?>; color: <?php the_field( 'color_scheme_floating_illusions_text', $color_scheme_id ); ?>;">
							<div class="grid-inner">
								<?php /*<h2 class="uppercase section-title"><?php _e( 'Floating Illusions', 'orcp' ); ?></h2><br>*/ ?>
								<p class="section-description">
                                    <span id="framework-no-1"><?php printf( __( 'FRAMEWORK NO.1', 'orcp' ), $active_grid_project_no ); ?></span>
                                </p>
							</div>
						</section>
					</a>
				</div>
				<div class="small-12 columns">
					<a href="#" class="facebook-box">
						<section class="grid-section-item" style="background: <?php the_field( 'color_scheme_facebook_bg', $color_scheme_id ); ?>;"></section>
					</a>
					<?php if ( $image_gallery ) : unset($image_gallery[0]); ?>
						<div class="project-floating-illusions">
							<ul>
								<?php foreach ( $image_gallery as $image ) : ?>
									<li><a href="<?php echo $image['url']; ?>" rel="floating-illusions" class="swipebox"><img src="<?php echo $image['sizes']['thumbnail']; ?>" alt=""></a></li>
								<?php endforeach; ?>
							</ul>
						</div>
					<?php endif; ?>
				</div>

			</div>

			<div class="fullwidth-row row collapse">

				<div class="small-12 columns">
					<a href="#" class="instagram-box">
						<section class="grid-section-item" style="background: <?php the_field( 'color_scheme_instagram_bg', $color_scheme_id ); ?>;"></section>
					</a>
				</div>
				<div class="small-12 columns">
					<a href="<?php echo $video_url; ?>" class="swipebox">
						<section class="grid-section-item"  style="background: <?php the_field( 'color_scheme_outlook_decoding_bg', $color_scheme_id ); ?>; color: <?php the_field( 'color_scheme_outlook_decoding_text', $color_scheme_id ); ?>;">
							<div class="grid-inner">
								<?php /*<h2 class="uppercase section-title"><?php _e( 'Outlook Decoding', 'orcp' ); ?></h2><br>*/ ?>
								<p class="section-description">
                                    <span id="blueprint"><?php printf( __( 'BLUEPRINT NO.1', 'orcp' ), $active_grid_project_no ); ?></span>
                                </p>
							</div>
						</section>
					</a>
				</div>

			</div>

		<?php

	   $grid_section = ob_get_contents();
	   ob_end_clean();

	   echo $grid_section;
	   die(1);
	}

	add_action( 'wp_ajax_nopriv_load-grid_section', 'orcp_prefix_load_grid' );
	add_action( 'wp_ajax_load-grid_section', 'orcp_prefix_load_grid' );

endif;

if ( ! function_exists( 'orcp_process_subcription_form' ) ) :

	/**
	 * AJAX: Process the Newsletter Subscription Form
	 */
	function orcp_process_subcription_form () {

		if ( wp_verify_nonce( $_POST['nonce'], 'newsletter_nonce' ) ) {

			$newsletter = new ORCP_Newsletter;

			if ( is_email( $_POST['email'] ) ) {
				$email = $_POST['email'];
			} else {
				$email = false;
			}

			if ( $email ) {

				// Call the API
				$subscribed = $newsletter->subscribe_email( $email );

				if ( $subscribed ) {
					$output = array(
						'status' => 'success',
						'message' => __( 'The email address was successfully added.', 'orcp' ),
					);
				} else {
					$output = array(
						'status' => 'error',
						'message' => __( 'The email address was not added to the newsletter.', 'orcp' ),
					);
				}

			} else {
				$output = array(
					'status' => 'error',
					'message' => __( 'Please enter an email address.', 'orcp' ),
				);
			}

		} else {
			$output = array(
				'status' => 'error',
				'message' => __( 'The security verification (nonce) failed to be verified.', 'orcp' ),
			);
		}

		$output = json_encode($output);
		echo $output;
		die(1);

	}

	add_action( 'wp_ajax_nopriv_orcp_process_subcription_form', 'orcp_process_subcription_form' );
	add_action( 'wp_ajax_orcp_process_subcription_form', 'orcp_process_subcription_form' );

endif;