<?php if ( is_singular() && !is_front_page() ) { ?>

	<!-- <figure class="indeximg">
		<?php echo do_shortcode('[gallery columns="0" itemtag="span" icontag="span" link="file" exclude="' . get_post_thumbnail_id( $post->ID ) . '"]'); ?>
	</figure> -->
	<?php

	// add_shortcode( 'gallery', '__return_false' );
	the_content();

} else {
	get_template_part( 'loop/fragments/loop', 'indextitle' ); ?>

	<figure class="indeximg">
		<?php echo do_shortcode('[gallery columns="0" itemtag="span" icontag="span" link="file" exclude="' . get_post_thumbnail_id( $post->ID ) . '"]'); ?>
	</figure>

	<div class="indexcontent">
		<p><?php the_excerpt(); ?></p>
		<a href="<?php the_permalink(); ?>" class="button">Read More</a>
	</div>
<?php }