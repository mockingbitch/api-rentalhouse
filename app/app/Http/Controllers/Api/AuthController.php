<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Constructor
     */
    public function __construct()
    {
    }

    /**
     * Login
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        if (Auth::attempt([
                'email'     => $request->email,
                'password'  => $request->password
            ])
        ) {
            $user = Auth::user();
            $response['message']    = __('message.login.success');
            $response['token']      = $user->createToken('MyApp')
                ->accessToken;

            return response()->json([
                'response' => $response
            ], 200);
        }

        return response()->json([
            'error' => __('message.login.failed')
        ], 401);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function getUserDetail(): JsonResponse
    {
        if(Auth::guard('api')->check()){
            $user = Auth::guard('api')->user();

            return response()->json([
                'data' => $user
            ],200);
        }

        return response()->json([
            'data' => __('message.login.failed')
        ], 401);
    }

    /**
     * Display the specified resource.
     */
    public function userLogout(): JsonResponse
    {
        if(Auth::guard('api')->check()){
            $accessToken = Auth::guard('api')->user()->token();

            \DB::table('oauth_refresh_tokens')
                ->where('access_token_id', $accessToken->id)
                ->update(['revoked' => true]);
            $accessToken->revoke();

            return response()->json([
                'message'   => __('message.logout.success')
            ],200);
        }

        return response()->json([
            'data' => __('message.login.failed')
        ],401);
    }
}
