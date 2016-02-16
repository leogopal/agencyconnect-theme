<?php /*

Sidebar related functions
- - - - - - - - - - - - - - - - - - - - -
all functions related to widgets, sidebars and sidebar displays

*/

class Nona_Sidebars 
{
  private $sidebars;

  public function __construct($bars) 
  {
    $this->sidebars = $bars;
    add_action( 'widgets_init', array($this, 'make_sidebars') );
    add_action( 'nona_sidebar', array( $this, 'do_sidebar' ), 10, 3 );
  }

  public function make_sidebars()
  {
    if ( empty($this->sidebars) ) 
    {
      $this->register( array('default') );
    } 
    else 
    {
      foreach($this->sidebars as $sb) 
      {
        $this->register($sb);
      }
    }

  }

  private function register($sb)
  { 
    $id = ( is_array($sb) ) ? $sb[0] : $sb;
    $name = ( is_array($sb) ) ? $sb[1] : $sb;
    $desc = ( is_array($sb) ) ? $sb[2] : 'displayed depending on the theme setup';

    register_sidebar( 
      array(
        'id'            => $id,
        'name'          => __( $name, 'nona' ),
        'description'   => __( $desc, 'nona' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s ">',
        'after_widget'  => "</div>",
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>'
      )
    );
  }

  public function do_sidebar( $name="", $class="", $wrapped=true ) 
  {
    if ($wrapped) {
      $this->wrapped_sidebar($name, $class);
    } else {
      $this->just_widgets($name);
    }
  }


  private function wrapped_sidebar($name, $class)
  {
    ob_start();
      echo "<aside class='sidebar ".$class."' role='complementary'>";
        $this->just_widgets($name);
      echo "</aside>";

      $sideBarInner = ob_get_contents();
    ob_end_clean();


    // $sideBar = "<aside class='sidebar ".$class."' role='complementary'>$sideBarInner</aside>";
    echo $sideBarInner;
  }
  
  private function just_widgets($name)
  {
    if ( is_active_sidebar($name) ) 
    {
       dynamic_sidebar( $name );
    } 
    else if ( is_active_sidebar($this->which_template() ) ) 
    {
       dynamic_sidebar( $this->which_template() );
    } 
    else 
    {
      dynamic_sidebar( 'default' );
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
    }elseif (is_archive()) {
      return 'archive';
    } elseif (is_page()) {
      return 'page';
    } elseif (is_archive()) {
      return 'single';
    } else {
      return 'default';
    }
  }


  public function count_widgets( $sidebar_id, $echo = true ) 
  {
      $the_sidebars = wp_get_sidebars_widgets();
      if( !isset( $the_sidebars[$sidebar_id] ) )
          return false;
      if( $echo )
          echo count( $the_sidebars[$sidebar_id] );
      else
          return count( $the_sidebars[$sidebar_id] );
  }
}



