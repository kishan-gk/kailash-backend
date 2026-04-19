<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExperienceController extends Controller
{
    public function index()
    {
        $companies = Company::with('roles')->orderBy('sort_order')->get();
        return view('admin.experience.index', compact('companies'));
    }

    public function create()
    {
        return view('admin.experience.form', ['company' => new Company(), 'roles' => []]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'period'     => 'required|string|max:100',
            'roles'      => 'required|array|min:1',
            'roles.*.title'       => 'required|string',
            'roles.*.period'      => 'required|string',
            'roles.*.description' => 'nullable|string',
        ]);

        $data = $request->only(['name', 'period', 'start_date', 'end_date', 'sort_order']);
        if ($request->hasFile('logo')) {
            $data['logo'] = Storage::url($request->file('logo')->store('companies', 'public'));
        }
        $data['is_active'] = $request->has('is_active');

        $company = Company::create($data);

        foreach ($request->roles as $i => $roleData) {
            $desc = array_filter(array_map('trim', explode("\n", $roleData['description'] ?? '')));
            Role::create([
                'company_id'  => $company->id,
                'title'       => $roleData['title'],
                'period'      => $roleData['period'],
                'description' => array_values($desc),
                'sort_order'  => $i + 1,
            ]);
        }

        return redirect()->route('admin.experience.index')->with('success', 'Experience added!');
    }

    public function edit(Company $experience)
    {
        $experience->load('roles');
        return view('admin.experience.form', ['company' => $experience, 'roles' => $experience->roles]);
    }

    public function update(Request $request, Company $experience)
    {
        $data = $request->only(['name', 'period', 'start_date', 'end_date', 'sort_order']);
        if ($request->hasFile('logo')) {
            $data['logo'] = Storage::url($request->file('logo')->store('companies', 'public'));
        }
        $data['is_active'] = $request->has('is_active');
        $experience->update($data);

        // Sync roles
        $experience->roles()->delete();
        foreach ($request->roles as $i => $roleData) {
            $desc = array_filter(array_map('trim', explode("\n", $roleData['description'] ?? '')));
            Role::create([
                'company_id'  => $experience->id,
                'title'       => $roleData['title'],
                'period'      => $roleData['period'],
                'description' => array_values($desc),
                'sort_order'  => $i + 1,
            ]);
        }

        return redirect()->route('admin.experience.index')->with('success', 'Experience updated!');
    }

    public function destroy(Company $experience)
    {
        $experience->roles()->delete();
        $experience->delete();
        return redirect()->route('admin.experience.index')->with('success', 'Experience deleted!');
    }
}
