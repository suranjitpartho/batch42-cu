<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\UniversityInfo;

class UniversityController extends Controller
{
    public function show()
    {
        $info = UniversityInfo::first();

        if (!$info) {
            abort(404);
        }

        return view('frontend.pages.university.show', compact('info'));
    }

    public function showBatchInfo()
    {
        $info = UniversityInfo::first();

        if (!$info) {
            abort(404);
        }

        return view('frontend.pages.batch.show', compact('info'));
    }
}
