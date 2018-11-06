<?php

function add_our_script() {
 
   wp_register_script( 'ajax-js', get_template_directory_uri() . '/js/ajax.js', array( 'jquery' ), '', true );
   wp_localize_script( 'ajax-js', 'ajax_params', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
   wp_enqueue_script( 'ajax-js' );
    
   }
   add_action( 'wp_enqueue_scripts', 'add_our_script' );