@extends('admin.admin_meta')
@section('content')

  <!-- ══ LEFT PANEL ══════════════════════════════ -->
 
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

      <form method="POST" action="{{ route('user.store') }}" enctype="multipart/form-data">
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
    @foreach($roles??[] as $role)
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
        <div class=".field-row">
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
    @foreach($states ??[] as $state)
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
@endsection