<?php

namespace App\Http\Resources;

use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LessonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
       /** @var Lesson $lesson */
        $lesson = parent::toArray($request);

        return [
            'id' => $lesson['id'],
            'name' => $lesson['title'],
            'description' => $lesson['content'],
            'video_link' => $lesson['video_link'],
            'hours' => $lesson['duration'],
        ];
    }
}
