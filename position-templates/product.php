<?php

$shapes = array( 'square', 'triangle', 'circle' );
$random_shape = $shapes[ array_rand( $shapes ) ];

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

		<section <?php do_action( 'section_start_tag', $section, $color_scheme ); ?> itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="section-product-<?php the_ID(); ?>" <?php post_class( 'section product-item' ); ?> data-anchor="product-<?php the_ID(); ?>" style="height:1100px;">

			<?php
				$product_id = $product_query->post->ID;
				$product = wc_get_product( $product_id );
				$product_colors = orcp_get_product_colors( $product_id );

				$variations_query_args = array(
					'post_type' => 'product_variation',
					'post_parent' => $product_id,
				);

				$variations_query = new WP_Query( $variations_query_args );
			?>

			<?php if ( $variations_query->have_posts() ) : ?>

				<div class="section-inner">

					<div class="product-item-colors">

						<?php while ( $variations_query->have_posts() ) : $variations_query->the_post(); ?>

							<?php
							$variation = wc_get_product( $variations_query->post->ID );

							$variation_image_id = get_post_meta( $variations_query->post->ID, '_thumbnail_id', true );

							$variation_image = wp_get_attachment_image_src( $variation_image_id, 'large' );
							$variation_image_original = wp_get_attachment_image_src( $variation_image_id, 'original' );

							$variation_attributes = $variation->get_variation_attributes();

							$gallery_attachment_ids = get_post_meta( get_the_ID(), '_wc_additional_variation_images', true );
							$gallery_attachment_ids = explode( ',', $gallery_attachment_ids );

							$color_slug = $variation_attributes['attribute_pa_color'];
							$color_obj = get_term_by( 'slug', $color_slug, 'pa_color' );

							$color_name = $color_obj->name;
							?>

							<div class="slide product-item-color">

								<div>

									<div class="product-item-images">
										<a href="<?php echo $variation_image_original[0]; ?>" class="swipebox product-slide" data-imgorder="0"><img src="<?php echo $variation_image[0]; ?>" alt="<?php the_title(); ?>"></a>

										<?php $i=1; foreach ( $gallery_attachment_ids as $img_id ) : $img = wp_get_attachment_url( $img_id ); ?>
											<a href="<?php echo $img; ?>" class="swipebox product-slide" data-imgorder="<?php echo $i; ?>"><img src="<?php echo $img; ?>" alt="<?php the_title(); ?>"></a>
										<?php $i++; endforeach; ?>
									</div>

									<div class="small-24 medium-24 large-17 columns"></div>

									<div class="small-24 medium-24 large-6 columns">

										<p class="product-item-project-title"><?php printf( __( 'Project No.%s', 'orcp' ), get_field( 'project_number', $active_project_obj ) ); ?></p>
										<p class="product-item-project-name"><?php the_field( 'project_objects_section_title', $active_project_obj ); ?></p>

										<?php if ( has_post_thumbnail() ) : ?>
											<div class="product-item-thumbnail">
												<?php echo get_the_post_thumbnail( $product_id, 'product-item-thumbnail' ); ?>
											</div>
										<?php endif; ?>

										<h3 class="product-item-title"><?php echo get_the_title( $product_id ); ?></h3>

										<p class="product-item-subtitle"><?php the_field( 'product_subtitle', $product_id ); ?></p>

										<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>

										<form class="single-product-add-cart-form" method="post">

											<p class="hide-for-large-up text-center">
												<?php _e( 'shop available on desktop', 'orcp' ); ?>
											</p>

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

												<li>

													<button type="submit" class="single_add_to_cart_button button alt product-item-actions-cart"><?php echo $product->single_add_to_cart_text(); ?></button>

													<input type="hidden" name="product_id" id="product_id" value="<?php echo $product_id; ?>" />
													<input type="hidden" id="variation_id" name="variation_id" value="<?php echo esc_attr( $variations_query->post->ID ); ?>" />
													<input type="hidden" id="color_slug" name="color_slug" value="<?php echo $color_obj->slug; ?>" />

												</li>
											</ul>

										</form>

										<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

										<p class="product-item-variation-title"><?php echo $color_name; ?></p>

										<?php woocommerce_template_single_price(); ?>

										<?php orcp_the_product_facts( $product_id ); ?>

										<?php
										$store_currencies = $store_currencies = get_option( 'wmcs_store_currencies', array() );

										if ( !empty( $store_currencies ) ) :
											$store_currencies = array( get_option('woocommerce_currency') => array() ) + $store_currencies; //add base currency as selectable
										?>

											<div class="product-item-currency-selector">
												<ul>
													<li class="product-item-currency-selector-label"><?php _e( 'Swap Currency', 'orcp' ); ?></li>
													<?php
													foreach ( $store_currencies as $key => $value ) : ?>
                                                        <?php // $random_shape; ?>
														<li>
															<a href="<?php echo add_query_arg( 'wmcs_set_currency', $key ); ?>">
																<img src="<?php echo THEME_IMAGES_URI; ?>/flex/triangle.svg" alt="" class="iconic product-item-currency-selector-icon triangle">
																<span class="triangle"><?php echo get_woocommerce_currency_symbol( $key ); ?></span>
															</a>
														</li>
													<?php endforeach; ?>
												</ul>
											</div>
										<?php endif; ?>

									</div>

								</div>

								<meta itemprop="url" content="<?php echo get_permalink( $product_id ); ?>" />

								<div class="product-item-selects">
									<?php if ( $gallery_attachment_ids ) : ?>
										<div class="product-item-angles">
											<ul>
												<li class="product-item-angles-title"><?php _e( 'Angle Option', 'orcp' ); ?></li>
												<li class="product-item-angles-item">
													<a href="#" data-imgorder="0"><img src="<?php echo THEME_IMAGES_URI; ?>/flex/circle.svg" alt="" class="iconic product-item-angles-item-icon"></a>
												</li>
												<?php
												$i=1;
												foreach ( $gallery_attachment_ids as $attachment_id ) :
												?>
													<li class="product-item-angles-item">
														<a href="#" data-imgorder="<?php echo $i; ?>"><img data-src="<?php echo THEME_IMAGES_URI; ?>/flex/circle.svg" alt="" class="iconic product-item-angles-item-icon"></a>
													</li>
												<?php $i++; endforeach; ?>
											</ul>
										</div>
									<?php endif; ?>

									<?php if ( $product_colors ) : $color_id = 0; ?>
										<div class="product-item-color-links">
											<ul>
												<li class="product-item-colors-item-title"><?php _e( 'Color Spectrum', 'orcp' ); ?></li>
												<?php foreach ( $product_colors as $color ) : ?>
													<li class="product-item-colors-item"><a href="#" class="product-item-nav-trigger" data-product="<?php echo $product_id; ?>" data-variation="<?php echo $color_id; ?>"><img src="<?php echo THEME_IMAGES_URI; ?>/flex/square.svg" alt="" class="iconic product-item-colors-item-icon" style="fill: <?php the_field( 'variation_color_code', $color['obj'] ); ?>"></a></li>
												<?php $color_id++; endforeach; ?>
											</ul>
										</div>
									<?php endif; ?>
                                    <div class="product-item-facts-btn product-facts-trigger" data-type="facts">
                                        <span>FACTS</span>
                                        <img src="http://www.o-r-c-p.com/wp-content/uploads/2017/02/facts.png" class="facts-mobile-trigger" alt="">
                                    </div>
								</div>

							</div>

						<?php endwhile; ?>

					</div>
				</div>

			<?php endif;

			wp_reset_postdata(); ?>

		</section>

		<?php do_action( 'woocommerce_after_single_product' ); ?>

		<section class="product-item-facts-box">
			<div class="product-item-facts-box-pixels bg-binary"></div>
			<div class="product-item-facts-box-content-wrapper">
                <a href="#" class="close-button product-item-facts-box-close"></a>
				<div class="product-item-facts-box-content">

					<div class="product-item-facts-box-content-item" id="facts">
						<h3><?php _e( 'Facts', 'orcp' ); ?></h3>
						<?php the_field( 'product_facts', $product_id ); ?>
					</div>

					<div class="product-item-facts-box-content-item" id="size">
						<h3><?php _e( 'Size Guide', 'orcp' ); ?></h3>
						<?php the_field( 'product_size_guide', $product_id ); ?>
					</div>

					<div class="product-item-facts-box-content-item" id="shipping">
						<h3><?php _e( 'Shipping', 'orcp' ); ?></h3>
						<?php the_field( 'orcp_shipping_info', 'option' ); ?>
					</div>

					<div class="product-item-facts-box-content-item" id="returns">
						<h3><?php _e( 'Returns', 'orcp' ); ?></h3>
						<?php the_field( 'orcp_returns_info', 'option' ); ?>
					</div>

					<div class="product-item-facts-box-content-item" id="payment">
						<h3><?php _e( 'Payment methods', 'orcp' ); ?></h3>
						<?php the_field( 'orcp_payment_methods_info', 'option' ); ?>
					</div>

					<div class="product-item-facts-box-content-item" id="contact">
						<h3><?php _e( 'Contact', 'orcp' ); ?></h3>
						<?php the_field( 'orcp_contact_info', 'option' ); ?>
					</div>

					<div class="product-item-facts-box-arrows">
						<ul>
							<li class="prev"><a href="#"></a></li>
							<li class="next"><a href="#"></a></li>
						</ul>
					</div>

					<div class="product-item-facts-box-navigation">
						<?php orcp_the_product_facts( $product_id ); ?>
					</div>

				</div>
			</div>

		</section>

	<?php endwhile;

endif; wp_reset_postdata(); ?>