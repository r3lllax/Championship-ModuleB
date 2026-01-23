<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CoursePaginationResource;
use App\Http\Resources\CourseResource;
use App\Http\Resources\LessonResource;
use App\Models\Course;
use App\Models\Record;
use App\Models\User;
use Carbon\Carbon;
use Carbon\Traits\Date;
use Illuminate\Http\JsonResponse;
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
     * @return JsonResponse|AnonymousResourceCollection
     */
    public function show(Course $course): JsonResponse|AnonymousResourceCollection
    {
        if(!$course->AccessToUser(request()->user()->id)){
            return response()->json([
                'message'=>'Forbidden for you.'
            ],403);
        };
        return LessonResource::collection($course->lessons);
    }

    /**
     * Creating order
     *
     * @param Course $course
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Course $course,request $request): JsonResponse
    {
        /** @var User $user */
        $user = $request->user();
        $user_courses = $user->records->map(function ($record) {
            return $record->course_id;
        });

        if ($user_courses->contains($course->id)){
            return response()->json([
                'message'=>'You already have a record for this course'
            ],403);
        }
        $record = Record::query()->create([
            'user_id'=>$user->id,
            'course_id'=>$course->id,
            'date'=>Carbon::now(),
            'payment_status'=>'pending',
        ]);

        return response()->json([
            'pay_url'=>'http://localhost:8000/payment-webhook' . "/$record->id"
        ]);
    }
}
