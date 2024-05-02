<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class ApiController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
 * @OA\Info(title="API SCHOOL", version="1.0")
 * @OA\Server(url="http://school-app.test/api")
 * @OA\Schemes(format="http")
 * @OA\SecurityScheme(
 *      securityScheme="bearerAuth",
 *      in="header",
 *      name="Authorization",
 *      type="http",
 *      scheme="Bearer",
 *      bearerFormat="JWT",
 * ),
 */

    /**
     * Api Response (Response Model for api)
     *
     * @param null $data
     * @param null $apiMessage
     * @param int $code
     * @return \Illuminate\Http\JsonResponse [String] message
     */
    public function apiResponse($data = null, $apiMessage = null, $error = null, $code = null)
    {
        return response()->json([
            'data' => $data,
            'message' => $apiMessage,
            'error' => $error,
            'api_version' => env('APP_VERSION')
        ], $code, [], JSON_UNESCAPED_UNICODE);
    }
}
