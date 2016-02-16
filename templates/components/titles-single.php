<?php

/*

Single titles
- - - - - - - - - - - - - - - - - -
This determines whether we're on a page or post and
as well as whether we've used the page title override
meta boxes.

*/

$single_type  = "";
$single_title = "";
$single_desc  = "";

$meta = get_post_custom();

/* Get Post Meta */
$page_title = (isset($meta["_page_header_introtitle"]) && !empty($meta["_page_header_introtitle"])) ? $meta["_page_header_introtitle"][0] : "";
$page_desc  = (isset($meta["_page_header_introdesc"]) && !empty($meta["_page_header_introdesc"])) ? $meta["_page_header_introdesc"][0] : "";
$post_title = (isset($meta["_post_header_introtitle"]) && !empty($meta["_post_header_introtitle"])) ? $meta["_post_header_introtitle"][0] : "";
$post_desc  = (isset($meta["_post_header_introdesc"]) && !empty($meta["_post_header_introdesc"])) ? $meta["_post_header_introdesc"][0] : "";

// page title & description meta boxes
if ( (strlen($page_title) > 0) || (strlen($page_desc) > 0) ) {

  if( ( strlen( $page_title ) > 0 ) ) {
    $single_title = $page_title;
  } else {
    $single_title = get_the_title();
  }


  if( ( strlen( $page_desc ) > 0 ) ) {
    $single_desc = $page_desc;
  }

// post title & description meta boxes
} else if ( ( strlen($post_title > 0) ) || ( strlen($post_desc) > 0) ) {

  if( strlen( $post_title ) > 0 ) {
    $single_title = $post_title;
  } else{
    $single_title = get_the_title();
  }

  if( strlen($post_desc) > 0 ) {
    $single_desc = $post_desc;
  }

// Meta Boxes not used
} else {
  $single_title = get_the_title();
}

// if the title is not empty
if ( ( strlen( $single_title ) > 0 ) || ( strlen( $single_desc ) > 0 ) ) { ?>

  <h1 class="page-title">
    <?php echo $single_title; ?>
  </h1>
  <?php if ( is_single() ) {
    get_template_part( 'templates/loop/fragments/loop', 'meta' ); // doesn't work outside the loop properly
  } ?>
  <p class="page-description">
    <?php echo $single_desc; ?>
  </p>

<?php }