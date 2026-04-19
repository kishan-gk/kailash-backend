{{-- resources/views/admin/skills/form.blade.php --}}
@extends('layouts.admin')
@section('page-title', isset($skill->id) ? 'Edit Skill' : 'New Skill')
@section('content')
<div style="max-width:600px">
  <div style="margin-bottom:20px"><a href="{{ route('admin.skills.index') }}" class="btn btn-ghost btn-sm">← Back</a></div>
  <form method="POST" action="{{ isset($skill->id) ? route('admin.skills.update', $skill) : route('admin.skills.store') }}">
    @csrf @if(isset($skill->id)) @method('PUT') @endif
    <div class="card">
      <div class="grid-2">
        <div class="form-group">
          <label class="form-label">Category</label>
          <input type="text" name="category" class="form-control" value="{{ old('category', $skill->category ?? 'EXPERTISE') }}" placeholder="EXPERTISE">
        </div>
        <div class="form-group">
          <label class="form-label">Sort Order</label>
          <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $skill->sort_order ?? 0) }}">
        </div>
      </div>
      <div class="form-group">
        <label class="form-label">Skill Title *</label>
        <input type="text" name="title" class="form-control" value="{{ old('title', $skill->title) }}" required placeholder="UI Design">
      </div>
      <div class="form-group">
        <label class="form-label">Description *</label>
        <textarea name="description" class="form-control" rows="4" required>{{ old('description', $skill->description) }}</textarea>
      </div>
      <div class="form-group">
        <label class="form-label">Tags (comma separated)</label>
        <input type="text" name="tags" class="form-control" value="{{ old('tags', implode(', ', $skill->tags ?? [])) }}" placeholder="Responsive design, High-fidelity screens, Design system">
        <div class="form-hint">Cards pe chhote badges dikhenge</div>
      </div>
      <label class="toggle-wrap">
        <input type="checkbox" name="is_active" {{ old('is_active', $skill->is_active ?? true) ? 'checked' : '' }}>
        <span style="font-size:13.5px">Active</span>
      </label>
    </div>
    <div style="margin-top:20px;display:flex;gap:12px">
      <button type="submit" class="btn btn-primary">{{ isset($skill->id) ? 'Save Changes' : 'Create Skill' }}</button>
      <a href="{{ route('admin.skills.index') }}" class="btn btn-ghost">Cancel</a>
    </div>
  </form>
</div>
@endsection
