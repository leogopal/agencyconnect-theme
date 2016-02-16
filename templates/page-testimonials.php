<?php /* 
	Template Name: Testimonials 
*/

get_header(); 

	/* select header template */
	do_action( 'nona_begin_template', 'simple' );?>

	<div class="content content-full" role="main">
		<div class="cycle-slideshow testimonial-slider clearfix"
			data-cycle-fx="fade"
			data-cycle-timeout="0"
			data-cycle-speed="430"
			data-cycle-prev=".prev"
			data-cycle-next=".next"
			data-cycle-loop="1"
			data-cycle-allow-wrap="true"
			data-cycle-slides="> .testimonial"
			data-cycle-auto-height="container"
			data-cycle-log="false">

			<?php $args = array(
					'post_type' => 'testimonial',
					'posts_per_page' => 40
				);

				nona_wp_query($args, true);  ?>
		</div>

	</div>

	<nav class="clearfix slidenav">
		<a href="#" class="prev hidden">prev</a>
		<a href="#" class="next hidden"> next</a>
	</nav>

	<?php /* select header template */
	do_action( 'nona_end_template', 'default' );

get_footer();