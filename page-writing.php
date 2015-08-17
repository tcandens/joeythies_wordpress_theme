<?php
/**
 * Template Name: Writing Page
 * Template for displaying collection of work items
 */

$context = Timber::get_context();
$posts = Timber::get_posts('post_type=post');
$context['title'] = 'Recent Writing';
$context['posts'] = $posts;
Timber::render( 'page-writing.twig', $context);
