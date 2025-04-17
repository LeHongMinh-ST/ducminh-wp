/**
 * JavaScript for animations on the bathroom and tiles pages
 */
jQuery(document).ready(function($) {
    // Function to check if element is in viewport
    function isElementInViewport(el) {
        if (typeof jQuery === "function" && el instanceof jQuery) {
            el = el[0];
        }
        var rect = el.getBoundingClientRect();
        return (
            rect.top <= (window.innerHeight || document.documentElement.clientHeight) * 0.8 &&
            rect.bottom >= 0
        );
    }

    // Apply animation classes when elements come into view
    function animateElementsOnScroll() {
        // Handle way-up elements
        $('.way-up').each(function() {
            if (isElementInViewport(this) && !$(this).hasClass('animated')) {
                $(this).css({
                    'animation': 'fadeInUp 1s ease forwards',
                    'opacity': '0'
                }).addClass('animated');
            }
        });

        // Handle way-down elements
        $('.way-down').each(function() {
            if (isElementInViewport(this) && !$(this).hasClass('animated')) {
                $(this).css({
                    'animation': 'fadeInDown 1s ease forwards',
                    'animation-delay': '0.5s',
                    'opacity': '0'
                }).addClass('animated');
            }
        });

        // Handle way-zoom elements
        $('.way-zoom:not(.btn-5):not(.btn-2)').each(function() {
            if (isElementInViewport(this) && !$(this).hasClass('animated')) {
                $(this).css({
                    'animation': 'zoomIn 0.5s ease forwards',
                    'opacity': '0'
                }).addClass('animated');
            }
        });

        // Handle way-zoom buttons (they should be visible but still animate)
        $('.btn-5.way-zoom, .btn-2.way-zoom').each(function() {
            if (isElementInViewport(this) && !$(this).hasClass('animated')) {
                $(this).css({
                    'animation': 'zoomIn 0.5s ease forwards'
                }).addClass('animated');
            }
        });
    }

    // Run animation check on page load
    animateElementsOnScroll();

    // Run animation check on scroll
    $(window).on('scroll', function() {
        animateElementsOnScroll();
    });

    // Handle "Load More" button animations
    $('.js-load-more').on('click', function() {
        var category = $(this).data('category');
        var container = $(this).data('container');

        // Add loading animation
        $(this).addClass('loading');

        // AJAX call would go here in a real implementation
        // For demo, we'll just simulate a delay
        setTimeout(function() {
            // Remove loading animation
            $('.js-load-more').removeClass('loading');

            // Add animation to newly loaded items
            $('#' + container + ' .new-items').addClass('way-zoom animated');
        }, 1000);
    });
});
