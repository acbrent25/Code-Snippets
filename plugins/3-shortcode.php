<?php

// Hook
// hint: registers all our custom shortcodes on init
add_action('init', 'clb_register_shortcodes');


// hint: registers all our custom shortcodes
function clb_register_shortcodes() {
	
	add_shortcode('clb_form', 'clb_form_shortcode');
	
}

// hint: returns a html string for a email capture form
function clb_form_shortcode( $args, $content="") {
	
	// get the list id
	$list_id = 0;
	if( isset($args['id']) ) $list_id = (int)$args['id'];
	
	// setup our output variable - the form html 
	$output = '
	
		<div class="clb">
		
			<form id="clb_form" name="clb_form" class="clb-form" method="post"
			action="/wp-admin/admin-ajax.php?action=clb_save_subscription" method="post">
			
				<input type="hidden" name="clb_list" value="'. $list_id .'">
			
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