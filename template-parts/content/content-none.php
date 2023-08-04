<?php if (is_search() ) : ?>

<p><?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'plants'); ?></p>
    <?php get_search_form(); ?>

<?php else : ?>

<p><?php esc_html_e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'plants'); ?></p>
    <?php get_search_form(); ?>

<?php endif; ?>
