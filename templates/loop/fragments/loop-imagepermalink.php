<?php  /* Fragment for the featured image wrapped in a link to its post  */

$post_id = get_the_id();

if ( has_post_thumbnail() && get_the_post_thumbnail($post_id) != '' ) : ?>
	<figure class="image-wrap permalink-image">
		<a href="<?php the_permalink(); ?>">
			<?php the_post_thumbnail(); ?>
		</a>
	</figure>

<?php elseif ( get_post_format() == 'image' ) :

	$first_img = nona_get_image_from_post();
	$img = ( !has_shortcode( get_the_content(),  'caption' ) ) ?
		"<img src='".nona_get_image_from_post()."' alt='".esc_attr( get_the_title() )."'>" :
		do_shortcode( get_the_content() );

	if ( isset($first_img) && !empty($first_img) ) : ?>
		<figure class="image-wrap permalink-image">
			<a href="<?php the_permalink(); ?>">
				<!-- <img src="<?php echo nona_get_image_from_post(); ?>" alt="<?php esc_attr( get_the_title() ); ?>"> -->
				<?php echo $img; ?>
			</a>
		</figure>

<?php endif;
endif;