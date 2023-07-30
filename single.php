<?php
get_header();
?>
<div class="container">
    <?php
    if (function_exists('is_product') && is_product()) {
        woocommerce_content();
    } else if (have_posts()) {
        while (have_posts()) {
            the_post(); ?>
                <h2 class='title'>
                <?php the_title(); ?>
                </h2>
                <?php
                the_content();
        }
    } else {
        get_template_part('template-parts/content/content-none');
    }
    comment_form();
    ?>

</div>

<?php
get_footer();
?>