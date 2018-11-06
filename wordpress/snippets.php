<?php 

// Trim number of characters
echo substr($someVariable, 0, 110); 

// Trim Number of Words
echo wp_trim_words($someVariable, 15, '...');

// Create Custom Exerpt
echo wp_trim_words( get_the_content(), 20, '...' );

// Background URL
?>
<div style="background:url('<?php echo get_template_directory_uri( ) ?>/assets/img/banner-home.jpg'); background-repeat: no-repeat; background-size: auto; background-position: 38% 0%;"></div>

<?php



