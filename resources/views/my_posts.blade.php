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
        --success:  #34d399;
        --amber:    #fbbf24;
        --sky:      #38bdf8;
        --text:     #e8e8f0;
        --muted:    #6b6b8a;
        --white:    #ffffff;
    }

    * { box-sizing: border-box; margin: 0; padding: 0; }

    /* ── Wrapper ── */
    .plc-page {
        min-height: 100vh;
        background: var(--bg);
        font-family: 'Karla', sans-serif;
        color: var(--text);
        padding: 2.5rem 2rem;
        position: relative;
        left :4%;
    }

    .plc-page::before {
        content: '';
        position: fixed;
        top: -10%; right: 10%;
        width: 560px; height: 560px;
        background: radial-gradient(circle, rgba(108,99,255,0.07) 0%, transparent 65%);
        pointer-events: none; z-index: 0;
    }

    .plc-inner {
        max-width: 860px;
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

    /* ── Page Header ── */
    .plc-page-header {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        margin-bottom: 2rem;
        flex-wrap: wrap;
        gap: 1rem;
        animation: fadeDown 0.5s ease forwards;
    }

    .plc-page-header .eyebrow {
        font-size: 0.68rem;
        font-weight: 500;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        color: var(--accent2);
        margin-bottom: 0.35rem;
    }

    .plc-page-header h1 {
        font-family: 'Syne', sans-serif;
        font-size: 1.9rem;
        font-weight: 800;
        color: var(--white);
        line-height: 1;
    }

    .btn-view-all {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.65rem 1.4rem;
        background: rgba(108,99,255,0.12);
        color: var(--accent2);
        border: 1px solid rgba(108,99,255,0.3);
        border-radius: 8px;
        font-family: 'Karla', sans-serif;
        font-size: 0.82rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s;
    }
    .btn-view-all:hover {
        background: rgba(108,99,255,0.22);
        border-color: rgba(108,99,255,0.5);
        color: var(--accent2);
        transform: translateY(-1px);
    }

    /* ── Main Card ── */
    .post-listing-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 16px;
        overflow: hidden;
        animation: fadeUp 0.5s 0.1s ease both;
    }

    /* ── Card Header ── */
    .plc-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 1.2rem 1.5rem;
        border-bottom: 1px solid var(--border);
        background: var(--surface2);
        flex-wrap: wrap;
        gap: 0.75rem;
    }

    .plc-title {
        font-family: 'Syne', sans-serif;
        font-size: 0.9rem;
        font-weight: 700;
        color: var(--white);
        display: flex;
        align-items: center;
        gap: 0.6rem;
    }

    .plc-title .ct-icon {
        width: 30px; height: 30px;
        border-radius: 8px;
        display: flex; align-items: center; justify-content: center;
        font-size: 0.9rem;
        background: rgba(108,99,255,0.15);
        border: 1px solid rgba(108,99,255,0.2);
    }

    .plc-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 22px;
        height: 22px;
        padding: 0 6px;
        border-radius: 6px;
        background: rgba(108,99,255,0.15);
        color: var(--accent2);
        font-family: 'Syne', sans-serif;
        font-size: 0.7rem;
        font-weight: 700;
        border: 1px solid rgba(108,99,255,0.25);
    }

    .plc-header-right {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    /* Search inside header */
    .plc-search {
        display: flex;
        align-items: center;
        gap: 0.4rem;
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 8px;
        padding: 0.38rem 0.75rem;
        transition: border-color 0.2s;
    }
    .plc-search:focus-within { border-color: var(--accent); }
    .plc-search input {
        background: none; border: none; outline: none;
        color: var(--text);
        font-family: 'Karla', sans-serif;
        font-size: 0.8rem;
        width: 130px;
    }
    .plc-search input::placeholder { color: var(--muted); }

    /* ── Scrollable Container ── */
    .posts-scroll-container {
        max-height: 600px;
        overflow-y: auto;
        overflow-x: hidden;
    }

    .posts-scroll-container::-webkit-scrollbar { width: 4px; }
    .posts-scroll-container::-webkit-scrollbar-track { background: var(--surface); }
    .posts-scroll-container::-webkit-scrollbar-thumb {
        background: var(--border);
        border-radius: 4px;
    }
    .posts-scroll-container::-webkit-scrollbar-thumb:hover { background: var(--accent); }

    /* ── Post Item ── */
    .post-item {
        border-bottom: 1px solid var(--border);
        transition: background 0.15s ease;
        animation: fadeUp 0.4s ease both;
    }

    .post-item:nth-child(1)  { animation-delay: 0.05s; }
    .post-item:nth-child(2)  { animation-delay: 0.10s; }
    .post-item:nth-child(3)  { animation-delay: 0.15s; }
    .post-item:nth-child(4)  { animation-delay: 0.20s; }
    .post-item:nth-child(5)  { animation-delay: 0.25s; }

    .post-item:last-child { border-bottom: none; }
    .post-item:hover { background: rgba(108,99,255,0.03); }

    /* ── Post Item Main Row ── */
    .post-item-main {
        display: flex;
        gap: 1rem;
        padding: 1.1rem 1.5rem;
        align-items: flex-start;
    }

    /* Thumbnail */
    .post-thumb-wrap {
        flex-shrink: 0;
        width: 76px;
        height: 62px;
        border-radius: 10px;
        overflow: hidden;
        background: var(--surface2);
        border: 1px solid var(--border);
        position: relative;
    }

    .post-thumb-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform 0.35s ease;
    }

    .post-item:hover .post-thumb-wrap img { transform: scale(1.07); }

    .post-no-thumb {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: var(--muted);
        background: linear-gradient(135deg, var(--surface2), #1f1a35);
        opacity: 0.6;
    }

    /* Content */
    .post-item-content {
        flex: 1;
        min-width: 0;
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    /* Top row: title + date */
    .pic-top {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 0.5rem;
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
        flex: 1;
    }

    .post-item-date {
        font-size: 0.7rem;
        color: var(--muted);
        white-space: nowrap;
        flex-shrink: 0;
        padding: 0.15rem 0.5rem;
        background: var(--surface2);
        border: 1px solid var(--border);
        border-radius: 20px;
    }

    /* Author row */
    .post-item-meta {
        display: flex;
        align-items: center;
        gap: 0.5rem;
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

    /* Stats row */
    .post-item-stats {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        flex-wrap: wrap;
    }

    .pi-stat {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        font-size: 0.7rem;
        color: var(--muted);
        padding: 0.18rem 0.55rem;
        background: var(--surface2);
        border: 1px solid var(--border);
        border-radius: 20px;
        font-weight: 500;
        position: relative;
    }

    .pi-stat.likes {
        color: var(--accent2);
        background: rgba(108,99,255,0.08);
        border-color: rgba(108,99,255,0.2);
        cursor: pointer;
    }

    .pi-stat.comments {
        color: var(--success);
        background: rgba(52,211,153,0.08);
        border-color: rgba(52,211,153,0.2);
    }

    /* Likes tooltip */
    .likes-tooltip {
        position: absolute;
        bottom: calc(100% + 8px);
        left: 0;
        min-width: 170px;
        max-width: 240px;
        background: var(--surface3);
        border: 1px solid var(--border);
        border-radius: 10px;
        padding: 0.75rem;
        z-index: 99;
        display: none;
        box-shadow: 0 8px 32px rgba(0,0,0,0.6);
    }

    .pi-stat.likes:hover .likes-tooltip { display: block; }

    .likes-tooltip-title {
        font-family: 'Syne', sans-serif;
        font-size: 0.6rem;
        font-weight: 700;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: var(--muted);
        margin-bottom: 0.5rem;
        padding-bottom: 0.4rem;
        border-bottom: 1px solid var(--border);
    }

    .likes-tooltip-list {
        display: flex;
        flex-direction: column;
        gap: 0.4rem;
        max-height: 130px;
        overflow-y: auto;
    }

    .likes-tooltip-list::-webkit-scrollbar { width: 3px; }
    .likes-tooltip-list::-webkit-scrollbar-thumb { background: var(--border); border-radius: 3px; }

    .liker-item {
        display: flex;
        align-items: center;
        gap: 0.45rem;
        font-size: 0.76rem;
        color: var(--text);
    }

    .liker-av {
        width: 20px; height: 20px;
        border-radius: 5px;
        background: linear-gradient(135deg, var(--accent), var(--accent2));
        display: flex; align-items: center; justify-content: center;
        font-size: 0.5rem;
        font-weight: 700;
        color: var(--white);
        flex-shrink: 0;
        font-family: 'Syne', sans-serif;
    }

    .no-likers { font-size: 0.74rem; color: var(--muted); font-style: italic; }

    /* Like button */
    .btn-like-inline {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        padding: 0.18rem 0.6rem;
        background: rgba(108,99,255,0.1);
        border: 1px solid rgba(108,99,255,0.25);
        border-radius: 20px;
        color: var(--accent2);
        font-family: 'Karla', sans-serif;
        font-size: 0.7rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
    }
    .btn-like-inline:hover {
        background: rgba(108,99,255,0.22);
        border-color: rgba(108,99,255,0.5);
    }

    /* ── Divider ── */
    .post-item-divider {
        height: 1px;
        background: var(--border);
        margin: 0 1.5rem;
    }

    /* ── Comments Section ── */
    .post-comments-section {
        margin: 0 1.5rem;
    }

    .comments-toggle-btn {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
        padding: 0.6rem 0;
        background: none;
        border: none;
        cursor: pointer;
        color: var(--muted);
        font-family: 'Karla', sans-serif;
        font-size: 0.75rem;
        font-weight: 500;
        transition: color 0.2s;
    }
    .comments-toggle-btn:hover { color: var(--accent2); }

    .ctb-left {
        display: flex;
        align-items: center;
        gap: 0.4rem;
    }

    .ctb-arrow { transition: transform 0.25s ease; font-size: 0.65rem; }
    .comments-toggle-btn.open .ctb-arrow { transform: rotate(180deg); }

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
        padding: 0.5rem 1rem;
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
        max-height: 180px;
        overflow-y: auto;
        padding-right: 0.25rem;
    }

    .dash-comments-list::-webkit-scrollbar { width: 3px; }
    .dash-comments-list::-webkit-scrollbar-thumb { background: var(--border); border-radius: 3px; }
    .dash-comments-list::-webkit-scrollbar-thumb:hover { background: var(--accent); }

    .dash-comment-item {
        display: flex;
        align-items: flex-start;
        gap: 0.55rem;
        padding: 0.55rem 0.7rem;
        background: var(--surface2);
        border-radius: 8px;
        border: 1px solid var(--border);
        transition: border-color 0.15s;
    }
    .dash-comment-item:hover { border-color: rgba(108,99,255,0.2); }

    .dc-avatar {
        width: 24px; height: 24px;
        border-radius: 6px;
        background: linear-gradient(135deg, var(--success), var(--sky));
        display: flex; align-items: center; justify-content: center;
        font-family: 'Syne', sans-serif;
        font-size: 0.54rem;
        font-weight: 700;
        color: var(--white);
        flex-shrink: 0;
        margin-top: 1px;
    }

    .dc-body { font-size: 0.78rem; line-height: 1.5; flex: 1; }
    .dc-body b { color: var(--accent2); font-weight: 600; margin-right: 0.3rem; }
    .dc-time {
        display: inline-block;
        font-size: 0.63rem;
        color: var(--muted);
        margin-left: 0.35rem;
    }

    .no-comments {
        font-size: 0.78rem;
        color: var(--muted);
        font-style: italic;
        text-align: center;
        padding: 0.75rem 0;
    }

    /* ── Empty State ── */
    .plc-empty {
        text-align: center;
        padding: 4rem 2rem;
        color: var(--muted);
    }
    .plc-empty .empty-icon { font-size: 2.5rem; margin-bottom: 0.75rem; opacity: 0.35; display: block; }
    .plc-empty p { font-size: 0.88rem; }

    /* ── Footer bar ── */
    .plc-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0.9rem 1.5rem;
        border-top: 1px solid var(--border);
        background: var(--surface2);
    }

    .plc-footer-count { font-size: 0.75rem; color: var(--muted); }

    .scroll-hint {
        display: flex;
        align-items: center;
        gap: 0.4rem;
        font-size: 0.7rem;
        color: var(--muted);
    }

    @media (max-width: 600px) {
        .plc-page { padding: 1.5rem 1rem; }
        .plc-page-header h1 { font-size: 1.5rem; }
        .post-item-main { gap: 0.75rem; padding: 0.9rem 1rem; }
        .post-thumb-wrap { width: 58px; height: 50px; }
        .post-comments-section, .post-item-divider { margin: 0 1rem; }
        .plc-search { display: none; }
    }
</style>

<div class="plc-page">
<div class="plc-inner">

    {{-- Page Header --}}
    <div class="plc-page-header">
        <div>
            <p class="eyebrow">Admin Panel</p>
            <h1>Recent Posts</h1>
        </div>
        <a href="{{ route('posts.index') }}" class="btn-view-all">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
            Manage All Posts
        </a>
    </div>

    {{-- Main Card --}}
    <div class="post-listing-card">

        {{-- Card Header --}}
        <div class="plc-header">
            <div class="plc-title">
                <div class="ct-icon">📝</div>
                Post Feed
                <span class="plc-badge">{{ $posts->count() }}</span>
            </div>
            <div class="plc-header-right">
                <div class="plc-search">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#6b6b8a" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                    <input type="text" id="postFeedSearch" placeholder="Search posts...">
                </div>
            </div>
        </div>

        {{-- Scrollable List --}}
        <div class="posts-scroll-container" id="postFeedList">

            @forelse($posts->sortByDesc('created_at')->take(10) as $post)
            <div class="post-item" data-title="{{ strtolower($post->title) }}" data-author="{{ strtolower($post->user->first_name ?? '') }}">

                {{-- Main Row --}}
                <div class="post-item-main">

                    {{-- Thumb --}}
                    <div class="post-thumb-wrap">
                        @if($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}">
                        @else
                            <div class="post-no-thumb">🖼</div>
                        @endif
                    </div>

                    {{-- Content --}}
                    <div class="post-item-content">

                        <div class="pic-top">
                            <div class="post-item-title" title="{{ $post->title }}">{{ $post->title }}</div>
                            <span class="post-item-date">{{ $post->created_at->format('d M, Y') }}</span>
                        </div>

                        <div class="post-item-meta">
                            <div class="pi-avatar">{{ strtoupper(substr($post->user->first_name ?? '?', 0, 2)) }}</div>
                            <span class="pi-author-name">{{ $post->user->first_name ?? '—' }}</span>
                        </div>

                        <div class="post-item-stats">

                            {{-- Likes + tooltip --}}
                            <div class="pi-stat likes" tabindex="0">
                                <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                                {{ $post->likes->count() }} likes

                                <div class="likes-tooltip">
                                    <div class="likes-tooltip-title">Liked by</div>
                                    <div class="likes-tooltip-list">
                                        @forelse($post->likes as $like)
                                        <div class="liker-item">
                                            <div class="liker-av">{{ strtoupper(substr($like->user->name ?? $like->user->first_name ?? '?', 0, 2)) }}</div>
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
                                <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                                {{ $post->comments->count() }} comments
                            </div>

                            {{-- Like button --}}
                            <form action="{{ route('post.like', $post->id) }}" method="POST" style="margin:0;">
                                @csrf
                                <button type="submit" class="btn-like-inline">♥ Like</button>
                            </form>

                        </div>
                    </div>
                </div>

                {{-- Divider --}}
                <div class="post-item-divider"></div>

                {{-- Comments Accordion --}}
                <div class="post-comments-section">
                    <button class="comments-toggle-btn" onclick="toggleDashComments(this)">
                        <div class="ctb-left">
                            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                            @if($post->comments->count() > 0)
                                {{ $post->comments->count() }} comment{{ $post->comments->count() !== 1 ? 's' : '' }} — click to expand
                            @else
                                No comments yet — be the first
                            @endif
                        </div>
                        <span class="ctb-arrow">▾</span>
                    </button>

                    <div class="comments-body">

                        <form action="{{ route('post.comment', $post->id) }}" method="POST" class="comment-form-dash">
                            @csrf
                            <input type="text" name="comment" placeholder="Write a comment..." required>
                            <button type="submit">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                                Send
                            </button>
                        </form>

                        <div class="dash-comments-list">
                            @forelse($post->comments->sortByDesc('created_at') as $comment)
                            <div class="dash-comment-item">
                                <div class="dc-avatar">{{ strtoupper(substr($comment->user->name ?? $comment->user->first_name ?? '?', 0, 2)) }}</div>
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
            <div class="plc-empty">
                <span class="empty-icon">📭</span>
                <p>No posts available yet.</p>
            </div>
            @endforelse

        </div>

        {{-- Footer bar --}}
        <div class="plc-footer">
            <span class="plc-footer-count" id="postFeedCount">Showing {{ min($posts->count(), 10) }} of {{ $posts->count() }} posts</span>
            <div class="scroll-hint">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><polyline points="19 12 12 19 5 12"/></svg>
                Scroll to see more
            </div>
        </div>

    </div>

</div>
</div>

<script>
    function toggleDashComments(btn) {
        const body = btn.nextElementSibling;
        const isOpen = body.classList.toggle('open');
        btn.classList.toggle('open', isOpen);
    }

    // Live search filter
    document.getElementById('postFeedSearch').addEventListener('input', function () {
        const q = this.value.toLowerCase();
        const items = document.querySelectorAll('#postFeedList .post-item');
        let visible = 0;
        items.forEach(item => {
            const title  = item.dataset.title  || '';
            const author = item.dataset.author || '';
            const match  = title.includes(q) || author.includes(q);
            item.style.display = match ? '' : 'none';
            if (match) visible++;
        });
        document.getElementById('postFeedCount').textContent =
            q ? `${visible} result${visible !== 1 ? 's' : ''} for "${this.value}"`
              : `Showing ${visible} of {{ $posts->count() }} posts`;
    });
</script>

@endsection