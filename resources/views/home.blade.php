<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>BlogSite — All Posts</title>
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@600;700;800&family=Karla:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>

/* ─────────────────────────────────────────
   RESET & VARIABLES
───────────────────────────────────────── */
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

:root {
    --bg:        #0d0d14;
    --surface:   #13131f;
    --surface2:  #1a1a2a;
    --surface3:  #1f1f30;
    --border:    #252538;
    --accent:    #6c63ff;
    --accent2:   #a78bfa;
    --danger:    #ff4f6b;
    --success:   #34d399;
    --amber:     #fbbf24;
    --text:      #e8e8f0;
    --muted:     #6b6b8a;
    --white:     #ffffff;
    --card-r:    14px;
    --nav-h:     68px;
}

html { scroll-behavior: smooth; }

body {
    background: var(--bg);
    font-family: 'Karla', sans-serif;
    color: var(--text);
    min-height: 100vh;
    display: flex;
    flex-direction: column;
}

/* ambient glow */
body::before {
    content: '';
    position: fixed;
    top: -20%;
    right: 5%;
    width: 700px; height: 700px;
    background: radial-gradient(circle, rgba(108,99,255,0.06) 0%, transparent 65%);
    pointer-events: none;
    z-index: 0;
}
body::after {
    content: '';
    position: fixed;
    bottom: -10%;
    left: -5%;
    width: 500px; height: 500px;
    background: radial-gradient(circle, rgba(52,211,153,0.03) 0%, transparent 65%);
    pointer-events: none;
    z-index: 0;
}

/* ─────────────────────────────────────────
   NAVBAR
───────────────────────────────────────── */
.navbar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 2rem;
    height: var(--nav-h);
    background: rgba(13,13,20,0.85);
    border-bottom: 1px solid var(--border);
    backdrop-filter: blur(14px);
    position: sticky;
    top: 0;
    z-index: 200;
    gap: 1.5rem;
}

.nav-logo {
    font-family: 'Syne', sans-serif;
    font-weight: 800;
    font-size: 1.3rem;
    color: var(--white);
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    flex-shrink: 0;
}

.nav-logo .logo-dot {
    width: 8px; height: 8px;
    border-radius: 50%;
    background: var(--accent);
    box-shadow: 0 0 8px var(--accent);
    display: inline-block;
}

.nav-search {
    flex: 1;
    max-width: 440px;
    position: relative;
}

.nav-search form { display: flex; }

.nav-search input {
    width: 100%;
    padding: 0.55rem 1rem 0.55rem 2.6rem;
    border-radius: 10px;
    border: 1.5px solid var(--border);
    background: var(--surface2);
    color: var(--text);
    font-family: 'Karla', sans-serif;
    font-size: 0.88rem;
    outline: none;
    transition: border-color 0.2s, box-shadow 0.2s;
}

.nav-search input:focus {
    border-color: var(--accent);
    box-shadow: 0 0 0 3px rgba(108,99,255,0.12);
}

.nav-search input::placeholder { color: var(--muted); }

.nav-search .search-icon {
    position: absolute;
    left: 0.85rem;
    top: 50%;
    transform: translateY(-50%);
    color: var(--muted);
    pointer-events: none;
}

.nav-actions { display: flex; align-items: center; gap: 0.75rem; flex-shrink: 0; }

.nav-profile {
    display: flex;
    align-items: center;
    gap: 0.6rem;
    padding: 0.4rem 0.75rem;
    background: var(--surface2);
    border: 1px solid var(--border);
    border-radius: 10px;
    cursor: pointer;
    transition: border-color 0.2s;
}
.nav-profile:hover { border-color: rgba(108,99,255,0.4); }

.nav-avatar {
    width: 30px; height: 30px;
    border-radius: 8px;
    background: linear-gradient(135deg, var(--accent), var(--accent2));
    display: flex; align-items: center; justify-content: center;
    font-family: 'Syne', sans-serif;
    font-weight: 700;
    font-size: 0.72rem;
    color: var(--white);
    flex-shrink: 0;
}

.nav-username {
    font-size: 0.85rem;
    font-weight: 500;
    color: var(--text);
}

.btn-nav {
    padding: 0.5rem 1.1rem;
    border: none;
    border-radius: 8px;
    font-family: 'Karla', sans-serif;
    font-size: 0.84rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.35rem;
}

.btn-login {
    background: var(--accent);
    color: var(--white);
    box-shadow: 0 0 16px rgba(108,99,255,0.3);
}
.btn-login:hover {
    background: #7c74ff;
    box-shadow: 0 0 24px rgba(108,99,255,0.5);
    color: var(--white);
}

.btn-logout {
    background: var(--danger-dim, rgba(255,79,107,0.12));
    color: var(--danger);
    border: 1px solid rgba(255,79,107,0.25);
}
.btn-logout:hover {
    background: rgba(255,79,107,0.22);
    border-color: rgba(255,79,107,0.5);
}

/* ─────────────────────────────────────────
   HERO SECTION
───────────────────────────────────────── */
.hero {
    position: relative;
    text-align: center;
    padding: 5rem 2rem 3.5rem;
    overflow: hidden;
    z-index: 1;
}

.hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.35rem 0.9rem;
    background: rgba(108,99,255,0.12);
    border: 1px solid rgba(108,99,255,0.25);
    border-radius: 20px;
    font-size: 0.72rem;
    font-weight: 600;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: var(--accent2);
    margin-bottom: 1.2rem;
}

.hero-badge::before {
    content: '';
    width: 6px; height: 6px;
    border-radius: 50%;
    background: var(--accent2);
    box-shadow: 0 0 6px var(--accent2);
}

.hero h1 {
    font-family: 'Syne', sans-serif;
    font-size: clamp(2rem, 5vw, 3.4rem);
    font-weight: 800;
    color: var(--white);
    line-height: 1.1;
    margin-bottom: 1rem;
}

.hero h1 .gradient-text {
    background: linear-gradient(90deg, var(--accent2), var(--success));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.hero-sub {
    font-size: 1rem;
    color: var(--muted);
    max-width: 460px;
    margin: 0 auto;
    line-height: 1.6;
}

/* ─────────────────────────────────────────
   POSTS SECTION
───────────────────────────────────────── */
.posts-section {
    flex: 1;
    max-width: 1140px;
    width: 100%;
    margin: 0 auto;
    padding: 0 1.5rem 4rem;
    position: relative;
    z-index: 1;
}

/* Filters bar */
.posts-toolbar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 2rem;
    flex-wrap: wrap;
    gap: 0.75rem;
}

.posts-count {
    font-family: 'Syne', sans-serif;
    font-size: 0.78rem;
    font-weight: 600;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: var(--muted);
}

.posts-count span { color: var(--accent2); }

.sort-tabs {
    display: flex;
    gap: 0.4rem;
}

.sort-tab {
    padding: 0.38rem 0.9rem;
    border-radius: 8px;
    font-size: 0.78rem;
    font-weight: 500;
    cursor: pointer;
    border: 1px solid var(--border);
    background: transparent;
    color: var(--muted);
    font-family: 'Karla', sans-serif;
    transition: all 0.18s;
}

.sort-tab.active, .sort-tab:hover {
    background: rgba(108,99,255,0.12);
    border-color: rgba(108,99,255,0.3);
    color: var(--accent2);
}

/* ─────────────────────────────────────────
   POSTS GRID — MAGAZINE MASONRY FEEL
───────────────────────────────────────── */
.posts-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1.25rem;
    animation: gridFadeIn 0.6s ease forwards;
}

@keyframes gridFadeIn {
    from { opacity:0; transform: translateY(20px); }
    to   { opacity:1; transform: translateY(0); }
}

/* First card spans 2 columns */
.post-card:first-child {
    grid-column: span 2;
}

.post-card:first-child .post-image-wrap {
    height: 280px;
}

/* ─────────────────────────────────────────
   POST CARD
───────────────────────────────────────── */
.post-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--card-r);
    overflow: hidden;
    display: flex;
    flex-direction: column;
    transition: transform 0.22s ease, border-color 0.22s ease, box-shadow 0.22s ease;
    animation: cardIn 0.5s ease both;
}

.post-card:nth-child(1) { animation-delay: 0.04s; }
.post-card:nth-child(2) { animation-delay: 0.08s; }
.post-card:nth-child(3) { animation-delay: 0.12s; }
.post-card:nth-child(4) { animation-delay: 0.16s; }
.post-card:nth-child(5) { animation-delay: 0.20s; }
.post-card:nth-child(6) { animation-delay: 0.24s; }

@keyframes cardIn {
    from { opacity:0; transform: translateY(16px); }
    to   { opacity:1; transform: translateY(0); }
}

.post-card:hover {
    transform: translateY(-4px);
    border-color: rgba(108,99,255,0.3);
    box-shadow: 0 12px 40px rgba(0,0,0,0.4), 0 0 0 1px rgba(108,99,255,0.1);
}

/* Image */
.post-image-wrap {
    position: relative;
    height: 200px;
    overflow: hidden;
    background: var(--surface2);
    flex-shrink: 0;
}

.post-image-wrap img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
    display: block;
}

.post-card:hover .post-image-wrap img {
    transform: scale(1.04);
}

.post-no-image {
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    background: linear-gradient(135deg, var(--surface2), #1f1a35);
    font-size: 2.5rem;
    opacity: 0.5;
}

.post-no-image span {
    font-size: 0.72rem;
    font-weight: 500;
    color: var(--muted);
    letter-spacing: 0.1em;
    text-transform: uppercase;
}

/* Category tag on image */
.post-tag {
    position: absolute;
    top: 0.75rem;
    left: 0.75rem;
    padding: 0.2rem 0.65rem;
    background: rgba(13,13,20,0.8);
    backdrop-filter: blur(6px);
    border: 1px solid rgba(108,99,255,0.3);
    border-radius: 20px;
    font-size: 0.65rem;
    font-weight: 600;
    color: var(--accent2);
    letter-spacing: 0.08em;
    text-transform: uppercase;
}

/* Card body */
.post-body {
    padding: 1.2rem;
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
    flex: 1;
}

.post-meta {
    display: flex;
    align-items: center;
    gap: 0.6rem;
}

.author-avatar {
    width: 28px; height: 28px;
    border-radius: 7px;
    background: linear-gradient(135deg, var(--accent), var(--accent2));
    display: flex; align-items: center; justify-content: center;
    font-family: 'Syne', sans-serif;
    font-size: 0.6rem;
    font-weight: 700;
    color: var(--white);
    flex-shrink: 0;
}

.author-info { flex: 1; min-width: 0; }
.author-name { font-size: 0.8rem; font-weight: 600; color: var(--text); line-height: 1.2; }
.post-date   { font-size: 0.7rem; color: var(--muted); }

.post-title {
    font-family: 'Syne', sans-serif;
    font-size: 0.95rem;
    font-weight: 700;
    color: var(--white);
    line-height: 1.4;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.post-card:first-child .post-title {
    font-size: 1.2rem;
}

/* Divider */
.post-divider {
    height: 1px;
    background: var(--border);
}

/* Stats row */
.post-stats {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.stat-chip {
    display: flex;
    align-items: center;
    gap: 0.35rem;
    font-size: 0.76rem;
    color: var(--muted);
    font-weight: 500;
}

.stat-chip svg { flex-shrink: 0; }

/* Actions */
.post-actions {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-top: auto;
}

.btn-like {
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    padding: 0.45rem 0.9rem;
    background: rgba(108,99,255,0.12);
    color: var(--accent2);
    border: 1px solid rgba(108,99,255,0.25);
    border-radius: 8px;
    font-family: 'Karla', sans-serif;
    font-size: 0.8rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
}

.btn-like:hover:not([disabled]) {
    background: rgba(108,99,255,0.25);
    border-color: rgba(108,99,255,0.5);
    color: var(--accent2);
}

.btn-like[disabled] {
    opacity: 0.4;
    cursor: not-allowed;
}

.like-count {
    padding: 0.45rem 0.7rem;
    background: var(--surface2);
    border: 1px solid var(--border);
    border-radius: 8px;
    font-size: 0.78rem;
    color: var(--muted);
    font-weight: 500;
}

/* Comment section */
.comment-section { padding: 0 1.2rem 1.2rem; }

.comment-toggle {
    display: flex;
    align-items: center;
    gap: 0.4rem;
    background: none;
    border: none;
    color: var(--muted);
    font-family: 'Karla', sans-serif;
    font-size: 0.78rem;
    font-weight: 500;
    cursor: pointer;
    padding: 0;
    margin-bottom: 0.75rem;
    transition: color 0.2s;
}
.comment-toggle:hover { color: var(--accent2); }

.comment-area { display: none; }
.comment-area.open { display: block; }

.comment-form {
    display: flex;
    gap: 0.5rem;
    margin-bottom: 0.75rem;
}

.comment-form input {
    flex: 1;
    padding: 0.5rem 0.8rem;
    background: var(--surface2);
    border: 1.5px solid var(--border);
    border-radius: 8px;
    color: var(--text);
    font-family: 'Karla', sans-serif;
    font-size: 0.82rem;
    outline: none;
    transition: border-color 0.2s;
}

.comment-form input:focus { border-color: var(--accent); }
.comment-form input::placeholder { color: var(--muted); }
.comment-form input[disabled] { opacity: 0.5; cursor: not-allowed; }

.comment-form button {
    padding: 0.5rem 0.9rem;
    background: var(--success);
    color: var(--bg);
    border: none;
    border-radius: 8px;
    font-family: 'Karla', sans-serif;
    font-size: 0.8rem;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.2s;
    white-space: nowrap;
}
.comment-form button:hover:not([disabled]) {
    background: #5fe4c0;
}
.comment-form button[disabled] { opacity: 0.4; cursor: not-allowed; }

.comments-list {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
    max-height: 140px;
    overflow-y: auto;
    padding-right: 0.3rem;
}

.comments-list::-webkit-scrollbar { width: 3px; }
.comments-list::-webkit-scrollbar-track { background: transparent; }
.comments-list::-webkit-scrollbar-thumb { background: var(--border); border-radius: 3px; }

.comment-item {
    display: flex;
    align-items: flex-start;
    gap: 0.55rem;
    padding: 0.55rem 0.7rem;
    background: var(--surface2);
    border-radius: 8px;
    border: 1px solid var(--border);
}

.c-avatar {
    width: 22px; height: 22px;
    border-radius: 5px;
    background: linear-gradient(135deg, var(--success), var(--accent));
    display: flex; align-items: center; justify-content: center;
    font-family: 'Syne', sans-serif;
    font-size: 0.55rem;
    font-weight: 700;
    color: var(--white);
    flex-shrink: 0;
    margin-top: 1px;
}

.c-text { font-size: 0.78rem; line-height: 1.4; }
.c-text b { color: var(--accent2); font-weight: 600; margin-right: 0.3rem; }

/* Empty state */
.empty-state {
    grid-column: 1 / -1;
    text-align: center;
    padding: 5rem 2rem;
    color: var(--muted);
}

.empty-icon { font-size: 3.5rem; margin-bottom: 1rem; opacity: 0.35; display: block; }
.empty-state p { font-size: 1rem; margin-bottom: 0.4rem; color: var(--text); font-weight: 500; }
.empty-state span { font-size: 0.85rem; }

/* ─────────────────────────────────────────
   FOOTER
───────────────────────────────────────── */
.site-footer {
    background: var(--surface);
    border-top: 1px solid var(--border);
    position: relative;
    z-index: 1;
    overflow: hidden;
}

.site-footer::before {
    content: '';
    position: absolute;
    top: -80px;
    left: 50%;
    transform: translateX(-50%);
    width: 600px; height: 200px;
    background: radial-gradient(ellipse, rgba(108,99,255,0.05) 0%, transparent 70%);
    pointer-events: none;
}

.footer-top {
    max-width: 1140px;
    margin: 0 auto;
    padding: 3rem 1.5rem 2rem;
    display: grid;
    grid-template-columns: 1.6fr 1fr 1fr 1fr;
    gap: 2.5rem;
}

.footer-brand .brand-logo {
    font-family: 'Syne', sans-serif;
    font-weight: 800;
    font-size: 1.3rem;
    color: var(--white);
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-bottom: 0.9rem;
    text-decoration: none;
}

.footer-brand .brand-logo .logo-dot {
    width: 8px; height: 8px;
    border-radius: 50%;
    background: var(--accent);
    box-shadow: 0 0 8px var(--accent);
}

.footer-brand p {
    font-size: 0.84rem;
    color: var(--muted);
    line-height: 1.7;
    max-width: 260px;
    margin-bottom: 1.4rem;
}

.footer-socials {
    display: flex;
    gap: 0.6rem;
}

.social-btn {
    width: 34px; height: 34px;
    border-radius: 8px;
    background: var(--surface2);
    border: 1px solid var(--border);
    display: flex; align-items: center; justify-content: center;
    color: var(--muted);
    font-size: 0.9rem;
    cursor: pointer;
    transition: all 0.2s;
    text-decoration: none;
}

.social-btn:hover {
    background: rgba(108,99,255,0.15);
    border-color: rgba(108,99,255,0.35);
    color: var(--accent2);
}

.footer-col h4 {
    font-family: 'Syne', sans-serif;
    font-size: 0.72rem;
    font-weight: 700;
    letter-spacing: 0.15em;
    text-transform: uppercase;
    color: var(--muted);
    margin-bottom: 1rem;
}

.footer-col ul { list-style: none; }

.footer-col ul li {
    margin-bottom: 0.6rem;
}

.footer-col ul li a {
    font-size: 0.85rem;
    color: var(--text);
    text-decoration: none;
    opacity: 0.7;
    transition: opacity 0.2s, color 0.2s;
    display: inline-flex;
    align-items: center;
    gap: 0.35rem;
}

.footer-col ul li a::before {
    content: '→';
    font-size: 0.65rem;
    opacity: 0;
    transform: translateX(-4px);
    transition: all 0.2s;
    color: var(--accent2);
}

.footer-col ul li a:hover {
    opacity: 1;
    color: var(--accent2);
}

.footer-col ul li a:hover::before {
    opacity: 1;
    transform: translateX(0);
}

.footer-newsletter h4 {
    font-family: 'Syne', sans-serif;
    font-size: 0.72rem;
    font-weight: 700;
    letter-spacing: 0.15em;
    text-transform: uppercase;
    color: var(--muted);
    margin-bottom: 1rem;
}

.footer-newsletter p {
    font-size: 0.82rem;
    color: var(--muted);
    margin-bottom: 0.8rem;
    line-height: 1.5;
}

.newsletter-form {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.newsletter-form input {
    padding: 0.6rem 0.9rem;
    background: var(--surface2);
    border: 1.5px solid var(--border);
    border-radius: 8px;
    color: var(--text);
    font-family: 'Karla', sans-serif;
    font-size: 0.83rem;
    outline: none;
    transition: border-color 0.2s;
}

.newsletter-form input:focus { border-color: var(--accent); }
.newsletter-form input::placeholder { color: var(--muted); }

.newsletter-form button {
    padding: 0.6rem;
    background: var(--accent);
    color: var(--white);
    border: none;
    border-radius: 8px;
    font-family: 'Karla', sans-serif;
    font-size: 0.83rem;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.2s, box-shadow 0.2s;
}

.newsletter-form button:hover {
    background: #7c74ff;
    box-shadow: 0 0 20px rgba(108,99,255,0.35);
}

.footer-divider {
    max-width: 1140px;
    margin: 0 auto;
    height: 1px;
    background: var(--border);
}

.footer-bottom {
    max-width: 1140px;
    margin: 0 auto;
    padding: 1.2rem 1.5rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 0.75rem;
}

.footer-copy {
    font-size: 0.78rem;
    color: var(--muted);
}

.footer-copy span { color: var(--accent2); }

.footer-tags {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
}

.footer-tag {
    padding: 0.18rem 0.6rem;
    border-radius: 20px;
    font-size: 0.65rem;
    font-weight: 600;
    letter-spacing: 0.06em;
    background: rgba(108,99,255,0.1);
    color: var(--accent2);
    border: 1px solid rgba(108,99,255,0.2);
}

/* ─────────────────────────────────────────
   RESPONSIVE
───────────────────────────────────────── */
@media (max-width: 960px) {
    .posts-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    .post-card:first-child {
        grid-column: span 2;
    }
    .footer-top {
        grid-template-columns: 1fr 1fr;
    }
}

@media (max-width: 640px) {
    .posts-grid {
        grid-template-columns: 1fr;
    }
    .post-card:first-child {
        grid-column: span 1;
    }
    .footer-top {
        grid-template-columns: 1fr;
        gap: 2rem;
    }
    .navbar { padding: 0 1rem; gap: 0.75rem; }
    .nav-search { display: none; }
    .hero { padding: 3rem 1.5rem 2.5rem; }
    .footer-bottom { flex-direction: column; align-items: flex-start; }
}

@media (max-width: 400px) {
    .nav-username { display: none; }
}

</style>
</head>
<body>

<!-- ══════════════════════════════
     NAVBAR
══════════════════════════════ -->
<nav class="navbar">
    <a href="/" class="nav-logo">
        Blog<span style="color:var(--accent2)">Site</span>
        <span class="logo-dot"></span>
    </a>

    <div class="nav-search">
        <form action="{{ route('home') }}" method="GET" >
            <svg class="search-icon" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            <input type="text" name="search" id="search" placeholder="Search posts..." value="{{ request('search') }}">
        </form>
    </div>

    <div class="nav-actions">
        @auth
            <div class="nav-profile">
                <div class="nav-avatar">{{ strtoupper(substr(Auth::user()->first_name ?? 'U', 0, 2)) }}</div>
                <span class="nav-username">{{ Auth::user()->first_name ?? 'User' }}</span>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-nav btn-logout">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                    Logout
                </button>
            </form>
        @else
            <a href="{{ route('login') }}" class="btn-nav btn-login">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/></svg>
                Login
            </a>
        @endauth
    </div>
</nav>

<!-- ══════════════════════════════
     HERO
══════════════════════════════ -->
<section class="hero">
    <div class="hero-badge">Latest Stories</div>
    <h1>Explore <span class="gradient-text">All Posts</span></h1>
    <p class="hero-sub">Discover stories, ideas, and perspectives from our community of writers.</p>
</section>

<!-- ══════════════════════════════
     POSTS
══════════════════════════════ -->
<main class="posts-section">
    <div class="posts-toolbar">
        <div class="posts-count">
            <span>{{ $posts->count() }}</span> post{{ $posts->count() !== 1 ? 's' : '' }} available
        </div>
        <div class="sort-tabs">
            <button class="sort-tab active">Latest</button>
            <button class="sort-tab">Popular</button>
            <button class="sort-tab">With Images</button>
        </div>
    </div>

    <div class="posts-grid">
        @forelse($posts as $post)
        <div class="post-card">
            {{-- Image --}}
            <div class="post-image-wrap">
                @if($post->image)
                    <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}">
                    <span class="post-tag">✦ Post</span>
                @else
                    <div class="post-no-image">
                        📝
                        <span>No Image</span>
                    </div>
                @endif
            </div>

            {{-- Body --}}
            <div class="post-body">
                <div class="post-meta">
                    <div class="author-avatar">{{ strtoupper(substr($post->user->first_name ?? '?', 0, 2)) }}</div>
                    <div class="author-info">
                        <div class="author-name">{{ $post->user->first_name ?? 'Unknown' }}</div>
                        <div class="post-date">{{ $post->created_at->format('d M, Y') }}</div>
                    </div>
                </div>

                <h2 class="post-title">{{ $post->title }}</h2>
                <p>{{$post->description}}</p>

                <div class="post-divider"></div>

                <div class="post-stats">
                    <div class="stat-chip">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                        {{ $post->likes->count() }} likes
                    </div>
                    <div class="stat-chip">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                        {{ $post->comments->count() }} comments
                    </div>
                </div>

                <div class="post-actions">
                    <form action="{{ route('post.like', $post->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn-like" @guest disabled @endguest>
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                            Like
                        </button>
                    </form>
                    <span class="like-count">{{ $post->likes->count() }}</span>
                </div>
            </div>

            {{-- Comments --}}
            <div class="comment-section">
                <button class="comment-toggle" onclick="toggleComments(this)">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                    {{ $post->comments->count() }} comment{{ $post->comments->count() !== 1 ? 's' : '' }}  ▾
                </button>

                <div class="comment-area">
                    <form action="{{ route('post.comment', $post->id) }}" method="POST" class="comment-form">
                        @csrf
                        <input type="text" name="comment" placeholder="Write a comment..." @guest disabled @endguest>
                        <button type="submit" @guest disabled @endguest>Send</button>
                    </form>

                    <div class="comments-list">
                        @foreach($post->comments as $comment)
                        <div class="comment-item">
                            <div class="c-avatar">{{ strtoupper(substr($comment->user->name ?? $comment->user->first_name ?? '?', 0, 2)) }}</div>
                            <div class="c-text">
                                <b>{{ $comment->user->name ?? $comment->user->first_name }}</b>{{ $comment->comment }}
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="empty-state">
            <span class="empty-icon">📭</span>
            <p>No posts available yet.</p>
            <span>Check back soon for new stories!</span>
        </div>
        @endforelse
    </div>
</main>

<!-- ══════════════════════════════
     FOOTER
══════════════════════════════ -->
<footer class="site-footer">
    <div class="footer-top">

        {{-- Brand --}}
        <div class="footer-brand">
            <a href="/" class="brand-logo">
                Blog<span style="color:var(--accent2)">Site</span>
                <span class="logo-dot"></span>
            </a>
            <p>A modern space to read, write, and connect with thinkers and creators around the world.</p>
            <div class="footer-socials">
                <a href="#" class="social-btn" title="Twitter">𝕏</a>
                <a href="#" class="social-btn" title="GitHub">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0 0 24 12c0-6.63-5.37-12-12-12z"/></svg>
                </a>
                <a href="#" class="social-btn" title="LinkedIn">in</a>
                <a href="#" class="social-btn" title="RSS">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 11a9 9 0 0 1 9 9"/><path d="M4 4a16 16 0 0 1 16 16"/><circle cx="5" cy="19" r="1"/></svg>
                </a>
            </div>
        </div>

        {{-- Nav Links --}}
        <div class="footer-col">
            <h4>Explore</h4>
            <ul>
                <li><a href="{{ route('posts.index') }}">All Posts</a></li>
                <li><a href="#">Trending</a></li>
                <li><a href="#">Featured</a></li>
                <li><a href="#">Archive</a></li>
            </ul>
        </div>

        <div class="footer-col">
            <h4>Account</h4>
            <ul>
                @auth
                    <li><a href="#">My Profile</a></li>
                    <li><a href="#">My Posts</a></li>
                    <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('footer-logout').submit();">Logout</a></li>
                    <form id="footer-logout" action="{{ route('logout') }}" method="POST" style="display:none;">@csrf</form>
                @else
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="#">Register</a></li>
                @endauth
                <li><a href="#">Settings</a></li>
            </ul>
        </div>

        {{-- Newsletter --}}
        <div class="footer-newsletter">
            <h4>Newsletter</h4>
            <p>Get the latest posts delivered straight to your inbox.</p>
            <div class="newsletter-form">
                <input type="email" placeholder="your@email.com">
                <button type="button">Subscribe →</button>
            </div>
        </div>

    </div>

    <div class="footer-divider"></div>

    <div class="footer-bottom">
        <div class="footer-copy">
            © {{ date('Y') }} <span>BlogSite</span> — Made with ♥ for writers everywhere
        </div>
        <div class="footer-tags">
            <span class="footer-tag">Open Platform</span>
            <span class="footer-tag">Dark Mode</span>
            <span class="footer-tag">Community</span>
        </div>
    </div>
</footer>

<script>
function toggleComments(btn) {
    const area = btn.nextElementSibling;
    const isOpen = area.classList.toggle('open');
    btn.innerHTML = btn.innerHTML.replace(isOpen ? '▾' : '▴', isOpen ? '▴' : '▾');
}



document.getElementById('search').addEventListener('blur', function() {
    this.form.submit();
});
</script>

</body>
</html>