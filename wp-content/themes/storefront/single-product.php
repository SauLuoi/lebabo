<?php
/**
 * The template for displaying all single posts.
 *
 * @package storefront
 */

get_header(); ?>
<?php
$id = get_the_ID();
$product = wc_get_product($id);
$image = $product->get_image();
$title = $product->get_name();

//price
$price = $product->get_price();
$price_regular = $product->get_regular_price();
$price_sale = $product->get_sale_price();
$price_date_on_sale_form = $product->get_date_on_sale_from();
$price_date_on_sale_to = $product->get_date_on_sale_to();
$price_total_sales = $product->get_total_sales();

// Get Product Images
$image_id = $product->get_image_id();
$gallery_id = $product->get_gallery_image_ids();

// Get Product Variations and Attributes
$children = $product->get_children(); // get variations
$attribute = $product->get_attributes();
$attribute_default = $product->get_default_attributes();
?>

<div class="single-product">
    <div class="container">
        <div class="main">
            <div class="main-gallery">

            </div>
            <div class="main-info">

            </div>
        </div>
    </div>
</div>

<?php
//do_action('storefront_sidebar');
get_footer();
