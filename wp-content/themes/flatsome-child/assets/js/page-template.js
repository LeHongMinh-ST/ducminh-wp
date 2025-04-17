/**
 * JavaScript for Vietceramics Style Page Template
 */
jQuery(document).ready(function($) {
    // Initialize Selectric for all select elements in filter dropdowns
    $('.select select').selectric({
        maxHeight: 300,
        nativeOnMobile: true,
        responsive: true,
        inheritOriginalWidth: true,
        disableOnMobile: false,
        onOpen: function() {
            // Custom open event handler if needed
        },
        onChange: function(element) {
            console.log('Selectric onChange triggered for:', element);
            var $select = $(element);
            var value = $select.val();

            // For tiles page
            if ($select.closest('.tiles-banner, .search-bar').length > 0) {
                if (value && value !== '0') {
                    // Get all current filter values
                    var params = {};

                    // Get keyword if exists
                    var keyword = $('.js-tiles-txtSearch').val();
                    if (keyword) {
                        params['keyword'] = keyword;
                    }

                    // Get all select values
                    $('.js-tiles-filter').each(function() {
                        var paramName = '';
                        var paramValue = $(this).val();

                        if ($(this).hasClass('js-tiles-brandFilter')) {
                            paramName = 'brand';
                        } else if ($(this).hasClass('js-tiles-inspiredFilter')) {
                            paramName = 'inspired';
                        } else if ($(this).hasClass('js-tiles-dimensionFilter')) {
                            paramName = 'dimension';
                        } else if ($(this).hasClass('js-tiles-styleFilter')) {
                            paramName = 'style';
                        }

                        if (paramName && paramValue && paramValue !== '0') {
                            params[paramName] = paramValue;
                        }
                    });

                    // Update the current select value
                    if ($select.hasClass('js-tiles-brandFilter')) {
                        params['brand'] = value;
                    } else if ($select.hasClass('js-tiles-inspiredFilter')) {
                        params['inspired'] = value;
                    } else if ($select.hasClass('js-tiles-dimensionFilter')) {
                        params['dimension'] = value;
                    } else if ($select.hasClass('js-tiles-styleFilter')) {
                        params['style'] = value;
                    }

                    // Build URL
                    var url = '/tiles-search/?';
                    var queryParams = [];

                    for (var key in params) {
                        if (params.hasOwnProperty(key)) {
                            queryParams.push(key + '=' + encodeURIComponent(params[key]));
                        }
                    }

                    url += queryParams.join('&');
                    window.location.href = url;
                }
            }

            // For bathroom page
            if ($select.hasClass('js-bathroom-filter') && value && value !== '0') {
                // Get all current filter values
                var params = {};

                // Get keyword if exists
                var keyword = $('.js-bathroom-txtSearch').val();
                if (keyword) {
                    params['keyword'] = keyword;
                }

                // Get all select values
                $('.js-bathroom-filter').each(function() {
                    var paramName = $(this).attr('name');
                    var paramValue = $(this).val();

                    if (paramName && paramValue && paramValue !== '0') {
                        params[paramName] = paramValue;
                    }
                });

                // Update the current select value
                var name = $select.attr('name');
                params[name] = value;

                // Build URL
                var url = '/bathroom-search/?';
                var queryParams = [];

                for (var key in params) {
                    if (params.hasOwnProperty(key)) {
                        queryParams.push(key + '=' + encodeURIComponent(params[key]));
                    }
                }

                url += queryParams.join('&');
                window.location.href = url;
            }
        }
    });

    // Handle filter search button click
    $('#filter-search-button').on('click', function() {
        // Get selected values
        var category = $('#category-dropdown').val();
        var price = $('#price-dropdown').val();
        var brand = $('#brand-dropdown').val();

        // Build URL with parameters
        var baseUrl = '/shop/';
        var params = [];

        // Add category parameter
        if (category) {
            baseUrl = '/product-category/' + category + '/';
        }

        // Add price parameter
        if (price) {
            var priceRange = price.split('-');
            if (priceRange.length === 2) {
                params.push('min_price=' + priceRange[0]);
                if (priceRange[1] !== '0') {
                    params.push('max_price=' + priceRange[1]);
                }
            }
        }

        // Add brand parameter (if you have a custom taxonomy for brands)
        if (brand) {
            params.push('brand=' + brand);
        }

        // Build final URL
        var url = baseUrl;
        if (params.length > 0) {
            url += '?' + params.join('&');
        }

        // Redirect to search results
        window.location.href = url;
    });

    // Optional: Handle Enter key press in dropdowns
    $('.filter-select').on('keyup', function(e) {
        if (e.key === 'Enter') {
            $('#filter-search-button').click();
        }
    });

    // Function to collect all tiles filter parameters
    function getTilesFilterParams() {
        var params = {};

        // Get keyword if exists
        var keyword = $('.js-tiles-txtSearch').val();
        if (keyword) {
            params['keyword'] = keyword;
        }

        // Get all select values
        $('.js-tiles-filter').each(function() {
            var paramName = '';
            var paramValue = $(this).val();

            if ($(this).hasClass('js-tiles-brandFilter')) {
                paramName = 'brand';
            } else if ($(this).hasClass('js-tiles-inspiredFilter')) {
                paramName = 'inspired';
            } else if ($(this).hasClass('js-tiles-dimensionFilter')) {
                paramName = 'dimension';
            } else if ($(this).hasClass('js-tiles-styleFilter')) {
                paramName = 'style';
            }

            if (paramName && paramValue && paramValue !== '0') {
                params[paramName] = paramValue;
            }
        });

        return params;
    }

    // Function to collect all bathroom filter parameters
    function getBathroomFilterParams() {
        var params = {};

        // Get keyword if exists
        var keyword = $('.js-bathroom-txtSearch').val();
        if (keyword) {
            params['keyword'] = keyword;
        }

        // Get all select values
        $('.js-bathroom-filter').each(function() {
            var paramName = $(this).attr('name');
            var paramValue = $(this).val();

            if (paramName && paramValue && paramValue !== '0') {
                params[paramName] = paramValue;
            }
        });

        return params;
    }

    // Function to build URL with parameters
    function buildUrl(baseUrl, params) {
        var queryParams = [];

        for (var key in params) {
            if (params.hasOwnProperty(key)) {
                queryParams.push(key + '=' + encodeURIComponent(params[key]));
            }
        }

        return baseUrl + '?' + queryParams.join('&');
    }

    // Handle Selectric change event for tiles page
    $(document).on('selectric-change', '.js-tiles-brandFilter', function(event, element, selectric) {
        console.log('Selectric change event for brand:', $(this).val());
        var value = $(this).val();
        if (value && value !== '0') {
            var params = getTilesFilterParams();
            params['brand'] = value;
            window.location.href = buildUrl('/tiles-search/', params);
        }
    });

    $(document).on('selectric-change', '.js-tiles-inspiredFilter', function(event, element, selectric) {
        console.log('Selectric change event for inspired:', $(this).val());
        var value = $(this).val();
        if (value && value !== '0') {
            var params = getTilesFilterParams();
            params['inspired'] = value;
            window.location.href = buildUrl('/tiles-search/', params);
        }
    });

    $(document).on('selectric-change', '.js-tiles-dimensionFilter', function(event, element, selectric) {
        console.log('Selectric change event for dimension:', $(this).val());
        var value = $(this).val();
        if (value && value !== '0') {
            var params = getTilesFilterParams();
            params['dimension'] = value;
            window.location.href = buildUrl('/tiles-search/', params);
        }
    });

    $(document).on('selectric-change', '.js-tiles-styleFilter', function(event, element, selectric) {
        console.log('Selectric change event for style:', $(this).val());
        var value = $(this).val();
        if (value && value !== '0') {
            var params = getTilesFilterParams();
            params['style'] = value;
            window.location.href = buildUrl('/tiles-search/', params);
        }
    });

    // Handle Selectric change event for bathroom page
    $(document).on('selectric-change', '.js-bathroom-filter', function(event, element, selectric) {
        console.log('Selectric change event for bathroom:', $(this).attr('name'), $(this).val());
        var name = $(this).attr('name');
        var value = $(this).val();
        if (value && value !== '0') {
            var params = getBathroomFilterParams();
            params[name] = value;
            window.location.href = buildUrl('/bathroom-search/', params);
        }
    });

    // Handle search button click for tiles page
    $('.js-tiles-btnSearchKey').on('click', function() {
        var params = getTilesFilterParams();
        if (Object.keys(params).length > 0) {
            window.location.href = buildUrl('/tiles-search/', params);
        }
    });

    // Handle enter key press in search box for tiles page
    $('.js-tiles-txtSearch').on('keypress', function(e) {
        if (e.which === 13) {
            var params = getTilesFilterParams();
            if (Object.keys(params).length > 0) {
                window.location.href = buildUrl('/tiles-search/', params);
            }
        }
    });

    // Handle search button click for bathroom page
    $('.js-bathroom-btnSearchKey').on('click', function() {
        var params = getBathroomFilterParams();
        if (Object.keys(params).length > 0) {
            window.location.href = buildUrl('/bathroom-search/', params);
        }
    });

    // Handle enter key press in search box for bathroom page
    $('.js-bathroom-txtSearch').on('keypress', function(e) {
        if (e.which === 13) {
            var params = getBathroomFilterParams();
            if (Object.keys(params).length > 0) {
                window.location.href = buildUrl('/bathroom-search/', params);
            }
        }
    });
});
