jQuery(document).ready(function($){
	console.log('ready');
	
// Require Event Type and send error if empty
$('.sub-btn').click(function(){
   
   // Get Form ID
   var event_type = $('#event_type_id');
   var alertMessage = [];
   
   if (event_type.val() === ''){
      alertMessage.push("Please Select an Event Type");
      $('.alert').text(alertMessage).show();
      return false;
   } 
   
   else return;
});
	
});