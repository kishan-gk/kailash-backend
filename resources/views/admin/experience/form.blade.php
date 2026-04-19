@extends('layouts.admin')
@section('page-title', isset($company->id) ? 'Edit Company' : 'New Company')

@section('content')
<div style="max-width:720px">
  <div style="display:flex;align-items:center;gap:12px;margin-bottom:24px">
    <a href="{{ route('admin.experience.index') }}" class="btn btn-ghost btn-sm">← Back</a>
  </div>

  <form method="POST" action="{{ isset($company->id) ? route('admin.experience.update', $company) : route('admin.experience.store') }}" enctype="multipart/form-data">
    @csrf
    @if(isset($company->id)) @method('PUT') @endif

    <div class="card" style="margin-bottom:20px">
      <h3 style="font-size:14px;font-weight:600;margin-bottom:18px;color:var(--text-muted)">COMPANY INFO</h3>
      <div class="grid-2">
        <div class="form-group">
          <label class="form-label">Company Name *</label>
          <input type="text" name="name" class="form-control" value="{{ old('name', $company->name) }}" required>
        </div>
        <div class="form-group">
          <label class="form-label">Period *</label>
          <input type="text" name="period" class="form-control" value="{{ old('period', $company->period) }}" placeholder="May 2025 – Present" required>
        </div>
      </div>
      <div class="grid-2">
        <div class="form-group">
          <label class="form-label">Company Logo</label>
          @if(isset($company->id) && $company->logo)
            <img src="{{ $company->logo }}" style="height:40px;margin-bottom:8px;display:block;object-contain">
          @endif
          <input type="file" name="logo" class="form-control" accept="image/*">
        </div>
        <div class="form-group">
          <label class="form-label">Sort Order</label>
          <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $company->sort_order ?? 0) }}">
        </div>
      </div>
      <label class="toggle-wrap">
        <input type="checkbox" name="is_active" {{ old('is_active', $company->is_active ?? true) ? 'checked' : '' }}>
        <span style="font-size:13.5px">Active (show on site)</span>
      </label>
    </div>

    {{-- Roles --}}
    <div class="card">
      <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px">
        <h3 style="font-size:14px;font-weight:600;color:var(--text-muted)">ROLES / POSITIONS</h3>
        <button type="button" onclick="addRole()" class="btn btn-ghost btn-sm">+ Add Role</button>
      </div>
      <div id="roles-container">
        @php $existingRoles = old('roles', $roles->count() ? $roles->map(fn($r) => ['title'=>$r->title,'period'=>$r->period,'description'=>implode("\n",$r->description??[])]) ->toArray() : [['title'=>'','period'=>'','description'=>'']]) @endphp
        @foreach($existingRoles as $i => $role)
        <div class="role-block" id="role-{{ $i }}">
          <button type="button" class="remove-role" onclick="removeRole('role-{{ $i }}')">×</button>
          <div class="grid-2">
            <div class="form-group" style="margin-bottom:12px">
              <label class="form-label">Job Title *</label>
              <input type="text" name="roles[{{ $i }}][title]" class="form-control" value="{{ $role['title'] ?? '' }}" required>
            </div>
            <div class="form-group" style="margin-bottom:12px">
              <label class="form-label">Period *</label>
              <input type="text" name="roles[{{ $i }}][period]" class="form-control" value="{{ $role['period'] ?? '' }}" placeholder="Jan 2025 – Apr 2025" required>
            </div>
          </div>
          <div class="form-group" style="margin-bottom:0">
            <label class="form-label">Description (ek line = ek bullet point)</label>
            <textarea name="roles[{{ $i }}][description]" class="form-control" rows="4" placeholder="Led design system&#10;Improved UI by 30%&#10;Worked with dev team">{{ $role['description'] ?? '' }}</textarea>
          </div>
        </div>
        @endforeach
      </div>
    </div>

    <div style="display:flex;gap:12px;margin-top:20px">
      <button type="submit" class="btn btn-primary">{{ isset($company->id) ? 'Save Changes' : 'Create Company' }}</button>
      <a href="{{ route('admin.experience.index') }}" class="btn btn-ghost">Cancel</a>
    </div>
  </form>
</div>
@endsection

@push('scripts')
<script>
let roleCount = {{ count($existingRoles) }};
function addRole() {
  const id = 'role-' + roleCount;
  const html = `
    <div class="role-block" id="${id}">
      <button type="button" class="remove-role" onclick="removeRole('${id}')">×</button>
      <div class="grid-2">
        <div class="form-group" style="margin-bottom:12px">
          <label class="form-label">Job Title *</label>
          <input type="text" name="roles[${roleCount}][title]" class="form-control" required>
        </div>
        <div class="form-group" style="margin-bottom:12px">
          <label class="form-label">Period *</label>
          <input type="text" name="roles[${roleCount}][period]" class="form-control" placeholder="Jan 2025 – Apr 2025" required>
        </div>
      </div>
      <div class="form-group" style="margin-bottom:0">
        <label class="form-label">Description (ek line = ek bullet point)</label>
        <textarea name="roles[${roleCount}][description]" class="form-control" rows="4" placeholder="Led design system&#10;Improved UI by 30%&#10;Worked with dev team"></textarea>
      </div>
    </div>`;
  document.getElementById('roles-container').insertAdjacentHTML('beforeend', html);
  roleCount++;
}
function removeRole(id) {
  const el = document.getElementById(id);
  if (el) el.remove();
}
</script>
@endpush
