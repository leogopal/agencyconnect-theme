<?php get_header(); 
	/* select header template */
	do_action( 'nona_begin_template', 'simple' );

		do_action('nona_wp_loop', 'content-full');

	/* close appropriately  */
	do_action( 'nona_end_template', 'simple' );

get_footer(); ?>