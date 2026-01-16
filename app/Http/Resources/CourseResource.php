<?php

namespace App\Http\Resources;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var Course $course */
        $course = $this;
        return [
            'id'=>$course->id,
            'name'=>$course->title,
            'description'=>$course->description,
            'hours'=>$course->duration,
            'img'=>$course->volume,
            'start_date'=>$course->start_date,
            'end_date'=>$course->end_date,
            'price'=>$course->price
        ];
    }
}
