<?php
/**
 * Custom breadcrumb for product page
 */

defined( 'ABSPATH' ) || exit;

// Get product categories
$product_cats = get_the_terms(get_the_ID(), 'product_cat');
$main_category = !empty($product_cats) ? $product_cats[0] : null;
?>

<div class="breadcrumb">
    <a href="<?php echo esc_url(home_url('/')); ?>">Trang chủ</a>
    <?php if ($main_category): ?>
        <a href="<?php echo esc_url(get_term_link($main_category)); ?>"><?php echo esc_html($main_category->name); ?></a>
    <?php endif; ?>
    <a><?php the_title(); ?></a>
</div>
