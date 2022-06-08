$(document).ready(function () {
    $('#board').css('display', 'block')
    $('#leadership').css('display', 'none')
    $('#tab-board').addClass('list-active')
})
// document.ready(function () {
//     document.getElementById('board').style.display = "block";
//     document.getElementById('tab-board').classList.add("list-active");
//     document.getElementById('leadership').style.display = "none";
// })
function openTab(name) {
    var i;
    var x = document.getElementsByClassName("team_member-section-posts");
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
    }
    document.getElementById(name).style.display = "block";
}

$(document).ready(function () {
    $(".team_member-section-list-item").click(function () {
        $(".team_member-section-list-item").removeClass("list-active");
        $(this).addClass("list-active");
    });
})

// Even Show Share Socials Box
$('.share-btn').click(function (e) {
   $(this).next().slideToggle();
});

// $(document).ready(function () {
//     var getNumberPost = $('.data-post').data('numberPost')
//     console.log(getNumberPost)
//     $('.team_member-expand').click(function () {
//         $('.data-post').attr("data-number-post", "3")
//     })
// })

$(document).ready(function () {
    var postExpand = $('.data-post').data('expand')
    var textExpand = $('.team_member-expand span').data('textExpand')
    if (postExpand == '') {
        $('.team_member-section-posts').addClass('team_member-section-posts-expand')
    } else {
        $('.team_member-section-posts').removeClass('team_member-section-posts-expand')
    }
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
