<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Company;
use App\Models\Skill;
use App\Models\Tool;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'projects'    => Project::count(),
            'companies'   => Company::count(),
            'skills'      => Skill::count(),
            'tools'       => Tool::count(),
            'active_projects' => Project::where('is_active', true)->count(),
        ];
        return view('admin.dashboard', compact('stats'));
    }
}
