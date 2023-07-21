<?php
/**
 * Enqueue theme assets
 *
 * @package THEME
 */

namespace PLANTS\Inc;

use PLANTS\Inc\Traits\Singleton;

class WooCommerce
{
    use Singleton;

    protected function __construct()
    {
        // Подключение WooCommerce
        if (class_exists("WooCommerce")) {
            require get_template_directory() . "/functions/woocommerce.php";
        }
        // load class.
        $this->setup_hooks();
    }

    protected function setup_hooks()
    {
        add_filter("woocommerce_enqueue_styles", "__return_empty_array");
        add_action("after_setup_theme", "theme_name_woocommerce_setup");

    }


    function theme_name_woocommerce_setup()
    {
        add_theme_support(
            "woocommerce",
            array(
                "thumbnail_image_width" => 150,   // размер thumbnail
                "single_image_width"    => 300,   // размер изображений товара
                "product_grid"          => array( // параметры вывода товаров на страницах архивов
                    "default_rows"      => 3,
                    "min_rows"          => 1,
                    "default_columns"   => 4,
                    "min_columns"       => 1,
                    "max_columns"       => 6,
                ),
            )
        );
        
        add_theme_support("wc-product-gallery-zoom");     # Увеличение изображений
        add_theme_support("wc-product-gallery-lightbox"); # Модальные окна
        add_theme_support("wc-product-gallery-slider");   # Слайдер изображений
    }
    


}