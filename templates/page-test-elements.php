<?php
/*
Template Name: Style Guide
*/
get_header(); 
	
	/* select header template */
	do_action( 'nona_begin_template', 'default' );?>

	<div class="content content-full grid-parent">
		<div class="style-col">

			<!-- <h1>Style Guide</h1> -->
			<p>This page is a preset template with uneditable content displaying <em>all of the standard elements</em> avaialbe to us  to demonstrate the overall <abbr>UI</abbr> and to be used for <abbr>CSS</abbr> styling, and style testing. Should additional elements be needed they can be added as <abbr>HTML</abbr> inside the template.  The asspects that should be assesed include the following :</p>

			<ul>
				<li>Maintenence of a Typographic Basline</li>
				<li>Button and form element style</li>
				<li>Basic HTML elements</li>
				<li>Specific controls</li>
			</ul>

			<p>Form element styling may differ in practice when generated by a plugin, where styling has been included, there is also another test page template for widget styling.</p>

			<form action="#" method="post">
			    <div>
			        <label for="name">Name:</label>
			        <input type="text" id="name" />
			    </div>
			    <div>
			        <label for="mail">E-mail:</label>
			        <input type="email" id="mail" />
			    </div>
			    <div>
			        <label for="msg">Message:</label>
			        <textarea id="msg" rows="10" cols="50"></textarea>
			    </div>
			     <div class="formfoot">
			        <input type="submit" value="submit"/>
			    </div>
			</form>

			<h4>Headings Elements 4</h4>
			<p>Jakob nielsen headroom interstitial leading accessibility kitsch prägnanz gradient. Cognitive dissonance balsamiq grouping user. Headroom iconography figure-ground type.</p>
			<h5>Headings Elements 5</h5>
			<p>Illustrator clarity pencil pixel visualization brainstorm. Adobe resolution complementary modern dropdown color theory mockup user storyboard.</p>
			<h6>Headings Elements 6</h6>
			<p>Photoshop drawer menu archetype typeface baseline modern dieter rams golden ratio. Focus group ascenders design language omnigraffle color theory workflow. </p>

			<ol>
			    <li>list item 2</li>
			    <li>list item 2
			        <ol>
			            <li>list item 3</li>
			            <li>list item 3</li>
			        </ol>
			    </li>
			    <li>list item 2</li>
			    <li>list item 2</li>
			</ol>

			<h1>Further Typographic Testing</h1>
			<p>This page is a preset template with uneditable content displaying all of the standard elements avaialbe to us  to demonstrate the overall <abbr>UI</abbr> and to be used for <abbr>CSS</abbr> styling, and style testing. Should additional elements be needed they can be added as <abbr>HTML</abbr> inside the template.  The asspects that should be assesed <strong>include the following</strong> :</p>

			<ul>
	            <li>list item 1</li>
	            <li>list item 1
	                <ul>
	                    <li>list item 2</li>
	                    <li>list item 2
	                        <ul>
	                            <li>list item 3</li>
	                            <li>list item 3</li>
	                        </ul>
	                    </li>
	                    <li>list item 2</li>
	                    <li>list item 2</li>
	                </ul>
	            </li>
	            <li>list item 1</li>
	            <li>list item 1</li>
	        </ul>
		</div>

		<div class="style-col">
		<!-- Basic elements  -->

			<h1>Headings Elements 1</h1>
			<p>Helvetica braindump aesthetic visualization portfolio balsamiq dribbble design by committee the. Prototype glyph accessibility italic typography interactive abstraction baseline</p>
			<h2>Headings Elements 2</h2>
			<p>Clarity jakob nielsen innovate measure pencil visualization footer kerning. Front-end dribbble rounded corners the jony ive grouping modular scale dieter rams retina.</p>
			<h3>Headings Elements 3</h3>
			<p>Design language mental model sans-serif sitemap pattern modern braindump. Ascenders brainstorm delightful dribbble braindump jony ive hero message.</p>
			<h4>Headings Elements 4</h4>
			<p>Jakob nielsen headroom interstitial leading accessibility kitsch prägnanz gradient. Cognitive dissonance balsamiq grouping user. Headroom iconography figure-ground type.</p>
			<h5>Headings Elements 5</h5>
			<p>Illustrator clarity pencil pixel visualization brainstorm. Adobe resolution complementary modern dropdown color theory mockup user storyboard.</p>
			<h6>Headings Elements 6</h6>
			<p>Photoshop drawer menu archetype typeface baseline modern dieter rams golden ratio. Focus group ascenders design language omnigraffle color theory workflow. </p>

			<h1>Typographic Baseline</h1>
			<p>a strong typographic baseline is an important fundamental styling objective for creating visual harmony through out the site, we will develop a modular scale in base.css, composed with em units the fundemental values will be a 12px base font size set on the body, with a general line height ratio of 1.5 leading to a baseline of 18px, the other important number to use will be 59(px) which is the full min column width at the full width layout.  Later this will be adjusted to a 16px base font size and 24px baseline calculated in rem's (relative to the font size set on the html element.)</p>

			<h3>Elements to look out for</h3>
			<ol>
				<li>Form and button adjustments on margin, border height and line height</li>
				<li>Heading and paragraph styles</li>
				<li>tables, lists and text elements</li>
				<li>Special or unique site elements should be added</li>
			</ol>

			<p>Form element styling may differ in practice when generated by a plugin, where styling has been included, there is also another test page template for widget styling.</p>

			<dl>
			    <dt>Description Lists</dt>
			    <dd>Though seldom used are important</dd>
			    <dt>Description Titles bold</dt>
			    <dd>while the description is softened.</dd>
			</dl>

			<h1>Gravity forms markup (with placeholders)</h1>
			<p>this is the markup taken from te standard form configuration on gravity forms, to see how how basic and default form styling handles it.</p>
			<form method="post" enctype="multipart/form-data" target="gform_ajax_frame_2" id="gform_2" class="gplaceholder" action="/movingtactics/contact-moving-tactics/#gf_2">
				<div class="gform_body">
					<ul id="gform_fields_2" class="gform_fields top_label description_below">
						<li id="field_2_1" class="gfield gfield_contains_required">
						<!-- <label class="gfield_label" for="input_2_1">Name<span class="gfield_required">*</span></label> -->
							<div class="ginput_container">
								<input name="input_1" id="input_2_1" type="text" value="" class="medium" tabindex="1" placeholder="Name *">
							</div>
						</li>
						<li id="field_2_2" class="gfield gfield_contains_required">
						<!-- <label class="gfield_label" for="input_2_2">Email<span class="gfield_required">*</span></label> -->
						<div class="ginput_container">
							<input name="input_2" id="input_2_2" type="email" value="" class="medium" tabindex="2" placeholder="Email *">
							</div>
						</li>
						<li id="field_2_4" class="gfield">
						<!-- <label class="gfield_label" for="input_2_4">Phone Number</label> -->
						<div class="ginput_container">
							<input name="input_4" id="input_2_4" type="text" value="" class="medium" tabindex="3" placeholder="Phone Number">
						</div>
						</li>
						<li id="field_2_3" class="gfield">
						<!-- <label class="gfield_label" for="input_2_3">Message</label> -->
						<div class="ginput_container">
							<textarea name="input_3" id="input_2_3" class="textarea medium" tabindex="4" rows="10" cols="50" placeholder="Message"></textarea>
						</div>
						</li>
						<li id="field_2_5" class="gfield     gform_hidden">
							<input name="input_5" id="input_2_5" type="hidden" class="gform_hidden" value=""></li>
						<li id="field_2_6" class="gfield    gform_validation_container">
							<!-- <label class="gfield_label" for="input_2_6">Name</label> -->
							<div class="ginput_container">
								<input name="input_6" id="input_2_6" type="text" value="" autocomplete="off" placeholder="Name">
							</div>
							<div class="gfield_description">This field is for validation purposes and should be left unchanged.</div>
						</li>
					</ul>
				</div>
			    <div class="gform_footer top_label"> 
			    	<input type="submit" id="gform_submit_button_2" class="button gform_button" value="Submit" tabindex="5" onclick="if(window[&quot;gf_submitting_2&quot;]){return false;}  if( !jQuery(&quot;#gform_2&quot;)[0].checkValidity || jQuery(&quot;#gform_2&quot;)[0].checkValidity()){window[&quot;gf_submitting_2&quot;]=true;} " placeholder=""><input type="hidden" name="gform_ajax" value="form_id=2&amp;title=&amp;description=">
			        <input type="hidden" class="gform_hidden" name="is_submit_2" value="1">
			        <input type="hidden" class="gform_hidden" name="gform_submit" value="2">
			        <input type="hidden" class="gform_hidden" name="gform_unique_id" value="">
			        <input type="hidden" class="gform_hidden" name="state_2" value="WyJhOjA6e30iLCJmYzI3NjllNDRhM2E5ZjY4M2RkYzBhMGJhODAzN2U0MiJd">
			        <input type="hidden" class="gform_hidden" name="gform_target_page_number_2" id="gform_target_page_number_2" value="0">
			        <input type="hidden" class="gform_hidden" name="gform_source_page_number_2" id="gform_source_page_number_2" value="1">
			        <input type="hidden" name="gform_field_values" value="">
			    </div>
			</form>
		</div>

	</div>

		<?php /* select header template */
		do_action( 'nona_end_template', 'default' );

	 get_footer();