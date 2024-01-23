<?php

namespace App\Http\Controllers\Api;

use App\Core\Logging\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Contracts\Repositories\UserRepositoryInterface;
use Laravel\Passport\ClientRepository;
use Mockery\Exception;

class AuthController extends Controller
{
    /**
     * Constructor
     *
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(
        public UserRepositoryInterface $userRepository,
    )
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
            $response['token']      = $user->createToken(env('APP_NAME'))
                ->accessToken;
            Log::append('login', $response);

            return response()->json([
                'response' => $response
            ], 200);
        }

        return response()->json([
            'error' => __('message.login.failed')
        ], 401);
    }

    /**
     * Register
     *
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        try {
            $input = $request->all();
            $input['password'] = bcrypt($input['password']);
            $user = $this->userRepository->create($input);
            $result['token'] = $user->createToken(env('APP_NAME'))->accessToken;
            $result['name'] = $user->name;
            $host = request()->root();
            $client = new ClientRepository();
            $newClient = $client->create(
                $user->id,
                $user['name'],
                $host,
                'users',
                false,
                true
            );
            $result['credential'] = [
                'client_name'       => $newClient['name'],
                'client_id'         => $newClient['id'],
                'client_secret_key' => $newClient['secret'],
            ];

            return response()->json([
                'success'   => true,
                'result'    => $result
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e
            ], 200);
        }
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
    public function logout(): JsonResponse
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
