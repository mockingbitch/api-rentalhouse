<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Laravel\Passport\ClientRepository;

class UserController extends Controller
{
    public $successStatus = 200;

    /**
     * login api
     *
     * @return JsonResponse
     */
    public function login()
    {
        if (Auth::attempt(
            [
                'email' => request('email'),
                'password' => request('password')
            ]
        )) {
            $user = Auth::user();
            $success['token'] = $user->createToken('MyApp')->accessToken;

            return response()->json(
                [
                    'success' => $success
                ],
                $this->successStatus
            );
        }
        else {
            return response()->json(
                [
                    'error' => 'Unauthorised'
                ], 401);
        }
    }



    /**
     * details api
     *
     * @return JsonResponse
     */
    public function details()
    {
        $user = Auth::user();

        return response()->json(
            [
                'success' => $user
            ],
            $this->successStatus
        );
    }

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

    public function test()
    {
        $user = auth()->user();
        dd($user);
        $user->tokens()->delete();
    }
}
