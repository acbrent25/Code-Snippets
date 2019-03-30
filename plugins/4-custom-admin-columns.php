<?php

// Add Filters https://developer.wordpress.org/reference/functions/add_filter/

// 1.2
// hint: register custom admin column headers
add_filter('manage_edit-clb_subscriber_columns','clb_subscriber_column_headers');

/* !3. FILTERS */

// 3.1 Adds custom columns and headers: Checkbox, Title & Email Address
function clb_subscriber_column_headers( $columns ) {
	
	// creating custom column header data
	$columns = array(
		'cb'=>'<input type="checkbox" />',
		'title'=>__('Subscriber Name'),
        'email'=>__('Email Address'),	
	);
	
	// returning new columns
	return $columns;
	
}

// 1.3
// hint: register custom admin column data for post type clb_subscriber
// hint: 1,2 is priority and number of arguments
add_filter('manage_clb_subscriber_posts_custom_column','clb_subscriber_column_data',1,2);

// 3.2 Add Content to Custom Columns
function clb_subscriber_column_data( $column, $post_id ) {
	
	// setup our return text
	$output = '';
	
	switch( $column ) {
		
		case 'name':
			// get the custom name data
			$fname = get_field('clb_fname', $post_id );
			$lname = get_field('clb_lname', $post_id );
			$output .= $fname .' '. $lname;
			break;
		case 'email':
			// get the custom email data
			$email = get_field('clb_email', $post_id );
			$output .= $email;
			break;
		
	}
	
	// echo the output
	echo $output;
	
}

// 3.2.3
// hint: handles custom admin title "title" column data for post types without titles
function clb_custom_admin_titles( $title, $post_id ) {
   
	global $post;

	$output = $title;
  // if post has a post type
	if( isset($post->post_type) ):
							switch( $post->post_type ) {
											// in our post type
											case 'clb_subscriber':
														$fname = get_field('clb_fname', $post_id );
														$lname = get_field('clb_lname', $post_id );
														$output = $fname .' '. $lname;
														break;
							}
			endif;
 
	return $output;
}

