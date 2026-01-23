<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Record;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class WebhookController extends Controller
{
    /**
     * @param Record $record
     * @return View
     */
    public function index(Record $record): View
    {
        return view('webhook.index',$record);
    }
}
