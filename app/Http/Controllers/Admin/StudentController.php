<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Record;
use Exception;
use Illuminate\Http\Request;

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
            'records'=>$course==null?Record::all():Record::where('course_id',$course)->get(),
        ]);
    }

}
