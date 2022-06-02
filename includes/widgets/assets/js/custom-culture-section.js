(function ($) {
    /**
       * @param $scope The Widget wrapper element as a jQuery element
     * @param $ The jQuery alias
     */
    var SwiperSliderHandler = function ($scope, $) {
        //console.log($scope);
        var $selector = $scope.find('.swiper-container'),
            $dataSwiper = $selector.data('swiper'),
            mySwiper = new Swiper($selector, $dataSwiper);
    };
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/custom-culture-section.default', SwiperSliderHandler);
    });
})(jQuery);
