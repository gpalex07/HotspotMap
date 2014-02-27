<?php

$PUBLIC_KEY = "CFdwBHTkz28s3951gIuQXWsY0cXyg2n8EsJZh6Utx3DYeGEt5U3mXUqaC9kIxhut";
$SECRET_KEY = "3nfyqWADVhAHrDVUGRPXQw1WF5VAseQf0WQaD9hbgBAoKFJBLY6C0I3b8oxrhv0m";
$redirect = "http://localhost/controller/home.php";

$endpoint = 'https://disqus.com/api/oauth/2.0/authorize?';
$client_id = $PUBLIC_KEY;
$scope = 'read,write';
$response_type = 'api_key';

$auth_url = $endpoint.'&client_id='.$client_id.'&scope='.$scope.'&response_type='.$response_type.'&redirect_uri='.$redirect;



// In case the user has logged in with Disqus SSO,
// the server has now return a code in the redirect url
// we need to request an api_key with this code
if(isset($_GET['code']))
{
}





/*$PUBLIC_KEY = "CFdwBHTkz28s3951gIuQXWsY0cXyg2n8EsJZh6Utx3DYeGEt5U3mXUqaC9kIxhut";
$SECRET_KEY = "3nfyqWADVhAHrDVUGRPXQw1WF5VAseQf0WQaD9hbgBAoKFJBLY6C0I3b8oxrhv0m";
$redirect = "http://localhost/controller/home.php";

$endpoint = 'https://disqus.com/api/oauth/2.0/authorize?';
$client_id = $PUBLIC_KEY;
$scope = 'read,write';
$response_type = 'code';

$auth_url = $endpoint.'&client_id='.$client_id.'&scope='.$scope.'&response_type='.$response_type.'&redirect_uri='.$redirect;*/


// Trigger the initial authentication call to receive a code
//echo "<h3>Login  -> <a href='".$auth_url."'>OAuth</a></h3>";

?>