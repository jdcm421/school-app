<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Validator;
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
     *          response=500,
     *          description="Internal Server"
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

    /**
     * @OA\Post(
     *      path="/admin/student/register",
     *      operationId="getStudentRegister",
     *      tags={"student"},
     *      summary="Register Student",
     *      description="Registrar al Estudiante",
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
     *         name="last_name",
     *         description="Apellido",
     *         required=true,
     *         in="query",
     *     @OA\Schema(
     *         type="string"
     *        )
     *      ),
     *      @OA\Parameter(
     *         name="age",
     *         description="Edad",
     *         required=true,
     *         in="query",
     *      @OA\Schema(
     *         type="int"
     *         )
     *      ),
     *      @OA\Parameter(
     *         name="identification_card",
     *         description="carnet de estudiante",
     *         required=true,
     *         in="query",
     *      @OA\Schema(
     *         type="string"
     *         )
     *      ),
     *      @OA\Parameter(
     *          name="email",
     *          description="correo electronico",
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
     *          response=400,
     *          description="Bad Request"
     *      ),
     *     @OA\Response(
     *            response=500,
     *            description="Forbidden"
     *        )
     *      )
     */
    public function register(Request $request){
        try{

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:100',
                'last_name' => 'required|string|max:100',
                'age' => 'required|integer|min:18|max:80',
                'identification_card'=>'required|string|max:11',
                'email' => 'required|email|unique:students',
            ]);

            if($validator->fails()){
                return $this->apiResponse(null,null, $validator->errors()->toJson(), 400);
            }


            $student = new Student([
                'name' => $request->get('name'),
                'last_name' => $request->get('last_name'),
                'age' => $request->get('age'),
                'identification_card' => $request->get('identification_card'),
                'email' => $request->get('email')
            ]);

            $student->save();
            return $this->apiResponse($student, 'OK', 'Solicitud Satisfactoria', 200);
        }catch(Exception $ex){
            Log::error($ex);
            return $this->apiResponse(null, null, 'Error interno', 500);
        }
    }

    /**
     * @OA\Get(
     *      path="/admin/student/{id}",
     *      operationId="getStudentId",
     *      tags={"student"},
     *      summary="obtener",
     *      description="Obtener Estudiante",
     *      @OA\Parameter(
     *          name="id",
     *          description="el id del Estudiante",
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
            $student = Student::with('courses')->find($id);
            if(is_null($student)){
                return $this->apiResponse(null, null, 'Estudiante no encontrado', 400);
            }
            return $this->apiResponse($student, 'OK', 'Solicitud Satisfactoria', 200);
        }catch(Exception $ex){
            Log::error($ex);
            return $this->apiResponse(null, null, 'Error interno', 500);
        }
    }

    /**
     * @OA\Post(
     *      path="/admin/student/updated/{id}",
     *      operationId="getStudentUpdated",
     *      tags={"student"},
     *      summary="updated student",
     *      description="Actualizar al Estudiante",
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
     *         name="last_name",
     *         description="Apellido",
     *         required=true,
     *         in="query",
     *     @OA\Schema(
     *         type="string"
     *        )
     *      ),
     *      @OA\Parameter(
     *         name="age",
     *         description="fecha de fin",
     *         required=true,
     *         in="query",
     *      @OA\Schema(
     *         type="int"
     *         )
     *      ),
     *      @OA\Parameter(
     *         name="identification_card",
     *         description="carnet estudiante",
     *         required=true,
     *         in="query",
     *      @OA\Schema(
     *         type="string"
     *         )
     *      ),
     *      @OA\Parameter(
     *          name="email",
     *          description="correo electronico",
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
            $student = Student::with('courses')->find($id);
            if(is_null($student)){
                return $this->apiResponse(null, null, 'Estudiante no encontrado', 400);
            }
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:100',
                'last_name' => 'required|string|max:100',
                'age' => 'required|integer|min:18|max:80',
                'identification_card'=>'required|string|max:11'
            ]);
            if($validator->fails()){
                return $this->apiResponse(null,null, $validator->errors()->toJson(), 400);
            }



            $student->name = $request->get('name');
            $student->last_name = $request->get('last_name');
            $student->age = $request->get('age');
            $student->identification_card = $request->get('identification_card');
            $student->email = $request->get('email');
            $student->save();

            return $this->apiResponse(null, 'OK', 'Solicitud Satisfactoria', 200);
        }catch(Exception $ex){
            Log::error($ex);
            return $this->apiResponse(null, null, 'Error interno', 500);
        }
    }

    /**
     * @OA\Delete(
     *      path="/admin/student/{id}",
     *      operationId="getStudentDeleteId",
     *      tags={"student"},
     *      summary="Eliminar",
     *      description="Eliminar Estudiante",
     *      @OA\Parameter(
     *          name="id",
     *          description="el id del Estudiante",
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
     *          response=400,
     *          description="No Content"
     *      )
     *     )
     */
    public function delete($id){
        try{
            $student = Student::find($id);
            if(is_null($student)){
                return $this->apiResponse(null, null, 'Estudiante no encontrado', 400);
            }
            $student->delete();

            return $this->apiResponse(null, null, 'Estudiante eliminado', 200);

        }catch(Exception $ex){
            Log::error($ex);
            return $this->apiResponse(null, null, 'Error interno', 500);
        }
    }

}
