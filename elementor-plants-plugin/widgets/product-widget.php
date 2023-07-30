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
        return ['basic'];
    }

    protected function _register_controls()
    {
        // Настройки виджета
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
                'default' => 'all', // Опция "all" будет выводить все продукты без фильтрации по категориям
            ]
        );

        $this->add_control(
            'featured_only',
            [
                'label' => esc_html__('Featured Products Only', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'elementor-addon'),
                'label_off' => esc_html__('No', 'elementor-addon'),
                'return_value' => 'yes',
                'default' => 'no',
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

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        // Параметры запроса для WP_Query
        $args = [
            'post_type' => 'product',
            'posts_per_page' => $settings['posts_per_page'],
            'orderby' => 'date',
            'order' => 'DESC',
        ];

        // Если выбрана конкретная категория или "Featured Only", добавляем соответствующие параметры
        if ($settings['category'] !== 'all') {
            $args['tax_query'] = [
                [
                    'taxonomy' => 'product_cat',
                    'field' => 'term_id',
                    'terms' => $settings['category'],
                ],
            ];
        }

        if ($settings['featured_only'] === 'yes') {
            $args['meta_query'] = [
                [
                    'key' => '_featured',
                    'value' => 'yes',
                ],
            ];
        }

        // Получаем продукты с помощью WP_Query
        $products_query = new WP_Query($args);

        if ($products_query->have_posts()) {
            while ($products_query->have_posts()) {
                $products_query->the_post();

                // Выводим информацию о продукте
                the_title('<h2>', '</h2>');
                the_post_thumbnail();
                the_content();
                echo '<hr>';
            }
            wp_reset_postdata(); // Сбрасываем запрос, чтобы не повлиять на другие элементы на странице
        } else {
            echo esc_html__('No products found.', 'elementor-addon');
        }
    }

    protected function get_product_categories()
    {
        // Получаем список категорий продуктов
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
