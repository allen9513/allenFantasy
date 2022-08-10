<?php

namespace App\Http\Controllers;
 
use App\Http\Controllers\Controller;
use App\Models\Authentication;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

/*
Big thanks to saurabhsahni
https://github.com/saurabhsahni/php-yahoo-oauth2
*/

class YahooClient { 

    public function getAuthURL() : string 
    {
        $authorizationUrl = env('YAHOO_AUTHORIZATION_ENDPOINT') . '?client_id=' . env('YAHOO_CONSUMER_KEY') . '&redirect_uri=oob&language=en-us&response_type=code';
        return $authorizationUrl;
    }

    public function setAuth($code) : void
    {
        $authHeader = env('YAHOO_CONSUMER_KEY') . ":" . env('YAHOO_CONSUMER_SECRET');
        $client = new Client();
        
        try {
            $response = $client->request(
                'POST', 
                env('YAHOO_TOKEN_ENDPOINT'), 
                [
                    'headers' => [
                        'Authorization' => 'Basic ' . base64_encode($authHeader),
                            'Content-Type' => 'application/x-www-form-urlencoded'
                    ], 
                    'form_params' => [
                        'grant_type ' => 'authorization_code',
                        'authorization_code' => $code,
                        "redirect_uri" => "oob"
                    ]
                ]
            );
        } catch (ClientException $e) {
            dd($e->getMessage());
        }

        $this->storeAuth(json_decode($response->getBody()->getContents())); 
    }

    private function storeAuth($auth)
    {
        Authentication::updateOrCreate(
            ['name' => 'yahoo'],
            [
                'name' => 'yahoo',
                'accessToken' => $auth->access_token, 
                'refreshToken' => $auth->refresh_token,
                'expiresIn' => $auth->expires_in,
            ]
        );
    }

    public function getAuth()
    {
        $auth = Authentication::where('name', 'yahoo')->first();

        $lastRefreshed = Carbon::create($auth->updated_at);
        $secondsSinceRefreshed = $lastRefreshed->diffInSeconds(Carbon::now());

        if ($secondsSinceRefreshed >= $auth->expires_in) {
            $this->refreshAuth($auth->refreshToken);
            $auth = Authentication::where('name', 'yahoo')->first();
        }

        return $auth;
    }

    private function refreshAuth($refreshToken)
    {
        $authHeader = env('YAHOO_CONSUMER_KEY') . ":" . env('YAHOO_CONSUMER_SECRET');
        $client = new Client();
        
        try {
            $response = $client->request(
                'POST', 
                env('YAHOO_TOKEN_ENDPOINT'), 
                [
                    'headers' => [
                        'Authorization' => 'Basic ' . base64_encode($authHeader),
                        'Content-Type' => 'application/x-www-form-urlencoded'
                    ], 
                    'form_params' => [
                        'grant_type ' => 'refresh_token',
                        'refresh_token' => $refreshToken,
                        "redirect_uri" => "oob"
                    ]
                ]
            );
        } catch (ClientException $e) {
            dd($e->getMessage());
        }

        $this->storeAuth(json_decode($response->getBody()->getContents())); 
    }
}

?>