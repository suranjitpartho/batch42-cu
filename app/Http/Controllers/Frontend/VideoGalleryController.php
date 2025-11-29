<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\VideoGallery;

class VideoGalleryController extends Controller
{
    public function index()
    {
        $videos = VideoGallery::where('is_active', true)
            ->orderBy('order')
            ->orderBy('created_at', 'desc')
            ->paginate(12);
            
        return view('frontend.pages.video_gallery', compact('videos'));
    }
}
