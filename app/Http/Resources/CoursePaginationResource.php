<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CoursePaginationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        self::$wrap = false;
        $response = parent::toArray($request);
        $response['data']=CourseResource::collection($response['data']);
        $response['pagination']=[
            'total'=>$response['last_page'],
            'current'=>$response['current_page'],
            'per_page'=>$response['per_page'],
        ];
        unset($response['per_page']);
        unset($response['total']);
        unset($response['last_page']);
        unset($response['current_page']);
        unset($response['links']);
        unset($response['last_page_url']);
        unset($response['from']);
        unset($response['first_page_url']);
        unset($response['next_page_url']);
        unset($response['path']);
        unset($response['prev_page_url']);
        unset($response['to']);
        return $response;
    }
}
