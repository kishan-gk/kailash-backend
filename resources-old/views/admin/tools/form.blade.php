@extends('layouts.admin')
@section('page-title', isset($tool->id) ? 'Edit Tool' : 'New Tool')
@section('content')
<div style="max-width:600px">
  <div style="margin-bottom:20px"><a href="{{ route('admin.tools.index') }}" class="btn btn-ghost btn-sm">← Back</a></div>
  <form method="POST" action="{{ isset($tool->id) ? route('admin.tools.update', $tool) : route('admin.tools.store') }}">
    @csrf @if(isset($tool->id)) @method('PUT') @endif
    <div class="card">
      <div class="form-group">
        <label class="form-label">Tool Name *</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $tool->name ?? '') }}" required placeholder="Figma, Adobe XD, VS Code...">
      </div>
      <div class="form-group">
        <label class="form-label">Icon URL</label>
        <input type="url" name="icon_url" class="form-control" value="{{ old('icon_url', $tool->icon_url ?? '') }}" placeholder="https://cdn.devicons.../figma.svg">
        <div class="form-hint">DevIcons ya koi bhi icon URL. e.g. https://cdn.jsdelivr.net/gh/devicons/devicon/icons/figma/figma-original.svg</div>
      </div>
      <div class="grid-2">
        <div class="form-group">
          <label class="form-label">Background Color</label>
          <div style="display:flex;gap:10px;align-items:center">
            <input type="color" id="bg_picker" value="{{ old('icon_bg_color', $tool->icon_bg_color ?? '#1E1E1E') }}" style="width:48px;height:40px;background:transparent;border:1px solid var(--border);border-radius:6px;cursor:pointer;padding:2px">
            <input type="text" name="icon_bg_color" id="bg_text" class="form-control" style="flex:1" value="{{ old('icon_bg_color', $tool->icon_bg_color ?? '#1E1E1E') }}">
          </div>
        </div>
        <div class="form-group">
          <label class="form-label">Orbit Level</label>
          <select name="orbit_level" class="form-control">
            @foreach(['center','inner','outer'] as $level)
            <option value="{{ $level }}" {{ old('orbit_level', $tool->orbit_level ?? 'outer') === $level ? 'selected' : '' }}>{{ ucfirst($level) }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="form-group">
        <label class="form-label">Sort Order</label>
        <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $tool->sort_order ?? 0) }}">
      </div>
      <label class="toggle-wrap">
        <input type="checkbox" name="is_active" {{ old('is_active', $tool->is_active ?? true) ? 'checked' : '' }}>
        <span style="font-size:13.5px">Active (show in orbital)</span>
      </label>
    </div>
    <div style="margin-top:20px;display:flex;gap:12px">
      <button type="submit" class="btn btn-primary">{{ isset($tool->id) ? 'Save Changes' : 'Create Tool' }}</button>
      <a href="{{ route('admin.tools.index') }}" class="btn btn-ghost">Cancel</a>
    </div>
  </form>
</div>
@endsection
@push('scripts')
<script>
  const p = document.getElementById('bg_picker'), t = document.getElementById('bg_text');
  p.addEventListener('input', () => t.value = p.value);
  t.addEventListener('input', () => p.value = t.value);
</script>
@endpush
