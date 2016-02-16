<?php
/*
Template Name: Contact
*/

get_header(); 

	/* select header template */
	do_action( 'nona_begin_template', 'default' );

		/* Do the loop - See templates/loop/loop.php */
		do_action('nona_wp_loop', 'contact');

		/* Get the sidebar */
		do_action('nona_sidebar', 'contact');

	/* select header template */
	do_action( 'nona_end_template', 'default' );

get_footer();