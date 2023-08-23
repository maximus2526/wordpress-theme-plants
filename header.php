<?php
/**
 * Theme functions
 *
 * @package  plants
 * @author   Maxim Kliakhin
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://www.hashbangcode.com/
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>
		<?php wp_title(); ?>
	</title>
	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

	<?php
	$plants_options = get_option( 'plants_options' );
	if ( function_exists( 'wp_body_open' ) ) {
		wp_body_open();
	}
	?>
	<header>
		<div class="header-promo text-center <?php echo ( 'Yes' !== $plants_options['header_banner_hide_option'] ) ? 'hide' : ''; ?>">
			<a href="<?php echo esc_html( $plants_options['header_banner_anchor'] ); ?>"><?php echo esc_html( $plants_options['header_banner_info'] ); ?></a>
		</div>
		<div class="container">
			<div class="header scheme-dark display-flex space-between">

				<div class="nav-section">
					<?php
					wp_nav_menu(
						array(
							'menu' => isset( $plants_options['header_menu'] ) ? $plants_options['header_menu'] : '',
						)
					);
					?>
				</div>
				<div class="logo-section">
					<a href="/">
					<?php
					echo wp_kses(
						get_custom_logo(),
						array(
							'img' => array(
								'src' => array(),
								'alt' => array(),
							),
							'a',
						)
					);
					?>
					</a>
				</div>
				<div class="profile-section display-flex align-center gap col-right">
					<div class="search-field">
						<a href><img src="<?php echo esc_attr( PLANTS_IMG_URI ); ?>/svg/search.svg" alt="search-sign"></a>
					</div>
					<?php if ( is_user_logged_in() ) : ?>
						<a href=" <?php echo esc_url( wp_logout_url() ); ?>">Log Out</a> 
					<?php else : ?>
						<div class="auth display-flex gap-5">
						<a href=" <?php echo esc_url( wp_login_url() ); ?>">Login</a> 
						/ 
						<a href="	<?php echo esc_url( site_url( '/wp-login.php?action=register&redirect_to=' . get_permalink() ) ); ?> ">Register</a>
					</div>
					<?php endif; ?>

					<div class="cart-section display-flex gap ">
						<div class="favorite">
							<a href class="display-flex gap-5">
								<img src="<?php echo esc_url( PLANTS_IMG_URI ); ?>/svg/profile-icons/favorite.svg" alt>
								<span class="favorite-count">0</span>
							</a>
						</div>
						<div class="cart">
							<a href="<?php echo class_exists( 'WooCommerce' ) ? esc_url( wc_get_cart_url() ) : ''; ?>" class="display-flex gap-5">
								<img src="<?php echo esc_url( PLANTS_IMG_URI ); ?>/svg/profile-icons/cart.svg" alt>
								<span class="cart-count">
									<?php echo class_exists( 'WooCommerce' ) ? count( WC()->cart->get_cart() ) : ''; ?>
								</span>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>

