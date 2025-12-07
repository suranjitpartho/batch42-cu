<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Constitution;
use Illuminate\Http\Request;

class ConstitutionController extends Controller
{

    public function index()
    {
        $constitutions = Constitution::orderBy('order')->paginate(10);
        return view('admin.constitutions.index', compact('constitutions'));
    }

    public function create()
    {
        return view('admin.constitutions.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'chapter_number' => 'required|string|max:255',
            'chapter_name_en' => 'nullable|string|max:255',
            'chapter_name_bn' => 'nullable|string|max:255',
            'content_en' => 'nullable|string',
            'content_bn' => 'nullable|string',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $constitution = new Constitution();
        $constitution->chapter_number = $validated['chapter_number'];
        $constitution->setTranslation('chapter_name', 'en', $validated['chapter_name_en']);
        $constitution->setTranslation('chapter_name', 'bn', $validated['chapter_name_bn']);
        $constitution->setTranslation('content', 'en', $validated['content_en']);
        $constitution->setTranslation('content', 'bn', $validated['content_bn']);
        $constitution->order = $validated['order'] ?? 0;
        $constitution->is_active = $request->has('is_active');
        $constitution->save();

        return redirect()->route('admin.constitutions.index')->with('success', 'Constitution chapter created successfully.');
    }

    public function edit(Constitution $constitution)
    {
        return view('admin.constitutions.edit', compact('constitution'));
    }

    public function update(Request $request, Constitution $constitution)
    {
        $validated = $request->validate([
            'chapter_number' => 'required|string|max:255',
            'chapter_name_en' => 'nullable|string|max:255',
            'chapter_name_bn' => 'nullable|string|max:255',
            'content_en' => 'nullable|string',
            'content_bn' => 'nullable|string',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $constitution->chapter_number = $validated['chapter_number'];
        $constitution->setTranslation('chapter_name', 'en', $validated['chapter_name_en']);
        $constitution->setTranslation('chapter_name', 'bn', $validated['chapter_name_bn']);
        $constitution->setTranslation('content', 'en', $validated['content_en']);
        $constitution->setTranslation('content', 'bn', $validated['content_bn']);
        $constitution->order = $validated['order'] ?? 0;
        $constitution->is_active = $request->has('is_active');
        $constitution->save();

        return redirect()->route('admin.constitutions.index')->with('success', 'Constitution chapter updated successfully.');
    }

    public function destroy(Constitution $constitution)
    {
        $constitution->delete();
        return redirect()->route('admin.constitutions.index')->with('success', 'Constitution chapter deleted successfully.');
    }
}
