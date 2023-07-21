<?php
global $woocommerce;
$product = wc_get_product();
?>

<div class="product display-flex align-center column">
    <div class="product-img">
        <?php
        $image_url = get_the_post_thumbnail_url($product->get_id());
        ?>

        <img <?php echo isset($args['lazy-attr']) ? $args['lazy-attr'] : ''; ?> src="<?php echo $image_url; ?>" alt>

        <?php echo isset($args['lazy-preloader']) ? $args['lazy-preloader'] : ''; ?>
    </div>
    <div class="product-name scheme-dark">
        <a href="<? echo $product->get_permalink() ?>"><?php the_title() ?></a>
    </div>
    <div class="price">
        <p>
            <?php echo $product->get_price(); ?>
        </p>
    </div>
    <div class="select-options-button display-flex text-center">
        <a href="#" class="button">
            Select options
        </a>
    </div>
</div>