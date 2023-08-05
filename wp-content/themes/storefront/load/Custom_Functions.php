<?php
// Register Style
function core_theme_Style() {
    // css
    // wp_register_style( 'fake-bootstrap-style', get_stylesheet_directory_uri() . "/assets/css/fake-bootstrap.css",false, 'all' );
    // wp_enqueue_style('fake-bootstrap-style');
    wp_register_style( 'main-style', get_stylesheet_directory_uri() . "/dist/css/main.css",false, 'all' );
    wp_enqueue_style('main-style');

    // js
    // wp_register_script( 'fake-bootstrap-script', get_stylesheet_directory_uri() . "/assets/js/fake-bootstrap.js", array('jquery'),false,true );
    // wp_enqueue_script('fake-bootstrap-script');

    wp_register_script( 'main-script', get_stylesheet_directory_uri() . "/dist/js/main.js", array('jquery'),false,true );
    wp_enqueue_script('main-script');
}
if (!is_admin()) add_action('wp_enqueue_scripts', 'core_theme_Style');


// Register Menu and image
if (!function_exists('core_theme_Setup')) {
    function core_theme_Setup()
    {
        register_nav_menus( array(
            'primary' => __( 'Menu primary', 'text_domain' ),
            'footer' => __( 'Menu Footer', 'text_domain'),
        ) );

	    add_theme_support( 'post-thumbnails' );
        // add_image_size( 'p-post', 380, 250, true );
	    // add_image_size( 'p-product', 600, 400, true );
    }
    add_action('after_setup_theme', 'core_theme_Setup');
}


// Customize TinyMCE editor font sizes
if ( ! function_exists( 'wpex_mce_text_sizes' ) ) {
    function wpex_mce_text_sizes( $initArray ){
        $initArray['fontsize_formats'] = "8px 10px 12px 14px 16px 18px 20px 22px 24px 26px 28px 30px 32px 36px 48px 60px 72px 96px";
        return $initArray;
    }
}
add_filter( 'tiny_mce_before_init', 'wpex_mce_text_sizes' );


// Customize TinyMCE editor font
add_filter( 'tiny_mce_before_init', 'mce_custom_fonts' );
function mce_custom_fonts( $init ) {
    $theme_advanced_fonts = 
                            "Noto Sans JP=Noto Sans JP,sans-serif;" .
                            // "noto-sans-cjk-jp=noto-sans-cjk-jp;" .
                            // "Noto Sans JP Bold=Noto Sans JP Bold;" .
                            // "Noto Sans JP Meidum=Noto Sans JP Meidum;" .
                            "Arial=arial,helvetica,sans-serif;" .
                            "Helvetica=helvetica;" .
                            "Times New Roman=times new roman,times;"
                            ;
    $init['font_formats'] = $theme_advanced_fonts;
    return $init;
}


// Upload json to media
add_filter(
    'upload_mimes',
    function( $types ) {
        return array_merge( $types, [ 'json' => 'text/plain' ] );
    }
);

// Delete span, br on Contact Form 7
add_filter('wpcf7_form_elements', function($content) {
    // Delete span (ko xoá đc vì sẽ mất thông báo validate)
    // $content = preg_replace('/<(span).*?class="\s*(?:.*\s)?wpcf7-form-control-wrap(?:\s[^"]+)?\s*"[^\>]*>(.*)<\/\1>/i', '\2', $content);
    // Delete br
    $content = str_replace('<br />', '', $content);
    return $content;
});

// Remove Contact Form 7 script and css
add_filter( 'wpcf7_load_js', '__return_false' );
add_filter( 'wpcf7_load_css', '__return_false' );


// Setup SMTP
// function core_setup_smtp_email( $phpmailer ) {
//     $phpmailer->isSMTP();     
//     $phpmailer->Host        = 'smtp.gmail.com';
//     $phpmailer->Port        = get_field('smtp_port', 'option');
//     $phpmailer->SMTPAuth    = true;
//     $phpmailer->Username    = get_field('smtp_user', 'option');
//     $phpmailer->Password    = get_field('smtp_pass', 'option');
//     $phpmailer->SMTPSecure  = get_field('smtp_encryption', 'option');
// }
// add_action( 'phpmailer_init', 'core_setup_smtp_email' );


// Remove admin menu
// function core_custom_admin_menu() {
//     // remove
//     remove_menu_page( 'index.php' );                             // index
//     remove_menu_page( 'edit-comments.php' );                     // comments
//     // remove_menu_page( 'tools.php' );                             // tools
//     // remove_menu_page( 'edit.php?post_type=acf-field-group' );    // acf field
//     // remove_menu_page( 'wpclever' );                              // woo quick-view
//     // remove_menu_page( 'woocommerce' );                           // woo chính (đơn hàng, cài đặt, ...)
//     // remove_menu_page( 'woocommerce-marketing' );                 // woo marketing (tiếp thị)

//     remove_submenu_page( 'edit.php', 'edit-tags.php?taxonomy=post_tag' );   // tag post
//     remove_submenu_page( 'themes.php', 'theme-editor.php' );                // themes
//     // remove_submenu_page( 'plugins.php', 'plugin-editor.php' );              // plugins
//     remove_submenu_page( 'options-general.php', 'options-writing.php' );    // setting
//     remove_submenu_page( 'options-general.php', 'options-discussion.php' );
//     remove_submenu_page( 'options-general.php', 'options-media.php' );
//     remove_submenu_page( 'options-general.php', 'options-privacy.php' );
//     // remove_submenu_page( 'wpcf7', 'wpcf7-integration' );                    // cf7
//     remove_submenu_page( 'contact-form-listing', 'import_cf7_csv' );        // cf7 db
//     remove_submenu_page( 'contact-form-listing', 'shortcode' );
//     remove_submenu_page( 'contact-form-listing', 'extentions' );
//     remove_submenu_page( 'contact-form-listing', 'mounstride-CRM' );
//     // remove_submenu_page( 'plugins.php', 'remove_taxonomy_base_slug' );      // remove_taxonomy_base_slug
//     // remove_submenu_page( 'options-general.php', 'breadcrumb-navxt' );       // breadcrumb-navxt

//     global $menu;       // Global to get menu array
//     global $submenu;    // Global to get submenu array

//      rename
//      $menu[10][0] = 'Thư viện ảnh';                      // gallery
//      if( isset($menu[45][0]) ) {
//          $menu[45][0] = 'Dữ liệu form';                  // cf7 db
//      }
//      $submenu['themes.php'][5][0] = 'Giao diện';         // submenu theme

//     // remove
//     $submenu['themes.php'][6][1] = '';                  // submenu customize
//     // $submenu['edit.php?post_type=product'][16][1] = ''; // woo tag
//     // $submenu['edit.php?post_type=product'][17][1] = ''; // woo attribute
// }
// add_action( 'admin_menu', 'core_custom_admin_menu' );




// Query_post_by_custompost
function core_query_post_by_custompost_paged($posttype_name, $numPost){
    $qr =  new WP_Query( array(
                        'post_type'     => $posttype_name,
                        'post_status'   => array('publish'),
                        'showposts'     => $numPost,
                        'order'         => 'DESC',
                        'orderby'       => 'date',
                        'paged'         => (get_query_var('paged')) ? get_query_var('paged') : 1,
                        'post__not_in'          => get_option( 'sticky_posts' ),
                        'ignore_sticky_posts'   => 1,
                ) );
    return $qr;
}


// Query_post_by_category
function core_query_post_by_category_paged($cat_id, $numPost){
    $qr =  new WP_Query( array(
                        'cat'           => $cat_id,
                        'post_status'   => array('publish'),
                        'showposts'     => $numPost,
                        'order'         => 'DESC',
                        'orderby'       => 'date',
                        'paged'         => (get_query_var('paged')) ? get_query_var('paged') : 1
                ) );
    return $qr;
}


// Query_post_by_taxonomy
function core_query_post_by_taxonomy_paged($posttype_name, $taxonomy_name, $term_id, $numPost){
    $qr =  new WP_Query( array(
                        'post_type'     =>  $posttype_name,
                        'tax_query'     =>  array(
                                                array(
                                                        'taxonomy'  => $taxonomy_name,
                                                        'field'     => 'id',
                                                        'terms'     => $term_id,
                                                        'operator'  => 'IN'
                                                )),
                        'post_status'   => array('publish'),
                        'showposts'     =>  $numPost,
                        'order'         =>  'DESC',
                        'orderby'       =>  'date',
                        'paged'         =>  (get_query_var('paged')) ? get_query_var('paged') : 1
                ) );
    return $qr;
}


// Query_search_post
function core_query_search_post_paged($keyword, $posttype_array, $numPost){
    $qr =  new WP_Query( array(
                        's'              => $keyword,
                        'post_type'      => $posttype_array,
                        'post_status'    => array('publish'),
                        'showposts'      => $numPost,
                        'order'          => 'DESC',
                        'orderby'        => 'type',
                        'paged'          => (get_query_var('paged')) ? get_query_var('paged') : 1
                ) );
    return $qr;
}



// Close all Update
if (!function_exists('core_remove_core_updates')) {
    function core_remove_core_updates() {
        global $wp_version;
        return(object) array('last_checked'=> time(),'version_checked'=> $wp_version,);
    }
    add_filter('pre_site_transient_update_core','core_remove_core_updates');
    add_filter('pre_site_transient_update_plugins','core_remove_core_updates');
    add_filter('pre_site_transient_update_themes','core_remove_core_updates');
}


// Custom Favicon
if (!function_exists('core_custom_favicon')) {
    function core_custom_favicon() {
        echo '<link rel="Shortcut Icon" type="image/x-icon" href="'.get_field('favicon', 'option').'" />';
    }
    add_action('wp_head', 'core_custom_favicon');
}

?>