<?php
class Subscribe_Widget extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return esc_html__('subscribe_widget', 'plants');
    }

    public function get_title()
    {
        return esc_html__('Subscribe Form Widget', 'elementor-addon');
    }

    public function get_icon()
    {
        return 'eicon-star';
    }

    public function get_categories()
    {
        return ['theme-widgets'];
    }

    protected function render()
    {
        ?>
        <form action="" method="post" id="footer-subscribe-input" class="subscribe-input display-flex gap-5">
            <input placeholder="Enter your email" type="email" name="subscribe-email">
            <button class="button" type="submit">Subscribe</button>
        </form>
        <?php
    }
}
