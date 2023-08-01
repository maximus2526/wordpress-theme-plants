<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php wp_title(); ?>
    </title>
    <?php wp_head(); ?>

</head>
<?php if (!is_front_page()): ?> 
<body <?php body_class(); ?>>

    <?php
    if (function_exists('wp_body_open')) {
        wp_body_open();
    }
    ?>
    <header>
        <div class="header-promo text-center">
            <a href="#">Sign up for our newsletter to get 10% off for the
                week!</a>

        </div>
        <div class="container">
            <div class="header scheme-dark display-flex space-between">

                <div class="nav-section">
                    <?php
                    wp_nav_menu(
                        array(
                            'menu' => 'header-menu',
                        )

                    )
                    ?>
                </div>
                <div class="logo-section">
                    <a href="/"><img src="<?php echo THEME_IMG_URI ?>/svg/logo.svg" alt="Woodmart"></a>
                </div>
                <div class="profile-section display-flex align-center gap col-right">
                    <div class="search-field">
                        <a href><img src="<?php echo THEME_IMG_URI ?>/svg/search.svg" alt="search-sign"></a>
                    </div>
                    <div class="auth display-flex gap-5">
                        <a href="">Login</a> / <a href="#">Register</a>

                    </div>
                    <div class="cart-section display-flex gap ">
                        <div class="favorite">
                            <a href class="display-flex gap-5">
                                <img src="<?php echo THEME_IMG_URI ?>/svg/profile-icons/favorite.svg" alt>
                                <span class="favorite-count">0</span>
                            </a>
                        </div>
                        <div class="cart">
                            <a href="<?php echo esc_url(wc_get_cart_url()) ?>" class="display-flex gap-5">
                                <img src="<?php echo THEME_IMG_URI ?>/svg/profile-icons/cart.svg" alt>
                                <span class="cart-count">
                                    <?php
                                    echo count(WC()->cart->get_cart())
                                        ?>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <?php endif; ?> 