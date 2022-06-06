(function ($) {
    /**
       * @param $scope The Widget wrapper element as a jQuery element
     * @param $ The jQuery alias
     */
    var WidgetCustomTeam = function ($scope, $) {
        var tabBoard = $scope.find('#tab-board')
        tabBoard.addClass('list-active')
        var board = $scope.find('#board')
        board.css('display', 'block')
        var leadership = $scope.find('#leadership')
        leadership.css('display', 'none')
        var listTab = $scope.find(".team_member-section-list-item")
        listTab.click(function () {
            listTab.removeClass("list-active")
            $(this).addClass("list-active")
        })

        // var postExpand = $scope.find('.data-post').data('expand')
        // if (postExpand == '') {
        //     $scope.find('.team_member-section-posts').addClass('team_member-section-posts-expand')
        // } else {
        //     $scope.find('.team_member-section-posts').removeClass('team_member-section-posts-expand')
        // }
    };

    // Make sure you run this code under Elementor.
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/team-member-widget.default', WidgetCustomTeam);
    });
})(jQuery);

function openTab(name) {
    var i
    var x = $('.team_member-section-posts')
    for (i = 0; i < x.length; i++) {
        $(x[i]).css('display', 'none')
    }
    $('#' + name + ' ').css('display', 'block');
}

$(document).ready(function () {
    var postExpand = $('.data-post').data('expand')
    var textExpand = $('.team_member-expand span').data('textExpand')
    if (postExpand == '') {
        $('.team_member-section-posts').addClass('team_member-section-posts-expand')
    } else {
        $('.team_member-section-posts').removeClass('team_member-section-posts-expand')
    }
    var textExpand = $('.team_member-expand span').data('textExpand')
    $('.team_member-expand').click(function () {
        if ($('.team_member-section-posts').hasClass('team_member-section-posts-expanded')) {
            $('.team_member-section-posts').removeClass('team_member-section-posts-expanded').css('transition', '0.3s')
            $('.team_member-section-posts').addClass('team_member-section-posts-expand').css('transition', '0.3s')
            $('.team_member-expand i').removeClass('fa-chevron-up')
            $('.team_member-expand i').addClass('fa-chevron-down')
            $('.team_member-expand span').html(textExpand)
        }
        else {
            $('.team_member-section-posts').removeClass('team_member-section-posts-expand').css('transition', '0.3s')
            $('.team_member-section-posts').addClass('team_member-section-posts-expanded').css('transition', '0.3s')
            $('.team_member-expand span').html('Close')
            $('.team_member-expand i').removeClass('fa-chevron-down')
            $('.team_member-expand i').addClass('fa-chevron-up')
        }
    })
})

// $(document).ready(function () {
//     $(".team_member-section-list-item").click(function () {
//         $(".team_member-section-list-item").removeClass("list-active");
//         $(this).addClass("list-active");
//     });
// })

// $(document).ready(function () {
//     var getNumberPost = $('.data-post').data('numberPost')
//     console.log(getNumberPost)
//     $('.team_member-expand').click(function () {
//         $('.data-post').attr("data-number-post", "3")
//     })
// })