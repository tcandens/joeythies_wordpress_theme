/* Break jQuery out of no-conflict mode */
jQuery(document).ready(function($) {

  var $body = $('body');
  var $html = $('html');
  /* Cut the mustard */
  $html.removeClass('no-js');

  /* Toggle State Class for Nav-Open */
  $('.js-navigation__button').click(function( e ) {
    e.preventDefault();
    $body.toggleClass('is-navigation-open');
  });

  $('.random-x').each(function( index ) {
    $( this ).offset({
      top: $('body').innerHeight() * Math.random()
    });
  });

});
