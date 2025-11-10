<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContentPage;
use Illuminate\Http\Request;

class ContentPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contentPages = ContentPage::latest()->paginate(10);
        return view('admin.content-pages.index', compact('contentPages'));
    }

    /**
     * Display the specified resource.
     */
    public function show(ContentPage $contentPage)
    {
        return view('admin.content-pages.show', compact('contentPage'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ContentPage $contentPage)
    {
        return view('admin.content-pages.edit', compact('contentPage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ContentPage $contentPage)
    {
        $request->validate([
            'title_en' => 'required|string',
            'title_bn' => 'required|string',
            'content_en' => 'required|string',
            'content_bn' => 'required|string',
            'is_published' => 'boolean',
        ]);

        $contentPage->setTranslation('title', 'en', $request->title_en);
        $contentPage->setTranslation('title', 'bn', $request->title_bn);
        $contentPage->setTranslation('content', 'en', $request->content_en);
        $contentPage->setTranslation('content', 'bn', $request->content_bn);
        $contentPage->is_published = $request->has('is_published');
        $contentPage->save();

        return redirect()->route('admin.content-pages.index')->with('success', 'Content page updated successfully.');
    }


}