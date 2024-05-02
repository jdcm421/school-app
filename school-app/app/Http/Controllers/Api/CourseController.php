<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Models\Course;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Validator;
use Log;
use function PHPUnit\Framework\isEmpty;

class CourseController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

     /**
     * @OA\Get(
     *      path="/admin/course",
     *      operationId="getcourse",
     *      tags={"course"},
     *      summary="listar",
     *      description="Listar cursos",
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
     *          response=500,
     *          description="Internal Server"
     *      )
     *     )
     */
    public function index(){
        try{
            $course = Course::with('studentAndCourse.student')->orderBy('id','asc')->get();
            return $this->apiResponse($course, 'OK', 'Solicitud Satisfactoria', 200);
        }catch(Exception $ex){
            Log::error($ex);
            return $this->apiResponse(null, null, 'Error interno', 500);
        }
    }

    /**
     * @OA\Post(
     *      path="/admin/course/register",
     *      operationId="getCourseRegister",
     *      tags={"course"},
     *      summary="Register course",
     *      description="Registrar al Cursos",
     *     @OA\Parameter(
     *         name="name",
     *         description="Nombre",
     *         required=true,
     *         in="query",
     *     @OA\Schema(
     *         type="string"
     *        )
     *      ),
     *     @OA\Parameter(
     *         name="date_start",
     *         description="fecha de inicio",
     *         required=true,
     *         in="query",
     *     @OA\Schema(
     *         type="string",
     *     format="date"
     *        )
     *      ),
     *      @OA\Parameter(
     *         name="date_end",
     *         description="fecha de fin",
     *         required=true,
     *         in="query",
     *      @OA\Schema(
     *         type="string",
     *     format="date"
     *         )
     *      ),
     *      @OA\Parameter(
     *         name="schedule",
     *         description="horario",
     *         required=true,
     *         in="query",
     *      @OA\Schema(
     *         type="string"
     *         )
     *      ),
     *      @OA\Parameter(
     *          name="type",
     *          description="tipo de modalidad",
     *          required=true,
     *          in="query",
     *       @OA\Schema(
     *          type="string"
     *          )
     *       ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=404,
     *          description="Forbidden"
     *      )
     *     )
     */

    public function register(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:50|regex:/^[a-zA-Z0-9 ]+$/u',
                'date_start' => 'required|date|date_format:Y-m-d',
                'date_end' => 'required|date|date_format:Y-m-d|after:date_start',
                'schedule' => 'required|regex:/^[0-9\: a]+$/u',
                'type'=>'required'
            ]);
            if($validator->fails()){
                return $this->apiResponse(null, 'BAD REQUEST',$validator->errors()->toJson(), 400);
            }

            $course = new Course([
                'name' => $request->name,
                'date_start'=>$request->date_start,
                'date_end'=>$request->date_end,
                'schedule' => $request->schedule,
                'type'=>$request->type
            ]);

            $course->save();

            return $this->apiResponse(null,'CREATED',null, 201);
        }catch(Exception $ex){
            Log::error($ex);
            return $this->apiResponse(null, null, 'Error interno', 500);
        }
    }

    /**
     * @OA\Get(
     *      path="/admin/course/{id}",
     *      operationId="getCourseId",
     *      tags={"course"},
     *      summary="obtener",
     *      description="Obtener cursos",
     *      @OA\Parameter(
     *          name="id",
     *          description="el id del curso",
     *          required=true,
     *          in="path",
     *      @OA\Schema(
     *          type="int"
     *         )
     *       ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=204,
     *          description="No Content"
     *      )
     *     )
     */
    public function find($id){
        try{
            $course = Course::with('studentAndCourse.student')->find($id);
            if(is_null($course)){
                return $this->apiResponse(null, null,'No existe cursos', 400);
            }
            return $this->apiResponse($course, 'Solicitud satifactoria', null, 200);
        }catch(Exception $ex){
            Log::error($ex);
            return $this->apiResponse(null, null, 'Error interno', 500);
        }
    }

    /**
     * @OA\Post(
     *      path="/admin/course/updated",
     *      operationId="getCourseUpdated",
     *      tags={"course"},
     *      summary="Actualizar course",
     *      description="Actualizar al Cursos",
     *     @OA\Parameter(
     *         name="name",
     *         description="Nombre",
     *         required=true,
     *         in="query",
     *     @OA\Schema(
     *         type="string"
     *        )
     *      ),
     *     @OA\Parameter(
     *         name="date_start",
     *         description="fecha de inicio",
     *         required=true,
     *         in="query",
     *     @OA\Schema(
     *         type="string",
     *     format="date"
     *        )
     *      ),
     *      @OA\Parameter(
     *         name="date_end",
     *         description="fecha de fin",
     *         required=true,
     *         in="query",
     *      @OA\Schema(
     *         type="string",
     *     format="date"
     *         )
     *      ),
     *      @OA\Parameter(
     *         name="schedule",
     *         description="horario",
     *         required=true,
     *         in="query",
     *      @OA\Schema(
     *         type="string"
     *         )
     *      ),
     *      @OA\Parameter(
     *          name="type",
     *          description="tipo de modalidad",
     *          required=true,
     *          in="query",
     *       @OA\Schema(
     *          type="string"
     *          )
     *       ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *       @OA\Response(
     *           response=500,
     *           description="Iinternal Serve"
     *       )
     *     )
     */

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
