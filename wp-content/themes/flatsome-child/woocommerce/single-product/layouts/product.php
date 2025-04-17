<?php
/**
 * Custom Product Layout for Vietceramics-style product page.
 *
 * @package          Flatsome-Child/WooCommerce/Templates
 */

// Include custom styles
include_once get_stylesheet_directory() . '/woocommerce/single-product/layouts/product-head.php';
?>
<div class="product-container">

<div class="product-main">
	<div class="container">
		<?php wc_get_template('single-product/breadcrumb.php', array(), '', get_stylesheet_directory() . '/woocommerce/'); ?>
	</div>
	<div class="row content-row mb-0">

		<div class="product-gallery col large-<?php echo flatsome_option('product_image_width'); ?>">
			<?php flatsome_sticky_column_open( 'product_sticky_gallery' ); ?>
			<?php
				/**
				 * woocommerce_before_single_product_summary hook
				 *
				 * @hooked woocommerce_show_product_images - 20
				 */
				do_action( 'woocommerce_before_single_product_summary' );
			?>
			<?php flatsome_sticky_column_close( 'product_sticky_gallery' ); ?>
		</div>

		<div class="product-info summary col-fit col entry-summary <?php flatsome_product_summary_classes();?>">
			<div class="product-info-inner">
				<?php
					/**
					 * woocommerce_single_product_summary hook
					 *
					 * @hooked woocommerce_template_single_title - 5
					 * @hooked woocommerce_template_single_rating - 10
					 * @hooked woocommerce_template_single_price - 10
					 * @hooked woocommerce_template_single_excerpt - 20
					 * @hooked woocommerce_template_single_add_to_cart - 30
					 * @hooked woocommerce_template_single_meta - 40
					 * @hooked woocommerce_template_single_sharing - 50
					 */
					do_action( 'woocommerce_single_product_summary' );
				?>

				<!-- Custom Vietceramics-style buttons -->
				<div class="vietceramics-buttons">
					<a href="#" class="button consultation-button">ĐẶT HẸN TƯ VẤN</a>
					<a href="#features" class="button learn-more-button">TÌM HIỂU THÊM</a>
					<a href="https://m.me/<?php echo esc_attr(get_option('woocommerce_facebook_page', 'your-facebook-page')); ?>" target="_blank" class="button contact-button">LIÊN HỆ NGAY</a>
				</div>

				<!-- Custom social sharing -->
				<div class="vietceramics-social-share">
					<span>Chia sẻ:</span>
					<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" target="_blank" class="facebook-share"><i class="icon-facebook"></i></a>
					<a href="mailto:?subject=<?php echo urlencode(get_the_title()); ?>&body=<?php echo urlencode(get_permalink()); ?>" class="email-share"><i class="icon-envelop"></i></a>
					<a href="https://pinterest.com/pin/create/button/?url=<?php echo urlencode(get_permalink()); ?>&media=<?php echo urlencode(wp_get_attachment_url(get_post_thumbnail_id())); ?>&description=<?php echo urlencode(get_the_title()); ?>" target="_blank" class="pinterest-share"><i class="icon-pinterest"></i></a>
				</div>
			</div>
		</div>

	</div>
</div>

<div class="product-footer">
	<div class="container">
		<!-- Custom Vietceramics-style tabs -->
		<div class="vietceramics-product-tabs">
			<ul class="tabs">
				<li class="active"><a href="#features">Tính năng</a></li>
				<li><a href="#specifications">Thông số kỹ thuật</a></li>
			</ul>

			<div class="tab-content">
				<div id="features" class="tab-panel active">
					<?php
					// Display product attributes in a table format
					global $product;
					$attributes = $product->get_attributes();

					if (!empty($attributes)) {
						echo '<div class="product-specifications">';
						foreach ($attributes as $attribute) {
							if ($attribute->get_visible()) {
								echo '<div class="spec-row">';
								echo '<div class="spec-name">' . wc_attribute_label($attribute->get_name()) . '</div>';
								echo '<div class="spec-value">';

								if ($attribute->is_taxonomy()) {
									$values = wc_get_product_terms($product->get_id(), $attribute->get_name(), array('fields' => 'names'));
									echo apply_filters('woocommerce_attribute', wpautop(wptexturize(implode(', ', $values))), $attribute, $values);
								} else {
									// Convert pipes to commas and display.
									$values = array_map('trim', explode(WC_DELIMITER, $attribute->get_options()));
									echo apply_filters('woocommerce_attribute', wpautop(wptexturize(implode(', ', $values))), $attribute, $values);
								}

								echo '</div>';
								echo '</div>';
							}
						}
						echo '</div>';
					} else {
						echo '<p>Không có thông số kỹ thuật cho sản phẩm này.</p>';
					}
					?>
				</div>
				<div id="specifications" class="tab-panel">
					<div class="product-description">
						<?php the_content(); ?>
					</div>
				</div>
			</div>
		</div>

		<?php
			/**
			 * woocommerce_after_single_product_summary hook
			 *
			 * @hooked woocommerce_output_product_data_tabs - 10
			 * @hooked woocommerce_upsell_display - 15
			 * @hooked woocommerce_output_related_products - 20
			 */
			do_action( 'woocommerce_after_single_product_summary' );
		?>
	</div>
</div>
</div>

<?php
// Include consultation form modal
include_once get_stylesheet_directory() . '/woocommerce/single-product/consultation-form-modal.php';
?>

<script>
jQuery(document).ready(function($) {
	// Tab functionality
	$('.vietceramics-product-tabs .tabs li a').on('click', function(e) {
		e.preventDefault();
		var target = $(this).attr('href');

		// Update active tab
		$('.vietceramics-product-tabs .tabs li').removeClass('active');
		$(this).parent().addClass('active');

		// Show target panel
		$('.vietceramics-product-tabs .tab-panel').removeClass('active');
		$(target).addClass('active');
	});

	// Color selection functionality
	$('.color-options img, .color-options .color-swatch').on('click', function() {
		$('.color-options img, .color-options .color-swatch').removeClass('selected');
		$(this).addClass('selected');

		// You can add code here to update the product image or price based on the selected color
		var selectedColor = $(this).data('color');
		console.log('Selected color:', selectedColor);
	});

	// Open consultation form when clicking the consultation button
	$('.consultation-button').on('click', function(e) {
		e.preventDefault();
		$.magnificPopup.open({
			items: {
				src: '#consultation-form-modal',
				type: 'inline'
			}
		});
	});

	// Scroll to features section when clicking the learn more button
	$('.learn-more-button').on('click', function(e) {
		e.preventDefault();

		// Make sure the features tab is active
		$('.vietceramics-product-tabs .tabs li').removeClass('active');
		$('.vietceramics-product-tabs .tabs li:first-child').addClass('active');
		$('.vietceramics-product-tabs .tab-panel').removeClass('active');
		$('#features').addClass('active');

		// Scroll to the tabs section
		$('html, body').animate({
			scrollTop: $('.vietceramics-product-tabs').offset().top - 100
		}, 500);
	});

	// Handle form submission
	$('.consultation-form').on('submit', function(e) {
		e.preventDefault();

		var formData = $(this).serialize();

		$.ajax({
			type: 'POST',
			url: woocommerce_params.ajax_url,
			data: {
				action: 'send_consultation_request',
				form_data: formData
			},
			success: function(response) {
				if (response.success) {
					$('.consultation-form-container').html('<div class="success-message"><h3>Xin cảm ơn</h3><p>Chúng tôi sẽ liên lạc với bạn trong thời gian sớm nhất</p></div>');
					setTimeout(function() {
						$.magnificPopup.close();
					}, 3000);
				} else {
					alert('Có lỗi xảy ra. Vui lòng thử lại sau.');
				}
			}
		});
	});
});
</script>
