<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Record;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http as HttpAlias;
use League\Uri\Http;

class StudentController extends Controller
{
    public function index(Request $request)
    {

        $course = null;
        try {
            $course = (int)$request->query('course');
        }
        catch (Exception $e) {
        }
        return view('students.index',[
            'records'=>$course==null?Record::query()->paginate(10):Record::where('course_id',$course)->paginate(10),
        ]);
    }

    public function certificate(Course $course, User $student)
    {
        $firstPart = null;
        $response = HttpAlias::withHeaders(['ClientId'=>'SOMEKEY'])->post('http://localhost:8090/create-sertificate',[
            'student_id'=>$student->id,
            'course_id'=>$course->id,
        ]);
        if ($response->successful()) {
            $firstPart = $response->json();
            $timestamps = Carbon::parse($course->end_date)->timestamp;
            $secondPart = str_pad($timestamps % 100000,5,0,STR_PAD_LEFT) . '1';
            $certificate = $firstPart['course_number'] . $secondPart;
            return view('certificate.index',[
                'student'=>$student,
                'course'=>$course,
                'certificate'=>$certificate,
            ]);
        }

    }

}
