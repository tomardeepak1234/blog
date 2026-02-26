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
        --danger-dim: rgba(255,79,107,0.12);
        --emerald: #34d399;
        --amber: #fbbf24;
        --text: #e8e8f0;
        --muted: #6b6b8a;
        --white: #ffffff;
    }

    * { box-sizing: border-box; margin: 0; padding: 0; }

    .pm-wrapper {
        min-height: 100vh;
        background: var(--bg);
        font-family: 'Karla', sans-serif;
        padding: 2.5rem 2rem;
        color: var(--text);
        position: relative;
        left: 4%;
    }

    .pm-wrapper::before {
        content: '';
        position: fixed;
        top: -10%;
        right: 20%;
        width: 500px;
        height: 500px;
        background: radial-gradient(circle, rgba(108,99,255,0.07) 0%, transparent 65%);
        pointer-events: none;
        z-index: 0;
    }

    .pm-inner {
        max-width: 1100px;
        margin: 0 auto;
        position: relative;
        z-index: 1;
    }

    /* ── Header ── */
    .pm-header {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        margin-bottom: 2rem;
        gap: 1rem;
        flex-wrap: wrap;
        animation: fadeDown 0.5s ease forwards;
    }

    @keyframes fadeDown {
        from { opacity:0; transform:translateY(-14px); }
        to   { opacity:1; transform:translateY(0); }
    }
    @keyframes fadeUp {
        from { opacity:0; transform:translateY(16px); }
        to   { opacity:1; transform:translateY(0); }
    }

    .pm-header-left .eyebrow {
        font-size: 0.68rem;
        font-weight: 500;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        color: var(--accent2);
        margin-bottom: 0.4rem;
    }

    .pm-header-left h1 {
        font-family: 'Syne', sans-serif;
        font-size: 2rem;
        font-weight: 800;
        color: var(--white);
        line-height: 1;
    }

    .btn-add-post {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1.6rem;
        background: var(--accent);
        color: var(--white);
        font-family: 'Karla', sans-serif;
        font-size: 0.85rem;
        font-weight: 500;
        letter-spacing: 0.05em;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.2s ease;
        box-shadow: 0 0 24px rgba(108,99,255,0.35);
    }
    .btn-add-post:hover {
        background: #7c74ff;
        box-shadow: 0 0 36px rgba(108,99,255,0.55);
        transform: translateY(-1px);
        color: var(--white);
    }

    /* ── Stats ── */
    .stats-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 1rem;
        margin-bottom: 2rem;
        animation: fadeUp 0.5s 0.1s ease both;
    }

    .stat-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 1.2rem 1.5rem;
        display: flex;
        flex-direction: column;
        gap: 0.3rem;
    }
    .stat-dot { width:6px; height:6px; border-radius:50%; margin-bottom:0.2rem; }
    .stat-label { font-size:0.7rem; text-transform:uppercase; letter-spacing:0.12em; color:var(--muted); font-weight:500; }
    .stat-value { font-family:'Syne',sans-serif; font-size:1.8rem; font-weight:700; color:var(--white); }

    /* ── Table Card ── */
    .table-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 16px;
        overflow: hidden;
        animation: fadeUp 0.5s 0.2s ease both;
    }

    .table-toolbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 1.2rem 1.5rem;
        border-bottom: 1px solid var(--border);
        gap: 1rem;
        flex-wrap: wrap;
    }
    .toolbar-title {
        font-family: 'Syne', sans-serif;
        font-size: 0.95rem;
        font-weight: 600;
        color: var(--text);
    }

    .search-box {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        background: var(--surface2);
        border: 1px solid var(--border);
        border-radius: 8px;
        padding: 0.45rem 0.9rem;
        transition: border-color 0.2s;
    }
    .search-box:focus-within { border-color: var(--accent); }
    .search-box input {
        background: none;
        border: none;
        outline: none;
        color: var(--text);
        font-family: 'Karla', sans-serif;
        font-size: 0.85rem;
        width: 180px;
    }
    .search-box input::placeholder { color: var(--muted); }
    .search-box svg { color: var(--muted); flex-shrink:0; }

    /* ── Table ── */
    .pm-table {
        width: 100%;
        border-collapse: collapse;
    }

    .pm-table thead tr {
        background: var(--surface2);
    }

    .pm-table thead th {
        padding: 0.9rem 1.2rem;
        font-family: 'Syne', sans-serif;
        font-size: 0.7rem;
        font-weight: 600;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: var(--muted);
        border: none;
        border-bottom: 1px solid var(--border);
        white-space: nowrap;
    }

    .pm-table tbody tr {
        border-bottom: 1px solid var(--border);
        transition: background 0.15s ease;
    }
    .pm-table tbody tr:hover { background: rgba(108,99,255,0.04); }
    .pm-table tbody tr:last-child { border-bottom: none; }

    .pm-table tbody td {
        padding: 0.9rem 1.2rem;
        font-size: 0.88rem;
        color: var(--text);
        border: none;
        vertical-align: middle;
    }

    /* Index badge */
    .idx-badge {
        display: inline-block;
        background: var(--surface2);
        border: 1px solid var(--border);
        color: var(--muted);
        font-family: 'Syne', sans-serif;
        font-size: 0.72rem;
        padding: 0.15rem 0.55rem;
        border-radius: 4px;
    }

    /* Post image */
    .post-thumb {
        width: 52px;
        height: 52px;
        object-fit: cover;
        border-radius: 8px;
        border: 1px solid var(--border);
        display: block;
    }

    .no-img {
        width: 52px;
        height: 52px;
        border-radius: 8px;
        background: var(--surface2);
        border: 1px dashed var(--border);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--muted);
        font-size: 1.2rem;
    }

    /* Post title cell */
    .post-title-cell {
        max-width: 260px;
    }
    .post-title-text {
        font-weight: 500;
        color: var(--white);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 240px;
        display: block;
    }

    /* Author chip */
    .author-chip {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }
    .author-avatar {
        width: 28px; height: 28px;
        border-radius: 6px;
        background: linear-gradient(135deg, var(--emerald), var(--accent));
        display: flex; align-items: center; justify-content: center;
        font-family: 'Syne', sans-serif;
        font-size: 0.65rem;
        font-weight: 700;
        color: var(--white);
        flex-shrink: 0;
    }
    .author-name { font-size: 0.85rem; color: var(--text); }

    /* Date */
    .date-text { font-size: 0.8rem; color: var(--muted); }

    /* Actions */
    .action-wrap { display:flex; align-items:center; gap:0.5rem; }

    .btn-edit-p {
        display: inline-flex; align-items: center; gap: 0.3rem;
        padding: 0.38rem 0.85rem;
        background: rgba(108,99,255,0.12);
        color: var(--accent2);
        border: 1px solid rgba(108,99,255,0.25);
        border-radius: 6px;
        font-family: 'Karla', sans-serif;
        font-size: 0.76rem; font-weight: 500;
        text-decoration: none;
        transition: all 0.2s ease;
    }
    .btn-edit-p:hover {
        background: rgba(108,99,255,0.25);
        color: var(--accent2);
        border-color: rgba(108,99,255,0.5);
    }

    .btn-del-p {
        display: inline-flex; align-items: center; gap: 0.3rem;
        padding: 0.38rem 0.85rem;
        background: var(--danger-dim);
        color: var(--danger);
        border: 1px solid rgba(255,79,107,0.25);
        border-radius: 6px;
        font-family: 'Karla', sans-serif;
        font-size: 0.76rem; font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    .btn-del-p:hover {
        background: rgba(255,79,107,0.22);
        border-color: rgba(255,79,107,0.5);
    }

    /* Empty state */
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        color: var(--muted);
    }
    .empty-state .empty-icon { font-size: 3rem; margin-bottom: 1rem; opacity: 0.4; }
    .empty-state p { font-size: 0.9rem; }

    /* Table footer */
    .table-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 1rem 1.5rem;
        border-top: 1px solid var(--border);
        flex-wrap: wrap;
        gap: 0.5rem;
    }
    .table-count { font-size: 0.78rem; color: var(--muted); }

    @media (max-width: 700px) {
        .pm-wrapper { padding: 1.5rem 1rem; }
        .pm-header-left h1 { font-size: 1.5rem; }
        .pm-table thead th, .pm-table tbody td { padding: 0.7rem 0.8rem; }
        .post-title-text { max-width: 140px; }
    }
</style>

<div class="pm-wrapper">
<div class="pm-inner">

    {{-- Header --}}
    <div class="pm-header">
        <div class="pm-header-left">
            <p class="eyebrow">Admin Panel</p>
            <h1>Post Management</h1>
        </div>
        <a href="{{ route('posts.create') }}" class="btn-add-post">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Add Post
        </a>
    </div>

    {{-- Stats --}}
    <div class="stats-row">
        <div class="stat-card">
            <div class="stat-dot" style="background: var(--accent2)"></div>
            <span class="stat-label">Total Posts</span>
            <span class="stat-value">{{ $posts->count() }}</span>
        </div>
        <div class="stat-card">
            <div class="stat-dot" style="background: var(--emerald)"></div>
            <span class="stat-label">This Month</span>
            <span class="stat-value">{{ $posts->filter(fn($p) => $p->created_at->isCurrentMonth())->count() }}</span>
        </div>
        <div class="stat-card">
            <div class="stat-dot" style="background: var(--amber)"></div>
            <span class="stat-label">With Images</span>
            <span class="stat-value">{{ $posts->filter(fn($p) => $p->image)->count() }}</span>
        </div>
        <div class="stat-card">
            <div class="stat-dot" style="background: var(--danger)"></div>
            <span class="stat-label">Authors</span>
            <span class="stat-value">{{ $posts->pluck('user.first_name')->filter()->unique()->count() }}</span>
        </div>
    </div>

    {{-- Table --}}
    <div class="table-card">
        <div class="table-toolbar">
            <span class="toolbar-title">All Posts</span>
            <div class="search-box">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                <input type="text" id="postSearch" placeholder="Search posts...">
            </div>
        </div>

        <div style="overflow-x: auto;">
            <table class="pm-table" id="postTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="postTableBody">
                    @forelse ($posts as $index => $post)
                    <tr>
                        <td><span class="idx-badge">{{ $index + 1 }}</span></td>
                        <td>
                            @if($post->image)
                                <img src="{{ asset('storage/' . $post->image) }}" class="post-thumb" alt="{{ $post->title }}">
                            @else
                                <div class="no-img">🖼</div>
                            @endif
                        </td>
                        <td class="post-title-cell">
                            <span class="post-title-text" title="{{ $post->title }}">{{ $post->title }}</span>
                        </td>
                        <td>
                            <div class="author-chip">
                                <div class="author-avatar">
                                    {{ strtoupper(substr($post->user->first_name ?? '?', 0, 2)) }}
                                </div>
                                <span class="author-name">{{ $post->user->first_name ?? '—' }}</span>
                            </div>
                        </td>
                        <td><span class="date-text">{{ $post->created_at->format('d M Y') }}</span></td>
                        <td>
                            <div class="action-wrap">
                                <a href="{{ route('posts.edit', $post->id) }}" class="btn-edit-p">
                                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                    Edit
                                </a>
                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="margin:0" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn-del-p" onclick="openDeleteModal(this)">
                                        <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M9 6V4h6v2"/></svg>
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6">
                            <div class="empty-state">
                                <div class="empty-icon">📭</div>
                                <p>No posts found. <a href="{{ route('posts.create') }}" style="color: var(--accent2);">Create your first post →</a></p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="table-footer">
            <span class="table-count" id="rowCount">Showing {{ $posts->count() }} post{{ $posts->count() !== 1 ? 's' : '' }}</span>
        </div>
    </div>

</div>
</div>

{{-- Delete Confirm Modal --}}
<div id="deleteModal" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.65); backdrop-filter:blur(4px); z-index:9999; align-items:center; justify-content:center;">
    <div style="background:#1a1a2a; border:1px solid #252538; border-radius:16px; padding:2rem; max-width:380px; width:90%; text-align:center; animation: fadeDown 0.25s ease;">
        <div style="width:52px;height:52px;background:rgba(255,79,107,0.12);border-radius:12px;margin:0 auto 1.2rem;display:flex;align-items:center;justify-content:center;">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#ff4f6b" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M9 6V4h6v2"/></svg>
        </div>
        <h3 style="font-family:'Syne',sans-serif;font-size:1.1rem;color:#fff;margin-bottom:0.6rem;">Delete Post?</h3>
        <p style="font-size:0.85rem;color:#6b6b8a;margin-bottom:1.5rem;">This action cannot be undone. The post will be permanently removed.</p>
        <div style="display:flex;gap:0.75rem;justify-content:center;">
            <button onclick="closeDeleteModal()" style="padding:0.6rem 1.4rem;background:transparent;border:1px solid #252538;color:#6b6b8a;border-radius:8px;font-family:'Karla',sans-serif;font-size:0.85rem;cursor:pointer;">Cancel</button>
            <button id="confirmDeleteBtn" style="padding:0.6rem 1.4rem;background:#ff4f6b;border:none;color:#fff;border-radius:8px;font-family:'Karla',sans-serif;font-size:0.85rem;cursor:pointer;font-weight:500;">Yes, Delete</button>
        </div>
    </div>
</div>

<script>
    let pendingForm = null;

    function openDeleteModal(btn) {
        pendingForm = btn.closest('form');
        document.getElementById('deleteModal').style.display = 'flex';
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').style.display = 'none';
        pendingForm = null;
    }

    document.getElementById('confirmDeleteBtn').addEventListener('click', () => {
        if (pendingForm) pendingForm.submit();
    });

    document.getElementById('deleteModal').addEventListener('click', function(e) {
        if (e.target === this) closeDeleteModal();
    });

    // Live search
    document.getElementById('postSearch').addEventListener('input', function () {
        const q = this.value.toLowerCase();
        const rows = document.querySelectorAll('#postTableBody tr');
        let visible = 0;
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            const match = text.includes(q);
            row.style.display = match ? '' : 'none';
            if (match) visible++;
        });
        document.getElementById('rowCount').textContent =
            `Showing ${visible} post${visible !== 1 ? 's' : ''}`;
    });
</script>

@endsection