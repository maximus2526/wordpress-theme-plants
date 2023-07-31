<?php
class Products_Widget extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'products_widget';
    }

    public function get_title()
    {
        return esc_html__('Products Widget', 'elementor-addon');
    }

    public function get_icon()
    {
        return 'eicon-products';
    }

    public function get_categories()
    {
        return ['theme-widgets'];
    }

    protected function _register_controls()
    {

        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Content', 'elementor-addon'),
            ]
        );

        $this->add_control(
            'category',
            [
                'label' => esc_html__('Product Category', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => $this->get_product_categories(),
                'default' => 'all',
            ]
        );


        $this->add_control(
            'posts_per_page',
            [
                'label' => esc_html__('Number of Products', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 4,
            ]
        );

        $this->add_control(
            'is_slider',
            [
                'label' => esc_html__('Is slider', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'no' => false,
                    'yes' => true
                ],
                'default' => 'no',
            ]
        );

        $this->add_control(
            'add_to_container',
            [
                'label' => esc_html__('Add To Container?', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'no' => false,
                    'yes' => true
                ],
                'default' => 'no',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        $args = [
            'post_type' => 'product',
            'posts_per_page' => $settings['posts_per_page'],
            'orderby' => 'date',
            'order' => 'DESC',
        ];

        if ($settings['category'] !== 'all') {
            $args['tax_query'] = [
                [
                    'taxonomy' => 'product_cat',
                    'field' => 'term_id',
                    'terms' => $settings['category'],
                ],
            ];
        }

        $products_query = new WP_Query($args);

        if ($products_query->have_posts()) {
            if ($settings['add_to_container'] === 'yes') {
                echo '<div class="container">';
            }
            if ($settings['is_slider'] === 'yes') {
                echo '<div class="swiper">';
                echo '<div class="swiper-wrapper">';
            }


            while ($products_query->have_posts()) {
                $products_query->the_post();
                global $product;
                ?>
                <div class="swiper-slide">
                    <div class="products display-flex wrap">
                        <div class="product">
                            <?php

                            if (has_post_thumbnail()) {
                                if ($product->is_on_sale()) {
                                    echo '<span class="onsale">Sale!</span>';
                                }
                                echo '<div class="product-image">';
                                the_post_thumbnail('thumbnail', ['style' => 'width: 100%;']);
                                echo '</div>';


                            }
                            // Output product title as a link to the product page
                            echo '<p><a href="' . get_permalink() . '">' . get_the_title() . '</a></p>';

                            echo '<div class="product-add-to-cart gap">' . do_shortcode('[add_to_cart id="' . get_the_ID() . '"]') . '</div>';
                            ?>
                        </div>
                    </div>
                </div>
                <?php
            }

            wp_reset_postdata();
            if ($settings['is_slider'] === 'yes') {
                echo '</div>'; // Close .swiper-wrapper
                echo '<div class="swiper-button-prev"><img src="' . THEME_IMG_URI . '/svg/swiper/slider-left.svg" alt=""></div>';
                echo '<div class="swiper-button-next"><img src="' . THEME_IMG_URI . '/svg/swiper/slider-right.svg" alt=""></div>';
                echo '</div>'; // Close .swiper
            }
            if ($settings['add_to_container'] === 'yes') {
                echo '</div>';
            }
        } else {
            echo esc_html__('No products found.', 'elementor-addon');
        }
    }

    protected function get_product_categories()
    {
        $categories = get_terms([
            'taxonomy' => 'product_cat',
            'hide_empty' => true,
        ]);

        $category_options = ['all' => esc_html__('All Products', 'elementor-addon')];

        foreach ($categories as $category) {
            $category_options[$category->term_id] = $category->name;
        }

        return $category_options;
    }
}