<?php

/*  - - - - - - - - - - - - - - - - - - - - - -

Recent Posts Widget
Custom Meta Widget

 - - - - - - - - - - - - - - - - - - - - - - */


/* Nona Recent Posts
 - - - - - - - - - - - - - - - - - - - - - - */
class nona_recent_posts extends WP_Widget {

    /* constructor
    - - - - - - - - - */
    function nona_recent_posts() {
        parent::__construct(false, $name = 'Nona Recent Posts');
    }

    /* Create the Widget
    - - - - - - - - - - */
    function widget($args, $instance) {
        extract( $args );
		global $posttypes;
        $title          = isset($instance['title']) ? apply_filters('widget_title', $instance['title']) : "";
        $pretext        = isset($instance['pretext'] ) ? apply_filters('widget_title', $instance['pretext']) : "";
        $cat            = isset($instance['cat']) ? apply_filters('widget_title', $instance['cat']) : "";
        $number         = isset($instance['number']) ? apply_filters('widget_title', $instance['number']) : "";
        $thumbnail_size = isset($instance['thumbnail_size']) ? apply_filters('widget_title', $instance['thumbnail_size']) : "";
        $thumbnail      = $instance['thumbnail'];
        $showexcerpt    = $instance['showexcerpt'];
        $showtimeago    = $instance['showtimeago'];
        $posttype       = $instance['posttype'];
        ?>
          <?php echo $before_widget; ?>
              <?php if ( $title )
                    echo $before_title . $title . $after_title; ?>
						<?php if ( !empty($pretext)) {

							echo wpautop($pretext);
						} ?>
						<ul class="nona-recent-posts clearfix">
						<?php

							global $post;
							$tmp_post = $post;

							// get the category IDs and place them in an array
							if($cat) {
								$args = 'posts_per_page=' . $number . '&post_type=' . $posttype . '&cat=' . $cat;
							} else {
								$args = 'posts_per_page=' . $number . '&post_type=' . $posttype;
							}
							$myposts = get_posts( $args );
							foreach( $myposts as $post ) : setup_postdata($post); ?>
								<li >
									<?php if($thumbnail == true) { ?>
										<a  href="<?php the_permalink(); ?>" class="nona-widgrt-post-img" style="float: left; width:<?php echo $thumbnail_size; ?>px;height:<?php echo $thumbnail_size; ?>px;">
												<?php echo the_post_thumbnail('medium');?>
										</a>
									<?php } ?>
									<div class="recent-post-info">
										<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><br/>
										<?php if($showexcerpt == true) { ?>
											<?php nona_excerpt(8); ?>
										<?php } ?>
										<?php if($showtimeago == true) { ?>
											<span class="time"><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?></span>
										<?php } ?>
									</div>
								</li>
							<?php endforeach; ?>
							<?php $post = $tmp_post; ?>
							<script>
								jQuery(document).ready(function($) {
									$(window).on('load', function() {
										function makeSingleCallFn(fn) {
										  var called = false;
										  return function() {
										    if (!called) {
										       fn.apply(this, arguments);
										    }
										  }
										}

										function centerImg() {
											var ul = $('ul.nona-recent-posts');
											var img = ul.find('a.nona-widgrt-post-img img');
												img.each(function() {
													var current   = $(this);
													var imgWidth  = current.outerWidth();
													var cWidth    = current.parent('a').outerWidth();
													var imgOffset = (imgWidth - cWidth) / 2;
													current.css({
														right: '-' + imgOffset + 'px'
													});
												});

										}
										var recentPostsCimg = makeSingleCallFn(centerImg);
										recentPostsCimg();
									});
								});
							</script>
						</ul> <!-- end loop output -->
					<div class="clear"></div>
        	<?php echo $after_widget; ?>
	    <?php
    }

    /* Update the Widget
    - - - - - - - - - - - - */
    function update($new_instance, $old_instance) {
		global $posttypes;
		$instance = $old_instance;

		$instance['title']          = strip_tags($new_instance['title']);
		$instance['pretext']        = strip_tags($new_instance['pretext']);
		$instance['cat']            = strip_tags($new_instance['cat']);
		$instance['number']         = strip_tags($new_instance['number']);
		$instance['thumbnail']      = $new_instance['thumbnail'];
		$instance['showexcerpt']    = $new_instance['showexcerpt'];
		$instance['showtimeago']    = $new_instance['showtimeago'];
		$instance['thumbnail_size'] = strip_tags($new_instance['thumbnail_size']);
		$instance['posttype']       = $new_instance['posttype'];
        return $instance;
    }

    /* Widget Form
    - - - - - - - - - */

    function form($instance) {

		$posttypes 		= get_post_types('', 'objects');
		$title          = isset( $instance['title'] ) ? esc_attr($instance['title']) : "";
		$pretext        = isset( $instance['pretext'] ) ? esc_attr($instance['pretext']) : "";
		$posttype       = isset( $instance['posttype'] ) ? esc_attr($instance['posttype']) : "";
		$cat            = isset( $instance['cat'] ) ? esc_attr($instance['cat']) : "";
		$number         = isset( $instance['number'] ) ? esc_attr($instance['number']) : "";
		$thumbnail      = isset( $instance['thumbnail'] ) ? esc_attr($instance['thumbnail']) : "";
		$showexcerpt    = isset( $instance['showexcerpt'] ) ? esc_attr($instance['showexcerpt']) : "";
		$showtimeago    = isset( $instance['showtimeago'] ) ? esc_attr($instance['showtimeago']) : "";
		$thumbnail_size = isset( $instance['thumbnail_size'] ) ? esc_attr($instance['thumbnail_size']) : "";

        ?>
         <p>
          <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'nona'); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        <p>
        	<label for="<?php echo $this->get_field_id('pretext'); ?>"><?php _e('Pre Post lists Text:', 'nona'); ?></label>
        	<textarea class="widefat" rows="3" cols="20" id="<?php echo $this->get_field_id('pretext'); ?>" name="<?php echo $this->get_field_name('pretext'); ?>"><?php echo $pretext; ?></textarea>
        </p>
        <p>
			<label for="<?php echo $this->get_field_id('posttype'); ?>"><?php _e('Choose the Post Type to display', 'nona'); ?></label>
			<select name="<?php echo $this->get_field_name('posttype'); ?>" id="<?php echo $this->get_field_id('posttype'); ?>" class="widefat">
			<?php
			foreach ($posttypes as $option) {
				if ($option->name !='attachment' && $option->name !='revision' && $option->name !='nav_menu_item' ) {
					echo '<option value="' . $option->name . '" id="' . $option->name . '"', $posttype == $option->name ? ' selected="selected"' : '', '>', $option->name, '</option>';
				}
			}
			?>
			</select>
		</p>
		<p>
          <label for="<?php echo $this->get_field_id('cat'); ?>"><?php _e('Category IDs, separated by commas', 'nona'); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id('cat'); ?>" name="<?php echo $this->get_field_name('cat'); ?>" type="text" value="<?php echo $cat; ?>" />
        </p>
		<p>
          <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of Posts:', 'nona'); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" />
        </p>
		<p>
          <input id="<?php echo $this->get_field_id('thumbnail'); ?>" name="<?php echo $this->get_field_name('thumbnail'); ?>" type="checkbox" value="1" <?php checked( '1', $thumbnail ); ?>/>
          <label for="<?php echo $this->get_field_id('thumbnail'); ?>"><?php _e('Display thumbnails?', 'nona'); ?></label>
        </p>
        <p>
          <input id="<?php echo $this->get_field_id('showexcerpt'); ?>" name="<?php echo $this->get_field_name('showexcerpt'); ?>" type="checkbox" value="1" <?php checked( '1', $showexcerpt ); ?>/>
          <label for="<?php echo $this->get_field_id('showexcerpt'); ?>"><?php _e('Display Excerpt?', 'nona'); ?></label>
        </p>
        <p>
          <input id="<?php echo $this->get_field_id('showtimeago'); ?>" name="<?php echo $this->get_field_name('showtimeago'); ?>" type="checkbox" value="1" <?php checked( '1', $showtimeago ); ?>/>
          <label for="<?php echo $this->get_field_id('showtimeago'); ?>"><?php _e('Display Time Ago?', 'nona'); ?></label>
        </p>
		<p>
          <label for="<?php echo $this->get_field_id('thumbnail_size'); ?>"><?php _e('Size of the thumbnails, e.g. <em>80</em> = 80px x 80px', 'nona'); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id('thumbnail_size'); ?>" name="<?php echo $this->get_field_name('thumbnail_size'); ?>" type="text" value="<?php echo $thumbnail_size; ?>" />
        </p>

        <?php
    }


} // End Class

add_action('widgets_init', create_function('', 'return register_widget("nona_recent_posts");'));




// ----------------------------------

/*

Based On : Custom Meta by the linx
Plugin Name: Custom Meta
Plugin URI: http://www.unreliablepollution.net/
Description: This plugin adds a widget that's almost like the vanilla meta widget, but it lets you choose what items to show.
Version: 1.0
Author: TheLinx
Author URI: http://www.unreliablepollution.net/

*/

function widget_cmeta_register() {
  function widget_cmeta($args) {
    extract($args);
    $options = get_option('widget_cmeta');
    $title   = $options['title'];
    $show    = array(
      'regstr'   => $options['show_regstr'],
      'loginout' => $options['show_loginout'],
      'regrss'   => $options['show_regrss'],
      'commrss'  => $options['show_commrss'],
      'wplink'   => $options['show_wplink']);
?>
    <?php echo $before_widget; ?>
      <?php echo $before_title . $title . $after_title; ?>
      <ul>
      <?php if ($show['regstr']) { wp_register(); } ?>
      <?php if ($show['loginout']) { ?><li><?php wp_loginout(); ?></li><?php } ?>
      <?php if ($show['regrss']) { ?><li><a href="<?php bloginfo('rss2_url'); ?>" title="<?php echo esc_attr(__('Syndicate this site using RSS 2.0','nona')); ?>"><?php _e('Entries <abbr title="Really Simple Syndication">RSS</abbr>'); ?></a></li><?php } ?>
      <?php if ($show['commrss']) { ?><li><a href="<?php bloginfo('comments_rss2_url'); ?>" title="<?php echo esc_attr(__('The latest comments to all posts in RSS','nona')); ?>"><?php _e('Comments <abbr title="Really Simple Syndication">RSS</abbr>'); ?></a></li><?php } ?>
      <?php if ($show['wplink']) { ?><li><a href="http://wordpress.org/" title="<?php echo esc_attr(__('Powered by WordPress, state-of-the-art semantic personal publishing platform.','nona')); ?>">WordPress.org</a></li><?php } ?>
      <?php wp_meta(); ?>
      </ul>
    <?php echo $after_widget; ?>
<?php
  }

  function widget_cmeta_control() {
    $options = get_option('widget_cmeta');
    if ( isset($_POST["cmeta-submit"]) ) {
      $newoptions['title']         = strip_tags(stripslashes($_POST["cmeta-title"]));
      $newoptions['show_regstr']   = $_POST["cmeta-sregstr"];
      $newoptions['show_loginout'] = $_POST["cmeta-sloginout"];
      $newoptions['show_regrss']   = $_POST["cmeta-sregrss"];
      $newoptions['show_commrss']  = $_POST["cmeta-scommrss"];
      $newoptions['show_wplink']   = $_POST["cmeta-swplink"];
      $options = $newoptions;
      update_option('widget_cmeta', $options);
    }
    if ( $options != $newoptions ) {
      // do fuck all ?
    }

    $title = esc_attr($options['title']);
    $show  = array(
      'regstr'   => $options['show_regstr'],
      'loginout' => $options['show_loginout'],
      'regrss'   => $options['show_regrss'],
      'commrss'  => $options['show_commrss'],
      'wplink'   => $options['show_wplink']
      ); ?>

        <p><label for="cmeta-title"><?php _e('Title:','nona'); ?> <input class="widefat" id="cmeta-title" name="cmeta-title" type="text" value="<?php echo $title; ?>" /></label></p>
        <p><label for="cmeta-sregstr"><input id="cmeta-sregstr" name="cmeta-sregstr" type="checkbox" value="1"<?php if ($show['regstr']) { echo " checked=\"checked\""; } ?> /> Show "Register/Site Admin"</label></p>
        <p><label for="cmeta-sloginout"><input id="cmeta-sloginout" name="cmeta-sloginout" type="checkbox" value="1"<?php if ($show['loginout']) { echo " checked=\"checked\""; } ?> /> Show "Log in/Log out"</label></p>
        <p><label for="cmeta-sregrss"><input id="cmeta-sregrss" name="cmeta-sregrss" type="checkbox" value="1"<?php if ($show['regrss']) { echo " checked=\"checked\""; } ?> /> Show "Entries RSS"</label></p>
        <p><label for="cmeta-scommrss"><input id="cmeta-scommrss" name="cmeta-scommrss" type="checkbox" value="1"<?php if ($show['commrss']) { echo " checked=\"checked\""; } ?> /> Show "Comments RSS"</label></p>
        <p><label for="cmeta-swplink"><input id="cmeta-swplink" name="cmeta-swplink" type="checkbox" value="1"<?php if ($show['wplink']) { echo " checked=\"checked\""; } ?> /> Show "WordPress.org"</label></p>
        <input type="hidden" id="cmeta-submit" name="cmeta-submit" value="1" />

  <?php
  }

  $ops = array(
    'classname'   => 'widget_cmeta',
    'description' => "Log in/out, admin, feed and WordPress links, configurable"
    );

  wp_register_sidebar_widget('cmeta', 'Custom Meta', 'widget_cmeta', $ops);
  wp_register_widget_control('cmeta', 'Custom Meta', 'widget_cmeta_control' );

}
add_action('widgets_init', 'widget_cmeta_register');



