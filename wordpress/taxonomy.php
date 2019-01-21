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


 <!-- Multi Level  -->
<?php
 // our current taxonomy slug
// If you want to get the current taxonomy automatically try using $wp_query->get_queried_object();
    $taxonomy = 'course';

// we get the terms of the taxonomy 'course', but only top-level-terms with (parent => 0)
$top_level_terms = get_terms( array(
    'taxonomy'      => $taxonomy,
    'parent'        => '0',
    'hide_empty'    => false,
) );

// only if some terms actually exists, we move on
if ($top_level_terms) {

    echo '<ul class="top-level-terms">';

    foreach ($top_level_terms as $top_level_term) {

        // the id of the top-level-term, we need this further down
        $top_term_id = $top_level_term->term_id;
        // the name of the top-level-term
        $top_term_name = $top_level_term->name;
        // the current used taxonomy
        $top_term_tax = $top_level_term->taxonomy;

        // note that the closing </li> is set further down, so that we can add a sub list item correctly
        echo '<li class="top-level-term"><strong>'.$top_term_name.'</strong>';

        // here we get the child-child terms
        // for this we are using 'child_of' => $top_term_id
        // I also set 'parent' => $top_term_id here, with this line you will only see this level and no further childs
        $second_level_terms = get_terms( array(
            'taxonomy' => $top_term_tax, // you could also use $taxonomy as defined in the first lines
            'child_of' => $top_term_id,
            'parent' => $top_term_id, // disable this line to see more child elements (child-child-child-terms)
            'hide_empty' => false,
        ) );

        // start a second list element if we have second level terms
        if ($second_level_terms) {

            echo '<ul class="second-level-terms">';

            foreach ($second_level_terms as $second_level_term) {

                $second_term_name = $second_level_term->name;

                echo '<li class="second-level-term">'.$second_term_name.'</li>';

            }// END foreach

            echo '</ul><!-- END .second-level-terms -->';

        }// END if

        echo '</li><!-- END .top-level-term -->';

    }// END foreach

    echo '</ul><!-- END .top-level-terms -->';

}// END if