<?php
$mypost_Query = new WP_Query(
    array(
        "post_type" => "product",
        "post_status" => "publish",
        "posts_per_page" => 20,
    )
);

if ($mypost_Query->have_posts()) {
    while ($mypost_Query->have_posts()):
        ?>
        <div class="product display-flex align-center column">
            <div class="product-img">
                <img src="<?php echo THEME_IMG_URI ?>/products/productimg.png" loading="lazy" alt>
                <div class="swiper-lazy-preloader"></div>
            </div>
            <div class="product-name">
                <a href="#">Golden Petra</a>
            </div>
            <div class="price">
                <p>$79</p>
            </div>
            <div class="select-options-button display-flex text-center">
                <a href="#" class="button">
                    Select options
                </a>
            </div>
        </div>


        <?php
        $mypost_Query->the_post();

        get_template_part("file-tpl"); # Шаблон для отображения каждого товара
    endwhile;
} else {
    echo ("<p>Извините, нет товаров.</p>");
}
wp_reset_postdata();
?>