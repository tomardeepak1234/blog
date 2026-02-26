@extends('admin.admin_meta')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=Karla:wght@300;400;500;600&display=swap');

    :root {
        --bg:       #0d0d14;
        --surface:  #13131f;
        --surface2: #1a1a2a;
        --border:   #252538;
        --accent:   #6c63ff;
        --accent2:  #a78bfa;
        --danger:   #ff4f6b;
        --success:  #34d399;
        --amber:    #fbbf24;
        --text:     #e8e8f0;
        --muted:    #6b6b8a;
        --white:    #ffffff;
    }

    * { box-sizing: border-box; margin: 0; padding: 0; }

    /* ── Wrapper ── */
    .post-wrapper {
        min-height: 100vh;
        background: var(--bg);
        font-family: 'Karla', sans-serif;
        color: var(--text);
        padding: 2.5rem 1.5rem;
        position: relative;
        left:4%;
    }

    .post-wrapper::before {
        content: '';
        position: fixed;
        top: -15%; right: 5%;
        width: 600px; height: 600px;
        background: radial-gradient(circle, rgba(108,99,255,0.07) 0%, transparent 65%);
        pointer-events: none; z-index: 0;
    }

    .post-wrapper::after {
        content: '';
        position: fixed;
        bottom: -10%; left: -5%;
        width: 400px; height: 400px;
        background: radial-gradient(circle, rgba(167,139,250,0.04) 0%, transparent 65%);
        pointer-events: none; z-index: 0;
    }

    /* ── Animations ── */
    @keyframes slideUp {
        from { opacity:0; transform:translateY(28px); }
        to   { opacity:1; transform:translateY(0); }
    }
    @keyframes fadeIn {
        from { opacity:0; transform:translateY(10px); }
        to   { opacity:1; transform:translateY(0); }
    }

    /* ── Page header ── */
    .page-topbar {
        max-width: 780px;
        margin: 0 auto 1.5rem;
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 0.75rem;
        animation: slideUp 0.5s ease forwards;
        position: relative; z-index: 1;
    }

    .page-topbar .eyebrow {
        font-size: 0.68rem;
        font-weight: 500;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        color: var(--accent2);
        margin-bottom: 0.35rem;
    }

    .page-topbar h1 {
        font-family: 'Syne', sans-serif;
        font-size: 1.9rem;
        font-weight: 800;
        color: var(--white);
        line-height: 1;
    }

    .btn-back-top {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.55rem 1.1rem;
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 8px;
        color: var(--muted);
        font-family: 'Karla', sans-serif;
        font-size: 0.82rem;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.2s;
    }
    .btn-back-top:hover {
        border-color: var(--muted);
        color: var(--text);
    }

    /* ── Main Card ── */
    .post-card {
        max-width: 780px;
        margin: 0 auto;
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 18px;
        overflow: hidden;
        animation: slideUp 0.55s 0.05s cubic-bezier(0.16, 1, 0.3, 1) both;
        position: relative; z-index: 1;
    }

    /* ── Card Header ── */
    .post-card-header {
        background: var(--surface2);
        border-bottom: 1px solid var(--border);
        padding: 2rem 2.5rem;
        position: relative;
        overflow: hidden;
    }

    .post-card-header::before {
        content: '✍️';
        position: absolute;
        right: 2rem;
        top: 50%;
        transform: translateY(-50%);
        font-size: 4.5rem;
        opacity: 0.06;
        pointer-events: none;
    }

    /* Accent top stripe */
    .post-card-header::after {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 3px;
        background: linear-gradient(90deg, var(--accent), var(--accent2));
        border-radius: 18px 18px 0 0;
    }

    .header-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.25rem 0.75rem;
        background: rgba(108,99,255,0.12);
        border: 1px solid rgba(108,99,255,0.25);
        border-radius: 20px;
        font-size: 0.65rem;
        font-weight: 600;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: var(--accent2);
        margin-bottom: 0.75rem;
    }

    .header-badge::before {
        content: '';
        width: 5px; height: 5px;
        border-radius: 50%;
        background: var(--accent2);
        box-shadow: 0 0 5px var(--accent2);
    }

    .post-card-header h2 {
        font-family: 'Syne', sans-serif;
        font-size: 1.6rem;
        font-weight: 800;
        color: var(--white);
        line-height: 1.1;
        margin: 0;
    }

    .post-card-header p {
        font-size: 0.82rem;
        color: var(--muted);
        margin-top: 0.4rem;
    }

    /* ── Card Body ── */
    .post-card-body {
        padding: 2rem 2.5rem;
    }

    /* Section divider */
    .section-divider {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 1.8rem;
    }

    .section-divider span {
        font-size: 0.65rem;
        letter-spacing: 0.18em;
        text-transform: uppercase;
        color: var(--muted);
        font-weight: 600;
        white-space: nowrap;
    }

    .section-divider::before,
    .section-divider::after {
        content: '';
        flex: 1;
        height: 1px;
        background: var(--border);
    }

    /* ── Field Groups ── */
    .field-group {
        margin-bottom: 1.6rem;
        opacity: 0;
        animation: fadeIn 0.5s ease forwards;
    }

    .field-group:nth-child(1) { animation-delay: 0.12s; }
    .field-group:nth-child(2) { animation-delay: 0.20s; }
    .field-group:nth-child(3) { animation-delay: 0.28s; }

    .field-label {
        display: flex;
        align-items: center;
        gap: 0.4rem;
        font-size: 0.68rem;
        font-weight: 600;
        letter-spacing: 0.14em;
        text-transform: uppercase;
        color: var(--muted);
        margin-bottom: 0.55rem;
    }

    .field-label .req { color: var(--danger); }

    /* Input */
    .field-input {
        width: 100%;
        padding: 0.82rem 1rem;
        background: var(--surface2);
        border: 1.5px solid var(--border);
        border-radius: 10px;
        color: var(--text);
        font-family: 'Karla', sans-serif;
        font-size: 0.93rem;
        outline: none;
        transition: all 0.2s ease;
    }

    .field-input:focus {
        border-color: var(--accent);
        box-shadow: 0 0 0 3px rgba(108,99,255,0.12);
        background: #1c1c2e;
    }

    .field-input::placeholder { color: var(--muted); }

    textarea.field-input {
        resize: vertical;
        min-height: 150px;
        line-height: 1.65;
    }

    /* char count */
    .field-footer {
        display: flex;
        justify-content: flex-end;
        margin-top: 0.35rem;
    }

    .char-count {
        font-size: 0.7rem;
        color: var(--muted);
        font-variant-numeric: tabular-nums;
    }

    .char-count.warn { color: var(--amber); }
    .char-count.over { color: var(--danger); }

    /* ── File Upload ── */
    .file-upload-zone {
        border: 2px dashed var(--border);
        border-radius: 10px;
        padding: 2rem 1.5rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.25s ease;
        background: var(--surface2);
        position: relative;
        overflow: hidden;
    }

    .file-upload-zone:hover,
    .file-upload-zone.dragover {
        border-color: var(--accent);
        background: rgba(108,99,255,0.05);
        box-shadow: 0 0 0 3px rgba(108,99,255,0.08);
    }

    .file-upload-zone input[type="file"] {
        position: absolute;
        inset: 0;
        opacity: 0;
        cursor: pointer;
        width: 100%;
        height: 100%;
    }

    .upload-icon-wrap {
        width: 52px; height: 52px;
        border-radius: 12px;
        background: rgba(108,99,255,0.12);
        border: 1px solid rgba(108,99,255,0.2);
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 0.9rem;
        font-size: 1.4rem;
        transition: transform 0.2s;
    }

    .file-upload-zone:hover .upload-icon-wrap {
        transform: scale(1.08);
    }

    .upload-main-text {
        font-size: 0.88rem;
        color: var(--text);
        font-weight: 500;
        margin-bottom: 0.3rem;
    }

    .upload-main-text strong { color: var(--accent2); }

    .upload-sub-text {
        font-size: 0.73rem;
        color: var(--muted);
    }

    /* Preview */
    .file-preview {
        display: none;
        align-items: center;
        gap: 0.75rem;
        margin-top: 0.9rem;
        padding: 0.65rem 0.9rem;
        background: rgba(52,211,153,0.07);
        border: 1px solid rgba(52,211,153,0.2);
        border-radius: 8px;
        text-align: left;
    }

    .file-preview.show { display: flex; }

    .preview-img {
        width: 42px; height: 42px;
        border-radius: 6px;
        object-fit: cover;
        border: 1px solid var(--border);
        display: none;
    }

    .preview-img.show { display: block; }

    .preview-check {
        width: 18px; height: 18px;
        border-radius: 50%;
        background: var(--success);
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }

    .file-preview-name {
        font-size: 0.8rem;
        color: var(--success);
        font-weight: 500;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .file-preview-size {
        font-size: 0.7rem;
        color: var(--muted);
        margin-left: auto;
        flex-shrink: 0;
    }

    /* ── Form Actions ── */
    .form-actions {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding-top: 1.5rem;
        border-top: 1px solid var(--border);
        margin-top: 0.5rem;
        flex-wrap: wrap;
    }

    .btn-publish {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.82rem 2rem;
        background: var(--accent);
        color: var(--white);
        font-family: 'Karla', sans-serif;
        font-size: 0.86rem;
        font-weight: 600;
        letter-spacing: 0.04em;
        border: none;
        border-radius: 9px;
        cursor: pointer;
        transition: all 0.2s ease;
        box-shadow: 0 0 22px rgba(108,99,255,0.35);
    }

    .btn-publish:hover {
        background: #7c74ff;
        box-shadow: 0 0 32px rgba(108,99,255,0.55);
        transform: translateY(-1px);
    }

    .btn-publish:active {
        transform: translateY(0);
        box-shadow: 0 0 12px rgba(108,99,255,0.3);
    }

    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.82rem 1.5rem;
        background: transparent;
        color: var(--muted);
        font-family: 'Karla', sans-serif;
        font-size: 0.86rem;
        font-weight: 500;
        border: 1px solid var(--border);
        border-radius: 9px;
        cursor: pointer;
        transition: all 0.2s ease;
        text-decoration: none;
    }

    .btn-back:hover {
        border-color: var(--muted);
        color: var(--text);
    }

    .save-hint {
        margin-left: auto;
        font-size: 0.72rem;
        color: var(--muted);
        display: flex;
        align-items: center;
        gap: 0.35rem;
    }

    /* ── Error state ── */
    .field-input.is-invalid {
        border-color: var(--danger);
        box-shadow: 0 0 0 3px rgba(255,79,107,0.1);
    }

    .field-error {
        margin-top: 0.4rem;
        font-size: 0.76rem;
        color: var(--danger);
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }

    @media (max-width: 600px) {
        .post-card-header, .post-card-body { padding: 1.5rem 1.2rem; }
        .page-topbar h1 { font-size: 1.5rem; }
        .form-actions { gap: 0.6rem; }
        .btn-publish, .btn-back { padding: 0.75rem 1.2rem; }
        .save-hint { display: none; }
    }
</style>

<div class="post-wrapper">

    {{-- Page topbar --}}
    <div class="page-topbar">
        <div>
            <p class="eyebrow">Admin Panel</p>
            <h1>Create Post</h1>
        </div>
        <a href="{{ route('posts.index') }}" class="btn-back-top">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg>
            Back to Posts
        </a>
    </div>

    {{-- Main card --}}
    <div class="post-card">

        {{-- Header --}}
        <div class="post-card-header">
            <div class="header-badge">New Post</div>
            <h2>Add New Post</h2>
            <p>Fill in the details below to publish a new post</p>
        </div>

        {{-- Body --}}
        <div class="post-card-body">

            <div class="section-divider"><span>Post Details</span></div>

            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" id="postForm">
                @csrf
                <input type="hidden" value="{{ $user->id }}" name="user_id">

                {{-- Title --}}
                <div class="field-group">
                    <label class="field-label" for="title">
                        Post Title <span class="req">*</span>
                    </label>
                    <input
                        type="text"
                        id="title"
                        name="title"
                        class="field-input {{ $errors->has('title') ? 'is-invalid' : '' }}"
                        value="{{ old('title') }}"
                        placeholder="Enter a compelling title..."
                        required
                        maxlength="120"
                        oninput="titleCount(this)"
                    >
                    @error('title')
                    <div class="field-error">
                        <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                        {{ $message }}
                    </div>
                    @enderror
                    <div class="field-footer">
                        <span class="char-count" id="title-count">0 / 120</span>
                    </div>
                </div>

                {{-- Description --}}
                <div class="field-group">
                    <label class="field-label" for="description">
                        Description <span class="req">*</span>
                    </label>
                    <textarea
                        id="description"
                        name="description"
                        class="field-input {{ $errors->has('description') ? 'is-invalid' : '' }}"
                        placeholder="Write your post content here..."
                        rows="6"
                        required
                        maxlength="2000"
                        oninput="descCount(this)"
                    >{{ old('description') }}</textarea>
                    @error('description')
                    <div class="field-error">
                        <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                        {{ $message }}
                    </div>
                    @enderror
                    <div class="field-footer">
                        <span class="char-count" id="desc-count">0 / 2000</span>
                    </div>
                </div>

                {{-- Image Upload --}}
                <div class="field-group">
                    <label class="field-label">Featured Image</label>

                    <div class="file-upload-zone" id="uploadZone">
                        <input
                            type="file"
                            id="image-input"
                            name="image"
                            accept="image/*"
                            onchange="handleFileSelect(this)"
                        >
                        <div class="upload-icon-wrap">🖼️</div>
                        <p class="upload-main-text">
                            <strong>Click to upload</strong> or drag & drop
                        </p>
                        <p class="upload-sub-text">PNG, JPG, WEBP — Max 10MB</p>

                        <div class="file-preview" id="filePreview">
                            <img src="" alt="" class="preview-img" id="previewImg">
                            <div class="preview-check">
                                <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                            </div>
                            <span class="file-preview-name" id="previewName">—</span>
                            <span class="file-preview-size" id="previewSize">—</span>
                        </div>
                    </div>
                </div>

                {{-- Actions --}}
                <div class="form-actions">
                    <button type="submit" class="btn-publish">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 2L11 13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                        Publish Post
                    </button>
                    <a href="{{ route('posts.index') }}" class="btn-back">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg>
                        Cancel
                    </a>
                    <span class="save-hint">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/></svg>
                        Your post will be published immediately
                    </span>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
    // Title char count
    function titleCount(input) {
        const el = document.getElementById('title-count');
        const len = input.value.length;
        el.textContent = `${len} / 120`;
        el.className = 'char-count' + (len > 100 ? ' warn' : '') + (len >= 120 ? ' over' : '');
    }

    // Desc char count
    function descCount(input) {
        const el = document.getElementById('desc-count');
        const len = input.value.length;
        el.textContent = `${len} / 2000`;
        el.className = 'char-count' + (len > 1800 ? ' warn' : '') + (len >= 2000 ? ' over' : '');
    }

    // File select handler
    function handleFileSelect(input) {
        const preview = document.getElementById('filePreview');
        const previewImg = document.getElementById('previewImg');
        const previewName = document.getElementById('previewName');
        const previewSize = document.getElementById('previewSize');

        if (input.files && input.files[0]) {
            const file = input.files[0];
            const sizeMB = (file.size / 1024 / 1024).toFixed(2);

            previewName.textContent = file.name;
            previewSize.textContent = `${sizeMB} MB`;
            preview.classList.add('show');

            // Show image preview
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = e => {
                    previewImg.src = e.target.result;
                    previewImg.classList.add('show');
                };
                reader.readAsDataURL(file);
            }
        } else {
            preview.classList.remove('show');
            previewImg.classList.remove('show');
        }
    }

    // Drag and drop
    const zone = document.getElementById('uploadZone');

    zone.addEventListener('dragover', e => {
        e.preventDefault();
        zone.classList.add('dragover');
    });

    zone.addEventListener('dragleave', () => zone.classList.remove('dragover'));

    zone.addEventListener('drop', e => {
        e.preventDefault();
        zone.classList.remove('dragover');
        const input = document.getElementById('image-input');
        input.files = e.dataTransfer.files;
        handleFileSelect(input);
    });
</script>

@endsection