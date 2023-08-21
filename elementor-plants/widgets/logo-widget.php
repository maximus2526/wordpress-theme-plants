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
			'image',
			[
				'label' => esc_html__( 'Choose Image', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
				'exclude' => [ 'custom' ],
				'include' => [],
				'default' => 'large',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		if ( $settings['choice'] === 'upload' ) {
			echo \Elementor\Group_Control_Image_Size::get_attachment_image_html($settings, 'thumbnail', 'image' );
		} else {
			the_custom_logo();
		}
	}
}


