<?php
/**
 * Product color options template
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Check if the product has a color attribute
$color_attribute_name = 'pa_color'; // Change this if your color attribute has a different name
$color_terms = wc_get_product_terms($product->get_id(), $color_attribute_name, array('fields' => 'all'));

if (!empty($color_terms)) {
    echo '<div class="color-options-container">';
    echo '<h4>Màu sắc</h4>';
    echo '<div class="color-options">';

    foreach ($color_terms as $term) {
        // Get color code from term meta (you may need to set this up)
        $color_code = get_term_meta($term->term_id, 'color_code', true);
        $color_image = get_term_meta($term->term_id, 'color_image', true);

        if ($color_image) {
            echo '<img src="' . esc_url($color_image) . '" alt="' . esc_attr($term->name) . '" title="' . esc_attr($term->name) . '" data-color="' . esc_attr($term->slug) . '">';
        } elseif ($color_code) {
            echo '<div class="color-swatch" style="background-color: ' . esc_attr($color_code) . ';" title="' . esc_attr($term->name) . '" data-color="' . esc_attr($term->slug) . '"></div>';
        } else {
            // Fallback to default colors
            $default_colors = array(
                'black' => '#000000',
                'white' => '#ffffff',
                'red' => '#ff0000',
                'blue' => '#0000ff',
                'green' => '#00ff00',
                'yellow' => '#ffff00',
                'orange' => '#ffa500',
                'purple' => '#800080',
                'pink' => '#ffc0cb',
                'brown' => '#a52a2a',
                'gray' => '#808080',
                'silver' => '#c0c0c0',
                'gold' => '#ffd700',
            );

            $color_code = isset($default_colors[strtolower($term->name)]) ? $default_colors[strtolower($term->name)] : '#cccccc';
            echo '<div class="color-swatch" style="background-color: ' . esc_attr($color_code) . ';" title="' . esc_attr($term->name) . '" data-color="' . esc_attr($term->slug) . '"></div>';
        }
    }

    echo '</div>';
    echo '</div>';
} else {
    // If no color attribute is found, display sample colors anyway for demonstration
    echo '<div class="color-options-container">';
    echo '<h4>Màu sắc</h4>';
    echo '<div class="color-options">';

    // Sample color swatches for demonstration
    $sample_colors = array(
        array('name' => 'Đen', 'color' => '#000000'),
        array('name' => 'Trắng', 'color' => '#ffffff'),
        array('name' => 'Vàng', 'color' => '#ffd700'),
        array('name' => 'Bạc', 'color' => '#c0c0c0'),
        array('name' => 'Chrome', 'color' => '#e8e8e8'),
        array('name' => 'Đồng', 'color' => '#b87333'),
        array('name' => 'Vàng hồng', 'color' => '#e5c5b5'),
        array('name' => 'Đen mờ', 'color' => '#333333'),
        array('name' => 'Trắng mờ', 'color' => '#f5f5f5'),
    );

    foreach ($sample_colors as $index => $color) {
        $selected = ($index === 0) ? 'selected' : '';
        echo '<div class="color-swatch ' . $selected . '" style="background-color: ' . esc_attr($color['color']) . '; width: 30px; height: 30px; border-radius: 50%; display: inline-block; margin-right: 10px; cursor: pointer; border: 2px solid ' . ($selected ? '#1a73e8' : 'transparent') . ';" title="' . esc_attr($color['name']) . '" data-color="' . esc_attr(sanitize_title($color['name'])) . '"></div>';
    }

    echo '</div>';
    echo '</div>';
}
?>
