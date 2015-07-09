console.log('script found!');

/* Break jQuery out of no-conflict mode */
jQuery(document).ready(function($) {
  var $body = $('body');
  $('.nav-button').click(function( e ) {
    e.preventDefault();
    $body.toggleClass('nav-open');
  });
});
