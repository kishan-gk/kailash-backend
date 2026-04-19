<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login — Portfolio CRM</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Space+Grotesk:wght@600;700&display=swap" rel="stylesheet">
<style>
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
  body {
    min-height: 100vh; background: #0a0a0a; color: white;
    font-family: 'Inter', sans-serif; display: flex; align-items: center; justify-content: center;
    background-image: radial-gradient(circle at 30% 40%, rgba(96,50,242,0.12) 0%, transparent 60%),
                      radial-gradient(circle at 80% 80%, rgba(139,61,255,0.08) 0%, transparent 50%);
  }
  .box {
    width: 100%; max-width: 380px; background: #111; border: 1px solid rgba(255,255,255,0.08);
    border-radius: 16px; padding: 40px; text-align: center;
  }
  .logo-mark {
    width: 52px; height: 52px; background: #6032F2; border-radius: 14px;
    display: flex; align-items: center; justify-content: center;
    font-family: 'Space Grotesk', sans-serif; font-size: 20px; font-weight: 700; margin: 0 auto 20px;
  }
  h1 { font-family: 'Space Grotesk', sans-serif; font-size: 22px; font-weight: 700; margin-bottom: 6px; }
  .sub { font-size: 13px; color: #888; margin-bottom: 28px; }
  .field { margin-bottom: 16px; text-align: left; }
  label { display: block; font-size: 11px; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px; color: #666; margin-bottom: 6px; }
  input[type=password] {
    width: 100%; padding: 12px 14px; background: #1a1a1a; border: 1px solid rgba(255,255,255,0.08);
    border-radius: 8px; color: white; font-size: 14px; font-family: inherit; outline: none;
    transition: border-color 0.15s;
  }
  input[type=password]:focus { border-color: rgba(96,50,242,0.5); box-shadow: 0 0 0 3px rgba(96,50,242,0.1); }
  .err { background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.2); color: #ef4444; padding: 10px 14px; border-radius: 8px; font-size: 13px; margin-bottom: 16px; text-align: left; }
  button {
    width: 100%; padding: 12px; background: #6032F2; color: white; border: none; border-radius: 8px;
    font-size: 14px; font-weight: 600; cursor: pointer; font-family: inherit; transition: background 0.15s;
  }
  button:hover { background: #8B3DFF; }
  .hint { font-size: 11px; color: #444; margin-top: 18px; }
</style>
</head>
<body>
<div class="box">
  <div class="logo-mark">K</div>
  <h1>Portfolio CRM</h1>
  <p class="sub">Enter your password to continue</p>

  @if($errors->any())
    <div class="err">{{ $errors->first() }}</div>
  @endif

  <form method="POST" action="{{ route('admin.login.post') }}">
    @csrf
    <div class="field">
      <label>Password</label>
      <input type="password" name="password" placeholder="••••••••" autofocus required>
    </div>
    <button type="submit">Sign In →</button>
  </form>
  <p class="hint">Default: admin123 — Change in .env file</p>
</div>
</body>
</html>
