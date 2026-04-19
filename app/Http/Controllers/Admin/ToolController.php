<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tool;
use Illuminate\Http\Request;

class ToolController extends Controller
{
    public function index()
    {
        $tools = Tool::orderBy('sort_order')->get();
        return view('admin.tools.index', compact('tools'));
    }

    public function create()
    {
        return view('admin.tools.form', ['tool' => new Tool()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'          => 'required|string|max:100',
            'icon_url'      => 'nullable|url',
            'icon_bg_color' => 'nullable|string|max:20',
            'orbit_level'   => 'required|in:inner,outer,center',
            'sort_order'    => 'nullable|integer',
        ]);
        $data['is_active'] = $request->has('is_active');
        Tool::create($data);
        return redirect()->route('admin.tools.index')->with('success', 'Tool added!');
    }

    public function edit(Tool $tool)
    {
        return view('admin.tools.form', compact('tool'));
    }

    public function update(Request $request, Tool $tool)
    {
        $data = $request->validate([
            'name'          => 'required|string|max:100',
            'icon_url'      => 'nullable|url',
            'icon_bg_color' => 'nullable|string|max:20',
            'orbit_level'   => 'required|in:inner,outer,center',
            'sort_order'    => 'nullable|integer',
        ]);
        $data['is_active'] = $request->has('is_active');
        $tool->update($data);
        return redirect()->route('admin.tools.index')->with('success', 'Tool updated!');
    }

    public function destroy(Tool $tool)
    {
        $tool->delete();
        return redirect()->route('admin.tools.index')->with('success', 'Tool deleted!');
    }
}
