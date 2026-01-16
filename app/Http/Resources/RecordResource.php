<?php

namespace App\Http\Resources;

use App\Models\Record;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RecordResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $res = parent::toArray($request);

        /** @var Record $record */
        $record = $this;
        $res['course']=CourseResource::make($record->course);
        unset($res['user_id']);
        unset($res['course_id']);
        return $res;
    }
}
