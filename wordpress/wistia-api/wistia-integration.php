<?php
/**
 * Template Name: Quiz with Modal and multiple quesitons pop up test
 * @package understrap
 */

get_header();
$container = get_theme_mod( 'understrap_container_type' );

// Get current user profile
$current_user = wp_get_current_user();

// Set email var
$user_email = '';

// Get Users Email Address
$current_user = wp_get_current_user();
$user_email = $current_user->user_email;
$user_name = $current_user->user_nicename;

// Assumes you have field for wistia video id
$wistia_video_id = get_field('wistia_video_id');


?>


<div class="wrapper" id="full-width-page-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content">

		<div class="row">

			<div class="col-md-12 content-area" id="primary">

				<main class="site-main" id="main" role="main">
				<div id="data" data-email="<?php echo $user_email; ?>" data-id="<?php echo $wistia_video_id; ?>" data-name="<?php echo $user_name; ?>"></div>
				
				<div id="pupop-data">
					<?php 
						// check if the repeater field has rows of data
						if( have_rows('popup_questions') ):
						
						 	// loop through the rows of data
						    while ( have_rows('popup_questions') ) : the_row(); ?>
							 	
							 	<div class="pupups" data-time="<?php the_sub_field('popup_time'); ?>"></div>

						   <?php endwhile;
						     
						else : // no rows found
						
						endif;
					?>
				</div>
				
				<script>
					// Video Data
					var videoId = jQuery('#data').data('id');
					// User Data
					var email = jQuery('#data').data('email');
					var name = jQuery('#data').data('name');
					// Create empty array then store all time values for use in Wisti JS
					var timeArr = [];
					jQuery('.pupups').each(function(){
						timeArr.push(jQuery(this).data('time'));
					});
				</script>
			
				<script src="//fast.wistia.com/assets/external/E-v1.js" async></script>
				<div id="wistiaData" class="wistia_embed wistia_async_<?php echo $wistia_video_id ?>" data-video-id="<?php echo $wistia_video_id; ?>" style="width:640px;height:360px;"></div>
				
				<script>
					// Wistia JS
					window._wq = window._wq || [];
					_wq.push({
						// Video ID from previous script
					   id: videoId,
					   onHasData: function (video) {
					      // Send Email to Wistia for Tracking
					      video.email(email);
					      // AZ: send data to PipeDrive
					      video.bind("play", function (video) {
					         if (jQuery.cookie("video" + videoId) != "1") {
					            console.log('send to pipedrive');
					            var encodeEmail = btoa(email);
					            jQuery.cookie("video" + videoId, 1);
					            jQuery.post("/api/pipedrive.php", { "e": encodeEmail, "hashedId": videoId, "name": name }, function () { });
					         }
					      });
					      
					      // Bind seconds change
					      video.bind("secondchange", function (t) {
						      // Set time to 0
					      	var time = 0;
					      	// For every time in array
						      for(var i = 0; i < timeArr.length; i++){
							      	// Set time variables
								      time = timeArr[i];
										// if t event = time then run code
							         if (t === time) {
								         // Show Modal with Timestamp ID
							            jQuery("#myModal_" + time).modal("show");
							            // Set Current Modal ID for easier DOM manipulation
							            var currentModal = "#myModal_" + time;
							            // Paus Video
							            video.pause();
							            
							            removeButtons(currentModal);
							            modalVisible(currentModal);
							         }
				      			}
				      	});

					      // If Learndash Quiz is Present
					      if (jQuery("#learndash_quizzes").length) {
					         jQuery("#learndash_quizzes").hide();
					         // When video ends launch quiz
					         video.bind("end", function () {
					            jQuery("#myModal").modal("show");
					         });
					
					      } else {
					         video.bind("end", function () {
					            jQuery("#myModal").modal("show");
					         });
					      }
					      
					      closeBtn(video);
					   }
					});
					
					// Play video when Modal is Closed
					function closeBtn(video){
						jQuery('#closeBtn').live('click', function(e){
							e.preventDefault();
							console.log('clicked close button');
							video.play();
						});						      
					}
					
					// Remove Close Buttons so Users Have to Complete Quiz
					function removeButtons(currentModal){
						console.log('current modal: ' + currentModal);
						jQuery(currentModal).find('.close').hide();
						jQuery(currentModal).find('.modal-footer').hide();
						
					}
					
					// Modify Current Modal
					function modalVisible(currentModal){
						if(jQuery(currentModal).is(':visible')){
							
							if(jQuery('.wpProQuiz_results').is(':visible')){
								console.log('results');
							}
							
							// Assign the Finish Quiz Button
							var finishBtn = jQuery(currentModal).find('input[type="button"][value="Finish Quiz"]');
							// Change the button value to Continue Quiz which changes the text
							if(finishBtn) {
								finishBtn.val('Continue Quiz');
								console.log('finishBtn: ' + finishBtn.val());
							}
							
							jQuery('input.wpProQuiz_button.wpProQuiz_QuestionButton').click(function(e){
								e.preventDefault();
								var textArea = jQuery(currentModal).find('textarea');
									
									// If text area is empty do nothing
									if (!jQuery.trim(jQuery(textArea).val())) {
									    // textarea is empty or contains only white-space
									    console.log('empty');
									} 
									// If text area has value then show show the close button
									if (jQuery.trim(jQuery(textArea).val())) {
										console.log('full');
										// Show Modal Footer containing close button
										jQuery(currentModal).find('.modal-footer').show();
									}
							});
							
						}
						
					}
					

					
				</script>	
					
				</main><!-- #main -->

			</div><!-- #primary -->
			
			<!-- MODAL FOR DISPLAYING QUIZ AT END OF VIDEO
			======================================================== -->		
			<div class="modal" tabindex="-1" role="dialog" id="myModal">
			  <div class="modal-dialog modal-lg" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title">Quiz</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
				      
					<!--  If Quiz Shortcode is present display it in modal -->
					<?php if( get_field('quiz_shortcode') ): 
						$quiz_shortcode = get_field( 'quiz_shortcode' );
					?>
						<div id="quiz-content"><?php echo do_shortcode( $quiz_shortcode ); ?></div>
			    	<?php endif; ?>
				        	
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			      </div>
			    </div>
			  </div>
			</div>
			<!-- END: MODAL 
			======================================================== -->

			<!-- DYNAMIC MODAL FOR EACH QUIZ INDIVIDUAL QUESTION
			======================================================== -->			
			<div id="dynamicModal"></div>
			<?php 
			// check if the repeater field has rows of data
			if( have_rows('popup_questions') ):
			
			 	// loop through the rows of data
			    while ( have_rows('popup_questions') ) : the_row(); ?>
				 
					<div class="modal" tabindex="-1" role="dialog" id="myModal_<?php the_sub_field('popup_time'); ?>" data-backdrop="static" data-keyboard="false">
					  <div class="modal-dialog modal-lg" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <h5 class="modal-title">Quiz</h5>
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          <span aria-hidden="true">&times;</span>
					        </button>
					      </div>
					      <div class="modal-body">
						      
							<!--  If Quiz Shortcode is present display it in modal -->
							<?php if( get_sub_field('quiz_id') ): 
								$quiz_id_shortcode = get_sub_field( 'quiz_id' );
							?>
								<div id="quiz-content"><?php echo do_shortcode( $quiz_id_shortcode ); ?></div>
					    	<?php endif; ?>
						        	
					      </div>
					      <div class="modal-footer">
					        <button type="button" id="closeBtn" class="btn btn-secondary" data-dismiss="modal">Close</button>
					      </div>
					    </div>
					  </div>
					</div>				 
				 
				 

			   <?php endwhile;
			     
			else : // no rows found
			
			endif;
		?>
			
			

		</div><!-- .row end -->

	</div><!-- Container end -->

</div><!-- Wrapper end -->


<?php get_footer(); ?>
