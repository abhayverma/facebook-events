<?php

namespace App;

use Facebook;
use Session;

class FacebookHelper
{

	private $facebook;

	private $helper;

	public function __construct()
	{
		$facebook = new Facebook\Facebook([
                            'app_id' => env('FB_CLIENT_ID'),
                            'app_secret' => env('FB_CLIENT_SECRET'),
                            'default_graph_version' => 'v2.6',
                            //'default_access_token' => '{access-token}', // optional
                        ]);

		$this->helper = $facebook->getRedirectLoginHelper();

		$this->facebook = $facebook;
	}

	public function getLoginUrl($redirect_url, $permissions)
	{
		return htmlspecialchars($this->helper->getLoginUrl($redirect_url, $permissions));
	}

	public function getUser($fields, $accessToken)
	{
		try {
            // Returns a `Facebook\FacebookResponse` object
            $response = $this->facebook->get($fields, $accessToken);
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
            dd('Graph returned an error: ' . $e->getMessage());
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
            dd('Facebook SDK returned an error: ' . $e->getMessage());
        }

        return $response->getGraphUser();
	}

	public function getData($fields, $accessToken)
	{
		try {
            // Returns a `Facebook\FacebookResponse` object
            $response = $this->facebook->get($fields, $accessToken);
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
            dd('Graph returned an error: ' . $e->getMessage());
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
            dd('Facebook SDK returned an error: ' . $e->getMessage());
        }

        return $response;
	}

    public function getImmortalToken($accessToken)
    {
        // The OAuth 2.0 client handler helps us manage access tokens
        $oAuth2Client = $this->facebook->getOAuth2Client();

        // Get the access token metadata from /debug_token
        $tokenMetadata = $oAuth2Client->debugToken($accessToken);

        // Validation (these will throw FacebookSDKException's when they fail)
        $tokenMetadata->validateAppId(env('FB_CLIENT_ID')); // Replace {app-id} with your app id
        // If you know the user ID this access token belongs to, you can validate it here
        //$tokenMetadata->validateUserId('123');
        $tokenMetadata->validateExpiration();

        if (! $accessToken->isLongLived()) {
            // Exchanges a short-lived access token for a long-lived one
            try {
                $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
            } catch (Facebook\Exceptions\FacebookSDKException $e) {
                dd("<p>Error getting long-lived access token: " . $this->helper->getMessage() . "</p>\n\n");
            }
        }
        return (string) $accessToken;
    }

    public function getAccessToken($accessToken = null)
    {
        try
        {
            $accessToken = $this->helper->getAccessToken();
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
            // When Graph returns an error
            dd('Graph returned an error: ' . $e->getMessage());
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues
            dd('Facebook SDK returned an error: ' . $e->getMessage());
        }

        if (! isset($accessToken)) {
            if ($this->helper->getError()) {
                header('HTTP/1.0 401 Unauthorized');
                echo "Error: " . $this->helper->getError() . "\n";
                echo "Error Code: " . $this->helper->getErrorCode() . "\n";
                echo "Error Reason: " . $this->helper->getErrorReason() . "\n";
                echo "Error Description: " . $this->helper->getErrorDescription() . "\n";
            } else {
                header('HTTP/1.0 400 Bad Request');
                echo 'Bad request';
            }
            exit;
        }
        return $this->getImmortalToken($accessToken);
    }
}