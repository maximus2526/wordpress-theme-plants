<?php
/**
 * Theme adding support
 *
 * @package  plants
 * @author   Maxim Kliakhin
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://www.hashbangcode.com/
 */

namespace PLANTS\Inc;

use PLANTS\Inc\Traits\Singleton;
/**
 * THEME
 */
class THEME {

	use Singleton;

	/**
	 * __construct
	 *
	 * @return void
	 */
	protected function __construct() {
		// Load class.
		$this->setup_hooks();
	}

	/**
	 * Setup_hooks.
	 *
	 * @return void
	 */
	protected function setup_hooks() {
		/**
		 * Actions.
		 */
		add_action( 'after_setup_theme', array( $this, 'setup_theme' ) );
		add_action( 'after_setup_theme', array( $this, 'true_load_theme_textdomain' ) );

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

		add_theme_support( 'custom-logo' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'widgets' );
		add_theme_support( 'widgets-block-editor' );
		add_theme_support( 'elementor' );
		add_theme_support( 'header-footer-elementor' );
		add_theme_support( 'automatic-feed-links' );
	}

	/**
	 * True_load_theme_textdomain.
	 *
	 * @return void
	 */
	public function true_load_theme_textdomain() {
		load_theme_textdomain( 'plants', get_template_directory() . '/languages' );
	}
}
