@extends('layouts.admin')
@section('page-title', 'Experience')

@section('content')
<div class="section-head">
  <div>
    <h2>Professional Journey</h2>
    <p style="font-size:12px;color:var(--text-muted);margin-top:4px">Companies aur roles manage karo</p>
  </div>
  <a href="{{ route('admin.experience.create') }}" class="btn btn-primary">+ Add Company</a>
</div>

@foreach($companies as $company)
<div class="card" style="margin-bottom:16px">
  <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:12px">
    <div style="display:flex;align-items:center;gap:12px">
      @if($company->logo)
        <img src="{{ $company->logo }}" style="width:40px;height:40px;object-fit:contain;border-radius:8px;background:var(--bg3);padding:4px">
      @else
        <div style="width:40px;height:40px;background:var(--bg3);border-radius:8px;display:flex;align-items:center;justify-content:center;font-weight:700;font-family:'Space Grotesk',sans-serif">{{ substr($company->name,0,1) }}</div>
      @endif
      <div>
        <div style="font-weight:600;font-family:'Space Grotesk',sans-serif">{{ $company->name }}</div>
        <div style="font-size:12px;color:var(--text-muted)">{{ $company->period }}</div>
      </div>
    </div>
    <div style="display:flex;gap:8px">
      <a href="{{ route('admin.experience.edit', $company) }}" class="btn btn-ghost btn-sm">Edit</a>
      <form method="POST" action="{{ route('admin.experience.destroy', $company) }}" onsubmit="return confirm('Delete?')">
        @csrf @method('DELETE')
        <button class="btn btn-danger btn-sm">Delete</button>
      </form>
    </div>
  </div>
  <div style="padding-left:52px">
    @foreach($company->roles as $role)
    <div style="padding:8px 0;border-top:1px solid var(--border)">
      <div style="font-size:13.5px;font-weight:500">{{ $role->title }}</div>
      <div style="font-size:11.5px;color:var(--text-muted);margin-top:2px">{{ $role->period }}</div>
    </div>
    @endforeach
  </div>
</div>
@endforeach

@if($companies->isEmpty())
<div class="card" style="text-align:center;padding:50px;color:var(--text-muted)">
  No experience added yet. <a href="{{ route('admin.experience.create') }}" style="color:var(--purple-light)">Add first company →</a>
</div>
@endif
@endsection
