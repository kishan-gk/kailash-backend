@extends('layouts.admin')
@section('page-title', 'Hero Section')

@section('content')
<div style="max-width:720px">
  <div class="api-box" style="margin-bottom:24px">
    <strong style="font-size:12px">API:</strong> <code>GET /api/portfolio/hero</code> — React site is endpoint se hero data fetch karta hai.
  </div>

  <form method="POST" action="{{ route('admin.hero.update') }}" enctype="multipart/form-data">
    @csrf
    <div class="card">
      <div class="form-group">
        <label class="form-label">Badge Text</label>
        <input type="text" name="badge_text" class="form-control" value="{{ old('badge_text', $hero->badge_text) }}" placeholder="UI/UX Designer • 2+ Years Experience">
        <div class="form-hint">Chhota badge hero ke upar dikhta hai</div>
      </div>

      <div class="form-group">
        <label class="form-label">Headline Line 1</label>
        <input type="text" name="headline_line1" class="form-control" value="{{ old('headline_line1', $hero->headline_line1) }}">
      </div>
      <div class="form-group">
        <label class="form-label">Headline Line 2</label>
        <input type="text" name="headline_line2" class="form-control" value="{{ old('headline_line2', $hero->headline_line2) }}">
      </div>
      <div class="form-group">
        <label class="form-label">Highlighted Word (circle animation)</label>
        <input type="text" name="headline_highlight_word" class="form-control" value="{{ old('headline_highlight_word', $hero->headline_highlight_word) }}" placeholder="Experiences">
        <div class="form-hint">Line 1 ka woh word jo purple oval se wrap hota hai</div>
      </div>

      <div class="form-group">
        <label class="form-label">Description Paragraph</label>
        <textarea name="description" class="form-control" rows="4">{{ old('description', $hero->description) }}</textarea>
      </div>

      <div class="grid-2">
        <div class="form-group">
          <label class="form-label">CTA Button Text</label>
          <input type="text" name="cta_button_text" class="form-control" value="{{ old('cta_button_text', $hero->cta_button_text) }}" placeholder="Let's Connect">
        </div>
        <div class="form-group">
          <label class="form-label">CTA Button URL</label>
          <input type="text" name="cta_button_url" class="form-control" value="{{ old('cta_button_url', $hero->cta_button_url) }}" placeholder="#contact">
        </div>
      </div>

      <div class="form-group">
        <label class="form-label">Logo Image</label>
        @if($hero->logo_image)
          <img src="{{ $hero->logo_image }}" style="height:36px;display:block;margin-bottom:8px">
        @endif
        <input type="file" name="logo_image" class="form-control" accept="image/*">
      </div>
    </div>

    <div style="margin-top:20px">
      <button type="submit" class="btn btn-primary">Save Hero Section</button>
    </div>
  </form>
</div>
@endsection
