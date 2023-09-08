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
		$social_list = array(
			'facebook'  => 'FB',
			'instagram' => 'IN',
			'twitter'   => 'TW',
			'linkedin'  => 'LI',
			'instagram' => 'IN',
		);
		foreach ( $social_list as $social_name => $abbreviation ) {

			$url          = isset( $instance[ 'social_url_' . $social_name ] ) ? $instance[ 'social_url_' . $social_name ] : '';
			?>
		<a href="<?php echo esc_url( $url ); ?>"><span class="social-icons"><?php echo esc_html( $abbreviation ); ?></span></a>
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
	// public function get_abbreviation( $link ) {
	// $abbreviation_list = array(
	// 'facebook'  => 'FB',
	// 'instagram' => 'IN',
	// 'twitter'   => 'TW',
	// 'linkedin'  => 'LI',
	// 'instagram' => 'IN',
	// );
	// $url_parts         = wp_parse_url( $link );
	// $hostname          = isset( $url_parts['host'] ) ? $url_parts['host'] : '';
	// $delete_extra      = explode( '.', $hostname )[0];
	// $abbreviation      = isset( $abbreviation_list[ $delete_extra ] ) ? $abbreviation_list[ $delete_extra ] : '';
	// return $abbreviation;
	// }

	/**
	 * Form.
	 *
	 * @param  array $instance instance.
	 * @return void
	 */
	public function form( $instance ) {
		$social_names = array( 'facebook', 'instagram', 'twitter', 'linkedin', 'instagram' );
		foreach ( $social_names as $name ) {
			$social_url = isset( $instance[ 'social_url_' . $name ] ) ? $instance[ 'social_url_' . $name ] : esc_html( 'your-site.url' );
			?>
		<span><?php echo esc_html( $name ); ?></span>
		<p>
			<label for="<?php echo esc_html( $this->get_field_id( 'social_url_' . $name ) ); ?> )"><?php echo esc_html__( 'Social url:', 'plants' ); ?></label>
			<input class="widget-field" id="<?php echo esc_html( $this->get_field_id( 'social_url_' . $name ) ); ?>" name="<?php echo esc_html( $this->get_field_name( 'social_url_' . $name ) ); ?>" type="text" value="<?php echo esc_attr( $social_url ); ?>" />
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

		$social_names = array( 'facebook', 'instagram', 'twitter', 'linkedin', 'instagram' );
		foreach ( $social_names as $name ) {
			$instance[ 'social_url_facebook' . $name ] = sanitize_text_field( $new_instance[ 'social_url_facebook' . $name ] );
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
