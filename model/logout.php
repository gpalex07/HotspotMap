<?php

session_start();

if(isset($_SESSION['username']))
{
    session_destroy ();
}

header("Location: ../controller/home.php");
die();

/*
session_start();

function dsq_hmacsha1($data, $key) {
    $blocksize=64;
    $hashfunc='sha1';
    if (strlen($key)>$blocksize)
        $key=pack('H*', $hashfunc($key));
    $key=str_pad($key,$blocksize,chr(0x00));
    $ipad=str_repeat(chr(0x36),$blocksize);
    $opad=str_repeat(chr(0x5c),$blocksize);
    $hmac = pack(
        'H*',$hashfunc(
            ($key^$opad).pack(
                'H*',$hashfunc(
                    ($key^$ipad).$data
                    )
                )
            )
        );
    return bin2hex($hmac);
}

echo $_SESSION['api_secret'] . '<br>';
// Destroy user session on Disqus
if(isset($_SESSION['api_secret']))
{


    $api_secret_key_returned_after_authentification = $_SESSION['api_secret'];
    $message = base64_encode(json_encode("remote_auth_s3")); // To log a user out of SSO, pass remote_auth_s3 as an encoded/signed empty JSON object ({}) as the message data. (quote from disqus doc)
    echo $message . "<br>";
    
    $timestamp = time();
    echo $timestamp . "<br>";
    
    $hmac = dsq_hmacsha1($message . ' ' . $timestamp, $api_secret_key_returned_after_authentification);
    echo $hmac . '<br>';

    $fields_string = $message . ' ' . $hmac . ' ' . $timestamp;

    echo $fields_string . '<br>';

    // Send the post request
    $ch = curl_init();

    //set the url, number of POST vars, POST data
    curl_setopt($ch,CURLOPT_URL,'https://disqus.com/api/oauth/2.0/api_key/?');
    curl_setopt($ch,CURLOPT_POST,1);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false); // Le temps de la version de dév (ce serait à changer avant la prod finale)
    //curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);

    //execute post
    $data = curl_exec($ch);
    if($data === false)
      echo 'Erreur Curl post : ' . curl_error($ch);
    else
      var_dump($data);

    //close connection
    curl_close($ch);


} else echo 'Your api_secret was not found. You\'re probably already logged out from Disqus.';

// Destroy user session on Hotspotmap

*/


?>