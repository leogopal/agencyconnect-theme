<?php
$fields 	= get_post_custom(); 
$client 	= isset($fields['_t_det_client'][0]) && !empty($fields['_t_det_client'][0]) ? $fields['_t_det_client'][0] : '';
$position 	= isset($fields['_t_det_position'][0]) && !empty($fields['_t_det_position'][0]) ? $fields['_t_det_position'][0] : '';
$company 	= isset($fields['_t_det_company'][0]) && !empty($fields['_t_det_company'][0]) ? $fields['_t_det_company'][0] : '';

?> 

<blockquote>
	<?php the_content(); ?>
	<cite>
		<?php echo $client.' - '.$position; ?>
		<strong><?php echo $company; ?></strong> 
	</cite>
</blockquote>


