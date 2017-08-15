<?php
/**
 * WooCommerce Tweaks & Addons
 *
 * In this file we try and contain all the relevant
 * tweaks, addons anc changes that effect WooCommerce.
 */

// Disable default stylesheet
add_filter( 'woocommerce_enqueue_styles', '__return_false' );

// Remove sidebar
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

// Change order of checkout load
remove_action( 'woocommerce_checkout_order_review', 'woocommerce_order_review', 10 );
remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );
add_action( 'woocommerce_checkout_order_review', 'woocommerce_order_review', 20 );
add_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 10 );