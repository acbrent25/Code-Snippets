
// Set initial load
if($(window).width() > 737) {
   $('#selector').hide();
} 

if($(window).width() <= 737) {
   $('#selector').show();
}

// Add on resize as well
$(window).resize(function() {
     if($(window).width() > 737) {
      $('#selector').hide();
   } 
   if($(window).width() <= 737) {
      $('#selector').show();
   }
});