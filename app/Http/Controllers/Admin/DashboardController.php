<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Antibiotic;
use App\Models\AntibioticCategory;
use App\Models\Feedback;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index', [
            'totalUsers' => User::count(),
            'totalAntibiotics' => Antibiotic::count(),
            'totalCategories' => AntibioticCategory::count(),
            'newFeedbacks' => Feedback::where(
                'status',
                'pending'
            )->count(),
        ]);
    }
}
