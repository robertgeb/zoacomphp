$(document).ready(function () {
  $('#carregando').fadeOut(600, function () {
    $('#menu').show(1000, function () {
      $('#conteudoPrincipal').fadeIn(600);
    });
  });

  //Links do menu
  $('.nav > li').click(function () {
    var alvo = $(this).children().attr('href');
    // $('html,body').animate({
    //   scrollTop: $('#'+alvo).offset().top
    // }, 500);
    return false;
  });
});
