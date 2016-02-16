<?php

include 'vendor/gizburdt/cuztom/cuztom.php';

/* enable constructor class on posts and pages
- - - - - - - - - - - - - - - - - - - - - - */
$posts = new Cuztom_Post_Type('post');
$pages = new Cuztom_Post_Type('page');

/* Custom post-types
- - - - - - - - - - - - - - - - - - - - - - */
$testimonials = new Cuztom_Post_Type('testimonial', array(
		'supports' => array( 'title', 'editor','thumbnail' ),
		'has_archive' => false
	)
);


/* Custom taxonomies
- - - - - - - - - - - - - - - - - - - - - - */
/* Example: To add taxonomy "property type" to the custom post type "property"*/
// $property_type = register_cuztom_taxonomy( 'property_type', 'property' );


/* Metaboxes
- - - - - - - - - - - - - - - - - - - - - - */
$posts->add_meta_box(
	'post_header',
	'Post Header',
	array(
		array(
			'name'        => 'introtitle',
			'label'       => 'Large Title',
			'description' => 'Use this to add a large descriptive title to the top of the post',
			'type'        => 'text'
		),
		array(
			'name'        => 'introdesc',
			'label'       => 'Large Introduction',
			'description' => 'Use this box to add a large brief introduction to the top of the post',
			'type'        => 'textarea'
		)
	)
);

$pages->add_meta_box(
	'page_header',
	'Page Header',
	array(
		array(
			'name'        => 'introtitle',
			'label'       => 'Large Title',
			'description' => 'Use this to add a large descriptive title to the top of the page',
			'type'        => 'text'
		),
		array(
			'name'        => 'introdesc',
			'label'       => 'Large Introduction',
			'description' => 'Use this box to add a large brief introduction to the top of the page',
			'type'        => 'textarea'
		)
	)
);


// Testimonials Meta Box
$testimonials->add_meta_box(
	't_det',
	'Testimonial Details',
	array(
		array(
			'name'        => 'client',
			'label'       => 'Testimonial Client - Individual',
			'description' => 'Name of the individual who provided the testimonial',
			'type'        => 'text'
		),
		array(
			'name'        => 'company',
			'label'       => 'Testimonial Client - Company',
			'description' => 'Company they represent',
			'type'        => 'text'
		),
		array(
			'name'        => 'position',
			'label'       => 'client position',
			'description' => 'Logo of the Company providing the testimonial',
			'type'        => 'text'
		)
	)
);
