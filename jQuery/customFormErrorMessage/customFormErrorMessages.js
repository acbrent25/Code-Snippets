jQuery(document).ready(function($){
	console.log('ready');
	
// Require Event Type and send error if empty
$('.sub-btn').click(function(e){
   e.preventDefault();
   // Get Form ID
   var alertMessage = [];
   var alert = '';
   if ($('#event_type_id').val() === ''){
      alertMessage.push("Please Select an Event Type");
   }
   if($('#widget_type_id').val() === ''){
      alertMessage.push("Please Select a Widget Type");
   } 
 
   if(alertMessage != undefined || alertMessage != 0){
      for(var i = 0; i < alertMessage.length; i++){
         console.log("alert message " + alertMessage[i]);
         alert += alertMessage[i] + '<br>';
         $('.alert').html(alert).show();
      }
   }


});
	
});