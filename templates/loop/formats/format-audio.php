<?php
//	Display Audio

// Get the video from the content
$mediaurl = nona_extract_urls( get_the_content() );  // NB : wp_extract_urls does not work on URL's with a query in them - pre 4.1

// Check if we're on a single page
if ( is_singular() && !is_front_page() ) :

    the_content();

	else :
    // output a filtered excerpt displaying the result of the conditionals above.
    get_template_part( 'templates/loop/fragments/loop', 'indextitle' );

   	// Check if we have media
    if ( isset($mediaurl) && !empty($mediaurl) ) {
        if (wp_oembed_get($mediaurl[0])) {
        	echo apply_filters('the_excerpt', wp_oembed_get($mediaurl[0]) );
        }
	} else {
		get_template_part( 'templates/loop/fragments/loop', 'imagepermalink' );
	} ?>

    <p><?php the_excerpt(); ?></p>
    <a href="<?php the_permalink(); ?>" class="button">Read More</a>
<?php endif ?>
