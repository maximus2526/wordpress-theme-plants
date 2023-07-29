<?php

namespace PLANTS\Inc;

use PLANTS\Inc\Traits\Singleton;

class WooCommerce
{

    use Singleton;

    protected function __construct()
    {
        $this->setup_hooks();
    }

    protected function setup_hooks()
    {
        add_action('after_setup_theme', 'theme_add_woocommerce_support');
        add_action('wp_enqueue_scripts', 'theme_load_woocommerce_styles');

    }

    function theme_add_woocommerce_support()
    {
        add_theme_support('woocommerce');
        add_theme_support('wc-product-gallery-zoom');
        add_theme_support('wc-product-gallery-lightbox');
        add_theme_support('wc-product-gallery-slider');
    }

    function theme_load_woocommerce_styles()
    {
        if (class_exists('WooCommerce')) {
            wp_enqueue_style('woocommerce-style', plugins_url('/woocommerce/woocommerce.css'));
        }
    }

}