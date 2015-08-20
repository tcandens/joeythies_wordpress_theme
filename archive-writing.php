<?php

$templates = array( 'page-writing.twig', 'index.twig' );

$data = Timber::get_context();

$data['title'] = 'Recent Writing';
$data['is_home'] = false;

$data['posts'] = Timber::get_posts();
$data['categories'] = Timber::get_terms('categories');

Timber::render( $templates, $data );

