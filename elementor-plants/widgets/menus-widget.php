<?php
class Menus_Widget extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return esc_html('menus_widget', 'plants');
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
            'menus',
            [
                'label' => esc_html__('Choice Menu', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => $this->get_menus_names(),
            ]
        );
        $this->add_control(
            'vertical',
            [
                'label' => esc_html__('Vertical', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'no' => false,
                    'yes' => true
                ],
                'default' => 'no',
            ]
        );

        $this->add_control(
            'with_signs',
            [
                'label' => esc_html__('With Signs', 'elementor-addon'),
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
            wp_nav_menu(
                array(
                    'menu' => $this->get_menus_names()[$settings['menus']],
                    'menu_class' => 'scheme-dark ' . ($settings['vertical'] === 'no' ? 'display-flex gap' : 'vertical-nav') . ($settings['with_signs'] === 'no' ? '' : ' menu-sign vertical-nav-item nav-img'),
                )

            );
    }

    protected function get_menus_names()
    {
        $menus = wp_get_nav_menus();
        $menu_names = array();
        foreach ($menus as $menu) {
            $menu_names[] = $menu->name;
        }

        return $menu_names;
    }
}