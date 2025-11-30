<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VideoGallery;
use Illuminate\Http\Request;

class VideoGalleryController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:video_gallery-view')->only('index');
        $this->middleware('can:video_gallery-create')->only(['create', 'store']);
        $this->middleware('can:video_gallery-edit')->only(['edit', 'update']);
        $this->middleware('can:video_gallery-delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $videos = VideoGallery::orderBy('order')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.video_galleries.index', compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.video_galleries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'youtube_url' => 'required|url',
            'order' => 'integer|min:0',
        ]);

        $videoId = $this->extractVideoId($request->youtube_url);

        if (!$videoId) {
            return back()->withErrors(['youtube_url' => 'Invalid YouTube URL. Could not extract video ID.'])->withInput();
        }

        VideoGallery::create([
            'title' => $request->title,
            'youtube_url' => $request->youtube_url,
            'video_id' => $videoId,
            'description' => $request->description,
            'is_active' => $request->has('is_active'),
            'order' => $request->order ?? 0,
        ]);

        return redirect()->route('admin.video-galleries.index')->with('success', 'Video added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VideoGallery $videoGallery)
    {
        return view('admin.video_galleries.edit', compact('videoGallery'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VideoGallery $videoGallery)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'youtube_url' => 'required|url',
            'order' => 'integer|min:0',
        ]);

        $videoId = $this->extractVideoId($request->youtube_url);

        if (!$videoId) {
            return back()->withErrors(['youtube_url' => 'Invalid YouTube URL. Could not extract video ID.'])->withInput();
        }

        $videoGallery->update([
            'title' => $request->title,
            'youtube_url' => $request->youtube_url,
            'video_id' => $videoId,
            'description' => $request->description,
            'is_active' => $request->has('is_active'),
            'order' => $request->order ?? 0,
        ]);

        return redirect()->route('admin.video-galleries.index')->with('success', 'Video updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VideoGallery $videoGallery)
    {
        $videoGallery->delete();
        return redirect()->route('admin.video-galleries.index')->with('success', 'Video deleted successfully.');
    }

    private function extractVideoId($url)
    {
        $pattern = '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i';
        if (preg_match($pattern, $url, $match)) {
            return $match[1];
        }
        return null;
    }
}
