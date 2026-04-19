<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSetting;
use App\Models\AboutSetting;
use App\Models\Skill;
use App\Models\Tool;
use App\Models\NavLink;
use App\Models\MarqueeItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

// ── Hero ─────────────────────────────────────────────────────────────
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
            'badge_text'             => 'required|string|max:255',
            'headline_line1'         => 'required|string|max:255',
            'headline_line2'         => 'required|string|max:255',
            'headline_highlight_word'=> 'required|string|max:100',
            'description'            => 'required|string',
            'cta_button_text'        => 'required|string|max:100',
            'cta_button_url'         => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('logo_image')) {
            $data['logo_image'] = Storage::url($request->file('logo_image')->store('hero', 'public'));
        }

        HeroSetting::first()->update($data);
        return redirect()->back()->with('success', 'Hero section updated!');
    }
}

// ── About ─────────────────────────────────────────────────────────────
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

// ── Skills ─────────────────────────────────────────────────────────────
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
        $data['tags']      = array_filter(array_map('trim', explode(',', $data['tags'] ?? '')));
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
        $data['tags']      = array_filter(array_map('trim', explode(',', $data['tags'] ?? '')));
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

// ── Tools ─────────────────────────────────────────────────────────────
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

// ── Nav Links ─────────────────────────────────────────────────────────
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

// ── Marquee ────────────────────────────────────────────────────────────
class MarqueeController extends Controller
{
    public function index()
    {
        $items = MarqueeItem::orderBy('sort_order')->get();
        return view('admin.marquee.index', compact('items'));
    }

    public function store(Request $request)
    {
        $data = $request->validate(['name' => 'required|string|max:100', 'sort_order' => 'nullable|integer']);
        if ($request->hasFile('logo')) {
            $data['logo'] = Storage::url($request->file('logo')->store('marquee', 'public'));
        }
        $data['is_active'] = $request->has('is_active');
        MarqueeItem::create($data);
        return redirect()->route('admin.marquee.index')->with('success', 'Item added!');
    }

    public function destroy(MarqueeItem $marquee)
    {
        $marquee->delete();
        return redirect()->route('admin.marquee.index')->with('success', 'Item deleted!');
    }
}
