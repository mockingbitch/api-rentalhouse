<?php

namespace App\Http\Controllers\Api;

use App\Core\Logger\Log;
use App\Enum\ErrorCodes;
use App\Exceptions\ApiException;
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
     *
     * @param LoginRequest $request
     * @return JsonResponse
     * @throws ApiException
     * @throws \Exception
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

            return $this->success($response);
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
            $result['first_name'] = $user->first_name;
            $result['last_name'] = $user->last_name;
            $name = $user->first_name . ' ' . $user->last_name;
            $host = request()->root();
            $client = new ClientRepository();
            $newClient = $client->create(
                $user->id,
                $name,
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
     * Show user data
     *
     * @return JsonResponse
     * @throws ApiException
     */
    public function show(): JsonResponse
    {
        try {
            $user = Auth::user();

            return response()->json([
                'data' => $user
            ],200);
        } catch (Exception $exception) {
            throw new ApiException(ErrorCodes::NOT_FOUND, $exception);
        }
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

    /**
     * Require Login
     * @return JsonResponse
     */
    public function requireLogin(): JsonResponse
    {
        return response()->json([
            'message' => 'Unauthorized'
        ], 200);
    }
}
