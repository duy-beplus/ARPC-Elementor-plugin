
// Even Show Share Socials Box
$('.btn-sharing').click(function (e) {
   $(this).next().slideToggle();
});

// Even Show Share Socials Box
$('.btn-faqs-share').click(function (e) {
   $(this).next().slideToggle();
});

 // Even Show Answer FAQs
$('.list-item-question').click(function (e) {
  $(this).children('.gg-chevron-up').toggleClass('inactive');
  $(this).children('.gg-chevron-down').toggleClass('active');
  $(this).next().slideToggle();
});
