<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Constitution;
use Illuminate\Http\Request;

class ConstitutionController extends Controller
{
    public function index()
    {
        $chapters = Constitution::where('is_active', true)
            ->orderBy('order')
            ->get();

        return view('frontend.pages.constitution.index', compact('chapters'));
    }
}
