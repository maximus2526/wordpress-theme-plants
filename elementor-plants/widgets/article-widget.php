<?php
class Articles_Widget extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'article_widget';
    }

    public function get_title()
    {
        return esc_html__('Article Widget', 'elementor-addon');
    }

    public function get_icon()
    {
        return 'eicon-post';
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
                'label' => esc_html__('Articles Category', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => $this->get_article_categories(),
                'default' => 'all',
            ]
        );


        $this->add_control(
            'posts_per_page',
            [
                'label' => esc_html__('Number of Articles', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 3,
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
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => $settings['posts_per_page'],
            'orderby' => 'date',
            'order' => 'DESC',
        ];

        if ($settings['category'] !== 'all') {
            $args['tax_query'] = [
                [
                    'taxonomy' => 'category',
                    'field' => 'term_id',
                    'terms' => $settings['category'],
                ],
            ];
        }

        $articles_query = new WP_Query($args);



        if ($articles_query->have_posts()) {
            if ($settings['add_to_container'] === 'yes') {
                echo '<div class="container">';
            }
            if ($settings['is_slider'] === 'yes') {
                echo '<div class="swiper-banner">';
                echo '<div class="swiper-wrapper ">';

                while ($articles_query->have_posts()) {
                    $articles_query->the_post();
                    ?>
                    <div class="swiper-slide darken-image" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>');">
                        <div class="article-banner">
                            <div class="banner-content  scheme-light">
                                <div class="banner-header">
                                    <a href="<?php echo get_permalink(); ?>">
                                        <?php the_title('<h3 class="entry-title">', '</h3>'); ?>
                                    </a>
                                </div>
                                <div class="banner-description opacity-80">
                                    <?php the_excerpt(); ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                }

                echo '</div>'; // Close .swiper-wrapper
                echo '</div>'; // Close .swiper
            } else {
                ?>
                <div class="row">
                <?php
                while ($articles_query->have_posts()) {
                    $articles_query->the_post();
                    ?>

            <div class="col-12">
                <div class="article display-flex align-center gap">
                    <div class="article-img">
                    <?php echo get_the_post_thumbnail(); ?>
                    </div>

                    <div class="article-content-wrapper display-flex space-between align-center">
                        <div class="article-content">
                            <div class="author">
                                Posted by
                                <?php the_author(); ?>
                            </div>
                            <div class="article-header">
                                <?php the_title('<h3 class="entry-title">', '</h3>'); ?>
                            </div>
                        </div>
                        <div class="continue-button">
                            <a href="<?php echo get_permalink(); ?>">
                                Continue reading →
                            </a>
                        </div>
                    </div>
                </div>
            </div>

                    <?php
                }
                ?>
                </div>
                <?php
            }

            wp_reset_postdata();

            if ($settings['add_to_container'] === 'yes') {
                echo '</div>';
            }
        } else {
            echo esc_html__('No articles found.', 'plants');
        }
    }



    protected function get_article_categories()
    {
        $categories = get_terms(
            [
            'taxonomy' => 'category',
            'hide_empty' => true,
            ]
        );

        $category_options = ['all' => esc_html__('All Articles', 'elementor-addon')];

        foreach ($categories as $category) {
            $category_options[$category->term_id] = $category->name;
        }

        return $category_options;
    }
}
