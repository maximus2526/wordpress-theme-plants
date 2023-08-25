<?php
/**
 * Settings page
 *
 * @package  plants
 * @author   Maxim Kliakhin
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://www.hashbangcode.com/
 */

if ( ! function_exists( 'plants_get_page_path' ) ) {
	/**
	 * Get_page_path.
	 *
	 * @return __FILE__
	 */
	function plants_get_page_path() {
		return __FILE__;
	}
}


if ( ! function_exists( 'plants_option_page' ) ) {
	/**
	 * This function creates a simple page with title Custom Theme Options Page.
	 *
	 * @return void
	 */
	function plants_option_page() {
		$settings_output = plants_get_settings();
		?>
	<div class="wrap">
		<h2><?php echo esc_html( $settings_output['plants_page_title'] ); ?></h2>
		<form method="post" action="options.php">
			<p class="submit">
				<?php
				wp_nonce_field();
				do_settings_sections( __FILE__ );
				settings_fields( $settings_output['plants_option_name'] );
				?>
				<input name="Submit" type="submit" class="button-primary" value="<?php esc_attr_e( 'Save Changes', 'plants' ); ?>" />
			</p>
		</form>
	</div>
		<?php
	}
}


