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
		add_action( 'add_meta_boxes', ( array( $this, 'add_metabox' ) ) );
		add_action( 'save_post', array( $this, 'save_meta' ), 10, 2 );
	}

	/**
	 * Add_metabox.
	 *
	 * @return void
	 */
	public function add_metabox() {
		add_meta_box(
			'plant_disable_elements_metabox',
			esc_html__( 'Display Control', 'plants' ),
			array( $this, 'disabler_metabox_callback' ),
			array( 'post', 'page', 'product' ),
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
		$post_id = $post->ID;
		wp_nonce_field( 'postsettingsupdate-' . $post_id, '_nonce' );

		$disable_list = array(
			'disable_header'  => get_post_meta( $post->ID, 'disable_header', true ),
			'disable_footer'  => get_post_meta( $post->ID, 'disable_footer', true ),
			'disable_sidebar' => get_post_meta( $post->ID, 'disable_sidebar', true ),
		);

		?>
		<table class="form-table">
			<tbody>
			<?php foreach ( $disable_list as $key => $value ) : ?>
				<tr>
					<th><?php echo esc_html__( 'Disable Header', 'plants' ); ?></th>
					<td>
						<label><input type="checkbox" name="<?php echo esc_html( $key ); ?>" <?php checked( 'on', esc_html( $value ) ); ?> /> <?php echo esc_html__( ' Yes', 'plants' ); ?></label>
					</td>
				</tr>
			<?php endforeach; ?>
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
		$disable_list = array(
			'disable_header',
			'disable_footer',
			'disable_sidebar',
		);
		foreach ( $disable_list as $disable_item ) {
			if ( isset( $_POST[ $disable_item ] ) ) {
				update_post_meta( $post_id, $disable_item, sanitize_text_field( isset( $_POST[ $disable_item ] ) ? wp_unslash( $_POST[ $disable_item ] ) : '' ) );
			} else {
				delete_post_meta( $post_id, 'disable_header' );
			}
		}

		return $post_id;
	}
}
