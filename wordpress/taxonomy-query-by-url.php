<?php get_header(); 

// Set up taxonomy example
// www.example.com/us/alabama/

// Get Everything after last slash
$url = 'https://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
// Save it in a variable to add to taxonomy query
$location = basename($url);
	
?>

<div class="container">

   <?php $loop = new WP_Query( array( 
		'post_type' => 'pawn_broker', 
		'tax_query' => array(
			 array(
			     'taxonomy' => 'location',
			     'field' => 'name',
			     'terms' => $location,
			     'include_children' => false,
			     'operator' => 'IN'
			 )
		),

	)  );
    		
   while( $loop->have_posts() ) : $loop->the_post();  ?>

	      <h1>Tax title: <?php echo the_title(); ?></h1>
        
	<?php	 endwhile;  wp_reset_query(); ?>

</div>

<?php get_footer(); ?>