<?php

// Get everything before character
$fullurl = explode('?', $code, 2);
$url = $fullurl[0];

// Get everything after ? in url
$code = $_SERVER['QUERY_STRING'];

// Get Query Var from URL and set to variable
// Expample URL example.com//thank-you-for-signing-up/?paid=1&eid=12349

	if(isset($_GET['eid'])){
		$transaction_id = $_GET['eid'];
   }
   
// Get Everything after last slash
$url = 'https://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
	
$str = basename($url);


// Convert URL to Array
$location_arr = explode('/', $url);
// Slice the array up 4 slots and back 2 to get the state
$location_sliced = array_slice($location_arr, 4, -2);
// Get the state
$state = implode('/', $location_sliced);