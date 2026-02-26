@extends('admin.admin_meta')

@section('content')

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=Karla:wght@300;400;500&display=swap');

        :root {
            --bg: #0d0d14;
            --surface: #13131f;
            --surface2: #1a1a2a;
            --border: #252538;
            --accent: #6c63ff;
            --accent2: #a78bfa;
            --danger: #ff4f6b;
            --danger-dim: rgba(255, 79, 107, 0.12);
            --success: #34d399;
            --success-dim: rgba(52, 211, 153, 0.1);
            --amber: #fbbf24;
            --amber-dim: rgba(251, 191, 36, 0.1);
            --sky: #38bdf8;
            --sky-dim: rgba(56, 189, 248, 0.1);
            --text: #e8e8f0;
            --muted: #6b6b8a;
            --white: #ffffff;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        .db-wrapper {
            min-height: 100vh;
            background: var(--bg);
            font-family: 'Karla', sans-serif;
            padding: 2.5rem 2rem;
            color: var(--text);
            position: relative;
            overflow-x: hidden;
            left: 4%;
        }

        /* Ambient blobs */
        .db-wrapper::before {
            content: '';
            position: fixed;
            top: -15%;
            right: 10%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(108, 99, 255, 0.07) 0%, transparent 65%);
            pointer-events: none;
            z-index: 0;
        }

        .db-wrapper::after {
            content: '';
            position: fixed;
            bottom: -10%;
            left: -5%;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(52, 211, 153, 0.04) 0%, transparent 65%);
            pointer-events: none;
            z-index: 0;
        }

        .db-inner {
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        /* ── Animations ── */
        @keyframes fadeDown {
            from {
                opacity: 0;
                transform: translateY(-14px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(18px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes pulseGlow {

            0%,
            100% {
                box-shadow: 0 0 18px rgba(108, 99, 255, 0.3);
            }

            50% {
                box-shadow: 0 0 32px rgba(108, 99, 255, 0.55);
            }
        }

        @keyframes countUp {
            from {
                opacity: 0;
                transform: translateY(8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ── Header ── */
        .db-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            margin-bottom: 2.5rem;
            flex-wrap: wrap;
            gap: 1rem;
            animation: fadeDown 0.5s ease forwards;
        }

        .db-header-left .greeting {
            font-size: 0.68rem;
            font-weight: 500;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--accent2);
            margin-bottom: 0.4rem;
        }

        .db-header-left h1 {
            font-family: 'Syne', sans-serif;
            font-size: 2.1rem;
            font-weight: 800;
            color: var(--white);
            line-height: 1;
        }

        .db-header-left h1 span {
            background: linear-gradient(90deg, var(--accent2), var(--sky));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .db-header-right {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .live-dot {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            background: var(--success-dim);
            border: 1px solid rgba(52, 211, 153, 0.25);
            border-radius: 20px;
            font-size: 0.75rem;
            color: var(--success);
            font-weight: 500;
        }

        .live-dot::before {
            content: '';
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: var(--success);
            animation: pulseGlow 2s infinite;
            box-shadow: 0 0 6px var(--success);
        }

        .date-chip {
            padding: 0.5rem 1rem;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 20px;
            font-size: 0.75rem;
            color: var(--muted);
            font-weight: 500;
        }

        /* ── Stat Cards ── */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .stat-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 1.5rem;
            position: relative;
            overflow: hidden;
            transition: transform 0.2s ease, border-color 0.2s ease;
            animation: fadeUp 0.5s ease both;
        }

        .stat-card:nth-child(1) {
            animation-delay: 0.05s;
        }

        .stat-card:nth-child(2) {
            animation-delay: 0.10s;
        }

        .stat-card:nth-child(3) {
            animation-delay: 0.15s;
        }

        .stat-card:nth-child(4) {
            animation-delay: 0.20s;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            border-color: rgba(108, 99, 255, 0.3);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            border-radius: 16px 16px 0 0;
        }

        .stat-card.c-purple::before {
            background: linear-gradient(90deg, var(--accent), var(--accent2));
        }

        .stat-card.c-green::before {
            background: linear-gradient(90deg, var(--success), #6ee7b7);
        }

        .stat-card.c-amber::before {
            background: linear-gradient(90deg, var(--amber), #fde68a);
        }

        .stat-card.c-sky::before {
            background: linear-gradient(90deg, var(--sky), #bae6fd);
        }

        .stat-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1rem;
        }

        .stat-icon {
            width: 42px;
            height: 42px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
        }

        .stat-icon.c-purple {
            background: rgba(108, 99, 255, 0.15);
        }

        .stat-icon.c-green {
            background: rgba(52, 211, 153, 0.12);
        }

        .stat-icon.c-amber {
            background: var(--amber-dim);
        }

        .stat-icon.c-sky {
            background: var(--sky-dim);
        }

        .stat-trend {
            display: flex;
            align-items: center;
            gap: 0.3rem;
            font-size: 0.72rem;
            font-weight: 600;
            padding: 0.2rem 0.55rem;
            border-radius: 20px;
        }

        .stat-trend.up {
            color: var(--success);
            background: var(--success-dim);
        }

        .stat-trend.down {
            color: var(--danger);
            background: var(--danger-dim);
        }

        .stat-trend.neu {
            color: var(--muted);
            background: var(--surface2);
        }

        .stat-value {
            font-family: 'Syne', sans-serif;
            font-size: 2.2rem;
            font-weight: 800;
            color: var(--white);
            line-height: 1;
            margin-bottom: 0.35rem;
            animation: countUp 0.6s ease forwards;
        }

        .stat-label {
            font-size: 0.75rem;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 0.1em;
            font-weight: 500;
        }

        .stat-sub {
            margin-top: 0.8rem;
            padding-top: 0.8rem;
            border-top: 1px solid var(--border);
            font-size: 0.76rem;
            color: var(--muted);
        }

        .stat-sub span {
            color: var(--text);
            font-weight: 500;
        }

        /* ── Mid Row ── */
        .mid-grid {
            display: grid;
            grid-template-columns: 1fr 340px;
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }

        @media (max-width: 900px) {
            .mid-grid {
                grid-template-columns: 1fr;
            }
        }

        /* ── Card base ── */
        .db-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 16px;
            overflow: hidden;
            animation: fadeUp 0.5s 0.25s ease both;
        }

        .db-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1.2rem 1.5rem;
            border-bottom: 1px solid var(--border);
            gap: 0.75rem;
            flex-wrap: wrap;
        }

        .db-card-title {
            font-family: 'Syne', sans-serif;
            font-size: 0.9rem;
            font-weight: 700;
            color: var(--white);
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }

        .db-card-title .ct-icon {
            width: 28px;
            height: 28px;
            border-radius: 7px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.85rem;
            background: rgba(108, 99, 255, 0.15);
        }

        .view-all-link {
            font-size: 0.75rem;
            color: var(--accent2);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
        }

        .view-all-link:hover {
            color: var(--white);
        }

        /* ── Recent Posts Table ── */
        .mini-table {
            width: 100%;
            border-collapse: collapse;
        }

        .mini-table thead th {
            padding: 0.7rem 1.2rem;
            font-family: 'Syne', sans-serif;
            font-size: 0.64rem;
            font-weight: 600;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--muted);
            border-bottom: 1px solid var(--border);
            background: var(--surface2);
        }

        .mini-table tbody tr {
            border-bottom: 1px solid var(--border);
            transition: background 0.15s;
        }

        .mini-table tbody tr:hover {
            background: rgba(108, 99, 255, 0.04);
        }

        .mini-table tbody tr:last-child {
            border-bottom: none;
        }

        .mini-table tbody td {
            padding: 0.85rem 1.2rem;
            font-size: 0.84rem;
            color: var(--text);
            vertical-align: middle;
        }

        .post-mini-thumb {
            width: 38px;
            height: 38px;
            object-fit: cover;
            border-radius: 7px;
            border: 1px solid var(--border);
            display: block;
        }

        .post-mini-no-img {
            width: 38px;
            height: 38px;
            border-radius: 7px;
            background: var(--surface2);
            border: 1px dashed var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            color: var(--muted);
        }

        .post-mini-title {
            font-weight: 500;
            color: var(--white);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 200px;
            display: block;
        }

        .mini-author {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
        }

        .mini-avatar {
            width: 24px;
            height: 24px;
            border-radius: 5px;
            background: linear-gradient(135deg, var(--accent), var(--accent2));
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Syne', sans-serif;
            font-size: 0.58rem;
            font-weight: 700;
            color: var(--white);
            flex-shrink: 0;
        }

        .mini-date {
            font-size: 0.76rem;
            color: var(--muted);
        }

        /* ── Quick Actions ── */
        .qa-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.75rem;
            padding: 1.2rem 1.5rem;
        }

        .qa-btn {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 0.4rem;
            padding: 1rem;
            background: var(--surface2);
            border: 1px solid var(--border);
            border-radius: 10px;
            text-decoration: none;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .qa-btn:hover {
            border-color: rgba(108, 99, 255, 0.4);
            background: rgba(108, 99, 255, 0.07);
            transform: translateY(-2px);
        }

        .qa-btn .qa-icon {
            width: 34px;
            height: 34px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            margin-bottom: 0.2rem;
        }

        .qa-btn .qa-label {
            font-family: 'Syne', sans-serif;
            font-size: 0.78rem;
            font-weight: 600;
            color: var(--white);
        }

        .qa-btn .qa-sub {
            font-size: 0.68rem;
            color: var(--muted);
        }

        /* ── Bottom Row ── */
        .bottom-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
        }

        @media (max-width: 700px) {
            .bottom-grid {
                grid-template-columns: 1fr;
            }

            .stats-grid {
                grid-template-columns: 1fr 1fr;
            }

            .db-wrapper {
                padding: 1.5rem 1rem;
            }

            .db-header-left h1 {
                font-size: 1.6rem;
            }
        }

        /* ── Users List ── */
        .user-item {
            display: flex;
            align-items: center;
            gap: 0.85rem;
            padding: 0.9rem 1.5rem;
            border-bottom: 1px solid var(--border);
            transition: background 0.15s;
        }

        .user-item:hover {
            background: rgba(108, 99, 255, 0.04);
        }

        .user-item:last-child {
            border-bottom: none;
        }

        .user-item-avatar {
            width: 36px;
            height: 36px;
            border-radius: 9px;
            background: linear-gradient(135deg, var(--success), var(--accent));
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Syne', sans-serif;
            font-size: 0.7rem;
            font-weight: 700;
            color: var(--white);
            flex-shrink: 0;
        }

        .user-item-info {
            flex: 1;
            min-width: 0;
        }

        .user-item-name {
            font-size: 0.86rem;
            font-weight: 500;
            color: var(--white);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .user-item-email {
            font-size: 0.74rem;
            color: var(--muted);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .role-pill {
            display: inline-block;
            padding: 0.18rem 0.6rem;
            border-radius: 20px;
            font-size: 0.66rem;
            font-weight: 600;
            letter-spacing: 0.05em;
            background: rgba(108, 99, 255, 0.12);
            color: var(--accent2);
            border: 1px solid rgba(108, 99, 255, 0.2);
            flex-shrink: 0;
        }

        /* ── Role Distribution ── */
        .role-dist-item {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid var(--border);
            transition: background 0.15s;
        }

        .role-dist-item:hover {
            background: rgba(108, 99, 255, 0.03);
        }

        .role-dist-item:last-child {
            border-bottom: none;
        }

        .rdi-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.55rem;
        }

        .rdi-name {
            font-size: 0.84rem;
            font-weight: 500;
            color: var(--white);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .rdi-count {
            font-family: 'Syne', sans-serif;
            font-size: 0.8rem;
            font-weight: 700;
            color: var(--muted);
        }

        .rdi-bar-bg {
            height: 5px;
            background: var(--surface2);
            border-radius: 10px;
            overflow: hidden;
        }

        .rdi-bar-fill {
            height: 100%;
            border-radius: 10px;
            transition: width 1s cubic-bezier(0.16, 1, 0.3, 1);
        }
    </style>

    <div class="db-wrapper">
        <div class="db-inner">

            {{-- ── Header ── --}}
            <div class="db-header">
                <div class="db-header-left">
                    <p class="greeting">Welcome Back</p>
                    <h1>Admin <span>Dashboard</span></h1>
                </div>
                <div class="db-header-right">
                    <span class="live-dot">Live</span>
                    <span class="date-chip" id="liveDateChip"></span>
                </div>
            </div>

            {{-- ── Stat Cards ── --}}
            <div class="stats-grid">

                <div class="stat-card c-purple">
                    <div class="stat-top">
                        <div class="stat-icon c-purple">👥</div>
                        <div class="stat-trend up">↑ Active</div>
                    </div>
                    <div class="stat-value">{{ $totalUsers ?? $users->count() }}</div>
                    <div class="stat-label">Total Users</div>
                    <div class="stat-sub">
                        <span>{{ $users->filter(fn($u) => $u->created_at->isCurrentMonth())->count() }}</span> joined this
                        month
                    </div>
                </div>

                <div class="stat-card c-green">
                    <div class="stat-top">
                        <div class="stat-icon c-green">📝</div>
                        <div class="stat-trend up">↑ Growing</div>
                    </div>
                    <div class="stat-value">{{ $totalPosts ?? $posts->count() }}</div>
                    <div class="stat-label">Total Posts</div>
                    <div class="stat-sub">
                        <span>{{ $posts->filter(fn($p) => $p->created_at->isCurrentMonth())->count() }}</span> published
                        this month
                    </div>
                </div>

                <div class="stat-card c-amber">
                    <div class="stat-top">
                        <div class="stat-icon c-amber">🛡️</div>
                        <div class="stat-trend neu">Stable</div>
                    </div>
                    <div class="stat-value">{{ $totalRoles ?? $roles->count() }}</div>
                    <div class="stat-label">Total Roles</div>
                    <div class="stat-sub">
                        <span>{{ $roles->count() }}</span> roles configured
                    </div>
                </div>

                <div class="stat-card c-sky">
                    <div class="stat-top">
                        <div class="stat-icon c-sky">🖼️</div>
                        <div class="stat-trend up">↑ Media</div>
                    </div>
                    <div class="stat-value">{{ $posts->filter(fn($p) => $p->image)->count() }}</div>
                    <div class="stat-label">Posts with Images</div>
                    <div class="stat-sub">
                        <span>{{ $posts->filter(fn($p) => !$p->image)->count() }}</span> without image
                    </div>
                </div>

            </div>

            {{-- ── Mid Row: Recent Posts + Quick Actions ── --}}
        {{-- ══════════════════════════════
     MID GRID
══════════════════════════════ --}}

<style>
/* ── Post Listing Card ── */
.post-listing-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 16px;
    overflow: hidden;
    animation: fadeUp 0.5s 0.25s ease both;
}

.plc-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 1.2rem 1.5rem;
    border-bottom: 1px solid var(--border);
}

.plc-title {
    font-family: 'Syne', sans-serif;
    font-size: 0.95rem;
    font-weight: 700;
    color: var(--white);
    display: flex;
    align-items: center;
    gap: 0.6rem;
}

.plc-title .ct-icon {
    width: 28px; height: 28px;
    border-radius: 7px;
    display: flex; align-items: center; justify-content: center;
    font-size: 0.85rem;
    background: rgba(108,99,255,0.15);
}

.view-all-link {
    font-size: 0.75rem;
    color: var(--accent2);
    text-decoration: none;
    font-weight: 500;
    transition: color 0.2s;
}
.view-all-link:hover { color: var(--white); }

/* ── Scrollable Posts Container ── */
.posts-scroll-container {
    max-height: 520px;
    overflow-y: auto;
    overflow-x: hidden;
}

.posts-scroll-container::-webkit-scrollbar {
    width: 4px;
}
.posts-scroll-container::-webkit-scrollbar-track {
    background: var(--surface2);
}
.posts-scroll-container::-webkit-scrollbar-thumb {
    background: var(--border);
    border-radius: 4px;
    transition: background 0.2s;
}
.posts-scroll-container::-webkit-scrollbar-thumb:hover {
    background: var(--accent);
}

/* ── Individual Post Item ── */
.post-item {
    border-bottom: 1px solid var(--border);
    transition: background 0.15s;
}
.post-item:last-child { border-bottom: none; }
.post-item:hover { background: rgba(108,99,255,0.03); }

.post-item-main {
    display: flex;
    gap: 1rem;
    padding: 1.1rem 1.5rem;
    align-items: flex-start;
}

/* Thumbnail */
.post-thumb-wrap {
    flex-shrink: 0;
    width: 80px;
    height: 64px;
    border-radius: 9px;
    overflow: hidden;
    background: var(--surface2);
    border: 1px solid var(--border);
}

.post-thumb-wrap img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform 0.3s;
}
.post-item:hover .post-thumb-wrap img { transform: scale(1.06); }

.post-no-thumb {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.4rem;
    color: var(--muted);
    background: linear-gradient(135deg, var(--surface2), #1f1a35);
}

/* Post Content */
.post-item-content {
    flex: 1;
    min-width: 0;
    display: flex;
    flex-direction: column;
    gap: 0.4rem;
}

.post-item-title {
    font-family: 'Syne', sans-serif;
    font-size: 0.88rem;
    font-weight: 700;
    color: var(--white);
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    line-height: 1.3;
}

.post-item-meta {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    flex-wrap: wrap;
}

.pi-author {
    display: flex;
    align-items: center;
    gap: 0.4rem;
}

.pi-avatar {
    width: 20px; height: 20px;
    border-radius: 5px;
    background: linear-gradient(135deg, var(--accent), var(--accent2));
    display: flex; align-items: center; justify-content: center;
    font-family: 'Syne', sans-serif;
    font-size: 0.5rem;
    font-weight: 700;
    color: var(--white);
    flex-shrink: 0;
}

.pi-author-name {
    font-size: 0.75rem;
    color: var(--text);
    font-weight: 500;
}

.pi-dot {
    width: 3px; height: 3px;
    border-radius: 50%;
    background: var(--border);
    flex-shrink: 0;
}

.pi-date {
    font-size: 0.72rem;
    color: var(--muted);
}

/* Stats row */
.post-item-stats {
    display: flex;
    align-items: center;
    gap: 0.6rem;
    margin-top: 0.2rem;
}

.pi-stat {
    display: inline-flex;
    align-items: center;
    gap: 0.3rem;
    font-size: 0.72rem;
    color: var(--muted);
    padding: 0.18rem 0.55rem;
    background: var(--surface2);
    border: 1px solid var(--border);
    border-radius: 20px;
    font-weight: 500;
    cursor: default;
    transition: all 0.2s;
    position: relative;
}

.pi-stat.likes {
    color: var(--accent2);
    background: rgba(108,99,255,0.08);
    border-color: rgba(108,99,255,0.2);
}

.pi-stat.comments {
    color: var(--success);
    background: rgba(52,211,153,0.08);
    border-color: rgba(52,211,153,0.2);
}

/* ── Likes Tooltip ── */
.pi-stat.likes { cursor: pointer; }

.likes-tooltip {
    position: absolute;
    bottom: calc(100% + 8px);
    left: 0;
    min-width: 160px;
    max-width: 240px;
    background: var(--surface3, #1f1f30);
    border: 1px solid var(--border);
    border-radius: 10px;
    padding: 0.7rem;
    z-index: 50;
    display: none;
    box-shadow: 0 8px 32px rgba(0,0,0,0.5);
}

.pi-stat.likes:hover .likes-tooltip,
.pi-stat.likes:focus .likes-tooltip {
    display: block;
}

.likes-tooltip-title {
    font-family: 'Syne', sans-serif;
    font-size: 0.62rem;
    font-weight: 700;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: var(--muted);
    margin-bottom: 0.5rem;
}

.likes-tooltip-list {
    display: flex;
    flex-direction: column;
    gap: 0.35rem;
    max-height: 120px;
    overflow-y: auto;
}

.likes-tooltip-list::-webkit-scrollbar { width: 3px; }
.likes-tooltip-list::-webkit-scrollbar-thumb { background: var(--border); border-radius: 3px; }

.liker-item {
    display: flex;
    align-items: center;
    gap: 0.45rem;
    font-size: 0.75rem;
    color: var(--text);
}

.liker-av {
    width: 18px; height: 18px;
    border-radius: 4px;
    background: linear-gradient(135deg, var(--accent), var(--accent2));
    display: flex; align-items: center; justify-content: center;
    font-size: 0.48rem;
    font-weight: 700;
    color: var(--white);
    flex-shrink: 0;
    font-family: 'Syne', sans-serif;
}

.no-likers {
    font-size: 0.75rem;
    color: var(--muted);
    font-style: italic;
}

/* ── Comments Accordion ── */
.post-comments-section {
    border-top: 1px solid var(--border);
    margin: 0 1.5rem;
    padding: 0;
    background: transparent;
}

.comments-toggle-btn {
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
    padding: 0.65rem 0;
    background: none;
    border: none;
    cursor: pointer;
    color: var(--muted);
    font-family: 'Karla', sans-serif;
    font-size: 0.76rem;
    font-weight: 500;
    transition: color 0.2s;
    gap: 0.5rem;
}

.comments-toggle-btn:hover { color: var(--accent2); }

.ctb-left {
    display: flex;
    align-items: center;
    gap: 0.4rem;
}

.ctb-arrow {
    transition: transform 0.2s;
    margin-left: auto;
    font-size: 0.7rem;
}

.comments-toggle-btn.open .ctb-arrow {
    transform: rotate(180deg);
}

.comments-body {
    display: none;
    padding-bottom: 1rem;
}

.comments-body.open { display: block; }

/* Comment form */
.comment-form-dash {
    display: flex;
    gap: 0.5rem;
    margin-bottom: 0.75rem;
}

.comment-form-dash input {
    flex: 1;
    padding: 0.5rem 0.75rem;
    background: var(--surface2);
    border: 1.5px solid var(--border);
    border-radius: 8px;
    color: var(--text);
    font-family: 'Karla', sans-serif;
    font-size: 0.8rem;
    outline: none;
    transition: border-color 0.2s;
}

.comment-form-dash input:focus { border-color: var(--accent); }
.comment-form-dash input::placeholder { color: var(--muted); }

.comment-form-dash button {
    padding: 0.5rem 0.9rem;
    background: var(--success);
    color: #0d0d14;
    border: none;
    border-radius: 8px;
    font-family: 'Karla', sans-serif;
    font-size: 0.78rem;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.2s;
    white-space: nowrap;
}

.comment-form-dash button:hover { background: #5fe4c0; }

/* Comments list */
.dash-comments-list {
    display: flex;
    flex-direction: column;
    gap: 0.45rem;
    max-height: 160px;
    overflow-y: auto;
    padding-right: 0.25rem;
}

.dash-comments-list::-webkit-scrollbar { width: 3px; }
.dash-comments-list::-webkit-scrollbar-thumb { background: var(--border); border-radius: 3px; }

.dash-comment-item {
    display: flex;
    align-items: flex-start;
    gap: 0.5rem;
    padding: 0.5rem 0.65rem;
    background: var(--surface2);
    border-radius: 8px;
    border: 1px solid var(--border);
}

.dc-avatar {
    width: 22px; height: 22px;
    border-radius: 5px;
    background: linear-gradient(135deg, var(--success), var(--sky, #38bdf8));
    display: flex; align-items: center; justify-content: center;
    font-family: 'Syne', sans-serif;
    font-size: 0.52rem;
    font-weight: 700;
    color: var(--white);
    flex-shrink: 0;
    margin-top: 1px;
}

.dc-body { font-size: 0.78rem; line-height: 1.45; }
.dc-body b { color: var(--accent2); font-weight: 600; margin-right: 0.3rem; }
.dc-time { display: block; font-size: 0.65rem; color: var(--muted); margin-top: 0.15rem; }

.no-comments {
    font-size: 0.78rem;
    color: var(--muted);
    font-style: italic;
    text-align: center;
    padding: 0.75rem 0;
}

/* ── Quick Actions (unchanged) ── */
.qa-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 0.75rem;
    padding: 1.2rem 1.5rem;
}

.qa-btn {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    gap: 0.4rem;
    padding: 1rem;
    background: var(--surface2);
    border: 1px solid var(--border);
    border-radius: 10px;
    text-decoration: none;
    transition: all 0.2s ease;
}

.qa-btn:hover {
    border-color: rgba(108,99,255,0.4);
    background: rgba(108,99,255,0.07);
    transform: translateY(-2px);
}

.qa-icon {
    width: 34px; height: 34px;
    border-radius: 8px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1rem;
    margin-bottom: 0.2rem;
}

.qa-label {
    font-family: 'Syne', sans-serif;
    font-size: 0.78rem;
    font-weight: 600;
    color: var(--white);
}

.qa-sub {
    font-size: 0.68rem;
    color: var(--muted);
}
</style>

<div class="mid-grid">

    {{-- ══ Recent Posts Full Listing ══ --}}
    <div class="post-listing-card">
        <div class="plc-header">
            <div class="plc-title">
                <div class="ct-icon">📝</div>
                Recent Posts
            </div>
            <a href="{{ route('posts.index') }}" class="view-all-link">View all →</a>
        </div>

        <div class="posts-scroll-container">
        @forelse($posts->sortByDesc('created_at')->take(10) as $post)
        <div class="post-item">

            {{-- Main Row: thumb + info + stats --}}
            <div class="post-item-main">

                {{-- Thumbnail --}}
                <div class="post-thumb-wrap">
                    @if($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}">
                    @else
                        <div class="post-no-thumb">🖼</div>
                    @endif
                </div>

                {{-- Content --}}
                <div class="post-item-content">

                    <div class="post-item-title" title="{{ $post->title }}">{{ $post->title }}</div>

                    <div class="post-item-meta">
                        <div class="pi-author">
                            <div class="pi-avatar">{{ strtoupper(substr($post->user->first_name ?? '?', 0, 2)) }}</div>
                            <span class="pi-author-name">{{ $post->user->first_name ?? '—' }}</span>
                        </div>
                        <div class="pi-dot"></div>
                        <span class="pi-date">{{ $post->created_at->format('d M, Y') }}</span>
                    </div>

                    {{-- Stats --}}
                    <div class="post-item-stats">

                        {{-- Likes with tooltip --}}
                        <div class="pi-stat likes" tabindex="0">
                            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                            {{ $post->likes->count() }} likes

                            {{-- Likers tooltip --}}
                            <div class="likes-tooltip">
                                <div class="likes-tooltip-title">Liked by</div>
                                <div class="likes-tooltip-list">
                                    @forelse($post->likes as $like)
                                    <div class="liker-item">
                                        <div class="liker-av">
                                            {{ strtoupper(substr($like->user->name ?? $like->user->first_name ?? '?', 0, 2)) }}
                                        </div>
                                        {{ $like->user->name ?? $like->user->first_name ?? 'Unknown' }}
                                    </div>
                                    @empty
                                    <div class="no-likers">No likes yet</div>
                                    @endforelse
                                </div>
                            </div>
                        </div>

                        {{-- Comments count --}}
                        <div class="pi-stat comments">
                            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                            {{ $post->comments->count() }} comments
                        </div>

                        {{-- Like action --}}
                        <form action="{{ route('post.like', $post->id) }}" method="POST" style="margin:0;">
                            @csrf
                            <button type="submit"
                                style="display:inline-flex;align-items:center;gap:0.3rem;padding:0.18rem 0.55rem;background:rgba(108,99,255,0.12);border:1px solid rgba(108,99,255,0.25);border-radius:20px;color:var(--accent2);font-family:'Karla',sans-serif;font-size:0.72rem;font-weight:600;cursor:pointer;transition:all 0.2s;"
                                onmouseover="this.style.background='rgba(108,99,255,0.25)'"
                                onmouseout="this.style.background='rgba(108,99,255,0.12)'">
                                ♥ Like
                            </button>
                        </form>

                    </div>
                </div>
            </div>

            {{-- Comments Accordion --}}
            <div class="post-comments-section">
                <button class="comments-toggle-btn" onclick="toggleDashComments(this)">
                    <div class="ctb-left">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                        {{ $post->comments->count() > 0 ? $post->comments->count() . ' comment' . ($post->comments->count() !== 1 ? 's' : '') : 'No comments yet' }} — click to expand
                    </div>
                    <span class="ctb-arrow">▾</span>
                </button>

                <div class="comments-body">

                    {{-- Comment Input --}}
                    <form action="{{ route('post.comment', $post->id) }}" method="POST" class="comment-form-dash">
                        @csrf
                        <input type="text" name="comment" placeholder="Write a comment..." required>
                        <button type="submit">Send</button>
                    </form>

                    {{-- Comments List --}}
                    <div class="dash-comments-list">
                        @forelse($post->comments->sortByDesc('created_at') as $comment)
                        <div class="dash-comment-item">
                            <div class="dc-avatar">
                                {{ strtoupper(substr($comment->user->name ?? $comment->user->first_name ?? '?', 0, 2)) }}
                            </div>
                            <div class="dc-body">
                                <b>{{ $comment->user->name ?? $comment->user->first_name ?? 'User' }}</b>{{ $comment->comment }}
                                <span class="dc-time">{{ $comment->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                        @empty
                        <div class="no-comments">No comments yet. Be the first!</div>
                        @endforelse
                    </div>

                </div>
            </div>

        </div>
        @empty
        <div style="text-align:center; padding:3rem 2rem; color:var(--muted);">
            <div style="font-size:2rem; margin-bottom:0.75rem; opacity:0.35;">📭</div>
            <p style="font-size:0.85rem;">No posts yet.</p>
        </div>
        @endforelse
        </div> {{-- end .posts-scroll-container --}}

    </div>

    {{-- ══ Quick Actions ══ --}}
    <div class="db-card" style="animation: fadeUp 0.5s 0.3s ease both;">
        <div class="db-card-header">
            <div class="db-card-title">
                <div class="ct-icon">⚡</div>
                Quick Actions
            </div>
        </div>
        <div class="qa-grid">
            <a href="{{ route('posts.create') }}" class="qa-btn">
                <div class="qa-icon" style="background: rgba(108,99,255,0.15);">✍️</div>
                <span class="qa-label">New Post</span>
                <span class="qa-sub">Create content</span>
            </a>
            <a href="{{ route('user.register') }}" class="qa-btn">
                <div class="qa-icon" style="background: rgba(52,211,153,0.12);">👤</div>
                <span class="qa-label">Add User</span>
                <span class="qa-sub">Register member</span>
            </a>
            <a href="{{ route('roles.index') }}" class="qa-btn">
                <div class="qa-icon" style="background: rgba(251,191,36,0.1);">🛡️</div>
                <span class="qa-label">Roles</span>
                <span class="qa-sub">Set permissions</span>
            </a>
            <a href="{{ route('posts.index') }}" class="qa-btn">
                <div class="qa-icon" style="background: rgba(56,189,248,0.1);">📋</div>
                <span class="qa-label">All Posts</span>
                <span class="qa-sub">Manage content</span>
            </a>
        </div>
    </div>

</div>



            {{-- ── Bottom Row: Recent Users + Role Distribution ── --}}
            <div class="bottom-grid">

                {{-- Recent Users --}}
                <div class="db-card" style="animation-delay: 0.3s;">
                    <div class="db-card-header">
                        <div class="db-card-title">
                            <div class="ct-icon">👥</div>
                            Recent Users
                        </div>
                        <a href="{{ route('user.list') }}" class="view-all-link">View all →</a>
                    </div>
                    @forelse($users->sortByDesc('created_at')->take(5) as $user)
                        <div class="user-item">
                            <div class="user-item-avatar">
                                {{ strtoupper(substr($user->name ?? ($user->first_name ?? '?'), 0, 2)) }}
                            </div>
                            <div class="user-item-info">
                                <div class="user-item-name">{{ $user->name ?? $user->first_name }}</div>
                                <div class="user-item-email">{{ $user->email }}</div>
                            </div>
                            @if ($user->role?->name)
                                <span class="role-pill">{{ $user->role->name }}</span>
                            @endif
                        </div>
                    @empty
                        <div style="text-align:center; padding:2rem; color:var(--muted); font-size:0.85rem;">No users yet.
                        </div>
                    @endforelse
                </div>

                {{-- Role Distribution --}}
                <div class="db-card" style="animation-delay: 0.35s;">
                    <div class="db-card-header">
                        <div class="db-card-title">
                            <div class="ct-icon">🛡️</div>
                            Role Distribution
                        </div>
                        <a href="{{ route('roles.index') }}" class="view-all-link">Manage →</a>
                    </div>

                    @php
                        $totalUsersCount = $users->count() ?: 1;
                        $roleColors = ['#6c63ff', '#34d399', '#fbbf24', '#38bdf8', '#f472b6', '#a78bfa'];
                        $roleIndex = 0;
                    @endphp

                    @forelse($roles as $role)
                        @php
                            $count = $users->filter(fn($u) => $u->role_id === $role->id)->count();
                            $pct = round(($count / $totalUsersCount) * 100);
                            $color = $roleColors[$roleIndex % count($roleColors)];
                            $roleIndex++;
                        @endphp
                        <div class="role-dist-item">
                            <div class="rdi-top">
                                <span class="rdi-name">
                                    <span
                                        style="width:8px;height:8px;border-radius:50%;background:{{ $color }};display:inline-block;flex-shrink:0;"></span>
                                    {{ $role->name }}
                                </span>
                                <span class="rdi-count">{{ $count }} user{{ $count !== 1 ? 's' : '' }}</span>
                            </div>
                            <div class="rdi-bar-bg">
                                <div class="rdi-bar-fill"
                                    style="width: {{ $pct }}%; background: {{ $color }};"></div>
                            </div>
                        </div>
                    @empty
                        <div style="text-align:center; padding:2rem; color:var(--muted); font-size:0.85rem;">No roles
                            configured.</div>
                    @endforelse
                </div>

            </div>

        </div>
    </div>

    <script>
        // Live date chip
        function updateDate() {
            const now = new Date();
            const opts = {
                weekday: 'short',
                day: 'numeric',
                month: 'short',
                year: 'numeric'
            };
            document.getElementById('liveDateChip').textContent = now.toLocaleDateString('en-IN', opts);
        }
        updateDate();

        // Animate progress bars on load
        window.addEventListener('load', () => {
            document.querySelectorAll('.rdi-bar-fill').forEach(bar => {
                const target = bar.style.width;
                bar.style.width = '0%';
                requestAnimationFrame(() => {
                    setTimeout(() => {
                        bar.style.width = target;
                    }, 100);
                });
            });
        });
    </script>
<script>
function toggleDashComments(btn) {
    const body = btn.nextElementSibling;
    const isOpen = body.classList.toggle('open');
    btn.classList.toggle('open', isOpen);
}
</script>
@endsection
