<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCourseRequest;
use App\Http\Requests\EditCourseRequest;
use App\Models\Course;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Nette\Utils\Image;
use Nette\Utils\ImageException;
use Nette\Utils\UnknownImageFileException;

class CoursesController extends Controller
{
    public function show(Course $course)
    {
        return view('courses.edit',[
            'course' => $course,
        ]);
    }

    /**
     * Edit course (without volume)
     * @param EditCourseRequest $request
     * @param Course $course
     * @return RedirectResponse
     */
    public function edit(EditCourseRequest $request, Course $course): RedirectResponse
    {
        $course->fill($request->validated());
        $course->save();
        return redirect()->route('courses');
    }
    public function index()
    {
        $courses = Course::query()->paginate(5);
        return view('courses.index',[
            'courses' => $courses
        ]);
    }

    public function create()
    {
        return view('courses.create');
    }

    /**
     * Create course
     * @throws ImageException
     * @throws UnknownImageFileException
     */
    public function store(CreateCourseRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $image_path = $this->makeAndStoreThumbnail($request->file('volume'));
        $data['volume'] = $image_path;
        Course::query()->create($data);
        return redirect()->route('courses');
    }

    /**
     * Delete course
     * @param Course $course
     * @return RedirectResponse
     */
    public function delete(Course $course): RedirectResponse
    {
        $course->delete();
        if (file_exists(public_path('volumes/' . $course->volume))) {
            unlink(public_path('volumes/' . $course->volume));
        }
        return redirect()->route('courses');
    }

    /**
     * Resize image and save, returns path
     * @param $volume
     * @return string
     * @throws ImageException
     * @throws UnknownImageFileException
     */
    private function makeAndStoreThumbnail($volume): string
    {
        $image = Image::fromFile($volume);
        $image->scale(300,300,7);

        $volume_name='mpic'.uniqid().'.'.$volume->getClientOriginalName();
        $image->save(public_path('volumes/'.$volume_name));
        return $volume_name;
    }

}
