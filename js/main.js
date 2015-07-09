/**********************
 **********************

/* Break jQuery out of no-conflict mode */
jQuery(document).ready(function($) {
  /* Cut the mustard */
  $('html').removeClass('no-js');
  var $body = $('body');
  $('.nav-button').click(function( e ) {
    e.preventDefault();
    $body.toggleClass('nav-open');
  });
});
