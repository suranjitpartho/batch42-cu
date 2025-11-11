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
        $socialLinks = [];
        if ($contentPage->slug === 'social-media-links') {
            $socialLinks = json_decode($contentPage->getTranslation('content', 'en'), true) ?? [];
        }

        return view('admin.content-pages.edit', compact('contentPage', 'socialLinks'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ContentPage $contentPage)
    {
        $baseRules = [
            'title_en' => 'required|string',
            'title_bn' => 'required|string',
            'is_published' => 'boolean',
        ];

        if ($contentPage->slug === 'social-media-links') {
            $socialRules = [
                'social_links.facebook_url' => 'nullable|url:http,https',
                'social_links.twitter_url' => 'nullable|url:http,https',
                'social_links.instagram_url' => 'nullable|url:http,https',
                'social_links.linkedin_url' => 'nullable|url:http,https',
                'social_links.youtube_url' => 'nullable|url:http,https',
            ];
            $rules = array_merge($baseRules, $socialRules);
            $validated = $request->validate($rules);

            $contentPage->setTranslation('title', 'en', $validated['title_en']);
            $contentPage->setTranslation('title', 'bn', $validated['title_bn']);
            $contentPage->is_published = $request->has('is_published');

            $socialLinks = $validated['social_links'] ?? [];
            $contentPage->setTranslation('content', 'en', json_encode($socialLinks));
            $contentPage->setTranslation('content', 'bn', null);

            $contentPage->save();

        } else {
            $contentRules = [
                'content_en' => 'nullable|string',
                'content_bn' => 'nullable|string',
            ];
            $rules = array_merge($baseRules, $contentRules);
            $validated = $request->validate($rules);

            $contentPage->setTranslation('title', 'en', $validated['title_en']);
            $contentPage->setTranslation('title', 'bn', $validated['title_bn']);
            $contentPage->setTranslation('content', 'en', $validated['content_en']);
            $contentPage->setTranslation('content', 'bn', $validated['content_bn']);
            $contentPage->is_published = $request->has('is_published');
            $contentPage->save();
        }

        return redirect()->route('admin.content-pages.index')->with('success', 'Content page updated successfully.');
    }


}