<?php
/**
 * Theme functions
 *
 * @package plants
 * @author  Maxim Kliakhin
 * @license http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link    http://www.hashbangcode.com/
 */

use PLANTS\Inc;

// Get the theme version & make it a named constant.
$theme_data = wp_get_theme();


define( 'PLANTS_VERSION', $theme_data->version );
define( 'PLANTS_DIR_PATH', untrailingslashit( get_template_directory() ) );
define( 'PLANTS_DIR_URI', untrailingslashit( get_template_directory_uri() ) );
define( 'PLANTS_URI', PLANTS_DIR_URI . '/assets' );
define( 'PLANTS_PATH', PLANTS_DIR_PATH . '/assets' );
define( 'PLANTS_FONTS_PATH', PLANTS_DIR_PATH . '/assets/fonts' );
define( 'PLANTS_JS_URI', PLANTS_DIR_URI . '/assets/js' );
define( 'PLANTS_JS_DIR_PATH', PLANTS_DIR_PATH . '/assets/js' );
define( 'PLANTS_IMG_URI', PLANTS_DIR_URI . '/assets/img' );
define( 'PLANTS_CSS_URI', PLANTS_DIR_URI . '/assets/css' );
define( 'PLANTS_CSS_DIR_PATH', PLANTS_DIR_PATH . '/assets/css' );

require_once PLANTS_DIR_PATH . '/inc/helpers/autoloader.php';



if ( ! function_exists( 'plants_get_theme_instances' ) ) {
	/**
	 * Plants_get_theme_instance.
	 *
	 * @return void
	 */
	function plants_get_theme_instances() {
		Inc\THEME::get_instance();
		Inc\Assets::get_instance();
		Inc\Menus::get_instance();
		Inc\WooCommerce::get_instance();
		Inc\MetaBoxes::get_instance();
		Inc\Sidebars::get_instance();
	}
}

if ( ! function_exists( 'plants_is_wc_exist' ) ) {
	/**
	 * Plants_is_WooCommerce_exist.
	 *
	 * @return bool
	 */
	function plants_is_wc_exist() {
		return class_exists( 'WooCommerce' );
	}
}

if ( ! function_exists( 'plants_custom_allow_svg_upload' ) ) {
	/**
	 * Custom_allow_svg_upload.
	 *
	 * @param  array $mimes Mimes types.
	 * @return array
	 */
	function plants_custom_allow_svg_upload( $mimes ) {
		$mimes['svg'] = 'image/svg+xml';
		return $mimes;
	}
}

add_filter( 'upload_mimes', 'plants_custom_allow_svg_upload' );

if ( ! function_exists( 'plants_custom_allow_svg_in_content' ) ) {
	/**
	 * Custom_allow_svg_in_content.
	 *
	 * @param  array $tags Allowed html tags.
	 * @return array
	 */
	function plants_custom_allow_svg_in_content( $tags ) {
		$tags['svg'] = array(
			'class'       => true,
			'width'       => true,
			'height'      => true,
			'viewbox'     => true,
			'xmlns'       => true,
			'fill'        => true,
			'aria-hidden' => true,
			'role'        => true,
			'focusable'   => true,
		);

		$tags['use'] = array(
			'href'       => true,
			'xlink:href' => true,
		);

		return $tags;
	}
	add_filter( 'wp_kses_allowed_html', 'plants_custom_allow_svg_in_content' );
}



plants_get_theme_instances();
if ( is_admin() ) {
	include_once 'inc/custom-settings/custom-settings.php';
}


if ( ! function_exists( 'plants_get_options' ) ) {
	/**
	 * Plants_get_options helper function.
	 *
	 * @param  string $key     Param Key.
	 * @param  string $default Default value.
	 * @return array
	 */
	function plants_get_options( $key, $default = '' ) {
		$get_options = get_option( 'plants_options' );
		if ( isset( $get_options[ $key ] ) || ! empty( $get_options[ $key ] ) ) {
			return $get_options[ $key ];
		}
		return $default;
	}
}

if ( ! function_exists( 'plants_container_inline_css' ) ) {
	/**
	 * Plants_container_inline_css.
	 *
	 * @see    custom-settings.
	 * @return void
	 */
	function plants_container_inline_css() {
		$option = plants_get_options( 'global_container' );
		if ( isset( $option ) && is_numeric( $option ) ) {
			$css = '
			.container { max-width: ' . (int) $option . 'px; }
			.elementor-container { max-width: ' . (int) $option . 'px !important; }
			';
			wp_register_style( 'plants-container-inline', false, 'jquery', PLANTS_VERSION );
			wp_enqueue_style( 'plants-container-inline' );
			wp_add_inline_style( 'plants-container-inline', $css );
		}
	}

	add_action( 'wp_enqueue_scripts', 'plants_container_inline_css', 99 );
}

if ( ! function_exists( 'plants_get_footer_menus' ) ) {
	/**
	 * Plants_get_footer_menus.
	 * Print footer menus in footer.
	 *
	 * @return void
	 */
	function plants_get_footer_menus() {
		$menu_names = plants_get_options( 'show_menu' );
		if ( empty( $menu_names ) ) {
			echo esc_html__( 'No avaible menus', 'plants' );
			return;
		}
		$menu_titles       = plants_get_options( 'menus_titles' );
		$arrays_difference = array_keys( array_diff_key( $menu_titles, $menu_names ) );

		foreach ( $arrays_difference as $name ) {
			unset( $menu_titles[ $name ] );
		}
		$menus = array_combine( $menu_names, $menu_titles );
		foreach ( $menus as $menu_name => $menu_title ) :
			?>
			<div class="footer-nav display-flex column scheme-dark output-padding">
				<div class="nav-title"><?php echo esc_html( $menu_title ); ?></div>
			<?php
			wp_nav_menu(
				array(
					'menu' => $menu_name,
				)
			);
			?>
			</div>
			<?php
		endforeach;
	}
}

if ( ! function_exists( 'plants_get_product_img' ) ) {
	/**
	 * Plants_get_product_img.
	 *
	 * @param  int    $width   Width.
	 * @param  int    $height  Height.
	 * @param  object $product Instanse.
	 * @return string
	 */
	function plants_get_product_img( $width, $height, $product ) {
		return wp_get_attachment_image_src( $product->get_image_id(), array( $width, $height ) )[0];
	}
}


// Elementor sub-addon enabled.
if ( is_plugin_active( 'elementor/elementor.php' ) ) {
	include 'inc/elementor-plants/elementor-addon.php';
}

?>
