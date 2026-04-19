<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function index()
    {
        $skills = Skill::orderBy('sort_order')->get();
        return view('admin.skills.index', compact('skills'));
    }

    public function create()
    {
        return view('admin.skills.form', ['skill' => new Skill()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'category'    => 'required|string|max:100',
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'tags'        => 'nullable|string',
            'sort_order'  => 'nullable|integer',
        ]);
        $data['tags']      = array_values(array_filter(array_map('trim', explode(',', $data['tags'] ?? ''))));
        $data['is_active'] = $request->has('is_active');
        Skill::create($data);
        return redirect()->route('admin.skills.index')->with('success', 'Skill added!');
    }

    public function edit(Skill $skill)
    {
        return view('admin.skills.form', compact('skill'));
    }

    public function update(Request $request, Skill $skill)
    {
        $data = $request->validate([
            'category'    => 'required|string|max:100',
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'tags'        => 'nullable|string',
            'sort_order'  => 'nullable|integer',
        ]);
        $data['tags']      = array_values(array_filter(array_map('trim', explode(',', $data['tags'] ?? ''))));
        $data['is_active'] = $request->has('is_active');
        $skill->update($data);
        return redirect()->route('admin.skills.index')->with('success', 'Skill updated!');
    }

    public function destroy(Skill $skill)
    {
        $skill->delete();
        return redirect()->route('admin.skills.index')->with('success', 'Skill deleted!');
    }
}
