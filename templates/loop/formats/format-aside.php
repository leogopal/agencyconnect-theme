<!-- Display Side Notes - Asides  -->
<?php

if ( is_singular() && !is_front_page() ) {
	the_content();
} else {
	get_template_part( 'templates/loop/fragments/loop', 'indextitle' );
	 the_content(); ?>
	<!-- <a href="<?php the_permalink(); ?>" class="button">Read More</a>  -->
<?php }
