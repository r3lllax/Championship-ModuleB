<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CoursePaginationResource;
use App\Http\Resources\CourseResource;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    public function index(request $request)
    {
        $page = $request->query('page') ? $request->query('page') : 1;
        return CoursePaginationResource::make(DB::table('courses')->paginate(10, ['*'], 'page', $page));
    }
}
