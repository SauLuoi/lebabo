<?php
/* Template Name: Shop */
?>
<?php get_header(); ?>

<?php
$cat_id_current = get_queried_object_id();
$parentcats = get_ancestors($cat_id_current, 'product_cat');
$cat_id_thumb = get_woocommerce_term_meta($cat_id_current, 'thumbnail_id', true);
$thumbnail_cat = wp_get_attachment_url($cat_id_thumb);
?>

<div class="archives-product">
    <div class="heading pc-block">
        <div class="container">
            <div class="breadcrumb">
                <a href="<?php echo bloginfo('url'); ?>">Trang chủ</a>
                <span><?php echo woocommerce_page_title(); ?></span>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="list-products">
            <?php
            $args = array(
                'post_status' => 'publish',
                'posts_per_page' => 1,
                'post_type'      => 'product',
            );
            $product_args = new WP_Query($args);

            $max_num_pages = $product_args->max_num_pages;
            if ($product_args->have_posts()) {
                while ($product_args->have_posts()) {
                    $product_args->the_post();
                    $product_id = get_the_ID();
                    $product_title = get_the_title();
                    $product_excerpt = get_the_excerpt();
                    $product_link = get_the_permalink();
                    $product_feature = get_the_post_thumbnail_url();
                    $product = wc_get_product($product_id);
                    $product_regular_price = $product->get_regular_price();
                    $product_sale_price = $product->get_sale_price();
                    $product_price = $product->get_price();
                    ?>
                    <div class="item">
                        <div class="product-item-image">
                            <img src="<?php echo $product_feature; ?>" alt="<?php echo $product_title; ?>">
                        </div>
                        <div class="product-item-title">
                            <a href="<?php echo $product_link; ?>"><?php echo $product_title; ?></a>
                        </div>
                        <?php if ($product_excerpt) { ?>
                            <div class="product-item-desc"><?php echo $product_excerpt; ?></div>
                        <?php } ?>
                        <div class="product-item-action">
                            <div class="add-to-cart">
                                <?php woocommerce_external_add_to_cart(); ?>
                            </div>
                            <div class="price">
                                <?php if ($product_regular_price !== $product_price) { ?>
                                    <span class="price-regular"><?php echo format_money($product_regular_price, true); ?></span>
                                <?php } ?>
                                <span class="price-current"><?php echo format_money($product_price, true); ?></span>
                            </div>
                        </div>
                    </div>
                <?php }
            } ?>
        </div>
      <?php echo core_paginationCustom($max_num_pages); ?>
    </div>
</div>

<?php get_footer(); ?>