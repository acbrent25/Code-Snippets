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



// Get URL Query Vars
function getQueryVariable(variable)
{
         var query = window.location.search.substring(1);
         var vars = query.split("&");
         for (var i=0;i<vars.length;i++) {
               var pair = vars[i].split("=");
               if(pair[0] == variable){return pair[1];}
         }
         return(false);
}

// Set Project Title from Query Vars
var project_title = getQueryVariable("project_title");

// If URL contains Project Title Then Set the Title Value and Text in Form
if(project_title){
   project_title = project_title.toString().replace(/%20/g, " ");
   $('#name').val(project_title).text(project_title);
}