<?php get_header(); ?>
   


<?php
// Get URL
$url = 'https://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
// Get Everything after last slash
$location = basename($url);

// Convert URL to Array
$location_arr = explode('/', $url);
// Slice the array up 4 slots and back 2 to get the state
$location_sliced = array_slice($location_arr, 4, -2);
// Get the state
$state = implode('/', $location_sliced);

?>

<?php 
   $websites = 0;
   // Get Directory Items at current location for count
   $directory_item_loop = new WP_Query( array( 
	'post_type' => 'us',
	'posts_per_page' => -1,
	'orderby' => 'title',
   'order'   => 'DESC',
	'tax_query' => array(
		 array(
		  'taxonomy' => 'location',
	     'field' => 'slug',
	     'terms' => $location,
	     'include_children' => true,
	     'operator' => 'IN'
		 )
	),

   )  );
	
	// Get number of business
	$businesses = 0;
	
	while( $directory_item_loop->have_posts() ) : $directory_item_loop->the_post(); 
	   $businesses++;
      
      // Get Number of websiteds
      if( get_field('website_link') ): 
      	 $websites++;
      endif;
   endwhile; ?>


<?php 
   
   // Get terms and find out if it's a parent or child then display content based on that
   $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); 
      

      
      wp_list_categories('taxonomy='.$state.'&depth=1&show_count=0&title_li=&child_of=' . $term->term_id);

      // Count children terms for # of cities display
      $taxonomy_name = get_queried_object()->taxonomy;
      $term_id = get_queried_object_id(); // Get the id of the taxonomy
     
      // $termchildren (cities) = get_term_children( $term_id, $taxonomy_name ); // Get the children of said taxonomy
      $termchildren = get_terms($taxonomy_name, array( 'child_of' => $term_id ) ); // This way organizes them alphabetically by name
      $cities = 0;
        
         // For each city increase the city count
         foreach ( $termchildren as $child ) {
            $cities++;        
         } 
         
      ?>
      
      <?php       
      
      // If term parent show the State Page
      if ($term->parent == 0) : ?>
      
      <div class="container vc-container" role="main">
         <div class="vc_row wpb_row vc_row-fluid arrow-standard">
            <div class="vc_col-sm-12 wpb_column vc_column_container">
               <div class="wpb_wrapper">
                  <div class="vc_row wpb_row vc_inner vc_row-fluid arrow-">
                     <div class="vc_col-sm-12 wpb_column vc_column_container">
                        <div class="wpb_wrapper">
                           <div id="directory">
                              <h1><?php echo $state; ?> Diamond Buyers, Gold Buyers &amp; Pawnbrokers Directory</h1>
                              <div id="stateintro">
      
                                 <div id="statestats">
                                    <div class="statsblock">
                                       Cities: <?php echo $cities; ?>,
                                       Businesses: <?php echo $businesses; ?>,
                                       Businesses with websites: <?php echo $websites; ?> 
                                 </div>
                                 
                                 <!-- Location Description // Edit the location to change -->
                                 <?php echo term_description(); ?>
                              </div>
      
                              <table id="citylist">
                                 
                                 <tbody>
                                    <?php foreach ( $termchildren as $child ) : 
                                       // Get City Name
                                       $city = get_term($child, $taxonomy_name);
                                       
                                       $city_name = $city->name;
                                       $city_slug = $city->slug;
                                       
                                    ?>
                                    
                                    <?php 
                                       // Get All Pawnbrokers for count
                                       $pb_city_loop = new WP_Query( array( 
                                 		'post_type' => 'us',
                                 		'posts_per_page' => -1,
                                 		'orderby' => 'title',
                                       'order'   => 'DESC',
                                 		'meta_key' => 'type',
                                 		'meta_value' => 'pawnbroker',
                                 		'tax_query' => array(
                                 			 array(
                                 			     'taxonomy' => 'location',
                                 			     'field' => 'slug',
                                 			     'terms' => $city_slug,
                                 			 )
                                 		),
                                 
                                 	)  );
                                 	
                                 	$pb_counter = 0;
                                 	while( $pb_city_loop->have_posts() ) : $pb_city_loop->the_post(); 
                                 	$pb_counter++;
                                    ?>
                                    <?php endwhile; ?>
                                    
                                    <?php 
                                       // Get All Diamond Buyers for count
                                       $db_city_loop = new WP_Query( array( 
                                 		'post_type' => 'us',
                                 		'posts_per_page' => -1,
                                 		'orderby' => 'title',
                                       'order'   => 'DESC',                                 		
                                 		'meta_key' => 'type',
                                 		'meta_value' => 'diamond buyer',
                                 		'tax_query' => array(
                                 			 array(
                                 			     'taxonomy' => 'location',
                                 			     'field' => 'slug',
                                 			     'terms' => $city_slug,
                                 			 )
                                 		),
                                 
                                 	)  );
                                 	
                                 	$db_counter = 0;
                                 	while( $db_city_loop->have_posts() ) : $db_city_loop->the_post(); 
                                 	$db_counter++;
                                    ?>
                                    <?php endwhile; ?>

                                    <tr>
                                       <td><a href="<?php echo $url; ?>/<?php echo $city_slug  ?>"><?php echo $city_name; ?></a></td>
                                    
                                       <td>Pawnbrokers: <?php echo $pb_counter; ?></td>
                                       <td>Diamond buyers: <?php echo $db_counter; ?></td>
                                    </tr>
                                    <?php endforeach; ?>

                                 </tbody>
                              </table>
      
                              <p>
                              </p>
      
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

     
   <?php 
      // Else if term child show the City Page
      else:

      // Latitude and longitude
      $term = get_queried_object();
      $latitude = get_field('latitude', $term);
      $longitude = get_field('longitude', $term);
      $text_below = get_field('text_below', $term);
   ?>	
   




   <div class="container vc-container" role="main">
   <div class="vc_row wpb_row vc_row-fluid arrow-standard">
      <div class="vc_col-sm-12 wpb_column vc_column_container">
         <div class="wpb_wrapper">
            <div class="vc_row wpb_row vc_inner vc_row-fluid arrow-">
               <div class="vc_col-sm-12 wpb_column vc_column_container">
                  <div class="wpb_wrapper">
                     <div id="directory">
                        <h1 itemscope="" itemtype="http://schema.org/Place"><span itemprop="name"><?php echo $location ?>, <?php echo $state; ?></span><span
                              itemprop="geo" itemscope="" itemtype="http://schema.org/GeoCoordinates">
                              <meta itemprop="latitude" content="<?php echo $longitude; ?>">
                              <meta itemprop="longitude" content="<?php echo $latitude; ?>"></span> Pawnbrokers, Diamond &amp; Gold Buyers Directory</h1>
                           <!-- Location Description // Edit the location to change -->
                           <?php echo term_description(); ?>

                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   <!-- Setup Pawn Broker Loop    -->
   <?php $pb_loop = new WP_Query( array( 
		'post_type' => 'us',
		'posts_per_page' => -1,
		'meta_key' => 'type',
		'meta_value' => 'pawnbroker',
		'orderby'   => 'title',
		'order'     => 'ASC', 
		'tax_query' => array(
			 array(
			     'taxonomy' => 'location',
			     'field' => 'slug',
			     'terms' => $location,
			     'include_children' => false,
			     'operator' => 'IN'
			 )
		),

	)  ); 
	
   if ( $pb_loop->have_posts() ) : ?> 
     <div class="vc_row wpb_row vc_row-fluid arrow-standard">
         <div class="vc_col-sm-12 wpb_column vc_column_container">
            <div class="wpb_wrapper">
               <div class="vc_row wpb_row vc_inner vc_row-fluid arrow-">
                  <div class="vc_col-sm-12 wpb_column vc_column_container">
                     <div class="wpb_wrapper">
                        <div>
                           <h2 id="pawnbrokers">Pawnbrokers</h2>
                           <ul class="addresslist">
                              
                              
                               <?php		
                              while( $pb_loop->have_posts() ) : $pb_loop->the_post();  
                              	// Setup Vars
                              	$street_address 	= get_field('st_address');
                              	$zip_code 			= get_field('zip_code');
                              	$phone_number 		= get_field('phone_number');
                              	$fax_number 		= get_field('fax_number');
                              	$website_link 		= get_field('website_link');
                              ?>
                              <li itemscope="" itemtype="http://schema.org/LocalBusiness">
   
                                 <div class="business" itemprop="name"><?php echo the_title(); ?></div>
                                 
                                 <?php if (!empty( $street_address )) : ?>
                                    <div class="address" itemprop="address" itemscope="" itemtype="http://schema.org/PostalAddress"><span itemprop="streetAddress"><?php echo $street_address; ?></span>
                                 <?php endif; ?>
                                 
                                 <?php if (!empty( $zip_code )) : ?>
                                 <br>Zip code: <span itemprop="postalCode"><?php echo $zip_code; ?></span><br></div>
                                 <?php endif; ?>
                                 
                                 <?php if (!empty( $phone_number )) : ?>
                                 <div class="telephone">
                                    <span class="phomber">
                                       <a href="tel:<?php echo $phone_number; ?>" class="phonenumber">
                                          <div itemprop="telephone"><?php echo $phone_number; ?></div>
                                       </a>
                                    </span>
                                    
                                    <?php if (!empty( $fax_number )) : ?>
                                       <div itemprop="faxNumber"><?php echo $fax_number; ?></div>
                                    <?php endif; ?>
                                    
                                 </div>
                                 <?php endif; ?>
                                 
                                 <?php if (!empty( $website_link )) : ?>
                                    <div class="web">
                                       <div itemprop="url"><?php echo $website_link ; ?></div>
                                    </div>
                                 <?php endif; ?>                           
                              </li>
                              <?php	 endwhile;  wp_reset_query(); ?> 
                           </ul>
   
                           <div class="row">
                              <div class="large-4 medium-4 medium-push-4 columns large-push-4">
                                 <p>
                                    <a class="button expand" target="" title="Get Your Offer" href="https://www.wpdiamonds.com/get-offer/">
                                       <span>Get A Free Quote Now</span>
                                    </a>
                                 </p>
                              </div>
                           </div>
                           
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   <?php endif; ?>
   
   
      <!-- Setup Diamond Buyer Loop    -->
      <?php $db_loop = new WP_Query( array( 
   		'post_type' => 'us',
   		'posts_per_page' => -1,
   		'meta_key' => 'type',
   		'meta_value' => 'diamond buyer',
   		'orderby'   => 'title',
   		'order'     => 'ASC', 
   		'tax_query' => array(
   			 array(
   			     'taxonomy' => 'location',
   			     'field' => 'slug',
   			     'terms' => $location,
   			     'include_children' => false,
   			     'operator' => 'IN'
   			 )
   		),
   
   	)  );
   	if ( $db_loop->have_posts() ) : ?>  
     <div class="vc_row wpb_row vc_row-fluid arrow-standard">
      <div class="vc_col-sm-12 wpb_column vc_column_container">
         <div class="wpb_wrapper">
            <div class="vc_row wpb_row vc_inner vc_row-fluid arrow-">
               <div class="vc_col-sm-12 wpb_column vc_column_container">
                  <div class="wpb_wrapper">
                     <div>
                        <h2 id="diamondbuyers">Diamond Buyers</h2>
                        <ul class="addresslist">
                           

                           <?php		
                            while( $db_loop->have_posts() ) : $db_loop->the_post();  
                           	// Setup Vars
                           	$street_address 	= get_field('st_address');
                           	$zip_code 			= get_field('zip_code');
                           	$phone_number 		= get_field('phone_number');
                           	$fax_number 		= get_field('fax_number');
                           	$website_link 		= get_field('website_link');
                           ?>                           
                           <li itemscope="" itemtype="http://schema.org/LocalBusiness">

                              <div class="business" itemprop="name"><?php echo the_title(); ?></div>
                              
                              <?php if (!empty( $street_address )) : ?>
                                 <div class="address" itemprop="address" itemscope="" itemtype="http://schema.org/PostalAddress"><span itemprop="streetAddress"><?php echo $street_address; ?></span>
                              <?php endif; ?>
                              
                              <?php if (!empty( $zip_code )) : ?>
                              <br>Zip code: <span itemprop="postalCode"><?php echo $zip_code; ?></span><br></div>
                              <?php endif; ?>
                              
                              <?php if (!empty( $phone_number )) : ?>
                              <div class="telephone">
                                 <span class="phomber">
                                    <a href="tel:<?php echo $phone_number; ?>" class="phonenumber">
                                       <div itemprop="telephone"><?php echo $phone_number; ?></div>
                                    </a>
                                 </span>
                                 
                                 <?php if (!empty( $fax_number )) : ?>
                                    <div itemprop="faxNumber"><?php echo $website_link; ?></div>
                                 <?php endif; ?>
                                 
                              </div>
                              <?php endif; ?>
                              
                              <?php if (!empty( $website_link )) : ?>
                                 <div class="web">
                                    <div itemprop="url"><?php echo $fax_number ; ?></div>
                                 </div>
                              <?php endif; ?>                           
                           </li>
                           <?php	 endwhile; endif;  wp_reset_query(); ?>
                           
                        </ul>

                        <div class="row">
                           <div class="large-4 medium-4 medium-push-4 columns large-push-4">
                              <p>
                                 <a class="button expand" target="" title="Get Your Offer" href="<?php echo get_home_url(); ?>/get-offer/">
                                    <span>Get A Free Quote Now</span>
                                 </a>
                              </p>
                           </div>
                        </div>
                        
                        <?php if (!empty( $text_below )) : ?> 
                           <p><?php echo $text_below; ?></p>
                        <?php endif; ?> 
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?php endif; ?>



<?php get_footer(); ?>

   
