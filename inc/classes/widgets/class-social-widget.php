<?php

/**
 * Theme adding support
 *
 * @package plants
 * @author  Maxim Kliakhin
 * @license http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link    http://www.hashbangcode.com/
 */

namespace PLANTS\Inc;

use WP_Widget;

/**
 * Social_Widget
 */
class Social_Widget extends WP_Widget {

	/**
	 * Max Social Links.
	 *
	 * @var int
	 */
	public $max_links = 5;

	/**
	 * Abbreviation_list.
	 *
	 * @var int
	 */


	/**
	 * __construct
	 *
	 * @return void
	 */
	public function __construct() {
		parent::__construct(
			// ID of widget.
			'plants_social_widget',
			// Widget name will appear in UI.
			esc_html__( 'Social Widget', 'plants' ),
			// Widget description.
			array( 'description' => esc_html__( 'Social widget', 'plants' ) )
		);
		add_action( 'widgets_init', array( $this, 'register_widgets' ) );
	}



	/**
	 * Widget.
	 *
	 * @param  array $args args.
	 * @param  array $instance instance.
	 * @return void
	 */
	public function widget( $args, $instance ) {
		echo wp_kses_post( $args['before_widget'] );
		echo '<div class="social">';
		foreach ( range( 1, $this->max_links ) as $link_id ) {
			$url_key      = 'social_url_' . (int) $link_id;
			$url          = isset( $instance[ $url_key ] ) ? $instance[ $url_key ] : '';
			$abbreviation = $this->get_abbreviation( $url ) ? $this->get_abbreviation( $url ) : esc_html( 'Invalid link' );
			$error_class  = esc_html__( 'Invalid link', 'plants' ) === $abbreviation ? 'widget-social-error' : '';
			?>
			<a href="<?php echo esc_url( $url ); ?>"><span class="social-icons <?php echo esc_html( $error_class ); ?>"><?php echo esc_html( $abbreviation ); ?></span></a>
			<?php
		}
		echo '</div>';
		echo wp_kses_post( $args['after_widget'] );
	}


	/**
	 * Get_abbreviation.
	 *
	 * @param string $link Link.
	 * @return array
	 */
	public function get_abbreviation( $link ) {
		$abbreviation_list = array(
			'facebook'  => 'FB',
			'instagram' => 'IN',
			'twitter'   => 'TW',
			'linkedin'  => 'LI',
			'instagram' => 'IN',
		);
		$url_parts         = wp_parse_url( $link );
		$hostname          = isset( $url_parts['host'] ) ? $url_parts['host'] : '';
		$delete_extra      = explode( '.', $hostname )[0];
		$abbreviation      = isset( $abbreviation_list[ $delete_extra ] ) ? $abbreviation_list[ $delete_extra ] : '';
		return $abbreviation;
	}

	/**
	 * Form.
	 *
	 * @param  array $instance instance.
	 * @return void
	 */
	public function form( $instance ) {
		foreach ( range( 1, $this->max_links ) as $link_id ) {
			$url_key    = 'social_url_' . (int) $link_id;
			$social_url = isset( $instance[ $url_key ] ) ? $instance[ $url_key ] : esc_html( 'your-site.url' );
			?>
			<span><?php echo esc_html__( 'Link id: ', 'plants' ) . esc_html( $link_id ); ?></span>
			<p>
				<label for="<?php echo esc_html( $this->get_field_id( $url_key ) ); ?> )"><?php echo esc_html__( 'Social url:', 'plants' ); ?></label>
				<input class="widget-field" id="<?php echo esc_html( $this->get_field_id( $url_key ) ); ?>" name="<?php echo esc_html( $this->get_field_name( $url_key ) ); ?>" type="text" value="<?php echo esc_attr( $social_url ); ?>" />
			</p>
			<?php
		}
	}


	/**
	 * Update.
	 *
	 * @param  array $new_instance new_instance.
	 * @param  array $old_instance old_instance.
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();

		foreach ( range( 1, $this->max_links ) as $link_id ) {
			$url_key              = 'social_url_' . (int) $link_id;
			$instance[ $url_key ] = sanitize_text_field( $new_instance[ $url_key ] );
		}

		return $instance;
	}

	/**
	 * Register Widgets.
	 *
	 * @return void
	 */
	public function register_widgets() {
		register_widget( __CLASS__ );
	}
}
