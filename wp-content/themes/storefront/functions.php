<?php
/**
 * Storefront engine room
 *
 * @package storefront
 */

/**
 * Assign the Storefront version to a var
 */
include_once get_template_directory() . '/load/Custom_Functions.php';
include_once get_template_directory() . '/load/CTPost_CTTax.php';
include_once get_template_directory() . '/load/Performance.php';
include_once get_template_directory() . '/load/Custom_database.php';
$theme = wp_get_theme('storefront');
$storefront_version = $theme['Version'];

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if (!isset($content_width)) {
    $content_width = 980; /* pixels */
}

$storefront = (object)array(
    'version' => $storefront_version,

    /**
     * Initialize all the things.
     */
    'main' => require 'inc/class-storefront.php',
    'customizer' => require 'inc/customizer/class-storefront-customizer.php',
);

require 'inc/storefront-functions.php';
require 'inc/storefront-template-hooks.php';
require 'inc/storefront-template-functions.php';
require 'inc/wordpress-shims.php';

if (class_exists('Jetpack')) {
    $storefront->jetpack = require 'inc/jetpack/class-storefront-jetpack.php';
}

if (storefront_is_woocommerce_activated()) {
    $storefront->woocommerce = require 'inc/woocommerce/class-storefront-woocommerce.php';
    $storefront->woocommerce_customizer = require 'inc/woocommerce/class-storefront-woocommerce-customizer.php';

    require 'inc/woocommerce/class-storefront-woocommerce-adjacent-products.php';

    require 'inc/woocommerce/storefront-woocommerce-template-hooks.php';
    require 'inc/woocommerce/storefront-woocommerce-template-functions.php';
    require 'inc/woocommerce/storefront-woocommerce-functions.php';
}

if (is_admin()) {
    $storefront->admin = require 'inc/admin/class-storefront-admin.php';

    require 'inc/admin/class-storefront-plugin-install.php';
}

/**
 * NUX
 * Only load if wp version is 4.7.3 or above because of this issue;
 * https://core.trac.wordpress.org/ticket/39610?cversion=1&cnum_hist=2
 */
if (version_compare(get_bloginfo('version'), '4.7.3', '>=') && (is_admin() || is_customize_preview())) {
    require 'inc/nux/class-storefront-nux-admin.php';
    require 'inc/nux/class-storefront-nux-guided-tour.php';
    require 'inc/nux/class-storefront-nux-starter-content.php';
}

/**
 * Note: Do not add any custom code here. Please use a custom plugin so that your customizations aren't lost during updates.
 * https://github.com/woocommerce/theme-customisations
 */

// Create menu Theme option use Acf Pro
if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
        'page_title' => 'Theme option',
        'menu_title' => 'Theme option',
        'menu_slug' => 'theme-settings',
        'capability' => 'edit_posts',
        'redirect' => false
    ));
}

add_filter('wp_nav_menu_objects', 'my_wp_nav_menu_objects', 10, 2);

//add field menu
function my_wp_nav_menu_objects($items, $args)
{

    // loop
    foreach ($items as $item) {

        // vars
        $menu_image = get_field('menu_image', $item);

        // append icon
        if ($menu_image) {

            $item->title .= '<div class="nav-expand-image"> <img src="' . $menu_image . '"></div>';

        }

    }
    // return
    return $items;

}


//shortcode cart
/**
 * Show cart contents / total Ajax
 */
add_filter('woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');

function woocommerce_header_add_to_cart_fragment($fragments)
{
    global $woocommerce;

    ob_start();

    ?>
    <a class="cart-customlocation" href="<?php echo esc_url(wc_get_cart_url()); ?>"
       title="<?php _e('Xem giỏ hàng', 'woothemes'); ?>"><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count); ?>
        – <?php echo $woocommerce->cart->get_cart_total(); ?></a>
    <?php
    $fragments['a.cart-customlocation'] = ob_get_clean();
    return $fragments;
}

//custom format vnđ
function format_money($amount, $currency = false)
{
    if ($currency) {
        return number_format($amount, 0, '.', '.') . 'đ';
    }
    return number_format($amount, 0, '.', '.');
}

// Pagination
function core_paginationCustom($max_num_pages) {
    echo '<div class="core-pagination">';

    if ($max_num_pages > 1) {   // tổng số trang (10)
        echo '<ul class="">';

        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // trang hiện tại (8)

        //trang đầu
        if ($paged > 1 ) {
            echo '<li class="pagination-li"><a href="'.esc_url( get_pagenum_link( 1 ) ).'" class="pagination-a">
            Trang đầu</a></li>';
        }

        //lùi 1 trang
        if ($paged > 1) {
            echo '<li class="pagination-li"><a href="'.esc_url( get_pagenum_link( $paged - 1 ) ).'" class="pagination-a">
            «</a></li>';
        }
        if($paged > 5) {
            echo " ...";
        }

        for($i= 1; $i <= $max_num_pages; $i++) {
            // $half_total_links = floor( 5 / 2);
            $half_total_links = 5;

            $from = $paged - $half_total_links; // trang hiện tại - 2 (8-2= 6)
            $to = $paged + $half_total_links;   // trang hiện tại + 2 (8+2 = 10)

            if ($from < $i && $i < $to) {   // $form cách $to 3 số (từ 6 đến 10 là 7,8,9)
                $class = $i == $paged ? 'active' : 'pagination-a';
                echo '<li class="pagination-li "><a href="'.esc_url( get_pagenum_link( $i ) ).'" class="'.$class.'">'.$i.'</a></li>';
            }
        }

        //tiến 1 trang
        if ($paged + 1 <= $max_num_pages) {
            echo '<li class="pagination-li"><a href="'.esc_url( get_pagenum_link( $paged + 1 ) ).'" class="pagination-a">
            »</a></li>';
        }

        if($paged < ($max_num_pages - 5)) {
            echo " ...";
        }

        //trang cuối
        if ($paged < ($max_num_pages) ) {
            echo '<li class="pagination-li"><a href="'.esc_url( get_pagenum_link( $max_num_pages ) ).'" class="pagination-a">
            Trang cuối </a></li>';
        }

        echo '</ul>';
    }

    echo '</div>';
}