<?php
/**
 * Settings page
 *
 * @package  plants
 * @author   Maxim Kliakhin
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://www.hashbangcode.com/
 */

/**
 * get_page_path
 *
 * @return void
 */
function get_page_path() {
	return __FILE__;
}

/**
 * this function creates a simple page with title Custom Theme Options Page.
 *
 * @return void
 */
function theme_option_page() {
	$settings_output = plants_get_settings();
	?>
	<div class="wrap">
		<h2><?php echo $settings_output['plants_page_title']; ?></h2>
		<form method="post" action="options.php">
			<p class="submit">
				<?php
				wp_nonce_field();
				do_settings_sections( __FILE__ );
				// var_dump($settings_output['plants_page_fields']);
				settings_fields( $settings_output['plants_option_name'] );

				?>
				<input name="Submit" type="submit" class="button-primary" value="<?php esc_attr_e( 'Save Changes', 'plants' ); ?>" />
			</p>
		</form>
	</div>
	<?php
}


