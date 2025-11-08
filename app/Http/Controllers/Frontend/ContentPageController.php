<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ContentPage;
use Illuminate\Http\Request;

class ContentPageController extends Controller
{
    public function show(ContentPage $contentPage)
    {
        if (!$contentPage->is_published) {
            abort(404); // Or redirect to a different page, or show a "coming soon" message
        }

        return view('frontend.pages.content-pages.show', compact('contentPage'));
    }
}