@extends('Admin.Admin_meta')

@section('content')

<style>
  @import url('https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500&display=swap');

  :root {
    --bg:        #0a0a0f;
    --surface:   #111118;
    --card:      #16161f;
    --border:    rgba(255,255,255,0.07);
    --accent:    #6c63ff;
    --accent2:   #ff6584;
    --accent3:   #43e97b;
    --accent4:   #f7971e;
    --text:      #f0f0f8;
    --muted:     #6b6b80;
    --glow:      rgba(108,99,255,0.25);
  }

  * { box-sizing: border-box; margin: 0; padding: 0; }

  body, .content {
    background: var(--bg);
    font-family: 'DM Sans', sans-serif;
    color: var(--text);
    min-height: 100vh;
  }

  /* ── TOP BAR ─────────────────────────────── */
  .dash-topbar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 22px 32px;
    border-bottom: 1px solid var(--border);
    background: var(--surface);
    position: sticky;
    top: 0;
    z-index: 100;
    backdrop-filter: blur(12px);
  }

  .dash-topbar .brand {
    font-family: 'Syne', sans-serif;
    font-weight: 800;
    font-size: 1.15rem;
    letter-spacing: 0.04em;
    color: var(--text);
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .dash-topbar .brand .dot {
    width: 9px; height: 9px;
    border-radius: 50%;
    background: var(--accent);
    box-shadow: 0 0 12px var(--accent);
    animation: pulse-dot 2s infinite;
  }

  @keyframes pulse-dot {
    0%, 100% { transform: scale(1); opacity: 1; }
    50%       { transform: scale(1.4); opacity: 0.6; }
  }

  .dash-topbar .topbar-right {
    display: flex;
    align-items: center;
    gap: 16px;
  }

  .topbar-date {
    font-size: 0.78rem;
    color: var(--muted);
    letter-spacing: 0.05em;
    text-transform: uppercase;
  }

  .topbar-avatar {
    width: 36px; height: 36px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--accent), var(--accent2));
    display: flex; align-items: center; justify-content: center;
    font-family: 'Syne', sans-serif;
    font-weight: 700;
    font-size: 0.8rem;
    cursor: pointer;
    transition: transform 0.2s;
  }
  .topbar-avatar:hover { transform: scale(1.1); }

  /* ── MAIN CONTENT ─────────────────────────── */
  .dash-body {
    padding: 36px 32px;
    max-width: 1200px;
    margin: 0 auto;
  }

  /* ── WELCOME HERO ─────────────────────────── */
  .welcome-hero {
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: 20px;
    padding: 36px 40px;
    margin-bottom: 32px;
    position: relative;
    overflow: hidden;
    animation: fadeUp 0.5s ease both;
  }

  .welcome-hero::before {
    content: '';
    position: absolute;
    top: -60px; right: -60px;
    width: 250px; height: 250px;
    border-radius: 50%;
    background: radial-gradient(circle, var(--glow) 0%, transparent 70%);
    pointer-events: none;
  }

  .welcome-hero::after {
    content: 'ADMIN';
    position: absolute;
    bottom: -10px; right: 32px;
    font-family: 'Syne', sans-serif;
    font-size: 5rem;
    font-weight: 800;
    color: rgba(255,255,255,0.03);
    letter-spacing: 0.1em;
    user-select: none;
  }

  .welcome-eyebrow {
    font-size: 0.7rem;
    text-transform: uppercase;
    letter-spacing: 0.15em;
    color: var(--accent);
    margin-bottom: 8px;
    font-weight: 600;
  }

  .welcome-title {
    font-family: 'Syne', sans-serif;
    font-size: 2rem;
    font-weight: 800;
    line-height: 1.2;
    margin-bottom: 10px;
  }

  .welcome-title span {
    background: linear-gradient(90deg, var(--accent), var(--accent2));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  }

  .welcome-sub {
    color: var(--muted);
    font-size: 0.9rem;
    line-height: 1.6;
    max-width: 500px;
  }

  .welcome-actions {
    display: flex;
    gap: 12px;
    margin-top: 24px;
  }

  .btn-primary-dash {
    background: var(--accent);
    color: #fff;
    border: none;
    padding: 10px 22px;
    border-radius: 10px;
    font-family: 'DM Sans', sans-serif;
    font-size: 0.85rem;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 7px;
    box-shadow: 0 4px 15px rgba(108,99,255,0.35);
  }
  .btn-primary-dash:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(108,99,255,0.5);
    color: #fff;
  }

  .btn-ghost-dash {
    background: transparent;
    color: var(--muted);
    border: 1px solid var(--border);
    padding: 10px 22px;
    border-radius: 10px;
    font-family: 'DM Sans', sans-serif;
    font-size: 0.85rem;
    cursor: pointer;
    transition: all 0.2s;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 7px;
  }
  .btn-ghost-dash:hover {
    color: var(--text);
    border-color: rgba(255,255,255,0.2);
    background: rgba(255,255,255,0.04);
  }

  /* ── STATS GRID ───────────────────────────── */
  .stats-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 16px;
    margin-bottom: 28px;
  }

  .stat-card {
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: 16px;
    padding: 22px 24px;
    position: relative;
    overflow: hidden;
    cursor: pointer;
    transition: all 0.25s;
    animation: fadeUp 0.5s ease both;
  }
  .stat-card:nth-child(1) { animation-delay: 0.05s; }
  .stat-card:nth-child(2) { animation-delay: 0.10s; }
  .stat-card:nth-child(3) { animation-delay: 0.15s; }
  .stat-card:nth-child(4) { animation-delay: 0.20s; }

  .stat-card:hover {
    transform: translateY(-4px);
    border-color: rgba(255,255,255,0.12);
    box-shadow: 0 12px 40px rgba(0,0,0,0.4);
  }

  .stat-card .glow-orb {
    position: absolute;
    top: -20px; right: -20px;
    width: 80px; height: 80px;
    border-radius: 50%;
    opacity: 0.5;
    filter: blur(20px);
    pointer-events: none;
  }

  .stat-icon {
    width: 40px; height: 40px;
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.1rem;
    margin-bottom: 16px;
  }

  .stat-label {
    font-size: 0.73rem;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: var(--muted);
    margin-bottom: 6px;
  }

  .stat-value {
    font-family: 'Syne', sans-serif;
    font-size: 2rem;
    font-weight: 800;
    line-height: 1;
    margin-bottom: 10px;
  }

  .stat-trend {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    font-size: 0.75rem;
    font-weight: 500;
    padding: 3px 8px;
    border-radius: 20px;
  }
  .trend-up   { background: rgba(67,233,123,0.12); color: var(--accent3); }
  .trend-down { background: rgba(255,101,132,0.12); color: var(--accent2); }

  /* ── BOTTOM ROW ───────────────────────────── */
  .bottom-row {
    display: grid;
    grid-template-columns: 1fr 380px;
    gap: 20px;
  }

  /* Activity Table */
  .table-card {
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: 16px;
    overflow: hidden;
    animation: fadeUp 0.5s ease 0.3s both;
  }

  .card-head {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 20px 24px;
    border-bottom: 1px solid var(--border);
  }

  .card-title {
    font-family: 'Syne', sans-serif;
    font-size: 0.95rem;
    font-weight: 700;
    letter-spacing: 0.02em;
  }

  .badge-new {
    background: rgba(108,99,255,0.15);
    color: var(--accent);
    font-size: 0.68rem;
    padding: 2px 9px;
    border-radius: 20px;
    font-weight: 600;
    letter-spacing: 0.05em;
  }

  .activity-table { width: 100%; border-collapse: collapse; }
  .activity-table th {
    text-align: left;
    font-size: 0.7rem;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: var(--muted);
    padding: 12px 24px;
    border-bottom: 1px solid var(--border);
    font-weight: 500;
  }
  .activity-table td {
    padding: 14px 24px;
    font-size: 0.85rem;
    border-bottom: 1px solid rgba(255,255,255,0.03);
    color: var(--text);
    transition: background 0.15s;
  }
  .activity-table tr:hover td { background: rgba(255,255,255,0.02); }
  .activity-table tr:last-child td { border-bottom: none; }

  .user-cell { display: flex; align-items: center; gap: 10px; }
  .user-av {
    width: 30px; height: 30px;
    border-radius: 50%;
    font-size: 0.7rem;
    font-weight: 700;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
  }
  .user-name { font-weight: 500; font-size: 0.83rem; }
  .user-email { font-size: 0.73rem; color: var(--muted); }

  .status-pill {
    font-size: 0.72rem;
    padding: 3px 10px;
    border-radius: 20px;
    font-weight: 600;
  }
  .s-active   { background: rgba(67,233,123,0.1);  color: var(--accent3); }
  .s-pending  { background: rgba(247,151,30,0.12); color: var(--accent4); }
  .s-inactive { background: rgba(255,101,132,0.1); color: var(--accent2); }

  /* Right Panel */
  .right-col { display: flex; flex-direction: column; gap: 16px; }

  /* Quick actions */
  .quick-card {
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: 16px;
    overflow: hidden;
    animation: fadeUp 0.5s ease 0.35s both;
  }

  .quick-actions-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1px;
    background: var(--border);
  }

  .qa-btn {
    background: var(--card);
    border: none;
    padding: 18px 16px;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 8px;
    cursor: pointer;
    transition: background 0.2s;
    text-decoration: none;
    color: var(--text);
  }
  .qa-btn:hover { background: rgba(255,255,255,0.04); color: var(--text); }
  .qa-icon { font-size: 1.3rem; }
  .qa-label { font-size: 0.72rem; color: var(--muted); font-weight: 500; }

  /* Donut chart panel */
  .donut-card {
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: 16px;
    padding: 20px 24px;
    animation: fadeUp 0.5s ease 0.4s both;
  }

  .donut-wrap {
    position: relative;
    width: 110px; height: 110px;
    margin: 20px auto 16px;
  }

  .donut-wrap svg { transform: rotate(-90deg); }
  .donut-center {
    position: absolute;
    inset: 0;
    display: flex; flex-direction: column;
    align-items: center; justify-content: center;
    font-family: 'Syne', sans-serif;
  }
  .donut-pct { font-size: 1.3rem; font-weight: 800; }
  .donut-sub { font-size: 0.65rem; color: var(--muted); }

  .donut-legend { display: flex; flex-direction: column; gap: 8px; }
  .legend-item { display: flex; align-items: center; justify-content: space-between; font-size: 0.8rem; }
  .legend-dot-label { display: flex; align-items: center; gap: 8px; }
  .legend-dot { width: 8px; height: 8px; border-radius: 50%; flex-shrink: 0; }
  .legend-val { font-weight: 600; font-size: 0.82rem; }

  /* Animation */
  @keyframes fadeUp {
    from { opacity: 0; transform: translateY(18px); }
    to   { opacity: 1; transform: translateY(0); }
  }

  /* Counter animation */
  .count-up { display: inline-block; }

  @media (max-width: 1024px) {
    .stats-grid { grid-template-columns: repeat(2, 1fr); }
    .bottom-row { grid-template-columns: 1fr; }
  }
  @media (max-width: 600px) {
    .dash-body { padding: 20px 16px; }
    .welcome-hero { padding: 24px 20px; }
    .stats-grid { grid-template-columns: 1fr 1fr; gap: 10px; }
  }
</style>

<div class="content" style="background:var(--bg, #0a0a0f); min-height:100vh;">

  <!-- TOP BAR -->
  <div class="dash-topbar">
    <div class="brand">
      <div class="dot"></div>
      Admin Panel
    </div>
    <div class="topbar-right">
      <span class="topbar-date" id="live-date"></span>
      <div class="topbar-avatar">SA</div>
    </div>
  </div>

  <div class="dash-body">

    <!-- WELCOME HERO -->
    <div class="welcome-hero">
      <div class="welcome-eyebrow">Overview · Today</div>
      <h1 class="welcome-title">Welcome back, <span>Super Admin</span> 👋</h1>
      <p class="welcome-sub">Here's what's happening across your platform today. All systems are running smoothly.</p>
      <div class="welcome-actions">
        <a href="#" class="btn-primary-dash">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg>
          Add New User
        </a>
        <a href="#" class="btn-ghost-dash">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M9 21V9"/></svg>
          View Reports
        </a>
      </div>
    </div>

    <!-- STATS GRID -->
    <div class="stats-grid">

      <!-- Users -->
      <div class="stat-card">
        <div class="glow-orb" style="background:var(--accent);"></div>
        <div class="stat-icon" style="background:rgba(108,99,255,0.15); color:var(--accent);">👤</div>
        <div class="stat-label">Total Users</div>
        <div class="stat-value" style="color:var(--accent);">
          <span class="count-up" data-target="150">0</span>
        </div>
        <div class="stat-trend trend-up">▲ 12% this month</div>
      </div>

      <!-- Orders -->
      <div class="stat-card">
        <div class="glow-orb" style="background:var(--accent3);"></div>
        <div class="stat-icon" style="background:rgba(67,233,123,0.12); color:var(--accent3);">📦</div>
        <div class="stat-label">Today's Orders</div>
        <div class="stat-value" style="color:var(--accent3);">
          <span class="count-up" data-target="45">0</span>
        </div>
        <div class="stat-trend trend-up">▲ 8% vs yesterday</div>
      </div>

      <!-- Revenue -->
      <div class="stat-card">
        <div class="glow-orb" style="background:var(--accent4);"></div>
        <div class="stat-icon" style="background:rgba(247,151,30,0.12); color:var(--accent4);">💰</div>
        <div class="stat-label">Revenue</div>
        <div class="stat-value" style="color:var(--accent4);">
          ₹<span class="count-up" data-target="84230">0</span>
        </div>
        <div class="stat-trend trend-up">▲ 5.2% vs last week</div>
      </div>

      <!-- Active Now -->
      <div class="stat-card">
        <div class="glow-orb" style="background:var(--accent2);"></div>
        <div class="stat-icon" style="background:rgba(255,101,132,0.12); color:var(--accent2);">⚡</div>
        <div class="stat-label">Active Now</div>
        <div class="stat-value" style="color:var(--accent2);">
          <span class="count-up" data-target="23">0</span>
        </div>
        <div class="stat-trend trend-down">▼ 3 left last hour</div>
      </div>
    </div>

    <!-- BOTTOM ROW -->
    <div class="bottom-row">

      <!-- Recent Users Table -->
      <div class="table-card">
        <div class="card-head">
          <span class="card-title">Recent Users</span>
          <span class="badge-new">LIVE</span>
        </div>
        <table class="activity-table">
          <thead>
            <tr>
              <th>User</th>
              <th>Role</th>
              <th>Joined</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>
                <div class="user-cell">
                  <div class="user-av" style="background:linear-gradient(135deg,#6c63ff,#a78bfa);">AS</div>
                  <div>
                    <div class="user-name">Aryan Sharma</div>
                    <div class="user-email">aryan@gmail.com</div>
                  </div>
                </div>
              </td>
              <td style="color:var(--muted); font-size:0.82rem;">Admin</td>
              <td style="color:var(--muted); font-size:0.82rem;">22 Feb 2026</td>
              <td><span class="status-pill s-active">Active</span></td>
            </tr>
            <tr>
              <td>
                <div class="user-cell">
                  <div class="user-av" style="background:linear-gradient(135deg,#ff6584,#ff8fa3);">PK</div>
                  <div>
                    <div class="user-name">Priya Kapoor</div>
                    <div class="user-email">priya@mail.com</div>
                  </div>
                </div>
              </td>
              <td style="color:var(--muted); font-size:0.82rem;">Author</td>
              <td style="color:var(--muted); font-size:0.82rem;">20 Feb 2026</td>
              <td><span class="status-pill s-active">Active</span></td>
            </tr>
            <tr>
              <td>
                <div class="user-cell">
                  <div class="user-av" style="background:linear-gradient(135deg,#f7971e,#ffd200);">RV</div>
                  <div>
                    <div class="user-name">Rohit Verma</div>
                    <div class="user-email">rohit@mail.com</div>
                  </div>
                </div>
              </td>
              <td style="color:var(--muted); font-size:0.82rem;">User</td>
              <td style="color:var(--muted); font-size:0.82rem;">18 Feb 2026</td>
              <td><span class="status-pill s-pending">Pending</span></td>
            </tr>
            <tr>
              <td>
                <div class="user-cell">
                  <div class="user-av" style="background:linear-gradient(135deg,#43e97b,#38f9d7);">SM</div>
                  <div>
                    <div class="user-name">Sneha Mehta</div>
                    <div class="user-email">sneha@mail.com</div>
                  </div>
                </div>
              </td>
              <td style="color:var(--muted); font-size:0.82rem;">User</td>
              <td style="color:var(--muted); font-size:0.82rem;">16 Feb 2026</td>
              <td><span class="status-pill s-inactive">Inactive</span></td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- RIGHT COLUMN -->
      <div class="right-col">

        <!-- Quick Actions -->
        <div class="quick-card">
          <div class="card-head">
            <span class="card-title">Quick Actions</span>
          </div>
          <div class="quick-actions-grid">
            <a href="#" class="qa-btn">
              <span class="qa-icon">👤</span>
              <span class="qa-label">Add User</span>
            </a>
            <a href="#" class="qa-btn">
              <span class="qa-icon">✍️</span>
              <span class="qa-label">New Post</span>
            </a>
            <a href="#" class="qa-btn">
              <span class="qa-icon">📊</span>
              <span class="qa-label">Reports</span>
            </a>
            <a href="#" class="qa-btn">
              <span class="qa-icon">⚙️</span>
              <span class="qa-label">Settings</span>
            </a>
          </div>
        </div>

        <!-- Role Breakdown Donut -->
        <div class="donut-card">
          <div class="card-title">User Breakdown</div>
          <div class="donut-wrap">
            <svg width="110" height="110" viewBox="0 0 110 110">
              <!-- Admin: 20% -->
              <circle cx="55" cy="55" r="40" fill="none" stroke="#6c63ff"
                stroke-width="14"
                stroke-dasharray="50.3 251.3"
                stroke-dashoffset="0" opacity="0.9"/>
              <!-- Author: 30% -->
              <circle cx="55" cy="55" r="40" fill="none" stroke="#ff6584"
                stroke-width="14"
                stroke-dasharray="75.4 251.3"
                stroke-dashoffset="-50.3" opacity="0.9"/>
              <!-- User: 50% -->
              <circle cx="55" cy="55" r="40" fill="none" stroke="#43e97b"
                stroke-width="14"
                stroke-dasharray="125.6 251.3"
                stroke-dashoffset="-125.7" opacity="0.9"/>
            </svg>
            <div class="donut-center">
              <span class="donut-pct">150</span>
              <span class="donut-sub">total</span>
            </div>
          </div>
          <div class="donut-legend">
            <div class="legend-item">
              <div class="legend-dot-label">
                <div class="legend-dot" style="background:var(--accent);"></div>
                <span style="color:var(--muted); font-size:0.8rem;">Admins</span>
              </div>
              <span class="legend-val">30</span>
            </div>
            <div class="legend-item">
              <div class="legend-dot-label">
                <div class="legend-dot" style="background:var(--accent2);"></div>
                <span style="color:var(--muted); font-size:0.8rem;">Authors</span>
              </div>
              <span class="legend-val">45</span>
            </div>
            <div class="legend-item">
              <div class="legend-dot-label">
                <div class="legend-dot" style="background:var(--accent3);"></div>
                <span style="color:var(--muted); font-size:0.8rem;">Users</span>
              </div>
              <span class="legend-val">75</span>
            </div>
          </div>
        </div>

      </div>
    </div>

  </div>
</div>

<script>
  // Live date
  const d = new Date();
  document.getElementById('live-date').textContent =
    d.toLocaleDateString('en-IN', { weekday:'short', day:'2-digit', month:'short', year:'numeric' });

  // Count up animation
  document.querySelectorAll('.count-up').forEach(el => {
    const target = +el.dataset.target;
    const duration = 1200;
    const step = target / (duration / 16);
    let current = 0;
    const timer = setInterval(() => {
      current = Math.min(current + step, target);
      el.textContent = Math.floor(current).toLocaleString('en-IN');
      if (current >= target) clearInterval(timer);
    }, 16);
  });
</script>

@endsection