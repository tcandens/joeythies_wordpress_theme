<?php

$context = Timber::get_context();
$post = Timber::query_post();
$context['post'] = $post;
$context['techs'] = Timber::get_terms('tech');
$context['duties'] = Timber::get_terms('duty');

Timber::render( 'single-work.twig', $context );
