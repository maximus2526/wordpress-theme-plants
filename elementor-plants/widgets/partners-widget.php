<?php
class Partners_Links_Widget extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'partners_links_widget';
    }

    public function get_title()
    {
        return esc_html__('Partners Links Widget', 'plants');
    }

    public function get_icon()
    {
        return 'eicon-device-mobile';
    }

    public function get_categories()
    {
        return ['theme-widgets'];
    }

    protected function _register_controls()
    {
        
        $this->start_controls_section(
            'img_size',
            [
                'label' => esc_html__('Size', 'plants'),
            ]
        );

        $this->add_control(
            'width',
            [
                'label' => esc_html__('Width', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '60px',
            ]
        );
        $this->add_control(
            'height',
            [
                'label' => esc_html__('Height', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '40px',
            ]
        );


        $this->end_controls_section();


        $this->start_controls_section(
            'section_partner_links',
            [
                'label' => esc_html__('Partner Links', 'plants'),
            ]
        );

        $repeater = new \Elementor\Repeater();


        $repeater->add_control(
            'partner_url',
            [
                'label' => esc_html__('URL', 'plants'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-partner-url.com', 'plants'),
                'show_external' => true,
                'default' => [
                    'url' => '',
                    'is_external' => true,
                ],
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'partner_img',
            [
                'label' => esc_html__('Choose Image', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::MEDIA, 
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'partner_links_list',
            [
                'label' => esc_html__('Social Links List', 'plants'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'social_url' => [
                            'url' => 'https://www.facebook.com/',
                            'is_external' => true,
                        ],
                        'social_abbreviation' => 'FB',
                    ],
                ],
            ]
        );

        $this->end_controls_section();
    }
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $width = $settings['width'];
        $height = $settings['height'];
        echo '<div class="display-flex gap">';
        if ($settings['partner_links_list']) {
            foreach ($settings['partner_links_list'] as $link) {
                
                $url = $link['partner_url']['url'];
                $image_url = $link['partner_img']['url'];
                echo '<a href="' . esc_url($url) . '"><img style="width: '. $width .'; height: '. $height .';" src="' . $image_url . '"></a>';
            }
        }
        echo '</div>';
    }
    
}

