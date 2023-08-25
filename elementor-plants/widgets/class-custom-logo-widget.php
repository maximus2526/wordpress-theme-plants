<?php
/**
 * Display logo from custom logo or uploaded in interface
 *
 * @package  plants
 * @author   Maxim Kliakhin
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://www.hashbangcode.com/
 */

use \Elementor\Controls_Manager;
/**
 * Custom_Logo_Widget
 */
class Custom_Logo_Widget extends \Elementor\Widget_Base {

	/**
	 * Get_name.
	 *
	 * @return string
	 */
	public function get_name() {
		return esc_html( 'logo_widget' );
	}

	/**
	 * Get_title.
	 *
	 * @return string
	 */
	public function get_title() {
		return esc_html__( 'Logo Widget', 'elementor-addon' );
	}

	/**
	 * Get_icon.
	 *
	 * @return text
	 */
	public function get_icon() {
		return 'eicon-logo';
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
			'image',
			array(
				'label'   => esc_html__( 'Choose Image', 'textdomain' ),
				'type'    => \Elementor\Controls_Manager::MEDIA,
				'default' => array(
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				),
			)
		);

		$this->add_group_control(
			\Elementor\Group_Control_Image_Size::get_type(),
			array(
				'name'    => 'thumbnail',
				'exclude' => array( 'custom' ),
				'include' => array(),
				'default' => 'large',
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
		if ( 'upload' === $settings['choice'] ) {
			echo wp_kses( \Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'image' ), true );
		} else {
			the_custom_logo();
		}
	}
}


