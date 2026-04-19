@extends('layouts.admin')
@section('page-title', 'Tech Tools')
@section('content')
<div class="section-head">
  <div><h2>Tech Tools / Orbital</h2><p style="font-size:12px;color:var(--text-muted);margin-top:4px">Hero section ke orbital tools</p></div>
  <a href="{{ route('admin.tools.create') }}" class="btn btn-primary">+ Add Tool</a>
</div>
<div class="card" style="padding:0;overflow:hidden">
  <table class="table">
    <thead><tr><th>Icon</th><th>Name</th><th>Orbit</th><th>Active</th><th>Actions</th></tr></thead>
    <tbody>
      @forelse($tools as $t)
      <tr>
        <td>
          @if($t->icon_url)
            <img src="{{ $t->icon_url }}" style="width:32px;height:32px;object-fit:contain;border-radius:6px" onerror="this.style.display='none'">
          @else
            <div style="width:32px;height:32px;border-radius:6px;background:{{ $t->icon_bg_color ?? 'var(--bg3)' }}"></div>
          @endif
        </td>
        <td><strong>{{ $t->name }}</strong></td>
        <td><span class="tag">{{ $t->orbit_level }}</span></td>
        <td><span class="pill-active {{ $t->is_active ? 'yes' : 'no' }}">{{ $t->is_active ? 'Active' : 'Hidden' }}</span></td>
        <td>
          <div style="display:flex;gap:8px">
            <a href="{{ route('admin.tools.edit', $t) }}" class="btn btn-ghost btn-sm">Edit</a>
            <form method="POST" action="{{ route('admin.tools.destroy', $t) }}" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button class="btn btn-danger btn-sm">Del</button></form>
          </div>
        </td>
      </tr>
      @empty
      <tr><td colspan="5" style="text-align:center;padding:40px;color:var(--text-muted)">No tools yet.</td></tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection
