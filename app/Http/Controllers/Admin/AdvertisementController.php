<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdvertisementController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:advertisement-view')->only('index');
        $this->middleware('can:advertisement-create')->only(['create', 'store']);
        $this->middleware('can:advertisement-edit')->only(['edit', 'update']);
        $this->middleware('can:advertisement-delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Advertisement::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('title', 'like', '%' . $search . '%')
                  ->orWhere('type', 'like', '%' . $search . '%');
        }

        $advertisements = $query->orderBy('type')->orderBy('order')->paginate(10);
        return view('admin.advertisements.index', compact('advertisements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.advertisements.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->type === 'lightbox' && Advertisement::where('type', 'lightbox')->exists()) {
            return redirect()->back()->withErrors(['type' => 'A lightbox advertisement already exists. You can only have one.'])->withInput();
        }

        if ($request->type === 'footer' && Advertisement::where('type', 'footer')->count() >= 5) {
            return redirect()->back()->withErrors(['type' => 'You cannot have more than 5 footer advertisements.'])->withInput();
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string|in:lightbox,footer',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'link_url' => 'nullable|url',
            'order' => 'required|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $imagePath = $request->file('image')->store('advertisements', 'public');

        Advertisement::create([
            'title' => $validated['title'],
            'type' => $validated['type'],
            'image_path' => $imagePath,
            'link_url' => $validated['link_url'],
            'order' => $validated['order'],
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.advertisements.index')->with('success', 'Advertisement created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Advertisement $advertisement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Advertisement $advertisement)
    {
        return view('admin.advertisements.edit', compact('advertisement'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Advertisement $advertisement)
    {
        if ($request->type === 'lightbox' && Advertisement::where('type', 'lightbox')->where('id', '!=', $advertisement->id)->exists()) {
            return redirect()->back()->withErrors(['type' => 'A lightbox advertisement already exists. You can only have one.'])->withInput();
        }

        if ($request->type === 'footer' && $advertisement->type !== 'footer' && Advertisement::where('type', 'footer')->count() >= 5) {
            return redirect()->back()->withErrors(['type' => 'You cannot have more than 5 footer advertisements.'])->withInput();
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string|in:lightbox,footer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'link_url' => 'nullable|url',
            'order' => 'required|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $data = [
            'title' => $validated['title'],
            'type' => $validated['type'],
            'link_url' => $validated['link_url'],
            'order' => $validated['order'],
            'is_active' => $request->has('is_active'),
        ];

        if ($request->hasFile('image')) {
            // Delete old image
            if ($advertisement->image_path) {
                Storage::disk('public')->delete($advertisement->image_path);
            }
            $data['image_path'] = $request->file('image')->store('advertisements', 'public');
        }

        $advertisement->update($data);

        return redirect()->route('admin.advertisements.index')->with('success', 'Advertisement updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Advertisement $advertisement)
    {
        // Delete the image from storage
        if ($advertisement->image_path) {
            Storage::disk('public')->delete($advertisement->image_path);
        }

        $advertisement->delete();

        return redirect()->route('admin.advertisements.index')->with('success', 'Advertisement deleted successfully.');
    }
}
