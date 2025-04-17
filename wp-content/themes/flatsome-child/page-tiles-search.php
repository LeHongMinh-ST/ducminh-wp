<?php
/**
 * Template name: Page - Tiles Search
 *
 * @package          Flatsome\Templates
 * @flatsome-version 3.18.0
 */
get_header(); ?>

<?php do_action( 'flatsome_before_page' ); ?>

    <div id="content" role="main" class="content-area">

        <div class="tiles-banner" style="text-shadow: 1px 1px 2px transpanrent; background-image: url('<?php echo get_the_post_thumbnail_url(); ?>');">
            <div class="container">
                <header class="way-up" style="opacity: 1; transform: translate3d(0px, 0px, 0px);">
                    <h2>BỘ SƯU TẬP GẠCH ỐP LÁT</h2>
                    <p>Đem vào không gian với những xu hướng gạch ốp lát mới nhất trên thế giới. Tại Vietceramics, các bộ sưu tập gạch ốp lát được lựa chọn từ những thương hiệu sản xuất nổi tiếng nhất trên thế giới. Phù hợp với nhiều không gian, các bộ sưu tập gạch ốp tường và gạch lát nền được ứng dụng rộng rãi từ những khu vực di chuyển nhiều đến tường trang trí.</p>
                </header>
                <ul class="tiles-nav way-down" style="opacity: 1; transform: translate3d(0px, 0px, 0px);">
                    <?php
                    // Get the parent category by slug
                    $parent_category = get_term_by('slug', 'gach-op-lat', 'product_cat');

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
                                    <img src="<?php echo $image_url; ?>" class="img" alt="<?php echo $category_name; ?>">
                                    <h2><?php echo $category_name; ?></h2>
                                    <a href="/gach-op-lat#<?php echo $category_slug; ?>">&nbsp;</a>
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

                    <div class="search-select" data-url="/tiles-search/">
                        <h3>Tìm kiếm:</h3>
                        <div class="select">
                            <?php echo get_attribute_dropdown('ung-dung', 'brand', 'brand', 'js-tiles-brandFilter js-tiles-filter', 'Ứng dụng'); ?>
                        </div>
                        <div class="select">
                            <?php echo get_attribute_dropdown('be-mat', 'inspired', 'inspired', 'js-tiles-inspiredFilter js-tiles-filter', 'Bề mặt'); ?>
                        </div>
                        <div class="select">
                            <?php echo get_attribute_dropdown('kich-thuoc', 'dimension', 'dimension', 'js-tiles-dimensionFilter js-tiles-filter', 'K&#237;ch thước'); ?>
                        </div>

                        <div class="select">
                            <?php echo get_attribute_dropdown('khu-vuc', 'style', 'style', 'js-tiles-styleFilter js-tiles-filter', 'Khu vực'); ?>
                        </div>


                    </div>
                    <div class="search-text">
                        <input type="text" placeholder="Từ khoá tìm kiếm" data-alert="Vui lòng nhập từ khoá để tìm sản phẩm" class="form-control js-tiles-txtSearch" value="<?php echo isset($_GET['keyword']) ? esc_attr($_GET['keyword']) : ''; ?>">
                        <span class="icon js-tiles-btnSearchKey" href="/tiles-search/"></span>
                    </div>
                </article>
            </div>
        </div>
        <div class="tiles" style="background:#fff">
            <?php
            // Process search parameters
            $args = array(
                'post_type' => 'product',
                'posts_per_page' => -1, // Show all products
                'tax_query' => array(
                    array(
                        'taxonomy' => 'product_cat',
                        'field' => 'slug',
                        'terms' => 'gach-op-lat',
                        'include_children' => true,
                    ),
                ),
            );

            // Check if we have any attribute filter
            $has_attribute_filter = false;

            // Add attribute filters
            $attribute_filters = array(
                'brand' => 'pa_ung-dung',
                'inspired' => 'pa_be-mat',
                'dimension' => 'pa_kich-thuoc',
                'style' => 'pa_khu-vuc',
            );

            foreach ($attribute_filters as $param => $taxonomy) {
                if (isset($_GET[$param]) && $_GET[$param] != '0') {
                    $has_attribute_filter = true;
                    $args['tax_query'][] = array(
                        'taxonomy' => $taxonomy,
                        'field' => 'term_id',
                        'terms' => intval($_GET[$param]),
                    );
                }
            }

            // If no attribute filter is set, don't show any products
            if (!$has_attribute_filter && !isset($_GET['keyword'])) {
                $args['post__in'] = array(0); // This will return no products
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
                                <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'thumbnail'); ?>" class="img" alt="<?php the_title(); ?>">
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

<?php do_action( 'flatsome_after_page' ); ?>

<script>
jQuery(document).ready(function($) {
    // Refresh Selectric after page load to show the selected values
    $('.select select').selectric('refresh');
});
</script>

<?php get_footer(); ?>