<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * @param String $social_token
     * @return void
     */
    public function checkGoogle($social_token)
    {
        try {
            $checkToken = $this->client->get("https://www.googleapis.com/oauth2/v3/tokeninfo?id_token=$social_token");
            $responseGoogle = json_decode($checkToken->getBody()->getContents(), true);

            return $this->checkUserByEmail($responseGoogle);
        } catch (\Exception $e) {
            return $this->responseBadRequest(['message' => $e->getMessage()]);
        }
    }

    /**
     * @param String $social_token
     * @return void
     */
    public function checkFacebook($social_token)
    {
        try {
            $checkToken = $this->client->get("https://graph.facebook.com/v3.1/me?fields=id,name,email&access_token=$social_token");
            $responseFacebook = json_decode($checkToken->getBody()->getContents(), true);

            return $this->checkUserByEmail($responseFacebook);
        } catch (\Exception $e) {
            return $this->responseBadRequest(['message' => $e->getMessage()]);
        }
    }
}
