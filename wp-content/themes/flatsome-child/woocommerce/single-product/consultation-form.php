<?php
/**
 * Consultation form template
 */

defined( 'ABSPATH' ) || exit;

global $product;
?>

<div id="consultation-form-modal" class="consultation-form-modal mfp-hide">
    <div class="consultation-form-container">
        <h3>ĐẶT HẸN TƯ VẤN</h3>
        <p>Quý khách vui lòng điền thông tin như hướng dẫn, để đặt hẹn tư vấn hoặc thiết kế. Chúng tôi sẽ liên hệ Quý khách trong thời gian sớm nhất</p>
        
        <form class="consultation-form" method="post">
            <div class="form-row">
                <label>Danh xưng</label>
                <div class="radio-group">
                    <label>
                        <input type="radio" name="title" value="Ông" checked> Ông
                    </label>
                    <label>
                        <input type="radio" name="title" value="Bà"> Bà
                    </label>
                </div>
            </div>
            
            <div class="form-row">
                <label for="name">Họ và tên *</label>
                <input type="text" name="name" id="name" required>
            </div>
            
            <div class="form-row">
                <label for="phone">Số điện thoại *</label>
                <input type="tel" name="phone" id="phone" required>
            </div>
            
            <div class="form-row">
                <label for="email">Địa chỉ Email *</label>
                <input type="email" name="email" id="email" required>
            </div>
            
            <div class="form-row">
                <label for="message">Lời nhắn</label>
                <textarea name="message" id="message" rows="4"></textarea>
            </div>
            
            <div class="form-row checkbox-row">
                <label>
                    <input type="checkbox" name="newsletter" value="1">
                    Đăng ký nhận bản tin điện tử
                </label>
            </div>
            
            <div class="form-row">
                <input type="hidden" name="product_id" value="<?php echo esc_attr($product->get_id()); ?>">
                <input type="hidden" name="product_name" value="<?php echo esc_attr($product->get_name()); ?>">
                <button type="submit" class="submit-button">ĐĂNG KÝ</button>
            </div>
        </form>
    </div>
</div>

<script>
jQuery(document).ready(function($) {
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
    
    // Handle form submission
    $('.consultation-form').on('submit', function(e) {
        e.preventDefault();
        
        var formData = $(this).serialize();
        
        $.ajax({
            type: 'POST',
            url: wc_add_to_cart_params.ajax_url,
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
