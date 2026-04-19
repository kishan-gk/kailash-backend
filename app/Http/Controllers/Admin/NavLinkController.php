<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NavLink;
use Illuminate\Http\Request;

class NavLinkController extends Controller
{
    public function index()
    {
        $links = NavLink::orderBy('sort_order')->get();
        return view('admin.nav.index', compact('links'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'label'      => 'required|string|max:100',
            'section_id' => 'required|string|max:100',
            'sort_order' => 'nullable|integer',
        ]);
        $data['is_active'] = $request->has('is_active');
        NavLink::create($data);
        return redirect()->route('admin.nav.index')->with('success', 'Nav link added!');
    }

    public function update(Request $request, NavLink $nav)
    {
        $data = $request->validate([
            'label'      => 'required|string|max:100',
            'section_id' => 'required|string|max:100',
            'sort_order' => 'nullable|integer',
        ]);
        $data['is_active'] = $request->has('is_active');
        $nav->update($data);
        return redirect()->route('admin.nav.index')->with('success', 'Nav link updated!');
    }

    public function destroy(NavLink $nav)
    {
        $nav->delete();
        return redirect()->route('admin.nav.index')->with('success', 'Nav link deleted!');
    }
}
