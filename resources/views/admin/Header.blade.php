<head>
  <meta charset="UTF-8">
  <title>Simple Admin Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS --> 
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    
<style>
    body {
      min-height: 100vh;
      display: flex;
    }
    .sidebar {
      width: 250px;
      background-color: #343a40;
    }
    .sidebar .nav-link {
      color: #fff;
    }
    .sidebar .nav-link.active {
      b
    }
    .content {
      padding: 20px;
      background-color: #f8f9fa;
    } 
  </style>

  <style>

  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

  :root {
    --bg: #0d0f14;
    --surface: #13151c;
    --card: #191c26;
    --border: #252836;
    --accent: #6c63ff;
    --accent2: #ff6584;
    --accent3: #43e97b;
    --text: #e8eaf0;
    --muted: #6b7089;
    --danger: #ff4d6d;
    --warning: #ffd166;
  }

  body {
    font-family: 'DM Sans', sans-serif;
    background: var(--bg);
    color: var(--text);
    min-height: 100vh;
    padding: 40px 20px;
    background-image:
      radial-gradient(ellipse at 20% 10%, rgba(108,99,255,0.12) 0%, transparent 50%),
      radial-gradient(ellipse at 80% 80%, rgba(255,101,132,0.08) 0%, transparent 50%);
  }

  .container {
    max-width: 900px;
    margin: 0 auto;
  }

  /* ---- PAGE HEADER ---- */
  .page-header {
    display: flex;
    align-items: center;
    gap: 16px;
    margin-bottom: 40px;
    animation: slideDown 0.5s ease forwards;
  }
  .page-header .icon-wrap {
    width: 48px; height: 48px;
    background: linear-gradient(135deg, var(--accent), var(--accent2));
    border-radius: 14px;
    display: grid; place-items: center;
    font-size: 22px;
    box-shadow: 0 8px 24px rgba(108,99,255,0.35);
  }
  .page-header h1 {
    font-family: 'Syne', sans-serif;
    font-size: 28px;
    font-weight: 800;
    letter-spacing: -0.5px;
  }
  .page-header h1 span { color: var(--accent); }

  /* ---- ALERT ---- */
  .alert {
    background: linear-gradient(135deg, rgba(67,233,123,0.12), rgba(67,233,123,0.05));
    border: 1px solid rgba(67,233,123,0.3);
    border-left: 3px solid var(--accent3);
    padding: 14px 18px;
    border-radius: 10px;
    margin-bottom: 24px;
    color: var(--accent3);
    font-size: 14px;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 10px;
    animation: fadeIn 0.4s ease;
  }

  /* ---- FORM CARD ---- */
  .form-card {
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: 20px;
    padding: 32px;
    margin-bottom: 36px;
    position: relative;
    overflow: hidden;
    animation: slideUp 0.5s ease forwards;
  }
  .form-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 3px;
    background: linear-gradient(90deg, var(--accent), var(--accent2));
  }

  .form-card-title {
    font-family: 'Syne', sans-serif;
    font-size: 18px;
    font-weight: 700;
    margin-bottom: 24px;
    display: flex;
    align-items: center;
    gap: 10px;
    color: var(--text);
  }
  .form-card-title .badge {
    background: rgba(108,99,255,0.15);
    color: var(--accent);
    font-size: 11px;
    font-weight: 600;
    padding: 3px 10px;
    border-radius: 20px;
    border: 1px solid rgba(108,99,255,0.25);
    letter-spacing: 0.5px;
    text-transform: uppercase;
  }

  .form-group { margin-bottom: 20px; }
  .form-group label {
    display: block;
    font-size: 13px;
    font-weight: 500;
    color: var(--muted);
    margin-bottom: 8px;
    letter-spacing: 0.3px;
  }
  .form-group label span { color: var(--accent2); margin-left: 2px; }

  .form-control {
    width: 100%;
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 12px;
    padding: 13px 16px;
    color: var(--text);
    font-family: 'DM Sans', sans-serif;
    font-size: 15px;
    outline: none;
    transition: border-color 0.2s, box-shadow 0.2s;
  }
  .form-control:focus {
    border-color: var(--accent);
    box-shadow: 0 0 0 3px rgba(108,99,255,0.15);
  }
  .form-control::placeholder { color: #3a3d54; }

  .error-msg {
    color: var(--danger);
    font-size: 12px;
    margin-top: 6px;
    display: flex;
    align-items: center;
    gap: 5px;
  }

  .form-actions { display: flex; gap: 12px; margin-top: 8px; }

  .btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 12px 24px;
    border-radius: 12px;
    border: none;
    cursor: pointer;
    font-family: 'DM Sans', sans-serif;
    font-size: 14px;
    font-weight: 600;
    transition: all 0.2s;
    letter-spacing: 0.2px;
  }
  .btn-primary {
    background: linear-gradient(135deg, var(--accent), #8b5cf6);
    color: #fff;
    box-shadow: 0 4px 16px rgba(108,99,255,0.35);
  }
  .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(108,99,255,0.45); }
  .btn-ghost {
    background: transparent;
    border: 1px solid var(--border);
    color: var(--muted);
  }
  .btn-ghost:hover { border-color: var(--muted); color: var(--text); background: rgba(255,255,255,0.03); }

  /* ---- TABLE CARD ---- */
  .table-card {
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: 20px;
    overflow: hidden;
    animation: slideUp 0.6s ease 0.1s both;
  }

  .table-header {
    padding: 24px 28px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-bottom: 1px solid var(--border);
  }
  .table-header h2 {
    font-family: 'Syne', sans-serif;
    font-size: 17px;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 10px;
  }
  .count-pill {
    background: rgba(108,99,255,0.15);
    color: var(--accent);
    font-size: 12px;
    font-weight: 700;
    padding: 2px 10px;
    border-radius: 20px;
  }
  .search-box {
    position: relative;
  }
  .search-box input {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 10px;
    padding: 9px 14px 9px 36px;
    color: var(--text);
    font-size: 13px;
    font-family: 'DM Sans', sans-serif;
    outline: none;
    width: 200px;
    transition: border-color 0.2s;
  }
  .search-box input:focus { border-color: var(--accent); }
  .search-box::before {
    content: '⌕';
    position: absolute;
    left: 11px; top: 50%;
    transform: translateY(-50%);
    color: var(--muted);
    font-size: 16px;
    pointer-events: none;
  }

  table {
    width: 100%;
    border-collapse: collapse;
  }
  thead th {
    padding: 14px 20px;
    text-align: left;
    font-size: 11px;
    font-weight: 700;
    color: var(--muted);
    text-transform: uppercase;
    letter-spacing: 1px;
    background: rgba(255,255,255,0.015);
    border-bottom: 1px solid var(--border);
  }
  thead th:first-child { padding-left: 28px; }
  thead th:last-child { text-align: right; padding-right: 28px; }

  tbody tr {
    border-bottom: 1px solid rgba(255,255,255,0.04);
    transition: background 0.15s;
  }
  tbody tr:last-child { border-bottom: none; }
  tbody tr:hover { background: rgba(108,99,255,0.04); }

  td {
    padding: 16px 20px;
    font-size: 14px;
    vertical-align: middle;
  }
  td:first-child { padding-left: 28px; }
  td:last-child { padding-right: 28px; }

  .row-num {
    width: 32px; height: 32px;
    background: rgba(255,255,255,0.05);
    border-radius: 8px;
    display: inline-grid;
    place-items: center;
    font-size: 12px;
    font-weight: 600;
    color: var(--muted);
  }

  .state-name {
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 10px;
  }
  .state-dot {
    width: 8px; height: 8px;
    background: linear-gradient(135deg, var(--accent), var(--accent2));
    border-radius: 50%;
  }

  .date-chip {
    background: rgba(255,255,255,0.05);
    border-radius: 8px;
    padding: 4px 10px;
    font-size: 12px;
    color: var(--muted);
    display: inline-block;
  }

  .action-group {
    display: flex;
    gap: 8px;
    justify-content: flex-end;
  }

  .btn-icon {
    width: 34px; height: 34px;
    border-radius: 9px;
    border: none;
    cursor: pointer;
    display: grid;
    place-items: center;
    font-size: 15px;
    transition: all 0.2s;
    text-decoration: none;
  }
  .btn-edit {
    background: rgba(108,99,255,0.12);
    color: var(--accent);
    border: 1px solid rgba(108,99,255,0.2);
  }
  .btn-edit:hover { background: rgba(108,99,255,0.25); transform: scale(1.08); }
  .btn-delete {
    background: rgba(255,77,109,0.1);
    color: var(--danger);
    border: 1px solid rgba(255,77,109,0.2);
  }
  .btn-delete:hover { background: rgba(255,77,109,0.22); transform: scale(1.08); }

  /* ---- EMPTY STATE ---- */
  .empty-state {
    padding: 60px 20px;
    text-align: center;
    color: var(--muted);
  }
  .empty-state .empty-icon { font-size: 40px; margin-bottom: 12px; opacity: 0.4; }
  .empty-state p { font-size: 14px; }

  /* ---- PAGINATION ---- */
  .table-footer {
    padding: 16px 28px;
    border-top: 1px solid var(--border);
    display: flex;
    align-items: center;
    justify-content: space-between;
    font-size: 13px;
    color: var(--muted);
  }
  .pagination { display: flex; gap: 6px; }
  .page-btn {
    width: 32px; height: 32px;
    border-radius: 8px;
    border: 1px solid var(--border);
    background: transparent;
    color: var(--muted);
    cursor: pointer;
    font-size: 13px;
    transition: all 0.2s;
    display: grid;
    place-items: center;
  }
  .page-btn.active { background: var(--accent); color: #fff; border-color: var(--accent); }
  .page-btn:hover:not(.active) { border-color: var(--accent); color: var(--accent); }

  /* ---- ANIMATIONS ---- */
  @keyframes slideDown { from { opacity: 0; transform: translateY(-16px); } to { opacity: 1; transform: translateY(0); } }
  @keyframes slideUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
  @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }

  tbody tr { animation: fadeIn 0.3s ease both; }
  tbody tr:nth-child(1) { animation-delay: 0.05s; }
  tbody tr:nth-child(2) { animation-delay: 0.1s; }
  tbody tr:nth-child(3) { animation-delay: 0.15s; }
  tbody tr:nth-child(4) { animation-delay: 0.2s; }
  tbody tr:nth-child(5) { animation-delay: 0.25s; }
  
</style>
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
      grid-template-columns: 1fr ;
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
  




body{
  background: #000;
  grid-template-columns: 220px 1fr
}


/* Header Section */
.page-header{
    background: #000;
    padding: 15px 20px;
    border-radius: 8px;
    margin-bottom: 20px;
}

.page-header h3{
    color: #fff;
    margin: 0;
}

/* Add Button */
.btn-primary{
    padding: 6px 15px;
    font-weight: 500;
}

/* Action Buttons */
.btn-edit{
    background-color: #0d6efd;
    color: #fff;
    padding: 4px 10px;
    font-size: 13px;
}

.btn-delete{
    background-color: #dc3545;
    color: #fff;
    padding: 4px 10px;
    font-size: 13px;
}


<style>

body{
    background: #131212;
    grid-template-columns: 320px 1fr;
}
.edit-header{
    background:#000;
    padding:15px 20px;
    border-radius:8px;
    margin-bottom:20px;
}

.edit-header h3{
    color:#fff;
    margin:0;
}

/* Card Styling */
.card{
    border-radius:10px;
}

.form-label{
    font-weight:500;
}
</style>
  </style>
</head>