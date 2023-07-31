<?php
class Menus_Widget extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'menus_widget';
    }

    public function get_title()
    {
        return esc_html__('Menus Widget', 'elementor-addon');
    }

    public function get_icon()
    {
        return 'eicon-menu-bar';
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


        $this->end_controls_section();
    }

    protected function render()
    {
       
    }

}