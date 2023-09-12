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
class Admin_Menu_Fields {

	use Singleton;

	/**
	 *  Field_Keys.
	 *
	 *  @var array $field_keys Field Keys.
	 */
	public $field_keys = array(
		'menus-selection' => array(
			'title' => 'Select menu for dropdown',
		),
	);

	/**
	 *  Menu Items Data Transit Property.
	 *
	 *  @var array $selected_items_data Items Data.
	 */
	public $selected_items_data = array();

	/**
	 * Init.
	 *
	 * @return void
	 */
	public function init() {

		if ( is_admin() ) {
			add_action( 'wp_nav_menu_item_custom_fields', array( $this, 'add_fileds' ), 10, 2 );
			add_action( 'wp_update_nav_menu_item', array( $this, 'save_fields' ), 10, 2 );
		}
	}

	/**
	 * Add_fileds.
	 *
	 * @param  int $item_id Item_Id.
	 * @return void
	 */
	public function add_fileds( $item_id ) {
		foreach ( $this->field_keys as $meta_key => $data ) {
			$value      = get_post_meta( $item_id, $meta_key, true ) ?? 'None';
			$title      = $data['title'];
			$menus_list = plants_get_menus_names();
			?>
			<p class="field-<?php echo esc_html( $meta_key ); ?> description">
				<?php echo esc_html( $title ); ?>
				<br />
				<select class="widefat edit-menu-item-<?php echo esc_html( $meta_key ); ?>" name="<?php echo sprintf( '%s[%s]', esc_attr( $meta_key ), esc_attr( $item_id ) ); ?>" id="menu-item-<?php echo esc_attr( $item_id ); ?>">
					<option value="None" <?php selected( 'None', $value ); ?>><?php echo esc_html( 'None' ); ?></option>
					<?php foreach ( $menus_list as $menu ) : ?>
						<option value="<?php echo esc_html( $menu ); ?>" <?php selected( $menu, $value ); ?>><?php echo esc_html( $menu ); ?></option>
					<?php endforeach; ?>
				</select>
			</p>
			<?php
			if ( 'None' !== $value ) {
				$this->selected_items_data[ $item_id ] = $value;
			}
		}
	}



	/**
	 * Dropdown Data Getter.
	 *
	 * @return array || @return null
	 */
	public function dropdown_data_getter() {
		return $this->selected_items_data ?? null;
	}

	/**
	 * Save_fields.
	 *
	 * @param  int $menu_id menu_id.
	 * @param  int $item_id Item_id.
	 * @return void
	 */
	public function save_fields( $menu_id, $item_id ) {

		foreach ( $this->field_keys as $meta_key => $data ) {
			$this->save_field( $menu_id, $item_id, $meta_key );
		}
	}


	/**
	 * Save_Field.
	 *
	 * @param  int    $menu_id menu_id.
	 * @param  int    $item_id item_id.
	 * @param  string $meta_key meta_key.
	 * @return void
	 */
	private function save_field( $menu_id, $item_id, $meta_key ) {
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
}
