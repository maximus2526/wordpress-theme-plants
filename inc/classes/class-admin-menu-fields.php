<?php
/**
 * Admin_Nav_Menu_Fields
 *
 * @package plants
 * @author  Maxim Kliakhin
 * @license http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link    http://www.hashbangcode.com/
 */

namespace PLANTS\Inc;

use PLANTS\Inc\Traits\Singleton;
/**
 * Admin_Menu_Fields
 */
final class Admin_Menu_Fields {
	use Singleton;

	public static array $field_keys = array(

		'_menu_item_svg_icon'   => array(
			'title' => 'SVG Icon Name',
			'desc'  => 'Set svg icon name (not url)',
		),

		'test_number_field'     => array(
			'title' => 'Number One',
			'type'  => 'number',
			'size'  => 'thin', // thin | wide
			// 'desc' => 'some text',
		),

		'test_number_field_two' => array(
			'title' => 'Number Two',
			'type'  => 'number',
			'size'  => 'thin', // thin | wide
			// 'desc' => 'some text',
		),

	);

	public static function init(): void {

		if ( is_admin() ) {
			add_action( 'wp_nav_menu_item_custom_fields', array( __CLASS__, 'add_fileds' ), 10, 2 );
			add_action( 'wp_update_nav_menu_item', array( __CLASS__, 'save_fields' ), 10, 2 );
		}
		// front
		else {
			add_filter( 'walker_nav_menu_start_el', array( __CLASS__, 'nav_menu_start_el' ), 10, 2 );
			add_filter( 'wp_nav_menu_args', array( __CLASS__, 'nav_menu_args' ) );
		}

	}

	public static function add_fileds( $item_id, $item ) {

		foreach ( self::$field_keys as $meta_key => $data ) {

			$value = get_post_meta( $item_id, $meta_key, true );
			$title = $data['title'];
			$type  = $data['type'] ?? 'text';
			$size  = $data['size'] ?? 'wide';

			$desc = empty( $data['desc'] ) ? '' : '<span class="description">' . $data['desc'] . '</span>';
			?>
			<p class="field-<?php echo $meta_key; ?> description description-<?php echo $size; ?>">
				<?php echo $title; ?>
				<br/>
				<input class="widefat edit-menu-item-<?php echo $meta_key; ?>"
					   type="<?php echo $type; ?>"
					   name="<?php echo sprintf( '%s[%s]', $meta_key, $item_id ); ?>"
					   id="menu-item-<?php echo $item_id; ?>"
					   value="<?php echo esc_attr( $value ); ?>"/>

				<?php echo $desc; ?>
			</p>
			<?php
		}
	}

	public static function save_fields( $menu_id, $item_id ) {

		foreach ( self::$field_keys as $meta_key => $data ) {
			self::save_field( $menu_id, $item_id, $meta_key );
		}
	}

	private static function save_field( $menu_id, $item_id, $meta_key ) {

		if ( ! isset( $_POST[ $meta_key ][ $item_id ] ) ) {
			return;
		}

		$val = $_POST[ $meta_key ][ $item_id ];

		if ( $val ) {
			update_post_meta( $item_id, $meta_key, sanitize_text_field( $val ) );
		} else {
			delete_post_meta( $item_id, $meta_key );
		}

	}

	public static function nav_menu_start_el( $item_output, $post ) {

		$svg = $post->_menu_item_svg_icon ?: '';
		if ( $svg ) {
			$svg = get_svg( $svg );
		}

		return str_replace( '{SVG}', $svg, $item_output );
	}

	public static function nav_menu_args( $args ) {

		if ( empty( $args['link_before'] ) ) {
			$args['link_before'] = '{SVG}';
		}

		return $args;
	}

}
