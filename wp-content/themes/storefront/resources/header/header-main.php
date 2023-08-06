<?php
$h_logo = get_field('h_logo', 'option');
?>
<div class="header-wrapper header-sticky pc">
    <a href="<?php echo bloginfo('url'); ?>" class="logo">
        <img src="<?php echo $h_logo; ?>" alt="<?php echo get_the_title(); ?>">
    </a>
    <div class="header-inner">
        <div class="header-inner_main">
            <div class="header-actions clear">
                <div class="search-new">
                    <form role="search" method="get" class="woocommerce-product-search"
                          action="<?php echo esc_url(home_url('/')); ?>">
                        <label class="screen-reader-text"
                               for="woocommerce-product-search-field-<?php echo isset($index) ? absint($index) : 0; ?>"><?php _e('Search for:', 'woocommerce'); ?></label>
                        <input type="search"
                               id="woocommerce-product-search-field-<?php echo isset($index) ? absint($index) : 0; ?>"
                               class="search-field"
                               placeholder="<?php echo esc_attr__('Search products&hellip;', 'woocommerce'); ?>"
                               value="<?php echo get_search_query(); ?>" name="s"/>
                        <input type="submit" value="<?php echo esc_attr_x('', 'submit button', 'woocommerce'); ?>"/>
                        <input type="hidden" name="post_type" value="product"/>
                    </form>
                </div>
                <div class="newsletter-signup">
                    <a href="#" aria-label="Sign Up" class="secondary-link-btn" data-link-type="newsletter">
                        <i class="ico-envelope"></i>
                    </a>
                </div>
                <div class="login link-account">
                    <a href="<?php bloginfo('url'); ?>/login" class="secondary-link-btn" data-link-type="account">
                        <i class="ico-account"></i>
                        <?php if(is_user_logged_in()) {
                            echo ' <span> ' .wp_get_current_user()->user_login . '</span>';
                        } else {
                            echo ' <span>Log in/Register</span>';
                        }?>
                    </a>
                </div><!-- /.login -->
            </div><!-- /.header-actions -->
            <?php get_template_part("resources/header/header-menu"); ?>
        </div>
        <div>
            <a class="shopping-bag mini-cart-toggle" href="<?php echo wc_get_cart_url(); ?>"
               title="<?php _e('View your shopping cart'); ?>">
                <i class="ico-bag"></i>
                <span class="shopping-bag-count">(
                <?php echo sprintf(_n('%d', '%d', WC()->cart->get_cart_contents_count()), WC()->cart->get_cart_contents_count()); ?>
                )</span>
            </a>
        </div>
    </div><!-- /.header-inner -->
</div>

<div class="header-wrapper header-sticky mb">
    <div class="main">
        <a href="javascript:void(0)" class="ico-menu active-menu"></a>
        <div class="main-logo">
            <a href="<?php echo bloginfo('url'); ?>" class="logo">
                <img src="<?php echo $h_logo; ?>" alt="<?php echo get_the_title(); ?>">
            </a>
        </div>
        <div class="action-buttons">
            <span class="login link-account">
                <a href="/front/app/account/home" class="secondary-link-btn" data-link-type="account">
                    <i class="ico-account"></i>
                    <?php if(is_user_logged_in()) {
                        echo ' <span> ' .wp_get_current_user()->user_login . '</span>';
                    } else {
                        echo ' <span>Log in/Register</span>';
                    }?>
                </a>
            </span><!-- /.login -->
            <span>
               <a class="shopping-bag mini-cart-toggle" href="<?php echo wc_get_cart_url(); ?>"
                  title="<?php _e('Xem giỏ hàng'); ?>">
                    <i class="ico-bag"></i>
                    <span class="shopping-bag-count">
                    <?php echo sprintf(_n('%d', '%d', WC()->cart->get_cart_contents_count()), WC()->cart->get_cart_contents_count()); ?>
                    </span>
                </a>
        </span>
        </div>
    </div>
    <?php get_template_part("resources/header/header-menu-mb"); ?>
</div>
