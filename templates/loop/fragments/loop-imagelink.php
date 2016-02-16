<?php /*  Fragment for images with a link to the full size media */
if ( has_post_thumbnail() && is_single() ) { ?>
<figure class="image-wrap single-featured-image">
	<?php $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
		echo '<a href="' . $large_image_url[0] . '" title="' . the_title_attribute('echo=0') . '" >';
		the_post_thumbnail('feature');
		echo '</a>'; ?>
</figure>
<?php }