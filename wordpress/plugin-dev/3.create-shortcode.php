<?php
function clb_form( $args, $content="") {

  // setup our output variable - the form html
  $output = '
	
  <div class="clb">
  
    <form id="clb_form" name="clb_form" class="clb-form" method="post">
    
      <p class="clb-input-container">
      
        <label>Your Name</label><br />
        <input type="text" name="clb_fname" placeholder="First Name" />
        <input type="text" name="clb_lname" placeholder="Last Name" />
      
      </p>
      
      <p class="clb-input-container">
      
        <label>Your Email</label><br />
        <input type="email" name="clb_email" placeholder="ex. you@email.com" />
      
      </p>';
      
      // including content in our form html if content is passed into the function
      if( strlen($content) ):
      
        $output .= '<div class="clb-content">'. wpautop($content) .'</div>';
      
      endif;
      
      // completing our form html
      $output .= '<p class="clb-input-container">
      
        <input type="submit" name="clb_submit" value="Sign Me Up!" />
      
      </p>
    
    </form>
  
  </div>

';
	
	// return our results/html
	return $output;
	
}
