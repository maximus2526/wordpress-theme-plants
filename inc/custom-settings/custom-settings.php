<?php


function plants_add_menu()
{

    // Display Settings Page link under the “Appearance” Admin Menu
    // add_theme_page( $page_title, $menu_title, $capability, $menu_slug, $function);
    $plants_settings_page = add_theme_page(
        "Theme Customization",
        "Theme Customization",
        "manage_options",
        "theme-options",
        "theme_option_page",
        null,
        99
    );
}

//add new menu for theme-options page with page callback theme-options-page.



/**
 * Helper function for defining variables for the current page
 *
 * @return array
 */
function plants_get_settings()
{

    $output = array();

    // put together the output array
    $output['plants_option_name'] = 'plants_options';
    $output['plants_page_title'] = __('Theme Settings Page', 'plants');
    $output['plants_page_sections'] = plants_options_page_sections();
    $output['plants_page_fields'] = plants_options_page_fields();
    $output['plants_contextual_help'] = '';

    return $output;
}


/*
 * Register our setting
 */
function plants_register_settings()
{

    // get the settings sections array
    $settings_output = plants_get_settings();
    $plants_option_name = $settings_output['plants_option_name'];
    //register_setting( $option_group, $option_name, $sanitize_callback );
    register_setting($plants_option_name, $plants_option_name);

    //sections
    // add_settings_section( $id, $title, $callback, $page );
    if (!empty($settings_output['plants_page_sections'])) {
        // call the “add_settings_section” for each!
        foreach ($settings_output['plants_page_sections'] as $id => $title) {
            add_settings_section($id, $title, '', get_page_path());
        }
        // call the add_settings_field for each!
        foreach ($settings_output['plants_page_fields'] as $field) {
            add_settings_field($field['id'], $field["title"], $field["callback"], get_page_path(), $field["section"]);
        }
    }
}




// Hooks section

add_action('admin_menu', 'plants_add_menu');
add_action('admin_init', 'plants_register_settings');

// Includes section
require_once 'lib/fields.php'; 
require_once 'lib/theme-options.php';
require_once 'lib/settings-page.php';
