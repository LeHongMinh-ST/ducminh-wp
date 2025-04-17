jQuery(document).ready(function($) {
    // Product tabs functionality
    $('.vietceramics-product-layout .product-tabs li a').on('click', function(e) {
        e.preventDefault();

        // Get the target tab
        var target = $(this).attr('href');

        // Remove active class from all tabs and panels
        $('.vietceramics-product-layout .product-tabs li').removeClass('active');
        $('.vietceramics-product-layout .woocommerce-Tabs-panel').removeClass('active');

        // Add active class to current tab and panel
        $(this).parent().addClass('active');
        $(target).addClass('active');
    });
});
