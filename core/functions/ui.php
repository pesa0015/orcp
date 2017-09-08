<?php

if ( ! function_exists( 'orcp_pagination' ) ) :

    /**
     * Pagination
     *
     * Creates a pagination markup based on the Foundation
     * framework pagination markup.
     *
     * @author  Erik Bernskiold
     */

    function orcp_pagination( $arrows = true, $ends = true, $pages = 2 ) {

        if (is_singular()) return;

        global $wp_query, $paged;
        $pagination = '';

        $max_page = $wp_query->max_num_pages;
        if ($max_page == 1) return;
        if (empty($paged)) $paged = 1;

        if ($arrows) $pagination .= orcp_pagination_link($paged - 1, 'arrow' . (($paged <= 1) ? ' unavailable' : ''), '&laquo;', 'Previous Page');
        if ($ends && $paged > $pages + 1) $pagination .= orcp_pagination_link(1);
        if ($ends && $paged > $pages + 2) $pagination .= orcp_pagination_link(1, 'unavailable', '&hellip;');
        for ($i = $paged - $pages; $i <= $paged + $pages; $i++) {
            if ($i > 0 && $i <= $max_page)
                $pagination .= orcp_pagination_link($i, ($i == $paged) ? 'current' : '');
        }
        if ($ends && $paged < $max_page - $pages - 1) $pagination .= orcp_pagination_link($max_page, 'unavailable', '&hellip;');
        if ($ends && $paged < $max_page - $pages) $pagination .= orcp_pagination_link($max_page);

        if ($arrows) $pagination .= orcp_pagination_link($paged + 1, 'arrow' . (($paged >= $max_page) ? ' unavailable' : ''), '&raquo;', 'Next Page');

        $pagination = '<ul class="pagination">' . $pagination . '</ul>';
        $pagination = '<div class="pagination-centered">' . $pagination . '</div>';

        echo $pagination;
    }

endif;

if ( ! function_exists( 'orcp_pagination_link' ) ) :

    /**
     * Pagination Link
     *
     * Creates the special pagination link that is then used in the
     * main pagination function above.
     *
     * @author  Erik Bernskiold
     */
    function orcp_pagination_link( $page, $class = '', $content = '', $title = '' ) {
        $id = sanitize_title_with_dashes('pagination-page-' . $page . ' ' . $class);
        $href = (strrpos($class, 'unavailable') === false && strrpos($class, 'current') === false) ? get_pagenum_link($page) : "#$id";

        $class = empty($class) ? $class : " class=\"$class\"";
        $content = !empty($content) ? $content : $page;
        $title = !empty($title) ? $title : 'Page ' . $page;

        return "<li$class><a id=\"$id\" href=\"$href\" title=\"$title\">$content</a></li>\n";
    }

endif;

if ( ! function_exists( 'orcp_get_excerpt' ) ) :

    /**
     * Custom Excerpt Function
     *
     * @param  integer $limit Amount of characters to show.
     */
    function orcp_get_excerpt( $limit, $text = null ) {

        global $post;

        if ( $text ) {
            $excerpt = explode(' ', $text, $limit);
        } else {
            $excerpt = explode(' ', get_the_excerpt(), $limit);
        }

        if (count($excerpt)>=$limit) {
        array_pop($excerpt);
            $excerpt = implode(" ",$excerpt).'...';
        } else {
            $excerpt = implode(" ",$excerpt);
        }

        $excerpt = strip_tags( preg_replace( '`\[[^\]]*\]`', '', $excerpt ) );

        return $excerpt;
    }

endif;

if ( ! function_exists( 'orcp_header_add_to_cart_fragment' ) ) :

    /**
     * Ensure cart contents update when products are added to the cart via AJAX
     */
    function orcp_header_add_to_cart_fragment( $fragments ) {

        global $woocommerce;

        ob_start();

        ?>
        <a class="cart-contents" id="mini-cart-trigger" href="#" title="<?php _e( 'View your shopping cart', 'orcp' ); ?>"><?php echo sprintf( __( 'Cart (%d)', 'orcp' ), $woocommerce->cart->cart_contents_count); ?></a>
        <?php

        $fragments['a.cart-contents'] = ob_get_clean();

        return $fragments;

    }

    add_filter( 'add_to_cart_fragments', 'orcp_header_add_to_cart_fragment' );

endif;

if ( ! function_exists( 'orcp_the_loading_spinner' ) ) :

    function orcp_the_loading_spinner() {

        ob_start(); ?>

        <section id="loading">
            <span class="alignmenthelper"></span><span class="transform" id="spinner"><img src="<?php echo THEME_IMAGES_URI; ?>/loading-text.png" alt="<?php _e( 'Loading...', 'orcp' ); ?>"></span>
        </section>

        <?php
        $output = ob_get_clean();

        echo $output;

    }

endif;

if ( ! function_exists( 'orcp_the_project_nav' ) ) :

    function orcp_the_project_nav( $active_project_number, $max_project_number ) {

        ob_start(); ?>

            <div class="projectnav-wrapper">
                <div class="projectnav-previous" onclick="projPrevious();"><span></span></div>
                <div class="projectnav-next" onclick="projNext();"><span></span></div>
            </div>

        <?php
        $output = ob_get_clean();

        echo $output;

    }

endif;

if ( ! function_exists( 'orcp_section_start_tag' ) ) :

    function orcp_section_start_tag( $section, $color_scheme ) {

        $attributes_array = array();

        if ( $section ) {

            if ( get_field( 'section_nav_id', $section ) ) {
                $attributes_array[] = 'id="section-' . get_field( 'section_nav_id', $section ) . '"';
                $attributes_array[] = 'data-anchor="' . get_field( 'section_nav_id', $section ) . '"';
            }

        }

        $attributes_array[] = 'data-colorscheme="' . $color_scheme['header_style'] . '"';

        if ( $color_scheme['bg_images'] ) {
            $random_image = $color_scheme['bg_images'][ array_rand($color_scheme['bg_images']) ];
            $bg_image = 'background-image: url(' . $random_image['url'] . ');';
        } else {
            $bg_image = '';
        }

        $attributes_array[] = 'style="background-color: ' . $color_scheme['bgcolor'] . '; color: ' . $color_scheme['text_color'] . '; border-color: ' . $color_scheme['text_color'] . ' !important; ' . $bg_image . '"';

        if ( $color_scheme['header_links_color'] ) {
            $attributes_array[] = 'data-headerlinkcolor="' . $color_scheme['header_links_color'] . '"';
        }

        if ( $color_scheme['logo_color'] ) {
            $attributes_array[] = 'data-headerlogocolor="' . $color_scheme['logo_color'] . '"';
        }

        if ( $color_scheme['header_menu_sprite'] ) {
            $attributes_array[] = 'data-headermenusprite="' . $color_scheme['header_menu_sprite'] . '"';
        }

        $attributes = join( $attributes_array, ' ' );

        echo $attributes;

    }

    add_action( 'section_start_tag', 'orcp_section_start_tag', 10, 2 );

endif;

if ( ! function_exists( 'orcp_the_shopping_cart' ) ) :

    function orcp_the_shopping_cart() {

        global $woocommerce;

        ob_start(); ?>

        <section class="split-screen-container shopping-cart-container">

            <div class="split-screen-left shopping-cart-pixels bg-binary"></div>

            <div class="split-screen-right shopping-cart-wrapper">
                <div class="split-screen-body shopping-cart">

                    <div class="split-screen-close" id="mini-cart-close">
                        <a href="#" class="close-button"><img src="<?php echo THEME_IMAGES_URI; ?>/flex/close-button.svg" class="iconic" alt="Close"></a>
                    </div>

                    <h2 class="mini-cart-title"><?php _e( 'Cart', 'orcp' ); ?></h2>

                    <?php if ( sizeof( WC()->cart->get_cart() ) > 0 ) : ?>

                        <table class="mini-cart">
                            <thead>
                                <tr>
                                    <th class="mini-cart-item"><?php _e( 'Object', 'orcp' ); ?></th>
                                    <th class="mini-cart-qty"><?php _e( 'Quantity', 'orcp' ); ?></th>
                                    <th class="mini-cart-price"><?php _e( 'Price', 'orcp' ); ?></th>
                                    <th class="mini-cart-subtotal"><?php _e( 'Subtotal', 'orcp' ); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) :

                                    $_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                                    $product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

                                    if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) :

                                        $product_name  = apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
                                        $thumbnail     = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
                                        $product_price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );

                                        $product_project = orcp_get_product_project( $product_id );
                                        ?>
                                        <tr class="mini-cart-product-item">
                                            <td class="mini-cart-item">
                                                <span class="mini-cart-item-project"><?php printf( __( 'Project No. %1$s - %2$s', 'orcp' ), get_field( 'project_number', $product_project ), get_field( 'project_objects_section_title', $product_project ) ); ?></span><br>
                                                <span class="mini-cart-product-title"><?php echo $_product->get_title(); ?></span><br>
                                                <span class="mini-cart-product-subtitle"><?php the_field( 'product_subtitle', $product_id ); ?></span><br>
                                                <?php echo WC()->cart->get_item_data( $cart_item ); ?>
                                            </td>
                                            <td class="mini-cart-qty">
                                                <div class="mini-cart-qty-selectors">
                                                    <a href="#" data-itemkey="<?php echo $cart_item_key; ?>" data-product-id="<?php echo $cart_item['product_id']; ?>" data-action="add" class="plus mini-cart-qty-trigger">+</a>
                                                    <a href="#" data-itemkey="<?php echo $cart_item_key; ?>" data-product-id="<?php echo $cart_item['product_id']; ?>" data-action="remove" class="minus mini-cart-qty-trigger">-</a>
                                                </div>
                                                <span class="mini-cart-qty-number"><?php echo $cart_item['quantity']; ?></span>
                                            </td>
                                            <td class="mini-cart-price">
                                                <?php
                                                    echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
                                                ?>
                                            </td>
                                            <td class="mini-cart-subtotal">
                                                <?php
                                                    echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
                                                ?>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>

                                <tr>
                                    <td colspan="2"></td>
                                    <td class="mini-cart-summary-label">
                                        <?php _e( 'Subtotal:', 'orcp' ); ?>
                                    </td>
                                    <td class="mini-cart-summary">
                                        <?php wc_cart_totals_subtotal_html(); ?>
                                    </td>
                                </tr>

                            </tfoot>
                        </table>

                        <p><a href="<?php echo $woocommerce->cart->get_checkout_url(); ?>" id="mini-cart-checkout">
                            <img src="<?php echo THEME_IMAGES_URI; ?>/checkout-button.png" alt="">
                            <span><?php _e( 'Go to Checkout', 'orcp' ); ?></span>
                        </a></p>

                    <?php else : ?>

                        <p><?php _e( 'Your cart is currently empty.', 'orcp' ); ?></p>

                    <?php endif; ?>

                </div>

            </div>

        </section>

        <?php
        echo ob_get_clean();

    }

endif;

if ( ! function_exists( 'orcp_the_product_facts' ) ) :

    function orcp_the_product_facts( $product_id ) {

        ob_start(); ?>

            <div class="product-item-facts">
                <ul>
                    <li><a href="#" class="product-facts-trigger" data-type="facts"><?php _e( 'Facts', 'orcp' ); ?></a></li>
                    <li><a href="#" class="product-facts-trigger" data-type="size"><?php _e( 'Size Guide', 'orcp' ); ?></a></li>
                    <li><a href="#" class="product-facts-trigger" data-type="shipping"><?php _e( 'Shipping', 'orcp' ); ?></a></li>
                    <li><a href="#" class="product-facts-trigger" data-type="returns"><?php _e( 'Returns', 'orcp' ); ?></a></li>
                    <li><a href="#" class="product-facts-trigger" data-type="payment"><?php _e( 'Payment Methods', 'orcp' ); ?></a></li>
                    <li><a href="#" class="product-facts-trigger" data-type="contact"><?php _e( 'Contact', 'orcp' ); ?></a></li>
                    <?php /*<li><a href="#" class="copy-link-trigger" data-link="<?php echo home_url() ;?>/#product-<?php echo $product_id; ?>" ><?php _e( 'Copy Link', 'orcp' ); ?></a></li>*/ ?>
                </ul>

                <?php /*
                <a id="product-item-facts-mobile-trigger" class="product-facts-trigger" data-type="facts">
                    <img data-src="<?php echo THEME_IMAGES_URI; ?>/flex/circle.svg" class="iconic" alt="" style="max-height: 150px;">
                </a>
                */ ?>
            </div>

        <?php
        echo ob_get_clean();

    }

endif;

if ( ! function_exists( 'orcp_the_site_footer' ) ) :

    function orcp_the_site_footer() {

        ob_start(); ?>

            <footer class="site-footer">
                <ul class="footer-details">
                    <li><?php _e( 'O.R.C.P', 'orcp' ); ?> &copy; <?php echo date('Y'); ?></li>
                    <li><?php _e( 'all rights reserved', 'orcp' ); ?></li>
                    <li><a href="<?php echo get_permalink( get_option( 'woocommerce_terms_page_id' ) ); ?>" class="no-link"><?php _e( 'terms & conditions', 'orcp' ); ?></a></li>
                    <li><a href="mailto:<?php _e( 'general@o-r-c-p.com', 'orcp' ); ?>" class="no-link"><?php _e( 'general@o-r-c-p.com', 'orcp' ); ?></a></li>
                    <li><a href="<?php echo home_url( 'our-social-responsibility' ); ?>" class="no-link"><?php _e( 'OSR', 'orcp' ); ?></a></li>
                   <?php /*
                    <li><?php _e( 'warehouse: O.R.C.P AB', 'orcp' ); ?></li>
                    <li><?php _e( 'ingenjorsgatan 5', 'orcp' ); ?></li>
                    <li><?php _e( '411 19', 'orcp' ); ?></li>
                    <li><?php _e( 'gothenburg', 'orcp' ); ?></li>
                    <li><?php _e( 'sweden', 'orcp' ); ?></li>
                    */ ?>
                    <li class="footer-details-logo"><img src="<?php echo THEME_IMAGES_URI; ?>/checkout-button.png" alt="ORCP"></li>
                </ul>
            </footer>

        <?php
        echo ob_get_clean();

    }

endif;