<?php

// Put in functions file
add_filter( 'gform_ajax_spinner_url', 'custom_gforms_spinner' );

function custom_gforms_spinner($src) {
    return get_stylesheet_directory_uri() . '/assets/img/design/loading.gif';
}