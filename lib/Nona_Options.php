<?php

/*

Nona Theme Options
 - - - - - - - - - - -
Using the Redux framework as it offers a wide range of field types and a
stable base to quickly add options to our themes.

 */

// Define Constants
 define('N_F_ASSETS', get_template_directory_uri().'/assets/');

// Initialize arrays
$args = array();
$tabs = array();
$sections = array();

/*

SETUP ARGS
 - - - - - - - - - - -
 Check the sample config in the redux submodule for more info and examples

*/
$theme                       = wp_get_theme();
$args['dev_mode']            = true;
$args['dev_mode_icon_class'] = 'icon-large';
$args['opt_name']            = 'nona_options';
$args['display_name']        = $theme->get('Name');
$args['display_version']     = $theme->get('Version');
$args['google_api_key']      = 'AIzaSyAytw7whQyaGAEHUwJZWCwkKOHFIS28sJA';
$args['show_import_export']  = true;
$args['import_icon_class']   = 'icon-large';
$args['default_icon_class']  = 'icon-large';
$args['menu_title']          = __('Theme Options', 'nona');
$args['page_title']          = __('Theme Options', 'nona');
$args['page_slug']           = 'nona_theme_options';
$args['default_show']        = true;
$args['default_mark']        = '*';
$args['page_cap']            = 'manage_options';
$args['page_type']           = 'submenu';
$args['page_parent']         = 'options-general.php';
$args['dev_mode']            = false; 
// $args['customizer'] = true;


/*

Help text / tabs etc
 - - - - - - - - - - -
Pretty generic and should need to be changed, though could be used to add
some specific help or instructions on a particular site build if necessary.

 */
$args['help_tabs'][] = array(
  'id'      => 'nona-help-1',
  'title'   => __('Nona FrameWork Information', 'nona'),
  'content' => __('<p>These Options are used in the setup of the <strong>theme framework</strong>, note that, of the options shown, some may <strong>NOT</strong> be supported or used in your build. These options have been created for developer use only during the initial site setup.  Should you have any queries regarding your project build or require assistance with changes or customizations, please contact us directly <a href="mailto:hello@nonacreative.com?subject=help">via email</a> </p>', 'nona')
  );

// Set the help sidebar for the options page.
$args['help_sidebar']   = __('<p>This theme framework is for use by Nona Creative Only, Please contact us directly at hello@nonacreative.com for assistance</p>', 'nona');

// Add HTML before the form.
 $args['intro_text']    = __('<p>This is the Nona theme options panel to be used during framework setup. Note to developers: You can find the corresponding functions in nona-options-render.php. These are not yet being called in the theme template files, and need to be custom-coded in as necessary.</p>', 'nona');

// Add content after the form.
// $args['footer_text']    = __('<p>Please see the help tab to the top right of the screen for more information regarding these options, or check in function/nona-options-render.php to find out which options have been implemented in this build</p>', 'nona');

// Set footer/credit line.
$args['footer_credit']  = __('<em></em>', 'nona');





/*

Option Sections and Fields
- - - - - - - - - - -
All options are added here, again check the sample-config in the theme-options/sample
folder, all theme options are managed as an extensive set of functions in nona-options-render.php
both for convenience and cleanliness.

 */


/*Layout Options*/
$sections[] = array(
  'icon'       => 'el-icon-cogs',
  'icon_class' => 'icon-large',
  'title'      => __('Layout', 'nona'),
  'desc'       => __('<p class="description">Control general layout for this theme, including the header, footer and menus, with these settings.</p>', 'nona' ),
  'fields'     => array(
    array(
      'id'       => 'logo',
      'type'     => 'media',
      'title'    => __('Logo Image', 'nona'),
      'subtitle' => __('Upload a logo image to replace the site title and description', 'nona'),
      'desc'     => __('the image should be in the PNG format with a transparent background.', 'nona')
      ),
     array(
      'id'       => 'menu-descriptions',
      'type'     => 'switch',
      'title'    => __('Show Menu Descriptions', 'nona'),
      'subtitle' => __('This will add menu descriptions to the main menu', 'nona'),
      'default'  => '2'
      ),
     array(
      'id'       => 'menu-search',
      'type'     => 'switch',
      'title'    => __('Main Menu Search Bar', 'nona'),
      'subtitle' => __('This will add a search bar to the main menu', 'nona'),
      'default'  => '2'
      ),
  )
);

/*Blog Options*/
$sections[] = array(
  'icon'       => 'el-icon-cogs',
  'icon_class' => 'icon-large',
  'title'      => __('Blog', 'nona'),
  'desc'       => __('<p class="description">Blog specific settings</p>', 'nona' ),
  'fields'     => array(
    array(
      'id'    => 'blog_title', //must be unique
      'type'  => 'text',
      'title' => __('Blog Page Title', 'nona')
    ),
    array(
      'id'    => 'blog_subtitle', //must be unique
      'type'  => 'textarea',
      'title' => __('Blog Page description', 'nona')
    )
  )
);


/*Contact and Social Details*/
$sections[] = array(
  'icon'       => 'el-icon-cogs',
  'icon_class' => 'icon-large',
  'title'      => __('Contact & Social', 'nona'),
  'desc'       => __('<p class="description">Contact Details and Social Links</p>', 'nona' ),
  'fields'     => array(
    array(
      'id'    => 'arb1-3',
      'type'  => 'info',
      'style' =>'success',
      'icon'  =>'el-icon-info-sign',
      'title' => 'Social Profile Link',
      'desc'  => __('Social Profile links can be added here. Icons will only show up in the selected area as set on the layout page, and only the icons for the profiles where you have added a URL will be displayed in these locations', 'nona' )
      ),
      array(
      'id'    => 'opt-twitter',
      'type'  => 'text',
      'title' => __('Twitter URL', 'nona' )
      ),
      array(
      'id'    => 'opt-fb',
      'type'  => 'text',
      'title' => __('Facebook URL', 'nona' )
      ),
      array(
      'id'    => 'opt-linkedIn',
      'type'  => 'text',
      'title' => __('LinkedIn URL', 'nona' )
      ),
      array(
      'id'    => 'opt-gplus',
      'type'  => 'text',
      'title' => __('Google+ URL', 'nona' )
      ),
      array(
      'id'    => 'opt-pinterest',
      'type'  => 'text',
      'title' => __('Pinterest URL', 'nona' )
      ),
      array(
      'id'    => 'opt-youtube',
      'type'  => 'text',
      'title' => __('Youtube URL', 'nona' )
      ),
      array(
      'id'    => 'opt-vimeo',
      'type'  => 'text',
      'title' => __('Vimeo URL', 'nona' )
      ),
      array(
      'id'    => 'opt-flickr',
      'type'  => 'text',
      'title' => __('Flickr URL', 'nona' )
      ),
      array(
      'id'    => 'opt-instagram',
      'type'  => 'text',
      'title' => __('Instagram URL', 'nona' )
      ),
       array(
      'id'    => 'opt-github',
      'type'  => 'text',
      'title' => __('Github URL', 'nona' )
      ),
      array(
      'id'    => 'opt-rss',
      'type'  => 'text',
      'title' => __('RSS Feed URL', 'nona' )
      ),
      array(
      'id'    => 'opt-email',
      'type'  => 'text',
      'title' => __('Email Address', 'nona' )
      ),
      array(
      'id'   => 'arb1-3',
      'type' => 'divide'
      )
  )
);


/*API Keys Options*/
$sections[] = array(
  'icon'       => 'el-icon-cogs',
  'icon_class' => 'icon-large',
  'title'      => __('API keys', 'nona'),
  // 'desc'       => __('<p class="description">These are the default theme options for the basic theme setup.</p>', 'nona' ),
  'fields' => array(

    array(
      'id'    => 'api-info',
      'type'  => 'info',
      'style' =>'success',
      'icon'  =>'el-icon-info-sign',
      'title' => 'API Keys',
      'desc'  => __('For proper integration with third party services you may need to acquire an API key for these services. They can be accessed through the functions listed in nona-options-render.php', 'nona' )
      ),
      array(
        'id'       => 'api-google', //must be unique
        'type'     => 'text',
        'title'    => __('Google Developer Api Key', 'nona' ),
        'subtitle' => __('This will be required for google fonts and google maps integration', 'nona' )
      ),
      array(
        'id'       => 'api-facebook', //must be unique
        'type'     => 'text',
        'title'    => __('Facebook App ID', 'nona' ),
        'subtitle' => __('required to receive like and share insights on your facebook page', 'nona' )
      ),
      array(
        'id'       => 'api-twitter-con-key', //must be unique
        'type'     => 'text',
        'title'    => __('Twitter App Consumer Key', 'nona' ),
        'subtitle' => __('you will need 4 values once you created a new twiter app', 'nona' )
      ),
      array(
        'id'       => 'api-twitter-con-secret', //must be unique
        'type'     => 'text',
        'title'    => __('Twitter App Consumer Secret', 'nona' ),
        'subtitle' => __('you will need 4 values once you created a new twiter app', 'nona' )
      ),
      array(
        'id'       => 'api-twitter-access-token', //must be unique
        'type'     => 'text',
        'title'    => __('Twitter App Access Token', 'nona' ),
        'subtitle' => __('you will need 4 values once you created a new twiter app', 'nona' )
      ),
      array(
        'id'       => 'api-twitter-access-secret', //must be unique
        'type'     => 'text',
        'title'    => __('Twitter App Access Token Secret', 'nona' ),
        'subtitle' => __('you will need 4 values once you created a new twiter app', 'nona' )
      )
  )
);

/*Login Screen Options - needs to be clean up and tested*/
// $sections[] = array(
// 'title'      => __('Login Screen', 'nona'),
// 'desc'       => __('<p class="description">These are the default theme options for the basic theme setup.</p>', 'nona'),
// 'icon'       => 'el-icon-cogs',
// 'icon_class' => 'icon-large',
// 'fields'     => array(
//     array(
//       'id'       => 'login-custom',
//       'type'     => 'switch',
//       'title'    => __('Customise The Login Panel', 'nona'),
//       'subtitle' => __('This theme allows advanced customisation and branding of the login screen, activate this here. This includes the login title or logo, colour scheme, background image and login side content.  There are reasonable defaults for all these, activate it and then check your login screen.', 'nona'),
//       'default' => '1'
//       ),
//     array(
//       'id'       => 'login-logo',
//       'type'     => 'media',
//       'title'    => __('Login Logo Image', 'nona'),
//       'subtitle' => __('Upload a logo image to replace the site title above the login form', 'nona'),
//       'desc'     => __('The image should be in the PNG format with a transparent background. 312px wide, by 82px high', 'nona'),
//       'required' => array('login-custom', '=' , '1')
//       ),
//     array(
//       'id'       => 'login-bg',
//       'type'     => 'media',
//       'title'    => __('Login Background', 'nona'),
//       'subtitle' => __('Upload a background image to be stretched across the login background', 'nona'),
//       'desc'     => __('The image should have a widescreen aspect ratio', 'nona'),
//       'required' => array('login-custom', '=' , '1')
//       ),
//     array(
//     'id'    => 'sidenote-heading', //must be unique
//     'type'  => 'text',
//     'title' => __('Login Page Notice Heading', 'nona'),
//     'required' => array('login-custom', '=' , '1')
//     ),
//     array(
//       'id'           => 'sidenote',
//       'type'         => 'textarea',
//       'title'        => __('Login Page Notice - HTML Validated', 'nona'),
//       'subtitle'     => __('Custom HTML Allowed (wp_kses)', 'nona'),
//       'desc'         => __('This will override the default notice on the login page, keep it brief, and to the point. Some HTML is allowed in here. (a, strong, em, br, p).', 'nona'),
//       'validate'     => 'html_custom',
//       'default'          => '',
//       'allowed_html' => array('a' => array('href' => array(),'title' => array()),'br' => array(),'em' => array(),'strong' => array(), 'p' => array()), //see http://codex.wordpress.org/Function_Reference/wp_kses
//       'required' => array('login-custom', '=' , '1')
//       ),
//   )
// );

/* Developer Maintenance Mode Landing Page */
// $sections[] = array(
//   'icon'       => 'el-icon-cogs',
//   'icon_class' => 'icon-large',
//   'title'      => __('Landing Page', 'nona'),
//   'desc'       => __('<p class="description">Maintenance / Developer Mode allows you to redirect non-logged in users to a custom landing page or the login page. Turn this on to avoid showing potential customers a site in progress, landing page customizations coming soon.</p>', 'nona' ),
//   'fields'     => array(
//      array(
//       'id'       => 'redirect-onoff',
//       'type'     => 'switch',
//       'title'    => __('Maintenance / Developer Mode', 'nona'),
//       'subtitle' => __('This theme allows you to redirect logged out users to a landing page, the login page or a specified page template by turning this feature on.', 'nona'),
//       'default' => false
//       ),
//     array(
//       'id'       => 'redirect-to',
//       'type'     => 'button_set',
//       'title'    => __('Redirect Template', 'nona'),
//       'subtitle' => __('Choose where to redirect non-logged in users when you put the site in developer mode.', 'nona'),
//       'options' => array(
//               '1' => 'Landing Page',
//               '2' => 'Login Page'
//             ),
//       'default' => '1'
//       ),
//     array(
//       'id'       => 'redirect-title',
//       'type'     => 'text',
//       'title'    => __('Landing Page Headline', 'nona'),
//       'subtitle' => __('The large title for this page, keep it brief.', 'nona'),
//       'default'  => 'Hello'
//       ),
//     array(
//       'id'       => 'redirect-content',
//       'type'     => 'editor',
//       'title'    => __('Landing Page content', 'nona'),
//       'subtitle' => __('The main content area for this page, anything goes.', 'nona')
//       ),
//   )
// );




global $ReduxFramework;
$ReduxFramework = new ReduxFramework($sections, $args, $tabs);

// END Sample Config




