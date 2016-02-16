# Theme Notes

## Custom Post Types
This theme uses a helper class called **cuztom** which makes creating custom post types and taxonmies much quicker. Have a look at the `lib/nona-nona-custom-posts-and-meta.php` to see how these are created.

## Templates 
The theme now makes use of the action hooks below in order to include discrete template fragments, stored in the templates directory.  Each of these can accept one or more arguments, which can be inspectected in the `lib/Nona_Layout.php` and `lib/Nona_Sidebar.php` files.

## The Loop
We use two files, loop.php and loop-inner.php that determine which template partials are neccessary to include for posts, pages, custom post types, taxonmies, archives etc.  This can be added to a templates in a number of ways, either using action hooks or through the helper methods.

## Sidebars
Sidebars can be registered easily by simple passing in a string, or an array to the array being passed into the $NonaSidebars object.  The Obj will check for a named active sidebar matching the one passed in to the do_action declaration in a template, if it doesn't find one, it will try a default based on the type of template being viewed (archive, single, etc) and if that is not found it will call the default sidebar.

## Action Hooks and Filters

* 'nona_begin_template' accepts 1 argument which will select a tempalte from the `templates/header` dir
* 'nona_wp_loop' which accepts 2 arguments, first a class for a wrapper div to be placed around the output of the standard loop, and secondly a boolean value for whether to wrap its output in a container at all.
* 'nona_sidebar' which accepts 3 arguments, firstly the name of the sidebar to call (calling a default if not given), followed by a class, and lastly a boolean value for whether it should be wrapped in a containing aside element.
* 'nona_end_template' accepts 1 argument which will select a tempalte from the `templates/footer` dir

## Layout Methods and Helpers

* `nona_detect($device)` which can be passed, mobile, desktop, tablet, android or ios
* `nona_content_nav()` which outputs basic next and previous pagination
* `nona_paginate()` outputs numbered pagination on archive pages  - when pretty permalinks are enabled
* `nona_entry_menta()` outputs the meta information about a post
* `nona_format_archive_link()` wraps the archive link in an anchor tag.
* `nona_extract_urls()` extracts the first URL from a post, useful for a variety of purposes
* `nona_get_image_from_post()` gets the first image from a post
* `nona_title($length)` returns a trimmed title according to the $length passed in
* `nona_excerpt($length)` returns a trimmed excerpt according to the $length passed in
* `nona_wp_query($args, $force_archive = true)` convenience used to create a new WP_Query object that also creates the loop and pulls in our loop and tempalte strucutre automagically.
* `nona_query_posts($args)` convenience used to override the query object with a query posts loop that also creates the loop and pulls in our loop and tempalte strucutre automagically.
* `nona_comment( $comment, $args, $depth )` used in the comments template for the comments feed.



