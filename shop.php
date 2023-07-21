<?php
$mypost_Query = new WP_Query(
    array(
        "post_type" => "product",
        "post_status" => "publish",
        "posts_per_page" => 20,
    )
);
?>
<div class="row row-spacing">
<?php
if ($mypost_Query->have_posts()) {
    while ($mypost_Query->have_posts()):
        ?>
        
            <div class="col-2">
                <?php
                $mypost_Query->the_post();
                get_template_part("template-parts/content", 'product-card');
                ?>
            </div>
        
    <?php
    endwhile;
    ?>
    </div>
    <?php
} else {
    echo ("<p>Sorry, shop is empty.</p>");
}
wp_reset_postdata();

// woocommerce_pagination();
?>