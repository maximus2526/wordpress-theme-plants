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
            <div class="top-slider scheme-light display-flex flex-end">
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
                <div class="swiper-slide">
                    
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
                            <a 
                            href="" 
                            class="button">
                                Select options
                            </a>
                        </div>
                    </div>
                </div>

            </div>
            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev"><img src="<?php echo THEME_IMG_URI ?>/svg/swiper/slider-left.svg" alt=""></div>
            <div class="swiper-button-next"><img src="<?php echo THEME_IMG_URI ?>/svg/swiper/slider-right.svg" alt=""></div>
        </div>
   
    </div>
    <div class="container">
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