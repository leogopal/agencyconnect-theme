<?php 
  /* Breadcrumbs fragment */ 

$bcDefaults = array(
  'container'       => 'div',   // container element
  'separator'       => '&#47;', // separator between items
  'before'          => '',      // HTML to output before
  'after'           => '',      // HTML to output after
  'show_on_front'   => false,    // whether to show on front
  'network'         => false,   // whether to create trail back to main site (multisite)
  'show_title'      => false,    // whether to show the current page title
  'show_browse'     => true,    // whether to show the "browse" text
  'echo'            => true,    // whether to echo or return the breadcrumbs

  /* Post taxonomy (examples follow). */
  'post_taxonomy' => array(
      // 'post'  => 'post_tag', // 'post' post type and 'post_tag' taxonomy
      // 'book'  => 'genre',    // 'book' post type and 'genre' taxonomy
  ),

  /* Labels for text used (see Breadcrumb_Trail::default_labels). */
  'labels' => array(
    'browse'              => __( 'Browse:',                             'breadcrumb-trail' ),
    'home'                => __( 'Home',                                'breadcrumb-trail' ),
    'error_404'           => __( '404 Not Found',                       'breadcrumb-trail' ),
    'archives'            => __( 'Archives',                            'breadcrumb-trail' ),
    /* Translators: %s is the search query. The HTML entities are opening and closing curly quotes. */
    'search'              => __( 'Search results for &#8220;%s&#8221;', 'breadcrumb-trail' ),
    /* Translators: %s is the page number. */
    'paged'               => __( 'Page %s',                             'breadcrumb-trail' ),
    /* Translators: Minute archive title. %s is the minute time format. */
    'archive_minute'      => __( 'Minute %s',                           'breadcrumb-trail' ),
    /* Translators: Weekly archive title. %s is the week date format. */
    'archive_week'        => __( 'Week %s',                             'breadcrumb-trail' ),

    /* "%s" is replaced with the translated date/time format. */
    'archive_minute_hour' => '%s',
    'archive_hour'        => '%s',
    'archive_day'         => '%s',
    'archive_month'       => '%s',
    'archive_year'        => '%s',
  )
); ?>

<nav class="breadcrumb-wrap">
  <!-- Bread Crumbs -->
  <?php breadcrumb_trail( $bcDefaults ); ?>
</nav>
