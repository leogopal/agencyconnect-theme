<?php


class Nona_Content
{

  public function __construct()
  {
    add_filter('body_class', array($this, 'add_slug_to_body_class') );
    add_filter( 'nav_menu_item_id', array($this, 'remove_menu_ids' )  ); // remove menu ids
    add_filter('the_content', array($this, 'filter_ptags_on_images') );
    add_filter('excerpt_more', array($this, 'more') );
    add_filter( 'excerpt_length', array($this, 'custom_excerpt_length') , 999 ); // Limit the default amount of excerpt shown.
    add_filter('request', array($this, 'custom_feed_request' ) );
    add_filter('the_excerpt_rss', array($this, 'rss_post_thumbnail') );
    add_filter('the_content_feed', array($this, 'rss_post_thumbnail' ) );
    add_action('get_header', array($this, 'enable_threaded_comments') );
    add_filter('pre_comment_content', array($this, 'encode_code_in_comment' ) );

    /* Filters
    - - - - - - - - - - - - - - - - - - - - */
    remove_filter( 'the_excerpt', 'wpautop' );  // removes excerpt automatic p tags
    add_filter('the_excerpt', 'do_shortcode');  // Allow Shortcodes in the Excerpt field
    add_filter( 'use_default_gallery_style', '__return_false' ); // remove gallery default styling
    add_filter( 'widget_text', 'do_shortcode' ); // use shortcodes in widgets

    /* remove junk from head
    - - - - - - - - - - - - - - - - - - - - */
    remove_action( 'wp_head', 'rsd_link' );
    remove_action( 'wp_head', 'wp_generator' );
    remove_action( 'wp_head', 'index_rel_link' );
    remove_action( 'wp_head', 'wlwmanifest_link' );
    remove_action( 'wp_head', 'feed_links_extra', 3 );
    remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
    remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
    remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 );
  }

  /* Add page slug to body class
   - - - - - - - - - - - - - - - - - - - - - */
  public function add_slug_to_body_class($classes)
  {
      global $post;
      if (is_home()) {
          $key = array_search('blog', $classes);
          if ($key > -1) {
              unset($classes[$key]);
          }
      } elseif (is_page()) {
          $classes[] = sanitize_html_class($post->post_name);
      } elseif (is_singular()) {
          $classes[] = sanitize_html_class($post->post_name);
      }

      return $classes;
  }

  /* Remove menu id's to avoid duplicates and clean up for SEO
   - - - - - - - - - - - - - - - - - - - - - */
  public function remove_menu_ids() {
    $empty = "";
    return $empty;
  }


  /* fix p tags around images in the post editor - NB : should combine this with other image procesing below
    - - - - - - - - - - - - - - - - - - - - - */
  public function filter_ptags_on_images($content)
  {
     return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
  }


  /* Excerpt Read More
  - - - - - - - - - - - - - */
  public function more( $more )
   {
    return '...';
  }

  /* Custom default excerpt lengths
  - - - - - - - - - - - - - */
   public function custom_excerpt_length( $length ) 
   {
       return 65;
   }

  /*  add cpt to rss
   - - - - - - - - */
  public function custom_feed_request( $nonacustomfeed ) 
  {
    if (isset($nonacustomfeed['feed']))
      $nonacustomfeed['post_type'] = get_post_types();
    return $nonacustomfeed;
  }

  /* add thumbnails to RSS Feed
  - - - - - - - - - - - - - - - - - - - - */
  public function rss_post_thumbnail($content) 
  {
     global $post;
     if(has_post_thumbnail($post->ID)) {
         $content = '<p>' . get_the_post_thumbnail($post->ID) .
         '</p>' . get_the_content();
     }

     return $content;
  }

  // enable threaded comments
  // - - - - - - - - - - - - -
  function enable_threaded_comments()
  {
    if (!is_admin()) {
      if (is_singular() && comments_open() && (get_option('thread_comments') == 1))
        wp_enqueue_script('comment-reply');
    }
  }

  /* escape html entities in comments
    - - - - - - - - - - - - - - - - - - - - - */
  public function encode_code_in_comment($source) 
  {
    $encoded = preg_replace_callback('/<code>(.*?)<\/code>/ims',
    create_function('$matches', '$matches[1] = preg_replace(array("/^[\r|\n]+/i", "/[\r|\n]+$/i"), "", $matches[1]);
    return "<code>" . htmlentities($matches[1]) . "</"."code>";'), $source);
    if ($encoded)
      return $encoded;
    else
      return $source;
  }
  

}

$NonaContent = new Nona_Content();

