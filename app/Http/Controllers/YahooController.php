<?php

namespace App\Http\Controllers;
 
use App\Http\Controllers\Controller;
use App\Models\Authentication;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

/*
Big thanks to saurabhsahni
https://github.com/saurabhsahni/php-yahoo-oauth2
*/

class YahooController {

    public function getAuthorizationURL() : string 
    {
        $authorizationUrl = env('YAHOO_AUTHORIZATION_ENDPOINT') . '?client_id=' . env('YAHOO_CONSUMER_KEY') . '&redirect_uri=oob&language=en-us&response_type=code';
        return $authorizationUrl;
    }

    public function getAccessToken($code) : string 
    {
        $url = env('YAHOO_TOKEN_ENDPOINT');
        $postdata = array('redirect_uri' => 'oob', 'code' => $code, 'grant_type' => 'authorization_code');
	    $auth = env('YAHOO_CONSUMER_KEY') . ':' . env('YAHOO_CONSUMER_SECRET');
        $response = $this->getAuthorizationTokens('authorization_code', $code);

	    return $response->access_token;
    }

    public function storeAccessTokens($code=NULL) 
    {
        $grantType = 'authorization_code';
        if (!$code) {
            $grantType = 'refresh_token';
        }
        
        $accessTokens = $this->getAuthorizationTokens($grantType, $code);

        Authentication::updateOrCreate(
            ['name' => 'yahoo'],
            [
                'name' => 'yahoo',
                'accessToken' => $accessTokens->access_token, 
                'refreshToken' => $accessTokens->refresh_token
            ]
        );

        return  $accessTokens;
    }

    private function getAuthorizationTokens($grantType, $code=NULL)
    {
        $postdata = array("redirect_uri" => "oob", "code" => $code, "grant_type" => "authorization_code");
	    $auth = env('YAHOO_CONSUMER_KEY') . ":" . env('YAHOO_CONSUMER_SECRET');
        $client = new Client();

        $codeType = 'code';
        if (!$code) {
            $codeType = 'refresh_token';
            $authentication = Authentication::where('name', 'yahoo')->first();
            $code = $authentication->refreshToken;
        }

        try {
            $response = $client->request(
                'POST', 
                env('YAHOO_TOKEN_ENDPOINT'), 
                [
                    'headers' => [
                        'Authorization' => 'Basic ' . base64_encode($auth),
                            'Content-Type' => 'application/x-www-form-urlencoded'
                    ], 
                    'form_params' => [
                        'grant_type ' => $grantType,
                        $codeType => $code,
                        "redirect_uri" => "oob"
                    ]
                ]
            );
        } catch (ClientException $e) {
            dd($e->getMessage());
        }

        return json_decode($response->getBody()->getContents());
    }
}

?>