<?php
/**
 * Page Template: Frontpage (Old)
 *
 * Adds a custom page template to display the frontpage.
 *
 * Template Name: Frontpage (Old)
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
$active_project_no = get_field( 'project_number', $active_project_obj );

$taxonomy = 'orcp_projects';
$tax_terms = get_terms($taxonomy);

$max_project_no = intval(wp_count_terms( $taxonomy, $tax_terms ));

// Now get on with it...
get_header(); ?>

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

		<!-- Introduction Preloader -->
		<section class="section" id="introduction">
			<span class="alignmenthelper"></span><img src="<?php echo THEME_IMAGES_URI; ?>/loading-icons.png" alt="Loading..." class="transform">
		</section>

		<!-- Welcome -->
		<section class="section" id="welcome" data-colorscheme="none">
			<div class="row">
				<div class="small-24 columns">
					<p class="big-logo"><img src="<?php echo THEME_IMAGES_URI; ?>/logo-big.png" alt="<?php _e( 'O.R.C.P', 'orcp' ); ?>"></p>
					<p class="welcome-text"><?php _e( 'Welcome', 'orcp' ); ?></p>
				</div>
			</div>
		</section>

		<!-- Circles -->
		<section class="section" id="circles" data-colorscheme="none"></section>

		<!-- Projects, Words, Colors -->
		<section class="section" id="nav-section" data-colorscheme="dark">
			<div class="row">

				<div class="nav-section-item small-24 medium-12 large-8 columns">
					<a href="#projects">
						<p class="nav-section-item-image"><img src="<?php echo THEME_IMAGES_URI; ?>/nav-projects.png" alt="<?php _e( 'Projects', 'orcp' ); ?>"></p>
						<p class="nav-section-item-title"><?php _e( 'Projects', 'orcp' ); ?></p>
					</a>
				</div>

				<div class="nav-section-item small-24 medium-12 large-8 columns">
					<a href="#books">
						<p class="nav-section-item-image"><img src="<?php echo THEME_IMAGES_URI; ?>/nav-words.png" alt="<?php _e( 'Words', 'orcp' ); ?>"></p>
						<p class="nav-section-item-title"><?php _e( 'Words', 'orcp' ); ?></p>
					</a>
				</div>

				<div class="nav-section-item small-24 medium-12 large-8 columns">
					<a href="#paintings">
						<p class="nav-section-item-image"><img src="<?php echo THEME_IMAGES_URI; ?>/nav-colors.png" alt="<?php _e( 'Colors', 'orcp' ); ?>"></p>
						<p class="nav-section-item-title"><?php _e( 'Colors', 'orcp' ); ?></p>
					</a>
				</div>

			</div>
		</section>

		<!-- Information -->
		<section class="section" id="information" data-colorscheme="dark">
			<div class="row">
				<div class="small-24 columns">
					<?php the_field( 'section5' ); ?>
				</div>
			</div>
		</section>

		<!-- Vertical shapes -->
		<section class="section" id="vertical-shapes" data-colorscheme="dark"></section>

		<!-- Books -->
		<section id="books-section" class="section" data-colorscheme="light">
			<div class="projectnav-wrapper">
				<div class="projectnav-previous" onclick="projPrevious(activeProjNo, maxProjNo);"><span></span></div>
				<div class="projectnav-next" onclick="projNext(activeProjNo, maxProjNo);"><span></span></div>
			</div>
			<div id="booksoutput"></div>
		</section>

		<!-- Facebook coupon -->
		<section class="section" id="facebook-coupon" data-colorscheme="dark">
			<div class="row">
				<div class="small-24 columns">
					<div class="facebook-coupon-inner">
						<?php the_field('section8'); ?>
					</div>
				</div>
			</div>
		</section>

		<!-- Products/Shoes Grid -->
		<section class="section bg-white" id="products-section"  data-colorscheme="light">
			<div class="projectnav-wrapper">
				<div class="projectnav-previous" onclick="projPrevious(activeProjNo, maxProjNo);"><span></span></div>
				<div class="projectnav-next" onclick="projNext(activeProjNo, maxProjNo);"><span></span></div>
			</div>
			<div id="products-section-inner"></div>
		</section>


		<section id="products">

		</section>

		<!-- Three squares -->
		<section class="section" id="three-squares" data-colorscheme="dark">
			<div class="row">
				<div class="small-24 columns">
					<?php the_field( 'section10' ); ?>
				</div>
			</div>
		</section>

		<!-- Product -->
		<div id="products-output"></div>

		<div style="height: 300px; background-color: pink;"></div>
		<?php
		$product_query_args = array(
			'post_type' => 'product',
			'posts_per_page' => '-1',
			'tax_query' => array(
				array(
					'taxonomy' => 'orcp_projects',
					'field'    => 'slug',
					'terms'    => 'project-' . $active_project_no,
				),
			),
		);

		$product_query = new WP_Query( $product_query_args );

		if ( $product_query->have_posts() ) :

			while ( $product_query->have_posts() ) : $product_query->the_post(); ?>

				<section data-colorscheme="light" itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class( 'section product-item flexslider' ); ?>>

					<?php
						$product_id = $post->ID;

						$available_variations = $product->get_available_variations();

						$variations_query_args = array(
							'post_type' => 'product_variation',
							'post_parent' => $product_id,
						);

						$variations_query = new WP_Query( $variations_query_args );
					?>

					<?php if ( $variations_query->have_posts() ) : ?>

						<div class="product-item-colors slides">

							<?php while ( $variations_query->have_posts() ) : $variations_query->the_post(); ?>

								<?php
								$variation_image_id = get_post_meta( $post->ID, '_thumbnail_id', true );

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
											<p class="product-item-project-name">Silence</p>

											<?php if ( has_post_thumbnail() ) : ?>
												<div class="product-item-thumbnail">
													<?php echo get_the_post_thumbnail( $product_id, 'thumbnail' ); ?>
												</div>
											<?php endif; ?>

											<h3 class="product-item-title"><?php echo get_the_title( $product_id ); ?></h3>

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
														<input type="hidden" name="product_id" value="<?php echo esc_attr( $post->ID ); ?>" />
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

		endif; wp_reset_postdata(); ?>

		<!-- Paintings -->
		<section class="section bg-white" id="paintings-section"  data-colorscheme="light">
			<div class="projectnav-wrapper">
				<div class="projectnav-previous" onclick="projPrevious(activeProjNo, maxProjNo);"><span></span></div>
				<div class="projectnav-next" onclick="projNext(activeProjNo, maxProjNo);"><span></span></div>
			</div>
			<div id="paintingsoutput"></div>
		</section>

		<!-- White logo area -->
		<?php
		$white_logo = get_field( 'section13' );

		if ( $white_logo ) : ?>
			<section class="section" id="white-logo" data-colorscheme="dark">
				<div class="row">
					<div class="small-24 columns">
						<?php
							if( !empty($white_logo) ): ?>
								<p class="big-logo"><img src="<?php echo $white_logo['url']; ?>" alt="<?php echo $white_logo['alt']; ?>" /></p>
						<?php endif; ?>
					</div>
				</div>
			</section>
		<?php endif; ?>

		<!-- Half black, half blue -->
		<section class="section" id="halfblackblue" data-colorscheme="dark">
			<div class="section-content small-12 columns" id="halfblack">
				<?php the_field('section14left'); ?>
			</div>

			<div class="section-content small-12 columns" id="halfblue">
				<?php the_field('section14right'); ?>
			</div>
		</section>

		<!-- Half grey, half white -->
		<section class="section" id="halfgreywhite" data-colorscheme="light">
			<div class="section-content small-12 columns" id="halfgrey">
				<?php the_field('section15left'); ?>
			</div>
			<div class="section-content small-12 columns" id="halfwhite">
				<?php the_field('section15right'); ?>
			</div>
		</section>

		<!-- Newsletter signup -->
		<section class="section" id="newsletter-signup" data-colorscheme="dark">
			<div class="row">
				<div class="small-24 columns">

					<!-- Begin MailChimp Signup Form -->
					<form action="//o-r-c-p.us10.list-manage.com/subscribe/post?u=f3b63f7543d9772d6cd51b508&amp;id=e8a73da059" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate newsletter-form" target="_blank" novalidate>

						<input type="email" name="EMAIL" id="mce-EMAIL" placeholder="<?php _e( 'Updates', 'orcp' ); ?>" class="required email">
						<input type="submit" name="subscribe" id="mc-embedded-subscribe" value="<?php _e( 'email adress + enter', 'orcp' ); ?>">

						<!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
					   <div style="position: absolute; left: -5000px;"><input type="text" name="b_f3b63f7543d9772d6cd51b508_e8a73da059" tabindex="-1" value=""></div>

					</form>
					<!--End mc_embed_signup-->

				</div>
			</div>
		</section>

		<!-- Gallery background -->
		<?php
			$section17img = get_field('section17');
			if( !empty($section17img) ): ?>
				<section class="section" id="gallerybg" data-colorscheme="dark" style="background: no-repeat url('<?php echo $section17img['url']; ?>')">
				</section>
		<?php endif; ?>

		<!-- Grey logo area -->
		<section class="section" id="greylogo" data-colorscheme="light">
			<div class="row">
				<div class="small-24 columns">
					<?php
						$section18img = get_field('section18');
						if( !empty($section18img) ): ?>
							<p class="big-logo"><img src="<?php echo $section18img['url']; ?>" alt="<?php echo $section18img['alt']; ?>" /></p>
						<?php endif; ?>
				</div>
			</div>
		</section>

		<!-- Circuits triangle area -->
		<section class="section" id="circuits-triangle" data-colorscheme="dark" style="background: url('<?php echo $project_image['url']; ?>')">

			<div class="circuits-triangle-inner">
				<div class="circuits-triangle-inner-text">
					<p><?php the_field('section19inner'); ?></p>
				</div>
				<img src="<?php echo THEME_IMAGES_URI; ?>/bg-black-triangle.png">
			</div>

			<footer class="site-footer">
				<div class="small-24 medium-8 large-8 columns footer-left">
					&copy; O.R.C.P AB | All rights reserved | <a href="#" class="no-link">Terms & Conditions</a> |
				</div>
				<div class="small-24 medium-8 large-6 columns footer-center">
					wholesale@orcp.com
				</div>
				<div class="small-24 medium-8 large-10 columns footer-right">
					| Warehouse: O.R.C.P AB | Ingenjorsgatan 5 | 411 19 Gothenburg | Sweden
				</div>
			</footer>

		</section>

	<?php endwhile; ?>

	<?php else : ?>

		<?php get_template_part('content', '404'); ?>

	<?php endif; ?>


<?php get_footer(); ?>

<!-- Ajax load for active project -->
<?php echo "<script type='text/javascript'>jQuery(function() {activeProjNo =". $active_project_no ."; maxProjNo = ". $max_project_no . "; changeProject(activeProjNo, maxProjNo)});</script>";?>
