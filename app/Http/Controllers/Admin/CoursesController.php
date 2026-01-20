<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CoursesController extends Controller
{

    public function index()
    {
        return view('courses.index',[
            'courses' => Course::all()
        ]);
    }

    public function create()
    {
        return view('courses.create');
    }

}
