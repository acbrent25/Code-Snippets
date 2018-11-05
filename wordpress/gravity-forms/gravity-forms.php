<?php 

// On error redirect to form
add_filter( 'gform_confirmation_anchor', '__return_true' );


// Hide Gravity Form field labels when using placeholders.
add_filter( 'gform_enable_field_label_visibility_settings', '__return_true' );