<?php

session_start();

//This is a all-in-one example of API authentication and making API calls using OAuth
//More information on using OAuth with Disqus can be found here: http://disqus.com/api/docs/auth/

error_reporting(E_ALL ^ E_NOTICE) ;

$PUBLIC_KEY = "CFdwBHTkz28s3951gIuQXWsY0cXyg2n8EsJZh6Utx3DYeGEt5U3mXUqaC9kIxhut";
$SECRET_KEY = "3nfyqWADVhAHrDVUGRPXQw1WF5VAseQf0WQaD9hbgBAoKFJBLY6C0I3b8oxrhv0m";
$redirect = "http://localhost/view/oauth/sso-oauthbased.php";

$endpoint = 'https://disqus.com/api/oauth/2.0/authorize/?';
$client_id = $PUBLIC_KEY;
$scope = 'read,write';
$response_type = 'api_key';

$auth_url = $endpoint.'scope='.$scope.'&response_type='.$response_type.'&redirect_uri='.$redirect;

echo $auth_url;

// Trigger the initial authentication call to receive a code
echo "<h3>Trigger authentication -> <a href='".$auth_url."'>OAuth</a></h3>";


// Get the code to request access
$CODE = $_GET['code'];

if($CODE){
  echo "CODE= " .$CODE."<br>";

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
if($data === false)
  echo 'Erreur Curl : ' . curl_error($ch);
else
  var_dump($data);

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




echo "<p><h3>The authentication information returned:</h3>";
var_dump($auth_results);
echo "</p>";

$access_token = $auth_results->access_token;

echo "<p><h3>The access token you'll use in API calls:</h3>";
echo $access_token;
echo "</p>";
echo $auth_results->access_token;


  function getData($url, $SECRET_KEY, $access_token){

        //Setting OAuth parameters
        $oauth_params = (object) array(
          'access_token' => $access_token, 
          'api_secret' => $SECRET_KEY
          );

          $param_string = '';

          
          //Build the endpiont from the fields selected and put add it to the string.
       
          //foreach($params as $key=>$value) { $param_string .= $key.'='.$value.'&'; }
          foreach($oauth_params as $key=>$value) { $param_string .= $key.'='.$value.'&'; }
          $param_string = rtrim($param_string, "&");

          // setup curl to make a call to the endpoint
          $url .= $param_string;

          //echo $url;
          $session = curl_init($url);

          // indicates that we want the response back rather than just returning a "TRUE" string
          curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($session,CURLOPT_FOLLOWLOCATION,true);

          // execute GET and get the session backs
          $results = curl_exec($session);
          // close connection
          curl_close($session);
          // show the response in the browser
          return  json_decode($results);
    }


    //Setting the correct endpoint
    $cases_endpoint = 'https://disqus.com/api/3.0/users/details.json?';

    //Calling the function to getData
    $user_details = getData($cases_endpoint, $SECRET_KEY, $access_token);
    echo "<p><h3>Getting user details:</h3>";
    var_dump($user_details);
    echo "</p>";
    
    //Setting the correct endpoint
    $forums_endpoint = 'https://disqus.com/api/3.0/users/listForums.json?';

    //Calling the function to getData
    $forum_details = getData($forums_endpoint, $SECRET_KEY, $access_token);
    echo "<p><h3>Getting forum details:</h3>";
    var_dump($forum_details);
    echo "</p>";
    }

?>


