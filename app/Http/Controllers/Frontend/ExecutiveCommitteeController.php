<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ExecutiveCommittee;
use Illuminate\Http\Request;

class ExecutiveCommitteeController extends Controller
{
    public function index()
    {
        // Fetch all active committees, ordered by year descending
        $committees = ExecutiveCommittee::where('is_active', true)
            ->orderBy('year', 'desc')
            ->paginate(12);

        $latestCommitteeId = $committees->first()?->id;
        
        // If we are on page 2+, we shouldn't mark anything as current if the latest is on page 1
        if ($committees->currentPage() > 1) {
            $latestCommitteeId = null;
        }

        return view('frontend.executive_committees.index', compact('committees', 'latestCommitteeId'));
    }
}
