<?php /*

		General Loop
		- - - - - - - - - - - - - - - - - - - - -
		This file includes the loop inner template part which is used
		to decide which template partials to include.

*/

do_action( 'nona_start_loop' );

/* - - - - - - - - - - - - - - - - - - - -
start loop
- - - - - - - - - - - - - - - - - - - - -*/
if (have_posts() ) {
	while(have_posts() ) {
		the_post();

		// call our inner loop file.
		get_template_part( 'templates/loop/loop', 'inner' );

	}

} else {

	// If there are no posts
	echo "<p class='no-posts'>No posts found.</p>";

}
/* End Loop  */


/* Pagination
- - - - - - - - - - - - - - - - - - - - -*/
do_action('nona_paginate' );

// Rest the Query
wp_reset_postdata();
rewind_posts();

