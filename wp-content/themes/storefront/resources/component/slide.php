<?php
$home_slide = get_field('home_slide');

if ($home_slide) {
    ?>
    <div class="slider slider-home">
        <div class="slider-clip">
            <div class="slides owl-carousel">
                <?php
                foreach ($home_slide as $slide) {
                    $home_slide_product = $slide['home_slide_product'];
                    $post_title = $home_slide_product->post_title;
                    $post_excerpt = $home_slide_product->post_excerpt;
                    $post_guid = $home_slide_product->guid;
                    $home_slide_feature = $slide['home_slide_feature'];
                    $home_slide_video = $slide['home_slide_video'];
                    $home_slide_link = get_the_permalink($home_slide_product->ID);
                    ?>
                    <div class="slide">
                        <a href="<?php echo $home_slide_link; ?>" class="gatracking" data-label="Promo - 1"
                           data-category="Hero Desktop">
                            <?php if ($home_slide_video) { ?>
                                <div class="slide-image slide-video pc">
                                    <video autoplay muted loop class="bgvid">
                                        <source src="<?php echo $home_slide_video; ?>"
                                                type="video/mp4">
                                    </video>
                                </div><!-- /.slide-video -->
                            <?php } ?>
                            <div class="slide-image <?php echo $home_slide_video ? 'mb' : ''; ?>">
                                <img src="<?php echo $home_slide_feature; ?>"
                                     alt="<?php echo $post_title; ?>" class="fullsize"/>
                            </div><!-- /.slide-image -->
                            <div class="slider-thumb">
                                <div class="slider-thumb-inner">
                                    <h2><?php echo $post_title; ?></h2>
                                    <p>coming soon...</p>
                                    <div class="actions">
                                        <a href="<?php echo $home_slide_link; ?>">View More</a>
                                    </div><!-- /.actions -->
                                    <a href="city-exclusives-2023.html" class="slider-thumb-link gatracking"
                                       data-label="Promo - 1" data-category="Hero Desktop"></a>
                                </div><!-- /.slider-thumb-inner -->
                            </div><!-- /.slider-thumb -->
                        </a>
                    </div><!-- /.slide -->
                <?php } ?>
            </div><!-- /.slides -->
        </div><!-- /.slider-clip -->
        <div class="slider-paging">
            <div class="slider-thumbs">
                <?php
                foreach ($home_slide as $slide) {
                    $home_slide_product = $slide['home_slide_product'];
                    $post_title = $home_slide_product->post_title;
                    $post_excerpt = $home_slide_product->post_excerpt;
                    $post_guid = $home_slide_product->guid;
                    $home_slide_feature = $slide['home_slide_feature'];
                    ?>
                    <div class="slider-thumb">
                        <div class="slider-thumb-inner">
                            <h2><?php echo $post_title; ?></h2>
                            <p>coming soon...</p>
                            <div class="actions">
                                <span href="#">View More</span>
                            </div><!-- /.actions -->
                            <a href="<?php echo $home_slide_link; ?>"
                               class="slider-thumb-link gatracking homepage-link-btn"
                               data-label="Promo - 1"
                               data-category="Hero Desktop"
                               data-position="1"
                               data-text="<?php echo $post_title; ?>"
                            ></a>
                        </div><!-- /.slider-thumb-inner -->
                    </div><!-- /.slider-thumb -->
                <?php } ?>
            </div><!-- /.slider-thumbs -->
        </div><!-- /.slider-paging -->
    </div><!-- /.slider -->

<?php } ?>
