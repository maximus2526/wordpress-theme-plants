<?php
/**
 * Bootstraps the Theme.
 *
 * @package THEME
 */

namespace PLANTS\Inc;

use PLANTS\Inc\Traits\Singleton;

class Menus {
	use Singleton;

	protected function __construct() {
		Menus::get_instance();
		$this->setup_hooks();
	
	}

	protected function setup_hooks() {
        add_action( 'init', 'register_my_menus' );
	}

    function register_my_menus() {
        register_nav_menus(
          array(
            'header-menu' => __( 'Header Menu' ),
            'extra-menu' => __( 'Extra Menu' )
           )
         );
       }
       
	/**
	 * Setup theme.
	 *
	 * @return void
	 */
	public function setup_theme() {

	

	}

}
