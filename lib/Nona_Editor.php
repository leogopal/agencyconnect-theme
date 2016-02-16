<?php
/* - - - - - - - - - - - - - - - - - - - - -

Add additional functionality to the editor
0 - Load Admin Scripts and CSS for editor
1 - Create Icon Array
2 - Add Icon Drop Down Inserter
3 - Add a style dropdown
  - add the dropdown
  - add the styles to te dropdown

- - - - - - - - - - - - - - - - - - - - - */

class Nona_Editor 
{

  public function __construct() {
    if (!is_admin()) return;

    add_action('admin_enqueue_scripts', array( $this, 'load_scripts' ));
    add_action('media_buttons',array( $this, 'add_font_awesome' ), 12);
    add_filter("mce_buttons_3", array( $this, "additional_editor_buttons" ));
    add_filter('tiny_mce_before_init', array( $this, 'customize_text_sizes' ));
    add_filter( 'mce_buttons_2', array( $this, 'style_selector' ) );
    add_filter( 'tiny_mce_before_init', array( $this, 'add_styles_to_style_select' ) );
  }

  public function load_scripts() {
    wp_register_script('nona-admin-editor-js', get_template_directory_uri() . '/public/js/admin/admin.min.js' );
    wp_register_style('nona-admin-editor-css', get_template_directory_uri() . '/public/css/admin.min.css' );
    wp_enqueue_script('nona-admin-editor-js');
    wp_enqueue_style('nona-admin-editor-css');
  }

  public function add_font_awesome() {
    $icons = $this->icon_list();
      echo '<a id="ico-trig" class="button">Icons</a><span class="ico-wrap"><select id="icon_select"><option>Icons</option>';
        foreach($icons as $icon) {
          echo '<option>'.$icon.'</option>';
        }
       echo '</select><a id="ico-close" class="button">X</a></span>';
  }

  private function icon_list() {
    $fa4_icons = array('glass','music','search','envelope-o','heart','star','star-o','user','film','th-large','th','th-list','check','times','search-plus','search-minus','power-off','signal','gear','cog','trash-o','home','file-o','clock-o','road','download','arrow-circle-o-down','arrow-circle-o-up','inbox','play-circle-o','rotate-right','repeat','refresh','list-alt','lock','flag','headphones','volume-off','volume-down','volume-up','qrcode','barcode','tag','tags','book','bookmark','print','camera','font','bold','italic','text-height','text-width','align-left','align-center','align-right','align-justify','list','dedent','outdent','indent','video-camera','picture-o','pencil','map-marker','adjust','tint','edit','pencil-square-o','share-square-o','check-square-o','move','step-backward','fast-backward','backward','play','pause','stop','forward','fast-forward','step-forward','eject','chevron-left','chevron-right','plus-circle','minus-circle','times-circle','check-circle','question-circle','info-circle','crosshairs','times-circle-o','check-circle-o','ban','arrow-left','arrow-right','arrow-up','arrow-down','mail-forward','share','resize-full','resize-small','plus','minus','asterisk','exclamation-circle','gift','leaf','fire','eye','eye-slash','warning','exclamation-triangle','plane','calendar','random','comment','magnet','chevron-up','chevron-down','retweet','shopping-cart','folder','folder-open','resize-vertical','resize-horizontal','bar-chart-o','twitter-square','facebook-square','camera-retro','key','gears','cogs','comments','thumbs-o-up','thumbs-o-down','star-half','heart-o','sign-out','linkedin-square','thumb-tack','external-link','sign-in','trophy','github-square','upload','lemon-o','phone','square-o','bookmark-o','phone-square','twitter','facebook','github','unlock','credit-card','rss','hdd-o','bullhorn','bell','certificate','hand-o-right','hand-o-left','hand-o-up','hand-o-down','arrow-circle-left','arrow-circle-right','arrow-circle-up','arrow-circle-down','globe','wrench','tasks','filter','briefcase','fullscreen','group','chain','link','cloud','flask','cut','scissors','copy','files-o','paperclip','save','floppy-o','square','reorder','list-ul','list-ol','strikethrough','underline','table','magic','truck','pinterest','pinterest-square','google-plus-square','google-plus','money','caret-down','caret-up','caret-left','caret-right','columns','unsorted','sort','sort-down','sort-asc','sort-up','sort-desc','envelope','linkedin','rotate-left','undo','legal','gavel','dashboard','tachometer','comment-o','comments-o','flash','bolt','sitemap','umbrella','paste','clipboard','lightbulb-o','exchange','cloud-download','cloud-upload','user-md','stethoscope','suitcase','bell-o','coffee','cutlery','file-text-o','building','hospital','ambulance','medkit','fighter-jet','beer','h-square','plus-square','angle-double-left','angle-double-right','angle-double-up','angle-double-down','angle-left','angle-right','angle-up','angle-down','desktop','laptop','tablet','mobile-phone','mobile','circle-o','quote-left','quote-right','spinner','circle','mail-reply','reply','github-alt','folder-o','folder-open-o','expand-o','collapse-o','smile-o','frown-o','meh-o','gamepad','keyboard-o','flag-o','flag-checkered','terminal','code','reply-all','mail-reply-all','star-half-empty','star-half-full','star-half-o','location-arrow','crop','code-fork','unlink','chain-broken','question','info','exclamation','superscript','subscript','eraser','puzzle-piece','microphone','microphone-slash','shield','calendar-o','fire-extinguisher','rocket','maxcdn','chevron-circle-left','chevron-circle-right','chevron-circle-up','chevron-circle-down','html5','css3','anchor','unlock-o','bullseye','ellipsis-horizontal','ellipsis-vertical','rss-square','play-circle','ticket','minus-square','minus-square-o','level-up','level-down','check-square','pencil-square','external-link-square','share-square','compass','toggle-down','caret-square-o-down','toggle-up','caret-square-o-up','toggle-right','caret-square-o-right','euro','eur','gbp','dollar','usd','rupee','inr','cny','rmb','yen','jpy','ruble','rouble','rub','won','krw','bitcoin','btc','file','file-text','sort-alpha-asc','sort-alpha-desc','sort-amount-asc','sort-amount-desc','sort-numeric-asc','sort-numeric-desc','thumbs-up','thumbs-down','youtube-square','youtube','xing','xing-square','youtube-play','dropbox','stack-overflow','instagram','flickr','adn','bitbucket','bitbucket-square','tumblr','tumblr-square','long-arrow-down','long-arrow-up','long-arrow-left','long-arrow-right','apple','windows','android','linux','dribbble','skype','foursquare','trello','female','male','gittip','sun-o','moon-o','archive','bug','vk','weibo','renren','pagelines','stack-exchange','arrow-circle-o-right','arrow-circle-o-left','toggle-left','caret-square-o-left','dot-circle-o','wheelchair','vimeo-square','turkish-lira','try'
    );

    sort($fa4_icons);
    return $fa4_icons;
  }

  public function additional_editor_buttons($buttons) {
    $buttons[] = 'fontsizeselect';
    $buttons[] = 'forecolorpicker';
    $buttons[] = 'hr';
    $buttons[] = 'del';
    $buttons[] = 'sub';
    $buttons[] = 'sup';

    return $buttons;
  }

  public function customize_text_sizes($initArray)
  {
    $initArray['theme_advanced_font_sizes'] = "10px,12px,14px,16px,18px,20px,22px,24px,30px,36px,48px,54px,61px,72px,84px,96px";
    return $initArray;
  }

  public function style_selector( $buttons ) {
      array_unshift( $buttons, 'styleselect' );
      return $buttons;
  }

  /* Add styles/classes to the "Styles" drop-down
  - - - - - - - - - - - - - - - - - - - - -*/
  public function add_styles_to_style_select( $settings ) {
      $style_formats = array(
            // Buttons
            array(
              'title' => 'buttons & links',
              'items' => array(
                          array(
                        'title'    => 'Button',
                        'selector' => 'a',
                        'classes'  => 'button',
                        'exact'    => true
                              ),
                          array(
                        'title'    => 'Button Alt',
                        'selector' => 'a',
                        'classes'  => 'button alt',
                        'exact'    => true
                              ),
                          array(
                        'title'    => 'Button highlight',
                        'selector' => 'a',
                        'classes'  => 'button highlight',
                        'exact'    => true
                              ),
                          array(
                        'title'    => 'Button Extra',
                        'selector' => 'a',
                        'classes'  => 'button extra',
                        'exact'    => true
                              ),
                          //Video Lightbox link
                     //      array(
                        // 'title'    => 'media Popup link',
                        // 'selector' => 'a',
                        // 'classes'  => 'media-lightbox',
                        // 'exact'    => true
                     //          ),
                )
              ),
            //formatting
            array(
              'title' => 'Text Formatting',
              'items' => array(
                          array(
                            'title'    => 'center column',
                        'block'    => 'div',
                        'classes'  => 'center-restrict',
                        'wrapper'  => true,
                        'exact'    => true
                            ),
                          array(
                            'title'    => 'pull left',
                        'block'    => 'div',
                        'classes'  => 'pull-left',
                        'wrapper'  => true,
                        'exact'    => true
                            ),
                          array(
                            'title'    => 'pull right',
                        'block'    => 'div',
                        'classes'  => 'pull-right',
                        'wrapper'  => true,
                        'exact'    => true
                            ),
                          array(
                            'title'    => 'Heading Center Basic 1',
                            'selector' => 'h1, h2, h3, h4, h5, h6',
                        'classes'  => 'heading-style-1',
                        'wrapper'  => false,
                        'exact'    => false
                            ),
                           array(
                            'title'    => 'Heading Center Basic 2',
                            'selector' => 'h1, h2, h3, h4, h5, h6',
                        'classes'  => 'heading-style-2',
                        'wrapper'  => false,
                        'exact'    => false
                            ),
                          array(
                            'title'    => 'Font Weight Light',
                            'inline'   => 'span',
                        'classes'  => 'thin',
                        'wrapper'  => false,
                        'exact'    => false
                            ),
                          array(
                            'title'    => 'Font Weight Regular',
                            'inline'   => 'span',
                        'classes'  => 'fat',
                        'styles'   => array(
                            'font-weight' => 'normal'
                          ),
                        'wrapper'  => false,
                        'exact'    => false
                            ),
                          array(
                            'title'    => 'Font Weight Heavy',
                            'inline'   => 'span',
                        'classes'  => 'fat',
                        'styles'   => array(
                            'font-weight' => 'bold',
                            'font-weight' => '900'
                          ),
                        'wrapper'  => false,
                        'exact'    => false
                            ),
                          array(
                            'title'    => 'cite',
                        'block'    => 'cite',
                        'wrapper'  => true,
                        'exact'    => true
                            ),
                          array(
                            'title'    => 'small',
                        'block'    => 'small',
                        'wrapper'  => true,
                        'exact'    => true
                            ),
                )
              ),
            // Alert Boxes
        array(
          'title' => 'Alert Boxes',
          'items' => array(
                      array(
                        'title'    => 'alert-info',
                    'block'    => 'div',
                    'classes'  => 'alertbox info',
                    'wrapper'  => true,
                    'exact'    => true
                        ),
                      array(
                        'title'    => 'alert-success',
                    'block'    => 'div',
                    'classes'  => 'alertbox success',
                    'wrapper'  => true,
                    'exact'    => true
                        ),
                      array(
                        'title'    => 'alert-warning',
                    'block'    => 'div',
                    'classes'  => 'alertbox warning',
                    'wrapper'  => true,
                    'exact'    => true
                        ),
                      array(
                        'title'    => 'alert-error',
                    'block'    => 'div',
                    'classes'  => 'alertbox error',
                    'wrapper'  => true,
                    'exact'    => true
                        ),
            )
          ),
        // Column Styles
        array(
          'title' => 'Column Styles',
          'items' => array(
                  array(
                        'title'    => 'Clear',
                    'block'    => 'div',
                    'classes'  => 'cf clear',
                    'wrapper'  => true,
                    'exact'    => true
                        ),
                      array(
                    'title'   => '1 / 2 Column',
                    'block'   => 'div',
                    'classes' => 'one_half editor-grid',
                    'wrapper' => true,
                    'exact'   => true
                      ),
                      array(
                    'title'   => '1 / 2 last',
                    'block'   => 'div',
                    'classes' => 'one_half last editor-grid',
                    'wrapper' => true,
                    'exact'   => true
                      ),
                      array(
                    'title'   => '1 / 3 Column',
                    'block'   => 'div',
                    'classes' => 'one_third editor-grid',
                    'wrapper' => true,
                    'exact'   => true
                      ),
                      array(
                    'title'   => '1 / 3 Last',
                    'block'   => 'div',
                    'classes' => 'one_third last editor-grid',
                    'wrapper' => true,
                    'exact'   => true
                      ),
                      array(
                    'title'   => '2 / 3 Column',
                    'block'   => 'div',
                    'classes' => 'two_third editor-grid',
                    'wrapper' => true,
                    'exact'   => true
                      ),
                      array(
                    'title'   => '2 / 3 Last',
                    'block'   => 'div',
                    'classes' => 'two_third last editor-grid',
                    'wrapper' => true,
                    'exact'   => true
                      ),
                      array(
                    'title'   => '1 / 4 Column',
                    'block'   => 'div',
                    'classes' => 'one_fourth editor-grid',
                    'wrapper' => true,
                    'exact'   => true
                      ),
                      array(
                    'title'   => '1 / 4 Last',
                    'block'   => 'div',
                    'classes' => 'one_fourth last editor-grid',
                    'wrapper' => true,
                    'exact'   => true
                      ),
                      array(
                    'title'   => '3 / 4 Column',
                    'block'   => 'div',
                    'classes' => 'three_fourth editor-grid',
                    'wrapper' => true,
                    'exact'   => true
                      ),
                      array(
                    'title'   => '3 / 4 Last',
                    'block'   => 'div',
                    'classes' => 'three_fourth last editor-grid',
                    'wrapper' => true,
                    'exact'   => true
                      ),
                      array(
                    'title'   => '1 / 5 Column',
                    'block'   => 'div',
                    'classes' => 'one_fifth editor-grid',
                    'wrapper' => true,
                    'exact'   => true
                      ),
                      array(
                    'title'   => '1 / 5 Last',
                    'block'   => 'div',
                    'classes' => 'one_fifth last editor-grid',
                    'wrapper' => true,
                    'exact'   => true
                      ),
                      array(
                    'title'   => '2 / 5 Column',
                    'block'   => 'div',
                    'classes' => 'two_fifth editor-grid',
                    'wrapper' => true,
                    'exact'   => true
                      ),
                      array(
                    'title'   => '2 / 5 Last',
                    'block'   => 'div',
                    'classes' => 'two_fifth last editor-grid',
                    'wrapper' => true,
                    'exact'   => true
                      ),
                      array(
                    'title'   => '3 / 5 Column',
                    'block'   => 'div',
                    'classes' => 'three_fifth editor-grid',
                    'wrapper' => true,
                    'exact'   => true
                      ),
                      array(
                    'title'   => '3 / 5 Last',
                    'block'   => 'div',
                    'classes' => 'three_fifth last editor-grid',
                    'wrapper' => true,
                    'exact'   => true
                      ),
                      array(
                    'title'   => '4 / 5 Column',
                    'block'   => 'div',
                    'classes' => 'four_fifth editor-grid',
                    'wrapper' => true,
                    'exact'   => true
                      ),
                      array(
                    'title'   => '4 / 5 Last',
                    'block'   => 'div',
                    'classes' => 'four_fifth last editor-grid',
                    'wrapper' => true,
                    'exact'   => true
                      ),
                      array(
                    'title'   => '1 / 6 Column',
                    'block'   => 'div',
                    'classes' => 'one_sixth editor-grid',
                    'wrapper' => true,
                    'exact'   => true
                      ),
                      array(
                    'title'   => '1 / 6 Last',
                    'block'   => 'div',
                    'classes' => 'one_sixth last editor-grid',
                    'wrapper' => true,
                    'exact'   => true
                      ),
                      array(
                    'title'   => '5 / 6 Column',
                    'block'   => 'div',
                    'classes' => 'five_sixth editor-grid',
                    'wrapper' => true,
                    'exact'   => true
                      ),
                      array(
                    'title'   => '5 / 6 Last',
                    'block'   => 'div',
                    'classes' => 'five_sixth last editor-grid',
                    'wrapper' => true,
                    'exact'   => true
                      )
            )
          ),

            // End Column Styles

         // End Styles Array
      );
      $settings['style_formats'] = json_encode( $style_formats );
      return $settings;
  }

}

