<?php
class Social_Links_Widget extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'social_links_widget';
    }

    public function get_title()
    {
        return esc_html__('Social Links Widget', 'plants');
    }

    public function get_icon()
    {
        return 'eicon-social-icons';
    }

    public function get_categories()
    {
        return ['theme-widgets'];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'section_social_links',
            [
                'label' => esc_html__('Social Links', 'plants'),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'social_url',
            [
                'label' => esc_html__('URL', 'plants'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-social-url.com', 'plants'),
                'show_external' => true,
                'default' => [
                    'url' => '',
                    'is_external' => true,
                ],
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'social_abbreviation',
            [
                'label' => esc_html__('Abbreviation', 'plants'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'FB', 
            ]
        );

        $this->add_control(
            'social_links_list',
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

        if (empty($settings['social_links_list'])) {
            return;
        }

        echo '<div class="social">';
        
        foreach ($settings['social_links_list'] as $link) {
            $url = $link['social_url']['url'];
            $title = $link['social_abbreviation'];
            ?>
                <a href="<?php echo esc_url($url) ?>"><span class="social-icons"><?php echo esc_html($title) ?></span></a>
            <?php
        
        }

        echo '</div>';
    }
}

