// (function ($) {
//     /**
//        * @param $scope The Widget wrapper element as a jQuery element
//      * @param $ The jQuery alias
//      */
//     var WidgetCustomCustomer = function ($scope, $) {
//         var dataExpand = $scope.find('.customer-section-wrapper').data('expand')
//         console.log(dataExpand)
//         if (dataExpand == '') {
//             // $scope.find('.customer-section-desc').removeClass('customer-section-desc-expand').css('max-height', '3000vh')
//             $('.customer-section-desc').addClass('customer-section-desc-expand')
//         }
//         $(window).on('elementor/frontend/init', function () {
//             elementorFrontend.hooks.addAction('frontend/element_ready/customer-section.default', WidgetCustomCustomer);
//         });
//     };
// })(jQuery);

$(document).ready(function () {
    var dataExpand = $('.customer-section-wrapper').data('expand')
    if (dataExpand == 'yes') {
        $('.customer-section-desc').removeClass('customer-section-desc-expand').css('height', 'auto')
    } else {
        $('.customer-section-desc').addClass('customer-section-desc-expand')
    }
})

$(document).ready(function () {
    var customer_desc = $('.customer-section-desc')
    var dataExpandText = $('.customer-section-wrapper').data('textExpand')
    $('.customer-section-more').click(function () {
        if (customer_desc.hasClass('customer-section-desc-expanded')) {
            customer_desc.removeClass('customer-section-desc-expanded').css('transition', '0.3s')
            customer_desc.addClass('customer-section-desc-expand').css('transition', '0.3s')
            $('.customer-section-more i').removeClass('fa-chevron-up')
            $('.customer-section-more i').addClass('fa-chevron-down')
            $('.customer-section-more span').html(dataExpandText)
        } else {
            customer_desc.removeClass('customer-section-desc-expand').css('transition', '0.3s')
            customer_desc.addClass('customer-section-desc-expanded').css('transition', '0.3s')
            $('.customer-section-more span').html('Close')
            $('.customer-section-more i').removeClass('fa-chevron-down')
            $('.customer-section-more i').addClass('fa-chevron-up')
        }
    })
});

// Even Show Answer FAQs
$('.btn-share-customer').click(function (e) {
    $(this).next().slideToggle();
});
