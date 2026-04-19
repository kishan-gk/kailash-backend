@extends('layouts.admin')
@section('page-title', isset($project->id) ? 'Edit Project' : 'New Project')

@section('content')
<div style="max-width:720px">
  <div style="display:flex;align-items:center;gap:12px;margin-bottom:24px">
    <a href="{{ route('admin.projects.index') }}" class="btn btn-ghost btn-sm">← Back</a>
    <h2 style="font-family:'Space Grotesk',sans-serif;font-size:16px">{{ isset($project->id) ? 'Edit: '.$project->title : 'New Project' }}</h2>
  </div>

  <form method="POST" action="{{ isset($project->id) ? route('admin.projects.update', $project) : route('admin.projects.store') }}" enctype="multipart/form-data">
    @csrf
    @if(isset($project->id)) @method('PUT') @endif

    <div class="card">
      <div class="grid-2">
        <div class="form-group">
          <label class="form-label">Project Title *</label>
          <input type="text" name="title" class="form-control" value="{{ old('title', $project->title) }}" required placeholder="e.g. Zinigo">
        </div>
        <div class="form-group">
          <label class="form-label">Category *</label>
          <input type="text" name="category" class="form-control" value="{{ old('category', $project->category) }}" placeholder="SaaS Product, Mobile App, Website...">
        </div>
      </div>

      <div class="form-group">
        <label class="form-label">Short Description *</label>
        <textarea name="description" class="form-control" rows="3" required placeholder="Brief description shown on card">{{ old('description', $project->description) }}</textarea>
      </div>

      <div class="grid-2">
        <div class="form-group">
          <label class="form-label">Brand / Accent Color</label>
          <div style="display:flex;gap:10px;align-items:center">
            <input type="color" name="brand_color" value="{{ old('brand_color', $project->brand_color ?? '#6032F2') }}" style="width:48px;height:40px;background:transparent;border:1px solid var(--border);border-radius:6px;cursor:pointer;padding:2px">
            <input type="text" name="brand_color_text" class="form-control" style="flex:1" value="{{ old('brand_color', $project->brand_color ?? '#6032F2') }}" placeholder="#6032F2" id="color_text">
          </div>
          <div class="form-hint">Used for card hover effects on portfolio</div>
        </div>
        <div class="form-group">
          <label class="form-label">Sort Order</label>
          <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $project->sort_order ?? 0) }}" min="0">
        </div>
      </div>

      <div class="form-group">
        <label class="form-label">Project Image</label>
        @if(isset($project->id) && $project->image)
          <div style="margin-bottom:10px">
            <img src="{{ $project->image }}" style="height:80px;border-radius:8px;object-fit:cover">
          </div>
        @endif
        <div style="display:flex;gap:10px">
          <div style="flex:1">
            <input type="file" name="image" class="form-control" accept="image/*">
            <div class="form-hint">Upload image (JPG/PNG)</div>
          </div>
          <div style="flex:1">
            <input type="text" name="image_url" class="form-control" value="{{ old('image_url') }}" placeholder="Or paste image URL...">
            <div class="form-hint">Or use external URL</div>
          </div>
        </div>
      </div>

      <div class="form-group">
        <label class="form-label">Case Study URL</label>
        <input type="url" name="case_study_url" class="form-control" value="{{ old('case_study_url', $project->case_study_url) }}" placeholder="https://...">
      </div>

      <div class="form-group">
        <label class="form-label">Case Study Content (Full text / HTML)</label>
        <textarea name="case_study_content" class="form-control" rows="6" placeholder="Detailed case study content shown in modal...">{{ old('case_study_content', $project->case_study_content) }}</textarea>
      </div>

      <div style="display:flex;gap:24px;margin-top:8px">
        <label class="toggle-wrap">
          <input type="checkbox" name="is_featured" {{ old('is_featured', $project->is_featured ?? true) ? 'checked' : '' }}>
          <span style="font-size:13.5px">Featured Project</span>
        </label>
        <label class="toggle-wrap">
          <input type="checkbox" name="is_active" {{ old('is_active', $project->is_active ?? true) ? 'checked' : '' }}>
          <span style="font-size:13.5px">Active (visible on site)</span>
        </label>
      </div>
    </div>

    <div style="display:flex;gap:12px;margin-top:20px">
      <button type="submit" class="btn btn-primary">{{ isset($project->id) ? 'Save Changes' : 'Create Project' }}</button>
      <a href="{{ route('admin.projects.index') }}" class="btn btn-ghost">Cancel</a>
    </div>
  </form>
</div>
@endsection

@push('scripts')
<script>
  // Sync color picker with text
  const colorPicker = document.querySelector('input[type=color]');
  const colorText = document.getElementById('color_text');
  colorPicker.addEventListener('input', () => { colorText.value = colorPicker.value; });
  colorText.addEventListener('input', () => { colorPicker.value = colorText.value; });
</script>
@endpush
