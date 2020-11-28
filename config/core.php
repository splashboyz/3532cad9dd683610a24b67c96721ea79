<?php
// show error reporting
error_reporting(E_ALL);
 
// set your default time-zone
date_default_timezone_set('Asia/Jakarta');
 
// variables used for jwt
$key = "1q2w3e4r";
$issued_at = time();
$expiration_time = $issued_at + (60 * 60); // valid for 1 hour
$issuer = "http://http://rest-api-code.net/";
?>