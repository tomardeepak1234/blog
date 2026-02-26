<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register — Blog Management</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=DM+Sans:ital,wght@0,300;0,400;0,500;1,400&display=swap" rel="stylesheet">
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --bg:      #0a0a0f;
      --surface: #111118;
      --card:    #16161f;
      --border:  rgba(255,255,255,0.07);
      --accent:  #6c63ff;
      --accent2: #ff6584;
      --accent3: #43e97b;
      --accent4: #f7971e;
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
      grid-template-columns: 420px 1fr;
    }

    /* ══════════════════════════════════════
       LEFT PANEL
    ══════════════════════════════════════ */
    .left-panel {
      background: var(--surface);
      border-right: 1px solid var(--border);
      display: flex;
      flex-direction: column;
      padding: 44px 40px;
      position: sticky;
      top: 0;
      height: 100vh;
      overflow: hidden;
    }

    .left-panel::before {
      content: '';
      position: absolute;
      top: -120px; left: -120px;
      width: 380px; height: 380px;
      background: radial-gradient(circle, rgba(108,99,255,0.15) 0%, transparent 65%);
      pointer-events: none;
    }
    .left-panel::after {
      content: '';
      position: absolute;
      bottom: -100px; right: -80px;
      width: 300px; height: 300px;
      background: radial-gradient(circle, rgba(255,101,132,0.1) 0%, transparent 65%);
      pointer-events: none;
    }

    .brand {
      display: flex;
      align-items: center;
      gap: 10px;
      position: relative;
      z-index: 1;
      margin-bottom: 52px;
    }
    .brand-box {
      width: 38px; height: 38px;
      background: linear-gradient(135deg, var(--accent), var(--accent2));
      border-radius: 10px;
      display: flex; align-items: center; justify-content: center;
      font-family: 'Syne', sans-serif;
      font-weight: 800;
      font-size: 0.88rem;
      box-shadow: 0 4px 20px rgba(108,99,255,0.4);
    }
    .brand-name {
      font-family: 'Syne', sans-serif;
      font-weight: 700;
      font-size: 1rem;
    }

    .left-copy {
      position: relative;
      z-index: 1;
      flex: 1;
    }
    .left-tag {
      font-size: 0.68rem;
      text-transform: uppercase;
      letter-spacing: 0.15em;
      color: var(--accent);
      font-weight: 600;
      margin-bottom: 14px;
    }
    .left-h {
      font-family: 'Syne', sans-serif;
      font-size: 2rem;
      font-weight: 800;
      line-height: 1.2;
      margin-bottom: 16px;
    }
    .left-h span {
      background: linear-gradient(90deg, var(--accent), var(--accent2));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }
    .left-p {
      color: var(--muted);
      font-size: 0.87rem;
      line-height: 1.75;
      margin-bottom: 40px;
    }

    /* Role cards */
    .role-cards { display: flex; flex-direction: column; gap: 10px; }
    .role-card {
      display: flex;
      align-items: center;
      gap: 12px;
      background: var(--card);
      border: 1px solid var(--border);
      border-radius: 12px;
      padding: 13px 15px;
      transition: border-color 0.2s;
    }
    .role-card:hover { border-color: rgba(255,255,255,0.13); }
    .role-card-icon {
      width: 36px; height: 36px;
      border-radius: 9px;
      display: flex; align-items: center; justify-content: center;
      font-size: 1rem;
      flex-shrink: 0;
    }
    .role-card-text strong {
      display: block;
      font-size: 0.83rem;
      font-weight: 600;
      margin-bottom: 1px;
    }
    .role-card-text span {
      font-size: 0.73rem;
      color: var(--muted);
    }

    .left-foot {
      position: relative;
      z-index: 1;
      font-size: 0.71rem;
      color: var(--muted);
    }

    /* ══════════════════════════════════════
       RIGHT PANEL — FORM
    ══════════════════════════════════════ */
    .right-panel {
      background: var(--bg);
      padding: 52px 60px;
      overflow-y: auto;
    }

    /* Step indicator */
    .steps-bar {
      display: flex;
      align-items: center;
      gap: 0;
      margin-bottom: 40px;
    }
    .step-item {
      display: flex;
      align-items: center;
      gap: 8px;
      font-size: 0.75rem;
      font-weight: 500;
      color: var(--muted);
      cursor: default;
    }
    .step-num {
      width: 26px; height: 26px;
      border-radius: 50%;
      border: 1.5px solid var(--border);
      display: flex; align-items: center; justify-content: center;
      font-size: 0.72rem;
      font-weight: 700;
      transition: all 0.2s;
    }
    .step-item.done .step-num {
      background: var(--accent3);
      border-color: var(--accent3);
      color: #0a0a0f;
    }
    .step-item.active .step-num {
      background: var(--accent);
      border-color: var(--accent);
      color: #fff;
      box-shadow: 0 0 12px rgba(108,99,255,0.5);
    }
    .step-item.active { color: var(--text); }
    .step-line {
      flex: 1;
      height: 1px;
      background: var(--border);
      margin: 0 12px;
    }

    /* Form header */
    .form-eyebrow {
      font-size: 0.7rem;
      text-transform: uppercase;
      letter-spacing: 0.14em;
      color: var(--accent);
      font-weight: 600;
      margin-bottom: 6px;
    }
    .form-title {
      font-family: 'Syne', sans-serif;
      font-size: 1.75rem;
      font-weight: 800;
      margin-bottom: 4px;
    }
    .form-sub {
      color: var(--muted);
      font-size: 0.85rem;
      margin-bottom: 32px;
    }

    /* ── Field ── */
    .field-row {
      display: grid;
      grid-template-columns: 1fr;
      gap: 16px;
    }
    .field { margin-bottom: 18px; }
    .field-label {
      display: flex;
      align-items: center;
      justify-content: space-between;
      font-size: 0.72rem;
      font-weight: 600;
      letter-spacing: 0.06em;
      text-transform: uppercase;
      color: var(--muted);
      margin-bottom: 8px;
    }
    .field-label .required {
      color: var(--accent2);
      font-size: 0.65rem;
      letter-spacing: 0;
      text-transform: none;
      font-weight: 400;
    }
    .field-label .optional {
      color: var(--muted);
      font-size: 0.65rem;
      font-style: italic;
      text-transform: none;
      font-weight: 400;
    }

    .input-wrap { position: relative; }
    .input-icon {
      position: absolute;
      left: 13px; top: 50%;
      transform: translateY(-50%);
      color: var(--muted);
      display: flex;
      pointer-events: none;
    }
    .field-input {
      width: 100%;
      background: var(--card);
      border: 1px solid var(--border);
      border-radius: 10px;
      padding: 12px 13px 12px 40px;
      font-family: 'DM Sans', sans-serif;
      font-size: 0.87rem;
      color: var(--text);
      outline: none;
      transition: border-color 0.2s, box-shadow 0.2s;
      -webkit-appearance: none;
    }
    .field-input::placeholder { color: #3a3a50; }
    .field-input:focus {
      border-color: rgba(108,99,255,0.5);
      box-shadow: 0 0 0 3px rgba(108,99,255,0.1);
    }
    .field-input.is-error {
      border-color: rgba(255,101,132,0.45);
      box-shadow: 0 0 0 3px rgba(255,101,132,0.08);
    }

    /* textarea */
    .field-textarea {
      width: 100%;
      background: var(--card);
      border: 1px solid var(--border);
      border-radius: 10px;
      padding: 12px 13px 12px 40px;
      font-family: 'DM Sans', sans-serif;
      font-size: 0.87rem;
      color: var(--text);
      outline: none;
      resize: vertical;
      min-height: 88px;
      transition: border-color 0.2s, box-shadow 0.2s;
      line-height: 1.6;
    }
    .field-textarea::placeholder { color: #3a3a50; }
    .field-textarea:focus {
      border-color: rgba(108,99,255,0.5);
      box-shadow: 0 0 0 3px rgba(108,99,255,0.1);
    }

    /* select */
    .field-select {
      width: 100%;
      background: var(--card);
      border: 1px solid var(--border);
      border-radius: 10px;
      padding: 12px 13px 12px 40px;
      font-family: 'DM Sans', sans-serif;
      font-size: 0.87rem;
      color: var(--text);
      outline: none;
      cursor: pointer;
      -webkit-appearance: none;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%236b6b80' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E");
      background-repeat: no-repeat;
      background-position: right 14px center;
      transition: border-color 0.2s, box-shadow 0.2s;
    }
    .field-select:focus {
      border-color: rgba(108,99,255,0.5);
      box-shadow: 0 0 0 3px rgba(108,99,255,0.1);
    }
    .field-select option { background: #16161f; }

    /* password toggle */
    .pw-toggle {
      position: absolute;
      right: 12px; top: 50%;
      transform: translateY(-50%);
      background: none; border: none;
      color: var(--muted);
      cursor: pointer;
      display: flex;
      padding: 3px;
      border-radius: 4px;
      transition: color 0.2s;
    }
    .pw-toggle:hover { color: var(--text); }

    /* password strength */
    .pw-strength {
      margin-top: 8px;
      display: flex;
      gap: 4px;
    }
    .pw-bar {
      flex: 1; height: 3px; border-radius: 3px;
      background: var(--border);
      transition: background 0.3s;
    }
    .pw-bar.weak   { background: var(--accent2); }
    .pw-bar.fair   { background: var(--accent4); }
    .pw-bar.good   { background: #a8d8f0; }
    .pw-bar.strong { background: var(--accent3); }
    .pw-label {
      font-size: 0.7rem;
      color: var(--muted);
      margin-top: 5px;
      height: 14px;
    }

    /* avatar upload */
    .avatar-upload {
      display: flex;
      align-items: center;
      gap: 16px;
      background: var(--card);
      border: 1px dashed rgba(255,255,255,0.1);
      border-radius: 12px;
      padding: 16px;
      cursor: pointer;
      transition: border-color 0.2s;
    }
    .avatar-upload:hover { border-color: rgba(108,99,255,0.4); }
    .avatar-preview {
      width: 56px; height: 56px;
      border-radius: 50%;
      background: linear-gradient(135deg, var(--accent), var(--accent2));
      display: flex; align-items: center; justify-content: center;
      font-family: 'Syne', sans-serif;
      font-weight: 800;
      font-size: 1.1rem;
      flex-shrink: 0;
      overflow: hidden;
    }
    .avatar-preview img { width: 100%; height: 100%; object-fit: cover; }
    .avatar-text strong { display: block; font-size: 0.83rem; margin-bottom: 3px; }
    .avatar-text span   { font-size: 0.73rem; color: var(--muted); }
    .avatar-upload input[type="file"] { display: none; }

    /* interests checkboxes */
    .interests-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 8px;
    }
    .interest-chip {
      display: flex;
      align-items: center;
      gap: 7px;
      background: var(--card);
      border: 1px solid var(--border);
      border-radius: 8px;
      padding: 9px 11px;
      cursor: pointer;
      transition: all 0.15s;
      user-select: none;
    }
    .interest-chip:hover { border-color: rgba(255,255,255,0.12); background: rgba(255,255,255,0.03); }
    .interest-chip input { display: none; }
    .interest-chip.checked {
      background: rgba(108,99,255,0.1);
      border-color: rgba(108,99,255,0.3);
      color: #a89cff;
    }
    .interest-emoji { font-size: 0.95rem; }
    .interest-label { font-size: 0.78rem; font-weight: 500; }

    /* section divider */
    .section-sep {
      display: flex;
      align-items: center;
      gap: 12px;
      margin: 28px 0 22px;
    }
    .section-sep-line { flex: 1; height: 1px; background: var(--border); }
    .section-sep-text {
      font-size: 0.68rem;
      text-transform: uppercase;
      letter-spacing: 0.12em;
      color: var(--muted);
      font-weight: 600;
      white-space: nowrap;
    }

    /* terms */
    .terms-row {
      display: flex;
      align-items: flex-start;
      gap: 10px;
      margin-bottom: 24px;
    }
    .terms-check {
      width: 16px; height: 16px;
      accent-color: var(--accent);
      margin-top: 2px;
      cursor: pointer;
      flex-shrink: 0;
    }
    .terms-text {
      font-size: 0.82rem;
      color: var(--muted);
      line-height: 1.6;
    }
    .terms-text a { color: var(--accent); text-decoration: none; }
    .terms-text a:hover { text-decoration: underline; }

    /* submit */
    .btn-submit {
      width: 100%;
      padding: 14px;
      background: var(--accent);
      color: #fff;
      border: none;
      border-radius: 11px;
      font-family: 'DM Sans', sans-serif;
      font-size: 0.92rem;
      font-weight: 600;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 9px;
      box-shadow: 0 4px 20px rgba(108,99,255,0.35);
      transition: all 0.2s;
      letter-spacing: 0.01em;
      position: relative;
      overflow: hidden;
    }
    .btn-submit::after {
      content: '';
      position: absolute;
      inset: 0;
      background: linear-gradient(135deg, rgba(255,255,255,0.12), transparent);
      opacity: 0;
      transition: opacity 0.2s;
    }
    .btn-submit:hover { transform: translateY(-2px); box-shadow: 0 8px 28px rgba(108,99,255,0.5); }
    .btn-submit:hover::after { opacity: 1; }
    .btn-submit:active { transform: translateY(0); }

    .login-link {
      text-align: center;
      margin-top: 20px;
      font-size: 0.84rem;
      color: var(--muted);
    }
    .login-link a { color: var(--accent); text-decoration: none; font-weight: 600; }
    .login-link a:hover { text-decoration: underline; }

    /* error msg */
    .field-err {
      font-size: 0.73rem;
      color: var(--error);
      margin-top: 6px;
      display: flex;
      align-items: center;
      gap: 4px;
    }

    /* animations */
    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(14px); }
      to   { opacity: 1; transform: translateY(0); }
    }
    .form-box { animation: fadeUp 0.45s ease both; }

    /* Responsive */
    @media (max-width: 900px) {
      body { grid-template-columns: 1fr; }
      .left-panel { display: none; }
      .right-panel { padding: 36px 24px; }
      .field-row { grid-template-columns: 1fr; }
      .interests-grid { grid-template-columns: repeat(2, 1fr); }
    }
  </style>
</head>
<body>

  <!-- ══ LEFT PANEL ══════════════════════════════ -->
  <div class="left-panel">

    <div class="brand">
      <div class="brand-box">AP</div>
      <span class="brand-name">Admin Panel</span>
    </div>

    <div class="left-copy">
      <div class="left-tag">Join the platform</div>
      <h2 class="left-h">Start your<br><span>blog journey</span><br>today</h2>
      <p class="left-p">
        Create your account and unlock full access to the blog management system — write, publish, and grow your audience.
      </p>

      <div class="role-cards">
        <div class="role-card">
          <div class="role-card-icon" style="background:rgba(108,99,255,0.12);">✍️</div>
          <div class="role-card-text">
            <strong>Author Access</strong>
            <span>Write & publish your own posts</span>
          </div>
        </div>
        <div class="role-card">
          <div class="role-card-icon" style="background:rgba(67,233,123,0.1);">📊</div>
          <div class="role-card-text">
            <strong>Analytics Dashboard</strong>
            <span>Track views, reads & engagement</span>
          </div>
        </div>
        <div class="role-card">
          <div class="role-card-icon" style="background:rgba(247,151,30,0.1);">🔒</div>
          <div class="role-card-text">
            <strong>Secure & Private</strong>
            <span>Your data is always protected</span>
          </div>
        </div>
      </div>
    </div>

    <div class="left-foot">© 2026 Admin Panel · Blog Management System</div>
  </div>

  <!-- ══ RIGHT PANEL (FORM) ══════════════════════ -->
  <div class="right-panel">
    <div class="form-box" style="max-width:580px; margin:0 auto;">

      <!-- Step bar -->
      <div class="steps-bar">
        <div class="step-item done">
          <div class="step-num">✓</div>
          <span>Account</span>
        </div>
        <div class="step-line"></div>
        <div class="step-item active">
          <div class="step-num">2</div>
          <span>Profile</span>
        </div>
        <div class="step-line"></div>
        <div class="step-item">
          <div class="step-num">3</div>
          <span>Preferences</span>
        </div>
      </div>

      <div class="form-eyebrow">Create Account</div>
      <h1 class="form-title">Register as Author</h1>
      <p class="form-sub">Fill in your details to get started with blog management</p>

      {{-- Laravel errors --}}
      @if($errors->any())
        <div style="background:rgba(255,101,132,0.08); border:1px solid rgba(255,101,132,0.2); border-radius:10px; padding:13px 15px; font-size:0.82rem; color:#ff6584; margin-bottom:24px;">
          ⚠️ {{ $errors->first() }}
        </div>
      @endif

      <form method="POST" action="" enctype="multipart/form-data">
        @csrf

        <!-- ── SECTION: Basic Info ── -->
        <div class="section-sep">
          <div class="section-sep-line"></div>
          <span class="section-sep-text">Basic Information</span>
          <div class="section-sep-line"></div>
        </div>

        <div class="field-row">
          <!-- First Name -->
          <div class="field">
            <div class="field-label">
              First Name <span class="required">* required</span>
            </div>
            <div class="input-wrap">
              <span class="input-icon">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
                </svg>
              </span>
              <input type="text" name="first_name" class="field-input @error('first_name') is-error @enderror"
                     placeholder="Aryan" value="{{ old('first_name') }}" required>
            </div>
            @error('first_name')<div class="field-err">⚠ {{ $message }}</div>@enderror
          </div>

          <!-- Last Name -->
          <div class="field">
            <div class="field-label">
              Last Name <span class="required">* required</span>
            </div>
            <div class="input-wrap">
              <span class="input-icon">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
                </svg>
              </span>
              <input type="text" name="last_name" class="field-input @error('last_name') is-error @enderror"
                     placeholder="Sharma" value="{{ old('last_name') }}" required>
            </div>
            @error('last_name')<div class="field-err">⚠ {{ $message }}</div>@enderror
          </div>
        </div>

        <!-- Username -->
        <div class="field">
          <div class="field-label">
            Username <span class="required">* required</span>
          </div>
          <div class="input-wrap">
            <span class="input-icon">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="4"/><path d="M16 8v5a3 3 0 0 0 6 0v-1a10 10 0 1 0-3.92 7.94"/>
              </svg>
            </span>
            <input type="text" name="username" id="username"
                   class="field-input @error('username') is-error @enderror"
                   placeholder="aryan_sharma" value="{{ old('username') }}"
                   oninput="checkUsername(this.value)" required>
          </div>
          <div id="username-hint" style="font-size:0.73rem; margin-top:5px; color:var(--muted);">
            Your public author handle — only letters, numbers, and underscores
          </div>
          @error('username')<div class="field-err">⚠ {{ $message }}</div>@enderror
        </div>

        <!-- Email -->
        <div class="field">
          <div class="field-label">
            Email Address <span class="required">* required</span>
          </div>
          <div class="input-wrap">
            <span class="input-icon">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="2" y="4" width="20" height="16" rx="2"/><path d="m2 7 10 7 10-7"/>
              </svg>
            </span>
            <input type="email" name="email"
                   class="field-input @error('email') is-error @enderror"
                   placeholder="aryan@example.com" value="{{ old('email') }}" required>
          </div>
          @error('email')<div class="field-err">⚠ {{ $message }}</div>@enderror
        </div>

        <div class="field-row">
          <!-- Phone -->
          <div class="field">
            <div class="field-label">
              Phone <span class="optional">optional</span>
            </div>
            <div class="input-wrap">
              <span class="input-icon">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 13a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 2.18h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                </svg>
              </span>
              <input type="tel" name="phone"
                     class="field-input @error('phone') is-error @enderror"
                     placeholder="+91 98765 43210" value="{{ old('phone') }}">
            </div>
          </div>

          <!-- Role -->
          <div class="field">
            <div class="field-label">
              Role <span class="required">* required</span>
            </div>
            <div class="input-wrap">
              <span class="input-icon">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                </svg>
              </span>
            <select name="role_id" required>
    <option value="">-- Select Role --</option>
    @foreach($roles as $role)
        <option value="{{ $role->id }}">
            {{ $role->name }}
        </option>
    @endforeach
</select>

        <!-- ── SECTION: Author Profile ── -->
        <div class="section-sep">
          <div class="section-sep-line"></div>
          <span class="section-sep-text">Author Profile</span>
          <div class="section-sep-line"></div>
        </div>

        <!-- Profile Photo -->
        <div class="field">
          <div class="field-label">Profile Photo <span class="optional">optional</span></div>
          <label class="avatar-upload" for="avatar-input">
            <div class="avatar-preview" id="avatar-preview">
              <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1.8">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
              </svg>
            </div>
            <div class="avatar-text">
              <strong>Upload your photo</strong>
              <span>JPG, PNG or WEBP · Max 2MB · Square preferred</span>
            </div>
            <input type="file" id="avatar-input" name="profile_image"
                   accept="image/*" onchange="previewAvatar(this)">
          </label>
        </div>

        <!-- Bio -->
        <div class="field">
          <div class="field-label">Bio / About You <span class="optional">optional</span></div>
          <div class="input-wrap">
            <span class="input-icon" style="top:14px; transform:none;">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/>
              </svg>
            </span>
            <textarea name="bio" class="field-textarea"
                      placeholder="Tell readers a little about yourself, your writing style, and what topics you cover..."
                      maxlength="300">{{ old('bio') }}</textarea>
          </div>
          <div style="font-size:0.7rem; color:var(--muted); margin-top:5px; text-align:right;">
            <span id="bio-count">0</span>/300
          </div>
        </div>

        <div class="field-row">
          <!-- Website -->
        

          <!-- Location / State -->
          <div class="field">
            <div class="field-label">State <span class="optional">optional</span></div>
            <div class="input-wrap">
              <span class="input-icon">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/>
                </svg>
              </span>
   <select name="state_id" class="field-input" required>
    <option value="">-- Select State --</option>
    @foreach($states as $state)
        <option value="{{ $state->id }}"
            {{ old('state_id') == $state->id ? 'selected' : '' }}>
            {{ $state->name }}
        </option>
    @endforeach
</select>
            </div>
          </div>
        </div>


        <!-- ── SECTION: Security ── -->
        <div class="section-sep">
          <div class="section-sep-line"></div>
          <span class="section-sep-text">Security</span>
          <div class="section-sep-line"></div>
        </div>

        <!-- Password -->
        <div class="field">
          <div class="field-label">Password <span class="required">* required</span></div>
          <div class="input-wrap">
            <span class="input-icon">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>
              </svg>
            </span>
            <input type="password" name="password" id="pw1"
                   class="field-input @error('password') is-error @enderror"
                   placeholder="Minimum 8 characters"
                   oninput="evalStrength(this.value)" required>
            <button type="button" class="pw-toggle" onclick="toggle('pw1','eye1')">
              <svg id="eye1" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
              </svg>
            </button>
          </div>
          <div class="pw-strength">
            <div class="pw-bar" id="b1"></div>
            <div class="pw-bar" id="b2"></div>
            <div class="pw-bar" id="b3"></div>
            <div class="pw-bar" id="b4"></div>
          </div>
          <div class="pw-label" id="pw-label"></div>
          @error('password')<div class="field-err">⚠ {{ $message }}</div>@enderror
        </div>

        <!-- Confirm Password -->
        <div class="field">
          <div class="field-label">Confirm Password <span class="required">* required</span></div>
          <div class="input-wrap">
            <span class="input-icon">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0 1 12 2.944a11.955 11.955 0 0 1-8.618 3.04A12.02 12.02 0 0 0 3 9c0 5.591 3.824 10.29 9 11.622C17.176 19.29 21 14.591 21 9c0-1.05-.143-2.073-.382-3.016z"/>
              </svg>
            </span>
            <input type="password" name="password_confirmation" id="pw2"
                   class="field-input"
                   placeholder="Repeat your password"
                   oninput="checkMatch()" required>
            <button type="button" class="pw-toggle" onclick="toggle('pw2','eye2')">
              <svg id="eye2" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
              </svg>
            </button>
          </div>
          <div id="match-msg" style="font-size:0.73rem; margin-top:5px; height:16px;"></div>
        </div>

        <!-- Terms -->
        <div class="terms-row">
          <input type="checkbox" name="terms" id="terms" class="terms-check" required>
          <label for="terms" class="terms-text">
            I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>.
            I understand my content will be published on the platform.
          </label>
        </div>

        <!-- Submit -->
        <button type="submit" class="btn-submit">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
            <circle cx="9" cy="7" r="4"/>
            <path d="M22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/>
          </svg>
          Create My Account
        </button>

        <div class="login-link">
          Already have an account? <a href="{{ route('login') }}">Sign in</a>
        </div>

      </form>
    </div>
  </div>

  <script>
    // Avatar preview
    function previewAvatar(input) {
      if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
          const p = document.getElementById('avatar-preview');
          p.innerHTML = `<img src="${e.target.result}" alt="avatar">`;
        };
        reader.readAsDataURL(input.files[0]);
      }
    }

    // Interest chip toggle
    function toggleChip(label) {
      const cb = label.querySelector('input');
      setTimeout(() => {
        label.classList.toggle('checked', cb.checked);
      }, 0);
    }
    // Init checked state on load
    document.querySelectorAll('.interest-chip input:checked').forEach(cb => {
      cb.closest('.interest-chip').classList.add('checked');
    });

    // Username hint
    function checkUsername(val) {
      const hint = document.getElementById('username-hint');
      const valid = /^[a-z0-9_]{3,20}$/.test(val);
      if (val.length === 0) {
        hint.style.color = 'var(--muted)';
        hint.textContent = 'Your public author handle — only letters, numbers, and underscores';
      } else if (valid) {
        hint.style.color = 'var(--accent3)';
        hint.textContent = '✓ Looks good!';
      } else {
        hint.style.color = 'var(--error)';
        hint.textContent = '3–20 chars, lowercase letters, numbers, underscores only';
      }
    }

    // Password strength
    function evalStrength(pw) {
      let score = 0;
      if (pw.length >= 8)              score++;
      if (/[A-Z]/.test(pw))            score++;
      if (/[0-9]/.test(pw))            score++;
      if (/[^A-Za-z0-9]/.test(pw))     score++;

      const bars   = ['b1','b2','b3','b4'];
      const states = ['','weak','fair','good','strong'];
      const labels = ['','Weak','Fair','Good 👍','Strong 🔒'];
      const colors = ['','var(--error)','var(--accent4)','#a8d8f0','var(--accent3)'];

      bars.forEach((id, i) => {
        const el = document.getElementById(id);
        el.className = 'pw-bar';
        if (i < score) el.classList.add(states[score]);
      });
      const lbl = document.getElementById('pw-label');
      lbl.style.color = colors[score];
      lbl.textContent = labels[score] || '';
    }

    // Confirm password match
    function checkMatch() {
      const p1  = document.getElementById('pw1').value;
      const p2  = document.getElementById('pw2').value;
      const msg = document.getElementById('match-msg');
      if (!p2) { msg.textContent = ''; return; }
      if (p1 === p2) {
        msg.style.color = 'var(--accent3)';
        msg.textContent = '✓ Passwords match';
      } else {
        msg.style.color = 'var(--error)';
        msg.textContent = '✗ Passwords do not match';
      }
    }

    // Show/hide password
    function toggle(inputId, iconId) {
      const input = document.getElementById(inputId);
      const icon  = document.getElementById(iconId);
      const isHidden = input.type === 'password';
      input.type = isHidden ? 'text' : 'password';
      icon.innerHTML = isHidden
        ? `<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/>
           <path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/>
           <line x1="1" y1="1" x2="23" y2="23"/>`
        : `<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>`;
    }

    // Bio character count
    const bioArea = document.querySelector('textarea[name="bio"]');
    const bioCount = document.getElementById('bio-count');
    if (bioArea && bioCount) {
      bioCount.textContent = bioArea.value.length;
      bioArea.addEventListener('input', () => {
        bioCount.textContent = bioArea.value.length;
        bioCount.style.color = bioArea.value.length > 270 ? 'var(--accent2)' : 'var(--muted)';
      });
    }
  </script>

</body>
</html>