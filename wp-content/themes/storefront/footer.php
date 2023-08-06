<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package storefront
 */

?>
<?php
$f_list_menu = get_field('f_list_menu', 'option');
?>

<footer id="colophon" class="site-footer" role="contentinfo">
    <div class="footer">
        <div class="wrapper">
            <?php if ($f_list_menu) { ?>
                <div class="footer-menu">
                    <?php
                    foreach ($f_list_menu as $menu) {
                        $f_menu_title = $menu['f_menu_title'];
                        $f_menu_item = $menu['f_menu_item'];
                        ?>
                        <div class="menu-item">
                            <h4 class="footer-title"><?php echo $f_menu_title; ?></h4>
                            <div class="menu-list">
                                <?php if ($f_menu_item) {
                                    foreach ($f_menu_item as $item) {
                                        $f_menu_item_name = $item['f_menu_item_name'];
                                        $f_menu_item_url = $item['f_menu_item_url'];
                                        ?>
                                        <a href="<?php echo $f_menu_item_url; ?>"><?php echo $f_menu_item_name; ?></a>
                                        <?php
                                    }
                                } ?>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            <?php } ?>
            <div class="footer-subscribe">
                <h5 class="footer-title">
                    Join our newsletter
                </h5>
                <p>
                    By signing up, you agree that your email address will be used only to send you marketing newsletters
                    and information about Le Labo products, events and offers. You can unsubscribe at any time by
                    clicking on the unsubscribe link in each newsletter. For more information on Le Labo’s privacy
                    practices, your rights and how to exercise these rights, and your relevant data controller please
                    see our <span class="footer-link"> Privacy Policy</span>. If I am a California resident, I agree to
                    the <span class="footer-link">Notice of Financial Incentive</span>.
                </p>
                <?php echo do_shortcode('[contact-form-7 id="164" title="Form subscribe"]'); ?>
            </div>
        </div>
    </div><!-- .col-full -->
</footer><!-- #colophon -->
</div><!-- #page -->


<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
        integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<?php wp_footer(); ?>

</body>
</html>
