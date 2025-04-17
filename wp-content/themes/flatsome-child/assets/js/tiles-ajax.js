jQuery(document).ready(function($) {
    // Load more products via AJAX
    $('.js-load-more').on('click', function(e) {
        e.preventDefault();
        
        var button = $(this);
        var category = button.data('category');
        var container = button.data('container');
        var productList = $('#' + container).find('ul');
        
        // Disable button during AJAX request
        button.addClass('loading');
        button.text('Đang tải...');
        
        $.ajax({
            url: tiles_ajax_params.ajax_url,
            type: 'POST',
            data: {
                action: 'load_more_products',
                category: category,
                security: tiles_ajax_params.nonce
            },
            success: function(response) {
                if (response.success) {
                    // Replace the current product list with the full list
                    productList.html(response.data.html);
                    
                    // Hide the button after successful load
                    button.hide();
                } else {
                    console.error('Error loading products:', response.data.message);
                    button.text('Lỗi khi tải. Thử lại');
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', error);
                button.text('Lỗi khi tải. Thử lại');
            },
            complete: function() {
                button.removeClass('loading');
            }
        });
    });
});
