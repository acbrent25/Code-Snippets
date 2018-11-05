// If URL has Query Vars
if(document.location.search.length) {
   
   // Get the URL Pramaters
   var urlParams = new URLSearchParams(window.location.search);
   
   // EX: https://yourside.com/?confirmed=1

   if(urlParams.get('confirmed') == 1){
       console.log('confirmed');
          // Hide the form
         $('#selecotr').hide();
         // Show confirmation Message
         $('#selecotr').show();
         // Show Press Button
         $('.selecotr').show().appendTo('#selecotr');
   }

}