<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

?>
<div class="container">
	<?php
	/**
	 * Hook: woocommerce_before_single_product.
	 *
	 * @hooked wc_print_notices - 10
	 */
	do_action( 'woocommerce_before_single_product' );

	if ( post_password_required() ) {
		echo get_the_password_form(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		return;
	}
	?>
</div>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>
	<?php
	// Get product page layout - force our custom layout
	wc_get_template_part( 'single-product/layouts/product', '' );

	do_action( 'woocommerce_after_single_product' );
	?>
</div>
