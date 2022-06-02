$(document).ready(function () {
    var customer_desc = $('.customer-section-desc')
    $('.customer-section-more').click(function () {
        if (customer_desc.hasClass('customer-section-desc-expanded')) {
            customer_desc.removeClass('customer-section-desc-expanded').css('transition', '0.3s')
            customer_desc.addClass('customer-section-desc-expand').css('transition', '0.3s')
            $('.customer-section-more i').removeClass('fa-chevron-up')
            $('.customer-section-more i').addClass('fa-chevron-down')
            $('.customer-section-more span').html('Expand to view our client listing')
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
