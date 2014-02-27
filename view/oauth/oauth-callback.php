<?php

	// My public keys (from http://disqus.com/api/applications/)
	$PUBLIC_KEY = "CFdwBHTkz28s3951gIuQXWsY0cXyg2n8EsJZh6Utx3DYeGEt5U3mXUqaC9kIxhut";
	$SECRET_KEY = "3nfyqWADVhAHrDVUGRPXQw1WF5VAseQf0WQaD9hbgBAoKFJBLY6C0I3b8oxrhv0m";

	// Get the code for request access
	$CODE = $_GET['code'];

// Request the access token
extract($_POST);

$authorize = "authorization_code";
$redirect = "http://www.example.com/results-page";

$url = 'https://disqus.com/api/oauth/2.0/access_token/?';
$fields = array(
	'grant_type'=>urlencode($authorize),
	'client_id'=>urlencode($PUBLIC_KEY),
	'client_secret'=>urlencode($SECRET_KEY),
	'redirect_uri'=>urlencode($redirect),
	'code'=>urlencode($CODE)
);

//url-ify the data for the POST
$fields_string="";
foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
rtrim($fields_string, "&");

//open chlo
$connection = curl_init();

//set the url, number of POST vars, POST data
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_POST,count($fields));
curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);

//execute post
$result = curl_exec($ch);

//close connection
curl_close($ch);

?>