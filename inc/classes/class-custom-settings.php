<?php

namespace PLANTS\Inc;

use PLANTS\Inc\Traits\Singleton;

class Custom_Settings
{
    use Singleton;

    protected function __construct()
    {
        $this->setup_hooks();
    }

    protected function setup_hooks()
    {
        add_action('admin_init', 'test_custom_settings');
    }

    function reading_section_description()
    {
        echo '<p>This is the new Reading section. </p>';
    }

    function test_custom_settings()
    {
        add_theme_page("Theme Customization", "Theme Customization", "manage_options", "theme-options", "theme_option_page", null, 99);
        add_settings_section(
            'first_section',
            //section name for the section to add
            'New Reading Settings',
            //section title visible on the page
            'reading_section_description',
            //callback for section description
            'Theme Customization' //page to which section will be added.
        );
    }
    //this function creates a simple page with title Custom Theme Options Page.
    function theme_option_page()
    {
        ?>
        <div class="wrap">
            <h1>Custom Theme Options Page</h1>
            <form method="post" action="options.php">
                <?php
                ?>
            </form>
        </div>
        <?php
    }

    
        
        
}