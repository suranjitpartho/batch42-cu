<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroBannerController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:hero_banner-view')->only('index');
        $this->middleware('can:hero_banner-create')->only(['create', 'store']);
        $this->middleware('can:hero_banner-edit')->only(['edit', 'update']);
        $this->middleware('can:hero_banner-delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = HeroBanner::query()->orderBy('order', 'asc');

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('title', 'like', '%' . $search . '%');
        }

        $heroBanners = $query->paginate(10);
        $heroBannersCount = HeroBanner::count();

        return view('admin.hero-banners.index', compact('heroBanners', 'heroBannersCount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (HeroBanner::count() >= 5) {
            return redirect()->route('admin.hero-banners.index')->with('error', 'You cannot add more than 5 hero banners.');
        }
        return view('admin.hero-banners.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (HeroBanner::count() >= 5) {
            return redirect()->route('admin.hero-banners.index')->with('error', 'You cannot add more than 5 hero banners.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
            'order' => 'required|integer',
            'is_active' => 'required|boolean',
        ]);

        $imagePath = $request->file('image')->store('hero-banners', 'public');

        HeroBanner::create([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'order' => $request->order,
            'is_active' => $request->is_active,
            'image_path' => $imagePath,
        ]);

        return redirect()->route('admin.hero-banners.index')->with('success', 'Hero banner created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(HeroBanner $heroBanner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HeroBanner $heroBanner)
    {
        return view('admin.hero-banners.edit', compact('heroBanner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HeroBanner $heroBanner)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
            'order' => 'required|integer',
            'is_active' => 'required|boolean',
        ]);

        $imagePath = $heroBanner->image_path;
        if ($request->hasFile('image')) {
            // Delete old image
            if ($imagePath) {
                Storage::disk('public')->delete($imagePath);
            }
            $imagePath = $request->file('image')->store('hero-banners', 'public');
        }

        $heroBanner->update([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'order' => $request->order,
            'is_active' => $request->is_active,
            'image_path' => $imagePath,
        ]);

        return redirect()->route('admin.hero-banners.index')->with('success', 'Hero banner updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HeroBanner $heroBanner)
    {
        // Delete the image from storage
        if ($heroBanner->image_path) {
            Storage::disk('public')->delete($heroBanner->image_path);
        }

        $heroBanner->delete();

        return redirect()->route('admin.hero-banners.index')->with('success', 'Hero banner deleted successfully.');
    }
}
