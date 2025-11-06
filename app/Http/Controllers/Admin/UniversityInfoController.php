<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UniversityInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UniversityInfoController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:university_info-view')->only(['edit']);
        $this->middleware('can:university_info-edit')->only(['updateTextualInfo', 'updateUniversityImages', 'updateBatchImages', 'destroyImage']);
    }

    /**
     * Show the form for editing the university information.
     */
    public function edit()
    {
        $info = UniversityInfo::firstOrCreate([]);
        return view('admin.university-info.edit', compact('info'));
    }

    /**
     * Update the textual information.
     */
    public function updateTextualInfo(Request $request)
    {
        $info = UniversityInfo::firstOrCreate([]);
        $request->validate([
            'university_history' => 'nullable|string',
            'university_mission' => 'nullable|string',
            'university_vision' => 'nullable|string',
            'batch_info' => 'nullable|string',
        ]);
        $info->update($request->only([
            'university_history',
            'university_mission',
            'university_vision',
            'batch_info',
        ]));
        return redirect()->route('admin.university-info.edit')->with('success', 'Textual information updated successfully.');
    }

    /**
     * Update the university images.
     */
    public function updateUniversityImages(Request $request)
    {
        $info = UniversityInfo::firstOrCreate([]);
        $request->validate([
            'university_main_photo_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'university_detail_photo_1_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'university_detail_photo_2_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'university_detail_photo_3_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'university_detail_photo_4_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'university_detail_photo_5_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageFields = [
            'university_main_photo_path',
            'university_detail_photo_1_path',
            'university_detail_photo_2_path',
            'university_detail_photo_3_path',
            'university_detail_photo_4_path',
            'university_detail_photo_5_path',
        ];

        $dataToUpdate = [];
        foreach ($imageFields as $field) {
            if ($request->hasFile($field)) {
                if ($info->{$field}) {
                    Storage::disk('public')->delete($info->{$field});
                }
                $path = $request->file($field)->store('university_info', 'public');
                $dataToUpdate[$field] = $path;
            }
        }

        if (!empty($dataToUpdate)) {
            $info->update($dataToUpdate);
        }

        return redirect()->route('admin.university-info.edit')->with('success', 'University images updated successfully.');
    }

    /**
     * Update the batch images.
     */
    public function updateBatchImages(Request $request)
    {
        $info = UniversityInfo::firstOrCreate([]);
        $request->validate([
            'batch_detail_photo_1_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'batch_detail_photo_2_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'batch_detail_photo_3_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'batch_detail_photo_4_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'batch_detail_photo_5_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageFields = [
            'batch_detail_photo_1_path',
            'batch_detail_photo_2_path',
            'batch_detail_photo_3_path',
            'batch_detail_photo_4_path',
            'batch_detail_photo_5_path',
        ];

        $dataToUpdate = [];
        foreach ($imageFields as $field) {
            if ($request->hasFile($field)) {
                if ($info->{$field}) {
                    Storage::disk('public')->delete($info->{$field});
                }
                $path = $request->file($field)->store('university_info', 'public');
                $dataToUpdate[$field] = $path;
            }
        }

        if (!empty($dataToUpdate)) {
            $info->update($dataToUpdate);
        }

        return redirect()->route('admin.university-info.edit')->with('success', 'Batch images updated successfully.');
    }

    /**
     * Delete an image from university info.
     */
    public function destroyImage(Request $request, $field)
    {
        $info = UniversityInfo::firstOrCreate([]);

        // Validate that the field is a valid image field
        $imageFields = [
            'university_main_photo_path',
            'university_detail_photo_1_path',
            'university_detail_photo_2_path',
            'university_detail_photo_3_path',
            'university_detail_photo_4_path',
            'university_detail_photo_5_path',
            'batch_detail_photo_1_path',
            'batch_detail_photo_2_path',
            'batch_detail_photo_3_path',
            'batch_detail_photo_4_path',
            'batch_detail_photo_5_path',
        ];

        if (!in_array($field, $imageFields)) {
            return response()->json(['success' => false, 'message' => 'Invalid image field specified.'], 422);
        }

        if ($info->{$field}) {
            Storage::disk('public')->delete($info->{$field});
            $info->update([$field => null]);
        }

        return response()->json(['success' => true]);
    }
}
