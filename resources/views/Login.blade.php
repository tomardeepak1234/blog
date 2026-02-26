<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login — Admin Panel</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --bg:      #0a0a0f;
      --surface: #111118;
      --card:    #16161f;
      --border:  rgba(255,255,255,0.07);
      --accent:  #6c63ff;
      --accent2: #ff6584;
      --text:    #f0f0f8;
      --muted:   #6b6b80;
      --error:   #ff6584;
    }

    body {
      min-height: 100vh;
      background: var(--bg);
      font-family: 'DM Sans', sans-serif;
      color: var(--text);
      display: grid;
      grid-template-columns: 1fr 1fr;
    }

    /* ── LEFT PANEL ─────────────────────────── */
    .left-panel {
      background: var(--surface);
      border-right: 1px solid var(--border);
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      padding: 48px 52px;
      position: relative;
      overflow: hidden;
    }

    /* big glow blobs */
    .left-panel::before {
      content: '';
      position: absolute;
      top: -100px; left: -100px;
      width: 350px; height: 350px;
      background: radial-gradient(circle, rgba(108,99,255,0.18) 0%, transparent 70%);
      pointer-events: none;
    }
    .left-panel::after {
      content: '';
      position: absolute;
      bottom: -80px; right: -80px;
      width: 280px; height: 280px;
      background: radial-gradient(circle, rgba(255,101,132,0.12) 0%, transparent 70%);
      pointer-events: none;
    }

    .left-top { position: relative; z-index: 1; }

    .brand-mark {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      margin-bottom: 56px;
    }
    .brand-mark-box {
      width: 38px; height: 38px;
      background: linear-gradient(135deg, var(--accent), var(--accent2));
      border-radius: 10px;
      display: flex; align-items: center; justify-content: center;
      font-family: 'Syne', sans-serif;
      font-weight: 800;
      font-size: 0.9rem;
      box-shadow: 0 4px 20px rgba(108,99,255,0.4);
    }
    .brand-mark-name {
      font-family: 'Syne', sans-serif;
      font-weight: 700;
      font-size: 1rem;
      letter-spacing: 0.02em;
    }

    .left-headline {
      font-family: 'Syne', sans-serif;
      font-size: 2.4rem;
      font-weight: 800;
      line-height: 1.2;
      margin-bottom: 16px;
    }
    .left-headline span {
      background: linear-gradient(90deg, var(--accent), var(--accent2));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }
    .left-desc {
      color: var(--muted);
      font-size: 0.9rem;
      line-height: 1.7;
      max-width: 340px;
    }

    /* feature pills */
    .feature-list {
      display: flex;
      flex-direction: column;
      gap: 14px;
      margin-top: 44px;
      position: relative;
      z-index: 1;
    }
    .feature-item {
      display: flex;
      align-items: center;
      gap: 13px;
      font-size: 0.85rem;
      color: var(--muted);
    }
    .feature-icon {
      width: 34px; height: 34px;
      border-radius: 9px;
      display: flex; align-items: center; justify-content: center;
      font-size: 0.95rem;
      flex-shrink: 0;
    }

    .left-bottom {
      position: relative;
      z-index: 1;
      font-size: 0.72rem;
      color: var(--muted);
      letter-spacing: 0.04em;
    }

    /* ── RIGHT PANEL (FORM) ─────────────────── */
    .right-panel {
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 48px 52px;
      background: var(--bg);
    }

    .form-box {
      width: 100%;
      max-width: 380px;
    }

    .form-eyebrow {
      font-size: 0.7rem;
      text-transform: uppercase;
      letter-spacing: 0.14em;
      color: var(--accent);
      font-weight: 600;
      margin-bottom: 8px;
    }

    .form-title {
      font-family: 'Syne', sans-serif;
      font-size: 1.8rem;
      font-weight: 800;
      margin-bottom: 6px;
    }

    .form-sub {
      color: var(--muted);
      font-size: 0.85rem;
      margin-bottom: 36px;
    }

    /* Alert */
    .alert-box {
      background: rgba(255,101,132,0.08);
      border: 1px solid rgba(255,101,132,0.2);
      border-radius: 10px;
      padding: 12px 14px;
      font-size: 0.82rem;
      color: var(--error);
      margin-bottom: 24px;
      display: flex;
      align-items: flex-start;
      gap: 8px;
    }

    .success-box {
      background: rgba(67,233,123,0.08);
      border: 1px solid rgba(67,233,123,0.2);
      border-radius: 10px;
      padding: 12px 14px;
      font-size: 0.82rem;
      color: #43e97b;
      margin-bottom: 24px;
    }

    /* Field */
    .field { margin-bottom: 20px; }

    .field-label {
      display: block;
      font-size: 0.78rem;
      font-weight: 500;
      letter-spacing: 0.04em;
      color: var(--muted);
      text-transform: uppercase;
      margin-bottom: 8px;
    }

    .input-wrap {
      position: relative;
    }

    .input-icon {
      position: absolute;
      left: 14px; top: 50%;
      transform: translateY(-50%);
      color: var(--muted);
      font-size: 0.9rem;
      pointer-events: none;
      display: flex;
    }

    .field-input {
      width: 100%;
      background: var(--card);
      border: 1px solid var(--border);
      border-radius: 10px;
      padding: 13px 14px 13px 42px;
      font-family: 'DM Sans', sans-serif;
      font-size: 0.88rem;
      color: var(--text);
      outline: none;
      transition: border-color 0.2s, box-shadow 0.2s;
    }
    .field-input::placeholder { color: var(--muted); }
    .field-input:focus {
      border-color: rgba(108,99,255,0.5);
      box-shadow: 0 0 0 3px rgba(108,99,255,0.12);
    }
    .field-input.is-error {
      border-color: rgba(255,101,132,0.5);
      box-shadow: 0 0 0 3px rgba(255,101,132,0.1);
    }

    .field-error {
      font-size: 0.74rem;
      color: var(--error);
      margin-top: 6px;
      display: flex;
      align-items: center;
      gap: 4px;
    }

    /* Toggle password */
    .toggle-pw {
      position: absolute;
      right: 13px; top: 50%;
      transform: translateY(-50%);
      background: none;
      border: none;
      cursor: pointer;
      color: var(--muted);
      display: flex;
      padding: 4px;
      border-radius: 4px;
      transition: color 0.2s;
    }
    .toggle-pw:hover { color: var(--text); }

    /* Remember + Forgot */
    .field-extras {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 24px;
    }

    .checkbox-wrap {
      display: flex;
      align-items: center;
      gap: 8px;
      cursor: pointer;
    }
    .checkbox-wrap input[type="checkbox"] {
      width: 15px; height: 15px;
      accent-color: var(--accent);
      cursor: pointer;
    }
    .checkbox-wrap span {
      font-size: 0.82rem;
      color: var(--muted);
    }

    .forgot-link {
      font-size: 0.82rem;
      color: var(--accent);
      text-decoration: none;
      transition: opacity 0.2s;
    }
    .forgot-link:hover { opacity: 0.75; }

    /* Submit btn */
    .btn-submit {
      width: 100%;
      padding: 14px;
      background: var(--accent);
      color: #fff;
      border: none;
      border-radius: 10px;
      font-family: 'DM Sans', sans-serif;
      font-size: 0.9rem;
      font-weight: 600;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      box-shadow: 0 4px 20px rgba(108,99,255,0.35);
      transition: all 0.2s;
      letter-spacing: 0.02em;
      position: relative;
      overflow: hidden;
    }

    .btn-submit::before {
      content: '';
      position: absolute;
      inset: 0;
      background: linear-gradient(135deg, rgba(255,255,255,0.1), transparent);
      opacity: 0;
      transition: opacity 0.2s;
    }
    .btn-submit:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 28px rgba(108,99,255,0.5);
    }
    .btn-submit:hover::before { opacity: 1; }
    .btn-submit:active { transform: translateY(0); }

    /* Divider */
    .divider {
      display: flex;
      align-items: center;
      gap: 14px;
      margin: 24px 0;
      color: var(--muted);
      font-size: 0.75rem;
    }
    .divider::before, .divider::after {
      content: '';
      flex: 1;
      height: 1px;
      background: var(--border);
    }

    .register-link {
      text-align: center;
      font-size: 0.84rem;
      color: var(--muted);
    }
    .register-link a {
      color: var(--accent);
      text-decoration: none;
      font-weight: 600;
    }
    .register-link a:hover { text-decoration: underline; }

    /* Responsive */
    @media (max-width: 768px) {
      body { grid-template-columns: 1fr; }
      .left-panel { display: none; }
      .right-panel { padding: 36px 24px; }
    }
  </style>
</head>
<body>

  <!-- LEFT PANEL -->
  <div class="left-panel">
    <div class="left-top">
      <div class="brand-mark">
        <div class="brand-mark-box">AP</div>
        <span class="brand-mark-name">Admin Panel</span>
      </div>

      <h2 class="left-headline">
        Manage everything<br>from <span>one place</span>
      </h2>
      <p class="left-desc">
        Your complete control centre for users, orders, and content. Secure, fast, and built for professionals.
      </p>

      <div class="feature-list">
        <div class="feature-item">
          <div class="feature-icon" style="background:rgba(108,99,255,0.12);">🛡️</div>
          <span>Role-based access control</span>
        </div>
        <div class="feature-item">
          <div class="feature-icon" style="background:rgba(67,233,123,0.1);">⚡</div>
          <span>Real-time dashboard overview</span>
        </div>
        <div class="feature-item">
          <div class="feature-icon" style="background:rgba(247,151,30,0.1);">📊</div>
          <span>Analytics & reporting</span>
        </div>
      </div>
    </div>

    <div class="left-bottom">© 2026 Admin Panel · All rights reserved</div>
  </div>

  <!-- RIGHT PANEL (FORM) -->
  <div class="right-panel">
    <div class="form-box">

      <div class="form-eyebrow">Secure Access</div>
      <h1 class="form-title">Sign in</h1>
      <p class="form-sub">Enter your credentials to continue</p>

      {{-- Success --}}
      @if(session('success'))
        <div class="success-box">✅ {{ session('success') }}</div>
      @endif

      {{-- Errors --}}
      @if($errors->any())
        <div class="alert-box">
          <span>⚠️</span>
          <span>{{ $errors->first() }}</span>
        </div>
      @endif

      <form method="POST" action="{{ route('login.check') }}">
        @csrf

        <!-- Email -->
        <div class="field">
          <label class="field-label" for="email">Email Address</label>
          <div class="input-wrap">
            <span class="input-icon">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="2" y="4" width="20" height="16" rx="2"/>
                <path d="m2 7 10 7 10-7"/>
              </svg>
            </span>
            <input
              type="email"
              id="email"
              name="email"
              class="field-input {{ $errors->has('email') ? 'is-error' : '' }}"
              value="{{ old('email') }}"
              placeholder="you@example.com"
              autocomplete="email"
              required>
          </div>
          @error('email')
            <div class="field-error">⚠ {{ $message }}</div>
          @enderror
        </div>

        <!-- Password -->
        <div class="field">
          <label class="field-label" for="password">Password</label>
          <div class="input-wrap">
            <span class="input-icon">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="3" y="11" width="18" height="11" rx="2"/>
                <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
              </svg>
            </span>
            <input
              type="password"
              id="password"
              name="password"
              class="field-input {{ $errors->has('password') ? 'is-error' : '' }}"
              placeholder="••••••••"
              autocomplete="current-password"
              required>
            <button type="button" class="toggle-pw" onclick="togglePassword()" title="Show/hide password">
              <svg id="eye-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                <circle cx="12" cy="12" r="3"/>
              </svg>
            </button>
          </div>
          @error('password')
            <div class="field-error">⚠ {{ $message }}</div>
          @enderror
        </div>

        <!-- Remember + Forgot -->
        <div class="field-extras">
          <label class="checkbox-wrap">
            <input type="checkbox" name="remember">
            <span>Remember me</span>
          </label>
          <a href="" class="forgot-link">Forgot password?</a>
        </div>

        <!-- Submit -->
        <button type="submit" class="btn-submit">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
            <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/>
            <polyline points="10 17 15 12 10 7"/>
            <line x1="15" y1="12" x2="3" y2="12"/>
          </svg>
          Sign In
        </button>

        <div class="divider">or</div>

        <div class="register-link">
          Don't have an account? <a href="{{ url('register') }}">Create one</a>
        </div>

      </form>
    </div>
  </div>

  <script>
    function togglePassword() {
      const input = document.getElementById('password');
      const icon  = document.getElementById('eye-icon');
      if (input.type === 'password') {
        input.type = 'text';
        icon.innerHTML = `
          <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/>
          <path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/>
          <line x1="1" y1="1" x2="23" y2="23"/>`;
      } else {
        input.type = 'password';
        icon.innerHTML = `
          <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
          <circle cx="12" cy="12" r="3"/>`;
      }
    }
  </script>

</body>
</html>