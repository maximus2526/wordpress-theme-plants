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
 * WooCommerce
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
		add_action( 'add_meta_boxes', ( array( $this, 'true_add_metabox' ) ) );
		add_action( 'save_post', array( $this, 'true_save_meta' ), 10, 2 );
		add_action( 'edit_attachment', array( $this, 'true_save_meta' ), 10, 2 );
		add_action( 'get_header', array( $this, 'disable_header' ), 25 );
		add_action( 'get_footer', array( $this, 'disable_footer' ), 25 );
		add_action( 'get_sidebar', array( $this, 'disable_sidebar' ), 25 );
	}

	/**
	 * True_add_metabox.
	 *
	 * @return void
	 */
	public function true_add_metabox() {
		add_meta_box(
			'disable_elements_metabox',
			'Display Control',
			array( $this, 'disabler_metabox_callback' ),
			'page',
			'normal',
			'default'
		);
	}

	/**
	 * Disabler_metabox_callback.
	 *
	 * @param  mixed $post Post.
	 * @return void
	 */
	public function disabler_metabox_callback( $post ) {
		wp_nonce_field( 'postsettingsupdate-' . $post->ID, '_truenonce' );
		$disable_header  = get_post_meta( $post->ID, 'disable_header', true );
		$disable_footer  = get_post_meta( $post->ID, 'disable_footer', true );
		$disable_sidebar = get_post_meta( $post->ID, 'disable_sidebar', true );

		?>
  <table class="form-table">
   <tbody>
	<tr>
	 <th>Disable Header</th>
	 <td>
   <label><input type="checkbox" name="disable_header" <?php checked( 'on', $disable_header, false ); ?> /> Yes</label>
	 </td>
	</tr>
	<tr>
	 <th>Disable Footer</th>
	 <td>
   <label><input type="checkbox" name="disable_footer" <?php checked( 'on', $disable_footer, false ); ?> /> Yes</label>
	 </td>
	</tr>
	<tr>
	 <th>Disable SideBar</th>
	 <td>
   <label><input type="checkbox" name="disable_sidebar" <?php checked( 'on', $disable_sidebar, false ); ?> /> Yes</label>
	 </td>
	</tr>
   </tbody>
  </table>
		<?php
	}

	/**
	 * True_save_meta.
	 *
	 * @param  mixed $post_id Post_Id.
	 * @param  mixed $post Post.
	 * @return int
	 */
	public function true_save_meta( $post_id, $post ) {
		// Проверка одноразовых полей.
		if ( ! isset( $_POST['_truenonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['_truenonce'] ) ), 'postsettingsupdate-' . $post->ID ) ) {
			return $post_id;
		}
		// Проверяем, может ли текущий юзер редактировать пост.
		$post_type = get_post_type_object( $post->post_type );

		if ( ! current_user_can( $post_type->cap->edit_post, $post_id ) ) {
			return $post_id;
		}
		// Ничего не делаем для автосохранений.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return $post_id;
		}
		// Проверяем тип записи.
		if ( 'page' !== $post->post_type ) {
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



	/**
	 * Disable_header.
	 *
	 * @return void
	 */
	public function disable_header() {
		if ( ! is_page() ) {
			return;
		}

		if ( 'on' === get_post_meta( get_the_ID(), 'disable_header', true ) ) {

		}
	}

	/**
	 * Disable_footer.
	 *
	 * @return void
	 */
	public function disable_footer() {

		if ( ! is_page() ) {
			return;
		}

		if ( 'on' === get_post_meta( get_the_ID(), 'disable_footer', true ) && is_page() ) {
			$post_id        = get_the_ID();
			$disable_header = get_post_meta( $post_id, 'disable_header', true );
			if ( $disable_header === 'on' ) {
							remove_action( 'get_header', '__return_false' );
			}
		}
	}

	/**
	 * Disable_sidebar.
	 *
	 * @return void
	 */
	public function disable_sidebar() {

		if ( ! is_page() ) {
			return;
		}
		if ( 'on' === get_post_meta( get_the_ID(), 'disable_footer', true ) && is_page() ) {
			$post_id        = get_the_ID();
			$disable_header = get_post_meta( $post_id, 'disable_header', true );
			if ( $disable_header === 'on' ) {
					remove_action( 'get_sidebar', '__return_false' );
			}
		}
	}
}
