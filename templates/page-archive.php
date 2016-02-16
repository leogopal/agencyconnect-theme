<?php
/*
Template Name: Archive
*/
get_header();

	/* select header template */
	do_action( 'nona_begin_template', 'default' );

		do_action('nona_wp_loop'); ?>
		
			<div class="content content-archive-page">
				<?php /* Create a new query overriding the main query */
					$args = array(
						'post_type' => 'testimonial'
					);

					nona_query_posts( $args ); ?>
			</div>

		<?php do_action('nona_sidebar');

	/* select footer template */
	do_action( 'nona_end_template', 'default' );

get_footer();