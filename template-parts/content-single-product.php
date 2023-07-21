<?php 
global $woocommerce; 
$product = wc_get_product();
?>

<div class="product display-flex align-center column">
    <div class="product-img">
        <?php echo $product->get_image(); ?>
    </div>
    <div class="product-name scheme-dark">
        <a href="/product/<? echo $product->get_name() ?>"><?php the_title() ?></a>
    </div>
    <div class="price">
        <p><?php echo $product->get_price(); ?></p>
    </div>
    <div class="product-description">
        <p><?php echo $product->get_description(); ?></p>
    </div>
    <div class="select-options-button display-flex text-center gap">
        <a href="#" class="button">
            Select options
        </a>
        <a href="#" class="button">
            Add to cart
        </a>
    </div>
</div>