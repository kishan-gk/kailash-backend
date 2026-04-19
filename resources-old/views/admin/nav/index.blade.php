@extends('layouts.admin')
@section('page-title', 'Navigation Links')
@section('content')
<div style="max-width:720px">
  <div class="section-head">
    <div><h2>Nav Links</h2><p style="font-size:12px;color:var(--text-muted);margin-top:4px">Sticky navbar ke links</p></div>
  </div>

  {{-- Add Form --}}
  <div class="card" style="margin-bottom:24px">
    <h3 style="font-size:13px;font-weight:600;color:var(--text-muted);margin-bottom:16px">ADD NEW LINK</h3>
    <form method="POST" action="{{ route('admin.nav.store') }}">
      @csrf
      <div class="grid-3" style="gap:12px;margin-bottom:12px">
        <div>
          <label class="form-label">Label</label>
          <input type="text" name="label" class="form-control" placeholder="Projects" required>
        </div>
        <div>
          <label class="form-label">Section ID</label>
          <input type="text" name="section_id" class="form-control" placeholder="#projects" required>
        </div>
        <div>
          <label class="form-label">Sort Order</label>
          <input type="number" name="sort_order" class="form-control" value="0">
        </div>
      </div>
      <div style="display:flex;align-items:center;gap:16px">
        <label class="toggle-wrap">
          <input type="checkbox" name="is_active" checked>
          <span style="font-size:13px">Active</span>
        </label>
        <button type="submit" class="btn btn-primary btn-sm">+ Add</button>
      </div>
    </form>
  </div>

  {{-- Existing Links --}}
  <div class="card" style="padding:0;overflow:hidden">
    <table class="table">
      <thead><tr><th>Label</th><th>Section ID</th><th>Order</th><th>Active</th><th>Actions</th></tr></thead>
      <tbody>
        @forelse($links as $link)
        <tr>
          <form method="POST" action="{{ route('admin.nav.update', $link) }}">
            @csrf @method('PUT')
            <td><input type="text" name="label" value="{{ $link->label }}" class="form-control" style="padding:6px 10px;font-size:13px"></td>
            <td><input type="text" name="section_id" value="{{ $link->section_id }}" class="form-control" style="padding:6px 10px;font-size:13px;font-family:monospace"></td>
            <td><input type="number" name="sort_order" value="{{ $link->sort_order }}" class="form-control" style="padding:6px 10px;font-size:13px;width:70px"></td>
            <td>
              <select name="is_active" class="form-control" style="padding:6px 10px;font-size:13px;width:90px">
                <option value="1" {{ $link->is_active ? 'selected' : '' }}>Active</option>
                <option value="0" {{ !$link->is_active ? 'selected' : '' }}>Hidden</option>
              </select>
            </td>
            <td>
              <div style="display:flex;gap:6px">
                <button type="submit" class="btn btn-ghost btn-sm">Save</button>
          </form>
                <form method="POST" action="{{ route('admin.nav.destroy', $link) }}" onsubmit="return confirm('Delete?')" style="display:inline">
                  @csrf @method('DELETE')
                  <button class="btn btn-danger btn-sm">Del</button>
                </form>
              </div>
            </td>
        </tr>
        @empty
        <tr><td colspan="5" style="text-align:center;padding:30px;color:var(--text-muted)">No links yet.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
