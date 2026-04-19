<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title', 'Portfolio CRM') — Kailash</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Space+Grotesk:wght@400;500;700&display=swap" rel="stylesheet">
<style>
  :root {
    --bg: #0a0a0a;
    --bg2: #111111;
    --bg3: #1a1a1a;
    --border: rgba(255,255,255,0.08);
    --purple: #6032F2;
    --purple-light: #8B3DFF;
    --text: #ffffff;
    --text-muted: #888;
    --text-dim: #555;
    --danger: #ef4444;
    --success: #22c55e;
    --warning: #f59e0b;
    --sidebar-w: 240px;
  }
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
  body { background: var(--bg); color: var(--text); font-family: 'Inter', sans-serif; min-height: 100vh; display: flex; }
  a { color: inherit; text-decoration: none; }

  /* Sidebar */
  .sidebar {
    width: var(--sidebar-w); min-height: 100vh; background: var(--bg2);
    border-right: 1px solid var(--border); display: flex; flex-direction: column;
    position: fixed; top: 0; left: 0; z-index: 100; overflow-y: auto;
  }
  .sidebar-logo {
    padding: 24px 20px 20px; border-bottom: 1px solid var(--border);
    display: flex; align-items: center; gap: 10px;
  }
  .logo-mark {
    width: 36px; height: 36px; background: var(--purple); border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-weight: 700; font-size: 14px; letter-spacing: -0.5px;
    font-family: 'Space Grotesk', sans-serif;
  }
  .logo-text { font-family: 'Space Grotesk', sans-serif; font-weight: 600; font-size: 15px; }
  .logo-sub { font-size: 11px; color: var(--text-muted); margin-top: 1px; }
  .nav-section { padding: 16px 12px 8px; font-size: 10px; text-transform: uppercase; letter-spacing: 1.2px; color: var(--text-dim); }
  .nav-item {
    display: flex; align-items: center; gap: 10px; padding: 9px 12px; border-radius: 8px;
    margin: 2px 8px; font-size: 13.5px; color: var(--text-muted); transition: all 0.15s; cursor: pointer;
  }
  .nav-item:hover { background: rgba(255,255,255,0.05); color: var(--text); }
  .nav-item.active { background: rgba(96,50,242,0.15); color: var(--purple-light); }
  .nav-item svg { width: 16px; height: 16px; flex-shrink: 0; opacity: 0.7; }
  .nav-item.active svg { opacity: 1; }
  .sidebar-footer {
    margin-top: auto; padding: 16px; border-top: 1px solid var(--border);
  }
  .logout-btn {
    display: flex; align-items: center; gap: 8px; padding: 9px 12px; border-radius: 8px;
    color: var(--text-muted); font-size: 13px; width: 100%; cursor: pointer;
    transition: all 0.15s; background: none; border: none;
  }
  .logout-btn:hover { background: rgba(239,68,68,0.1); color: var(--danger); }

  /* Main */
  .main { margin-left: var(--sidebar-w); flex: 1; min-height: 100vh; display: flex; flex-direction: column; }
  .topbar {
    padding: 16px 28px; border-bottom: 1px solid var(--border); display: flex;
    align-items: center; justify-content: space-between; background: var(--bg); position: sticky; top: 0; z-index: 50;
  }
  .page-title { font-family: 'Space Grotesk', sans-serif; font-size: 18px; font-weight: 600; }
  .topbar-right { display: flex; align-items: center; gap: 12px; }
  .badge { font-size: 11px; padding: 3px 10px; border-radius: 20px; background: rgba(96,50,242,0.15); color: var(--purple-light); border: 1px solid rgba(96,50,242,0.2); }
  .content { padding: 28px; flex: 1; }

  /* Cards */
  .card { background: var(--bg2); border: 1px solid var(--border); border-radius: 12px; padding: 24px; }
  .card-sm { background: var(--bg2); border: 1px solid var(--border); border-radius: 10px; padding: 16px; }

  /* Grid */
  .grid-3 { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; }
  .grid-2 { display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px; }

  /* Stats */
  .stat-card { background: var(--bg2); border: 1px solid var(--border); border-radius: 12px; padding: 20px; }
  .stat-num { font-family: 'Space Grotesk', sans-serif; font-size: 36px; font-weight: 700; color: var(--purple-light); }
  .stat-label { font-size: 12px; color: var(--text-muted); margin-top: 4px; }

  /* Buttons */
  .btn { display: inline-flex; align-items: center; gap: 6px; padding: 8px 18px; border-radius: 8px; font-size: 13.5px; font-weight: 500; cursor: pointer; border: none; transition: all 0.15s; }
  .btn-primary { background: var(--purple); color: white; }
  .btn-primary:hover { background: var(--purple-light); }
  .btn-ghost { background: transparent; color: var(--text-muted); border: 1px solid var(--border); }
  .btn-ghost:hover { background: var(--bg3); color: var(--text); }
  .btn-danger { background: rgba(239,68,68,0.1); color: var(--danger); border: 1px solid rgba(239,68,68,0.2); }
  .btn-danger:hover { background: rgba(239,68,68,0.2); }
  .btn-sm { padding: 5px 12px; font-size: 12px; }

  /* Forms */
  .form-group { margin-bottom: 18px; }
  .form-label { display: block; font-size: 12px; font-weight: 500; color: var(--text-muted); margin-bottom: 6px; text-transform: uppercase; letter-spacing: 0.5px; }
  .form-control {
    width: 100%; padding: 10px 14px; background: var(--bg3); border: 1px solid var(--border);
    border-radius: 8px; color: var(--text); font-size: 14px; font-family: inherit;
    transition: border-color 0.15s; outline: none;
  }
  .form-control:focus { border-color: rgba(96,50,242,0.5); box-shadow: 0 0 0 3px rgba(96,50,242,0.1); }
  textarea.form-control { resize: vertical; min-height: 100px; }
  .form-hint { font-size: 11px; color: var(--text-dim); margin-top: 5px; }
  .toggle-wrap { display: flex; align-items: center; gap: 10px; }
  input[type=checkbox] { width: 16px; height: 16px; accent-color: var(--purple); cursor: pointer; }

  /* Table */
  .table { width: 100%; border-collapse: collapse; }
  .table th { padding: 10px 14px; text-align: left; font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.8px; color: var(--text-dim); border-bottom: 1px solid var(--border); }
  .table td { padding: 12px 14px; font-size: 13.5px; border-bottom: 1px solid rgba(255,255,255,0.04); vertical-align: middle; }
  .table tr:hover td { background: rgba(255,255,255,0.02); }
  .table tr:last-child td { border-bottom: none; }

  /* Alerts */
  .alert { padding: 12px 16px; border-radius: 8px; font-size: 13.5px; margin-bottom: 20px; }
  .alert-success { background: rgba(34,197,94,0.1); border: 1px solid rgba(34,197,94,0.2); color: var(--success); }
  .alert-error { background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.2); color: var(--danger); }

  /* Color dot */
  .color-dot { width: 20px; height: 20px; border-radius: 50%; display: inline-block; flex-shrink: 0; }
  .img-thumb { width: 48px; height: 36px; object-fit: cover; border-radius: 6px; background: var(--bg3); }

  /* Section header */
  .section-head { display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px; }
  .section-head h2 { font-family: 'Space Grotesk', sans-serif; font-size: 16px; font-weight: 600; }

  /* Tag */
  .tag { display: inline-flex; padding: 2px 10px; border-radius: 20px; font-size: 11px; background: rgba(255,255,255,0.05); color: var(--text-muted); border: 1px solid var(--border); margin: 2px; }

  /* Role block */
  .role-block { background: var(--bg3); border: 1px solid var(--border); border-radius: 8px; padding: 16px; margin-bottom: 12px; position: relative; }
  .role-block .remove-role { position: absolute; top: 10px; right: 10px; background: none; border: none; color: var(--danger); cursor: pointer; font-size: 18px; line-height: 1; }

  /* API info box */
  .api-box { background: var(--bg3); border: 1px solid rgba(96,50,242,0.25); border-radius: 10px; padding: 16px 20px; font-size: 12.5px; }
  .api-box code { background: rgba(96,50,242,0.15); padding: 2px 8px; border-radius: 4px; font-family: monospace; font-size: 12px; color: var(--purple-light); }

  /* Active pill */
  .pill-active { display: inline-flex; padding: 2px 10px; border-radius: 20px; font-size: 11px; font-weight: 500; }
  .pill-active.yes { background: rgba(34,197,94,0.1); color: var(--success); border: 1px solid rgba(34,197,94,0.2); }
  .pill-active.no { background: rgba(239,68,68,0.08); color: var(--text-dim); border: 1px solid var(--border); }

  @media (max-width: 900px) {
    .grid-3 { grid-template-columns: 1fr 1fr; }
    .grid-2 { grid-template-columns: 1fr; }
  }
</style>
@stack('styles')
</head>
<body>

{{-- Sidebar --}}
<aside class="sidebar">
  <div class="sidebar-logo">
    <div class="logo-mark">K</div>
    <div>
      <div class="logo-text">Portfolio CRM</div>
      <div class="logo-sub">Kailash</div>
    </div>
  </div>

  <div class="nav-section">Overview</div>
  <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18"/></svg>
    Dashboard
  </a>

  <div class="nav-section">Content</div>
  <a href="{{ route('admin.hero.edit') }}" class="nav-item {{ request()->routeIs('admin.hero*') ? 'active' : '' }}">
    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3l14 9-14 9V3z"/></svg>
    Hero Section
  </a>
  <a href="{{ route('admin.projects.index') }}" class="nav-item {{ request()->routeIs('admin.projects*') ? 'active' : '' }}">
    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
    Projects
  </a>
  <a href="{{ route('admin.skills.index') }}" class="nav-item {{ request()->routeIs('admin.skills*') ? 'active' : '' }}">
    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
    Skills / Expertise
  </a>
  <a href="{{ route('admin.tools.index') }}" class="nav-item {{ request()->routeIs('admin.tools*') ? 'active' : '' }}">
    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
    Tech Tools
  </a>
  <a href="{{ route('admin.experience.index') }}" class="nav-item {{ request()->routeIs('admin.experience*') ? 'active' : '' }}">
    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
    Experience
  </a>
  <a href="{{ route('admin.about.edit') }}" class="nav-item {{ request()->routeIs('admin.about*') ? 'active' : '' }}">
    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
    About Me
  </a>

  <div class="nav-section">Navigation</div>
  <a href="{{ route('admin.nav.index') }}" class="nav-item {{ request()->routeIs('admin.nav*') ? 'active' : '' }}">
    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16"/></svg>
    Nav Links
  </a>
  <a href="{{ route('admin.marquee.index') }}" class="nav-item {{ request()->routeIs('admin.marquee*') ? 'active' : '' }}">
    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"/></svg>
    Marquee Bar
  </a>

  <div class="sidebar-footer">
    <form method="POST" action="{{ route('admin.logout') }}">
      @csrf
      <button type="submit" class="logout-btn">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width:15px;height:15px"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
        Logout
      </button>
    </form>
  </div>
</aside>

{{-- Main Content --}}
<div class="main">
  <div class="topbar">
    <div class="page-title">@yield('page-title', 'Dashboard')</div>
    <div class="topbar-right">
      <span class="badge">API Live</span>
      <a href="/api/portfolio" target="_blank" style="font-size:12px;color:var(--text-muted)">View API →</a>
    </div>
  </div>

  <div class="content">
    @if(session('success'))
      <div class="alert alert-success">✓ {{ session('success') }}</div>
    @endif
    @if($errors->any())
      <div class="alert alert-error">{{ $errors->first() }}</div>
    @endif

    @yield('content')
  </div>
</div>

@stack('scripts')
</body>
</html>
