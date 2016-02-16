<?php
/*
Template Name: Home Page
*/
get_header(); 

	/* select header template */
	do_action( 'nona_begin_template', 'default' );

		/* Do the loop - See templates/loop/loop.php */
		do_action('nona_wp_loop');

		/* Get the sidebar */
		do_action('nona_sidebar');

	/* select header template */
	do_action( 'nona_end_template', 'default' );
  
get_footer();