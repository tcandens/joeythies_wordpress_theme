<?php
/**
 * Template Name: Work Page
 * Template for displaying collection of work items
 */

$context = Timber::get_context();
$posts = Timber::get_posts('post_type=work');
$context['title'] = 'Recent Work';
$context['roles'] = Timber::get_terms('duty');
$context['posts'] = $posts;
Timber::render( 'page-work.twig', $context);
