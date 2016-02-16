<?php

/*
  LOOP INNER
  - - - - - - - - - - - - - - - - - - - - -
  used as a traffic controller to determine what content to include
  in any particular template, in order to keep the majority of our
  templates cleaner and simpler to edit.  Its abstracted from Loop.php
  so that it can be used in custom loops in any template.

*/

/* LOOP CONFIG
- - - - - - - - - - - - - - - - - - - - -*/
$root        = 'templates/loop';
$loop_config = array(
  'index_class'    => 'excerpt',                      // add classes for layout
  'single_class'   => 'is-singular',                    // add classes for layout
  'format_path'    => $root.'/formats/format',              // store path to format fragments
  'postype_path'   => $root.'/posttypes/index',             // store path to post type fragments
  'single_path'    => $root.'/posttypes/single',              // store path to post type fragments
  'frag_path'      => $root.'/fragments/loop',              // store path to general fragments.
  'curr_post'      => ( get_query_var('type_override') ) 
            ? get_query_var('type_override') 
            : get_post_type(),                  // get current post type
  'post_class'     => implode( ' ', get_post_class( 'excerpt' ) ),
  'single_class'   => implode( ' ', get_post_class( 'is-singular' ) ),
  'closetag'       => "</article>"                    // used to close the article tags
);
extract($loop_config);

$openindex      = "<article id='post-".get_the_ID()."' class='".trim($post_class)."'>";
$opensingle     = "<article id='post-".get_the_ID()."' class='".trim($single_class)."'>";
$has_template   = locate_template( $postype_path."-".$curr_post.".php", 0, 0 );     // check for post type template
$has_single     = locate_template( $single_path."-".$curr_post.".php", 0, 0 );      // check for post type single template

/*
  Index / Archive / Category / Tag / search
  - - - - - - - - - - - - - - - - - - - - -
  we are also checking a custom query variable that should be set
  when declaring a new WP_Query Obj if you would like ti to act like an
  archive trigger.
*/
if (is_home() || is_archive() || is_search() || get_query_var( 'force_archive' ) ) {

  echo $openindex;

    // Check for post format
    if ( get_post_format() ) {
      get_template_part( $format_path, get_post_format() );

    // Check for Custom Post Type AND Template
      } else if ( $has_template && (is_post_type_archive() || get_query_var('type_override') ) ) {
        get_template_part( $postype_path, $curr_post );

      // Get the Default Type
    } else {
      get_template_part( $format_path, 'standard' );
      }

  echo $closetag; // close the article tag


 /*
   Single Page
  - - - - - - - - - - - - - - - - - - - - -
  This will run similar checks as above, formats use the same files for singular
  templates where as custom post types will require a index and single page, alternatively
  it will use the default single page.
*/
} else if ( is_singular() ) {
  echo $opensingle ;

    // Check for post format
    if ( get_post_format() ) {
      // get the post format template
      get_template_part( $format_path, get_post_format() );

    // Check for Custom Post Type AND Template
    } else if ( $has_single && ($curr_post !== 'post' 
          || $curr_post !== 'page') ) {
      // get the custom post type tempalte
      get_template_part( $single_path, $curr_post );

    // Default
    } else {
       // display the feautured image if there is one.
      get_template_part( $frag_path, 'imagelink' );

      // the main event
      the_content();

    }

    // additional items for posts
    if ( is_single() ) {
      wp_link_pages( array(             // page links for multi page content
        'before' => '<div class="page-links">' . __( 'Pages:', 'nona' ),
        'after' => '</div>' )
      );
      // get_template_part( $frag_path, 'social'); // Social Sharing Buttons
      nona_content_nav( 'nav-below' );        // Next - Previous Navigation
      comments_template( '', true );        // Comments
    }

  echo $closetag; // close the article tag

} // End Singular Conditional