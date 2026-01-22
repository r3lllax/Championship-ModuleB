<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateLessonRequest;
use App\Http\Requests\EditLessonRequest;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function create(Course $course)
    {
        return view('lessons.create',[
            'course' => $course
        ]);
    }

    /**
     * Create Lesson to course
     *
     * @param CreateLessonRequest $request
     * @param Course $course
     * @return RedirectResponse
     */
    public function store(CreateLessonRequest $request, Course $course): RedirectResponse
    {
        $course->lessons()->create([...$request->validated(),'course_id' => $course->id]);

        return redirect()->route('courses.lessons', $course);
    }

    public function edit(Lesson $lesson)
    {
        return view('lessons.edit',[
            'lesson' => $lesson
        ]);
    }

    /**
     * Edit lesson
     * @param CreateLessonRequest $request
     * @param Lesson $lesson
     * @return RedirectResponse
     */
    public function storeEdit(CreateLessonRequest $request, Lesson $lesson): RedirectResponse
    {
        $lesson->update($request->validated());
        return redirect()->route('courses.lessons', $lesson->course);
    }

    /**
     * Delete course`s lesson
     * @param Lesson $lesson
     * @return RedirectResponse
     */
    public function delete(Lesson $lesson): RedirectResponse
    {
        if ($lesson->course->users->count()==0){
            $lesson->delete();
        }

        return redirect()->to(route('courses.lessons', $lesson->course));
    }
}
