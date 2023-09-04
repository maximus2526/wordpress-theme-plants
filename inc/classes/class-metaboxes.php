<?php
/**
 * MetaBoxes support.
 *
 * @package  plants
 * @author   Maxim Kliakhin
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://www.hashbangcode.com/
 */

namespace PLANTS\Inc;

use PLANTS\Inc\Traits\Singleton;

/**
 * MetaBoxes
 */
class MetaBoxes {




	use Singleton;

	/**
	 * __construct
	 *
	 * @return void
	 */
	protected function __construct() {
		$this->setup_hooks();
	}

	/**
	 * Setup_hooks.
	 *
	 * @return void
	 */
	protected function setup_hooks() {
		add_action( 'add_meta_boxes', ( array( $this, 'add_metabox' ) ) );
		add_action( 'save_post', array( $this, 'save_meta' ), 10, 2 );
		add_action( 'edit_attachment', array( $this, 'save_meta' ), 10, 2 );
	}

	/**
	 * Add_metabox.
	 *
	 * @return void
	 */
	public function add_metabox() {
		add_meta_box(
			'disable_elements_metabox',
			'Display Control',
			array( $this, 'disabler_metabox_callback' ),
			array( 'post', 'page' ),
			'normal',
			'default'
		);
	}

	/**
	 * Disabler_metabox_callback.
	 *
	 * @param  object $post Post.
	 * @return void
	 */
	public function disabler_metabox_callback( $post ) {
		wp_nonce_field( 'postsettingsupdate-' . $post->ID, '_nonce' );
		$disable_header  = get_post_meta( $post->ID, 'disable_header', true );
		$disable_footer  = get_post_meta( $post->ID, 'disable_footer', true );
		$disable_sidebar = get_post_meta( $post->ID, 'disable_sidebar', true );

		?>
		<table class="form-table">
			<tbody>
				<tr>
					<th>Disable Header</th>
					<td>
						<label><input type="checkbox" name="disable_header" <?php checked( 'on', $disable_header ); ?> /> Yes</label>
					</td>
				</tr>
				<tr>
					<th>Disable Footer</th>
					<td>
						<label><input type="checkbox" name="disable_footer" <?php checked( 'on', $disable_footer ); ?> /> Yes</label>
					</td>
				</tr>
				<tr>
					<th>Disable SideBar</th>
					<td>
						<label><input type="checkbox" name="disable_sidebar" <?php checked( 'on', $disable_sidebar ); ?> /> Yes</label>
					</td>
				</tr>
			</tbody>
		</table>
		<?php
	}

	/**
	 * Save_meta.
	 *
	 * @param  int    $post_id Post_Id.
	 * @param  object $post Post.
	 * @return int
	 */
	public function save_meta( $post_id, $post ) {
		if ( ! isset( $_POST['_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['_nonce'] ) ), 'postsettingsupdate-' . $post->ID ) ) {
			return $post_id;
		}

		$post_type = get_post_type_object( $post->post_type );

		if ( ! current_user_can( $post_type->cap->edit_post, $post_id ) ) {
			return $post_id;
		}
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return $post_id;
		}

		if ( isset( $_POST['disable_header'] ) ) {
			update_post_meta( $post_id, 'disable_header', sanitize_text_field( isset( $_POST['disable_header'] ) ? wp_unslash( $_POST['disable_header'] ) : '' ) );
		} else {
			delete_post_meta( $post_id, 'disable_header' );
		}

		if ( isset( $_POST['disable_footer'] ) ) {
			update_post_meta( $post_id, 'disable_footer', sanitize_text_field( isset( $_POST['disable_footer'] ) ? wp_unslash( $_POST['disable_footer'] ) : '' ) );
		} else {
			delete_post_meta( $post_id, 'disable_footer' );
		}

		if ( isset( $_POST['disable_sidebar'] ) ) {
			update_post_meta( $post_id, 'disable_sidebar', sanitize_text_field( isset( $_POST['disable_sidebar'] ) ? wp_unslash( $_POST['disable_sidebar'] ) : '' ) );
		} else {
			delete_post_meta( $post_id, 'disable_sidebar' );
		}

		return $post_id;
	}
}
