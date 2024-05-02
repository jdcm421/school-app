<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Models\Course;
use App\Models\Student;
use Exception;
use Illuminate\Support\Facades\Log;

class DashboardController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * @OA\Get(
     *      path="/admin/dashboard",
     *      operationId="getDashboard",
     *      tags={"dashboard"},
     *      summary="listar",
     *      description="Listar Tablero",
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
        try {
            $topCourse = Course::with('studentAndCourse.student')->get();
            $topStudent = Student::with('courses.course')->get();
            $course = Course::with('studentAndCourse.student')->get();
            return $this->apiResponse([
                'topCourse' => $topCourse,
                'topStudent' => $topStudent,
                'course' => $course
            ],'OK',null,200);
        }catch(Exception $ex){
            Log::error($ex);
            return $this->apiResponse(null, null, 'Error interno', 500);
        }
    }
}
