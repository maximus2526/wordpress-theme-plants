
<footer class="container">
    <div class="top-footer display-flex">
        <div class="left-side">
            <section class="sidebar">

                <aside>
                    <?php dynamic_sidebar('sidebar-1'); ?>
                </aside>

            </section>

            <div class="logo-section">
                <a href="/"><img src="<?php echo PLANTS_IMG_URI ?>/svg/logo.svg" alt="Woodmart"></a>
            </div>
            <div class="subscribe-block display-flex column gap">
                <label for="footer-subscribe-input">Join our newsletter
                    to
                    stay up to date on features and releases.</label>
                <form action="" method="post" id="footer-subscribe-input" class="subscribe-input display-flex gap-5">
                    <input placeholder="Enter your email" type="email" name="subscribe-email">
                    <button class="button" type="submit">Subscribe</button>
                </form>
                <div class="text">
                    By subscribing you agree to with our Privacy Policy
                    and
                    provide consent to receive updates from our company.
                </div>
            </div>
            <div class="social">
                <a href=""><span class="social-icons">FB</span></a>
                <a href=""><span class="social-icons">TW</span></a>
                <a href=""><span class="social-icons">IN</span></a>
            </div>
        </div>
        <div class="right-side display-flex justify-around">
            <div class="footer-nav display-flex column">
                <div class="nav-title">Shop</div>
                <ul class="nav-items scheme-dark">
                    <li><a href>Plants</a></li>
                    <li><a href>Planters</a></li>
                    <li><a href>Plant care</a></li>
                    <li><a href>Gift cards</a></li>
                    <li><a href>Pet Friendly</a></li>
                </ul>
            </div>
            <div class="footer-nav display-flex column">
                <div class="nav-title">Shop</div>
                <ul class="nav-items scheme-dark">
                    <li><a href>Plants</a></li>
                    <li><a href>Planters</a></li>
                    <li><a href>Plant care</a></li>
                    <li><a href>Gift cards</a></li>
                    <li><a href>Pet Friendly</a></li>
                </ul>
            </div>
            <div class="footer-nav display-flex column">
                <div class="nav-title">Shop</div>
                <ul class="nav-items scheme-dark">
                    <li><a href>Plants</a></li>
                    <li><a href>Planters</a></li>
                    <li><a href>Plant care</a></li>
                    <li><a href>Gift cards</a></li>
                    <li><a href>Pet Friendly</a></li>
                </ul>
            </div>

        </div>
    </div>
    <div class="bottom-footer display-flex space-between align-center">
        <div class="rights">
            <span>WoodMart. 2023 created by Xtemos Studio.</span>
        </div>
        <div class="partners">
            <img src="<?php echo PLANTS_IMG_URI ?>/svg/partners.svg" alt>
        </div>
    </div>

</footer>
<?php
wp_footer();
?>
</body>

</html>

