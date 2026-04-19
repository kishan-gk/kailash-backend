@extends('layouts.admin')
@section('page-title', 'About Me')

@section('content')
<div style="max-width:720px">
  <form method="POST" action="{{ route('admin.about.update') }}" enctype="multipart/form-data">
    @csrf
    <div class="card" style="margin-bottom:20px">
      <h3 style="font-size:14px;font-weight:600;margin-bottom:18px;color:var(--text-muted)">ABOUT SECTION</h3>

      <div class="form-group">
        <label class="form-label">Section Heading</label>
        <input type="text" name="heading" class="form-control" value="{{ old('heading', $about->heading) }}">
      </div>
      <div class="form-group">
        <label class="form-label">Bio / Description</label>
        <textarea name="bio" class="form-control" rows="5">{{ old('bio', $about->bio) }}</textarea>
      </div>
      <div class="grid-3">
        <div class="form-group">
          <label class="form-label">Years Experience</label>
          <input type="number" name="years_experience" class="form-control" value="{{ old('years_experience', $about->years_experience) }}" min="0">
        </div>
        <div class="form-group">
          <label class="form-label">Projects Count</label>
          <input type="number" name="projects_count" class="form-control" value="{{ old('projects_count', $about->projects_count) }}" min="0">
        </div>
        <div class="form-group">
          <label class="form-label">Education</label>
          <input type="text" name="education" class="form-control" value="{{ old('education', $about->education) }}" placeholder="BCA">
        </div>
      </div>
    </div>

    <div class="card" style="margin-bottom:20px">
      <h3 style="font-size:14px;font-weight:600;margin-bottom:18px;color:var(--text-muted)">CONTACT INFO</h3>
      <div class="grid-2">
        <div class="form-group">
          <label class="form-label">Email</label>
          <input type="email" name="email" class="form-control" value="{{ old('email', $about->email) }}">
        </div>
        <div class="form-group">
          <label class="form-label">Phone</label>
          <input type="text" name="phone" class="form-control" value="{{ old('phone', $about->phone) }}">
        </div>
      </div>
    </div>

    <div class="card" style="margin-bottom:20px">
      <h3 style="font-size:14px;font-weight:600;margin-bottom:18px;color:var(--text-muted)">SOCIAL LINKS</h3>
      <div class="grid-2">
        <div class="form-group">
          <label class="form-label">LinkedIn URL</label>
          <input type="url" name="linkedin_url" class="form-control" value="{{ old('linkedin_url', $about->linkedin_url) }}" placeholder="https://linkedin.com/in/...">
        </div>
        <div class="form-group">
          <label class="form-label">Instagram URL</label>
          <input type="url" name="instagram_url" class="form-control" value="{{ old('instagram_url', $about->instagram_url) }}" placeholder="https://instagram.com/...">
        </div>
        <div class="form-group">
          <label class="form-label">Behance URL</label>
          <input type="url" name="behance_url" class="form-control" value="{{ old('behance_url', $about->behance_url) }}" placeholder="https://behance.net/...">
        </div>
        <div class="form-group">
          <label class="form-label">GitHub URL</label>
          <input type="url" name="github_url" class="form-control" value="{{ old('github_url', $about->github_url) }}" placeholder="https://github.com/...">
        </div>
        <div class="form-group">
          <label class="form-label">Dribbble URL</label>
          <input type="url" name="dribbble_url" class="form-control" value="{{ old('dribbble_url', $about->dribbble_url) }}" placeholder="https://dribbble.com/...">
        </div>
      </div>
    </div>

    <div class="card" style="margin-bottom:20px">
      <h3 style="font-size:14px;font-weight:600;margin-bottom:18px;color:var(--text-muted)">PROFILE IMAGE</h3>
      @if($about->profile_image)
        <img src="{{ $about->profile_image }}" style="height:80px;border-radius:10px;margin-bottom:12px;display:block">
      @endif
      <input type="file" name="profile_image" class="form-control" accept="image/*">
    </div>

    <button type="submit" class="btn btn-primary">Save About Section</button>
  </form>
</div>
@endsection
