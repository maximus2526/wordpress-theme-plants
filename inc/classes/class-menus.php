<?php
/**
 * Bootstraps the Theme.
 *
 * @package PLANTS
 */

namespace PLANTS\Inc;

use PLANTS\Inc\Traits\Singleton;

class Menus
{
    use Singleton;

    protected function __construct()
    {
        Menus::get_instance();
        $this->setup_hooks();
    
    }

    protected function setup_hooks()
    {
        add_action('init', 'register_my_menus');
    }

    function register_my_menus()
    {
        register_nav_menus(
            array(
            'header-menu' => __('header-menu'),
            )
        );
    }
       
    /**
     * Setup theme.
     *
     * @return void
     */


}
