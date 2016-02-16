<blockquote class="index-quote">
	<?php the_content(); ?>
</blockquote>

<em class="post-meta">
	<?php
		echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' old - ';
		nona_entry_meta();
		nona_format_archive_link();
	?>
</em>

