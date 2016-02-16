<?php 
/**
 * Class contain basic layout control methods.
 * 
 */

class Nona_Layout 
{

  private $loopPath;
  private $headerPath;
  private $footerPath;
  private $componentPath;

  public function __construct() 
  {
    if (is_admin()) return;
    
    $this->loopPath   = 'templates/loop/loop';
    $this->headerPath   = 'templates/header/header';
    $this->footerPath   = 'templates/footer/footer';
    $this->componentPath   = 'templates/components';
    

    add_action( 'nona_begin_template', array( $this, 'header_template_select' ), 10 );
    add_action( 'nona_end_template', array( $this, 'footer_template_select' ), 10 );
    add_action( 'nona_page_title', array( $this, 'page_titles' ), 10 );
    add_action( 'nona_wp_loop', array( $this, 'wp_loop' ), 10, 2 );
    add_action( 'wp_head', array( $this, 'load_favicons' ), 1 );
    add_action( 'nona_mobile_nav', array( $this, 'mobile_nav' ), 10 );
    add_action( 'nona_paginate', array( $this, 'paginate' ), 10 );
  }

  public function header_template_select($template)
  {
    get_template_part($this->headerPath, $template);
  }

  public function footer_template_select($template)
  {
    get_template_part($this->footerPath, $template);
  }

  public function page_titles() 
  {
    $part = ( is_singular() ) ? 'single' : 'archive';
    get_template_part( $this->componentPath.'/titles', $part );
  }

  public function wp_loop($class="", $noMarkup=false)
  {
    if ($noMarkup) {
      $this->just_loop();
    } else {
      $this->do_content($class);
    }
  }

  public function load_favicons()
  {
    get_template_part( $this->componentPath.'/favicons' );
  }

  private function just_loop()
  {
    get_template_part($this->loopPath);
  }

  private function just_loop_inner()
  {
    get_template_part($this->loopPath, 'inner');
  }

  private function do_content($class="index")
  { 
    $template = $this->which_template();
    ob_start();

    if (is_author())
      $this->author_bio();

    echo "<div class='content content-$template $class' role='main'>";
      if (is_search())
        get_search_form( true );
      
      $this->just_loop();
    echo "</div>";

    $content = ob_get_contents();
    ob_clean();

    echo $content;
  }

  public function mobile_nav()
  {
    get_template_part( $this->componentPath.'/nav', 'mobile' );
  }

  public function paginate()
  {
    global $wp_rewrite;
    // if are not using pretty permalinks
    if ( $wp_rewrite->permalink_structure == '' ) {

      if ( !is_singular() ) {
        nona_content_nav( 'nav-below' );
      }

    } else {

      // numeric pagination
      echo nona_paginate();
    }
  }

  private function author_bio()
  {
    if ( get_the_author_meta( 'description' ) ) {
      get_template_part( $this->componentPath.'/author', 'bio' ); 
    } 
  }

  private function which_template()
  {
    if (is_home()) {
      return 'blog';
    } elseif (is_search()) {
      return 'search';
    } elseif (is_author()) {
      return 'author';
    } elseif (is_archive()) {
      return 'archive';
    } elseif (is_page()) {
      return 'page';
    } elseif (is_archive()) {
      return 'single';
    } else {
      return 'default';
    }
  }

} // end Nona Layout

