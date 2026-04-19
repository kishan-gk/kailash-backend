@extends('layouts.admin')
@section('page-title', 'Projects')

@section('content')
<div class="section-head">
  <div>
    <h2>Projects</h2>
    <p style="font-size:12px;color:var(--text-muted);margin-top:4px">Ye sab projects aapki portfolio site pe show honge</p>
  </div>
  <a href="{{ route('admin.projects.create') }}" class="btn btn-primary">+ Add Project</a>
</div>

<div class="card" style="padding:0;overflow:hidden">
  <table class="table">
    <thead>
      <tr>
        <th>#</th>
        <th>Image</th>
        <th>Title</th>
        <th>Category</th>
        <th>Color</th>
        <th>Active</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @forelse($projects as $p)
      <tr>
        <td style="color:var(--text-dim)">{{ $p->sort_order }}</td>
        <td>
          @if($p->image)
            <img src="{{ $p->image }}" class="img-thumb" alt="{{ $p->title }}">
          @else
            <div class="img-thumb" style="display:flex;align-items:center;justify-content:center;font-size:18px;background:var(--bg3);border-radius:6px">🖼</div>
          @endif
        </td>
        <td><strong>{{ $p->title }}</strong><br><span style="font-size:12px;color:var(--text-muted)">{{ Str::limit($p->description, 50) }}</span></td>
        <td><span class="tag">{{ $p->category }}</span></td>
        <td>
          <div style="display:flex;align-items:center;gap:8px">
            <span class="color-dot" style="background:{{ $p->brand_color }}"></span>
            <span style="font-size:12px;color:var(--text-muted);font-family:monospace">{{ $p->brand_color }}</span>
          </div>
        </td>
        <td><span class="pill-active {{ $p->is_active ? 'yes' : 'no' }}">{{ $p->is_active ? 'Active' : 'Hidden' }}</span></td>
        <td>
          <div style="display:flex;gap:8px">
            <a href="{{ route('admin.projects.edit', $p) }}" class="btn btn-ghost btn-sm">Edit</a>
            <form method="POST" action="{{ route('admin.projects.destroy', $p) }}" onsubmit="return confirm('Delete this project?')">
              @csrf @method('DELETE')
              <button type="submit" class="btn btn-danger btn-sm">Delete</button>
            </form>
          </div>
        </td>
      </tr>
      @empty
      <tr><td colspan="7" style="text-align:center;color:var(--text-muted);padding:40px">No projects yet. <a href="{{ route('admin.projects.create') }}" style="color:var(--purple-light)">Add one →</a></td></tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection
