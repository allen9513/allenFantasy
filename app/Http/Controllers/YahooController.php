<?php

namespace App\Http\Controllers;
 
use App\Http\Controllers\Controller;

/*
Big thanks to saurabhsahni
https://github.com/saurabhsahni/php-yahoo-oauth2
*/

class YahooController {

    const AUTHORIZATION_ENDPOINT  = 'https://api.login.yahoo.com/oauth2/request_auth';
    const TOKEN_ENDPOINT   = 'https://api.login.yahoo.com/oauth2/get_token';

    public function getAuthorizationURL() {
        $url = self::AUTHORIZATION_ENDPOINT; //todo config
        $authorizationUrl = $url.'?client_id='.env('YAHOO_CONSUMER_KEY').'&redirect_uri=oob&language=en-us&response_type=code';
        return $authorizationUrl;
    }

    public function getAccessToken($code) {
        $url = self::TOKEN_ENDPOINT; //todo config
        $postdata = array("redirect_uri" => "oob", "code" => $code, "grant_type" => "authorization_code");
	    $auth = env('YAHOO_CONSUMER_KEY') . ":" . env('YAHOO_CONSUMER_SECRET');
        $response = self::fetch($url,$postdata,$auth); 
	    $jsonResponse = json_decode($response);

	    return $jsonResponse->access_token;
    }

    public function fetch($url,$postdata="",$auth="",$headers="") {
        $curl = curl_init($url); 
	    if ($postdata) {
            curl_setopt($curl, CURLOPT_POST, true); 
	        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($postdata));
	    } 
	    else {
	        curl_setopt($curl, CURLOPT_POST, false);
	    }
	    if ($auth){
	        curl_setopt($curl, CURLOPT_USERPWD, $auth);
	    }
	    if ($headers){
	        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
	    }
	    curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
        $response = curl_exec( $curl );
        if (empty($response)) {
            // some kind of an error happened
            die(curl_error($curl));
            curl_close($curl); // close cURL handler
        } else {
            $info = curl_getinfo($curl);
            curl_close($curl); // close cURL handler
            if ($info['http_code'] != 200 && $info['http_code'] != 201 ) {
                echo "Received error: " . $info['http_code']. "\n";
                echo "Raw response:".$response."\n";
                die();
            }
        }
        return $response;
    }
}

?>