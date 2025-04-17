<?php
/**
 * Product head section for adding custom styles
 */

defined( 'ABSPATH' ) || exit;
?>
<style>
/* Custom WooCommerce Styling for Vietceramics-style product page */

/* Product Title */
.product-title {
    font-size: 24px;
    font-weight: 600;
    margin-bottom: 15px;
    text-transform: uppercase;
}

/* Product Gallery */
.product-gallery {
    margin-bottom: 30px;
}

.product-gallery .flickity-viewport {
    background-color: #fff;
    border-radius: 5px;
}

.product-thumbnails img, .product-gallery-slider img {
    border-radius: 5px;
}

/* Product Info */
.product-info {
    padding-left: 30px;
}

.product-info-inner {
    padding: 20px;
    background-color: #fff;
    border-radius: 5px;
}

/* Product Short Description */
.product-short-description {
    margin-bottom: 20px;
    font-size: 14px;
    line-height: 1.6;
}

/* Custom Buttons */
.vietceramics-buttons {
    display: flex;
    flex-direction: column;
    gap: 10px;
    margin: 20px 0;
}

.vietceramics-buttons .button {
    width: 100%;
    margin: 0;
    text-align: center;
    font-weight: 600;
    letter-spacing: 0.5px;
    border-radius: 3px;
    padding: 10px 15px;
}

.consultation-button {
    background-color: #1a73e8 !important;
    color: #fff !important;
}

.learn-more-button {
    background-color: #f8f9fa !important;
    color: #202124 !important;
    border: 1px solid #dadce0 !important;
}

.contact-button {
    background-color: #4267B2 !important;
    color: #fff !important;
}

/* Social Sharing */
.vietceramics-social-share {
    display: flex;
    align-items: center;
    margin-top: 20px;
    padding-top: 15px;
    border-top: 1px solid #eee;
}

.vietceramics-social-share span {
    margin-right: 10px;
    font-weight: 500;
}

.vietceramics-social-share a {
    margin-right: 15px;
    font-size: 18px;
    color: #666;
}

.vietceramics-social-share a:hover {
    color: #1a73e8;
}

/* Custom Tabs */
.vietceramics-product-tabs {
    margin-top: 40px;
    margin-bottom: 40px;
}

.vietceramics-product-tabs .tabs {
    display: flex;
    list-style: none;
    margin: 0;
    padding: 0;
    border-bottom: 1px solid #eee;
}

.vietceramics-product-tabs .tabs li {
    margin: 0;
    padding: 0;
}

.vietceramics-product-tabs .tabs li a {
    display: block;
    padding: 12px 20px;
    color: #666;
    font-weight: 500;
    text-decoration: none;
    border-bottom: 2px solid transparent;
}

.vietceramics-product-tabs .tabs li.active a {
    color: #1a73e8;
    border-bottom-color: #1a73e8;
}

.vietceramics-product-tabs .tab-content {
    padding: 30px 0;
}

.vietceramics-product-tabs .tab-panel {
    display: none;
}

.vietceramics-product-tabs .tab-panel.active {
    display: block;
}

/* Product Specifications */
.product-specifications {
    display: grid;
    grid-template-columns: 1fr;
    gap: 10px;
}

.spec-row {
    display: grid;
    grid-template-columns: 1fr 2fr;
    padding: 10px 0;
    border-bottom: 1px solid #eee;
}

.spec-row:last-child {
    border-bottom: none;
}

.spec-name {
    font-weight: 500;
    color: #666;
}

.spec-value {
    color: #333;
}

/* Color Options */
.color-options-container {
    margin: 15px 0;
}

.color-options-container h4 {
    font-size: 16px;
    font-weight: 500;
    margin-bottom: 10px;
}

.color-options {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin: 10px 0;
}

.color-options img,
.color-options .color-swatch {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    cursor: pointer;
    border: 2px solid transparent;
    transition: all 0.2s;
    display: inline-block;
}

.color-options img.selected,
.color-options .color-swatch.selected {
    border-color: #1a73e8;
}

/* Hide default WooCommerce tabs */
.woocommerce-tabs {
    display: none !important;
}

/* Responsive Styles */
@media (max-width: 849px) {
    .product-info {
        padding-left: 0;
        margin-top: 20px;
    }

    .spec-row {
        grid-template-columns: 1fr;
    }

    .vietceramics-product-tabs .tabs {
        flex-direction: column;
    }

    .vietceramics-product-tabs .tabs li a {
        padding: 10px 0;
    }
}

/* Consultation Form Modal */
.consultation-form-modal {
    position: relative;
    background: #FFF;
    padding: 30px;
    width: auto;
    max-width: 600px;
    margin: 20px auto;
    border-radius: 5px;
}

.consultation-form-container h3 {
    text-align: center;
    margin-bottom: 20px;
    color: #333;
}

.consultation-form .form-row {
    margin-bottom: 15px;
}

.consultation-form label {
    display: block;
    margin-bottom: 5px;
    font-weight: 500;
}

.consultation-form input[type="text"],
.consultation-form input[type="tel"],
.consultation-form input[type="email"],
.consultation-form textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 3px;
}

.consultation-form .radio-group {
    display: flex;
    gap: 20px;
}

.consultation-form .radio-group label {
    display: flex;
    align-items: center;
    font-weight: normal;
}

.consultation-form .radio-group input {
    margin-right: 5px;
}

.consultation-form .checkbox-row label {
    display: flex;
    align-items: center;
    font-weight: normal;
}

.consultation-form .checkbox-row input {
    margin-right: 10px;
}

.consultation-form .submit-button {
    background-color: #1a73e8;
    color: #fff;
    border: none;
    padding: 12px 20px;
    border-radius: 3px;
    cursor: pointer;
    font-weight: 600;
    width: 100%;
}

.success-message {
    text-align: center;
    padding: 30px 0;
}

.success-message h3 {
    margin-bottom: 10px;
    color: #4CAF50;
}
</style>
