<?php

get_template_part( 'templates/loop/fragments/loop', 'indextitle' );

get_template_part( 'templates/loop/fragments/loop', 'imagepermalink' ); ?>

<div class="indexcontent">
	<p><?php the_excerpt() ?></p>
	<a href="<?php the_permalink(); ?>" class="button">Read More</a>
</div>


