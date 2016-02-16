<?php /*

Meta
- - - - - - - - - - - - - - - - - -
The post meta fragment, it is included in page titles,
as well as in the post index.

*/ ?>

<em class="post-meta">
	<?php
		echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' old - ';
		nona_entry_meta();
		nona_format_archive_link();
	?>
</em>