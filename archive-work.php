<?php

$templates = array( 'page-work.twig', 'index.twig' );

$data = Timber::get_context();

$data['title'] = 'Recent Work';
$data['is_home'] = false;

$data['posts'] = Timber::get_posts();
$data['categories'] = Timber::get_terms('duty');

Timber::render( $templates, $data );

