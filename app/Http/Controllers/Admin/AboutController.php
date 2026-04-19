<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    public function edit()
    {
        $about = AboutSetting::firstOrCreate([]);
        return view('admin.about.edit', compact('about'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'heading'          => 'required|string|max:255',
            'bio'              => 'required|string',
            'years_experience' => 'required|integer|min:0',
            'projects_count'   => 'required|integer|min:0',
            'education'        => 'required|string|max:100',
            'email'            => 'nullable|email',
            'phone'            => 'nullable|string|max:50',
            'linkedin_url'     => 'nullable|url',
            'instagram_url'    => 'nullable|url',
            'behance_url'      => 'nullable|url',
            'github_url'       => 'nullable|url',
            'dribbble_url'     => 'nullable|url',
        ]);

        if ($request->hasFile('profile_image')) {
            $data['profile_image'] = Storage::url($request->file('profile_image')->store('about', 'public'));
        }

        AboutSetting::first()->update($data);
        return redirect()->back()->with('success', 'About section updated!');
    }
}
