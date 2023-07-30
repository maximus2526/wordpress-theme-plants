<?php
class Swiper_Widget extends \Elementor\Widget_Inner_Section
{
    public function get_name()
    {
        return 'swiper_widget';
    }

    public function get_title()
    {
        return esc_html__('Swiper Widget', 'elementor-addon');
    }

    public function get_icon()
    {
        return 'eicon-accordion';
    }

    public function get_categories()
    {
        return ['basic'];
    }

    protected function render()
    {
        echo 'sdffdsdfsdfs';
        add_action('elementor/element/before_section_start', function (\Elementor\Element_Base $element) {
            if ('section' === $element->get_name()) {
                ?>
                <!-- Slider main container -->
                <div class="swiper">
                    <!-- Additional required wrapper -->
                    <div class="swiper-wrapper">

                        <!-- Slides -->
                        <?php
            }
        });
        echo 'sdffdsdfsdfs';
        add_action('elementor/element/after_section_start', function (\Elementor\Element_Base $element) {
            if ('section' === $element->get_name()) {
                ?>
                    </div>
                    <!-- If we need navigation buttons -->
                    <div class="swiper-button-prev"><img src="<?php echo THEME_IMG_URI ?>/svg/swiper/slider-left.svg" alt="">
                    </div>
                    <div class="swiper-button-next"><img src="<?php echo THEME_IMG_URI ?>/svg/swiper/slider-right.svg" alt="">
                    </div>
                </div>
                <?php
            }
            echo 'sdffdsdfsdfs';
        });
    }

}