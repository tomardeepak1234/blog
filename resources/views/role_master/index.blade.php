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
        --success-dim: rgba(52,211,153,0.1);
        --amber: #fbbf24;
        --amber-dim: rgba(251,191,36,0.1);
        --text: #e8e8f0;
        --muted: #6b6b8a;
        --white: #ffffff;
    }

    * { box-sizing: border-box; margin: 0; padding: 0; }

    .rm-wrapper {
        min-height: 100vh;
        background: var(--bg);
        font-family: 'Karla', sans-serif;
        padding: 2.5rem 2rem;
        color: var(--text);
        position: relative;
        left:4%;
    }

    .rm-wrapper::before {
        content: '';
        position: fixed;
        top: -10%;
        left: 25%;
        width: 550px;
        height: 550px;
        background: radial-gradient(circle, rgba(108,99,255,0.07) 0%, transparent 65%);
        pointer-events: none;
        z-index: 0;
    }

    .rm-inner {
        max-width: 1100px;
        margin: 0 auto;
        position: relative;
        z-index: 1;
    }

    /* ── Animations ── */
    @keyframes fadeDown {
        from { opacity:0; transform:translateY(-14px); }
        to   { opacity:1; transform:translateY(0); }
    }
    @keyframes fadeUp {
        from { opacity:0; transform:translateY(16px); }
        to   { opacity:1; transform:translateY(0); }
    }
    @keyframes slideIn {
        from { opacity:0; transform:translateX(-12px); }
        to   { opacity:1; transform:translateX(0); }
    }

    /* ── Header ── */
    .rm-header {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        margin-bottom: 2rem;
        gap: 1rem;
        flex-wrap: wrap;
        animation: fadeDown 0.5s ease forwards;
    }

    .rm-header-left .eyebrow {
        font-size: 0.68rem;
        font-weight: 500;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        color: var(--accent2);
        margin-bottom: 0.4rem;
    }

    .rm-header-left h1 {
        font-family: 'Syne', sans-serif;
        font-size: 2rem;
        font-weight: 800;
        color: var(--white);
        line-height: 1;
    }

    .rm-header-icon {
        width: 48px; height: 48px;
        border-radius: 12px;
        background: linear-gradient(135deg, var(--accent), var(--accent2));
        display: flex; align-items: center; justify-content: center;
        font-size: 1.4rem;
        box-shadow: 0 0 20px rgba(108,99,255,0.35);
    }

    /* ── Toast ── */
    .rm-toast {
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
        animation: slideIn 0.4s ease forwards;
    }

    .rm-toast .toast-close {
        margin-left: auto;
        background: none;
        border: none;
        color: var(--success);
        cursor: pointer;
        font-size: 1rem;
        padding: 0;
        line-height: 1;
        opacity: 0.7;
    }
    .rm-toast .toast-close:hover { opacity: 1; }

    /* ── Layout grid ── */
    .rm-grid {
        display: grid;
        grid-template-columns: 320px 1fr;
        gap: 1.5rem;
        align-items: start;
    }

    @media (max-width: 860px) {
        .rm-grid { grid-template-columns: 1fr; }
    }

    /* ── Form Card ── */
    .form-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 16px;
        overflow: hidden;
        animation: fadeUp 0.5s 0.1s ease both;
        position: sticky;
        top: 1.5rem;
    }

    .form-card-top {
        padding: 1.4rem 1.5rem;
        border-bottom: 1px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.75rem;
    }

    .form-card-top .fc-title {
        font-family: 'Syne', sans-serif;
        font-size: 0.95rem;
        font-weight: 700;
        color: var(--white);
    }

    .mode-badge {
        display: inline-block;
        padding: 0.2rem 0.65rem;
        border-radius: 20px;
        font-size: 0.68rem;
        font-weight: 600;
        letter-spacing: 0.08em;
        text-transform: uppercase;
    }

    .mode-badge.new {
        background: rgba(108,99,255,0.15);
        color: var(--accent2);
        border: 1px solid rgba(108,99,255,0.3);
    }

    .mode-badge.editing {
        background: var(--amber-dim);
        color: var(--amber);
        border: 1px solid rgba(251,191,36,0.3);
    }

    .form-card-body { padding: 1.5rem; }

    .field-label {
        display: block;
        font-size: 0.68rem;
        font-weight: 600;
        letter-spacing: 0.15em;
        text-transform: uppercase;
        color: var(--muted);
        margin-bottom: 0.55rem;
    }

    .field-label .req { color: var(--danger); margin-left: 2px; }

    .field-input {
        width: 100%;
        padding: 0.8rem 1rem;
        background: var(--surface2);
        border: 1.5px solid var(--border);
        border-radius: 8px;
        color: var(--text);
        font-family: 'Karla', sans-serif;
        font-size: 0.92rem;
        outline: none;
        transition: all 0.2s ease;
    }

    .field-input:focus {
        border-color: var(--accent);
        box-shadow: 0 0 0 3px rgba(108,99,255,0.12);
    }

    .field-input::placeholder { color: var(--muted); }
    .field-input.is-invalid { border-color: var(--danger); }

    .invalid-msg {
        margin-top: 0.4rem;
        font-size: 0.78rem;
        color: var(--danger);
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }

    .btn-save {
        width: 100%;
        padding: 0.85rem;
        background: var(--accent);
        color: var(--white);
        font-family: 'Karla', sans-serif;
        font-size: 0.88rem;
        font-weight: 600;
        letter-spacing: 0.05em;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.2s ease;
        box-shadow: 0 0 20px rgba(108,99,255,0.3);
        margin-top: 1.2rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .btn-save:hover {
        background: #7c74ff;
        box-shadow: 0 0 32px rgba(108,99,255,0.5);
        transform: translateY(-1px);
    }

    .btn-cancel {
        width: 100%;
        padding: 0.75rem;
        background: transparent;
        color: var(--muted);
        font-family: 'Karla', sans-serif;
        font-size: 0.85rem;
        font-weight: 500;
        border: 1px solid var(--border);
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.2s ease;
        margin-top: 0.6rem;
        text-align: center;
        text-decoration: none;
        display: block;
    }

    .btn-cancel:hover {
        border-color: var(--muted);
        color: var(--text);
    }

    /* ── Table Card ── */
    .table-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 16px;
        overflow: hidden;
        animation: fadeUp 0.5s 0.15s ease both;
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

    .toolbar-left {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .toolbar-title {
        font-family: 'Syne', sans-serif;
        font-size: 0.95rem;
        font-weight: 600;
        color: var(--text);
    }

    .role-count-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 24px; height: 24px;
        border-radius: 6px;
        background: rgba(108,99,255,0.15);
        color: var(--accent2);
        font-family: 'Syne', sans-serif;
        font-size: 0.72rem;
        font-weight: 700;
        border: 1px solid rgba(108,99,255,0.25);
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
        width: 160px;
    }

    .search-box input::placeholder { color: var(--muted); }

    /* ── Table ── */
    .rm-table {
        width: 100%;
        border-collapse: collapse;
    }

    .rm-table thead tr { background: var(--surface2); }

    .rm-table thead th {
        padding: 0.85rem 1.2rem;
        font-family: 'Syne', sans-serif;
        font-size: 0.68rem;
        font-weight: 600;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: var(--muted);
        border: none;
        border-bottom: 1px solid var(--border);
        white-space: nowrap;
    }

    .rm-table tbody tr {
        border-bottom: 1px solid var(--border);
        transition: background 0.15s ease;
    }

    .rm-table tbody tr:hover { background: rgba(108,99,255,0.04); }
    .rm-table tbody tr:last-child { border-bottom: none; }

    .rm-table tbody td {
        padding: 0.9rem 1.2rem;
        font-size: 0.88rem;
        color: var(--text);
        border: none;
        vertical-align: middle;
    }

    .idx-badge {
        display: inline-block;
        background: var(--surface2);
        border: 1px solid var(--border);
        color: var(--muted);
        font-family: 'Syne', sans-serif;
        font-size: 0.7rem;
        padding: 0.12rem 0.5rem;
        border-radius: 4px;
    }

    .role-name-cell {
        display: flex;
        align-items: center;
        gap: 0.65rem;
    }

    .role-icon {
        width: 32px; height: 32px;
        border-radius: 8px;
        background: linear-gradient(135deg, rgba(108,99,255,0.2), rgba(167,139,250,0.2));
        border: 1px solid rgba(108,99,255,0.2);
        display: flex; align-items: center; justify-content: center;
        font-size: 0.9rem;
        flex-shrink: 0;
    }

    .role-name-text {
        font-weight: 500;
        color: var(--white);
    }

    .date-text { font-size: 0.8rem; color: var(--muted); }

    .action-wrap { display: flex; align-items: center; gap: 0.5rem; }

    .btn-edit-r {
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

    .btn-edit-r:hover {
        background: rgba(108,99,255,0.25);
        color: var(--accent2);
        border-color: rgba(108,99,255,0.5);
    }

    .btn-del-r {
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

    .btn-del-r:hover {
        background: rgba(255,79,107,0.22);
        border-color: rgba(255,79,107,0.5);
    }

    .empty-state {
        text-align: center;
        padding: 3.5rem 2rem;
        color: var(--muted);
    }

    .empty-state .empty-icon { font-size: 2.5rem; margin-bottom: 0.75rem; opacity: 0.4; }
    .empty-state p { font-size: 0.88rem; }

    .table-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0.9rem 1.5rem;
        border-top: 1px solid var(--border);
    }

    .table-count { font-size: 0.78rem; color: var(--muted); }

    @media (max-width: 600px) {
        .rm-wrapper { padding: 1.5rem 1rem; }
        .rm-header-left h1 { font-size: 1.5rem; }
    }
</style>

<div class="rm-wrapper">
<div class="rm-inner">

    {{-- Header --}}
    <div class="rm-header">
        <div style="display:flex; align-items:center; gap: 1rem;">
            <div class="rm-header-icon">🛡️</div>
            <div class="rm-header-left">
                <p class="eyebrow">Admin Panel</p>
                <h1>Role Management</h1>
            </div>
        </div>
    </div>

    {{-- Toast --}}
    @if(session('success'))
    <div class="rm-toast" id="rm-toast">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
        {{ session('success') }}
        <button class="toast-close" onclick="document.getElementById('rm-toast').remove()">✕</button>
    </div>
    @endif

    {{-- Grid --}}
    <div class="rm-grid">

        {{-- ── Form Card ── --}}
        <div class="form-card">
            <div class="form-card-top">
                <span class="fc-title">{{ isset($editRole) ? 'Edit Role' : 'Add New Role' }}</span>
                <span class="mode-badge {{ isset($editRole) ? 'editing' : 'new' }}">
                    {{ isset($editRole) ? 'Editing' : 'New' }}
                </span>
            </div>
            <div class="form-card-body">
                <form method="POST" action="{{ isset($editRole) ? route('roles.update', $editRole->id) : route('roles.store') }}">
                    @csrf
                    @if(isset($editRole)) @method('PUT') @endif

                    <div>
                        <label class="field-label" for="roleName">
                            Role Name <span class="req">*</span>
                        </label>
                        <input
                            type="text"
                            id="roleName"
                            name="name"
                            class="field-input {{ $errors->has('name') ? 'is-invalid' : '' }}"
                            value="{{ isset($editRole) ? $editRole->name : old('name') }}"
                            placeholder="e.g. Admin, Editor..."
                            autocomplete="off"
                        >
                        @error('name')
                        <div class="invalid-msg">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn-save">
                        @if(isset($editRole))
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                            Update Role
                        @else
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                            Save Role
                        @endif
                    </button>

                    @if(isset($editRole))
                    <a href="{{ route('roles.index') }}" class="btn-cancel">Cancel</a>
                    @endif

                </form>
            </div>
        </div>

        {{-- ── Table Card ── --}}
        <div class="table-card">
            <div class="table-toolbar">
                <div class="toolbar-left">
                    <span class="toolbar-title">All Roles</span>
                    <span class="role-count-badge">{{ count($roles) }}</span>
                </div>
                <div class="search-box">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#6b6b8a" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                    <input type="text" id="roleSearch" placeholder="Search roles...">
                </div>
            </div>

            <div style="overflow-x: auto;">
                <table class="rm-table" id="rolesTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Role Name</th>
                            <th>Created</th>
                            <th style="text-align:right; padding-right:1.5rem;">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="rolesBody">
                        @forelse($roles as $key => $role)
                        <tr>
                            <td><span class="idx-badge">{{ $key + 1 }}</span></td>
                            <td>
                                <div class="role-name-cell">
                                    <div class="role-icon">🛡️</div>
                                    <span class="role-name-text role-name">{{ $role->name }}</span>
                                </div>
                            </td>
                            <td><span class="date-text">{{ $role->created_at->format('d M Y') }}</span></td>
                            <td style="text-align:right;">
                                <div class="action-wrap" style="justify-content:flex-end;">
                                    <a href="{{ route('roles.edit', $role->id) }}" class="btn-edit-r">
                                        <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                        Edit
                                    </a>
                                    <form action="{{ route('roles.destroy', $role->id) }}" method="POST" style="margin:0" class="del-form">
                                        @csrf @method('DELETE')
                                        <button type="button" class="btn-del-r" onclick="openDeleteModal(this, '{{ $role->name }}')">
                                            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M9 6V4h6v2"/></svg>
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4">
                                <div class="empty-state">
                                    <div class="empty-icon">🛡️</div>
                                    <p>No roles found. Add your first role.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="table-footer">
                <span class="table-count" id="roleCount">{{ count($roles) }} role{{ count($roles) !== 1 ? 's' : '' }} total</span>
            </div>
        </div>

    </div>
</div>
</div>

{{-- Delete Modal --}}
<div id="deleteModal" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.65); backdrop-filter:blur(4px); z-index:9999; align-items:center; justify-content:center;">
    <div style="background:#1a1a2a; border:1px solid #252538; border-radius:16px; padding:2rem; max-width:380px; width:90%; text-align:center; animation: fadeDown 0.25s ease;">
        <div style="width:52px;height:52px;background:rgba(255,79,107,0.12);border-radius:12px;margin:0 auto 1.2rem;display:flex;align-items:center;justify-content:center;">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#ff4f6b" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M9 6V4h6v2"/></svg>
        </div>
        <h3 style="font-family:'Syne',sans-serif;font-size:1.1rem;color:#fff;margin-bottom:0.5rem;">Delete Role?</h3>
        <p style="font-size:0.82rem;color:#6b6b8a;margin-bottom:0.4rem;">You are about to delete:</p>
        <p id="deleteRoleName" style="font-family:'Syne',sans-serif;font-size:0.95rem;color:#a78bfa;font-weight:600;margin-bottom:1.4rem;"></p>
        <p style="font-size:0.82rem;color:#6b6b8a;margin-bottom:1.5rem;">This action cannot be undone.</p>
        <div style="display:flex;gap:0.75rem;justify-content:center;">
            <button onclick="closeDeleteModal()" style="padding:0.6rem 1.4rem;background:transparent;border:1px solid #252538;color:#6b6b8a;border-radius:8px;font-family:'Karla',sans-serif;font-size:0.85rem;cursor:pointer;">Cancel</button>
            <button id="confirmDeleteBtn" style="padding:0.6rem 1.4rem;background:#ff4f6b;border:none;color:#fff;border-radius:8px;font-family:'Karla',sans-serif;font-size:0.85rem;cursor:pointer;font-weight:500;">Yes, Delete</button>
        </div>
    </div>
</div>


<script>
    // Auto dismiss toast
    const toast = document.getElementById('rm-toast');
    if (toast) setTimeout(() => toast.remove(), 3500);

    // Delete modal
    let pendingForm = null;

    function openDeleteModal(btn, roleName) {
        pendingForm = btn.closest('form');
        document.getElementById('deleteRoleName').textContent = roleName;
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
    document.getElementById('roleSearch').addEventListener('input', function () {
        const q = this.value.toLowerCase();
        const rows = document.querySelectorAll('#rolesBody tr');
        let visible = 0;
        rows.forEach(row => {
            const name = row.querySelector('.role-name');
            if (!name) return;
            const match = name.textContent.toLowerCase().includes(q);
            row.style.display = match ? '' : 'none';
            if (match) visible++;
        });
        document.getElementById('roleCount').textContent =
            `${visible} role${visible !== 1 ? 's' : ''} ${q ? 'found' : 'total'}`;
    });
</script>

@endsection