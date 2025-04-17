<?php
/**
 * Template name: Page - Bathroom
 *
 * @package          Flatsome\Templates
 * @flatsome-version 3.18.0
 */

// Enqueue custom CSS and JS for animations
wp_enqueue_style('bathroom-animations', get_stylesheet_directory_uri() . '/assets/css/animations.css');
wp_enqueue_script('bathroom-animations', get_stylesheet_directory_uri() . '/assets/js/animations.js', array('jquery'), '', true);

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
                        <input type="text" placeholder="Từ khoá tìm kiếm"
                               data-alert="Vui lòng nhập từ khoá để tìm sản phẩm"
                               class="form-control js-bathroom-txtSearch">
                        <span class="icon js-bathroom-btnSearchKey"></span>
                    </div>
                </article>
            </div>
        </div>
        <div class="bathroom bathroom-1" id="voi-nuoc">
            <div class="container">
                <div class="bathroom-body line">
                    <header style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/img/bg-bathroom-1.jpg');">
                        <article>
                            <h2>Vòi nước</h2>
                            <p>L&#224; điểm nhấn cho kh&#244;ng gian ph&#242;ng tắm, việc lựa chọn c&#225;c thiết kế v&#242;i
                                nước từ v&#242;i chậu rửa đến v&#242;i bồn tắm rất quan trọng. Với t&#237;nh năng vượt
                                trội, đồ bền cao v&#224; chất liệu cao cấp, c&#225;c bộ sưu tập thiết bị vệ sinh v&#242;i
                                nước thể hiện sự h&#224;i h&#242;a giữa t&#237;nh năng sản phẩm cũng như sự tiện lợi cho
                                người sử dụng.</p>
                        </article>
                    </header>

                    <?php echo get_category_products_list('voi-nuoc', 4, 'js-cate-1697'); ?>
                    <a href="javascript:void(0);" class="btn-5 btn-marble way-zoom js-load-more" data-category="voi-nuoc" data-container="voi-nuoc"><span>Xem th&#234;m</span></a>

                </div>

            </div>
        </div>
        <div class="bathroom bathroom-1" id="chau-rua">
            <div class="container">
                <div class="bathroom-body ">
                    <header style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/img/bg-bathroom-2.jpg');">
                        <article>
                            <h2>Chậu rửa</h2>
                            <p>Nhằm đem đến sự thoải m&#225;i v&#224; tiện lợi khi sử dụng, c&#225;c d&#242;ng sản phẩm
                                thiết bị vệ sinh ph&#242;ng tắm chậu rửa cao cấp được thiết kế với kiểu d&#225;ng đa
                                dạng, t&#237;nh năng hiện đại, ph&#249; hợp với c&#225;c phong c&#225;ch kh&#244;ng gian
                                ph&#242;ng tắm ri&#234;ng biệt.</p>
                        </article>
                    </header>

                    <?php echo get_category_products_list('chau-rua', 4, 'js-cate-1698'); ?>
                    <a href="javascript:void(0);" class="btn-5 btn-marble way-zoom js-load-more" data-category="chau-rua" data-container="chau-rua"><span>Xem th&#234;m</span></a>

                </div>

            </div>
        </div>
        <div class="bathroom bathroom-2" id="bon-cau" style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/img/bg-bathroom-3.jpg');">
            <div class="container">
                <div class="bathroom-body ">
                    <header>
                        <article>
                            <h2>Bồn cầu</h2>
                            <p>Từ bồn cầu một khối, bồn cầu hai khối đến bồn cầu treo tường, bộ sưu tập thiết bị vệ sinh
                                bị ph&#242;ng tắm, bồn cầu của Vietceramics đa dạng về kiểu d&#225;ng, thiết kế v&#224;
                                t&#237;nh năng ph&#249; hợp với mọi thị hiếu của kh&#225;ch h&#224;ng.</p>
                        </article>
                    </header>

                    <?php echo get_category_products_list('bon-cau', 4, 'js-cate-1699'); ?>
                    <a href="javascript:void(0);" class="btn-5 btn-marble way-zoom js-load-more" data-category="bon-cau" data-container="bon-cau"><span>Xem th&#234;m</span></a>

                </div>
            </div>
        </div>
        <div class="bathroom bathroom-1" id="bon-tam-sen-tam">
            <div class="container">
                <div class="bathroom-body line">
                    <header style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/img/bg-bathroom-4.jpg');">
                        <article>
                            <h2>Bồn tắm & Sen tắm</h2>
                            <p>Đa dạng về k&#237;ch thước, kiểu d&#225;ng, chất liệu, bộ sưu tập thiết bị vệ sinh bị ph&#242;ng
                                tắm c&#225;c d&#242;ng sản phẩm bồn tắm v&#224; sen tắm với thiết kế đương đại, sang
                                trọng đem đến nhiều lựa chọn v&#224; ph&#249; hợp ho&#224;n hảo với kh&#244;ng gian ph&#242;ng
                                tắm của bạn.</p>
                        </article>
                    </header>

                    <?php echo get_category_products_list('bon-tam-sen-tam', 4, 'js-cate-1700'); ?>
                    <a href="javascript:void(0);" class="btn-5 btn-marble way-zoom js-load-more" data-category="bon-tam-sen-tam" data-container="bon-tam-sen-tam"><span>Xem th&#234;m</span></a>

                </div>

            </div>
        </div>
        <div class="bathroom bathroom-3" id="noi-that-phu-kien">
            <div class="container">
                <div class="bathroom-body ">
                    <header style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/img/bg-bathroom-5.jpg');">
                        <article>
                            <h2>Nội thất & Phụ kiện</h2>
                            <p>Với sự đa dạng về phong c&#225;ch từ hiện đại đến cổ điển, c&#225;c d&#242;ng sản phẩm
                                thiết bị vệ sinh ph&#242;ng tắm nội thất v&#224; phụ kiện được thiết kế theo mỗi kh&#244;ng
                                gian ph&#242;ng tắm hứa hẹn đ&#225;p ứng được thị hiếu v&#224; phong c&#225;ch ri&#234;ng
                                của mỗi kh&#225;ch h&#224;ng.</p>
                        </article>
                    </header>

                    <?php echo get_category_products_list('noi-that-phu-kien', 4, 'js-cate-1701'); ?>
                    <a href="javascript:void(0);" class="btn-5 btn-marble way-zoom js-load-more" data-category="noi-that-phu-kien" data-container="noi-that-phu-kien"><span>Xem th&#234;m</span></a>

                </div>

            </div>
        </div>
    </div>

<?php do_action('flatsome_after_page'); ?>

<script>
jQuery(document).ready(function($) {
    console.log('Inline script loaded for bathroom page');

    // Function to collect all bathroom filter parameters
    function getBathroomFilterParams() {
        var params = {};

        // Get keyword if exists
        var keyword = $('.js-bathroom-txtSearch').val();
        if (keyword) {
            params['keyword'] = keyword;
        }

        // Get all select values
        $('.js-bathroom-filter').each(function() {
            var paramName = $(this).attr('name');
            var paramValue = $(this).val();

            if (paramName && paramValue && paramValue !== '0') {
                params[paramName] = paramValue;
            }
        });

        return params;
    }

    // Function to build URL with parameters
    function buildUrl(baseUrl, params) {
        var queryParams = [];

        for (var key in params) {
            if (params.hasOwnProperty(key)) {
                queryParams.push(key + '=' + encodeURIComponent(params[key]));
            }
        }

        return baseUrl + '?' + queryParams.join('&');
    }

    // Direct event handlers for bathroom page
    $('select[name="category"].js-bathroom-filter').on('change', function() {
        var value = $(this).val();
        console.log('Category filter changed inline:', value);
        if (value && value !== '0') {
            var params = getBathroomFilterParams();
            params['category'] = value;
            window.location.href = buildUrl('/thiet-bi-phong-tam-search/', params);
        }
    });

    $('select[name="brand"].js-bathroom-filter').on('change', function() {
        var value = $(this).val();
        console.log('Brand filter changed inline:', value);
        if (value && value !== '0') {
            var params = getBathroomFilterParams();
            params['brand'] = value;
            window.location.href = buildUrl('/thiet-bi-phong-tam-search/', params);
        }
    });

    $('select[name="price"].js-bathroom-filter').on('change', function() {
        var value = $(this).val();
        console.log('Price filter changed inline:', value);
        if (value && value !== '0') {
            var params = getBathroomFilterParams();
            params['price'] = value;
            window.location.href = buildUrl('/thiet-bi-phong-tam-search/', params);
        }
    });

    // Handle search button click
    $('.js-bathroom-btnSearchKey').on('click', function() {
        var params = getBathroomFilterParams();
        if (Object.keys(params).length > 0) {
            window.location.href = buildUrl('/thiet-bi-phong-tam-search/', params);
        }
    });

    // Handle enter key press in search box
    $('.js-bathroom-txtSearch').on('keypress', function(e) {
        if (e.which === 13) {
            var params = getBathroomFilterParams();
            params['keyword'] = $(this).val();
            if (Object.keys(params).length > 0) {
                window.location.href = buildUrl('/thiet-bi-phong-tam-search/', params);
            }
        }
    });

    // Ensure animations are triggered on page load and scroll
    // This is a backup to make sure animations work even if the external JS file fails to load
    function isElementInView(element) {
        var rect = element.getBoundingClientRect();
        return (
            rect.top <= (window.innerHeight || document.documentElement.clientHeight) * 0.8 &&
            rect.bottom >= 0
        );
    }

    function checkAnimations() {
        $('.way-up, .way-down, .way-zoom').each(function() {
            if (isElementInView(this) && !$(this).hasClass('animated')) {
                $(this).addClass('animated');
                if ($(this).hasClass('way-up')) {
                    $(this).css({
                        'animation': 'fadeInUp 1s ease forwards',
                        'opacity': '0'
                    });
                } else if ($(this).hasClass('way-down')) {
                    $(this).css({
                        'animation': 'fadeInDown 1s ease forwards',
                        'animation-delay': '0.5s',
                        'opacity': '0'
                    });
                } else if ($(this).hasClass('way-zoom') && !$(this).hasClass('btn-5') && !$(this).hasClass('btn-2')) {
                    $(this).css({
                        'animation': 'zoomIn 0.5s ease forwards',
                        'opacity': '0'
                    });
                } else if ($(this).hasClass('way-zoom') && ($(this).hasClass('btn-5') || $(this).hasClass('btn-2'))) {
                    $(this).css({
                        'animation': 'zoomIn 0.5s ease forwards'
                    });
                }
            }
        });
    }

    // Run on page load
    checkAnimations();

    // Run on scroll
    $(window).on('scroll', function() {
        checkAnimations();
    });
});
</script>

<?php get_footer(); ?>