<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExecutiveCommittee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExecutiveCommitteeController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:executive_committee-view')->only('index');
        $this->middleware('can:executive_committee-create')->only(['create', 'store']);
        $this->middleware('can:executive_committee-edit')->only(['edit', 'update']);
        $this->middleware('can:executive_committee-delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $committees = ExecutiveCommittee::orderByRaw('year DESC')->paginate(10);
        return view('admin.executive_committees.index', compact('committees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $availableYears = $this->getAvailableYears();
        return view('admin.executive_committees.create', compact('availableYears'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'year' => 'required|string|unique:executive_committees,year',
            'document' => 'required|file|mimes:pdf|max:10240',
        ]);

        $path = $request->file('document')->store('executive_committees', 'public');

        ExecutiveCommittee::create([
            'year' => $request->year,
            'document_path' => $path,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.executive-committees.index')->with('success', 'Executive Committee document uploaded successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ExecutiveCommittee $executiveCommittee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ExecutiveCommittee $executiveCommittee)
    {
        $availableYears = $this->getAvailableYears($executiveCommittee->year);
        return view('admin.executive_committees.edit', compact('executiveCommittee', 'availableYears'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ExecutiveCommittee $executiveCommittee)
    {
        $request->validate([
            'year' => 'required|string|unique:executive_committees,year,' . $executiveCommittee->id,
            'document' => 'nullable|file|mimes:pdf|max:10240',
        ]);

        $data = [
            'year' => $request->year,
            'is_active' => $request->has('is_active'),
        ];

        if ($request->hasFile('document')) {
            // Delete old document
            Storage::disk('public')->delete($executiveCommittee->document_path);
            
            // Store new document
            $data['document_path'] = $request->file('document')->store('executive_committees', 'public');
        }

        $executiveCommittee->update($data);

        return redirect()->route('admin.executive-committees.index')->with('success', 'Executive Committee updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ExecutiveCommittee $executiveCommittee)
    {
        Storage::disk('public')->delete($executiveCommittee->document_path);
        $executiveCommittee->delete();

        return redirect()->route('admin.executive-committees.index')->with('success', 'Executive Committee deleted successfully.');
    }

    /**
     * Get available years for dropdown
     */
    private function getAvailableYears($currentYear = null)
    {
        $years = [];
        $startYear = 2024;
        $endYear = date('Y') + 5;

        for ($i = $startYear; $i < $endYear; $i++) {
            $yearRange = $i . '-' . ($i + 1);
            $years[] = $yearRange;
        }

        return $years;
    }
}
