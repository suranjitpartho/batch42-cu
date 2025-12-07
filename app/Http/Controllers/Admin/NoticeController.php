<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notice;

class NoticeController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:notice-view')->only('index');
        $this->middleware('can:notice-create')->only(['create', 'store']);
        $this->middleware('can:notice-edit')->only(['edit', 'update']);
        $this->middleware('can:notice-delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $notices = Notice::query()
            ->when($search, function ($query, $search) {
                return $query->where('title', 'like', "%{$search}%")
                             ->orWhere('content', 'like', "%{$search}%");
            })
            ->paginate(10);

        return view('admin.notices.index', compact('notices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.notices.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'members_only' => 'nullable|boolean',
        ]);

        Notice::create([
            'title' => $request->title,
            'content' => $request->content,
            'members_only' => $request->has('members_only'),
        ]);

        return redirect()->route('admin.notices.index')->with('success', 'Notice created successfully.');
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
    public function edit(Notice $notice)
    {
        return view('admin.notices.edit', compact('notice'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Notice $notice)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'members_only' => 'nullable|boolean',
        ]);

        $notice->update([
            'title' => $request->title,
            'content' => $request->content,
            'members_only' => $request->has('members_only'),
        ]);

        return redirect()->route('admin.notices.index')->with('success', 'Notice updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notice $notice)
    {
        $notice->delete();

        return redirect()->route('admin.notices.index')->with('success', 'Notice deleted successfully.');
    }
}
