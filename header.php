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
	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

	<?php
	if ( function_exists( 'wp_body_open' ) ) {
		wp_body_open();
	}
	?>
	<header>
		<div class="header-promo text-center <?php echo ( 'Yes' !== plants_get_options( 'header_banner_hide_option' ) ) ? 'hide' : ''; ?>">
			<a href="<?php echo esc_html( plants_get_options( 'header_banner_anchor' ) ); ?>"><?php echo esc_html( plants_get_options( 'header_banner_info' ) ); ?></a>
		</div>
		<div class="container">
			<div class="header scheme-dark display-flex space-between">

				<div class="nav-section">
					<?php
					wp_nav_menu(
						array(
							'menu' => plants_get_options( 'header_menu' ),
						)
					);
					?>
					<div class="hamburger">
						<img class="menu-hamburger-img" src="<?php echo esc_url( PLANTS_IMG_URI ) . '/svg/menu_hamburger.svg'; ?>" alt="">
						<div class="humburger-menu">
							<div class="close-btn button">
								X
							</div>
							<?php
							wp_nav_menu(
								array(
									'menu' => plants_get_options( 'header_menu' ),
								)
							);
							?>
						</div>
					</div>
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
						<a href=" <?php echo esc_url( wp_logout_url() ); ?>"><?php echo esc_html__( 'Log Out', 'plants' ); ?></a>
					<?php else : ?>
						<div class="auth display-flex gap-5">
							<a href=" <?php echo esc_url( wp_login_url() ); ?>"><?php echo esc_html__( 'Login', 'plants' ); ?></a>
							<?php echo esc_html( '/' ); ?>
							<a href="	<?php echo esc_url( site_url( '/wp-login.php?action=register&redirect_to=' . get_permalink() ) ); ?> "><?php echo esc_html__( 'Register', 'plants' ); ?></a>
						</div>
					<?php endif; ?>
					<?php if ( plants_is_wc_exist() ) : ?>
					<div class="cart-section display-flex gap ">
						<div class="favorite">
							<a href class="display-flex gap-5">
								<img src="<?php echo esc_url( PLANTS_IMG_URI ); ?>/svg/profile-icons/favorite.svg" alt>
								<span class="favorite-count">0</span>
							</a>
						</div>
						<div class="cart">
							<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="display-flex gap-5">
								<img src="<?php echo esc_url( PLANTS_IMG_URI ); ?>/svg/profile-icons/cart.svg" alt>
								<span class="cart-count">
									<?php echo (int) WC()->cart->get_cart_contents_count(); ?>
								</span>
							</a>
						</div>
					</div>
						<?php
						else :
							echo esc_html__( 'Install WooCommerce for site work correctly' );
						endif;
						?>

				</div>
			</div>
		</div>
	</header>
