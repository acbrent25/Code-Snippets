<?php

// On Taxonomy Template
// Get terms and find out if it's a parent or child then display content based on that
   $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); 
      
      // If term parent show the State Page
      if ($term->parent == 0) : 
         // Do something
      else: 
         // Do something
      endif;
?>

<?php

// ACF on Taxonomy Term
// Get Terms 
$term_obj = get_queried_object();
// Get Custom Field in Terms
$terms = get_field('custom_field', $term_obj);

?>

<?php foreach($terms as $term) : ?>
   <a href="<?php echo $link; ?>/<?php echo strtolower($term->name); ?>"><?php echo $term->name; ?></a>, 
<?php endforeach; ?> 
   