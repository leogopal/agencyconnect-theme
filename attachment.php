<?php
/*
Attachment Page
*/
get_header(); 

	/* select header template */
	do_action( 'nona_begin_template', 'default' );?>

<div class="content content-full attachment" role="main">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<h2><?php the_title(); ?></h2>

		<div class="entry-attachment">
			<?php if ( wp_attachment_is_image( $post->id ) ) : $att_image = wp_get_attachment_image_src( $post->id, "full"); ?>
			    <div class="attachment">
			    	<a href="<?php echo wp_get_attachment_url($post->id); ?>" title="<?php the_title(); ?>" rel="attachment">
			    		<img src="<?php echo $att_image[0];?>" width="<?php echo $att_image[1];?>" height="<?php echo $att_image[2];?>"  class="attachment-medium" alt="<?php $post->post_excerpt; ?>" />
					</a>
			    </div>
				<?php else : ?>
				<a href="<?php echo wp_get_attachment_url($post->ID) ?>" title="<?php echo esc_html( get_the_title($post->ID), 1 ) ?>" rel="attachment"><?php echo basename($post->guid) ?></a>
			<?php endif; ?>
		</div>

	<?php endwhile; endif; ?>
</div>

<?php /* select header template */
do_action( 'nona_end_template', 'default' );

get_footer();