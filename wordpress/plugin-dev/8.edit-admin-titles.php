<?php

// hint: registers special custom admin title columns
function clb_register_custom_admin_titles() {
  add_filter(
    'the_title',
    'clb_custom_admin_titles',
    99,
    2
  );
}

// hint: handles custom admin title "title" column data for post types without titles
function clb_custom_admin_titles( $title, $post_id ) {
   
  global $post;

  $output = $title;
 
  if( isset($post->post_type) ):
              switch( $post->post_type ) {
                      case 'clb_subscriber':
                            $fname = get_field('clb_fname', $post_id );
                            $lname = get_field('clb_lname', $post_id );
                            $output = $fname .' '. $lname;
                            break;
              }
      endif;
 
  return $output;
}

