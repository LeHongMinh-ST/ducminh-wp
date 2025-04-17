<?php
// Add custom Theme Functions here

/**
 * Enqueue custom styles and scripts for category pages and page templates
 */
function flatsome_child_enqueue_styles() {

    // Enqueue jQuery Selectric styles
    wp_enqueue_style(
        'jquery-selectric-styles',
        get_stylesheet_directory_uri() . '/assets/css/selectric.css',
        array(),
        '1.13.0'
    );
    wp_enqueue_style(
        'jquery-fontawesome-styles',
        get_stylesheet_directory_uri() . '/assets/css/font-awesome.css',
        array(),
        '4.7.0'
    );

    // Enqueue app styles
    wp_enqueue_style(
        'flatsome-child-app-styles',
        get_stylesheet_directory_uri() . '/assets/css/app.css',
        array(),
        '1.0.1'
    );

    // Enqueue custom WooCommerce styles
    wp_enqueue_style(
        'vietceramics-woocommerce-styles',
        get_stylesheet_directory_uri() . '/woocommerce-custom.css',
        array(),
        '1.0.0'
    );

    // Enqueue Magnific Popup for modals
    wp_enqueue_style(
        'magnific-popup',
        'https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css',
        array(),
        '1.1.0'
    );

    wp_enqueue_script(
        'magnific-popup',
        'https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js',
        array('jquery'),
        '1.1.0',
        true
    );

    // Enqueue search results styles for search pages
    if (is_page_template('page-tiles-search.php') || is_page_template('page-bathroom-search.php')) {
        wp_enqueue_style(
            'search-results-styles',
            get_stylesheet_directory_uri() . '/assets/css/search-results.css',
            array(),
            '1.0.0'
        );
    }

    // Enqueue jQuery Selectric script
    wp_enqueue_script(
        'jquery-selectric',
        get_stylesheet_directory_uri() . '/assets/js/libs/jquery.selectric.min.js',
        array('jquery'),
        '1.13.0',
        true
    );

    // Enqueue page template JavaScript
    wp_enqueue_script(
        'flatsome-child-page-template-js',
        get_stylesheet_directory_uri() . '/assets/js/page-template.js',
        array('jquery', 'jquery-selectric'),
        '1.0.0',
        true
    );

    // Enqueue AJAX JavaScript for the tiles and bathroom page templates
    if (is_page_template('page-tiles.php') || is_page_template('page-bathroom.php') ||
        is_page_template('page-tiles-search.php') || is_page_template('page-bathroom-search.php')) {
        wp_enqueue_script(
            'tiles-ajax-js',
            get_stylesheet_directory_uri() . '/assets/js/tiles-ajax.js',
            array('jquery'),
            '1.0.0',
            true
        );

        // Pass AJAX URL and nonce to JavaScript
        wp_localize_script(
            'tiles-ajax-js',
            'tiles_ajax_params',
            array(
                'ajax_url' => admin_url('admin-ajax.php'),
                'nonce' => wp_create_nonce('tiles_ajax_nonce')
            )
        );
    }

    // Enqueue search redirect JavaScript for search pages
    if (is_page_template('page-tiles.php') || is_page_template('page-bathroom.php') ||
        is_page_template('page-tiles-search.php') || is_page_template('page-bathroom-search.php')) {
        wp_enqueue_script(
            'search-redirect-js',
            get_stylesheet_directory_uri() . '/assets/js/search-redirect.js',
            array('jquery'),
            '1.0.0',
            true
        );
    }
}
add_action('wp_enqueue_scripts', 'flatsome_child_enqueue_styles');

/**
 * AJAX handler for loading more products
 */
function load_more_products_ajax_handler() {
    // Check nonce for security
    check_ajax_referer('tiles_ajax_nonce', 'security');

    // Get the category slug from the AJAX request
    $category_slug = isset($_POST['category']) ? sanitize_text_field($_POST['category']) : '';

    if (empty($category_slug)) {
        wp_send_json_error(array('message' => 'Category slug is required'));
        return;
    }

    // Get the category by slug
    $category = get_term_by('slug', $category_slug, 'product_cat');

    if (!$category) {
        wp_send_json_error(array('message' => 'Category not found'));
        return;
    }

    // Query products from this category
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => -1, // Get all products
        'tax_query' => array(
            array(
                'taxonomy' => 'product_cat',
                'field' => 'term_id',
                'terms' => $category->term_id,
            )
        )
    );

    $products = new WP_Query($args);

    $html = '';

    if ($products->have_posts()) {
        while ($products->have_posts()) {
            $products->the_post();
            global $product;

            $product_image = get_the_post_thumbnail_url(get_the_ID(), 'thumbnail');
            $product_title = get_the_title();
            $product_link = get_permalink();

            $html .= '<li>';
            $html .= '<figure>';
            $html .= '<a href="' . esc_url($product_link) . '">&nbsp;</a>';
            $html .= '<img src="' . esc_url($product_image) . '" class="img" alt="' . esc_attr($product_title) . '">';
            $html .= '<figcaption><span>' . esc_html($product_title) . '</span></figcaption>';
            $html .= '</figure>';
            $html .= '</li>';
        }
        wp_reset_postdata();
    } else {
        $html = '<li><p>Không tìm thấy sản phẩm nào.</p></li>';
    }

    wp_send_json_success(array('html' => $html));
}

// Add AJAX actions for both logged in and non-logged in users
add_action('wp_ajax_load_more_products', 'load_more_products_ajax_handler');
add_action('wp_ajax_nopriv_load_more_products', 'load_more_products_ajax_handler');

/**
 * Generate a dropdown select with product attribute terms
 *
 * @param string $attribute_slug The attribute slug (without 'pa_' prefix)
 * @param string $select_name The name attribute for the select element
 * @param string $select_id The ID attribute for the select element
 * @param string $select_class The class attribute for the select element
 * @param string $default_option_text The text for the default option (value=0)
 * @return string HTML for the select dropdown
 */
function get_attribute_dropdown($attribute_slug, $select_name, $select_id, $select_class, $default_option_text) {
    // Start building the select element
    $output = '<select name="' . esc_attr($select_name) . '" id="' . esc_attr($select_id) . '" tabindex="-1" class="' . esc_attr($select_class) . ' search-dropdown" onchange="console.log(\'Select changed directly:\', this.id, this.name, this.value);">';

    // Get the selected value from URL parameters
    $selected_value = isset($_GET[$select_name]) ? $_GET[$select_name] : '0';

    // Add the default option
    $selected = ($selected_value === '0') ? ' selected' : '';
    $output .= '<option value="0"' . $selected . '>' . esc_html($default_option_text) . '</option>';

    // Get attribute terms
    $attribute_taxonomy = 'pa_' . $attribute_slug; // 'pa_' prefix is required for product attributes
    $terms = get_terms(array(
        'taxonomy' => $attribute_taxonomy,
        'hide_empty' => false,
    ));

    // Add options for each term
    if (!empty($terms) && !is_wp_error($terms)) {
        foreach ($terms as $term) {
            $selected = ($selected_value == $term->term_id) ? ' selected' : '';
            $output .= '<option value="' . esc_attr($term->term_id) . '"' . $selected . '>' . esc_html($term->name) . '</option>';
        }
    }

    // Close the select element
    $output .= '</select>';

    return $output;
}

/**
 * Get products from a category and display them in a list
 *
 * @param string $category_slug The category slug
 * @param int $limit Number of products to display (default: 6)
 * @param string $list_class Additional classes for the list element
 * @return string HTML for the product list
 */
function get_category_products_list($category_slug, $limit = 6, $list_class = '') {
    // Start building the output
    $output = '';

    // Get the category by slug
    $category = get_term_by('slug', $category_slug, 'product_cat');

    if ($category) {
        // Start the list
        $output .= '<ul class="way-down ' . esc_attr($list_class) . '">';

        // Query products from this category
        $args = array(
            'post_type' => 'product',
            'posts_per_page' => $limit,
            'tax_query' => array(
                array(
                    'taxonomy' => 'product_cat',
                    'field' => 'term_id',
                    'terms' => $category->term_id,
                )
            )
        );

        $products = new WP_Query($args);

        if ($products->have_posts()) {
            while ($products->have_posts()) {
                $products->the_post();
                global $product;

                $product_image = get_the_post_thumbnail_url(get_the_ID(), 'thumbnail');
                if (!$product_image) {
                    $product_image = wc_placeholder_img_src();
                }
                $product_title = get_the_title();
                $product_link = get_permalink();

                $output .= '<li>';
                $output .= '<figure>';
                $output .= '<a href="' . esc_url($product_link) . '">&nbsp;</a>';
                $output .= '<img src="' . esc_url($product_image) . '" class="img" alt="' . esc_attr($product_title) . '">';
                $output .= '<figcaption><span>' . esc_html($product_title) . '</span></figcaption>';
                $output .= '</figure>';
                $output .= '</li>';
            }
            wp_reset_postdata();
        } else {
            $output .= '<li><p>Không tìm thấy sản phẩm nào.</p></li>';
        }

        // Close the list
        $output .= '</ul>';
    }

    return $output;
}
/**
 * Handle consultation form submission via AJAX
 */
function send_consultation_request() {
    // Parse the form data
    parse_str($_POST['form_data'], $form_data);

    // Sanitize input data
    $title = isset($form_data['title']) ? sanitize_text_field($form_data['title']) : 'Ông';
    $name = isset($form_data['name']) ? sanitize_text_field($form_data['name']) : '';
    $phone = isset($form_data['phone']) ? sanitize_text_field($form_data['phone']) : '';
    $email = isset($form_data['email']) ? sanitize_email($form_data['email']) : '';
    $message = isset($form_data['message']) ? sanitize_textarea_field($form_data['message']) : '';
    $newsletter = isset($form_data['newsletter']) ? true : false;
    $product_id = isset($form_data['product_id']) ? intval($form_data['product_id']) : 0;
    $product_name = isset($form_data['product_name']) ? sanitize_text_field($form_data['product_name']) : '';

    // Validate required fields
    if (empty($name) || empty($phone) || empty($email)) {
        wp_send_json_error(array('message' => 'Vui lòng điền đầy đủ thông tin bắt buộc.'));
        return;
    }

    // Prepare email content
    $to = get_option('admin_email');
    $subject = 'Yêu cầu tư vấn sản phẩm: ' . $product_name;

    $body = "<p><strong>Thông tin khách hàng:</strong></p>";
    $body .= "<p>Danh xưng: {$title}</p>";
    $body .= "<p>Họ và tên: {$name}</p>";
    $body .= "<p>Số điện thoại: {$phone}</p>";
    $body .= "<p>Email: {$email}</p>";

    if (!empty($message)) {
        $body .= "<p>Lời nhắn: {$message}</p>";
    }

    $body .= "<p><strong>Thông tin sản phẩm:</strong></p>";
    $body .= "<p>Tên sản phẩm: {$product_name}</p>";
    $body .= "<p>ID sản phẩm: {$product_id}</p>";
    $body .= "<p>Đường dẫn sản phẩm: " . get_permalink($product_id) . "</p>";

    $body .= "<p>Đăng ký nhận bản tin: " . ($newsletter ? 'Có' : 'Không') . "</p>";

    // Set headers for HTML email
    $headers = array('Content-Type: text/html; charset=UTF-8');

    // Send email
    $sent = wp_mail($to, $subject, $body, $headers);

    // Save to database if needed (you can create a custom table for this)
    // ...

    // Subscribe to newsletter if checked
    if ($newsletter) {
        // Add your newsletter subscription logic here
        // ...
    }

    if ($sent) {
        wp_send_json_success(array('message' => 'Yêu cầu tư vấn đã được gửi thành công.'));
    } else {
        wp_send_json_error(array('message' => 'Có lỗi xảy ra khi gửi yêu cầu. Vui lòng thử lại sau.'));
    }
}

// Add AJAX actions for consultation form
add_action('wp_ajax_send_consultation_request', 'send_consultation_request');
add_action('wp_ajax_nopriv_send_consultation_request', 'send_consultation_request');

/**
 * Add custom product tabs
 */
function vietceramics_product_tabs() {
    // Remove default tabs
    remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
}
add_action('init', 'vietceramics_product_tabs');

/**
 * Include custom templates for product page
 */
function vietceramics_include_custom_templates() {
    if (is_product()) {
        // Include color options template after short description
        add_action('woocommerce_single_product_summary', function() {
            wc_get_template('single-product/color-options.php', array(), '', get_stylesheet_directory() . '/woocommerce/');
        }, 25);
    }
}
add_action('wp_footer', 'vietceramics_include_custom_templates');

/**
 * Force our custom product template
 */
function vietceramics_force_custom_product_template($template, $slug, $name) {
    if (is_product() && $slug === 'single-product/layouts/product') {
        $template = get_stylesheet_directory() . '/woocommerce/single-product/layouts/product.php';
    }
    return $template;
}
add_filter('wc_get_template_part', 'vietceramics_force_custom_product_template', 10, 3);

/**
 * Remove page title from product pages
 */
function vietceramics_remove_product_page_title() {
    if (is_product()) {
        remove_action('flatsome_after_header', 'flatsome_product_title', 10);
    }
}
add_action('wp', 'vietceramics_remove_product_page_title');
