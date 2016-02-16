<?php
/*

UTILITY FUNCTIONS
 - Add Short code Drop down to media buttons in editor
 - clean up Short codes without raw nonsense

SHORTCODEs
 - Auto embed Gists   						[gist id="ID" file="FILE"]
 - Google Map 								[googlemap width="200" height="200" src="[url]"]
 - Hide Content with Count Down Timer 		[cdt month="10" day="17" year="2014"]content[/cdt]
 - Link Email Address 						[emaillink mail="" subject="" ]
 - Media Popup								[mediapopup src="" text=""]media-lightbox
 - Contact Form								[contact email="" subject="" label_name="" label_email="" label_subject="" label_message="" label_submit="" error_empty="" error_noemail="" success=""]
 - Post Series Custom Taxonomy 				[series title="" title_wrap="" limit="" list="" future=""]
 - Fluid columns  							[column width="one-third" last="false" ][/column]
 - Buttons 									[button type="default" text="" link="" icon="" bg="" color=""]
 - Alerts 									[alert type="info" title="" message="" icon=""]
 - Heading Styles 							[heading_style type="stlye-1" title="styled" subtitle="heading subtitle"]
 - Pull Quotes 								[pullquote align="left"][/pullquote]
 - Recent Posts 							[recent-posts count="5"]
 - Toggles
 - Tabs
 - Accordion
 - Pricing Table
 - Modal
*/

/*
add short code function drop down list to editor
- - - - - - - - - - - - - - - - - - - - - - - - - - */
function nona_add_sc_select() {
    global $shortcode_tags;
    $shortcodes_list = "";
     /*  enter names of shortcode to exclude bellow */
    $exclude = array("wp_caption", "caption", "embed");
    echo '<a id="sc-trig" class="button">Short Codes</a><span class="sc-wrap"><select id="sc_select"><option>Shortcode</option>';
    foreach ($shortcode_tags as $key => $val){
            if(!in_array($key,$exclude)){
            	$shortcodes_list .= '<option value="'.$key.'">'.$key.'</option>';
            }
        }
     echo $shortcodes_list;
     echo '</select><a id="sc-close" class="button">X</a></span>';
}


/* Clean up Short codes
- - - - - - - - - - - - - - - - - - - - - - - - - - */
function nona_clean_shortcodes($content) {
    $array = array (
		'<p>['    => '[',
		']</p>'   => ']',
		']<br />' => ']'
    );
    $content = strtr($content, $array);
    return $content;
}

add_filter('the_content', 'nona_clean_shortcodes');




/* Embed Gist
[gist id="ID" file="FILE"]
- - - - - - - - - - - - - - - - - - - - - - - - - - */
function gist_shortcode($atts) {
  return sprintf( '<script src="%s.js"></script>' ,$atts['link'] );
}

add_shortcode('gist','gist_shortcode');




/* Google Maps Shortcode -
[googlemap width="200" height="200" src="[url]"]
 - - - - - - - - - - - - - - - - - - - - - - - - - - */
function fn_googleMaps($atts, $content = null) {
       extract(shortcode_atts(array(
					"width"  => '640',
					"height" => '480',
					"src"    => ''
                    ), $atts));
      return '<iframe width="'.$width.'" height="'.$height.'" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="'.$src.'"></iframe>';
}

add_shortcode("googlemap", "fn_googleMaps");




/*Hide  content in shortcode until a count down timer runs out.
[cdt month="10" day="17" year="2014"]content[/cdt]
- - - - - - - - - - - - - - - - - - - - - - - - - - */
function nona_content_countdown($atts, $content = null){
  extract(shortcode_atts(array(
     'month' => '',
     'day'   => '',
     'year'  => ''
    ), $atts));
    $remain = ceil((mktime( 0,0,0,(int)$month,(int)$day,(int)$year) - time())/86400);
    if( $remain > 1 ){
        return $daysremain = "<div class='content-delay-event'>Just <b>($remain)</b> days until content is available</div>";
    }else if($remain == 1 ){
        return $daysremain = "<div class='content-delay-event'>Just <b>($remain)</b> day until content is available</div>";
    }else{
        return $content;
    }
}

add_shortcode('cdt', 'nona_content_countdown');



/*  Email Link
[emaillink mail="" subject="" ]
 - - - - - - - - - - - - - - - - - - - - - - - - - - */
function nona_mail_shortcode( $atts ) {
    extract(shortcode_atts(array(
    		'mail' => '',
    		'subject' => ''
    	), $atts));

    return '<a href="mailto:'.$mail.'?subject='.$subject.'" target="_blank">'.$mail.'</a>';
}

add_shortcode('emaillink', 'nona_mail_shortcode');


/* - Media Popup
[mediapopup src="" text=""]
 - - - - - - - - - - - - - - - - - - - - - - - - - - */
 function nona_mediapop_sc($atts) {
 	extract(shortcode_atts(
 		array(
 			'text' => '',
 			'src' => ''
 			),
 		$atts )
 		);

 	$medialink = "<a class='media-lightbox' href='$src'>$text</a>";
 	return $medialink;
 }

add_shortcode('mediapopup', 'nona_mediapop_sc');

/* - Modal Box
[modal text="" id=""][/modal]
 - - - - - - - - - - - - - - - - - - - - - - - - - - */
 function nona_modalbox_sc( $atts, $content ) {
 	extract(shortcode_atts(
 		array(
 			'text' => '',
 			'id' => '',
 			'button' => '',
 			'icon' => ''
 			),
 		$atts )
 		);

 	$buttontrue = ($button != '') ? "button $button" : '';
 	$icontrue = ($icon != '') ? "<i class='fa fa-$icon'></i>" : '';

 	$modalout = "<a class='modtrigger $buttontrue' href='#$id'>$icontrue$text</a>";
 	$modalout .= "<div id='$id' style='display:none;'>";
 	$modalout .= do_shortcode( $content );
 	$modalout .= "</div>";
 	return $modalout;
 }

add_shortcode('modal', 'nona_modalbox_sc');

/* contact form
[contact email="" subject="" label_name="" label_email="" label_subject="" label_message="" label_submit="" error_empty="" error_noemail="" success=""]
 - - - - - - - - - - - - - - - - - - - - - - - - - - */
// function to get the IP address of the user
function nona_get_the_ip() {
	if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
		return $_SERVER["HTTP_X_FORWARDED_FOR"];
	}
	elseif (isset($_SERVER["HTTP_CLIENT_IP"])) {
		return $_SERVER["HTTP_CLIENT_IP"];
	}
	else {
		return $_SERVER["REMOTE_ADDR"];
	}
}

// the shortcode

function nona_contact_form($atts) {
	extract(shortcode_atts(array(
		"email"         => get_bloginfo('admin_email'),
		"subject"       => '',
		"label_name"    => 'Your Name',
		"label_email"   => 'Your E-mail Address',
		"label_subject" => 'Subject',
		"label_message" => 'Your Message',
		"label_submit"  => 'Submit',
		"error_empty"   => 'Please fill in all the required fields.',
		"error_noemail" => 'Please enter a valid e-mail address.',
		"success"       => 'Thanks for your e-mail! We\'ll get back to you as soon as we can.'
	), $atts));




	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$error = false;
		$required_fields = array("your_name", "email", "message", "subject");

		foreach ($_POST as $field => $value) {
			if (get_magic_quotes_gpc()) {
				$value = stripslashes($value);
			}
			$form_data[$field] = strip_tags($value);
			var_dump($form_data);
		}

		foreach ($required_fields as $required_field) {
			$value = trim($form_data[$required_field]);
			if(empty($value)) {
				$error = true;
				$result = $error_empty;
				// var_dump($value);
			}
		}

		if(!is_email($form_data['email'])) {
			$error = true;
			$result = $error_noemail;
		}

		if ($error == false) {
			$email_subject = "[" . get_bloginfo('name') . "] " . $form_data['subject'];
			$email_message = $form_data['message'] . "\n\nIP: " . nona_get_the_ip();
			$headers  = "From: ".$form_data['your_name']." <".$form_data['email'].">\n";
			$headers .= "Content-Type: text/plain; charset=UTF-8\n";
			$headers .= "Content-Transfer-Encoding: 8bit\n";
			wp_mail($email, $email_subject, $email_message, $headers);
			$result = $success;
			$sent = true;
		}
	} else {
		$result = "";
		$sent = "";
		$form_data = array(
				'your_name' => "",
				'email' => "",
				'subject' => "",
				'message' => ""
			);
		$info = "";
	}

	if ($result != "") {
		$info = '<div class="info">'.$result.'</div>';
	}
	$email_form = '<form class="nona-contact-form clearfix" method="post" action="'.get_permalink().'">

			<label for="cf_name">'.$label_name.':</label>
			<input type="text" name="your_name" id="cf_name" placeholder="'.$label_name.'" value="'.$form_data['your_name'].'" />

			<label for="cf_email">'.$label_email.':</label>
			<input type="text" name="email" id="cf_email" placeholder="'.$label_email.'" value="'.$form_data['email'].'" />

			<label for="cf_subject">'.$label_subject.':</label>
			<input type="text" name="subject" id="cf_subject" placeholder="'.$label_subject.'" value="'.$subject.$form_data['subject'].'" />

			<label for="cf_message">'.$label_message.':</label>
			<textarea name="message" id="cf_message" cols="50" rows="15" placeholder="'.$label_message.'">'.$form_data['message'].'</textarea>

		<div id="nona-contact-submit" class="clearfix">
			<input type="submit" value="'.$label_submit.'" name="send" id="cf_send" />
		</div>
	</form>';

	if($sent == true) {
		return $info;
	} else {
		return $info.$email_form;
	}

}

add_shortcode('contact', 'nona_contact_form');




/*  Series of Posts (by taxonomy)
[series title="" title_wrap="" limit="" list="" future=""]
- - - - - - - - - - - - - - - - - - - - - */
function series_tax() {
	$labels = array(
		'name' => __('Series', 'nona'),
		'singular_name' => __('Series', 'nona'),
		'all_items' => __('All Series','nona'),
		'edit_item' => __('Edit Series','nona'),
		'update_item' => __('Update Series','nona'),
		'add_new_item' => __('Add New Series','nona'),
		'new_item_name' => __('New Series Name','nona'),
		'menu_name' => __('Series','nona')
	);

	register_taxonomy(
		'series',
		array('post'), /* if you want to use pages or custom post types, simply extend the array like array('post','page','custom-post-type') */
		array(
			'hierarchical' => true, /* if set to "true", you can use Series as categories; if set to "false", you can use them as tags! */
			'labels' => $labels,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array('slug' => 'series'), /* you may need to flush the rewrite rules at Options -> Permalinks (just update the existing preferences without any change) */
		)
	);
}
add_action('init', 'series_tax', 0);

// The shortcode function of Post Series
function series_sc($atts) {
	extract(
		shortcode_atts(
			array(
				"slug" => '',
				"id" => '',
				"title" => '',
				"title_wrap" => 'h3',
				"list" => 'ol',
				"limit" => -1,
				"future" => 'on'
			),
			$atts
		)
	);
	if ($id) {
		// Use the "id" attribute if it exists
		$tax_query = array(array('taxonomy' => 'series', 'field' => 'id', 'terms' => $id));
	}
	elseif ($slug) {
		// Use the "slug" attribute if "id" does not exist
		$tax_query = array(array('taxonomy' => 'series', 'field' => 'slug', 'terms' => $slug));
	}
	else {
		// Use posts own Series tax if neither "id" nor "slug" exist
		$terms = get_the_terms($post->ID,'series');
		if ($terms && !is_wp_error($terms)) {
			$tax_query = array(array('taxonomy' => 'series', 'field' => 'slug', 'terms' => $term[0]->slug));
		}
		else {
			$error = true;
		}
	}
	if ($title) {
		// Create the title if the "title" attribute exists
		$title_output = '<'.$title_wrap.' class="post-series-title">'.$title.'</'.$title_wrap.'>';
	}
	if ($future == 'on') {
		// Include the future posts if the "future" attribute is set to "on"
		$post_status = array('publish','future');
	}
	else {
		// Exclude the future posts if the "future" attribute is set to "off"
		$post_status = 'publish';
	}
	if ($error == false) {
		$args = array(
			'tax_query' => $tax_query,
			'posts_per_page' => $limit,
			'orderby' => 'date',
			'order' => 'ASC',
			'post_status' => $post_status
		);
		$the_posts = get_posts($args);
		/* if there is more than one post with the specified "series" taxonomy, display the list. if there is just one post with the specified taxonomy, there is no need to list the only post! */
		if (count($the_posts) > 1) {
			// display the title first
			$output = $title_output;
			// create the list tag - notice the "post-series-list" class
			$output .= '<'.$list.' class="post-series-list">';
			// the loop to list the posts
			foreach ($the_posts as $post) {
				setup_postdata($post);
				if ($post->post_status == 'publish') {
					$output .= '<li><a href="'.get_permalink($post->ID).'">'.get_the_title($post->ID).'</a></li>';
				}
				else {
					/* we can not link the post if the post is not published yet! */
					$output .= '<li>Future post: '.get_the_title($post->ID).'</li>';
				}
			}
			wp_reset_query();
			// close the list tag...
			$output .= '</'.$list.'>';
			// ...and return the whole output!
			return $output;
		}
	}
}
add_shortcode('series','series_sc');


/* Fluid Columns
[column width="one-third" last="false" ][/column]
- - - - - - - - - - - - - - - - - - - - - - - - - - */
function nona_column_sc( $atts , $content = null ) {
	extract( shortcode_atts(
		array(
			'width' => 'one-third',
			'last' => 'false',
		), $atts )
	);

	$islast = ( $last ) ? "-last" : "";
	$column = "<div class=".$width.$last.">$ontent</div>";
	return $column;
}

add_shortcode( 'column', 'nona_column_sc' );


/* Buttons
[button type="default" text="" link="" icon="" bg="" color=""]
- - - - - - - - - - - - - - - - - - - - - - - - - - */
function nona_buttons_sc( $atts ) {
	extract( shortcode_atts( array(
			"type" => "default",  // default  - alt - highlight - extra
			"icon" => "",
			"bg" => "",
			"color" => "",
			"text"=> "Alert Box",
			"link" => "#"
		),
		$atts )
	);

	$inserticon = ($icon != "") ? "<i class='fa fa-$icon'></i>" : "" ;
	$bgoverride = ($bg != "") ? "backgorund:$bg;" : "";
	$coloroverride = ($color != "") ? "color:$color;" : "";

	$buttonout = "<a class='button $type' style='$bgoverride $coloroverride'>$inserticon $text</a>";
	return $buttonout;

}

add_shortcode('button', 'nona_buttons_sc');


/* Alerts
[alert type="info" title="" message="" icon=""]
- - - - - - - - - - - - - - - - - - - - - - - - - - */
function nona_alert_sc( $atts ) {
	extract( shortcode_atts( array(
			"type" => "info",  // info  - success - warning - error
			"icon" => "",
			"title"=> "Alert Box",
			"message" => "This is an alert box and can have a variety of styles depending on your needs."
		),
		$atts )
	);
	$inserticon = ($icon != "") ? "<i class='fa fa-$icon'></i>" : "" ;
	$alertbox = "<div class='alertbox $type'>$inserticon<h4>$title</h4><p>$message</p></div>";
	return $alertbox;

}


add_shortcode('alert', 'nona_alert_sc');

/* Header Style
[heading_style type="stlye-1" title="styled header" subtitle="styled header subtitle"]
- - - - - - - - - - - - - - - - - - - - - - - - - - */
function nona_heading_style_sc( $atts ) {
	extract( shortcode_atts( array(
			"type" => "style-1",  // info  - success - warning - error
			"icon" => "",
			"title"=> "",
			"stubtitle" => ""
		),
		$atts )
	);
	$inserticon = ($icon != "") ? "<i class='fa fa-$icon'></i>" : "" ;
	$heading = "<hgroup class='heading-$type'><h2>$inserticon $title</h2><h3>$subtitle</h3></hgroup>";
	return $heading;

}


add_shortcode('heading_style', 'nona_heading_style_sc');

/* Pull Quotes
[pullquote align="left"][/pullquote]
- - - - - - - - - - - - - - - - - - - - - - - - - - */
function nona_pullquote_sc( $atts , $content = null ) {
	extract( shortcode_atts(
		array(
			'align' => 'left'
		), $atts )
	);

	$pullquote = "<div class=pull-".$align.">$ontent</div>";
	return $pullquote;
}

add_shortcode( 'pullquote', 'nona_pullquote_sc' );

/* Accordion
[]
- - - - - - - - - - - - - - - - - - - - - - - - - - */





/* Tabs
[]
- - - - - - - - - - - - - - - - - - - - - - - - - - */





/* Toggles
[]
- - - - - - - - - - - - - - - - - - - - - - - - - - */





/* Query Posts
[recent-posts count="5"]
- - - - - - - - - - - - - - - - - - - - - - - - - - */
function recent_posts_shortcode( $atts ) {

	// Attributes
	extract( shortcode_atts(
		array(
			'count' => '5',
		), $atts )
	);

	// Code
$output = '<ul>';
$recent_post_query = new WP_Query( array ( 'posts_per_page' => $posts ) );
while ( $recent_post_query->have_posts() ): $recent_post_query->the_post();
	$output = '<li>' . get_the_title() . '</li>';
endwhile;
wp_reset_postdata();
$output = '</ul>';
return $output;

}
add_shortcode( 'recent-posts', 'recent_posts_shortcode' );
