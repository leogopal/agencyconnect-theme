<?php
/*
Template Name: Full Width
*/
get_header(); 

	/* select header template */
	do_action( 'nona_begin_template', 'default' );

  /* Loop with fullwidth class */
	do_action('nona_wp_loop', 'content-full');

	/* select header template */
	do_action( 'nona_end_template', 'default' );

get_footer();