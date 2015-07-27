<?php

if ( ! class_exists( 'Timber' ) ) {
  add_action( 'admin_notices', function() {
      echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#timber' ) ) . '">' . esc_url( admin_url( 'plugins.php' ) ) . '</a></p></div>';
    } );
  return;
}

class StarterSite extends TimberSite {

  function __construct() {
    add_theme_support( 'post-formats' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'menus' );
    add_filter( 'timber_context', array( $this, 'add_to_context' ) );
    add_filter( 'get_twig', array( $this, 'add_to_twig' ) );
    add_action( 'init', array( $this, 'register_post_types' ) );
    add_action( 'init', array( $this, 'register_taxonomies' ) );
    parent::__construct();
  }

  function register_post_types() {
    //this is where you can register custom post types
    register_post_type( 'work',
      array(
          'labels' => array(
            'name' => 'Work',
            'singular_name' => 'Work'
          ),
          'public' => true,
          'menu_position' => 5,
          'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail' )
      )
    );
  }

  function register_taxonomies() {
    //this is where you can register custom taxonomies
  }

  function add_to_context( $context ) {
    $context['menu'] = new TimberMenu('nav-menu');
    return $context;
  }

  function add_to_twig( $twig ) {
    /* this is where you can add your own fuctions to twig */
    $twig->addExtension( new Twig_Extension_StringLoader() );
    $twig->addFilter( 'myfoo', new Twig_Filter_Function( 'myfoo' ) );
    return $twig;
  }
  
}

new StarterSite();

function myfoo( $text ) {
  $text .= ' bar!';
  return $text;
}

/*
 *Disable the visual editor
 */
add_filter('user_can_richedit', create_function( '$a', 'return false;' ), 50);

/*
 *Add Custom QuickTags to editor
 */
function add_quicktags() {
  if (wp_script_is( 'quicktags' )) {
?>
  <script type="text/javascript">
  QTags.addButton( 'figure', 'figure', '<figure class="window">', '</figure>');
  </script>
<?php
  }
}
add_action('admin_print_footer_scripts', 'add_quicktags');

/*
 *Add editor quicktags on admin
 */
function show_quicktags( $qtInit ) {
  $qtInit['buttons'] = 'strong,em,block,ul,ol,li,link,code,fullscreen';
  return $qtInit;
}
add_filter('quicktags_settings', 'show_quicktags');

/*
 *Remove Auto Paragraphs from Img tags
 */
function filter_ptags_on_images($content){
   return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}
add_filter('the_content', 'filter_ptags_on_images');

/*
 *Register Site Wide Main Navigation Menu
 */
function register_my_menu() {
  register_nav_menu('nav-menu', __( 'Navigation Menu' ));
}
add_action( 'init', 'register_my_menu' );

/*
 *Enqueue Javascript & Stylesheets
 */
function enqueue_scripts() {
  wp_enqueue_style( 'stylesheet', get_template_directory_uri() . '/main.css' );
  wp_register_script( 'main-script', get_template_directory_uri() . '/js/main.js', array( 'jquery', 'backbone' ), false, true );
  wp_enqueue_script( 'main-script' );
}
add_action( 'wp_enqueue_scripts', 'enqueue_scripts' );
