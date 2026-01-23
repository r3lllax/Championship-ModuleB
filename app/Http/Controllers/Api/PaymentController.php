<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Record;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Webhook payment
     * @param Request $request
     * @return JsonResponse
     */
    public function webhook(Request $request): JsonResponse
    {
        /** @var Record $record */
        $record = Record::query()->findOrFail($request->get('order_id'));
        if ($record->payment_status == 'pending') {
            $record->update(['payment_status' => $request->get('status')]);
        }
        return response()->json([],204);
    }
}
