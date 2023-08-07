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
class Menus_Widget extends \Elementor\Widget_Base {

	/**
	 * get_name
	 *
	 * @return void
	 */
	public function get_name() {
		return esc_html( 'menus_widget', 'plants' );
	}

	/**
	 * get_title
	 *
	 * @return void
	 */
	public function get_title() {
		return esc_html__( 'Menus Widget', 'elementor-addon' );
	}

	/**
	 * get_icon
	 *
	 * @return void
	 */
	public function get_icon() {
		return 'eicon-menu-bar';
	}

	/**
	 * get_categories
	 *
	 * @return void
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
				'label' => esc_html__( 'Content', 'elementor-addon' ),
			)
		);

		$this->add_control(
			'menus',
			array(
				'label'   => esc_html__( 'Choice Menu', 'elementor-addon' ),
				'type'    => Controls_Manager::SELECT,
				'options' => $this->get_menus_names(),
			)
		);
		$this->add_control(
			'vertical',
			array(
				'label'   => esc_html__( 'Vertical', 'elementor-addon' ),
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
				'label'   => esc_html__( 'With Signs', 'elementor-addon' ),
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
	 * render
	 *
	 * @return void
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
			wp_nav_menu(
				array(
					'menu'       => $this->get_menus_names()[ $settings['menus'] ],
					'menu_class' => 'scheme-dark ' . ( $settings['vertical'] === 'no' ? 'display-flex gap' : 'vertical-nav' ) . ( $settings['with_signs'] === 'no' ? '' : ' menu-sign vertical-nav-item nav-img' ),
				)
			);
	}

	/**
	 * get_menus_names
	 *
	 * @return void
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
