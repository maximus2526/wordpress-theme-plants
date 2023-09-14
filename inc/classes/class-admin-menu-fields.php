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
		$this->field_keys = array( 'menus-selection' => array( 'title' => esc_html__( 'Select html block for header menu option', 'plants' ) ) );
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
		$img_id       = (int) get_post_meta( $post->ID, 'menu_icon_id', true );
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
	 * Add_fields.
	 *
	 * @param  int    $item_id Item_Id.
	 * @param  object $item_obj Item_obj.
	 * @return void
	 */
	public function add_fields( $item_id, $item_obj ) {
		$meta_key         = key( $this->field_keys );
		$data             = $this->field_keys[ $meta_key ];
		$value            = get_post_meta( $item_id, $meta_key, true ) ?? 'None';
		$title            = $data['title'];
		$html_blocks_data = plants_get_html_blocks_data();
		?>
		<div class="field-<?php echo esc_html( $meta_key ); ?> html-block-field">
			<?php echo esc_html( $title ); ?>
			<br />
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
		
		<div class="field-<?php echo esc_html( $meta_key ); ?> upload-icon-field">
			<div class="field-title">
				<span><?php echo esc_html__( 'Choice menu item icon:', 'plants' ); ?></span>
				<?php
				$img_id = (int) get_post_meta( $item_id, 'menu_icon_id', true );
				$img    = wp_get_attachment_image( $img_id, array( 100, 100 ) );
				if ( isset( $_POST['remove-img'] ) ) {
					delete_post_meta( $item_id, 'menu_icon_id' );
					wp_delete_attachment( $img_id );
					unset( $img );
				}
				?>
			</div>
			<?php

			if ( $img_id && ! isset( $_POST['remove-img'] ) && ! isset( $_POST['change-img'] ) ) {
				echo wp_kses_post( $img );
				?>
			<button name="change-img" class="button-link"><?php echo esc_html__( 'Change image', 'plants' ); ?></button>
			<span><?php echo esc_html( ' | ' ); ?></span>
			<button name="remove-img" class="button-link"><?php echo esc_html__( 'Remove image', 'plants' ); ?></button>
				<?php
			} else {

				if ( isset( $img ) ) {
					echo wp_kses_post( $img );
					?>
					<?php
				}
				?>
				<input type="file" name="<?php echo 'menus-icon-' . (int) $item_id; ?>" accept="image/*">
				<?php
			}

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
		if ( isset( $_FILES[ 'menus-icon-' . $item_id ] ) ) {
			$img_id = media_handle_upload( 'menus-icon-' . $item_id, $item_id ); // Add the file to the media library.

			if ( ! is_wp_error( $img_id ) ) {
				update_post_meta( $item_id, 'menu_icon_id', $img_id ); // Save the img/attachment ID in a post meta.
			}
		}
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
