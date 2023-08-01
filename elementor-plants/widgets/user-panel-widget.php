<?php
class User_Panel_Widget extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'user_panel_widget';
    }

    public function get_title()
    {
        return esc_html__('User Panel Widget', 'elementor-addon');
    }

    public function get_icon()
    {
        return 'eicon-user-circle-o';
    }
    public function get_categories()
    {
        return ['theme-widgets'];
    }

    protected function _register_controls()
    {
    }

    protected function render()
    {
?>
        <div class="profile-section display-flex align-center gap col-right">
            <div class="search-field">
                <a href><img src="<?php echo THEME_IMG_URI ?>/svg/search.svg" alt="search-sign"></a>
            </div>
            <div class="auth display-flex gap-5">
                <a href="">Login</a> / <a href="/wp-login.php?action=register">Register</a>

            </div>
            <div class="cart-section display-flex gap ">
                <div class="favorite">
                    <a href class="display-flex gap-5">
                        <img src="<?php echo THEME_IMG_URI ?>/svg/profile-icons/favorite.svg" alt>
                        <span class="favorite-count">0</span>
                    </a>
                </div>
                <div class="cart">
                    <?php
                    if (class_exists('WooCommerce') && is_a(WC(), 'WC_Cart')) {
                        $cart_count = count(WC()->cart->get_cart());
                    } else {
                        $cart_count = 0;
                    }
                    ?>
                    <a href="<?php echo esc_url(wc_get_cart_url()) ?>" class="display-flex gap-5">
                        <img src="<?php echo THEME_IMG_URI ?>/svg/profile-icons/cart.svg" alt>
                        <span class="cart-count">
                            <?php echo $cart_count; ?>
                        </span>
                    </a>
                </div>

            </div>
        </div>
<?php
    }
}
