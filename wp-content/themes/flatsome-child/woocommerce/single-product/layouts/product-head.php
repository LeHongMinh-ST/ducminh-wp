<?php
/**
 * Product head section for adding custom styles
 */

defined( 'ABSPATH' ) || exit;
?>
<style>
/* Custom WooCommerce Styling for Vietceramics-style product page */

/* Product Title */
.product-title,
.product-info .product_title,
.product-info .product-title {
    color: #981b1e;
    font-weight: 400;
    margin-bottom: 30px;
    font-size: 32px;
    font-size: 3.2rem;
    line-height: 38px;
    line-height: 3.8rem;
    text-transform: uppercase;
}

/* Breadcrumb */
.breadcrumb {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
    font-size: 14px;
}

.breadcrumb a {
    color: #666;
    text-decoration: none;
    position: relative;
    padding-right: 20px;
    margin-right: 10px;
}

.breadcrumb a:after {
    content: '/';
    position: absolute;
    right: 0;
    color: #ccc;
}

.breadcrumb a:last-child {
    color: #981b1e;
    padding-right: 0;
    margin-right: 0;
}

.breadcrumb a:last-child:after {
    display: none;
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
}

.vietceramics-buttons .button {
    width: 100%;
    margin: 0;
    text-align: left;
    font-weight: 500;
    letter-spacing: 0.5px;
    border-radius: 0;
    padding: 5px 0;
    font-size: 14px;
    background-color: transparent !important;
    border: none !important;
    border-bottom: 1px solid #e0e0e0 !important;
    position: relative;
    transition: all 0.3s ease;
}

.vietceramics-buttons .button:after {
    content: '';
    position: absolute;
    bottom: -1px;
    left: 0;
    width: 0;
    height: 1px;
    background-color: #981b1e;
    transition: width 0.3s ease;
}

.vietceramics-buttons .button:hover:after {
    width: 100%;
}

.consultation-button {
    color: #981b1e !important;
}

.learn-more-button {
    color: #333 !important;
}

.contact-button,
.vietceramics-buttons .contact-button {
    color: #333 !important;
    border-bottom: 1px solid #e0e0e0 !important;
}

.vietceramics-buttons .button:hover {
    color: #981b1e !important;
}

/* Social Sharing */
.vietceramics-social-share {
    display: flex;
    align-items: center;
    padding-top: 15px;
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
    gap: 30px;
}

.vietceramics-product-tabs .tabs li {
    margin: 0;
    padding: 0;
}

.vietceramics-product-tabs .tabs li a {
    display: block;
    padding: 12px 0;
    color: #666;
    font-weight: 500;
    text-decoration: none;
    border-bottom: 2px solid transparent;
    font-size: 22px;
    font-size: 2.2rem;
    line-height: 28px;
    line-height: 2.8rem;
    text-transform: uppercase;
}

.vietceramics-product-tabs .tabs li.active a {
    color: #981b1e;
    border-bottom-color: #981b1e;
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
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin-top: 10px;
}

.spec-row {
    display: grid;
    grid-template-columns: 1fr 2fr;
    padding: 12px 0;
    border-bottom: 1px solid #e0e0e0;
}

.spec-row:last-child {
    border-bottom: 1px solid #e0e0e0;
}

.spec-name {
    font-weight: 500;
    color: #666;
    padding-right: 20px;
}

.spec-value {
    color: #333;
    line-height: 1.5;
    text-align: right;
}

.spec-value p {
    margin-bottom: 0;
}

/* Product Description */
.product-description {
    color: #333;
    line-height: 1.6;
}

.product-description p {
    margin-bottom: 15px;
}

.product-description ul,
.product-description ol {
    margin-left: 20px;
    margin-bottom: 15px;
}

.product-description h1,
.product-description h2,
.product-description h3,
.product-description h4,
.product-description h5,
.product-description h6 {
    color: #981b1e;
    margin-top: 20px;
    margin-bottom: 10px;
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
    border-color: #981b1e;
}

/* Hide default WooCommerce tabs */
.woocommerce-tabs {
    display: none !important;
}

/* Hide default page title */
.shop-page-title,
.product-page-title,
.page-title,
.featured-title,
.dark.page-title,
.page-title-inner {
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
    background-color: #981b1e;
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
    color: #981b1e;
}
</style>
