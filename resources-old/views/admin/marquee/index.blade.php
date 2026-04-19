@extends('layouts.admin')
@section('page-title', 'Marquee Bar')
@section('content')
<div style="max-width:720px">
  <div class="section-head">
    <div><h2>Marquee / Brand Bar</h2><p style="font-size:12px;color:var(--text-muted);margin-top:4px">Scrolling brand names jo hero ke neeche dikhte hain</p></div>
  </div>

  {{-- Add Form --}}
  <div class="card" style="margin-bottom:24px">
    <h3 style="font-size:13px;font-weight:600;color:var(--text-muted);margin-bottom:16px">ADD ITEM</h3>
    <form method="POST" action="{{ route('admin.marquee.store') }}" enctype="multipart/form-data">
      @csrf
      <div class="grid-3" style="gap:12px;margin-bottom:12px">
        <div>
          <label class="form-label">Name *</label>
          <input type="text" name="name" class="form-control" placeholder="Techworld" required>
        </div>
        <div>
          <label class="form-label">Logo (optional)</label>
          <input type="file" name="logo" class="form-control" accept="image/*">
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

  {{-- List --}}
  <div class="card" style="padding:0;overflow:hidden">
    <table class="table">
      <thead><tr><th>Logo</th><th>Name</th><th>Order</th><th>Actions</th></tr></thead>
      <tbody>
        @forelse($items as $item)
        <tr>
          <td>
            @if($item->logo)
              <img src="{{ $item->logo }}" style="height:28px;object-contain">
            @else
              <span style="color:var(--text-dim);font-size:12px">—</span>
            @endif
          </td>
          <td><strong>{{ $item->name }}</strong></td>
          <td style="color:var(--text-muted)">{{ $item->sort_order }}</td>
          <td>
            <form method="POST" action="{{ route('admin.marquee.destroy', $item) }}" onsubmit="return confirm('Delete?')">
              @csrf @method('DELETE')
              <button class="btn btn-danger btn-sm">Delete</button>
            </form>
          </td>
        </tr>
        @empty
        <tr><td colspan="4" style="text-align:center;padding:30px;color:var(--text-muted)">No items yet.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
