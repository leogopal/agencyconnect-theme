<?php
/*
Template Helpers

*/

/* RESS using Mobile Detect */
include "vendor/mobiledetect/mobiledetectlib/Mobile_Detect.php";

/* Init the Mobile Detect Class */
$detect = new Mobile_Detect;

/* Nona Detect Function */
function nona_detect($q = 'mobile') {
  global $detect;

  switch ($q) {
    case 'mobile':
      $is = ( $detect->isMobile() && !$detect->isTablet() );
      break;

    case 'tablet':
      $is = $detect->isTablet();
      break;

    case 'desktop':
      $is = (!$detect->isMobile());
      break;

    case 'ios':
      $is = $detect->isiOS();
      break;

    case 'android':
      $is = $detect->isAndroidOS();
      break;

    default:
      $is = false;
      break;
  }

  return $is;
}

// Basic Pagination
//- - - - - - - - - - - - -
if ( ! function_exists( 'nona_content_nav' ) ) {
  function nona_content_nav( $nav_id ) {
    global $wp_query;

    ?>
    <nav id="<?php echo $nav_id; ?>" class="grid-parent">

    <?php if ( is_single() ) : // navigation links for single posts ?>

      <?php previous_post_link( '<div class="nav-previous">%link</div>', '<span class="meta-nav"><i class="fa fa-angle-left"></i>' . _x( '', 'nona' ) . '</span> %title' ); ?>
      <?php next_post_link( '<div class="nav-next">%link</div>', '%title <span class="meta-nav"><i class="fa fa-angle-right"></i>' . _x( '', 'nona' ) . '</span>' ); ?>

    <?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

      <?php if ( get_next_posts_link() ) : ?>
        <div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav"><i class="fa fa-angle-left"></i></span> Older posts', 'nona' ) ); ?></div>
      <?php endif; ?>

      <?php if ( get_previous_posts_link() ) : ?>
        <div class="nav-next "><?php previous_posts_link( __( 'Newer posts <span class="meta-nav"><i class="fa fa-angle-right"></i></span>', 'nona' ) ); ?></div>
      <?php endif; ?>

    <?php endif; ?>
    <div class="clear"></div>
    </nav><!-- #<?php echo $nav_id; ?> -->
    <?php
  }
} // nona_content_nav


/* Numberic Pagination
- - - - - - - - - - - - - */
if ( !function_exists('nona_paginate') ) {
  function nona_paginate() {
      global $wp_query, $wp_rewrite;
      $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
      $pagination = array(
        'base'    => @add_query_arg('page','%#%'),
        'format'  => '',
        'total'   => $wp_query->max_num_pages,
        'current'   => $current,
        'show_all'  => true,
        'prev_text' => '<i class="fa fa-angle-left"></i>',
        'next_text' => '<i class="fa fa-angle-right"></i>',
        'type'    => 'list'
      );
      if( $wp_rewrite->using_permalinks() ) {
        $pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );
      }
      if( !empty($wp_query->query_vars['s']) ) {
        $pagination['add_args'] = array( 's' => get_query_var( 's' ) );
      }

      return paginate_links( $pagination );
  }
}


/* Nona Meta - TODO : might be better in a template
- - - - - - - - - - - - - */
function nona_entry_meta() {
  // used between list items, there is a space after the comma.
  $categories_list = get_the_category_list( __( ', ', 'nona' ) );

  // used between list items, there is a space after the comma.
  $tag_list = get_the_tag_list( '', __( ', ', 'nona' ) );

  $date = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a>',
    esc_url( get_permalink() ),
    esc_attr( get_the_time() ),
    esc_attr( get_the_date( 'c' ) ),
    esc_html( get_the_date() )
  );

  $author = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
    esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
    esc_attr( sprintf( __( 'View all posts by %s', 'nona' ), get_the_author() ) ),
    get_the_author()
  );

  // 1 is category, 2 is tag, 3 is the date and 4 is the author's name.
  if ( $tag_list ) {
    $utility_text = __( 'This entry was posted in %1$s and tagged %2$s on %3$s <span class="by-author"> by %4$s</span>.', 'nona' );
  } else if ( '' != $categories_list ) {
    $utility_text = __( 'This entry was posted in %1$s on %3$s <span class="by-author"> by %4$s</span>.', 'nona' );
  } else {
    $utility_text = __( 'This entry was posted on %3$s <span class="by-author"> by %4$s</span>.', 'nona' );
  }

  printf (
    $utility_text,
    $categories_list,
    $tag_list,
    $date,
    $author
  );
} // end entry meta function

/* Show Post Format Archive link
- - - - - - - - - - - - - */
function nona_format_archive_link() {
    $format = get_post_format();
    $format_link = get_post_format_link($format);
    if ( !empty($format_link) ) {
      echo '<a href="' . $format_link . '"> View ' . $format . ' Archive</a>';
    }
}


/* Use RegEx to extract URLs from arbitrary content. PATCH wp-includes/functions.php - once sorted in core update to call the wp function. 
- - - - - - - - - - - - - - - - - - - - */
function nona_extract_urls( $content ) {
    preg_match_all(
        "#([\"']?)("
            . "(?:([\w-]+:)?//?)"
            . "[^\s()<>]+"
            . "[.]"
            . "(?:"
                . "\([\w\d]+\)|"
                . "(?:"
                    . "[^`!()\[\]{};:'\".,<>«»“”‘’\s]|"
                    . "(?:[:]\d+)?/?"
                . ")+"
            . ")"
        . ")\\1#",
        $content,
        $post_links
    );

    $post_links = array_unique( array_map( 'html_entity_decode', $post_links[2] ) );

    return array_values( $post_links );
}

/* used as a fallback for post format 'image' if no featured image set
- - - - - - - - - - - - - - - - - - - - */
function nona_get_image_from_post() {
  global $post, $posts;
  $content = $post->post_content;
  ob_start();
  ob_end_clean();
  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $content, $matches);

  if( isset( $matches[1] ) && !empty( $matches[1] ) ) {
    $img_link = $matches[1][0];
  } else {
    $img_link = "";
  }

  return $img_link;
}

/* Custom title lengths
- - - - - - - - - - - - - */
function nona_title($length) {
    global $post;
    $content = strip_tags($post->post_title);
    preg_match('/^\s*+(?:\S++\s*+){1,'.$length.'}/', $content, $matches);
    if ( !empty($matches) && count($matches)>0 ) {
      echo  $matches[0];
  }
}

/* Custom excerpt lengths
- - - - - - - - - - - - - */
function nona_excerpt($length) {
    global $post;
    $content = strip_tags($post->post_content);
    preg_match('/^\s*+(?:\S++\s*+){1,'.$length.'}/', $content, $matches);
    if ( !empty($matches) && count($matches)>0 ) {
      echo "<p>" . $matches[0] . "</p>";
    }
}


/* Secondary Loops convenience function
- - - - - - - - - - - - - - - - - - - - */
function nona_wp_query($args, $force_archive = true) 
{
   /*
    Setup a secondary query
    - - - - - - - - - - - - - - - - - - -
    everything here works as WP_Query usually does. Our Loop files though,
    require the WP_Conditionals to apply, which they don't, unless we alter
    the main query with query_posts.

    In Order to tell our loop to output archive style post listings, we need to
    set an arbitrary custom key / value in the query vars that our loop can
    check for, as well as the post type 
  */

  // Initialize a new WP_Query Object
  $custom_query = new WP_Query( $args );

  // This sets an arbitrary value in the query_vars
  global $wp_query;
  $wp_query->set( 'force_archive', $force_archive );

  if ( $args['post_type'] !== 'post' )
    $wp_query->set( 'type_override', $args['post_type'] );

  // Loop with the new WP_Query Object
  if ( $custom_query->have_posts() ) {
    while ( $custom_query->have_posts() ) {
      $custom_query->the_post();
        get_template_part( 'templates/loop/loop', 'inner' );
    }
  } // end loop

}

/* Loop Override 
- - - - - - - - - - - - - - - - - - - - */
function nona_query_posts($args)
{ 
  /*
    Setup a new primary query
    - - - - - - - - - - - - - - - - - - -
    everything here works as query posts usually does, its main
    purpose is to create post type archive page tempaltes, where we 
    require the functionality of a page template, with all the behaviour
    of an archive such as pagination.
  */

  $paged = 1;

  if ( get_query_var('paged') ) $paged = get_query_var('paged');
  if ( get_query_var('page') ) $paged = get_query_var('page');

  $args['paged'] = $paged;

  query_posts( $args );

  get_template_part('templates/loop/loop');

  wp_reset_query();

}

//Comments
// - - - - - - - - - - - - -
if ( ! function_exists( 'nona_comment' ) ) {
  function nona_comment( $comment, $args, $depth ) {

    $GLOBALS['comment'] = $comment;
    switch ( $comment->comment_type ) :
      case 'pingback' :
      case 'trackback' :
    ?>
    <li class="post pingback">
      <i class="fa fa-link align-left"></i> <p> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'nona' ), ' ' ); ?></p>
    </li>
    <?php
        break;
      default :
    ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
      <article id="comment-<?php comment_ID(); ?>" class="comment">
        <div>
          <div class="comment-author vcard">
            <?php echo get_avatar( $comment, 110 ); ?>
          </div><!-- .comment-author .vcard -->
        </div>

        <div class="comment-content">
          <div class="comment-meta commentmetadata">
          <?php printf(  sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
             <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"> - <time pubdate datetime="<?php comment_time( 'c' ); ?>">
            <?php
              /* translators: 1: date, 2: time */
              printf( __( '%1$s at %2$s', 'nona' ), get_comment_date(), get_comment_time() ); ?>
            </time></a>
            <?php edit_comment_link( __( '(Edit)', 'nona' ), ' ' );
            ?>
          </div><!-- .comment-meta .commentmetadata -->

          <?php comment_text(); ?>

          <?php if ( $comment->comment_approved == '0' ) : ?>
            <em class="waitnote"><?php _e( 'Your comment is awaiting moderation.', 'nona' ); ?></em>
            <br />
          <?php endif; ?>

          <div class="reply">
            <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
          </div><!-- .reply -->
        </div>


      </article><!-- #comment-## -->
    </li>
    <?php
        break;
    endswitch;
  }
} // ends check for nona_comment()
