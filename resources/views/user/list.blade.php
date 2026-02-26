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
        --success: #34d399;
        --text: #e8e8f0;
        --muted: #6b6b8a;
        --white: #ffffff;
    }

    * { box-sizing: border-box; margin: 0; padding: 0; }

    .ul-wrapper {
        min-height: 100vh;
        background: var(--bg);
        font-family: 'Karla', sans-serif;
        padding: 2.5rem 2rem;
        color: var(--text);
    }

    /* Ambient glow */
    .ul-wrapper::before {
        content: '';
        position: fixed;
        top: -20%;
        left: 30%;
        width: 600px;
        height: 600px;
        background: radial-gradient(circle, rgba(108,99,255,0.08) 0%, transparent 65%);
        pointer-events: none;
        z-index: 0;
    }

    .ul-inner {
        max-width: 1100px;
        margin: 0 auto;
        position: relative;
        z-index: 1;
        left: 3%;
    }

    /* ── Page Header ── */
    .page-top {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        margin-bottom: 2.5rem;
        gap: 1rem;
        flex-wrap: wrap;
        animation: fadeDown 0.5s ease forwards;
    }

    @keyframes fadeDown {
        from { opacity:0; transform: translateY(-16px); }
        to   { opacity:1; transform: translateY(0); }
    }

    .page-top-left .eyebrow {
        font-size: 0.68rem;
        font-weight: 500;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        color: var(--accent2);
        margin-bottom: 0.4rem;
    }

    .page-top-left h1 {
        font-family: 'Syne', sans-serif;
        font-size: 2rem;
        font-weight: 800;
        color: var(--white);
        line-height: 1;
    }

    .btn-add {
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

    .btn-add:hover {
        background: #7c74ff;
        box-shadow: 0 0 36px rgba(108,99,255,0.55);
        transform: translateY(-1px);
        color: var(--white);
    }

    .btn-add svg { width: 16px; height: 16px; }

    /* ── Stats Row ── */
    .stats-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
        gap: 1rem;
        margin-bottom: 2rem;
        animation: fadeUp 0.5s 0.1s ease both;
    }

    @keyframes fadeUp {
        from { opacity:0; transform: translateY(16px); }
        to   { opacity:1; transform: translateY(0); }
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

    .stat-card .stat-label {
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 0.12em;
        color: var(--muted);
        font-weight: 500;
    }

    .stat-card .stat-value {
        font-family: 'Syne', sans-serif;
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--white);
    }

    .stat-card .stat-dot {
        width: 6px; height: 6px;
        border-radius: 50%;
        background: var(--accent2);
        margin-bottom: 0.2rem;
    }

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

    .table-toolbar .toolbar-title {
        font-family: 'Syne', sans-serif;
        font-size: 0.95rem;
        font-weight: 600;
        color: var(--text);
    }

    /* Search override for DataTables */
    .dataTables_filter label {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--muted);
        font-size: 0.82rem;
    }

    .dataTables_filter input {
        background: var(--surface2);
        border: 1px solid var(--border);
        color: var(--text);
        padding: 0.45rem 0.9rem;
        border-radius: 6px;
        font-family: 'Karla', sans-serif;
        font-size: 0.85rem;
        outline: none;
        transition: border-color 0.2s;
        margin-left: 0.4rem !important;
    }

    .dataTables_filter input:focus {
        border-color: var(--accent);
    }

    .dataTables_length label {
        color: var(--muted);
        font-size: 0.82rem;
        display: flex;
        align-items: center;
        gap: 0.4rem;
    }

    .dataTables_length select {
        background: var(--surface2);
        border: 1px solid var(--border);
        color: var(--text);
        padding: 0.4rem 0.6rem;
        border-radius: 6px;
        font-family: 'Karla', sans-serif;
        font-size: 0.82rem;
        outline: none;
        margin: 0 0.3rem;
    }

    /* ── Table ── */
    #userTable {
        width: 100% !important;
        border-collapse: collapse;
    }

    #userTable thead tr {
        background: var(--surface2);
    }

    #userTable thead th {
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

    #userTable thead th.sorting,
    #userTable thead th.sorting_asc,
    #userTable thead th.sorting_desc {
        cursor: pointer;
    }

    #userTable thead th.sorting_asc { color: var(--accent2); }
    #userTable thead th.sorting_desc { color: var(--accent2); }

    #userTable tbody tr {
        border-bottom: 1px solid var(--border);
        transition: background 0.15s ease;
    }

    #userTable tbody tr:hover {
        background: rgba(108, 99, 255, 0.04);
    }

    #userTable tbody tr:last-child { border-bottom: none; }

    #userTable tbody td {
        padding: 1rem 1.2rem;
        font-size: 0.88rem;
        color: var(--text);
        border: none;
        vertical-align: middle;
    }

    /* ID badge */
    .id-badge {
        display: inline-block;
        background: var(--surface2);
        border: 1px solid var(--border);
        color: var(--muted);
        font-family: 'Syne', sans-serif;
        font-size: 0.75rem;
        padding: 0.15rem 0.6rem;
        border-radius: 4px;
    }

    /* Avatar + Name */
    .user-cell {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .user-avatar {
        width: 34px;
        height: 34px;
        border-radius: 8px;
        background: linear-gradient(135deg, var(--accent), var(--accent2));
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Syne', sans-serif;
        font-size: 0.75rem;
        font-weight: 700;
        color: var(--white);
        flex-shrink: 0;
    }

    .user-name {
        font-weight: 500;
        color: var(--white);
    }

    /* Role badge */
    .role-badge {
        display: inline-block;
        padding: 0.2rem 0.7rem;
        border-radius: 20px;
        font-size: 0.72rem;
        font-weight: 500;
        letter-spacing: 0.05em;
        background: rgba(108,99,255,0.15);
        color: var(--accent2);
        border: 1px solid rgba(108,99,255,0.25);
    }

    /* Action buttons */
    .action-wrap {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-edit-u {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        padding: 0.4rem 0.9rem;
        background: rgba(108,99,255,0.12);
        color: var(--accent2);
        border: 1px solid rgba(108,99,255,0.25);
        border-radius: 6px;
        font-family: 'Karla', sans-serif;
        font-size: 0.78rem;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .btn-edit-u:hover {
        background: rgba(108,99,255,0.25);
        color: var(--accent2);
        border-color: rgba(108,99,255,0.5);
    }

    .btn-delete-u {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        padding: 0.4rem 0.9rem;
        background: var(--danger-dim);
        color: var(--danger);
        border: 1px solid rgba(255,79,107,0.25);
        border-radius: 6px;
        font-family: 'Karla', sans-serif;
        font-size: 0.78rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .btn-delete-u:hover {
        background: rgba(255,79,107,0.22);
        border-color: rgba(255,79,107,0.5);
    }

    /* DataTables pagination */
    .dataTables_paginate {
        padding: 1rem 1.5rem;
        text-align: right;
    }

    .dataTables_paginate .paginate_button {
        display: inline-block;
        padding: 0.35rem 0.75rem;
        margin: 0 0.1rem;
        border-radius: 6px;
        font-size: 0.82rem;
        cursor: pointer;
        color: var(--muted) !important;
        transition: all 0.15s;
        border: 1px solid transparent !important;
        background: transparent !important;
    }

    .dataTables_paginate .paginate_button:hover {
        background: var(--surface2) !important;
        color: var(--text) !important;
        border-color: var(--border) !important;
    }

    .dataTables_paginate .paginate_button.current {
        background: var(--accent) !important;
        color: var(--white) !important;
        border-color: var(--accent) !important;
    }

    .dataTables_paginate .paginate_button.disabled {
        opacity: 0.3;
        cursor: default;
    }

    .dataTables_info {
        padding: 1rem 1.5rem 0;
        font-size: 0.78rem;
        color: var(--muted);
    }

    .dt-bottom-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        border-top: 1px solid var(--border);
    }

    @media (max-width: 700px) {
        .ul-wrapper { padding: 1.5rem 1rem; }
        .page-top-left h1 { font-size: 1.5rem; }
        #userTable thead th, #userTable tbody td { padding: 0.7rem 0.8rem; }
    }
</style>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<div class="ul-wrapper">
<div class="ul-inner">

    {{-- Page Top --}}
    <div class="page-top">
        <div class="page-top-left">
            <p class="eyebrow">Admin Panel</p>
            <h1>User Listing</h1>
        </div>
        <a href="{{ route('user.register') }}" class="btn-add">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Add User
        </a>
    </div>

    {{-- Stats --}}
    <div class="stats-row">
        <div class="stat-card">
            <div class="stat-dot"></div>
            <span class="stat-label">Total Users</span>
            <span class="stat-value">{{ $users->count() }}</span>
        </div>
        <div class="stat-card">
            <div class="stat-dot" style="background: var(--success)"></div>
            <span class="stat-label">This Month</span>
            <span class="stat-value">{{ $users->filter(fn($u) => $u->created_at->isCurrentMonth())->count() }}</span>
        </div>
        <div class="stat-card">
            <div class="stat-dot" style="background: var(--accent)"></div>
            <span class="stat-label">Roles</span>
            <span class="stat-value">{{ $users->pluck('role.name')->filter()->unique()->count() }}</span>
        </div>
    </div>

    {{-- Table --}}
    <div class="table-card">
        <div class="table-toolbar">
            <span class="toolbar-title">All Users</span>
        </div>

        <div style="overflow-x: auto;">
            <table id="userTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Role</th>
                        <th>Joined</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td><span class="id-badge">#{{ $user->id }}</span></td>
                        <td>
                            <div class="user-cell">
                                <div class="user-avatar">
                                    {{ strtoupper(substr($user->name ?? $user->first_name ?? '?', 0, 2)) }}
                                </div>
                                <span class="user-name">{{ $user->name ?? $user->first_name }}</span>
                            </div>
                        </td>
                        <td style="color: var(--muted)">{{ $user->email }}</td>
                        <td style="color: var(--muted)">{{ $user->phone ?? '—' }}</td>
                        <td>
                            @if($user->role?->name)
                                <span class="role-badge">{{ $user->role->name }}</span>
                            @else
                                <span style="color: var(--muted)">—</span>
                            @endif
                        </td>
                        <td style="color: var(--muted); font-size: 0.82rem;">{{ $user->created_at->format('d M Y') }}</td>
                        <td>
                            <div class="action-wrap">
                                <a href="{{ route('user.edit', $user->id) }}" class="btn-edit-u">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                    Edit
                                </a>
                                <form action="{{ route('user.delete', $user->id) }}" method="POST" style="margin:0">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn-delete-u"
                                        onclick="confirmDelete(this)">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M10 11v6M14 11v6"/><path d="M9 6V4h6v2"/></svg>
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="dt-bottom-row">
            <div class="dataTables_info" id="userTable_info"></div>
            <div class="dataTables_paginate" id="userTable_paginate"></div>
        </div>
    </div>

</div>
</div>

{{-- Delete Confirm Modal --}}
<div id="deleteModal" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.6); backdrop-filter:blur(4px); z-index:9999; align-items:center; justify-content:center;">
    <div style="background: #1a1a2a; border:1px solid #252538; border-radius:16px; padding:2rem; max-width:380px; width:90%; text-align:center; animation: fadeDown 0.25s ease;">
        <div style="width:52px;height:52px;background:rgba(255,79,107,0.12);border-radius:12px;margin:0 auto 1.2rem;display:flex;align-items:center;justify-content:center;">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#ff4f6b" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M9 6V4h6v2"/></svg>
        </div>
        <h3 style="font-family:'Syne',sans-serif;font-size:1.1rem;color:#fff;margin-bottom:0.6rem;">Delete User?</h3>
        <p style="font-size:0.85rem;color:#6b6b8a;margin-bottom:1.5rem;">This action cannot be undone. The user will be permanently removed.</p>
        <div style="display:flex;gap:0.75rem;justify-content:center;">
            <button onclick="closeModal()" style="padding:0.6rem 1.4rem;background:transparent;border:1px solid #252538;color:#6b6b8a;border-radius:8px;font-family:'Karla',sans-serif;font-size:0.85rem;cursor:pointer;">Cancel</button>
            <button id="confirmDeleteBtn" style="padding:0.6rem 1.4rem;background:#ff4f6b;border:none;color:#fff;border-radius:8px;font-family:'Karla',sans-serif;font-size:0.85rem;cursor:pointer;font-weight:500;">Yes, Delete</button>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function () {
    $('#userTable').DataTable({
        pageLength: 10,
        lengthMenu: [5, 10, 25, 50],
        dom: '<"table-toolbar-dt"lf>t<"dt-bottom-row"ip>',
        language: {
            search: '',
            searchPlaceholder: 'Search users...',
            lengthMenu: 'Show _MENU_ rows',
            info: 'Showing _START_–_END_ of _TOTAL_ users',
            paginate: { previous: '←', next: '→' }
        },
        initComplete: function() {
            // Move DataTables controls into our toolbar
            $('.dataTables_filter').appendTo('.table-toolbar');
            $('.dataTables_length').appendTo('.table-toolbar');
        }
    });
});

let pendingForm = null;

function confirmDelete(btn) {
    pendingForm = btn.closest('form');
    const modal = document.getElementById('deleteModal');
    modal.style.display = 'flex';
}

function closeModal() {
    document.getElementById('deleteModal').style.display = 'none';
    pendingForm = null;
}

document.getElementById('confirmDeleteBtn').addEventListener('click', function () {
    if (pendingForm) pendingForm.submit();
});

document.getElementById('deleteModal').addEventListener('click', function(e) {
    if (e.target === this) closeModal();
});
</script>

@endsection