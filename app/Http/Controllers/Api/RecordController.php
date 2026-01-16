<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RecordResource;
use App\Models\Record;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class RecordController extends Controller
{
    /**
     * Get user orders
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(request $request): AnonymousResourceCollection
    {
        /** @var User $user */
        $user = $request->user();
        return RecordResource::collection($user->records);
    }

    /**
     * Unsubscribe
     * @param Record $record
     * @param Request $request
     * @return JsonResponse
     */
    public function unsubscribe(Record $record,request $request): JsonResponse
    {
        if($record->payment_status=="success"){
            return response()->json([
                "status"=>"was payed"
            ],418);
        }

        if ($record->user_id!==$request->user()->id){
            return response()->json([
                'message'=>'Forbidden for you'
            ],403);
        }

        if(Record::query()->where("id",$record->id)->delete()){
            return response()->json([
                "status"=>"success"
            ]);
        }

        return response()->json([
            'message'=>'Something went wrong'
        ],500);

    }
}
