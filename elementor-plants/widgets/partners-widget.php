<?php
/**
 * Display partners icons with uses Reapeater
 *
 * @package  plants
 * @author   Maxim Kliakhin
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://www.hashbangcode.com/
 */

/**
 * Partners_Links_Widget
 */

use \Elementor\Controls_Manager;
use \Elementor\Utils;

class Partners_Links_Widget extends \Elementor\Widget_Base {
	/**
	 * get_name
	 *
	 * @return void
	 */
	public function get_name() {
		return esc_html( 'partners_links_widget', 'plants' );
	}

	/**
	 * get_title
	 *
	 * @return void
	 */
	public function get_title() {
		return esc_html__( 'Partners Links Widget', 'plants' );
	}

	/**
	 * get_icon
	 *
	 * @return void
	 */
	public function get_icon() {
		return 'eicon-device-mobile';
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
			'img_size',
			array(
				'label' => esc_html__( 'Size', 'plants' ),
			)
		);

		$this->add_control(
			'width',
			array(
				'label'   => esc_html__( 'Width', 'elementor-addon' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '60px',
			)
		);
		$this->add_control(
			'height',
			array(
				'label'   => esc_html__( 'Height', 'elementor-addon' ),
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
				'label'         => esc_html__( 'URL', 'plants' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => esc_html__( 'https://your-partner-url.com', 'plants' ),
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
				'label'   => esc_html__( 'Choose Image', 'elementor-addon' ),
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
	 * render
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
				echo '<a href="' . esc_url( $url ) . '"><img style="width: ' . esc_html( $width, 'plants' ) . '; height: ' . esc_html( $height, 'plants' ) . ';" src="' . esc_url( $image_url ) . '"></a>';
			}
		}
		echo '</div>';
	}

}

