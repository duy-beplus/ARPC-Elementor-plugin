// Even Show Answer FAQs
$('.list-item-question').click(function (e) {
  $(this).toggleClass('active');
  $(this).next().slideToggle();
});
