<?php
class Custom_Logo_Widget extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'logo_widget';
    }

    public function get_title()
    {
        return esc_html__('Logo Widget', 'elementor-addon');
    }

    public function get_icon()
    {
        return 'eicon-logo';
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
            'choice',
            [
                'label' => esc_html__('Choose Image:', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'default' => 'Default',
                    'upload' => 'Upload',
                ],
                'default' => 'default',
            ]
        );

        $this->add_control(
            'upload_image',
            [
                'label' => esc_html__('Choose Image', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'media_type' => 'image',
                'condition' => [
                    'choice' => 'upload',
                ],
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        if ($settings['choice'] == 'upload') {
            echo '<img src="' . $settings['upload_image']['url'] . '">';
            echo wp_get_attachment_image($settings['image']['id'], 'thumbnail');
            $this->add_render_attribute('image', 'src', $settings['image']['url']);
            $this->add_render_attribute('image', 'alt', \Elementor\Control_Media::get_image_alt($settings['image']));
            $this->add_render_attribute('image', 'title', \Elementor\Control_Media::get_image_title($settings['image']));
            $this->add_render_attribute('image', 'class', 'my-custom-class');
            echo \Elementor\Group_Control_Image_Size::get_attachment_image_html($settings, 'thumbnail', 'image');
        } else {
            the_custom_logo();
        }
    }
}
