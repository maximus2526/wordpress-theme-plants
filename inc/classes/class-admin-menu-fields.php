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
use \Elementor\Plugin as Plugin;

/**
 * Admin_Menu_Fields
 */
class Admin_Menu_Fields {



	use Singleton;
	/**
	 * Field_list.
	 *
	 * @var array
	 */
	protected $field_keys = array();

	/**
	 *  Menu Items Data Transit Property.
	 *
	 *  @var array $selected_items_data Items Data.
	 */
	public $selected_items_data = array();


	/**
	 * __construct
	 *
	 * @return void
	 */
	protected function __construct() {
		$this->field_keys = array(
			'menus-selection' => array( 'title' => esc_html__( 'Select html block for header menu option', 'plants' ) ),
			'img-upload'      => array( 'title' => esc_html__( 'Upload or delete img for menu item', 'plants' ) ),
		);
	}

	/**
	 * Init.
	 *
	 * @return void
	 */
	public function init() {
		if ( is_admin() ) {
			add_action( 'wp_nav_menu_item_custom_fields', array( $this, 'add_fields' ), 10, 2 );
			add_action( 'wp_update_nav_menu_item', array( $this, 'save_fields' ), 10, 2 );
		} else {
			add_filter( 'walker_nav_menu_start_el', array( $this, 'nav_menu_start_el' ), 10, 2 ); // Front.
			add_filter( 'nav_menu_item_attributes', array( $this, 'nav_menu_attributes' ), 10, 2 ); // Front.
		}
	}



	/**
	 * Nav_menu_item_attributes callback.
	 *
	 * @param  object $li_atts li_atts.
	 * @param  object $menu_item menu_item.
	 * @return object
	 */
	public function nav_menu_attributes( $li_atts, $menu_item ) {
		$html_block = get_post_meta( $menu_item->ID, 'menus-selection', true );
		if ( 'none' !== $html_block && isset( $html_block ) && ! empty( $html_block ) ) {
			$li_atts['class'] .= ' dropdown-icon';
		}
		return $li_atts;
	}

	/**
	 * Nav_menu_start_el callback.
	 *
	 * @param  object $item_output Item_output.
	 * @param  object $post Post.
	 * @return object
	 */
	public function nav_menu_start_el( $item_output, $post ) {
		$img_id       = (int) get_post_meta( $post->ID, 'img-upload', true );
		$html_block   = get_post_meta( $post->ID, 'menus-selection', true );
		$item_output .= wp_get_attachment_image( $img_id, array( 20, 20 ) );
		if ( 'none' !== $html_block && isset( $html_block ) && ! empty( $html_block ) ) {
			$item_output .= '<div data-id="' . (int) $post->ID . '" class="scheme-dark menus-item-dropdown-section">';
			if ( is_plugin_active( 'elementor/elementor.php' ) ) {
				$item_output .= Plugin::instance()->frontend->get_builder_content($html_block); // phpcs:ignore
			} else {
				$post         = get_post( $html_block );
				$item_output .= wp_kses_post( $post->post_content );
			}
			$item_output .= '</div>';
		}
		return $item_output;
	}


	/**
	 * Image_uploader_field.
	 *
	 * @param  string $name name.
	 * @param  string $value value.
	 * @return void
	 */
	public function image_uploader_field( $name, $value = '' ) {
		echo '
		<div class="description description-wide">
						<div class="attachment-control">
										' . wp_get_attachment_image( $value, array( 50, 50 ) ) . '
										<input type="hidden" name="' . esc_attr( $name ) . '" id="' . esc_attr( $name ) . '" value="' . esc_attr( $value ) . '" />
										<button type="submit" class="upload_image_button button"> ' . esc_html__( 'Upload', 'plants' ) . ' </button>';
		if ( $value ) {
			echo '<button type="submit" class="remove_image_button button-link">' . esc_html__( ' Remove', 'plants' ) . '</button>
						</div>
		</div>
		';
		}

	}
	/**
	 * Add_fields.
	 *
	 * @param  int    $item_id Item_Id.
	 * @param  object $item_obj Item_obj.
	 * @return void
	 */
	public function add_fields( $item_id, $item_obj ) {
		$meta_key         = key( $this->field_keys );
		$value            = get_post_meta( $item_id, $meta_key, true ) ?? 'None';
		$html_blocks_data = plants_get_html_blocks_data();
		$img_id           = get_post_meta( $item_id, 'img-upload', true );

		?>
		<div class=" description description-wide field-<?php echo esc_html( $meta_key ); ?> html-block-field">
			<span class="field-menus-title">
				<?php echo esc_html( $this->field_keys['menus-selection']['title'] ); ?>
			</span>

			<select class="widefat edit-menu-item-<?php echo esc_html( $meta_key ); ?>" name="<?php echo sprintf( '%s[%s]', esc_attr( $meta_key ), esc_attr( $item_id ) ); ?>" id="menu-item-<?php echo esc_attr( $item_id ); ?>">
				<option value="none" <?php selected( 'none', $value ); ?>><?php echo esc_html( 'None' ); ?></option>
				<?php
				foreach ( $html_blocks_data as $block_id => $html_block ) :
					?>
					<option value="<?php echo esc_html( $block_id ); ?>" <?php selected( $block_id, $value ); ?>><?php echo esc_html( $html_block ); ?></option>
					<?php
				endforeach;
				?>
			</select>
		</div>
		<div class="description description-wide field-<?php echo esc_html( $meta_key ); ?> upload-icon-field">
			<span class="field-menus-title">
			<?php
			echo esc_html( $this->field_keys['img-upload']['title'] );
			?>
			</span>
			<?php
			$this->image_uploader_field( sprintf( '%s[%s]', esc_attr( 'img-upload' ), esc_attr( $item_id ) ), $img_id ?? 'None' );
			?>


		</div> 
		<?php
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
		if (!isset($_POST[$meta_key][$item_id])) { // phpcs:ignore
			return;
		}

		$val = $_POST[$meta_key][$item_id]; // phpcs:ignore

		if ( $val ) {
			update_post_meta( $item_id, $meta_key, sanitize_text_field( $val ) );
		} else {
			delete_post_meta( $item_id, $meta_key );
		}
	}
}


?>
