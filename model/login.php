<?php


//This is a all-in-one example of API authentication and making API calls using OAuth
//More information on using OAuth with Disqus can be found here: http://disqus.com/api/docs/auth/

error_reporting(E_ALL ^ E_NOTICE) ;

$PUBLIC_KEY = "CFdwBHTkz28s3951gIuQXWsY0cXyg2n8EsJZh6Utx3DYeGEt5U3mXUqaC9kIxhut";
$SECRET_KEY = "3nfyqWADVhAHrDVUGRPXQw1WF5VAseQf0WQaD9hbgBAoKFJBLY6C0I3b8oxrhv0m";

$redirect = "http://localhost/controller/login.php";

// Get the code to request access
if(isset($_GET['code'])){

	session_start();


	$CODE = $_GET['code'];

	// Build the URL and request the authentication token
	extract($_POST);


	$url = 'https://disqus.com/api/oauth/2.0/api_key/?';
	$fields = array(
	  'grant_type'=>"api_key",
	  'redirect_uri'=>($redirect),
	  'code'=>($CODE)
	);

	//url-ify the data for the POST
	$fields_string='';
	foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
	$fields_string=rtrim($fields_string, "&");
	echo "fields_string= " .$fields_string."<br>";

	//open connection
	$ch = curl_init();

	//set the url, number of POST vars, POST data
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_POST,1);
	curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Le temps de la version de dév (ce serait à changer avant la prod finale)
	//curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);

	//execute post
	$data = curl_exec($ch);
	/*if($data === false)
	  echo 'Erreur Curl : ' . curl_error($ch);
	else
	  var_dump($data);*/

	//close connection
	curl_close($ch);

	//turn the string into a object
	$auth_results = json_decode($data);

	// Store the results in the user's session on Hotspotmap
	$_SESSION['username']      = $auth_results->username;
	$_SESSION['user_id']       = $auth_results->user_id;
	$_SESSION['access_token']  = $auth_results->access_token;
	$_SESSION['api_secret']    = $auth_results->api_secret;
	$_SESSION['expires_in']    = $auth_results->expires_in;
	$_SESSION['token_type']    = $auth_results->token_type;
	$_SESSION['scope']         = $auth_results->scope;
	$_SESSION['api_key']       = $auth_results->api_key;
	$_SESSION['refresh_token'] = $auth_results->refresh_token;

	// User is logged in, we redirect him to the home page.
	header('Location: ../controller/home.php');
	die();

} else {

	// No code means the user just clicked to login.
	// We redirect to the disqus authentification page.
	// We have to use headers since the authentification will only work if the requesting page is also the recieving page.
	$endpoint = 'https://disqus.com/api/oauth/2.0/authorize/?';
	$client_id = $PUBLIC_KEY;
	$scope = 'read,write';
	$response_type = 'api_key';

	$auth_url = $endpoint.'scope='.$scope.'&response_type='.$response_type.'&redirect_uri='.$redirect;

	header('Location: ' . $auth_url);
	die();
}

?>



