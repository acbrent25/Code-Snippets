<?php

// filter
function clb_subscriber_column_header( $columns ) {
   // create cusomt column header data
   $columns = array (
     'cb'=>'<input type="checkbox" />',
     'title'=>__('Subscriber Name'),
     'email'=>__('Email Address'),
   );
 
   // returning new columns
   return $columns;
   
 }

 // hook

 // hint: register custom admin column headers
add_filter('manage_edit-clb_subscriber_columns', 'clb_subscriber_columns_headers');