<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroController extends Controller
{
    public function edit()
    {
        $hero = HeroSetting::firstOrCreate([]);
        return view('admin.hero.edit', compact('hero'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'badge_text'              => 'required|string|max:255',
            'headline_line1'          => 'required|string|max:255',
            'headline_line2'          => 'required|string|max:255',
            'headline_highlight_word' => 'required|string|max:100',
            'description'             => 'required|string',
            'cta_button_text'         => 'required|string|max:100',
            'cta_button_url'          => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('logo_image')) {
            $data['logo_image'] = Storage::url($request->file('logo_image')->store('hero', 'public'));
        }

        HeroSetting::first()->update($data);
        return redirect()->back()->with('success', 'Hero section updated!');
    }
}
