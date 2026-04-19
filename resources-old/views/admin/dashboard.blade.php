@extends('layouts.admin')
@section('page-title', 'Dashboard')

@section('content')
<div style="margin-bottom:28px">
  <p style="color:var(--text-muted);font-size:13.5px">Welcome back! Here's what's in your portfolio.</p>
</div>

{{-- Stats --}}
<div class="grid-3" style="margin-bottom:28px">
  <div class="stat-card">
    <div class="stat-num">{{ $stats['projects'] }}</div>
    <div class="stat-label">Total Projects</div>
  </div>
  <div class="stat-card">
    <div class="stat-num">{{ $stats['active_projects'] }}</div>
    <div class="stat-label">Active Projects</div>
  </div>
  <div class="stat-card">
    <div class="stat-num">{{ $stats['companies'] }}</div>
    <div class="stat-label">Companies</div>
  </div>
  <div class="stat-card">
    <div class="stat-num">{{ $stats['skills'] }}</div>
    <div class="stat-label">Skills</div>
  </div>
  <div class="stat-card">
    <div class="stat-num">{{ $stats['tools'] }}</div>
    <div class="stat-label">Tech Tools</div>
  </div>
</div>

{{-- API Reference --}}
<div class="card" style="margin-bottom:24px">
  <h3 style="font-family:'Space Grotesk',sans-serif;font-size:15px;margin-bottom:14px">📡 API Endpoints — React Site Ke Liye</h3>
  <div style="display:grid;gap:8px;font-size:13px">
    @foreach([
      ['GET', '/api/portfolio', 'Sari data ek saath (recommended)'],
      ['GET', '/api/portfolio/hero', 'Hero section'],
      ['GET', '/api/portfolio/projects', 'All projects'],
      ['GET', '/api/portfolio/experience', 'Companies + roles'],
      ['GET', '/api/portfolio/skills', 'Skills / expertise'],
      ['GET', '/api/portfolio/tools', 'Tech tools'],
      ['GET', '/api/portfolio/about', 'About + contact'],
      ['GET', '/api/portfolio/nav', 'Navigation links'],
      ['GET', '/api/portfolio/marquee', 'Marquee bar'],
    ] as $ep)
    <div style="display:flex;align-items:center;gap:10px;padding:8px 12px;background:var(--bg3);border-radius:7px">
      <span style="background:rgba(96,50,242,0.2);color:var(--purple-light);padding:2px 8px;border-radius:4px;font-size:11px;font-weight:600;font-family:monospace">{{ $ep[0] }}</span>
      <code style="font-family:monospace;color:var(--purple-light);font-size:12.5px">{{ $ep[1] }}</code>
      <span style="color:var(--text-muted);font-size:12px;margin-left:auto">{{ $ep[2] }}</span>
      <a href="{{ $ep[1] }}" target="_blank" style="color:var(--text-dim);font-size:11px">Test →</a>
    </div>
    @endforeach
  </div>
</div>

{{-- Quick Actions --}}
<div class="card">
  <h3 style="font-family:'Space Grotesk',sans-serif;font-size:15px;margin-bottom:14px">⚡ Quick Actions</h3>
  <div style="display:flex;flex-wrap:wrap;gap:10px">
    <a href="{{ route('admin.projects.create') }}" class="btn btn-primary">+ New Project</a>
    <a href="{{ route('admin.experience.create') }}" class="btn btn-ghost">+ Add Experience</a>
    <a href="{{ route('admin.skills.create') }}" class="btn btn-ghost">+ Add Skill</a>
    <a href="{{ route('admin.hero.edit') }}" class="btn btn-ghost">Edit Hero</a>
    <a href="{{ route('admin.about.edit') }}" class="btn btn-ghost">Edit About</a>
  </div>
</div>
@endsection
