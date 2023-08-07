<?php
/**
 * Display logo from custom logo or uploaded in interface
 *
 * @package  plants
 * @author   Maxim Kliakhin
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://www.hashbangcode.com/
 */

/**
 * Custom_Logo_Widget
 */
use \Elementor\Controls_Manager;
use \Elementor\Utils;
class Custom_Logo_Widget extends \Elementor\Widget_Base {

	/**
	 * get_name
	 *
	 * @return void
	 */
	public function get_name() {
		return esc_html( 'logo_widget', 'plants' );
	}

	/**
	 * get_title
	 *
	 * @return void
	 */
	public function get_title() {
		return esc_html__( 'Logo Widget', 'elementor-addon' );
	}

	/**
	 * get_icon
	 *
	 * @return void
	 */
	public function get_icon() {
		return 'eicon-logo';
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
			'choice',
			array(
				'label'   => esc_html__( 'Choose Image:', 'elementor-addon' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'default' => 'Default',
					'upload'  => 'Upload',
				),
				'default' => 'default',
			)
		);

		$this->add_control(
			'upload_image',
			array(
				'label'      => esc_html__( 'Choose Image', 'elementor-addon' ),
				'type'       => Controls_Manager::MEDIA,
				'media_type' => 'image',
				'condition'  => array(
					'choice' => 'upload',
				),
				'default'    => array(
					'url' => Utils::get_placeholder_image_src(),
				),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		if ( $settings['choice'] === 'upload' ) {
			echo '<img src="' . $settings['upload_image']['url'] . '">';  // Todo: переробити без Img
		} else {
			the_custom_logo();
		}
	}
}
