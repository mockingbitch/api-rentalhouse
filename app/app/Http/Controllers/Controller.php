<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponse;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * Base Api controller
 * @OA\Info(
 *      version="1.0.0",
 *      title="Rental House API version 1.0 Documentation",
 *      description="Rental House API version 1.0 Documentation",
 *      @OA\Contact(
 *          email="jarvis.phongtran@gmail.com"
 *      ),
 * )
 *
 * @OA\Server(
 *      url=L5_SWAGGER_CONST_HOST,
 *      description="Rental House API version 1.0"
 * )
 *
 *
 *
 * @OA\Components(
 *    @OA\Parameter(
 *       in="path",
 *       name="Id",
 *       required=true,
 *       @OA\Schema(type="integer")
 *    ),
 *
 *    @OA\Response(response=204, description=""),
 *
 *    @OA\Response(response=400, description=""),
 *
 *    @OA\Response(response=413, description=""),
 * )
 * @OA\SecurityScheme(
 *      securityScheme="bearer",
 *      in="header",
 *      name="bearer",
 *      type="http",
 *      scheme="bearer",
 *      bearerFormat="JWT",
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests, ApiResponse;
}
