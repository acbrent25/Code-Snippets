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



<?php
   //Function Reference/ get term hierarchy
   /** The taxonomy we want to parse */
   $taxonomy = "category";
   /** Get all taxonomy terms */
   $terms = get_terms($taxonomy, array(
           "orderby"    => "count",
           "hide_empty" => false
       )
   );
   /** Get terms that have children */
   $hierarchy = _get_term_hierarchy($taxonomy);
       /** Loop through every term */
       foreach($terms as $term) {
       //Skip term if it has children
       if($term->parent) {
         continue;
       } 
         echo $term->name;    
       /** If the term has children... */
         if($hierarchy[$term->term_id]) {
       /** display them */
       foreach($hierarchy[$term->term_id] as $child) {
       /** Get the term object by its ID */
       $child = get_term($child, "category_list");
            echo '--'.$child->name;
           }
        }
     }
 ?>