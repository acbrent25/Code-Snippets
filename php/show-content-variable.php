<?php

// Show content if test variable is present.  Usefull for testing front end code before going live
// Example URL https://adamchampagne.com/?test

if (isset($_GET["test"])) { ?>

   <h1>Your code here</h1>

<?php } ?>



<?php 
// Example URL https://adamchampagne.com/?tmode=example-variable-1
   if (isset($_GET['tmode'])) {
      $tmode = $_GET['tmode'];
      
      if ($tmode == 'example-variable-1') { 
      // do something
      
      } else if ( $tmode == "example-variable-2") {  
      // do something else
      }
      else {
         echo 'no input';
      // do something else
      }
   }

// Get URL
$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

if (strpos($url, 'car') !== false) {
   echo 'Car exists.';
} else {
   echo 'No cars.';
}


?>
