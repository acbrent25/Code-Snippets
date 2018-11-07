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
   if ($('#eventType').val() === ''){
      alertMessage.push("Please Select an Event Type");
   }
   // Same as above
   if ($('#widgetType').val() === ''){
      alertMessage.push("Please Select a Widget Type");
   }
   
   // Same as above
   if ($('#yourName').val() === ''){
      alertMessage.push("Please Enter Your Name");
   } 
   
   // if the alert message array isn't empty
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