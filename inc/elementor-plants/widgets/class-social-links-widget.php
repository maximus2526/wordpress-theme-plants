<?php
/**
 * Display social icons with uses Reapeater
 *
 * @package  plants
 * @author   Maxim Kliakhin
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://www.hashbangcode.com/
 */

use \Elementor\Controls_Manager;

/**
 * Social_Links_Widget
 */
class Social_Links_Widget extends \Elementor\Widget_Base {


	/**
	 * Get_name.
	 *
	 * @return string
	 */
	public function get_name() {
		return esc_html__( 'social_links_widget', 'plants' );
	}

	/**
	 * Get_title.
	 *
	 * @return string
	 */
	public function get_title() {
		return esc_html__( 'Social Links Widget', 'plants' );
	}

	/**
	 * Get_icon.
	 *
	 * @return string
	 */
	public function get_icon() {
		return esc_html( 'eicon-social-icons' );
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
			'section_social_links',
			array(
				'label' => esc_html__( 'Social Links', 'plants' ),
			)
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'social_url',
			array(
				'label'         => esc_html__( 'URL', 'plants' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => esc_html( 'https://your-social-url.com' ),
				'show_external' => true,
				'default'       => array(
					'url'         => '',
					'is_external' => true,
				),
				'label_block'   => true,
			)
		);

		$repeater->add_control(
			'social_abbreviation',
			array(
				'label'   => esc_html__( 'Abbreviation', 'plants' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'FB',
			)
		);

		$this->add_control(
			'social_links_list',
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

		if ( empty( $settings['social_links_list'] ) ) {
			return;
		}

		echo '<div class="social">';

		foreach ( $settings['social_links_list'] as $link ) {
			$url   = $link['social_url']['url'];
			$title = $link['social_abbreviation'];
			?>
			<a href="<?php echo esc_url( $url ); ?>"><span class="social-icons"><?php echo esc_html( $title ); ?></span></a>
			<?php

		}

		echo '</div>';
	}
}
