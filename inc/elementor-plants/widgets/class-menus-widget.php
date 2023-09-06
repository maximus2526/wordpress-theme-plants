<?php
/**
 * Display menus in diferent orientation and signs
 *
 * @package  plants
 * @author   Maxim Kliakhin
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://www.hashbangcode.com/
 */

use \Elementor\Controls_Manager;

/**
 * Menus_Widget
 */
class Menus_Widget extends \Elementor\Widget_Base {


	/**
	 * Get_name.
	 *
	 * @return string
	 */
	public function get_name() {
		return esc_html__( 'menus_widget', 'plants' );
	}

	/**
	 * Get_title.
	 *
	 * @return string
	 */
	public function get_title() {
		return esc_html__( 'Menus Widget', 'plants' );
	}

	/**
	 * Get_icon.
	 *
	 * @return string
	 */
	public function get_icon() {
		return esc_html( 'eicon-menu-bar' );
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
	protected function _register_controls() {
		$this->start_controls_section(
			'section_content',
			array(
				'label' => esc_html__( 'Content', 'plants' ),
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
		$this->add_control(
			'vertical',
			array(
				'label'   => esc_html__( 'Vertical', 'plants' ),
				'type'    => Controls_Manager::SWITCHER,
				'options' => array(
					'no'  => false,
					'yes' => true,
				),
				'default' => 'no',
			)
		);

		$this->add_control(
			'with_signs',
			array(
				'label'   => esc_html__( 'With Signs', 'plants' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'no'  => false,
					'yes' => true,
				),
				'default' => 'no',
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
				'menu'       => $this->get_menus_names()[ $settings['menus'] ],
				'menu_class' => 'scheme-dark ' . ( 'no' === $settings['vertical'] ? 'display-flex gap' : 'vertical-nav' ) . ( 'no' === $settings['with_signs'] ? '' : ' menu-sign vertical-nav-item nav-img' ),
			)
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
