@extends('layouts.admin')
@section('page-title', 'Skills / Expertise')

@section('content')
<div class="section-head">
  <h2>Skills & Expertise</h2>
  <a href="{{ route('admin.skills.create') }}" class="btn btn-primary">+ Add Skill</a>
</div>

<div class="card" style="padding:0;overflow:hidden">
  <table class="table">
    <thead>
      <tr><th>Category</th><th>Title</th><th>Tags</th><th>Active</th><th>Actions</th></tr>
    </thead>
    <tbody>
      @forelse($skills as $s)
      <tr>
        <td><span class="tag">{{ $s->category }}</span></td>
        <td><strong>{{ $s->title }}</strong><br><span style="font-size:12px;color:var(--text-muted)">{{ Str::limit($s->description, 60) }}</span></td>
        <td>@foreach($s->tags??[] as $t)<span class="tag">{{ $t }}</span>@endforeach</td>
        <td><span class="pill-active {{ $s->is_active ? 'yes' : 'no' }}">{{ $s->is_active ? 'Active' : 'Hidden' }}</span></td>
        <td>
          <div style="display:flex;gap:8px">
            <a href="{{ route('admin.skills.edit', $s) }}" class="btn btn-ghost btn-sm">Edit</a>
            <form method="POST" action="{{ route('admin.skills.destroy', $s) }}" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button class="btn btn-danger btn-sm">Del</button></form>
          </div>
        </td>
      </tr>
      @empty
      <tr><td colspan="5" style="text-align:center;padding:40px;color:var(--text-muted)">No skills yet.</td></tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection
