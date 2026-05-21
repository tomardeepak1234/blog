@extends('admin.admin_meta')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=Karla:wght@300;400;500&display=swap');

    :root {
        --bg:          #0d0d14;
        --surface:     #13131f;
        --surface2:    #1a1a2a;
        --border:      #252538;
        --accent:      #6c63ff;
        --accent2:     #a78bfa;
        --danger:      #ff4f6b;
        --danger-dim:  rgba(255,79,107,0.12);
        --success:     #34d399;
        --text:        #e8e8f0;
        --muted:       #6b6b8a;
        --white:       #ffffff;
    }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    .ul-wrapper {
        min-height: 100vh;
        background: var(--bg);
        font-family: 'Karla', sans-serif;
        padding: 2rem 2rem;
        color: var(--text);
        position: relative;
        left: 3%;
    }

    .ul-wrapper::before {
        content: '';
        position: fixed;
        top: -20%; left: 30%;
        width: 600px; height: 600px;
        background: radial-gradient(circle, rgba(108,99,255,0.08) 0%, transparent 65%);
        pointer-events: none;
        z-index: 0;
    }

    .ul-inner {
        max-width: 1100px;
        margin: 0 auto;
        position: relative;
        z-index: 1;
    }

    /* Page Header */
    .page-top {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        margin-bottom: 2rem;
        gap: 1rem;
        flex-wrap: wrap;
        animation: fadeDown 0.5s ease forwards;
    }

    @keyframes fadeDown {
        from { opacity: 0; transform: translateY(-16px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(16px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .page-eyebrow {
        font-size: 0.68rem;
        font-weight: 500;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        color: var(--accent2);
        margin-bottom: 0.4rem;
    }

    .page-title {
        font-family: 'Syne', sans-serif;
        font-size: 2rem;
        font-weight: 800;
        color: var(--white);
        line-height: 1;
    }

    /* ── CHANGE 1: btn-group wrapper ── */
    .btn-group {
        display: flex;
        align-items: center;
        gap: 0.6rem;
    }

    .btn-add {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.7rem 1.5rem;
        background: var(--accent);
        color: var(--white);
        font-family: 'Karla', sans-serif;
        font-size: 0.85rem;
        font-weight: 500;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.2s;
        box-shadow: 0 0 24px rgba(108,99,255,0.35);
        white-space: nowrap;
    }
    .btn-add:hover {
        background: #7c74ff;
        box-shadow: 0 0 36px rgba(108,99,255,0.55);
        transform: translateY(-1px);
        color: var(--white);
    }

    /* ── CHANGE 2: Export button style ── */
    .btn-export {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.7rem 1.5rem;
        background: rgba(52,211,153,0.1);
        color: var(--success);
        font-family: 'Karla', sans-serif;
        font-size: 0.85rem;
        font-weight: 500;
        border: 1px solid rgba(52,211,153,0.28);
        border-radius: 8px;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.2s;
        white-space: nowrap;
    }
    .btn-export:hover {
        background: rgba(52,211,153,0.2);
        border-color: rgba(52,211,153,0.5);
        transform: translateY(-1px);
    }

    /* Stats */
    .stats-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
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
        transition: border-color 0.2s;
    }
    .stat-card:hover { border-color: rgba(108,99,255,0.3); }

    .stat-dot { width: 6px; height: 6px; border-radius: 50%; background: var(--accent2); margin-bottom: 0.2rem; }
    .stat-label { font-size: 0.68rem; text-transform: uppercase; letter-spacing: 0.12em; color: var(--muted); font-weight: 500; }
    .stat-value { font-family: 'Syne', sans-serif; font-size: 1.9rem; font-weight: 700; color: var(--white); }

    /* Table Card */
    .table-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 16px;
        overflow: hidden;
        animation: fadeUp 0.5s 0.2s ease both;
    }

    /* Toolbar */
    .table-toolbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 1rem 1.5rem;
        border-bottom: 1px solid var(--border);
        gap: 1rem;
        flex-wrap: wrap;
        background: rgba(255,255,255,0.015);
    }

    .toolbar-title {
        font-family: 'Syne', sans-serif;
        font-size: 0.9rem;
        font-weight: 600;
        color: var(--text);
    }

    .toolbar-search {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .toolbar-search input {
        background: var(--surface2);
        border: 1px solid var(--border);
        color: var(--text);
        padding: 0.42rem 0.9rem;
        border-radius: 7px;
        font-family: 'Karla', sans-serif;
        font-size: 0.82rem;
        outline: none;
        width: 200px;
        transition: border-color 0.2s, box-shadow 0.2s;
    }
    .toolbar-search input:focus {
        border-color: var(--accent);
        box-shadow: 0 0 0 3px rgba(108,99,255,0.1);
    }
    .toolbar-search input::placeholder { color: var(--muted); }

    /* Table */
    .user-table {
        width: 100%;
        border-collapse: collapse;
        table-layout: fixed;
    }

    .user-table thead tr { background: var(--surface2); }

    .user-table thead th {
        padding: 0.85rem 1.2rem;
        font-family: 'Syne', sans-serif;
        font-size: 0.65rem;
        font-weight: 600;
        letter-spacing: 0.14em;
        text-transform: uppercase;
        color: var(--muted);
        border: none;
        border-bottom: 1px solid var(--border);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .user-table tbody tr {
        border-bottom: 1px solid rgba(37,37,56,0.7);
        transition: background 0.15s;
    }
    .user-table tbody tr:last-child { border-bottom: none; }
    .user-table tbody tr:hover { background: rgba(108,99,255,0.035); }

    .user-table tbody td {
        padding: 0.9rem 1.2rem;
        font-size: 0.875rem;
        color: var(--text);
        border: none;
        vertical-align: middle;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .user-table tbody td.empty-cell {
        text-align: center;
        padding: 3rem;
        color: var(--muted);
        font-size: 0.9rem;
    }

    /* Cell components */
    .sno-badge {
        display: inline-block;
        background: var(--surface2);
        border: 1px solid var(--border);
        color: var(--muted);
        font-family: 'Syne', sans-serif;
        font-size: 0.7rem;
        font-weight: 600;
        padding: 0.18rem 0.55rem;
        border-radius: 5px;
    }

    .user-cell {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        overflow: hidden;
    }

    .user-avatar {
        width: 34px; height: 34px;
        border-radius: 8px;
        object-fit: cover;
        flex-shrink: 0;
        border: 1.5px solid rgba(108,99,255,0.25);
    }

    .user-avatar-initials {
        width: 34px; height: 34px;
        border-radius: 8px;
        background: linear-gradient(135deg, var(--accent), var(--accent2));
        display: flex; align-items: center; justify-content: center;
        font-family: 'Syne', sans-serif;
        font-size: 0.7rem;
        font-weight: 700;
        color: var(--white);
        flex-shrink: 0;
    }

    .user-name {
        font-weight: 500;
        color: var(--white);
        font-size: 0.875rem;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .cell-muted { color: var(--muted); font-size: 0.82rem; }

    .role-badge {
        display: inline-block;
        padding: 0.18rem 0.65rem;
        border-radius: 20px;
        font-size: 0.68rem;
        font-weight: 600;
        background: rgba(108,99,255,0.14);
        color: var(--accent2);
        border: 1px solid rgba(108,99,255,0.25);
        white-space: nowrap;
    }

    .state-badge {
        display: inline-block;
        padding: 0.18rem 0.65rem;
        border-radius: 20px;
        font-size: 0.68rem;
        font-weight: 600;
        background: rgba(52,211,153,0.1);
        color: var(--success);
        border: 1px solid rgba(52,211,153,0.22);
        white-space: nowrap;
    }

    .action-wrap {
        display: flex;
        align-items: center;
        gap: 0.4rem;
        justify-content: center;
    }

    .btn-edit-u {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        padding: 0.35rem 0.75rem;
        background: rgba(108,99,255,0.1);
        color: var(--accent2);
        border: 1px solid rgba(108,99,255,0.22);
        border-radius: 6px;
        font-family: 'Karla', sans-serif;
        font-size: 0.75rem;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.2s;
        white-space: nowrap;
    }
    .btn-edit-u:hover { background: rgba(108,99,255,0.22); color: var(--accent2); border-color: rgba(108,99,255,0.45); }

    .btn-delete-u {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        padding: 0.35rem 0.75rem;
        background: var(--danger-dim);
        color: var(--danger);
        border: 1px solid rgba(255,79,107,0.22);
        border-radius: 6px;
        font-family: 'Karla', sans-serif;
        font-size: 0.75rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
        white-space: nowrap;
    }
    .btn-delete-u:hover { background: rgba(255,79,107,0.2); border-color: rgba(255,79,107,0.48); }

    /* Table Footer */
    .table-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 0.75rem;
        padding: 1rem 1.5rem;
        border-top: 1px solid var(--border);
        background: rgba(255,255,255,0.01);
    }

    .table-info { font-size: 0.76rem; color: var(--muted); }

    /* Laravel Pagination */
    .pagination {
        display: flex;
        align-items: center;
        gap: 0.25rem;
        list-style: none;
        margin: 0; padding: 0;
    }
    .pagination .page-item .page-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 30px;
        height: 30px;
        padding: 0 0.5rem;
        border-radius: 6px;
        font-size: 0.78rem;
        font-family: 'Karla', sans-serif;
        color: var(--muted);
        background: transparent;
        border: 1px solid transparent;
        text-decoration: none;
        transition: all 0.15s;
    }
    .pagination .page-item .page-link:hover { background: var(--surface2); color: var(--text); border-color: var(--border); }
    .pagination .page-item.active .page-link { background: var(--accent); color: var(--white); border-color: var(--accent); }
    .pagination .page-item.disabled .page-link { opacity: 0.35; cursor: default; pointer-events: none; }

    /* Custom Pagination */
    .custom-pagination {
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }

    .pg-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 30px;
        height: 30px;
        padding: 0 0.5rem;
        border-radius: 6px;
        font-size: 0.78rem;
        font-family: 'Karla', sans-serif;
        color: var(--muted);
        background: transparent;
        border: 1px solid transparent;
        text-decoration: none;
        transition: all 0.15s;
        cursor: pointer;
    }
    .pg-btn:hover { background: var(--surface2); color: var(--text); border-color: var(--border); }
    .pg-btn--active { background: var(--accent) !important; color: var(--white) !important; border-color: var(--accent) !important; }
    .pg-btn--disabled { opacity: 0.3; cursor: default; pointer-events: none; }

    /* Delete Modal */
    #deleteModal {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.65);
        backdrop-filter: blur(5px);
        z-index: 9999;
        align-items: center;
        justify-content: center;
    }

    .modal-box {
        background: #1a1a2a;
        border: 1px solid #2e2e48;
        border-radius: 16px;
        padding: 2rem;
        max-width: 380px;
        width: 90%;
        text-align: center;
        animation: fadeDown 0.25s ease;
    }

    .modal-icon {
        width: 52px; height: 52px;
        background: rgba(255,79,107,0.12);
        border-radius: 12px;
        margin: 0 auto 1.2rem;
        display: flex; align-items: center; justify-content: center;
    }

    .modal-title { font-family: 'Syne', sans-serif; font-size: 1.1rem; color: var(--white); margin-bottom: 0.5rem; }
    .modal-desc { font-size: 0.82rem; color: var(--muted); margin-bottom: 1.5rem; line-height: 1.6; }
    .modal-actions { display: flex; gap: 0.75rem; justify-content: center; }

    .btn-modal-cancel {
        padding: 0.6rem 1.4rem;
        background: transparent;
        border: 1px solid var(--border);
        color: var(--muted);
        border-radius: 8px;
        font-family: 'Karla', sans-serif;
        font-size: 0.85rem;
        cursor: pointer;
        transition: all 0.2s;
    }
    .btn-modal-cancel:hover { border-color: var(--muted); color: var(--text); }

    .btn-modal-confirm {
        padding: 0.6rem 1.4rem;
        background: var(--danger);
        border: none;
        color: var(--white);
        border-radius: 8px;
        font-family: 'Karla', sans-serif;
        font-size: 0.85rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
        box-shadow: 0 0 16px rgba(255,79,107,0.3);
    }
    .btn-modal-confirm:hover { background: #ff3357; box-shadow: 0 0 24px rgba(255,79,107,0.5); }

    /* ── CHANGE 3: Export Modal styles ── */
    #exportModal {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.65);
        backdrop-filter: blur(5px);
        z-index: 9999;
        align-items: center;
        justify-content: center;
    }

    .export-modal-box {
        background: #1a1a2a;
        border: 1px solid #2e2e48;
        border-radius: 16px;
        width: 400px;
        max-width: 92%;
        overflow: hidden;
        animation: fadeDown 0.25s ease;
    }

    .export-modal-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 1.1rem 1.4rem;
        border-bottom: 1px solid var(--border);
    }

    .export-modal-title {
        font-family: 'Syne', sans-serif;
        font-size: 0.95rem;
        font-weight: 700;
        color: var(--white);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .export-modal-close {
        background: none;
        border: none;
        color: var(--muted);
        font-size: 1.3rem;
        cursor: pointer;
        line-height: 1;
        padding: 0 4px;
        transition: color 0.2s;
    }
    .export-modal-close:hover { color: var(--text); }

    .export-modal-body { padding: 1.3rem 1.4rem; }

    .export-date-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0.85rem;
        margin-bottom: 0.75rem;
    }

    .export-field-label {
        display: block;
        font-size: 0.68rem;
        font-weight: 600;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: var(--muted);
        margin-bottom: 0.4rem;
    }

    .export-date-input {
        width: 100%;
        height: 40px;
        padding: 0 0.85rem;
        background: var(--surface2);
        border: 1px solid var(--border);
        border-radius: 8px;
        color: var(--text);
        font-family: 'Karla', sans-serif;
        font-size: 0.85rem;
        outline: none;
        transition: border-color 0.2s, box-shadow 0.2s;
    }
    .export-date-input:focus {
        border-color: var(--success);
        box-shadow: 0 0 0 3px rgba(52,211,153,0.1);
    }

    .export-hint {
        font-size: 0.74rem;
        color: var(--muted);
        line-height: 1.5;
        margin-top: 0.3rem;
    }

    .export-modal-footer {
        display: flex;
        gap: 0.65rem;
        padding: 1rem 1.4rem;
        border-top: 1px solid var(--border);
    }

    .btn-export-cancel {
        flex: 1;
        padding: 0.65rem;
        background: transparent;
        border: 1px solid var(--border);
        color: var(--muted);
        border-radius: 8px;
        font-family: 'Karla', sans-serif;
        font-size: 0.85rem;
        cursor: pointer;
        transition: all 0.2s;
    }
    .btn-export-cancel:hover { border-color: var(--muted); color: var(--text); }

    .btn-export-submit {
        flex: 2;
        padding: 0.65rem;
        background: var(--success);
        border: none;
        color: #0d0d14;
        border-radius: 8px;
        font-family: 'Karla', sans-serif;
        font-size: 0.85rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.4rem;
        box-shadow: 0 0 16px rgba(52,211,153,0.25);
    }
    .btn-export-submit:hover { background: #2bc889; box-shadow: 0 0 24px rgba(52,211,153,0.45); }

    @media (max-width: 768px) {
        .ul-wrapper { padding: 1.5rem 1rem; left: 0; }
        .page-title { font-size: 1.6rem; }
        .user-table thead th, .user-table tbody td { padding: 0.75rem 0.85rem; }
        .toolbar-search input { width: 140px; }
        .export-date-grid { grid-template-columns: 1fr; }
    }

    nav { width: 100% }

</style>

<div class="ul-wrapper">
<div class="ul-inner">

    {{-- Page Header --}}
    <div class="page-top">
        <div>
            <p class="page-eyebrow">Admin Panel</p>
            <h1 class="page-title">User Listing</h1>
        </div>

        {{-- CHANGE 1: btn-group wraps both buttons --}}
        <div class="btn-group">
            <a href="{{ route('user.register') }}" class="btn-add">
                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                </svg>
                Add User
            </a>

            {{-- CHANGE 2: Export button --}}
            <button type="button" class="btn-export" onclick="document.getElementById('exportModal').style.display='flex'">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                    <polyline points="7 10 12 15 17 10"/>
                    <line x1="12" y1="15" x2="12" y2="3"/>
                </svg>
                Export
            </button>
        </div>
    </div>

    {{-- Stats --}}
    <div class="stats-row">
        <div class="stat-card">
            <div class="stat-dot"></div>
            <span class="stat-label">Total Users</span>
            <span class="stat-value">{{ $users->total() }}</span>
        </div>
        <div class="stat-card">
            <div class="stat-dot" style="background: var(--success)"></div>
            <span class="stat-label">This Month</span>
            <span class="stat-value">
                {{ $users->getCollection()->filter(fn($u) => $u->created_at->isCurrentMonth())->count() }}
            </span>
        </div>
        <div class="stat-card">
            <div class="stat-dot" style="background: var(--accent)"></div>
            <span class="stat-label">Unique Roles</span>
            <span class="stat-value">
                {{ $users->getCollection()->pluck('role.name')->filter()->unique()->count() }}
            </span>
        </div>
    </div>

    {{-- Table Card --}}
    <div class="table-card">

        {{-- Toolbar --}}
        <div class="table-toolbar">
            <span class="toolbar-title">All Users</span>
            <div class="toolbar-search">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none"
                     stroke="var(--muted)" stroke-width="2">
                    <circle cx="11" cy="11" r="8"/>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
                <input type="text" id="tableSearch" placeholder="Search users...">
            </div>
        </div>

        {{-- Table --}}
        <div style="overflow-x: auto;">
            <table class="user-table" id="userTable">
                <thead>
                    <tr>
                        <th style="width:65px;">S.No</th>
                        <th style="width:190px;">Name</th>
                        <th style="width:200px;">Email</th>
                        <th style="width:130px;">Phone</th>
                        <th style="width:100px;">Role</th>
                        <th style="width:110px;">State</th>
                        <th style="width:140px; text-align:center;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr>
                        <td>
                            <span class="sno-badge">
                                {{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}
                            </span>
                        </td>

                        <td>
                            <div class="user-cell">
                                @if($user->profile_image)
                                    <img src="{{ asset('storage/' . $user->profile_image) }}"
                                         alt="{{ $user->first_name }}" class="user-avatar">
                                @else
                                    <div class="user-avatar-initials">
                                        {{ strtoupper(substr($user->first_name ?? $user->name ?? '?', 0, 2)) }}
                                    </div>
                                @endif
                                <span class="user-name">
                                    {{ trim(($user->first_name ?? '') . ' ' . ($user->last_name ?? '')) ?: '—' }}
                                </span>
                            </div>
                        </td>

                        <td><span class="cell-muted">{{ $user->email }}</span></td>

                        <td><span class="cell-muted">{{ $user->phone ?? '—' }}</span></td>

                        <td>
                            @if($user->role?->name)
                                <span class="role-badge">{{ $user->role->name }}</span>
                            @else
                                <span class="cell-muted">N/A</span>
                            @endif
                        </td>

                        <td>
                            @if($user->state?->name)
                                <span class="state-badge">{{ $user->state->name }}</span>
                            @else
                                <span class="cell-muted">N/A</span>
                            @endif
                        </td>

                        <td>
                            <div class="action-wrap">
                                <a href="{{ route('user.edit', $user->id) }}" class="btn-edit-u">
                                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none"
                                         stroke="currentColor" stroke-width="2">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                    </svg>
                                    Edit
                                </a>
                                <form action="{{ route('user.delete', $user->id) }}"
                                      method="POST" style="margin:0;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn-delete-u"
                                            onclick="confirmDelete(this)">
                                        <svg width="11" height="11" viewBox="0 0 24 24" fill="none"
                                             stroke="currentColor" stroke-width="2">
                                            <polyline points="3 6 5 6 21 6"/>
                                            <path d="M19 6l-1 14H6L5 6"/>
                                            <path d="M9 6V4h6v2"/>
                                        </svg>
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="empty-cell">📭 No users found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Footer --}}
        <div class="table-footer">
            {{ $users->links('pagination::bootstrap-5') }}
        </div>

    </div>
</div>
</div>

{{-- Delete Modal --}}
<div id="deleteModal">
    <div class="modal-box">
        <div class="modal-icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#ff4f6b" stroke-width="2">
                <polyline points="3 6 5 6 21 6"/>
                <path d="M19 6l-1 14H6L5 6"/>
                <path d="M9 6V4h6v2"/>
            </svg>
        </div>
        <h3 class="modal-title">Delete User?</h3>
        <p class="modal-desc">This action cannot be undone. The user will be permanently removed.</p>
        <div class="modal-actions">
            <button class="btn-modal-cancel" onclick="closeDeleteModal()">Cancel</button>
            <button class="btn-modal-confirm" id="confirmDeleteBtn">Yes, Delete</button>
        </div>
    </div>
</div>

{{-- CHANGE 3: Export Modal --}}
<div id="exportModal">
    <div class="export-modal-box">

        <div class="export-modal-header">
            <span class="export-modal-title">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--success)" stroke-width="2.5">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                    <polyline points="7 10 12 15 17 10"/>
                    <line x1="12" y1="15" x2="12" y2="3"/>
                </svg>
                Export Users
            </span>
            <button class="export-modal-close" onclick="closeExportModal()">×</button>
        </div>

        <form method="GET" action="{{ route('user.export') }}">
            <div class="export-modal-body">
                <div class="export-date-grid">
                    <div>
                        <label class="export-field-label" for="from_date">From date</label>
                        <input type="date" id="from_date" name="from_date"
                               class="export-date-input" required
                               value="{{ request('from_date') }}">
                    </div>
                    <div>
                        <label class="export-field-label" for="to_date">To date</label>
                        <input type="date" id="to_date" name="to_date"
                               class="export-date-input" required
                               value="{{ request('to_date') }}">
                    </div>
                </div>
                <p class="export-hint">
                    Selected date range ke users CSV file mein export honge.
                </p>
            </div>

            <div class="export-modal-footer">
                <button type="button" class="btn-export-cancel" onclick="closeExportModal()">
                    Cancel
                </button>
                <button type="submit" class="btn-export-submit">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                        <polyline points="7 10 12 15 17 10"/>
                        <line x1="12" y1="15" x2="12" y2="3"/>
                    </svg>
                    Export Now
                </button>
            </div>
        </form>

    </div>
</div>

<script>
    // Table search
    document.getElementById('tableSearch').addEventListener('input', function () {
        const q = this.value.toLowerCase();
        document.querySelectorAll('#userTable tbody tr').forEach(row => {
            row.style.display = row.textContent.toLowerCase().includes(q) ? '' : 'none';
        });
    });

    // Delete Modal
    let pendingForm = null;

    function confirmDelete(btn) {
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

    document.getElementById('deleteModal').addEventListener('click', function (e) {
        if (e.target === this) closeDeleteModal();
    });

    // Export Modal
    function closeExportModal() {
        document.getElementById('exportModal').style.display = 'none';
    }

    document.getElementById('exportModal').addEventListener('click', function (e) {
        if (e.target === this) closeExportModal();
    });

    // Auto date validation: to_date >= from_date
    document.getElementById('from_date').addEventListener('change', function () {
        document.getElementById('to_date').min = this.value;
    });
</script>

@endsection
