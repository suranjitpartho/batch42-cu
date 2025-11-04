<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Event;

class EventController extends Controller
{
    public function show(Event $event)
    {
        return view('frontend.pages.events.show', compact('event'));
    }
}
