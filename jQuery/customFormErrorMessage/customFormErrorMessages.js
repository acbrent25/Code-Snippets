jQuery(document).ready(function($){
	console.log('ready');
	
// Submit Button Function to Check for Empty Fields
$('.sub-btn').click(function(e){
   // Prevent default click behavoir
   e.preventDefault();
   // Create alert message array to store all alerts
   var alertMessage = [];
   // empty alert for use in loop
   var alert = '';
   // if event type is missing a value then push custom alertmessage to array
   if ($('#event_type_id').val() === ''){
      alertMessage.push("Please Select an Event Type");
   }
   // Same as above
   if ($('#widget_type_id').val() === ''){
      alertMessage.push("Please Select a Widget Type");
   } 
   
   // fi the alert message array isn't empty
   if (alertMessage != undefined || alertMessage != 0){
      //loop over ever alertmessage in array
      for(var i = 0; i < alertMessage.length; i++){
         console.log("alert message " + alertMessage[i]);
         // add alertMessages to alert for printing to DOM
         alert += alertMessage[i] + '<br>';
         // Add to DOM element and show
         $('.alert').html(alert).show();
      }
   }


});
	
});