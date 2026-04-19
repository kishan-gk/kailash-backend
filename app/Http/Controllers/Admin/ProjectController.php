<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::orderBy('sort_order')->get();
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.form', ['project' => new Project()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'              => 'required|string|max:255',
            'description'        => 'required|string',
            'category'           => 'required|string|max:100',
            'brand_color'        => 'nullable|string|max:20',
            'case_study_url'     => 'nullable|url|max:500',
            'case_study_content' => 'nullable|string',
            'sort_order'         => 'nullable|integer',
            'is_featured'        => 'nullable|boolean',
            'is_active'          => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('projects', 'public');
            $data['image'] = Storage::url($data['image']);
        } elseif ($request->image_url) {
            $data['image'] = $request->image_url;
        }

        $data['is_featured'] = $request->has('is_featured');
        $data['is_active']   = $request->has('is_active');

        Project::create($data);
        return redirect()->route('admin.projects.index')->with('success', 'Project created!');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.form', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $data = $request->validate([
            'title'              => 'required|string|max:255',
            'description'        => 'required|string',
            'category'           => 'required|string|max:100',
            'brand_color'        => 'nullable|string|max:20',
            'case_study_url'     => 'nullable|url|max:500',
            'case_study_content' => 'nullable|string',
            'sort_order'         => 'nullable|integer',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = Storage::url($request->file('image')->store('projects', 'public'));
        } elseif ($request->image_url) {
            $data['image'] = $request->image_url;
        }

        $data['is_featured'] = $request->has('is_featured');
        $data['is_active']   = $request->has('is_active');

        $project->update($data);
        return redirect()->route('admin.projects.index')->with('success', 'Project updated!');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.projects.index')->with('success', 'Project deleted!');
    }

    public function reorder(Request $request)
    {
        foreach ($request->order as $item) {
            Project::where('id', $item['id'])->update(['sort_order' => $item['order']]);
        }
        return response()->json(['success' => true]);
    }
}
