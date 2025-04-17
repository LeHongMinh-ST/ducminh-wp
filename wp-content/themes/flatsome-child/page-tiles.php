<?php
/**
 * Template name: Page - Tiles
 *
 * @package          Flatsome\Templates
 * @flatsome-version 3.18.0
 */

// Enqueue custom CSS and JS for animations
wp_enqueue_style('animations', get_stylesheet_directory_uri() . '/assets/css/animations.css');
wp_enqueue_script('animations', get_stylesheet_directory_uri() . '/assets/js/animations.js', array('jquery'), '', true);

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
                            <?php echo get_attribute_dropdown('kich-thuoc', 'dimension', 'dimension', 'js-tiles-dimensionFilter js-tiles-filter', 'Kích thước'); ?>
                        </div>

                        <div class="select">
                            <?php echo get_attribute_dropdown('khu-vuc', 'style', 'style', 'js-tiles-styleFilter js-tiles-filter', 'Khu vực'); ?>
                        </div>


                    </div>
                    <div class="search-text">
                        <input type="text" placeholder="Từ khoá tìm kiếm" data-alert="Vui lòng nhập từ khoá để tìm sản phẩm" class="form-control js-tiles-txtSearch">
                        <span class="icon js-tiles-btnSearchKey"></span>
                    </div>
                </article>
            </div>
        </div>
        <div class="tiles tiles-1" id="gach-van-da-marble" style="background:#fff">
            <header class="way-up" style="opacity: 1; transform: translate3d(0px, 0px, 0px);">
                <h3>Gạch Vân Đá Marble</h3>
                <p>Gạch ốp tường và gạch lát nền vân đá cẩm thạch marble đem đến vẻ đẹp tự nhiên, sự sang trọng và sắc màu tươi mới cho những không gian rộng mở.</p>
            </header>
            <?php echo get_category_products_list('gach-van-da-marble', 6, 'js-look-1096'); ?>
            <a href="javascript:void(0);" class="btn-2 btn-pmarble way-zoom js-load-more" data-category="gach-van-da-marble" data-container="tiles-1" style="opacity: 1; transform: matrix3d(1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1);"><span class="">Xem thêm</span></a>
        </div>
        <div class="tiles tiles-2" id="gach-van-da-tu-nhien" style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/img/bg-tiles-2.jpg')">
            <header class="way-up" style="opacity: 1; transform: translate3d(0px, 0px, 0px);">
                <h3>Gạch Vân Đá Tự Nhiên</h3>
                <p>Một lựa chọn hoàn hảo thay cho đá tự nhiên, các bộ sưu tập gạch ốp lát vân đá đem đến vẻ đẹp tinh tế, phù hợp với các bề mặt trong và ngoài sân, các dự án nhà ở hay khu vực thương mại.</p>
            </header>
            <?php echo get_category_products_list('gach-van-da-tu-nhien', 6, 'js-look-1097'); ?>
            <a href="javascript:void(0);" class="btn-2 btn-pmarble way-zoom js-load-more" data-category="gach-van-da-tu-nhien" data-container="gach-van-da-tu-nhien"><span class="">Xem thêm</span></a>
        </div>
        <div class="tiles tiles-3" id="gach-thiet-ke-xi-mang" style="background:#fff">
            <article>
                <header class="way-up" style="opacity: 1; transform: translate3d(0px, 0px, 0px);">
                    <h3>Gạch Thiết Kế Xi Măng</h3>
                    <p>Với cảm hứng từ các công trình kiến trúc hiện đại, các bộ sưu tập gạch ốp lát mang phong cách đương đại với thiết kế bề mặt xi măng mang đến một vẻ đẹp hiện đại, đơn giản mà vẫn tinh tế.</p>
                </header>

                <?php echo get_category_products_list('gach-thiet-ke-xi-mang', 4, 'js-look-1098'); ?>
                <a href="javascript:void(0);" class="btn-2 btn-pmarble way-zoom js-load-more" data-category="gach-thiet-ke-xi-mang" data-container="gach-thiet-ke-xi-mang" style="opacity: 1; transform: matrix3d(1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1);"><span>Xem thêm</span></a>


            </article>
        </div>
        <div class="tiles tiles-4" id="gach-trang-tri" style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/img/bg-tiles-3.jpg')">
            <header class="way-up">
                <h3>Gạch Trang Trí</h3>
                <p>Được biết đến như một xu hướng thiết kế mới, từ gạch ốp lát 3D đến gạch ốp lát lấy ý tưởng từ các bố cục chất liệu, gạch ốp lát trang trí hứa hẹn mang đến một trải nghiệm mới cho các không gian nội thất.</p>
            </header>
            <?php echo get_category_products_list('gach-trang-tri', 6, 'js-look-1099'); ?>
            <a href="javascript:void(0);" class="btn-2 btn-pmarble way-zoom js-load-more" data-category="gach-trang-tri" data-container="gach-trang-tri"><span class="">Xem thêm</span></a>

        </div>
        <div class="tiles tiles-5" id="gach-van-go" style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/img/bg-tiles-4.jpg')">
            <header class="way-up" style="opacity: 1; transform: translate3d(0px, 0px, 0px);">
                <h3>Gạch Vân Gỗ</h3>
                <p>Mang vẻ đẹp của gỗ tự nhiên với khả năng bền, dễ vệ sinh và bảo quản, bộ sưu tập gạch ốp lát vân gỗ với các lựa chọn kích thước đa dạng hứa hẹn đem đến một không gian hiện đại, ấm cúng và tinh tế.</p>
            </header>
            <?php echo get_category_products_list('gach-van-go', 6, 'js-look-1100'); ?>
            <a href="javascript:void(0);" class="btn-2 btn-pmarble way-zoom js-load-more" data-category="gach-van-go" data-container="gach-van-go"><span class="">Xem thêm</span></a>
        </div>
    </div>

<?php do_action( 'flatsome_after_page' ); ?>

<script>
jQuery(document).ready(function($) {
    console.log('Inline script loaded for tiles page');

    // Direct event handlers for tiles page
    $('.js-tiles-brandFilter').on('change', function() {
        var value = $(this).val();
        console.log('Brand filter changed inline:', value);
        if (value && value !== '0') {
            window.location.href = '/tiles-search/?brand=' + value;
        }
    });

    $('.js-tiles-inspiredFilter').on('change', function() {
        var value = $(this).val();
        console.log('Inspired filter changed inline:', value);
        if (value && value !== '0') {
            window.location.href = '/tiles-search/?inspired=' + value;
        }
    });

    $('.js-tiles-dimensionFilter').on('change', function() {
        var value = $(this).val();
        console.log('Dimension filter changed inline:', value);
        if (value && value !== '0') {
            window.location.href = '/tiles-search/?dimension=' + value;
        }
    });

    $('.js-tiles-styleFilter').on('change', function() {
        var value = $(this).val();
        console.log('Style filter changed inline:', value);
        if (value && value !== '0') {
            window.location.href = '/tiles-search/?style=' + value;
        }
    });

    // Handle "Load More" button animations
    $('.js-load-more').on('click', function() {
        var category = $(this).data('category');
        var container = $(this).data('container');

        // Add loading animation
        $(this).addClass('loading');

        // AJAX call would go here in a real implementation
        // For demo, we'll just simulate a delay
        setTimeout(function() {
            // Remove loading animation
            $('.js-load-more').removeClass('loading');

            // Add animation to newly loaded items
            $('#' + container + ' .new-items').addClass('way-zoom animated');
        }, 1000);
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
                } else if ($(this).hasClass('way-zoom') && !$(this).hasClass('btn-2') && !$(this).hasClass('btn-5')) {
                    $(this).css({
                        'animation': 'zoomIn 0.5s ease forwards',
                        'opacity': '0'
                    });
                } else if ($(this).hasClass('way-zoom') && ($(this).hasClass('btn-2') || $(this).hasClass('btn-5'))) {
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