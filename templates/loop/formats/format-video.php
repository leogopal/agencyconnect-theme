<?php // Display Videos

// Get the video from the content
$mediaurl = nona_extract_urls( get_the_content() );  // NB : wp_extract_urls does not work on URL's with a query in them - pre 4.1

// Check if we're on a single page
if ( is_singular() && !is_front_page() ) :
	the_content(); // Output the Content

else : // we're on some sort of listing page.
	get_template_part( 'templates/loop/fragments/loop', 'indextitle' );

	// Check if we have media
	if ( isset($mediaurl) && !empty($mediaurl) ) {
		if (wp_oembed_get($mediaurl[0])) {
        	echo apply_filters('the_excerpt', wp_oembed_get($mediaurl[0]) ); // Append the media embed to the excerpt hook
        }
	} else {
		get_template_part( 'templates/loop/fragments/loop', 'imagepermalink' );  // alternatively output the featured image

	} ?>

	<p><?php the_excerpt(); ?></p>
	<a href="<?php the_permalink(); ?>" class="button">Read More</a>

<?php endif ?>
