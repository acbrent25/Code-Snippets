<?php

// Get everything before character
$fullurl = explode('?', $code, 2);
$url = $fullurl[0];

// Get everything after ? in url
$code = $_SERVER['QUERY_STRING'];