<?php

// Get the video from the content
$linkurl = nona_extract_urls( get_the_content() );  // NB : wp_extract_urls does not work on URL's with a query in them - pre 4.1
$link = ( isset($linkurl) && !empty($linkurl) ) ? $linkurl : array('#');

if ( is_singular() && !is_front_page() ) { ?>

	<em class="indexlink">
		<?php echo $link[0]; ?>
	</em>

	<?php the_content(); ?>

	<a href="<?php echo $link[0]; ?>" class="button" rel="follow">
		Go To Link
	</a>

<?php } else { ?>

	<?php get_template_part( 'templates/loop/fragments/loop', 'indextitle' ); ?>
	<!-- the link -->
	<em class="indexlink">
		<?php echo $link[0]; ?>
	</em>

	<?php the_excerpt(); ?>

	<!-- external link -->
	<a href="<?php echo $link[0]; ?>" class="button" rel="follow">
		Go To Link
	</a>

 <?php } ?>
