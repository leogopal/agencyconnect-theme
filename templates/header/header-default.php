<?php
/* Header Center Logo / Menu Fragment */
?>
<header class="headwrap wrap" role="banner">
	<div class="grid-container" >
		<?php 
      get_template_part('templates/components/header', 'sitetitle');
			get_template_part('templates/components/nav', 'header');

      // get_template_part( 'header/header', 'left' ); // above
      if (!is_front_page()) {
        do_action( 'nona_page_title' );
        get_template_part('templates/components/breadcrumbs');
      } 
    ?>
	</div>
</header>

<!-- Start Content Section - Outer wrap and inner wrap. -->
<main class="mainwrap wrap" role="main">
	<div class="grid-container main">