<?php

/*

Theme Options Output Functions
- - - - - - - - - - - - - - - - - - - - -
All options should be rendered using functions in this file
and attached to the appropriate action / filter hooks or alternatively
called in the appropriate template file.

*/

/* call theme options
  - - - - - - - - - - - - - - - - - - - - - */
$options = [];
$options = get_option('nona_options');


/*

Layout Options
- - - - - - - - - - - - - - - - - - - - -
Overall layout options, used to show, hide, build and alter certain sections of the site



/* Site Title function
  - - - - - - - - - - - - - - - - - - - - - */
function nona_site_title() {
  global $options;
  $logo = (isset($options['logo'])) ? $options['logo'] : array();
  $siteUrl = home_url();
  $sitename = get_bloginfo('name');
  $desc = get_bloginfo('description');
  $nonatitle = '';

  if ( isset($logo['url']) && !empty($logo['url']) ) {
    $nonatitle  = '<h1 class="sitelogo">';
    $nonatitle .= '<a href="'.$siteUrl.'">';
    $nonatitle .= '<img src="'.$logo['url'].'" alt="'.$sitename.'" />';
    $nonatitle .= '</a></h1>';
  } else {
    $nonatitle  = '<h1 class="sitetitle">';
    $nonatitle .= '<a href="'.$siteUrl.'">'.$sitename.'</a>';
    $nonatitle .= '<small>'.$desc.'</small>';
    $nonatitle .= '</h1>';
  }

  // echoing as I don't expect to further process this
  echo $nonatitle;
}

/* Nona Main Menu and Descriptions
- - - - - - - - - - - - - - - - - - - - - */
function nona_main_menu() {
  global $options;

  if ( isset($options['menu-descriptions']) && $options['menu-descriptions'] == 1 ) {

    // Custom Menu Descriptions walker
    class nona_menu_descriptions extends Walker_Nav_Menu {
      function start_el( &$output, $object, $depth = 0, $args = array(), $current_object_id = 0 ) {
        global $wp_query;
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        $class_names = $value = '';

        $classes = empty( $object->classes ) ? array() : (array) $object->classes;

        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $object ) );
        $class_names = ' class="'. esc_attr( $class_names ) . '"';

        $output .= $indent . '<li id="menu-item-'. $object->ID . '"' . $value . $class_names .'>';

        $attributes  = !empty( $object->attr_title ) ? ' title="'  . esc_attr( $object->attr_title ) .'"' : '';
        $attributes .= !empty( $object->target )     ? ' target="' . esc_attr( $object->target     ) .'"' : '';
        $attributes .= !empty( $object->xfn )        ? ' rel="'    . esc_attr( $object->xfn        ) .'"' : '';
        $attributes .= !empty( $object->url )        ? ' href="'   . esc_attr( $object->url        ) .'"' : '';

        $prepend = '<span>';
        $append = '</span>';
        $description  = !empty( $object->description ) ? '<small>'.esc_attr( $object->description ).'</small>' : '';

        if ( $depth != 0 ) {
          $description = $append = $prepend = "";
        }

        $object_output = $args->before;
        $object_output .= '<a'. $attributes .'>';
        $object_output .= $args->link_before .$prepend.apply_filters( 'the_title', $object->title, $object->ID ).$append;
        $object_output .= $description.$args->link_after;
        $object_output .= '</a>';
        $object_output .= $args->after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $object_output, $object, $depth, $args );
      }

    } // end custom nav descriptions walker class

    // Main Menu with descriptions
    wp_nav_menu( array(
        'container'    => false,
        'theme_location' => 'primary',
        'menu_id'      => 'top-menu',
        'menu_class'     => 'dnav',
        'before'         => '',
        'after'          => '',
        'link_before'    => '',
        'link_after'     => '',
        'depth'          => 0,
        'walker'     => new nona_menu_descriptions()
      )
    );
  } else {
    // Standard Main Menu
    wp_nav_menu( array(
        'container'    => false,
        'theme_location' => 'primary',
        'menu_id'      => 'top-menu',
        'menu_class'     => 'standard-nav',
        'before'         => '',
        'after'          => '',
        'link_before'    => '',
        'link_after'     => '',
        'depth'          => 0
      )
    );
  } // end else statement
} // end main menu function


/* Add Search Bar to Menu
- - - - - - - - - - - - - - - - - - - - - */
if ( isset($options['menu-search']) && $options['menu-search'] == 1 ) {
  function add_search_box($items, $args) {
        ob_start();
        get_search_form();
        $searchform = ob_get_contents();
        ob_end_clean();

        $items .= '<li>' . $searchform . '</li>';

      return $items;
  }

  add_filter('wp_nav_menu_items','add_search_box', 10, 2);
}



/*

Blog Options
- - - - - - - - - - - - - - - - - - - - -
Overall layout options, used to show, hide, build and alter certain sections of the site

Blog Title
- - - - - - - - - - - - - - - - - - - - - */
function nona_blog_title() {
  global $options;
  if ( isset($options['blog_title']) && !empty($options['blog_title']) ) {
    return $options['blog_title'];
  } else {
    return "Blog";
  }
}

/* Blog Description
- - - - - - - - - - - - - - - - - - - - - */
function nona_blog_subtitle() {
  global $options;
  if ( isset($options['blog_subtitle']) && !empty($options['blog_subtitle']) ) {
    return $options['blog_subtitle'];
  }
}




/*

Contact and Social
- - - - - - - - - - - - - - - - - - - - -
These should include setup options, fall backs etc necessary for the setup of the site.


Social Profile Follow Links
  - - - - - - - - - - - - - - - - - - - - - */
function nona_social_icons() {
  global $options;
  $social_icons = '';
  if ( !empty($options['opt-twitter'] ) && isset($options['opt-twitter'] ) ) {
    $social_icons .= '<a class="socialicons twitter" target="_blank" href="'.$options['opt-twitter'].'">
      <i class="fa fa-twitter"></i>
    </a>';
  }
  if ( !empty($options['opt-fb'] ) && isset($options['opt-fb'] ) ) {
    $social_icons .= '<a class="socialicons facebook" target="_blank" href="'.$options['opt-fb'].'">
      <i class="fa fa-facebook"></i>
    </a>';
  }
  if ( !empty($options['opt-linkedIn'] ) && isset($options['opt-linkedIn'] ) ) {
    $social_icons .= '<a class="socialicons linkedin" target="_blank" href="'.$options['opt-linkedIn'].'">
      <i class="fa fa-linkedin"></i>
    </a>';
  }
  if ( !empty($options['opt-gplus'] ) && isset($options['opt-gplus'] ) ) {
    $social_icons .= '<a class="socialicons gplus" target="_blank" href="'.$options['opt-gplus'].'">
      <i class="fa fa-google-plus"></i>
    </a>';
  }
  if ( !empty($options['opt-pinterest'] ) && isset($options['opt-pinterest'] ) ) {
    $social_icons .= '<a class="socialicons pinterest" target="_blank" href="'.$options['opt-pinterest'].'">
      <i class="fa fa-pinterest"></i>
    </a>';
  }
  if ( !empty($options['opt-youtube'] ) && isset($options['opt-youtube'] ) ) {
    $social_icons .= '<a class="socialicons youtube" target="_blank" href="'.$options['opt-youtube'].'">
      <i class="fa fa-youtube"></i>
    </a>';
  }
  if ( !empty($options['opt-vimeo'] ) && isset($options['opt-vimeo'] ) ) {
    $social_icons .= '<a class="socialicons vimeo" target="_blank" href="'.$options['opt-vimeo'].'">
      <i class="fa fa-vimeo-square"></i>
    </a>';
  }
  if ( !empty($options['opt-flickr'] ) && isset($options['opt-flickr'] ) ) {
    $social_icons .= '<a class="socialicons flickr" target="_blank" href="'.$options['opt-flickr'].'">
      <i class="fa fa-flickr"></i>
    </a>';
  }
  if ( !empty($options['opt-instagram'] ) && isset($options['opt-instagram'] ) ) {
    $social_icons .= '<a class="socialicons instagram" target="_blank" href="'.$options['opt-instagram'].'">
      <i class="fa fa-instagram"></i>
    </a>';
  }
  if ( !empty($options['opt-github'] ) && isset($options['opt-github'] ) ) {
    $social_icons .= '<a class="socialicons github" target="_blank" href="'.$options['opt-github'].'">
      <i class="fa fa-github"></i>
    </a>';
  }
  if ( !empty($options['opt-rss'] ) && isset($options['opt-rss'] ) ) {
    $social_icons .= '<a class="socialicons rss" target="_blank" href="'.$options['opt-rss'].'">
      <i class="fa fa-rss"></i>
    </a>';
  }
  if ( !empty($options['opt-email'] ) && isset($options['opt-email'] ) ) {
    $social_icons .= '<a class="socialicons email" target="_blank" href="mailto:'.$options['opt-email'].'">
      <i class="fa fa-envelope-o"></i>
    </a>';
  }
  echo $social_icons;
}







/*Return API values
  - - - - - - - - - - - - - - - - - - - - -*/
function nona_fb_api() {
  global $options;
  $key = "";
  if ( isset($options['api-facebook']) && !empty($options['api-facebook']) ) {
    $key = $options['api-facebook'];
  } else {
    return $key;
  }
}
function nona_google_api() {
  global $options;
  $key = "";
  if ( isset($options['api-google']) && !empty($options['api-google']) ) {
    $key = $options['api-google'];
  } else {
    return $key;
  }
}
function nona_twitter_consumer_key() {
  global $options;
  $key = "";
  if ( isset($options['api-twitter-con-key']) && !empty($options['api-twitter-con-key']) ) {
    $key = $options['api-twitter-con-key'];
  } else {
    return $key;
  }
}
function nona_twitter_consumer_secret() {
  global $options;
  $key = "";
  if ( isset($options['api-twitter-con-secret']) && !empty($options['api-twitter-con-secret']) ) {
    $key = $options['api-twitter-con-secret'];
  } else {
    return $key;
  }
}
function nona_twitter_access_token() {
  global $options;
  $key = "";
  if ( isset($options['api-twitter-access-token']) && !empty($options['api-twitter-access-token']) ) {
    $key = $options['api-twitter-access-token'];
  } else {
    return $key;
  }
}
function nona_twitter_token_secret() {
  global $options;
  $key = "";
  if ( isset($options['api-twitter-access-secret']) && !empty($options['api-twitter-access-secret']) ) {
    $key = $options['api-twitter-access-secret'];
  } else {
    return $key;
  }
}

/*

Login Page Customizations - Needs to be cleaned up and tested!
- - - - - - - - - - - - - - - - - - - -
This group of functions offer the ability to customize the login page extensively
including login page Logo or Site title, background image, form customizations and
side note function

*/
// if (!empty($options['login-custom']) && isset($options['login-custom']) ) {

// function my_login_url_local() {
//   return home_url();
// }
// add_filter('login_headerurl', 'my_login_url_local');

// function my_login_title_attr() {
//   return esc_attr(get_bloginfo('name'));
// }
// add_filter('login_headertitle', 'my_login_title_attr');

/* Change Admin Login Logo
- - - - - - - - - - - - - - - - - - - - */
  if ( !empty( $options['login-logo']['url'] ) && isset( $options['login-logo']['url'] ) ) {

    function custom_login_logo() {
      global $options;
      echo '<style type="text/css">
      h1 a { background-image:url('.$options['login-logo']['url'].')!important; }
      </style>';
    }
    add_action('login_head', 'custom_login_logo');

  } else  {

    function my_style_site_name() {
    ?> <style type="text/css">
      h1 a { height:auto!important; text-indent:0!important; overflow:visible!important; text-decoration:none; color:#444; display:block; margin:0; padding:0 10px; background:none!important; }
      h1 { font-family:'helvetica neue', arial, sans-serif; font-weight:bold; text-align:center; font-size:2em; width:310px; position:relative; right:-8px; margin:0 0 1em 0; }
      </style>
    <?php }
    add_action('login_head', 'my_style_site_name');


  }

   /* Add Style  to Login Page
  - - - - - - - - - - - - - - - -*/
  function nona_login_style_and_scripts() {
    global $options;

    // set default background image if none is uploaded
    if ( isset($options['login-bg']['url']) && !empty($options['login-bg']['url']) ) {
      $bg = $options['login-bg'];
    }else {
      $bg = get_template_directory_uri().'/public/img/login-bg-test.jpg';
    } 
    ?>

     <link rel="stylesheet" id="custom_wp_admin_css"  href="<?php echo $login_css; ?>" type="text/css" media="all" />
     <!-- <script src="<?php echo get_template_directory_uri(); ?>/js/jquery-1.10.2.min.js\"></script> -->
     <script src="<?php echo get_template_directory_uri(); ?>/public/js/admin/loginbuild.min.js"></script>
     <script> jQuery(document).ready(function($) { $('body').anystretch("<?php echo $bg; ?>", {speed: 150}); }); </script>
  <?php }

  // add_action( 'login_enqueue_scripts', 'nona_login_style_and_scripts' );
  // add_action( 'lost_password', 'nona_login_style_and_scripts' );

  /*Login Page SideNote Content
  - - - - - - - - - - - - - - - - - - - - */
//   function nona_login_sidenote() {
//     global $options;
//     $siteUrl = home_url();
//     $sitename = get_bloginfo('name');

//     $sidenote = '<div class="sidenote">';
//     if ( !empty($options['sidenote-heading']) && isset($options['sidenote-heading']) ) {
//       $sidenote .= '<h2>'.$options['sidenote-heading'].'</h2>';
//     } else {
//       $sidenote .= '<h2>Welcome to the Backend Administrative Panel for <a href="'.$siteUrl.'">'.$sitename.'</a></h2>';
//     }

//     if ( !empty($options['sidenote']) && isset($options['sidenote']) ) {
//       $sidenote .= $options['sidenote'];
//     } else {
//       $sidenote .= '<p>You are required to login with your username and password in order to access the administrative controls for this site.  Should you be unsure of how to login, or how to manage these options, please contact your site administrator, or developer at your earliest convenince.</p>';
//       $sidenote .= '<p>Site Designed and Developed by Nona Creative.</p>';
//     }

//     $sidenote .= '</div>';
//     echo $sidenote;
//   }

// add_action('login_footer', 'nona_login_sidenote');

// } 
// end login options meta conditional




/*

The landing Page / Dev mode Redirects - Needs to be cleaned up and tested!
- - - - - - - - - - - - - - - - - - - -
This group of functions will determine if the theme is set in "Dev" mode and allow
 you to redirect logged out users to either the maintenance / under construction / landing
 page templates or select a specific page to redirect to including the login page

*/

// to landing page
// function nona_dev_redirect() {
//     include( get_template_directory() . '/page-templates/landing-page.php' ); // custom theme ops page template
//     exit();
// }

// to login
// function nona_dev_redirect_to_login() {
//   wp_redirect( home_url( '/wp-admin/' ) );
//   exit();
// }

//  To a specific page
// function nona_dev_redirect_to_page($pageid) {
//   wp_redirect( 'http://localhost/zz_nona-foundation/?page_id=38' ); // page - do later - must reset headers
//   exit();
// }

// add_action( 'wp_head', 'nona_dev_redirect_to_page' );

// Set from options
// function nona_redirect_settings() {
//   global $options;
//   if ( isset($options['redirect-onoff']) && !empty($options['redirect-onoff']) ) {
//     $go = $options['redirect-to'];
//     if ( !is_user_logged_in() ) {
//       if ( $go == 1 ) {
//         add_action( 'template_redirect', 'nona_dev_redirect' );
//       } else if ( $go == 2 ) {
//         add_action( 'template_redirect', 'nona_dev_redirect_to_login' );
//       } else {
//         return false;
//       }
//     }
//   }
// }

// add_action('init', 'nona_redirect_settings');

/* Landing page content from options panel
- - - - - - - - - - - - - - - - - - - -*/

// title
// function nona_redirect_title() {
//   global $options;
//   if ( isset($options['redirect-title']) && !empty($options['redirect-title']) ) {
//     echo $options['redirect-title'];
//   } else {
//     echo 'hello';
//   }
// }

// content
// function nona_redirect_content() {
//     global $options;
//     $content = $options['redirect-content'];
//   if ( isset($content) && !empty($content) ) {
//     echo wptexturize( wpautop( $content ) );
//   } else {
//     $sitetitle = get_bloginfo('name');
//     $adminmail = get_option('admin_email', '');
//     echo "<p>Welcome to the new online home of <strong> $sitetitle </strong>.  We're hard at work putting our new website together, check back soon or if its urgent <a href='mailto:$adminmail'>get in touch with us here.</a></p>";
//   }
// }
