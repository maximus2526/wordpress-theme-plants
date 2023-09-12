<?php
/**
 * Display categories menus
 *
 * @package  plants
 * @author   Maxim Kliakhin
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://www.hashbangcode.com/
 */

use \Elementor\Utils;
use \Elementor\Controls_Manager;
use \Elementor\Widget_Base;

/**
 * Categories_Menus_Widget
 */
class Categories_Menus_Widget extends Widget_Base {

	/**
	 * Get_name.
	 *
	 * @return string
	 */
	public function get_name() {
		return esc_html__( 'categories_menus_widget', 'plants' );
	}

	/**
	 * Get_title.
	 *
	 * @return string
	 */
	public function get_title() {
		return esc_html__( 'Categories Menus Widget', 'plants' );
	}

	/**
	 * Get_icon.
	 *
	 * @return string
	 */
	public function get_icon() {
		return esc_html( 'eicon-library-save' );
	}

	/**
	 * Get_categories.
	 *
	 * @return array
	 */
	public function get_categories() {
		return array( 'theme-widgets' );
	}

	/**
	 * _register_controls
	 *
	 * @return void
	 */
	protected function _register_controls() { // phpcs:ignore
		$this->start_controls_section(
			'display_category_menu',
			array(
				'label' => esc_html__( 'Display Categories Menu', 'plants' ),
			)
		);

		$this->add_control(
			'menus',
			array(
				'label'   => esc_html__( 'Choice Menu', 'plants' ),
				'type'    => Controls_Manager::SELECT,
				'options' => $this->get_menus_names(),
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Render.
	 *
	 * @return void
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		wp_nav_menu(
			array(
				'menu'       => $this->get_menus_names()[ $settings['menus'] ] ?? $this->get_menus_names()[0],
				'menu_class' => 'scheme-dark ',
			),
		);
	}

		/**
		 * Get_menus_names.
		 *
		 * @return array
		 */
	protected function get_menus_names() {
		$menus      = wp_get_nav_menus();
		$menu_names = array();
		foreach ( $menus as $menu ) {
			$menu_names[] = $menu->name;
		}

		return $menu_names;
	}
}

