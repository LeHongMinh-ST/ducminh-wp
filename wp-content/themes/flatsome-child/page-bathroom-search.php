<?php
/**
 * Template name: Page - Bathroom Search
 *
 * @package          Flatsome\Templates
 * @flatsome-version 3.18.0
 */
get_header(); ?>

<?php do_action('flatsome_before_page'); ?>

<div id="content" role="main" class="content-area">
    <div class="bathroom-banner" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>');">
        <div class="container">
            <header class="way-up">
                <h2>BỘ SƯU TẬP THIẾT BỊ VỆ SINH PHÒNG TẮM CỦA VIETCERAMICS</h2>
                <p>Nhằm mang đến các trải nghiệm tinh tế để bạn có thể tận hưởng những khoảng khắc thư thái sau một
                    ngày dài, bộ sưu tập thiết bị vệ sinh phòng tắm phân phối độc quyền bởi Vietceramics được thiết
                    kế với nhiều kiểu dáng sang trọng, phong cách tiện nghi , nhằm đem đến lựa chọn phù hợp giúp tô
                    điểm cho không gian phòng tắm cổ điển cũng như hiện đại.</p>
            </header>
            <ul class="way-down">
                <?php
                // Get the parent category by slug
                $parent_category = get_term_by('slug', 'thiet-bi-phong-tam', 'product_cat');

                if ($parent_category) {
                    // Get subcategories of the parent category
                    $subcategories = get_terms(array(
                        'taxonomy' => 'product_cat',
                        'parent' => $parent_category->term_id,
                        'hide_empty' => false,
                    ));

                    $count = 1;
                    foreach ($subcategories as $subcategory) {
                        // Get the category thumbnail ID
                        $thumbnail_id = get_term_meta($subcategory->term_id, 'thumbnail_id', true);
                        // Get the image URL
                        $image_url = wp_get_attachment_url($thumbnail_id);
                        // Get the category name
                        $category_name = $subcategory->name;
                        // Get the category slug
                        $category_slug = $subcategory->slug;
                        ?>
                        <li>
                            <article>
                                <div class="icon-bath bath-1 "
                                     style="background-image: url('<?php echo $image_url; ?>');"></div>
                                <h2><?php echo $category_name; ?></h2>
                                <a href="#<?php echo $category_slug; ?>">&nbsp;</a>
                            </article>
                        </li>
                        <?php
                        $count++;
                    }
                }
                ?>
            </ul>
        </div>
    </div>
    <div class="search-bar">
        <div class="container">
            <article>
                <div class="search-select" data-url="/bathroom-search/">
                    <h3>Tìm kiếm:</h3>
                    <div class="select">
                        <?php echo get_attribute_dropdown('thuong-hieu', 'brand', 'brand', 'js-tiles-brandFilter js-bathroom-filter', 'Thương hiệu'); ?>
                    </div>
                    <div class="select">
                        <?php echo get_attribute_dropdown('bo-suu-tap', 'inspired', 'inspired', 'js-tiles-inspiredFilter js-bathroom-filter', 'Bộ sưu tập'); ?>
                    </div>
                    <div class="select">
                        <?php echo get_attribute_dropdown('mau-sac', 'dimension', 'dimension', 'js-tiles-dimensionFilter js-bathroom-filter', 'Màu sắc'); ?>
                    </div>

                    <div class="select">
                        <?php echo get_attribute_dropdown('kieu-giang', 'style', 'style', 'js-tiles-styleFilter js-bathroom-filter', 'Kiểu giáng'); ?>
                    </div>
                </div>
                <div class="search-text">
                    <input type="text" placeholder="Từ khoá tìm kiếm" data-alert="Vui lòng nhập từ khoá để tìm sản phẩm"
                           class="form-control js-bathroom-txtSearch"
                           value="<?php echo isset($_GET['keyword']) ? esc_attr($_GET['keyword']) : ''; ?>">
                    <span class="icon js-bathroom-btnSearchKey"></span>
                </div>
            </article>
        </div>
    </div>

    <div class="search-results">
        <div class="container">
            <?php
            // Process search parameters
            $args = array(
                'post_type' => 'product',
                'posts_per_page' => -1, // Show all products
            );

            // Check if we have any attribute filter
            $has_attribute_filter = false;

            // Add category filter
            if (isset($_GET['category']) && $_GET['category'] != '0') {
                $has_attribute_filter = true;
                $args['tax_query'][] = array(
                    'taxonomy' => 'product_cat',
                    'field' => 'slug',
                    'terms' => sanitize_text_field($_GET['category']),
                );
            }

            // Add brand filter
            if (isset($_GET['brand']) && $_GET['brand'] != '0') {
                $has_attribute_filter = true;
                $args['tax_query'][] = array(
                    'taxonomy' => 'pa_thuong-hieu',
                    'field' => 'term_id',
                    'terms' => intval($_GET['brand']),
                );
            }

            // If no attribute filter is set, don't show any products
            if (!$has_attribute_filter && !isset($_GET['keyword'])) {
                $args['post__in'] = array(0); // This will return no products
            }

            // Add price filter
            if (isset($_GET['price']) && $_GET['price'] != '0') {
                $has_attribute_filter = true;
                $price_range = explode('-', $_GET['price']);
                if (count($price_range) == 2) {
                    $min_price = intval($price_range[0]);
                    $max_price = intval($price_range[1]);

                    $args['meta_query'][] = array(
                        'key' => '_price',
                        'value' => array($min_price, $max_price == 0 ? 999999999 : $max_price),
                        'type' => 'numeric',
                        'compare' => 'BETWEEN',
                    );
                }
            }

            // Add keyword search
            if (isset($_GET['keyword']) && !empty($_GET['keyword'])) {
                $args['s'] = sanitize_text_field($_GET['keyword']);
            }

            // Run the query
            $products = new WP_Query($args);

            if ($products->have_posts()) {
                echo '<ul class="products-grid">';
                while ($products->have_posts()) {
                    $products->the_post();
                    global $product;
                    ?>
                    <li>
                        <figure>
                            <a href="<?php the_permalink(); ?>">&nbsp;</a>
                            <div class="image">
                                <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'thumbnail'); ?>"
                                     class="img" alt="<?php the_title(); ?>">
                            </div>
                            <figcaption><span><?php the_title(); ?></span></figcaption>
                        </figure>
                    </li>
                    <?php
                }
                echo '</ul>';

                // No pagination needed as we're showing all products

                wp_reset_postdata();
            } else {
                echo '<p class="no-results">Không tìm thấy sản phẩm nào phù hợp với tiêu chí tìm kiếm của bạn.</p>';
            }
            ?>
        </div>
    </div>
</div>

<?php do_action('flatsome_after_page'); ?>

<script>
    jQuery(document).ready(function ($) {
        // Refresh Selectric after page load to show the selected values
        $('.select select').selectric('refresh');
    });
</script>

<?php get_footer(); ?>
