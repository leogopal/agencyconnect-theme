<?php /*
	Default Template
	- - - - - - - - - 
	handles, index, single, page, archive, search, and author, as well 
	as remaining the standard default page for any other requests
	not handled by specific tempaltes.

	To Better understand the actions and tempaltes, check lib/Nona_layout.php, 
	lib/Nona_Sidebars.php and have a loop at the templates directory.
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