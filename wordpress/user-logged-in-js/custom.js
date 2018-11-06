var data = {
   action: 'is_user_logged_in'
};

jQuery.post(ajaxurl, data, function(response) {
   if(response == 'yes') {
       // user is logged in, do your stuff here
   } else {
       // user is not logged in, show login form here
   }
});