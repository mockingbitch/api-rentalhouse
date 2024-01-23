<?php
///**
// * OAuth 2.0 Client credentials grant.
// *
// * @author      Alex Bilbie <hello@alexbilbie.com>
// * @copyright   Copyright (c) Alex Bilbie
// * @license     http://mit-license.org/
// *
// * @link        https://github.com/thephpleague/oauth2-server
// */
//
//namespace App\Core\Passport;
//
//use DateInterval;
//use Laravel\Passport\Client;
//use League\OAuth2\Server\Exception\OAuthServerException;
//use League\OAuth2\Server\Grant\ClientCredentialsGrant as BaseClientCredentialsGrant;
//use League\OAuth2\Server\RequestAccessTokenEvent;
//use League\OAuth2\Server\RequestEvent;
//use League\OAuth2\Server\ResponseTypes\ResponseTypeInterface;
//use Psr\Http\Message\ServerRequestInterface;
//
///**
// * Client credentials grant class.
// */
//class ClientCredentialsGrant extends BaseClientCredentialsGrant
//{
//    /**
//     * {@inheritdoc}
//     */
//    public function respondToAccessTokenRequest(
//        ServerRequestInterface $request,
//        ResponseTypeInterface $responseType,
//        DateInterval $accessTokenTTL
//    ) {
//        list($clientId) = $this->getClientCredentials($request);
//
//        $client = $this->getClientEntityOrFail($clientId, $request);
//
//        if (!$client->isConfidential()) {
//            $this->getEmitter()->emit(new RequestEvent(RequestEvent::CLIENT_AUTHENTICATION_FAILED, $request));
//
//            throw OAuthServerException::invalidClient($request);
//        }
//
//        // Validate request
//        $this->validateClient($request);
//
//        $scopes = $this->validateScopes($this->getRequestParameter('scope', $request, $this->defaultScope));
//
//        // Finalize the requested scopes
//        $finalizedScopes = $this->scopeRepository->finalizeScopes($scopes, $this->getIdentifier(), $client);
//
//        // Get user from client
//        $user = Client::find($client->getIdentifier())->user;
//
//        // Issue and persist access token
//        $accessToken = $this->issueAccessToken($accessTokenTTL, $client, $user->id, $finalizedScopes);
//
//        // Send event to emitter
//        $this->getEmitter()->emit(new RequestAccessTokenEvent(RequestEvent::ACCESS_TOKEN_ISSUED, $request, $accessToken));
//
//        // Inject access token into response type
//        $responseType->setAccessToken($accessToken);
//
//        return $responseType;
//    }
//}
