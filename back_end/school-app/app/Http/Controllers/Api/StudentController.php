<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Exception;
use Log;
use App\Models\Student;

class StudentController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * @OA\Get(
     *      path="/admin/student",
     *      operationId="getStudent",
     *      tags={"student"},
     *      summary="listar",
     *      description="Listar studiantes",
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
    public function index(){
        try{
            $student = Student::with('courses.course')->get();
            return $this->apiResponse($student, 'OK', 'Solicitud Satisfactoria', 200);
        }catch(Exception $ex){
            Log::error($ex);
            return $this->apiResponse(null, null, 'Error interno', 500);
        }
    }


    public function register(Request $request){
        try{

        }catch(Exception $ex){
            Log::error($ex);
            return $this->apiResponse(null, null, 'Error interno', 500);
        }
    }

    public function find($id){
        try{

        }catch(Exception $ex){
            Log::error($ex);
            return $this->apiResponse(null, null, 'Error interno', 500);
        }
    }

    public function updated($id, Request $request){
        try{

        }catch(Exception $ex){
            Log::error($ex);
            return $this->apiResponse(null, null, 'Error interno', 500);
        }
    }

    public function delete($id){
        try{

        }catch(Exception $ex){
            Log::error($ex);
            return $this->apiResponse(null, null, 'Error interno', 500);
        }
    }

}
