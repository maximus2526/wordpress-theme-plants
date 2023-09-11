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
use \Elementor\Plugin as Plugin;

/**
 * Html_Block Widget
 */
class Html_Block extends \Elementor\Widget_Base {

	/**
	 * Get_name.
	 *
	 * @return string
	 */
	public function get_name() {
		return esc_html__( 'html_block', 'plants' );
	}

	/**
	 * Get_title.
	 *
	 * @return string
	 */
	public function get_title() {
		return esc_html( 'HTML' ) . esc_html__( ' Block', 'plants' );
	}

	/**
	 * Get_icon.
	 *
	 * @return text
	 */
	public function get_icon() {
		return esc_html( 'eicon-editor-h4' );
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
			'html_block_name',
			array(
				'label'   => esc_html__( 'Enter HTML-Block id:', 'plants' ),
				'type'    => Controls_Manager::SELECT,
				'options' => plants_get_html_blocks_data(),
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
		if ( $settings['html_block_name'] ) {
			$posts_id = $settings['html_block_name'];
			echo Plugin::instance()->frontend->get_builder_content( $posts_id ); // phpcs:ignore
		}
	}


}
