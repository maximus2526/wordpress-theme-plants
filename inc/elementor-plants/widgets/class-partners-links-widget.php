<?php
/**
 * Display partners icons with uses Reapeater
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
 * Partners_Links_Widget
 */
class Partners_Links_Widget extends Widget_Base {

	/**
	 * Get_name.
	 *
	 * @return string
	 */
	public function get_name() {
		return esc_html__( 'partners_links_widget', 'plants' );
	}

	/**
	 * Get_title.
	 *
	 * @return string
	 */
	public function get_title() {
		return esc_html__( 'Partners Links Widget', 'plants' );
	}

	/**
	 * Get_icon.
	 *
	 * @return string
	 */
	public function get_icon() {
		return esc_html( 'eicon-device-mobile' );
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
			'img_size',
			array(
				'label' => esc_html__( 'Size', 'plants' ),
			)
		);

		$this->add_control(
			'width',
			array(
				'label'   => esc_html__( 'Width', 'plants' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '60px',
			)
		);
		$this->add_control(
			'height',
			array(
				'label'   => esc_html__( 'Height', 'plants' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '40px',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_partner_links',
			array(
				'label' => esc_html__( 'Partner Links', 'plants' ),
			)
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'partner_url',
			array(
				'label'         => esc_html( 'URL' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => esc_url( 'https://your-partner-url.com' ),
				'show_external' => true,
				'default'       => array(
					'url'         => '',
					'is_external' => true,
				),
				'label_block'   => true,
			)
		);

		$repeater->add_control(
			'partner_img',
			array(
				'label'   => esc_html__( 'Choose Image', 'plants' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => Utils::get_placeholder_image_src(),
				),
			)
		);

		$this->add_control(
			'partner_links_list',
			array(
				'label'   => esc_html__( 'Social Links List', 'plants' ),
				'type'    => Controls_Manager::REPEATER,
				'fields'  => $repeater->get_controls(),
				'default' => array(
					array(
						'social_url'          => array(
							'url'         => 'https://www.facebook.com/',
							'is_external' => true,
						),
						'social_abbreviation' => 'FB',
					),
				),
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
		$width    = $settings['width'];
		$height   = $settings['height'];
		echo '<div class="display-flex gap">';
		if ( $settings['partner_links_list'] ) {
			foreach ( $settings['partner_links_list'] as $link ) {

				$url       = $link['partner_url']['url'];
				$image_url = $link['partner_img']['url'];
				echo '<a href="' . esc_url( $url ) . '"><img style="width: ' . esc_html( $width ) . '; height: ' . esc_html( $height ) . ';" src="' . esc_url( $image_url ) . '"></a>';
			}
		}
		echo '</div>';
	}
}
