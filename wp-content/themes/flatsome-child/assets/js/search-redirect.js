jQuery(document).ready(function($) {
    console.log('Search redirect script loaded');

    // Function to get URL parameter by name
    function getUrlParameter(name) {
        name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
        var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
        var results = regex.exec(location.search);
        return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
    }

    // Function to set select values based on URL parameters
    function setSelectValues() {
        // Set values for tiles search
        if ($('.js-tiles-filter').length) {
            var brand = getUrlParameter('brand');
            var inspired = getUrlParameter('inspired');
            var dimension = getUrlParameter('dimension');
            var style = getUrlParameter('style');
            var keyword = getUrlParameter('keyword');

            if (brand) $('#brand').val(brand);
            if (inspired) $('#inspired').val(inspired);
            if (dimension) $('#dimension').val(dimension);
            if (style) $('#style').val(style);
            if (keyword) $('.js-tiles-txtSearch').val(keyword);
        }

        // Set values for bathroom search
        if ($('.js-bathroom-filter').length) {
            var category = getUrlParameter('category');
            var brand = getUrlParameter('brand');
            var price = getUrlParameter('price');
            var keyword = getUrlParameter('keyword');

            if (category) $('#category').val(category);
            if (brand) $('#brand').val(brand);
            if (price) $('#price').val(price);
            if (keyword) $('.js-bathroom-txtSearch').val(keyword);
        }
    }

    // Set select values on page load
    setSelectValues();

    // Add a general change event handler for all select elements
    $('select.search-dropdown').on('change', function() {
        console.log('Select changed:', this.id, this.name, $(this).val());

        // For tiles page
        if ($(this).hasClass('js-tiles-brandFilter')) {
            handleTilesAttributeSearch('brand', $(this).val());
        } else if ($(this).hasClass('js-tiles-inspiredFilter')) {
            handleTilesAttributeSearch('inspired', $(this).val());
        } else if ($(this).hasClass('js-tiles-dimensionFilter')) {
            handleTilesAttributeSearch('dimension', $(this).val());
        } else if ($(this).hasClass('js-tiles-styleFilter')) {
            handleTilesAttributeSearch('style', $(this).val());
        }

        // For bathroom page
        if ($(this).hasClass('js-bathroom-filter')) {
            if (this.name === 'category') {
                handleBathroomAttributeSearch('category', $(this).val());
            } else if (this.name === 'brand') {
                handleBathroomAttributeSearch('brand', $(this).val());
            } else if (this.name === 'price') {
                handleBathroomAttributeSearch('price', $(this).val());
            }
        }
    });

    // Handle tiles search based on the specific attribute
    function handleTilesAttributeSearch(attributeName, attributeValue) {
        var searchUrl = '/tiles-search/?';
        var params = [];

        // Add the selected attribute
        if (attributeValue && attributeValue !== '0') {
            params.push(attributeName + '=' + attributeValue);
        }

        // Add keyword if present
        var keyword = $('.js-tiles-txtSearch').val();
        if (keyword) {
            params.push('keyword=' + encodeURIComponent(keyword));
        }

        searchUrl += params.join('&');
        window.location.href = searchUrl;
    }

    // Handle bathroom search based on the specific attribute
    function handleBathroomAttributeSearch(attributeName, attributeValue) {
        var searchUrl = '/bathroom-search/?';
        var params = [];

        // Add the selected attribute
        if (attributeValue && attributeValue !== '0') {
            params.push(attributeName + '=' + attributeValue);
        }

        // Add keyword if present
        var keyword = $('.js-bathroom-txtSearch').val();
        if (keyword) {
            params.push('keyword=' + encodeURIComponent(keyword));
        }

        searchUrl += params.join('&');
        window.location.href = searchUrl;
    }

    // Tiles search events
    console.log('Number of brand filters:', $('.js-tiles-brandFilter').length);
    console.log('Number of inspired filters:', $('.js-tiles-inspiredFilter').length);
    console.log('Number of dimension filters:', $('.js-tiles-dimensionFilter').length);
    console.log('Number of style filters:', $('.js-tiles-styleFilter').length);

    $('.js-tiles-brandFilter').on('change', function() {
        console.log('Brand filter changed:', $(this).val());
        handleTilesAttributeSearch('brand', $(this).val());
    });

    $('.js-tiles-inspiredFilter').on('change', function() {
        console.log('Inspired filter changed:', $(this).val());
        handleTilesAttributeSearch('inspired', $(this).val());
    });

    $('.js-tiles-dimensionFilter').on('change', function() {
        console.log('Dimension filter changed:', $(this).val());
        handleTilesAttributeSearch('dimension', $(this).val());
    });

    $('.js-tiles-styleFilter').on('change', function() {
        console.log('Style filter changed:', $(this).val());
        handleTilesAttributeSearch('style', $(this).val());
    });

    $('.js-tiles-btnSearchKey').on('click', function() {
        var keyword = $('.js-tiles-txtSearch').val();
        if (keyword) {
            handleTilesAttributeSearch('keyword', keyword);
        }
    });

    $('.js-tiles-txtSearch').on('keypress', function(e) {
        if (e.which === 13) {
            var keyword = $(this).val();
            if (keyword) {
                handleTilesAttributeSearch('keyword', keyword);
            }
        }
    });

    // Bathroom search events
    $('select[name="category"].js-bathroom-filter').on('change', function() {
        handleBathroomAttributeSearch('category', $(this).val());
    });

    $('select[name="brand"].js-bathroom-filter').on('change', function() {
        handleBathroomAttributeSearch('brand', $(this).val());
    });

    $('select[name="price"].js-bathroom-filter').on('change', function() {
        handleBathroomAttributeSearch('price', $(this).val());
    });

    $('.js-bathroom-btnSearchKey').on('click', function() {
        var keyword = $('.js-bathroom-txtSearch').val();
        if (keyword) {
            handleBathroomAttributeSearch('keyword', keyword);
        }
    });

    $('.js-bathroom-txtSearch').on('keypress', function(e) {
        if (e.which === 13) {
            var keyword = $(this).val();
            if (keyword) {
                handleBathroomAttributeSearch('keyword', keyword);
            }
        }
    });
});
