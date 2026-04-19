<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MarqueeItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MarqueeController extends Controller
{
    public function index()
    {
        $items = MarqueeItem::orderBy('sort_order')->get();
        return view('admin.marquee.index', compact('items'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'       => 'required|string|max:100',
            'sort_order' => 'nullable|integer',
        ]);
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
