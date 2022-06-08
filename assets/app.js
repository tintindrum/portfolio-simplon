
// any CSS you import will output into a single css file (app.scss in this case)
import './styles/app.scss';

// start the Stimulus application
import './bootstrap';

import 'bootstrap'

import 'owl.carousel';


$(function() {
    // Main Object
    var RESHOP = {};

    var
        $filterGridWrapper = $('.filter__grid-wrapper'),
        $collectionOfFilterBtn = $('.filter__btn'),
        $primarySlider = $('#hero-slider'),
        $collectionProductSlider = $('.product-slider'),
        $shopCategoryToggleSpan = $('.shop-w__category-list .has-list > .js-shop-category-span'),// Recursive
        $shopGridBtn = $('.js-shop-grid-target'),
        $shopListBtn = $('.js-shop-list-target'),
        $shopPerspectiveRow = $('.shop-p__collection > div'),
        $shopFilterBtn = $('.js-shop-filter-target');

    // Predefined variables RESHOP.onTabActiveRefreshSlider = function() {
          
        RESHOP.onTabActiveRefreshSlider = function() {
          
            $('.tab-list [data-toggle="tab"]').on('shown.bs.tab', function (e) {
                
                var currentID = $(e.target).attr('href');
                
                $(currentID + '.active').find('.tab-slider').trigger('refresh.owl.carousel');
            });
        }; 
    
        // Bind all sliders 
        RESHOP.primarySlider = function() {
            if ($primarySlider.length) {
                $primarySlider.owlCarousel({
                    items: 1,
                    autoplayTimeout: 8000,
                    loop: true,
                    margin: -1,
                    dots: false,
                    smartSpeed: 1500,
                    rewind: false, 
                    nav: false,
                    responsive: {
                        992: {
                            dots: true
                        }
                    }
                });
            }
        };
    
        // Bind all sliders into the page
        RESHOP.productSlider = function() {
            if ($collectionProductSlider.length) {
                $collectionProductSlider.on('initialize.owl.carousel', function () {
                    $(this).closest('.slider-fouc').removeAttr('class');
                }).each(function () {
                    var thisInstance = $(this);
                    var itemPerLine = thisInstance.data('item');
                    thisInstance.owlCarousel({
                        autoplay: true,
                        loop: false,
                        dots: false,
                        rewind: true,
                        smartSpeed: 1500,
                        nav: true,
                        navElement: 'div',
                        navClass: ['p-prev', 'p-next'],
                        navText: ['<i class="fas fa-long-arrow-alt-left"></i>', '<i class="fas fa-long-arrow-alt-right"></i>'],
                        responsive: {
                            0: {
                                items: 1
                            },
                            768: {
                                items: itemPerLine - 2
                            },
                            991: {
                                items: itemPerLine - 1
                            },
                            1200: {
                                items: itemPerLine
                            }
                        }
                    });
                });
            }
        };

        // Bind isotope filter plugin
        RESHOP.isotopeFilter = function() {

            // Check
            if ($filterGridWrapper.length) {

                $filterGridWrapper.isotope({
                    itemSelector:'.filter__item',
                    filter: '*'
                });
            }

            if ($collectionOfFilterBtn.length) {
                $collectionOfFilterBtn.on('click',function(){
                // Get Value 
                var selectorValue = $(this).attr('data-filter');
                // initialize isotope plugin
                    $filterGridWrapper.isotope({
                        filter:selectorValue
                    });
                $(this).closest('.filter-category-container').find('.js-checked').removeClass('js-checked');
                $(this).addClass('js-checked');
                });
            }
        };


        // Shop Category
        RESHOP.shopCategoryToggle = function() {
            if ($shopCategoryToggleSpan.length) {
                $shopCategoryToggleSpan.on('click', function () {
                    $(this).toggleClass('is-expanded');
                    $(this).next('ul').stop(true, true).slideToggle();
                });
            }
        };

        // Shop Perspective Change
        RESHOP.shopPerspectiveChange = function() {
            if ($shopGridBtn.length && $shopListBtn.length)   {
                $shopGridBtn.on('click',function () {
                    $(this).addClass('is-active');
                    $shopListBtn.removeClass('is-active');
                    $shopPerspectiveRow.removeClass('is-list-active');
                    $shopPerspectiveRow.addClass('is-grid-active');
                });
                $shopListBtn.on('click',function () {
                    $(this).addClass('is-active');
                    $shopGridBtn.removeClass('is-active');
                    $shopPerspectiveRow.removeClass('is-grid-active');
                    $shopPerspectiveRow.addClass('is-list-active');
                });
            }
    };
    // Shop Side Filter Settings
    RESHOP.shopSideFilter = function() {
        if ($shopFilterBtn.length) {
            $shopFilterBtn.on('click',function () {
                // Add Class Active
                $(this).toggleClass('is-active');
                // Get Value 
                var target = $(this).attr('data-side');
                // Open Side
                $(target).toggleClass('is-open');
            });
        }
    };
    

    
    RESHOP.primarySlider();
    RESHOP.productSlider();
    RESHOP.shopCategoryToggle();
    RESHOP.isotopeFilter();
    RESHOP.shopPerspectiveChange();
    RESHOP.shopSideFilter();
    
})(jQuery); // fin de la fonction 