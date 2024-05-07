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
            $topCourse = Course::whereBetween('created_at',[now()->subMonths(6),now()])->withCount('studentAndCourse')
                ->having('student_and_course_count', '>=', 3)
                ->orderBy('student_and_course_count','desc')
                ->limit(3)
                ->get();
            $topStudent = Student::withCount('courses')
                ->having('courses_count', '>=', 2)
                ->orderBy('courses_count', 'desc')
                ->limit(3)->get();
            $course = Course::all();
            $student = Student::all();
            $oneCourse = Course::withCount('studentAndCourse')->having('student_and_course_count','>=',1)->orderBy('id','desc')->get();
            return $this->apiResponse([
                'topCourse' => $topCourse,
                'topStudent' => $topStudent,
                'student' => $student->count(),
                'course' => $course->count(),
                'oneCourse' => $oneCourse
            ],'OK',null,200);
        }catch(Exception $ex){
            Log::error($ex);
            return $this->apiResponse(null, null, 'Error interno', 500);
        }
    }
}
