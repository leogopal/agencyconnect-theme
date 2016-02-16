<?php
/*
The Search Form Template
*/
?>
<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
	<label>
		<span class="screen-reader-text">Search for:</span>
		<input type="search" class="search-field" placeholder="Search" value="" name="s" title="Search for:" />
	</label>
	<button type="submit" class="search-submit" value="Search" >
		<i class="fa fa-search"></i>
	</button>
</form>