<?php

if ( ! class_exists( 'Timber' ) ) {
	echo 'Timber not activated. Make sure you activate the plugin in <a href="/wp-admin/plugins.php#timber">/wp-admin/plugins.php</a>';
	return;
}
$context = Timber::get_context();
$args = array(
	'post_type' => array( 'post', 'work' )
);
$context['posts'] = Timber::get_posts( $args );
$context['intro'] = Timber::get_posts( array( 'pagename' => 'intro ') )[0];
Timber::render( 'index.twig', $context );
