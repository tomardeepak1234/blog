<!-- Sidebar -->
<style>
  @import url('https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500&display=swap');

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
    --glow:    rgba(108,99,255,0.25);
  }

  .sidebar {
    width: 260px;
    min-height: 100vh;
    background: var(--surface);
    border-right: 1px solid var(--border);
    display: flex;
    flex-direction: column;
    padding: 0;
    font-family: 'DM Sans', sans-serif;
    position: relative;
    overflow: hidden;
    flex-shrink: 0;
  }

  /* Background glow effect */
  .sidebar::before {
    content: '';
    position: absolute;
    top: -80px; left: -80px;
    width: 220px; height: 220px;
    background: radial-gradient(circle, var(--glow) 0%, transparent 70%);
    pointer-events: none;
    z-index: 0;
  }

  /* ── LOGO AREA ─────────────────── */
  .sidebar-brand {
    padding: 24px 22px 20px;
    border-bottom: 1px solid var(--border);
    position: relative;
    z-index: 1;
  }

  .sidebar-brand-inner {
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .brand-logo {
    width: 36px; height: 36px;
    background: linear-gradient(135deg, var(--accent), var(--accent2));
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-family: 'Syne', sans-serif;
    font-weight: 800;
    font-size: 0.85rem;
    color: #fff;
    box-shadow: 0 4px 15px rgba(108,99,255,0.4);
    flex-shrink: 0;
  }

  .brand-text {
    display: flex;
    flex-direction: column;
  }

  .brand-name {
    font-family: 'Syne', sans-serif;
    font-weight: 800;
    font-size: 0.95rem;
    color: var(--text);
    letter-spacing: 0.02em;
    line-height: 1;
  }

  .brand-sub {
    font-size: 0.68rem;
    color: var(--muted);
    letter-spacing: 0.08em;
    text-transform: uppercase;
    margin-top: 2px;
  }

  /* Live indicator */
  .live-badge {
    margin-left: auto;
    display: flex;
    align-items: center;
    gap: 5px;
    background: rgba(67,233,123,0.1);
    border: 1px solid rgba(67,233,123,0.2);
    border-radius: 20px;
    padding: 3px 9px;
    font-size: 0.65rem;
    color: var(--accent3);
    font-weight: 600;
    letter-spacing: 0.05em;
  }

  .live-dot {
    width: 6px; height: 6px;
    border-radius: 50%;
    background: var(--accent3);
    animation: blink 1.5s infinite;
  }

  @keyframes blink {
    0%, 100% { opacity: 1; }
    50%       { opacity: 0.3; }
  }

  /* ── NAV SECTION ───────────────── */
  .sidebar-nav {
    flex: 1;
    padding: 18px 14px;
    position: relative;
    z-index: 1;
    overflow-y: auto;
  }

  .nav-section-label {
    font-size: 0.65rem;
    text-transform: uppercase;
    letter-spacing: 0.12em;
    color: var(--muted);
    padding: 0 10px;
    margin-bottom: 8px;
    margin-top: 6px;
    font-weight: 600;
  }

  .nav-item-link {
    display: flex;
    align-items: center;
    gap: 11px;
    padding: 11px 12px;
    border-radius: 10px;
    text-decoration: none;
    color: var(--muted);
    font-size: 0.85rem;
    font-weight: 500;
    margin-bottom: 3px;
    transition: all 0.2s;
    position: relative;
    border: 1px solid transparent;
  }

  .nav-item-link:hover {
    background: rgba(255,255,255,0.04);
    color: var(--text);
    border-color: var(--border);
  }

  .nav-item-link.active {
    background: rgba(108,99,255,0.12);
    color: #a89cff;
    border-color: rgba(108,99,255,0.25);
  }

  .nav-item-link.active::before {
    content: '';
    position: absolute;
    left: 0; top: 50%;
    transform: translateY(-50%);
    width: 3px;
    height: 60%;
    background: var(--accent);
    border-radius: 0 3px 3px 0;
    box-shadow: 0 0 10px var(--accent);
  }

  .nav-icon {
    width: 30px; height: 30px;
    border-radius: 8px;
    display: flex; align-items: center; justify-content: center;
    font-size: 0.95rem;
    flex-shrink: 0;
    background: rgba(255,255,255,0.04);
    transition: background 0.2s;
  }

  .nav-item-link:hover  .nav-icon { background: rgba(255,255,255,0.07); }
  .nav-item-link.active .nav-icon { background: rgba(108,99,255,0.2); }

  .nav-label { flex: 1; }

  .nav-badge {
    font-size: 0.65rem;
    padding: 2px 7px;
    border-radius: 20px;
    font-weight: 700;
  }

  .nb-purple { background: rgba(108,99,255,0.2); color: var(--accent); }
  .nb-green  { background: rgba(67,233,123,0.15); color: var(--accent3); }
  .nb-orange { background: rgba(247,151,30,0.15); color: var(--accent4); }

  .nav-divider {
    border: none;
    border-top: 1px solid var(--border);
    margin: 14px 0;
  }

  /* ── USER FOOTER ───────────────── */
  .sidebar-footer {
    padding: 16px 14px;
    border-top: 1px solid var(--border);
    position: relative;
    z-index: 1;
  }

  .user-card {
    display: flex;
    align-items: center;
    gap: 11px;
    padding: 10px;
    border-radius: 10px;
    background: var(--card);
    border: 1px solid var(--border);
    cursor: pointer;
    transition: all 0.2s;
    text-decoration: none;
  }

  .user-card:hover { border-color: rgba(255,255,255,0.12); background: rgba(255,255,255,0.03); }

  .user-av-s {
    width: 34px; height: 34px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--accent), var(--accent2));
    display: flex; align-items: center; justify-content: center;
    font-family: 'Syne', sans-serif;
    font-weight: 700;
    font-size: 0.78rem;
    color: #fff;
    flex-shrink: 0;
  }

  .user-info { flex: 1; min-width: 0; }
  .user-info-name {
    font-size: 0.82rem;
    font-weight: 600;
    color: var(--text);
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    line-height: 1.2;
  }
  .user-info-role {
    font-size: 0.7rem;
    color: var(--muted);
    margin-top: 1px;
  }

  .logout-btn {
    background: transparent;
    border: none;
    color: var(--muted);
    font-size: 1rem;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 28px; height: 28px;
    border-radius: 7px;
    transition: all 0.2s;
    flex-shrink: 0;
  }
  .logout-btn:hover { background: rgba(255,101,132,0.1); color: var(--accent2); }
</style>

<div class="sidebar">

  <!-- Brand -->
  <div class="sidebar-brand">
    <div class="sidebar-brand-inner">
      <div class="brand-logo">AP</div>
      <div class="brand-text">
        <span class="brand-name">Admin Panel</span>
        <span class="brand-sub">Management System</span>
      </div>
      <div class="live-badge">
        <div class="live-dot"></div>
        LIVE
      </div>
    </div>
  </div>

  <!-- Nav -->
  <nav class="sidebar-nav">

    <div class="nav-section-label">Main</div>

     
@if (Auth::user()->role->name==='Admin')
    

    <a href="{{ url('dashboard') }}" class="nav-item-link active">
      <div class="nav-icon">🏠</div>
      <span class="nav-label">Dashboard</span>
    </a>

    <a href="{{ url('user') }}" class="nav-item-link">
      <div class="nav-icon">👤</div>
      <span class="nav-label">Users</span>
      <span class="nav-badge nb-purple">{{Auth::user()->count()}}</span>
    </a>


    <a href="{{ url('role_master') }}" class="nav-item-link">
      <div class="nav-icon">🛡️</div>
      <span class="nav-label">Role Master</span>
    </a>

    <a href="{{ url('state_master') }}" class="nav-item-link">
      <div class="nav-icon">🗺️</div>
      <span class="nav-label">State Master</span>
    </a>
@endif


    <a href="{{ url('post') }}" class="nav-item-link">
      <div class="nav-icon">📝</div>
      <span class="nav-label">Post Management</span>
      <span class="nav-badge nb-orange">New</span>
    </a>
    <a href="{{ url('my-posts')}}" class="nav-item-link">
      <div class="nav-icon">📝</div>
      <span class="nav-label">My Posts</span>
      {{-- <span class="nav-badge nb-orange">New</span> --}}
    </a>

    <a href="{{ url('settings') }}" class="nav-item-link">
      <div class="nav-icon">⚙️</div>
      <span class="nav-label">Settings</span>
    </a>

  </nav>

  <!-- Footer User Card -->
  <div class="sidebar-footer">
    <div style="display:flex; align-items:center; gap:8px;">
      <a href="{{ url('profile') }}" class="user-card" style="flex:1; text-decoration:none;">
        <div class="user-av-s"> {{ substr(Auth::user()->role->name, 0, 2) }}</div>
        <div class="user-info">
          <div class="user-info-name">{{Auth::user()->first_name}}</div>
          <div class="user-info-role">{{Auth::user()->role->name}}</div>
        </div>
      </a>
   <form method="POST" action="{{ route('logout') }}" style="margin:0;">
    @csrf
    <button type="submit" class="logout-btn" title="Logout">
        <svg width="15" height="15" viewBox="0 0 24 24"
             fill="none" stroke="currentColor" stroke-width="2.2">

            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
            <polyline points="16 17 21 12 16 7"/>
            <line x1="21" y1="12" x2="9" y2="12"/>
        </svg>
    </button>
</form>
    </div>
  </div>

</div>

<script>
  // Auto-highlight active nav link based on current URL
  document.querySelectorAll('.nav-item-link').forEach(link => {
    link.classList.remove('active');
    if (link.href === window.location.href ||
        window.location.pathname.includes(new URL(link.href).pathname.split('/')[1])) {
      link.classList.add('active');
    }
  });
</script>