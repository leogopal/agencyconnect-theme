<?php

/*

   Admin Basic Customisations and niceties
   - - - - - - - - - - - - - - - - - - - -
   - change 'blog' menu title to 'blog posts'
   - Replace Admin Footer Text
   - add custom favicon to admin
   - add 'all settings' menu
   - Change WordPress Greeting

 */

class Nona_Admin 
{

  public function __construct() 
  {
    add_action( 'admin_menu', array( $this, 'rename_posts' ) );
    add_filter('admin_footer_text', array( $this, 'footer_copyright' ));
    add_action('admin_menu', array( $this, 'show_system_settings' ));
    add_action( 'admin_bar_menu', array( $this, 'admin_greeting' ), 11, 1 );
    add_action('admin_head', array( $this,'remove_admin_color_scheme') );
    add_action('init', array( $this, 'new_author_base_url') );
    add_action('pre_get_posts', array( $this, 'custom_post_author_archive' ));
    add_filter('user_contactmethods',array( $this, 'new_contact_methods'),10,1);
    // add_filter('avatar_defaults', 'custom_gravatars');  // TODO : create custom gravatars and update the method
    remove_filter('pre_user_description', 'wp_filter_kses'); //  enable html markup in user profiles
  }

  /* changing 'posts' to 'Blog Posts'
  - - - - - - - - - - - - - - - - - - - - - */
  public function rename_posts() 
  {
      global $menu;
      $menu[5][0] = 'Blog Posts';
  }


  /* Replace admin footer Text
  - - - - - - - - - - - - - - - - - - - - - */
  public function footer_copyright() 
  {
    echo 'This site designed and developed by <a href="http://www.nonacreative.com">Nona Creative</a>.';
  }


  /* admin link for all settings
  - - - - - - - - - - - - - - - - - - - - - */
  public function show_system_settings() 
  {
    add_options_page(__('All Settings'), __('All Settings'), 'administrator', 'options.php');
  }

  /* Change Admin Bar Gretting
  - - - - - - - - - - - - - - - -*/
  public function admin_greeting( $wp_admin_bar ) 
  {
    $user_id      = get_current_user_id();
    $current_user = wp_get_current_user();
    $profile_url  = get_edit_profile_url( $user_id );

    if ( 0 != $user_id ) {

      /* Add the "My Account" menu */
      $avatar = get_avatar( $user_id, 28 );
      $howdy  = sprintf( __('hello %1$s', 'nona'), $current_user->first_name );
      $class  = empty( $avatar ) ? '' : 'with-avatar';

      $wp_admin_bar->add_menu(
        array(
          'id'     => 'my-account',
          'parent' => 'top-secondary',
          'title'  => $howdy . $avatar,
          'href'   => $profile_url,
          'meta'   => array(
            'class'  => $class,
          ),
        )
      );
    }
  } // end admin greeting


  /* remove user admin color scheme option
   - - - - - - - - - - - - - - - - - - - - - */
  function remove_admin_color_scheme() 
  {
     global $_wp_admin_css_colors;
     $_wp_admin_css_colors = 0;
  }

  /* Change the base url for authors from "authors"
  - - - - - - - - - - - - - - - - - - - - - */
  function new_author_base_url() 
  {
      global $wp_rewrite;
      $author_slug = 'writers';
      $wp_rewrite->author_base = $author_slug;
  }
  
  /* Add specific CPT's to author archives
  - - - - - - - - - - - - - - - - - - - - - */
  function custom_post_author_archive($query) 
  {
      if ($query->is_author)
          $query->set( 'post_type', array('testimonial', 'post') );
      remove_action( 'pre_get_posts', 'custom_post_author_archive' );
  }
  

  /* Change Default profile contact info - http://wp-snippets.com/1705/addremove-contact-info-fields/
    - - - - - - - - - - - - - - - - - - - - - */
  function new_contact_methods( $contactmethods ) 
  {
     $contactmethods['twitter'] = 'Twitter';
     $contactmethods['linkedin'] = 'LinkedIn';
     $contactmethods['behance'] = 'Behance'; 
     $contactmethods['pinterest'] = 'Pinterest'; 
     unset($contactmethods['yim']); // Remove YIM
     unset($contactmethods['aim']); // Remove AIM
     unset($contactmethods['jabber']); // Remove Jabber

     return $contactmethods;
  }

  /* customize default gravatars
  - - - - - - - - - - - - - - - - - - - - - */
  function custom_gravatars($avatar_defaults) 
  {

    // change the default gravatar
    $customGravatar1 = get_template_directory_uri() .'/images/gravatar01.png';
    $avatar_defaults[$customGravatar1] = 'Default';

    // add a custom user gravatar
    $customGravatar2 = get_template_directory_uri() .'/images/gravatar02.png';
    $avatar_defaults[$customGravatar2] = 'Custom Gravatar';

    // add another custom gravatar
    $customGravatar3 = get_template_directory_uri().'/images/gravatar03.png';
    $avatar_defaults[$customGravatar3] = 'Custom Gravatar 2';

    return $avatar_defaults;
  }
  
}
