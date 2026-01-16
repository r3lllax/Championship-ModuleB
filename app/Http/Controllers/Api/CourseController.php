<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CoursePaginationResource;
use App\Http\Resources\CourseResource;
use App\Http\Resources\LessonResource;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    /**
     * Get all courses (with pagination)
     * @param Request $request
     * @return CoursePaginationResource
     */
    public function index(request $request): CoursePaginationResource
    {
        $page = $request->query('page') ? $request->query('page') : 1;
        return CoursePaginationResource::make(DB::table('courses')->paginate(10, ['*'], 'page', $page));
    }

    /**
     * Course`s lessons
     * @param Course $course
     * @return AnonymousResourceCollection
     */
    public function show(Course $course): AnonymousResourceCollection
    {
        return LessonResource::collection($course->lessons);
    }
}
