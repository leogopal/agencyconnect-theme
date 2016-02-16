<?php

/*
Archive titles
- - - - - - - - - - - - - - - - - -
This determines what kind of archive we're in, 
and outputs the correct page title and description.

*/
$archive_type  = "";
$archive_title = "";
$archive_desc  = "";

// Archive / Catagory / Tag Page Headings
if ( is_archive() && !is_author() ) {
	$archive_type  = "archive";

	if ( is_day() ) {
		$archive_title = sprintf( __( 'Daily Archives : %s', 'nona' ), get_the_date() );
	} elseif ( is_month() ) {
		$archive_title = sprintf( __( 'Monthly Archives : %s', 'nona' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'nona' ) ) );
	} elseif ( is_year() ) {
		$archive_title = sprintf( __( 'Yearly Archives : %s', 'nona' ), get_the_date( _x( 'Y', 'yearly archives date format', 'nona' ) ) );
	} elseif ( is_post_type_archive() ) {
		$archive_title = sprintf(__('%s Archive','nona'), post_type_archive_title('', false) );
	} else {
		$archive_title = sprintf(__('%s Archive','nona'), single_term_title('', false) );
	}

	$archive_desc = term_description();

// search
} else if ( is_search() ) {

	$archive_type  = "search";
	$archive_title = sprintf(__('Searching %s','nona'), get_bloginfo('name') );

	// show a helpful message
	if ( have_posts() ) {
		$archive_desc = sprintf( __( 'You searched for <strong>"%s"</strong>, view the results below or try a different search term in the search bar above to find what you were looking for. ', 'nona' ), get_search_query() );

	// show a fail message
	} else {
		$archive_desc = sprintf( __( 'You searched for <strong>"%s"</strong> - Unfortunately <strong>we could not find anything </strong>matching that description exactly.  Try a different search term in the search bar above, return to the home page or contact us for more information. ', 'nona' ), get_search_query() );
	}

// Author
} else if ( is_author() ) {
	$archive_type  = "author";
	if ( have_posts() ) {
			/* Queue the first post, that way we know what author we're dealing with. */
		the_post();

		 $archive_title = sprintf( __( 'Author : %s', 'nona' ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' );

		rewind_posts();
	} else {
		$archive_title = sprintf( __( 'Author Archive', 'nona' ) );
	}

// Blog
} else if ( is_home() ) {
	$archive_type  = "blog";
			$archive_title = "All The News Things";
			$archive_desc =	"Direct from our heads, hearts and studio";

} // end conditional

// if the title is not empty
if ( strlen($archive_title ) > 0 ) { ?>
	
	<h1 class="page-title">
		<?php echo $archive_title; ?>
	</h1>
	<p class="page-description">
		<?php echo $archive_desc; ?>
	</p>

<?php }