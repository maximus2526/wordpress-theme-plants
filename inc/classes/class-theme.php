<?php
/**
 * Bootstraps the Theme.
 *
 * @package THEME
 */

namespace PLANTS\Inc;

use PLANTS\Inc\Traits\Singleton;

class THEME {
	use Singleton;

	protected function __construct() {

		// Load class.
		Assets::get_instance();
		$this->setup_hooks();
	}

	protected function setup_hooks() {

		/**
		 * Actions.
		 */
		add_action( 'after_setup_theme', [ $this, 'setup_theme' ] );

	}

	/**
	 * Setup theme.
	 *
	 * @return void
	 */
	public function setup_theme() {

		/**
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );
		add_theme_support( 'menus' );
		add_theme_support( 'widgets' );
		add_theme_support( 'widgets-block-editor' );
		add_theme_support( 'elementor' );
		add_theme_support( 'header-footer-elementor' );
	}

}
