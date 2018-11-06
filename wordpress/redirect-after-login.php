<?php

// Function to redirect users not logged in away from course listing 
add_action( 'template_redirect', 'redirect_to_specific_page' );

function redirect_to_specific_page() {
	
	//	printf( __( 'The post type is: %s', 'textdomain' ), get_post_type( get_the_ID() ) );
    if (( is_archive('198') || (is_singular( 'sfwd-courses' ))) && !is_user_logged_in() ) {
        wp_redirect(get_permalink('118')); 
        exit;
    }
	// check if user is logged in before showing video-catalog  page and redirect if needed
    if (( is_archive('432') || (is_page( '432' ))) && !is_user_logged_in() ) {

    	// AZ: added  redirect_to param
        wp_redirect(get_permalink('118') . '?redirect_to=video-catalog'); 
        exit;
    }
    
    if( (is_page( '919' )) && !is_user_logged_in() ){
	    wp_redirect(get_permalink('118') . '?redirect_to=quiz-test'); 
        exit;
    }
    
}