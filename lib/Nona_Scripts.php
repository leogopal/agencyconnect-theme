<?php

if (!class_exists('Nona_Scripts')) {
  class Nona_Scripts {

    public function __construct()
    {
      if ( !is_admin() ) add_action( "wp_enqueue_scripts", array($this, "styles"), 1 );
      if ( !is_admin() ) add_action( "wp_enqueue_scripts", array($this, 'scripts'), 2 );
    }

    function styles() 
    {
      wp_register_script( 'modernizr', get_template_directory_uri().'/public/js/support/modernizr-2.8.3.min.js', array(), false, false);
      wp_register_style( 'allcss', get_template_directory_uri() . '/public/css/style.min.css', array(), false, 'all' );
      // wp_register_script('respondjs', get_template_directory_uri().'/js/respond.min.js', array('modernizr'), false, false);

      wp_enqueue_script('modernizr');
      wp_enqueue_style( 'allcss' );
      // wp_enqueue_script('respondjs');

    }

    public function scripts() 
    {
      // wp_deregister_script('hoverIntent'); // May interfere if you're using superfish
      wp_register_script( 'alljs', get_template_directory_uri().'/public/js/all.min.js', array('modernizr', 'jquery'), false, true );
      wp_enqueue_script( 'alljs' );

      $localize_data = array(
        'ajaxurl'     => admin_url( 'admin-ajax.php' ),
        'templateurl' => get_template_directory_uri(),
        'includesUrl' => includes_url(),
        'spinner'     => includes_url() . "images/spinner.gif",
        'homeUrl'     => home_url(),
        'isLoggedIn'  => is_user_logged_in(),
        'isFrontPage' => is_front_page(),
        'isHome'    => is_home(),
        'isDesktop'   => (nona_detect('desktop')) ? true : false,
        'isMobile'    => (nona_detect('mobile')) ? true : false,
        'isTablet'    => (nona_detect('tablet')) ? true : false,
        'isIos'       => (nona_detect('ios')) ? true : false,
        'isAndriod'   => (nona_detect('andriod')) ? true : false,
      );

      wp_localize_script( 'alljs', 'nona', $localize_data );

    }

  }
} // end if.

