<?php
/*
404 Error Page
*/
get_header(); 

	/* select header template */
	do_action( 'nona_begin_template', 'simple' );?>

		<div class="content content-full four-oh-four" role="main">
		     <h2>404</h2>
		    <p>This is a little embarrassing but the page you were looking for could not be found, please try searching the site or <a href="<?php echo home_url(); ?>">return to the home page.</a></p>
		     <?php get_search_form( true ); ?>
		</div>

	<?php /* select header template */
	do_action( 'nona_end_template', 'default' );

get_footer();