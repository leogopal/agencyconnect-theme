<?php
/*
Template Name: Right Side bar
*/

get_header(); 

	/* select header template */
	do_action( 'nona_begin_template', 'default' );

		do_action('nona_wp_loop', 'swop');

		do_action('nona_sidebar', 'default', 'swop');

	/* select header template */
	do_action( 'nona_end_template', 'default' );

get_footer();