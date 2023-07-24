<?php
/**
 * Main template file.
 *
 * @package PLANTS
 */

get_header();

?>
<main>
    <div class="container">
        <?php 
        if ( is_cart() ) {
            get_template_part('template-parts/content', 'cart');
        }
        elseif ((is_woocommerce() and is_product()) && (is_single() || is_page())) {
            # Товар
            
            get_template_part('template-parts/content', 'single-product');
            
        }elseif ( is_shop() ) {
            get_template_part('shop');
        }elseif (is_single()) {
            get_template_part('template-parts/content', 'single-post');
        }


        ?>
    </div>
    

</main>

<?php get_footer() ?>