<!-- Display Images -->
<?php
if ( is_singular() && !is_front_page() ) {
	// get_template_part( 'loop/fragments/loop', 'imagelink' );

	 the_content();

} else {
	get_template_part( 'templates/loop/fragments/loop', 'indextitle' );
	get_template_part( 'templates/loop/fragments/loop', 'imagepermalink' );?>
	<p><?php the_excerpt(); ?></p>
	<a href="<?php the_permalink(); ?>" class="button">Read More</a>

<?php }
