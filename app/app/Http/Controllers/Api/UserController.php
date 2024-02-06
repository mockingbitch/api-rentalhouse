<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Requests\UpdateUserRequest;
use App\Services\UserService;
use Exception;

class UserController extends Controller
{
    /**
     * Constructor
     *
     * @param UserService $userService
     */
    public function __construct(
        protected UserService $userService,
    )
    {

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
        } catch (Exception $e) {
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
        } catch (Exception $e) {
            return $this->responseBadRequest(['message' => $e->getMessage()]);
        }
    }

    /**
     * Update user information
     *
     * @param UpdateUserRequest $request
     * @param int|null $id
     * @return JsonResponse
     * @throws Exception
     */
    public function update(UpdateUserRequest $request, ?int $id): JsonResponse
    {
        $user                = $this->userService->update($id, $request->all());
        $response['data']    = new UserResource($user);
        $response['message'] = __('message.common.update.success');

        return $this->success($response, true);
    }

    /**
     * User Information
     *
     * @return JsonResponse
     * @throws Exception
     */
    public function information(): JsonResponse
    {
        $response['data'] = new UserResource(auth()->user());

        return $this->success($response);
    }
}
