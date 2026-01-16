<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RecordResource;
use App\Models\Record;
use App\Models\User;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    public function index(request $request)
    {
        /** @var User $user */
        $user = $request->user();
        return RecordResource::collection($user->records);
    }
}
