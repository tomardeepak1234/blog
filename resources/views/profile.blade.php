@extends('admin.admin_meta')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=Karla:wght@300;400;500;600&display=swap');

    :root {
        --bg:       #0d0d14;
        --surface:  #13131f;
        --surface2: #1a1a2a;
        --surface3: #1f1f30;
        --border:   #252538;
        --accent:   #6c63ff;
        --accent2:  #a78bfa;
        --danger:   #ff4f6b;
        --danger-dim: rgba(255,79,107,0.12);
        --success:  #34d399;
        --success-dim: rgba(52,211,153,0.1);
        --amber:    #fbbf24;
        --sky:      #38bdf8;
        --text:     #e8e8f0;
        --muted:    #6b6b8a;
        --white:    #ffffff;
    }

    * { box-sizing: border-box; margin: 0; padding: 0; }

    .profile-wrapper {
        min-height: 100vh;
        background: var(--bg);
        font-family: 'Karla', sans-serif;
        color: var(--text);
        padding: 2.5rem 2rem;
        position: relative;
    }

    .profile-wrapper::before {
        content: '';
        position: fixed;
        top: -15%; right: 5%;
        width: 600px; height: 600px;
        background: radial-gradient(circle, rgba(108,99,255,0.07) 0%, transparent 65%);
        pointer-events: none; z-index: 0;
    }
    .profile-wrapper::after {
        content: '';
        position: fixed;
        bottom: -10%; left: -5%;
        width: 400px; height: 400px;
        background: radial-gradient(circle, rgba(52,211,153,0.03) 0%, transparent 65%);
        pointer-events: none; z-index: 0;
    }

    .profile-inner {
        max-width: 1000px;
        margin: 0 auto;
        position: relative;
        z-index: 1;
    }

    /* ── Animations ── */
    @keyframes fadeDown { from{opacity:0;transform:translateY(-14px)} to{opacity:1;transform:translateY(0)} }
    @keyframes fadeUp   { from{opacity:0;transform:translateY(16px)}  to{opacity:1;transform:translateY(0)} }
    @keyframes fadeIn   { from{opacity:0} to{opacity:1} }

    /* ── Page Header ── */
    .profile-page-header {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        margin-bottom: 2rem;
        flex-wrap: wrap;
        gap: 1rem;
        animation: fadeDown 0.5s ease forwards;
    }

    .profile-page-header .eyebrow {
        font-size: 0.68rem;
        font-weight: 500;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        color: var(--accent2);
        margin-bottom: 0.35rem;
    }

    .profile-page-header h1 {
        font-family: 'Syne', sans-serif;
        font-size: 1.9rem;
        font-weight: 800;
        color: var(--white);
        line-height: 1;
    }

    /* ── Toast ── */
    .profile-toast {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        background: var(--success-dim);
        border: 1px solid rgba(52,211,153,0.3);
        border-radius: 10px;
        padding: 0.8rem 1.2rem;
        margin-bottom: 1.5rem;
        color: var(--success);
        font-size: 0.88rem;
        font-weight: 500;
        animation: fadeDown 0.4s ease forwards;
    }

    .profile-toast .toast-close {
        margin-left: auto;
        background: none;
        border: none;
        color: var(--success);
        cursor: pointer;
        font-size: 1rem;
        padding: 0;
        opacity: 0.7;
        transition: opacity 0.2s;
    }
    .profile-toast .toast-close:hover { opacity: 1; }

    /* ── Main Layout ── */
    .profile-layout {
        display: grid;
        grid-template-columns: 300px 1fr;
        gap: 1.5rem;
        align-items: start;
    }

    @media (max-width: 860px) { .profile-layout { grid-template-columns: 1fr; } }

    /* ── Card Base ── */
    .profile-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 16px;
        overflow: hidden;
        animation: fadeUp 0.5s ease both;
    }

    .profile-card:nth-child(1) { animation-delay: 0.05s; }
    .profile-card:nth-child(2) { animation-delay: 0.10s; }
    .profile-card:nth-child(3) { animation-delay: 0.15s; }

    .card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 1.1rem 1.4rem;
        border-bottom: 1px solid var(--border);
        background: var(--surface2);
    }

    .card-title {
        font-family: 'Syne', sans-serif;
        font-size: 0.88rem;
        font-weight: 700;
        color: var(--white);
        display: flex;
        align-items: center;
        gap: 0.55rem;
    }

    .card-title .ct-icon {
        width: 28px; height: 28px;
        border-radius: 7px;
        display: flex; align-items: center; justify-content: center;
        font-size: 0.85rem;
        background: rgba(108,99,255,0.15);
        border: 1px solid rgba(108,99,255,0.2);
    }

    .card-body { padding: 1.4rem; }

    /* ── Left Column ── */
    .left-col {
        display: flex;
        flex-direction: column;
        gap: 1.25rem;
    }

    /* ── Avatar Card ── */
    .avatar-card-body {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 2rem 1.4rem 1.6rem;
        text-align: center;
    }

    .avatar-wrap {
        position: relative;
        width: 110px;
        height: 110px;
        margin-bottom: 1.2rem;
    }

    .avatar-img {
        width: 110px;
        height: 110px;
        border-radius: 22px;
        object-fit: cover;
        border: 3px solid var(--border);
        display: block;
        background: linear-gradient(135deg, var(--accent), var(--accent2));
    }

    .avatar-initials {
        width: 110px;
        height: 110px;
        border-radius: 22px;
        background: linear-gradient(135deg, var(--accent), var(--accent2));
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Syne', sans-serif;
        font-size: 2.2rem;
        font-weight: 800;
        color: var(--white);
        border: 3px solid rgba(108,99,255,0.3);
        box-shadow: 0 0 30px rgba(108,99,255,0.25);
    }

    .avatar-edit-btn {
        position: absolute;
        bottom: -8px;
        right: -8px;
        width: 34px; height: 34px;
        border-radius: 10px;
        background: var(--accent);
        border: 2px solid var(--bg);
        display: flex; align-items: center; justify-content: center;
        cursor: pointer;
        transition: all 0.2s;
        box-shadow: 0 0 12px rgba(108,99,255,0.4);
    }
    .avatar-edit-btn:hover {
        background: #7c74ff;
        transform: scale(1.1);
        box-shadow: 0 0 20px rgba(108,99,255,0.6);
    }

    .avatar-edit-btn input[type="file"] {
        position: absolute;
        inset: 0;
        opacity: 0;
        cursor: pointer;
        width: 100%;
        height: 100%;
        border-radius: 10px;
    }

    .profile-name {
        font-family: 'Syne', sans-serif;
        font-size: 1.15rem;
        font-weight: 800;
        color: var(--white);
        margin-bottom: 0.3rem;
    }

    .profile-email {
        font-size: 0.78rem;
        color: var(--muted);
        margin-bottom: 0.75rem;
    }

    .profile-role-badge {
        display: inline-block;
        padding: 0.22rem 0.75rem;
        border-radius: 20px;
        font-size: 0.7rem;
        font-weight: 600;
        letter-spacing: 0.06em;
        background: rgba(108,99,255,0.12);
        color: var(--accent2);
        border: 1px solid rgba(108,99,255,0.25);
        margin-bottom: 1.2rem;
    }

    .avatar-upload-hint {
        font-size: 0.72rem;
        color: var(--muted);
        text-align: center;
        line-height: 1.5;
        padding: 0.75rem 1rem;
        border-top: 1px solid var(--border);
        width: 100%;
    }

    /* ── Stats Card ── */
    .stats-grid-mini {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0.6rem;
        padding: 1rem 1.2rem 1.2rem;
    }

    .stat-mini {
        background: var(--surface2);
        border: 1px solid var(--border);
        border-radius: 10px;
        padding: 0.9rem 0.8rem;
        text-align: center;
        transition: border-color 0.2s;
    }
    .stat-mini:hover { border-color: rgba(108,99,255,0.3); }

    .stat-mini-value {
        font-family: 'Syne', sans-serif;
        font-size: 1.5rem;
        font-weight: 800;
        color: var(--white);
        line-height: 1;
        margin-bottom: 0.3rem;
    }

    .stat-mini-label {
        font-size: 0.65rem;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: var(--muted);
        font-weight: 500;
    }

    /* ── Right Column ── */
    .right-col {
        display: flex;
        flex-direction: column;
        gap: 1.25rem;
    }

    /* ── Tabs ── */
    .profile-tabs {
        display: flex;
        gap: 0.35rem;
        padding: 0.7rem 1.4rem;
        border-bottom: 1px solid var(--border);
        background: var(--surface2);
        flex-wrap: wrap;
    }

    .tab-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.42rem 0.9rem;
        border: 1px solid transparent;
        border-radius: 8px;
        font-family: 'Karla', sans-serif;
        font-size: 0.78rem;
        font-weight: 500;
        cursor: pointer;
        background: transparent;
        color: var(--muted);
        transition: all 0.18s;
    }

    .tab-btn.active,
    .tab-btn:hover {
        background: rgba(108,99,255,0.12);
        border-color: rgba(108,99,255,0.25);
        color: var(--accent2);
    }

    .tab-content { display: none; padding: 1.4rem; }
    .tab-content.active { display: block; }

    /* ── Fields ── */
    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
        margin-bottom: 1.1rem;
    }

    .form-row.full { grid-template-columns: 1fr; }

    @media (max-width: 600px) { .form-row { grid-template-columns: 1fr; } }

    .field-group { display: flex; flex-direction: column; }

    .field-label {
        font-size: 0.67rem;
        font-weight: 600;
        letter-spacing: 0.14em;
        text-transform: uppercase;
        color: var(--muted);
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }
    .field-label .req { color: var(--danger); }

    .field-input {
        padding: 0.75rem 0.95rem;
        background: var(--surface2);
        border: 1.5px solid var(--border);
        border-radius: 9px;
        color: var(--text);
        font-family: 'Karla', sans-serif;
        font-size: 0.9rem;
        outline: none;
        transition: all 0.2s;
        width: 100%;
    }
    .field-input:focus {
        border-color: var(--accent);
        box-shadow: 0 0 0 3px rgba(108,99,255,0.12);
        background: #1c1c2e;
    }
    .field-input::placeholder { color: var(--muted); }
    .field-input:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    .field-hint {
        font-size: 0.7rem;
        color: var(--muted);
        margin-top: 0.35rem;
    }

    /* Password strength */
    .password-strength {
        margin-top: 0.45rem;
    }

    .strength-bar-bg {
        height: 4px;
        background: var(--surface2);
        border-radius: 4px;
        overflow: hidden;
        margin-bottom: 0.3rem;
    }

    .strength-bar-fill {
        height: 100%;
        border-radius: 4px;
        transition: width 0.4s ease, background 0.4s ease;
        width: 0%;
    }

    .strength-text {
        font-size: 0.68rem;
        font-weight: 500;
    }

    /* Toggle password */
    .input-eye-wrap {
        position: relative;
    }
    .input-eye-wrap .field-input { padding-right: 2.5rem; }
    .eye-toggle {
        position: absolute;
        right: 0.75rem;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        cursor: pointer;
        color: var(--muted);
        padding: 0;
        display: flex; align-items: center; justify-content: center;
        transition: color 0.2s;
    }
    .eye-toggle:hover { color: var(--accent2); }

    /* ── Section label ── */
    .section-label {
        font-family: 'Syne', sans-serif;
        font-size: 0.7rem;
        font-weight: 700;
        letter-spacing: 0.14em;
        text-transform: uppercase;
        color: var(--muted);
        padding-bottom: 0.6rem;
        border-bottom: 1px solid var(--border);
        margin-bottom: 1rem;
    }

    /* ── Form footer ── */
    .form-footer {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding-top: 1.2rem;
        border-top: 1px solid var(--border);
        margin-top: 0.5rem;
        flex-wrap: wrap;
    }

    .btn-save {
        display: inline-flex;
        align-items: center;
        gap: 0.45rem;
        padding: 0.75rem 1.8rem;
        background: var(--accent);
        color: var(--white);
        font-family: 'Karla', sans-serif;
        font-size: 0.84rem;
        font-weight: 600;
        border: none;
        border-radius: 9px;
        cursor: pointer;
        transition: all 0.2s;
        box-shadow: 0 0 20px rgba(108,99,255,0.3);
    }
    .btn-save:hover {
        background: #7c74ff;
        box-shadow: 0 0 28px rgba(108,99,255,0.5);
        transform: translateY(-1px);
    }

    .btn-reset {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.75rem 1.3rem;
        background: transparent;
        color: var(--muted);
        font-family: 'Karla', sans-serif;
        font-size: 0.84rem;
        font-weight: 500;
        border: 1px solid var(--border);
        border-radius: 9px;
        cursor: pointer;
        transition: all 0.2s;
    }
    .btn-reset:hover {
        border-color: var(--muted);
        color: var(--text);
    }

    /* ── Danger Zone ── */
    .danger-zone {
        background: var(--danger-dim);
        border: 1px solid rgba(255,79,107,0.25);
        border-radius: 12px;
        padding: 1.2rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .danger-zone-info h4 {
        font-family: 'Syne', sans-serif;
        font-size: 0.85rem;
        font-weight: 700;
        color: var(--danger);
        margin-bottom: 0.25rem;
    }

    .danger-zone-info p {
        font-size: 0.78rem;
        color: var(--muted);
        line-height: 1.5;
    }

    .btn-danger {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.65rem 1.2rem;
        background: transparent;
        color: var(--danger);
        font-family: 'Karla', sans-serif;
        font-size: 0.8rem;
        font-weight: 600;
        border: 1px solid rgba(255,79,107,0.35);
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.2s;
        white-space: nowrap;
        text-decoration: none;
    }
    .btn-danger:hover {
        background: rgba(255,79,107,0.15);
        border-color: rgba(255,79,107,0.6);
        color: var(--danger);
    }

    /* ── Activity List ── */
    .activity-list { display: flex; flex-direction: column; gap: 0.5rem; }

    .activity-item {
        display: flex;
        align-items: center;
        gap: 0.85rem;
        padding: 0.75rem 0.9rem;
        background: var(--surface2);
        border: 1px solid var(--border);
        border-radius: 10px;
        transition: border-color 0.15s;
    }
    .activity-item:hover { border-color: rgba(108,99,255,0.25); }

    .activity-icon {
        width: 34px; height: 34px;
        border-radius: 9px;
        display: flex; align-items: center; justify-content: center;
        font-size: 0.9rem;
        flex-shrink: 0;
    }

    .activity-text { flex: 1; min-width: 0; }
    .activity-text .a-title { font-size: 0.82rem; color: var(--text); font-weight: 500; }
    .activity-text .a-sub  { font-size: 0.7rem; color: var(--muted); margin-top: 0.1rem; }
    .activity-time { font-size: 0.68rem; color: var(--muted); flex-shrink: 0; }

    /* ── Delete Modal ── */
    #deleteModal {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.65);
        backdrop-filter: blur(4px);
        z-index: 9999;
        align-items: center;
        justify-content: center;
    }

    @media (max-width: 600px) {
        .profile-wrapper { padding: 1.5rem 1rem; }
        .profile-page-header h1 { font-size: 1.5rem; }
    }
</style>

<div class="profile-wrapper">
<div class="profile-inner">

    {{-- Page Header --}}
    <div class="profile-page-header">
        <div>
            <p class="eyebrow">Admin Panel</p>
            <h1>My Profile</h1>
        </div>
    </div>

    {{-- Toast --}}
    @if(session('success'))
    <div class="profile-toast" id="profile-toast">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
        {{ session('success') }}
        <button class="toast-close" onclick="document.getElementById('profile-toast').remove()">✕</button>
    </div>
    @endif

    <div class="profile-layout">

        {{-- ═══ LEFT COLUMN ═══ --}}
        <div class="left-col">

            {{-- Avatar Card --}}
            <div class="profile-card">
                <div class="card-header">
                    <div class="card-title">
                        <div class="ct-icon">👤</div>
                        Profile Photo
                    </div>
                </div>

                <form action="{{ route('profile.avatar') }}" method="POST" enctype="multipart/form-data" id="avatarForm">
                    @csrf
                    @method('PUT')

                    <div class="avatar-card-body">
                        <div class="avatar-wrap">
                            {{-- Show image if exists, else initials --}}
                            @if(Auth::user()->avatar)
                                <img
                                    src="{{ asset('storage/' . Auth::user()->avatar) }}"
                                    alt="Profile"
                                    class="avatar-img"
                                    id="avatarPreview"
                                >
                            @else
                                <div class="avatar-initials" id="avatarInitials">
                                    {{ strtoupper(substr(Auth::user()->first_name ?? Auth::user()->name ?? 'U', 0, 2)) }}
                                </div>
                                <img src="" alt="" class="avatar-img" id="avatarPreview" style="display:none;">
                            @endif

                            {{-- Edit button --}}
                            <div class="avatar-edit-btn" title="Change photo">
                                <input
                                    type="file"
                                    name="avatar"
                                    accept="image/*"
                                    onchange="previewAvatar(this)"
                                >
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                            </div>
                        </div>

                        <div class="profile-name">{{ Auth::user()->first_name ?? Auth::user()->name ?? 'User' }} {{ Auth::user()->last_name ?? '' }}</div>
                        <div class="profile-email">{{ Auth::user()->email }}</div>

                        @if(Auth::user()->role?->name)
                            <span class="profile-role-badge">{{ Auth::user()->role->name }}</span>
                        @endif

                        {{-- Save avatar button - shown after selection --}}
                        <button type="submit" class="btn-save" id="avatarSaveBtn" style="display:none; width:100%; justify-content:center;">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                            Upload Photo
                        </button>
                    </div>

                    <div class="avatar-upload-hint">
                        JPG, PNG or WEBP · Max 2MB · Recommended 400×400
                    </div>
                </form>
            </div>

            {{-- Stats Card --}}
            <div class="profile-card">
                <div class="card-header">
                    <div class="card-title">
                        <div class="ct-icon">📊</div>
                        My Stats
                    </div>
                </div>
                <div class="stats-grid-mini">
                    <div class="stat-mini">
                        <div class="stat-mini-value" style="color: var(--accent2);">
                            {{ Auth::user()->posts->count() ?? 0 }}
                        </div>
                        <div class="stat-mini-label">Posts</div>
                    </div>
                    <div class="stat-mini">
                        <div class="stat-mini-value" style="color: var(--success);">
                            {{ Auth::user()->posts->sum(fn($p) => $p->likes->count()) ?? 0 }}
                        </div>
                        <div class="stat-mini-label">Likes</div>
                    </div>
                    <div class="stat-mini">
                        <div class="stat-mini-value" style="color: var(--amber);">
                            {{ Auth::user()->posts->sum(fn($p) => $p->comments->count()) ?? 0 }}
                        </div>
                        <div class="stat-mini-label">Comments</div>
                    </div>
                    <div class="stat-mini">
                        <div class="stat-mini-value" style="color: var(--sky);">
                            {{ Auth::user()->created_at->diffInDays(now()) }}
                        </div>
                        <div class="stat-mini-label">Days Active</div>
                    </div>
                </div>
            </div>

        </div>

        {{-- ═══ RIGHT COLUMN ═══ --}}
        <div class="right-col">

            {{-- Tabbed Card --}}
            <div class="profile-card">

                {{-- Tabs --}}
                <div class="profile-tabs">
                    <button class="tab-btn active" onclick="switchTab('personal', this)">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        Personal Info
                    </button>
                    <button class="tab-btn" onclick="switchTab('password', this)">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                        Password
                    </button>
                    <button class="tab-btn" onclick="switchTab('activity', this)">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
                        Activity
                    </button>
                    <button class="tab-btn" onclick="switchTab('danger', this)">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                        Danger Zone
                    </button>
                </div>

                {{-- ── Tab: Personal Info ── --}}
                <div class="tab-content active" id="tab-personal">
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <p class="section-label">Basic Information</p>

                        <div class="form-row">
                            <div class="field-group">
                                <label class="field-label" for="first_name">First Name <span class="req">*</span></label>
                                <input type="text" id="first_name" name="first_name"
                                    class="field-input"
                                    value="{{ Auth::user()->first_name ?? '' }}"
                                    placeholder="First name" required>
                            </div>
                            <div class="field-group">
                                <label class="field-label" for="last_name">Last Name</label>
                                <input type="text" id="last_name" name="last_name"
                                    class="field-input"
                                    value="{{ Auth::user()->last_name ?? '' }}"
                                    placeholder="Last name">
                            </div>
                        </div>

                        <div class="form-row full">
                            <div class="field-group">
                                <label class="field-label" for="email">Email Address <span class="req">*</span></label>
                                <input type="email" id="email" name="email"
                                    class="field-input"
                                    value="{{ Auth::user()->email }}"
                                    placeholder="your@email.com" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="field-group">
                                <label class="field-label" for="phone">Phone Number</label>
                                <input type="tel" id="phone" name="phone"
                                    class="field-input"
                                    value="{{ Auth::user()->phone ?? '' }}"
                                    placeholder="+91 99999 00000">
                            </div>
                            <div class="field-group">
                                <label class="field-label" for="username">Username</label>
                                <input type="text" id="username" name="username"
                                    class="field-input"
                                    value="{{ Auth::user()->username ?? '' }}"
                                    placeholder="@username">
                            </div>
                        </div>

                        <p class="section-label" style="margin-top: 1.2rem;">Additional Details</p>

                        <div class="form-row full">
                            <div class="field-group">
                                <label class="field-label" for="bio">Bio</label>
                                <textarea id="bio" name="bio"
                                    class="field-input"
                                    rows="3"
                                    placeholder="Write a short bio about yourself..."
                                    maxlength="300"
                                    oninput="bioCount(this)">{{ Auth::user()->bio ?? '' }}</textarea>
                                <div style="display:flex; justify-content:flex-end; margin-top:0.3rem;">
                                    <span class="field-hint" id="bio-count">0 / 300</span>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="field-group">
                                <label class="field-label" for="website">Website</label>
                                <input type="url" id="website" name="website"
                                    class="field-input"
                                    value="{{ Auth::user()->website ?? '' }}"
                                    placeholder="https://yoursite.com">
                            </div>
                            <div class="field-group">
                                <label class="field-label" for="location">Location</label>
                                <input type="text" id="location" name="location"
                                    class="field-input"
                                    value="{{ Auth::user()->location ?? '' }}"
                                    placeholder="City, Country">
                            </div>
                        </div>

                        <div class="form-row full">
                            <div class="field-group">
                                <label class="field-label" for="role_display">Role</label>
                                <input type="text" id="role_display"
                                    class="field-input"
                                    value="{{ Auth::user()->role->name ?? 'No Role Assigned' }}"
                                    disabled>
                                <span class="field-hint">Role is assigned by administrator</span>
                            </div>
                        </div>

                        <div class="form-footer">
                            <button type="submit" class="btn-save">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/></svg>
                                Save Changes
                            </button>
                            <button type="reset" class="btn-reset">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 1 0 .49-4.31"/></svg>
                                Reset
                            </button>
                        </div>
                    </form>
                </div>

                {{-- ── Tab: Password ── --}}
                <div class="tab-content" id="tab-password">
                    <form action="{{ route('profile.password') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <p class="section-label">Change Password</p>

                        <div class="form-row full" style="margin-bottom:1.1rem;">
                            <div class="field-group">
                                <label class="field-label" for="current_password">Current Password <span class="req">*</span></label>
                                <div class="input-eye-wrap">
                                    <input type="password" id="current_password" name="current_password"
                                        class="field-input" placeholder="Enter current password" required>
                                    <button type="button" class="eye-toggle" onclick="togglePass('current_password', this)">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="form-row full" style="margin-bottom:1.1rem;">
                            <div class="field-group">
                                <label class="field-label" for="new_password">New Password <span class="req">*</span></label>
                                <div class="input-eye-wrap">
                                    <input type="password" id="new_password" name="new_password"
                                        class="field-input" placeholder="Min 8 characters" required
                                        oninput="checkStrength(this)">
                                    <button type="button" class="eye-toggle" onclick="togglePass('new_password', this)">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                    </button>
                                </div>
                                <div class="password-strength" id="strengthWrap" style="display:none;">
                                    <div class="strength-bar-bg">
                                        <div class="strength-bar-fill" id="strengthBar"></div>
                                    </div>
                                    <span class="strength-text" id="strengthText"></span>
                                </div>
                            </div>
                        </div>

                        <div class="form-row full" style="margin-bottom:1.1rem;">
                            <div class="field-group">
                                <label class="field-label" for="new_password_confirmation">Confirm New Password <span class="req">*</span></label>
                                <div class="input-eye-wrap">
                                    <input type="password" id="new_password_confirmation" name="new_password_confirmation"
                                        class="field-input" placeholder="Repeat new password" required
                                        oninput="checkMatch(this)">
                                    <button type="button" class="eye-toggle" onclick="togglePass('new_password_confirmation', this)">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                    </button>
                                </div>
                                <span class="field-hint" id="matchHint"></span>
                            </div>
                        </div>

                        <div class="form-footer">
                            <button type="submit" class="btn-save">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                                Update Password
                            </button>
                        </div>
                    </form>
                </div>

                {{-- ── Tab: Activity ── --}}
                <div class="tab-content" id="tab-activity">
                    <p class="section-label">Recent Activity</p>
                    <div class="activity-list">

                        {{-- Account created --}}
                        <div class="activity-item">
                            <div class="activity-icon" style="background:rgba(108,99,255,0.12);">🎉</div>
                            <div class="activity-text">
                                <div class="a-title">Account Created</div>
                                <div class="a-sub">You joined the platform</div>
                            </div>
                            <span class="activity-time">{{ Auth::user()->created_at->format('d M Y') }}</span>
                        </div>

                        {{-- Recent posts --}}
                        @forelse(Auth::user()->posts->sortByDesc('created_at')->take(4) as $post)
                        <div class="activity-item">
                            <div class="activity-icon" style="background:rgba(52,211,153,0.1);">📝</div>
                            <div class="activity-text">
                                <div class="a-title">Published a Post</div>
                                <div class="a-sub">{{ Str::limit($post->title, 45) }}</div>
                            </div>
                            <span class="activity-time">{{ $post->created_at->diffForHumans() }}</span>
                        </div>
                        @empty
                        <div class="activity-item">
                            <div class="activity-icon" style="background:rgba(107,107,138,0.1);">📭</div>
                            <div class="activity-text">
                                <div class="a-title">No posts yet</div>
                                <div class="a-sub">Start writing your first post</div>
                            </div>
                            <span class="activity-time">—</span>
                        </div>
                        @endforelse

                        {{-- Last login --}}
                        <div class="activity-item">
                            <div class="activity-icon" style="background:rgba(251,191,36,0.1);">🔑</div>
                            <div class="activity-text">
                                <div class="a-title">Last Login</div>
                                <div class="a-sub">Successful authentication</div>
                            </div>
                            <span class="activity-time">{{ Auth::user()->updated_at->diffForHumans() }}</span>
                        </div>

                    </div>
                </div>

                {{-- ── Tab: Danger Zone ── --}}
                <div class="tab-content" id="tab-danger">
                    <p class="section-label">Danger Zone</p>

                    <div style="display:flex; flex-direction:column; gap:0.9rem;">

                        {{-- Deactivate --}}
                        <div class="danger-zone">
                            <div class="danger-zone-info">
                                <h4>Deactivate Account</h4>
                                <p>Temporarily disable your account. You can reactivate it by logging in again.</p>
                            </div>
                            <button type="button" class="btn-danger">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18.36 6.64a9 9 0 1 1-12.73 0"/><line x1="12" y1="2" x2="12" y2="12"/></svg>
                                Deactivate
                            </button>
                        </div>

                        {{-- Delete account --}}
                        <div class="danger-zone">
                            <div class="danger-zone-info">
                                <h4>Delete Account</h4>
                                <p>Permanently delete your account and all associated data. This cannot be undone.</p>
                            </div>
                            <button type="button" class="btn-danger" onclick="openDeleteModal()">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M9 6V4h6v2"/></svg>
                                Delete Account
                            </button>
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
</div>

{{-- ── Delete Account Modal ── --}}
<div id="deleteModal" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.7); backdrop-filter:blur(4px); z-index:9999; align-items:center; justify-content:center;">
    <div style="background:#1a1a2a; border:1px solid #252538; border-radius:16px; padding:2rem; max-width:400px; width:90%; text-align:center;">
        <div style="width:56px;height:56px;background:rgba(255,79,107,0.12);border-radius:14px;margin:0 auto 1.2rem;display:flex;align-items:center;justify-content:center;">
            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#ff4f6b" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
        </div>
        <h3 style="font-family:'Syne',sans-serif;font-size:1.1rem;color:#fff;margin-bottom:0.5rem;">Delete Your Account?</h3>
        <p style="font-size:0.82rem;color:#6b6b8a;margin-bottom:1rem;line-height:1.6;">This will permanently delete your account, posts, and all data. Type <strong style="color:#ff4f6b;">DELETE</strong> to confirm.</p>
        <input type="text" id="deleteConfirmInput" placeholder="Type DELETE to confirm"
            style="width:100%;padding:0.65rem 0.9rem;background:#13131f;border:1.5px solid #252538;border-radius:8px;color:#e8e8f0;font-family:'Karla',sans-serif;font-size:0.85rem;outline:none;margin-bottom:1.2rem;transition:border-color 0.2s;"
            oninput="checkDeleteConfirm(this)">
        <div style="display:flex;gap:0.75rem;justify-content:center;">
            <button onclick="closeDeleteModal()" style="padding:0.65rem 1.4rem;background:transparent;border:1px solid #252538;color:#6b6b8a;border-radius:8px;font-family:'Karla',sans-serif;font-size:0.85rem;cursor:pointer;">Cancel</button>
            <form action="{{ route('profile.destroy') }}" method="POST" id="deleteAccountForm">
                @csrf
                @method('DELETE')
                <button type="submit" id="deleteConfirmBtn"
                    style="padding:0.65rem 1.4rem;background:#ff4f6b;border:none;color:#fff;border-radius:8px;font-family:'Karla',sans-serif;font-size:0.85rem;cursor:pointer;font-weight:600;opacity:0.4;pointer-events:none;transition:all 0.2s;">
                    Delete Forever
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    // Toast auto dismiss
    const toast = document.getElementById('profile-toast');
    if (toast) setTimeout(() => toast.remove(), 4000);

    // Tab switching
    function switchTab(name, btn) {
        document.querySelectorAll('.tab-content').forEach(t => t.classList.remove('active'));
        document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
        document.getElementById('tab-' + name).classList.add('active');
        btn.classList.add('active');
    }

    // Avatar preview
    function previewAvatar(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = e => {
                const preview = document.getElementById('avatarPreview');
                const initials = document.getElementById('avatarInitials');
                preview.src = e.target.result;
                preview.style.display = 'block';
                if (initials) initials.style.display = 'none';
                document.getElementById('avatarSaveBtn').style.display = 'inline-flex';
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Bio count
    function bioCount(el) {
        const count = document.getElementById('bio-count');
        count.textContent = `${el.value.length} / 300`;
    }
    // init bio count
    const bioEl = document.getElementById('bio');
    if (bioEl && bioEl.value) bioCount(bioEl);

    // Password strength
    function checkStrength(input) {
        const val = input.value;
        const wrap = document.getElementById('strengthWrap');
        const bar  = document.getElementById('strengthBar');
        const text = document.getElementById('strengthText');

        if (!val) { wrap.style.display = 'none'; return; }
        wrap.style.display = 'block';

        let score = 0;
        if (val.length >= 8)              score++;
        if (/[A-Z]/.test(val))            score++;
        if (/[0-9]/.test(val))            score++;
        if (/[^A-Za-z0-9]/.test(val))     score++;

        const levels = [
            { pct: '25%', color: '#ff4f6b', label: 'Weak',    style: 'color: #ff4f6b' },
            { pct: '50%', color: '#fbbf24', label: 'Fair',    style: 'color: #fbbf24' },
            { pct: '75%', color: '#38bdf8', label: 'Good',    style: 'color: #38bdf8' },
            { pct: '100%',color: '#34d399', label: 'Strong',  style: 'color: #34d399' },
        ];
        const lvl = levels[score - 1] || levels[0];
        bar.style.width = lvl.pct;
        bar.style.background = lvl.color;
        text.textContent = lvl.label;
        text.style.cssText = lvl.style;
    }

    // Confirm match
    function checkMatch(input) {
        const hint = document.getElementById('matchHint');
        const newPass = document.getElementById('new_password').value;
        if (!input.value) { hint.textContent = ''; return; }
        if (input.value === newPass) {
            hint.textContent = '✓ Passwords match';
            hint.style.color = 'var(--success)';
        } else {
            hint.textContent = '✕ Passwords do not match';
            hint.style.color = 'var(--danger)';
        }
    }

    // Toggle password visibility
    function togglePass(id, btn) {
        const input = document.getElementById(id);
        const isText = input.type === 'text';
        input.type = isText ? 'password' : 'text';
        btn.style.color = isText ? 'var(--muted)' : 'var(--accent2)';
    }

    // Delete modal
    function openDeleteModal() {
        document.getElementById('deleteModal').style.display = 'flex';
        document.getElementById('deleteConfirmInput').value = '';
        const btn = document.getElementById('deleteConfirmBtn');
        btn.style.opacity = '0.4';
        btn.style.pointerEvents = 'none';
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').style.display = 'none';
    }

    function checkDeleteConfirm(input) {
        const btn = document.getElementById('deleteConfirmBtn');
        if (input.value === 'DELETE') {
            btn.style.opacity = '1';
            btn.style.pointerEvents = 'auto';
            input.style.borderColor = 'var(--danger)';
        } else {
            btn.style.opacity = '0.4';
            btn.style.pointerEvents = 'none';
            input.style.borderColor = '#252538';
        }
    }

    document.getElementById('deleteModal').addEventListener('click', function(e) {
        if (e.target === this) closeDeleteModal();
    });
</script>

@endsection