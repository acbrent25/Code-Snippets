jQuery(document).ready(function($) {
 
   var ajax_url = ajax_params.ajax_url; // so we access our ajax_url through the ajax_params object
   var data = {
       'action': 'my_action',
       'whatever': 1234
   };

   $.post(ajax_url, data, function(response) {
       alert(response);
   });
});