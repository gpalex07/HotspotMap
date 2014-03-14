<?php

class Client {
	public function __construct(){}

	// Make an HTTP request and returns the HTTP response code.
	public function request($method, $url, $data=''){

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HEADER, true);    // we want headers
		curl_setopt($ch, CURLOPT_NOBODY, true);    // we don't need body
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_TIMEOUT,10);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);


		if($method === 'POST'){
			$fields_string='';
			foreach($data as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
			rtrim($fields_string, '&');
			
			curl_setopt($ch,CURLOPT_POST, count($data));
			curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
		}


		$output = curl_exec($ch);
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);

		return $httpcode;

	}
}