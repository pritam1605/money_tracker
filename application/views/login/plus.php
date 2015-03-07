<?php 
	set_include_path(get_include_path() . PATH_SEPARATOR . '/path/to/google-api-php-client/src');

	// Ensure that this is no request forgery going on, and that the user
	// sending us this connect request is the user that was supposed to.
	if ($request->get('state') != ($app['session']->get('state'))) 
	{
	    return new Response('Invalid state parameter', 401);
	}

	$code = $request->getContent();
	$gPlusId = $request->get['gplus_id'];
	// Exchange the OAuth 2.0 authorization code for user credentials.
	$client->authenticate($code);

	$token = json_decode($client->getAccessToken());
	// Verify the token
	$reqUrl = 'https://www.googleapis.com/oauth2/v1/tokeninfo?access_token=' .
	      $token->access_token;
	$req = new Google_HttpRequest($reqUrl);

	$tokenInfo = json_decode(
	  $client::getIo()->authenticatedRequest($req)->getResponseBody());

	// If there was an error in the token info, abort.
	if ($tokenInfo->error) 
	{
		return new Response($tokenInfo->error, 500);
	}
	// Make sure the token we got is for the intended user.
	if ($tokenInfo->userid != $gPlusId) 
	{
		return new Response("Token's user ID doesn't match given user ID", 401);
	}
	// Make sure the token we got is for our app.
	if ($tokenInfo->audience != CLIENT_ID) 
	{
		return new Response("Token's client ID does not match app's.", 401);
	}

?>