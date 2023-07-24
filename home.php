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
        <div class="top-section display-flex gap">
            <aside class="vertical-nav scheme-dark">
                <ul>
                    <li class="vertical-nav-item">
                        <a href class="display-flex">
                            <span class="nav-title">
                                Plants
                            </span>

                            <img class="nav-img" src="<?php echo THEME_IMG_URI ?>/svg/dropdown-icons/ref-icon.svg" alt>
                        </a>
                    </li>
                    <li class="vertical-nav-item">
                        <a href class="display-flex">
                            <span class="nav-title">
                                Planters
                            </span>

                            <img class="nav-img" src="<?php echo THEME_IMG_URI ?>/svg/dropdown-icons/ref-icon.svg" alt>
                        </a>
                    </li>
                    <li class="vertical-nav-item">
                        <a href class="display-flex">
                            <span class="nav-title">
                                Plant care
                            </span>

                            <img class="nav-img" src="<?php echo THEME_IMG_URI ?>/svg/dropdown-icons/ref-icon.svg" alt>
                        </a>
                    </li>
                    <li class="vertical-nav-item">
                        <a href class="display-flex">
                            <span class="nav-title">
                                Gift ideas
                            </span>

                            <img class="nav-img" src="<?php echo THEME_IMG_URI ?>/svg/dropdown-icons/ref-icon.svg" alt>
                        </a>
                    </li>
                    <li class="vertical-nav-item">
                        <a href class="display-flex">
                            <span class="nav-title">
                                Pet Friendly
                            </span>

                            <img class="nav-img" src="<?php echo THEME_IMG_URI ?>/svg/dropdown-icons/ref-icon.svg" alt>
                        </a>
                    </li>
                </ul>
            </aside>
            <div class="top-slider scheme-light display-flex flex-end darken-image">
                <div class="slider-content">
                    <div class="block-title">
                        <h2 class="title">A large selection of plants,
                            fertilizers and accessories.</h2>
                    </div>
                    <div class="slider-description">
                        <p class="opacity-80">A wonderful serenity has
                            taken possession of my entire soul, like
                            these sweet mornings of spring which I enjoy
                            with my whole heart.</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="popular-products">
        <div class="container">
            <div class="block-heading display-flex align-center space-between">
                <div class="title">
                    <h4 class="title">Most popular products</h4>
                </div>
                <div class="nav-section scheme-dark">
                    <ul class="nav">
                        <li><a class="active" href="#">Plants</a></li>
                        <li><a href="#">Planters</a></li>
                        <li><a href="#">Plant care</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Slider main container -->
        <div class="swiper">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
                <!-- Slides -->
                <?php
                $product_Query = new WP_Query(
                    array(
                        "post_type" => "product",
                        "post_status" => "publish",
                        "posts_per_page" => 10,
                    )
                );

                if ($product_Query->have_posts()) {
                    while ($product_Query->have_posts()) {
                        $product_Query->the_post();
                        ?>
                        <div class="swiper-slide">
                            <?php get_template_part("template-parts/content", 'product-card', ['lazy-attr' => 'loading="lazy"', 'lazy-preloader' => '<div class="swiper-lazy-preloader"></div>']); ?>
                        </div>
                        <?php
                    }
                } else {
                    echo ("<p>Empty.</p>");
                }
                wp_reset_postdata();
                ?>


            </div>
            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev"><img src="<?php echo THEME_IMG_URI ?>/svg/swiper/slider-left.svg" alt="">
            </div>
            <div class="swiper-button-next"><img src="<?php echo THEME_IMG_URI ?>/svg/swiper/slider-right.svg" alt="">
            </div>
        </div>

    </div>

    <div class="product-size-banners">
        <div class="container">
            <div class="block-title">
                <h4 class="title">Shopping by size</h4>
            </div>
            <div class="row scheme-light">
                <div class="col-4">
                    <div class="size-banner darken-image">
                        <img src="wp-content/themes/plants/assets/img/size-banners/gif/small.gif" alt="">
                        <div class="banner-content display-flex column">
                            <p class="sub-title">1 - 2ft.</p>
                            <h2 class="title">Small plants</h2>
                            <a href="">Shop now</a>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="size-banner darken-image">
                        <img src="wp-content/themes/plants/assets/img/size-banners/gif/medium.gif" alt="">
                        <div class="banner-content display-flex column">
                            <p class="sub-title">1 - 2ft.</p>
                            <h2 class="title">Small plants</h2>
                            <a href="">Shop now</a>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="size-banner darken-image">
                        <img src="wp-content/themes/plants/assets/img/size-banners/gif/large.gif" alt="">
                        <div class="banner-content display-flex column">
                            <p class="sub-title">1 - 2ft.</p>
                            <h2 class="title">Small plants</h2>
                            <a href="">Shop now</a>
                        </div>
                    </div>

                </div>
            </div>


        </div>
    </div>

    <div class="promo-video">
        <div class="container">
            <div class="block-title">
                <h1> Explore our  <img src="<?php echo THEME_IMG_URI ?>/title-images/ps-top-min-1.png" alt=""> extensive range of plants  <img src="<?php echo THEME_IMG_URI ?>/title-images/ps-top-min-2.png" alt=""> for your  <img src="<?php echo THEME_IMG_URI ?>/title-images/ps-top-min-3.png" alt=""> room. </h3>
            </div>
            <div class="promo-content display-flex gap">
                <div class="quotes">
                    <div class="quote-text">
                        <img src="<?php echo THEME_IMG_URI ?>/svg/quotes.svg" alt="">
                        <p>I am so happy, my dear friend, so absorbed in the exquisite sense of mere existence.</p>
                    </div>

                    <div class="quote-author display-flex gap">
                        <div class="avatar">
                            <img src="<?php echo THEME_IMG_URI ?>/size-banners/avatar.png" alt="">
                        </div>
                        <div class="quote-author-info">
                            <div class="quote-author-name">
                                <p class="title">Jenny Wilson</p>
                            </div>
                            <div class="quote-author-position">
                                <p class="text">Founder</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="video">

                </div>
            </div>

        </div>

    </div>

    <div class="container">
        <div class="exotic-products">

            <div class="container">
                <div class="block-heading display-flex align-center space-between">
                    <div class="title">
                        <h4 class="title">Exotic flowering plants</h4>
                        <p class="text">Most popular products</p>
                    </div>
                    <div class="nav-section scheme-light">
                        <div class="button">
                            <a href="">Shop all</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row row-spacing space-between">
                <?php
                $product_Query = new WP_Query(
                    array(
                        "post_type" => "product",
                        "post_status" => "publish",
                        "posts_per_page" => 5,

                    )
                );

                if ($product_Query->have_posts()):
                    while ($product_Query->have_posts()):
                        ?>

                        <div class="col-2 col-sm-6">
                            <?php
                            $product_Query->the_post();
                            get_template_part("template-parts/content", 'product-card');

                            ?>
                        </div>

                        <?php
                    endwhile;
                endif;
                ?>
            </div>
        </div>

        <div class="our-articles">
            <div class="block-title">
                <h4 class="title">Our articles</h4>
            </div>
            <div class="articles">
                <div class="row row-spacing space-between">
                    <?php
                    $post_Query = new WP_Query(
                        array(
                            "post_type" => "post",
                            "post_status" => "publish",
                            "posts_per_page" => 3,
                        )
                    );

                    if ($post_Query->have_posts()):
                        while ($post_Query->have_posts()):
                            ?>

                            <div class="col-12">
                                <?php
                                $post_Query->the_post();
                                get_template_part("template-parts/content", 'post-card');
                                ?>
                            </div>

                            <?php
                        endwhile;
                    endif;
                    ?>
                </div>
            </div>

        </div>

        <div class="instagram-galery">
            <div class="block-title">
                <h4 class="title">View our instagram</h4>
            </div>
            <div class="galery-photos ">
                <div class="row display-flex space-between">
                    <div class="col-2">
                        <img src="<?php echo THEME_IMG_URI ?>/products/productimg.png" alt="">
                    </div>
                    <div class="col-2">
                        <img src="<?php echo THEME_IMG_URI ?>/products/productimg.png" alt="">
                    </div>
                    <div class="col-2">
                        <img src="<?php echo THEME_IMG_URI ?>/products/productimg.png" alt="">
                    </div>
                    <div class="col-2">
                        <img src="<?php echo THEME_IMG_URI ?>/products/productimg.png" alt="">
                    </div>
                    <div class="col-2">
                        <img src="<?php echo THEME_IMG_URI ?>/products/productimg.png" alt="">
                    </div>
                    <div class="col-2">
                        <img src="<?php echo THEME_IMG_URI ?>/products/productimg.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>

<?php get_footer() ?>