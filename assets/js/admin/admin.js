
// This File is called on any admin panel with the WP editor
//- - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Chosen v0.11.1 | (c) 2011-2013 by Harvest | MIT License, https://github.com/harvesthq/chosen/blob/master/LICENSE.md



jQuery(document).ready(function($) {

// Chosen Select Box replacement
// $('#sc_select, #icon_select').chosen({
//   disable_search_threshold: 10
// });

var icowrap = $(".ico-wrap");
var icotrig = $("#ico-trig");
var scWrap = $(".sc-wrap");
var scTrig = $("#sc-trig");

// icons button - toggle select
$("#ico-trig, #ico-close").on("click", function() {
		icowrap.toggle();
		icotrig.toggle();

		scWrap.hide();
		scTrig.show();
});

// Shortcode button - toggle select
$("#sc-trig, #sc-close").on("click", function() {
		scWrap.toggle();
		scTrig.toggle();

		icowrap.hide();
		icotrig.show();
});

// add icons to icon drop down as a visual cue
// $('#icon_select_chzn .chzn-results li').each(function() {
// 	$(this).addClass( 'fa fa-'+$(this).text() );
// });


// Icon Drop Down
$("#icon_select").change(function() {
		var iconVal = $("#icon_select :selected").val();
		send_to_editor("&nbsp;<i class=\"fa fa-"+iconVal+"\"><span style=\"color:transparent;display:none;\">i</span></i>&nbsp;");
		return false;
})


/*

SHORTCODEs
 - Auto embed Gists   				        [gist id="ID" file="FILE"]
 - Google Map 								[googlemap width="200" height="200" src="[url]"]
 - Hide Content with Count Down Timer 		[cdt month="10" day="17" year="2014"]content[/cdt]
 - Link Email Address 						[emaillink mail="" subject="" ]
 - Media Popup								[mediapopup src="" text=""]
 - Modal 									[modal text="" id=""][/modal]
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
*/



// Shortcode Dropdown Switch
$("#sc_select").change(function() {

	var scVal = $("#sc_select :selected").val();

			switch(scVal) {
				case "shortcode":
				return false;
				break;

				case "gallery":
				send_to_editor("[gallery itemtag=\"div\" icontag=\"span\" captiontag=\"p\"]");
				break;

				case "video":
				send_to_editor("[video src=\"\" width=\"\" height=\"\" poster=\"\" ]");
				break;

				case "audio":
				send_to_editor("[audio src=\"\" ]");
				break;

				case "gist":
				send_to_editor("[gist id=\"ID\" file=\"FILE\"]");
				break;

				case "googlemap":
				send_to_editor("[googlemap width=\"200\" height=\"200\" src=\"[url]\"]");
				break;

				case "cdt":
				send_to_editor("[cdt month=\"10\" day=\"17\" year=\"2011\"]content to be hidden until the release date[/cdt]");
				break;

				case "emaillink":
				send_to_editor("[emaillink mail=\"\" subject=\"\" ]");
				break;

				case "mediapopup":
				send_to_editor("[mediapopup src=\"\" text=\"\"]");
				break;

				case "modal":
				send_to_editor("[modal text=\"\" id=\"\"][/modal]");
				break;

				case "contact":
				send_to_editor("[contact subject=\"\" error_empty=\"\" error_noemail=\"\" success=\"\" ]");
				break;

				case "series":
				send_to_editor("[series title=\"Posts In This Series\" title_wrap=\"h4\" limit=\"-1\" list=\"ol\" future=\"on\"]");
				break;

				case "column":
				send_to_editor("[column width=\"one-third\" last=\"false\" ][/column]");
				break;

				case "button":
				send_to_editor("[button type=\"default\" text=\"\" link=\"\" icon=\"\" bg=\"\" color=\"\"]");
				break;

				case "alert":
				send_to_editor("[alert type=\"info\" title=\"\" message=\"\" icon=\"\"]");
				break;

				case "heading_style":
				send_to_editor("[heading_style type=\"stlye-1\" title=\"styled\" subtitle=\"heading subtitle\"]");
				break;

				case "pullquote":
				send_to_editor("[pullquote align=\"left\"][/pullquote]");
				break;

				case "recent-posts":
				send_to_editor("[recent-posts count=\"5\"]");
				break;

				default : send_to_editor(jQuery("#sc_select :selected").val());
			}

		return false;
});


});