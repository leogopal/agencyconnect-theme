<?php
/**
 * Theme Features and functionality
 * @author Paul van Zyl <paul@nonacreative.com>
 */

/**
 * Include Libraries / Modules & Custom Functionality
 */
if ( !class_exists( 'ReduxFramework' ) && file_exists( dirname( __FILE__ ) . '/lib/vendor/options/redux-framework/ReduxCore/framework.php' ) ) 
{
  require_once( dirname( __FILE__ ) . '/lib/vendor/options/redux-framework/ReduxCore/framework.php' );
}

if ( !isset( $redux_demo ) && file_exists( dirname( __FILE__ ) . '/lib/Nona_Options.php' ) ) 
{
  require_once( dirname( __FILE__ ) . '/lib/Nona_Options.php' );
  // require_once(dirname( __FILE__ ) .  '/functions/theme-options/sample/sample-config.php'); // use for testing.
}


/**
 * Vendor libs
 *  - BreadCrumbs
 *  - Custom Post Types and Meta Helper
 *  - Theme Options Render Functions
 *   - Options Render Functions
 *   TODO : Refactor Options Render Functions
 */
include 'lib/vendor/justintadlock/breadcrumb-trail/inc/breadcrumbs.php';
include 'lib/nona-custom-posts-and-meta.php';
include 'lib/nona-options-render.php';


/**
 * Theme Modules 
 * Used primarily to setup custom functionality
 */
include 'lib/Nona_Scripts.php';
include 'lib/Nona_Content.php'; 
include 'lib/Nona_Admin.php';
include 'lib/Nona_Editor.php';
include 'lib/Nona_Sidebars.php';
include 'lib/Nona_Layout.php';

/**
 * Theme functions & Extension
 * TODO : Refactor shortcodes and widgets
 */
include 'lib/old/nona-shortcodes.php';
include 'lib/old/nona-widgets.php';
include 'lib/nona_template_helpers.php';

/**
 * On Theme Setup
 * This requires some customization for each new project
 */
if ( !function_exists( 'nona_theme_setup' ) ) 
{
  function nona_theme_setup() 
  {

    /* add language files */
    // load_theme_textdomain( 'nona', get_template_directory() . '/functions/assets/languages' );

    /* arbitrary max content width required by WP */
    if ( !isset( $content_width ) ) 
    {
      $content_width = 900;
    }

    /* add Editor Style Sheet */
    add_editor_style( 'public/css/editor.min.css' );

    /*  Theme Support */
    add_theme_support( 'automatic-feed-links' );                          // add feed links
    add_theme_support( 'html5', array( 'comment-list', 'search-form', 'comment-form', ) );    // add HTML5 elements
    add_theme_support( 'post-formats', array( 'gallery', 'image', 'video', 'audio', 'link' ) ); // add post-formats
    add_theme_support( 'post-thumbnails' );                           // add post thumbnails
    // add_theme_support( 'woocommerce' );

    /* disable WooCommere default CSS */
    // define('WOOCOMMERCE_USE_CSS', false);

    /* custom image sizes - name - width - height - crop */
    // add_image_size( 'indeximg', 230, 150 );
    // add_image_size( 'feature', 480, 320 );
    // add_image_size( 'slider', 0, 0 );

    /* Add custom image sizes to editor */
    function nona_image_sizes_choice( $sizes ) 
    {
      $custom_sizes = array(
        // 'indeximg' => 'nona Index Image',
        // 'feature'  => 'Nona Featured Image',
        // 'slider'   => 'Nona Slider Image Size'
      );
      return array_merge( $sizes, $custom_sizes );
    }

    /* Register Nav Menus */
    register_nav_menus(
      array(
        'headline' => __( 'Short Headline Navigation appears above header', 'nona' ),
        'primary' => __( 'Primary Navigation', 'nona' ),
        'footer' => __( 'Short Footer Navigation', 'nona' ),
        'mobile' => __( 'Mobile Menu', 'nona' )
      )
    );

    /* Init Modules  */
    
    /**
     * Sidebar Setup.
     * Define sidebars by adding names to the array.
     * NB : Note that names such as 'blog', 'search', 'author', 'archive', 'page' 
     * or 'single' will  automatically  be included on those pages as a default.
     */
    $widgetAreas = array(
      /* You can pass in an array if you want to add a description */
      array(
        'default', // id
        'default', // name
        'used on all blog templates, and as a fallback for inactive sidebars' // desc
      ), 
      /* or just pass a name */
      'page', 
      'contact',
          'footer-1'
    );

    $NonaSidebars = new Nona_Sidebars($widgetAreas);
    $NonaScripts  = new Nona_Scripts();
    $NonaEditor   = new Nona_Editor();
    $admin        = new Nona_Admin();
    $NonaLayout   = new Nona_Layout();

  } // end the nona theme setup
} // end thene setup function_exists condition


/* Action Hook */
add_action( 'after_setup_theme', 'nona_theme_setup' );
