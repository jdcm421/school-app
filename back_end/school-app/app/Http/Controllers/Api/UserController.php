<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Http\Controllers\ApiController;
use App\Models\User;
use Auth;
use Exception;
use Log;

class UserController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth:api', ['only' => ['logout']]);
        $this->middleware('guest', ['except' => ['logout']]);
    }

    /**
     * @OA\Post(
     *      path="/login",
     *      operationId="getClient",
     *      tags={"admin"},
     *      summary="login client",
     *      description="iniciar sesion",
     *      security={{"bearerAuth":{}}},
     *      @OA\Parameter(
     *         name="email",
     *         description="correo electronico",
     *         required=true,
     *         in="query",
     *      @OA\Schema(
     *         type="string"
     *         )
     *      ),
     *     @OA\Parameter(
     *         name="password",
     *         description="password",
     *         required=true,
     *         in="query",
     *     @OA\Schema(
     *         type="string"
     *        )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=404,
     *          description="Not found"
     *      )
     *     )
     */

    public function login(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'email' => 'required|string|email',
                'password' => 'required|string|min:6|max:50'
            ]);

            if ($validator->fails()) {
                return $this->apiResponse(null, 'KO', $validator->errors()->toJson(), 400);
            }

            $credentials = request(['email', 'password']);
            if (!Auth::guard()->attempt($credentials)) {
                return $this->apiResponse(null, 'KO', 'Credenciales incorrectas', 401);
            }

            $user = Auth::user();
            $user->generateToken();
            $user->save();
            //dd($user);
            $user->load('roles');
            return $this->apiResponse($user, 'OK', null, 200);

        }catch(Exception $ex){
            Log::error($ex);
            return $this->apiResponse(null, null, 'Error interno', 500);
        }
    }

    /**
     * @OA\Post(
     *      path="/admin/logout",
     *      operationId="getClientLogout",
     *      tags={"admin"},
     *      summary="Logout",
     *      description="Cerrar Sesion",
     *      security={{"bearerAuth":{}}},
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Not Found"
     *      )
     *     )
     */

    public function logout(Request $request){
        try{
            $user = $request->user();
            $user->api_token = null;
            $user->save();
            return $this->apiResponse(null, 'OK', null, 200);
        }catch(Exception $ex){
            Log::error($ex);
            return $this->apiResponse(null, null, 'Error interno', 500);
        }
    }
}
