<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>BlogSite — All Posts</title>
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@600;700;800&family=Karla:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
:root{
  --bg:#06060e;--surface:#0a0a18;--surface2:#0f0f22;--border:#18183a;
  --accent:#9b5de5;--accent2:#c084fc;--accent3:#e879f9;--gold:#f9c74f;
  --text:#e8e8f0;--muted:#52527a;--white:#ffffff;--nav-h:68px;
}
html{scroll-behavior:smooth}
body{background:var(--bg);font-family:'Karla',sans-serif;color:var(--text);min-height:100vh;overflow-x:hidden;cursor:none}

/* ── CURSOR ── */
.cursor{position:fixed;width:9px;height:9px;background:var(--accent2);border-radius:50%;pointer-events:none;z-index:9999;transform:translate(-50%,-50%);mix-blend-mode:screen}
.cursor-ring{position:fixed;width:32px;height:32px;border:1px solid rgba(192,132,252,.4);border-radius:50%;pointer-events:none;z-index:9998;transform:translate(-50%,-50%);transition:width .12s,height .12s,border-color .12s;mix-blend-mode:screen}

/* ── PROGRESS BAR ── */
.scroll-progress{position:fixed;top:0;left:0;height:2px;background:linear-gradient(90deg,var(--accent),var(--accent3),var(--gold));z-index:1000;width:0%;pointer-events:none}

/* ── CANVAS ── */
#hero-canvas{position:fixed;top:0;left:0;width:100%;height:100vh;z-index:0;pointer-events:none}

/* ── FOG VIGNETTE ── */
.fog-vignette{
  position:fixed;top:0;left:0;width:100%;height:100vh;z-index:1;pointer-events:none;
  background:radial-gradient(ellipse 70% 60% at 50% 50%, transparent 25%, rgba(6,6,14,.6) 75%, rgba(6,6,14,.92) 100%);
}
/* Depth rays */
.depth-rays{
  position:fixed;top:50%;left:50%;transform:translate(-50%,-50%);
  width:140vw;height:140vh;z-index:1;pointer-events:none;
  background:conic-gradient(from 0deg at 50% 50%,
    transparent 0deg, rgba(155,93,229,.025) 8deg, transparent 16deg,
    transparent 60deg, rgba(192,132,252,.02) 68deg, transparent 76deg,
    transparent 130deg, rgba(232,121,249,.025) 138deg, transparent 146deg,
    transparent 200deg, rgba(249,199,79,.015) 208deg, transparent 216deg,
    transparent 270deg, rgba(155,93,229,.02) 278deg, transparent 286deg,
    transparent 340deg, rgba(192,132,252,.025) 348deg, transparent 360deg
  );
  animation:rayRot 60s linear infinite;
}
@keyframes rayRot{from{transform:translate(-50%,-50%) rotate(0deg)}to{transform:translate(-50%,-50%) rotate(360deg)}}

/* ── SCROLL DRIVER ── */
#scroll-driver{height:560vh;position:relative;z-index:2}

/* ── STICKY HERO ── */
.hero-sticky{position:sticky;top:0;height:100vh;display:flex;flex-direction:column;align-items:center;justify-content:center;pointer-events:none;overflow:hidden}

/* ── HERO LABEL ── */
.hero-label{
  font-family:'Syne',sans-serif;font-size:.68rem;font-weight:700;
  letter-spacing:.3em;text-transform:uppercase;color:var(--gold);
  opacity:0;transform:translateY(14px);transition:opacity .7s,transform .7s;
  position:absolute;top:19%;display:flex;align-items:center;gap:.8rem;
}
.hero-label::before,.hero-label::after{content:'';width:28px;height:1px;background:var(--gold);opacity:.45}
.hero-label.visible{opacity:1;transform:translateY(0)}

/* ── HERO TITLE ── */
.hero-main-title{
  font-family:'Syne',sans-serif;font-size:clamp(2.8rem,7vw,6rem);
  font-weight:800;color:var(--white);text-align:center;line-height:1;
  position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);
  width:100%;padding:0 2rem;
}
.hero-main-title .line{display:block;overflow:hidden}
.hero-main-title .word{display:inline-block;transform:translateY(110%);transition:transform .9s cubic-bezier(.16,1,.3,1)}
.hero-main-title .word.up{transform:translateY(0)}

.hero-sub{
  position:absolute;font-size:.85rem;color:var(--muted);
  letter-spacing:.08em;opacity:0;transition:opacity .8s .5s;
  white-space:nowrap;top:calc(50% + clamp(3rem,7.5vw,6.6rem));
  left:50%;transform:translateX(-50%);
}
.hero-sub.visible{opacity:1}

/* ── GRADIENT TEXT ── */
.gradient-text{
  background:linear-gradient(90deg,var(--accent),var(--accent2),var(--accent3),var(--gold),var(--accent));
  -webkit-background-clip:text;-webkit-text-fill-color:transparent;
  background-clip:text;background-size:400%;
  animation:gShift 7s linear infinite;
}
@keyframes gShift{0%{background-position:0%}100%{background-position:400%}}

/* ── SCROLL HEADINGS ── */
.scroll-heading{
  position:absolute;font-family:'Syne',sans-serif;font-weight:800;
  font-size:clamp(1.15rem,2.8vw,2.3rem);color:var(--white);
  text-align:center;width:88%;left:50%;
  transform:translateX(-50%) translateY(28px);
  opacity:0;transition:opacity .6s,transform .6s;pointer-events:none;
}
.scroll-heading span{color:var(--gold)}
.scroll-heading .sub{
  display:block;font-size:.58em;font-weight:400;
  color:var(--muted);margin-top:.38rem;
  letter-spacing:.12em;text-transform:uppercase;
}
.scroll-heading.show{opacity:1;transform:translateX(-50%) translateY(0)}
#sh1{top:19%}#sh2{top:19%}#sh3{top:19%}#sh4{top:19%}

/* ── SCROLL HINT ── */
.scroll-hint{position:absolute;bottom:5.5%;left:50%;transform:translateX(-50%);display:flex;flex-direction:column;align-items:center;gap:.5rem;opacity:1;transition:opacity .4s}
.scroll-hint.hide{opacity:0}
.scroll-hint span{font-size:.6rem;letter-spacing:.2em;text-transform:uppercase;color:var(--muted)}
.scroll-mouse{width:20px;height:32px;border:1.5px solid rgba(249,199,79,.38);border-radius:10px;display:flex;align-items:flex-start;justify-content:center;padding-top:5px}
.scroll-mouse::after{content:'';width:2px;height:6px;background:var(--gold);border-radius:2px;animation:sw 1.8s ease infinite}
@keyframes sw{0%{opacity:1;transform:translateY(0)}100%{opacity:0;transform:translateY(10px)}}

/* ── BLOB STATS ── */
.blob-stats{position:absolute;bottom:12%;left:50%;transform:translateX(-50%);display:flex;gap:2.5rem;opacity:0;transition:opacity .5s}
.bstat{text-align:center}
.bstat-num{font-family:'Syne',sans-serif;font-size:1.5rem;font-weight:800;color:var(--gold);line-height:1}
.bstat-label{font-size:.56rem;letter-spacing:.15em;text-transform:uppercase;color:var(--muted);margin-top:.22rem}

/* ── NAVBAR ── */
.navbar{position:fixed;top:0;left:0;width:100%;display:flex;align-items:center;justify-content:space-between;padding:0 2rem;height:var(--nav-h);background:rgba(6,6,14,.92);border-bottom:1px solid var(--border);backdrop-filter:blur(18px);z-index:500;gap:1.5rem}
.nav-logo{font-family:'Syne',sans-serif;font-weight:800;font-size:1.3rem;color:var(--white);text-decoration:none;display:flex;align-items:center;gap:.5rem}
.logo-dot{width:8px;height:8px;border-radius:50%;background:var(--gold);box-shadow:0 0 10px var(--gold);display:inline-block;animation:ldot 2.5s ease infinite}
@keyframes ldot{0%,100%{box-shadow:0 0 8px var(--gold)}50%{box-shadow:0 0 22px var(--gold),0 0 40px rgba(249,199,79,.22)}}
.nav-search{flex:1;max-width:420px;position:relative}
.nav-search form{display:flex}
.nav-search input{width:100%;padding:.52rem 1rem .52rem 2.5rem;border-radius:10px;border:1.5px solid var(--border);background:var(--surface2);color:var(--text);font-family:'Karla',sans-serif;font-size:.87rem;outline:none;transition:border-color .2s,box-shadow .2s}
.nav-search input:focus{border-color:var(--accent2);box-shadow:0 0 0 3px rgba(192,132,252,.1)}
.nav-search input::placeholder{color:var(--muted)}
.search-icon{position:absolute;left:.8rem;top:50%;transform:translateY(-50%);color:var(--muted);pointer-events:none}
.nav-actions{display:flex;align-items:center;gap:.75rem;flex-shrink:0}
.nav-profile{display:flex;align-items:center;gap:.6rem;padding:.4rem .75rem;background:var(--surface2);border:1px solid var(--border);border-radius:10px;cursor:pointer;transition:border-color .2s;text-decoration:none}
.nav-profile:hover{border-color:rgba(192,132,252,.4)}
.nav-avatar{width:30px;height:30px;border-radius:8px;background:linear-gradient(135deg,var(--accent),var(--accent3));display:flex;align-items:center;justify-content:center;font-family:'Syne',sans-serif;font-weight:700;font-size:.72rem;color:var(--white)}
.nav-username{font-size:.85rem;font-weight:500;color:var(--text)}
.btn-nav{padding:.5rem 1.1rem;border:none;border-radius:8px;font-family:'Karla',sans-serif;font-size:.84rem;font-weight:600;cursor:pointer;transition:all .2s;text-decoration:none;display:inline-flex;align-items:center;gap:.35rem}
.btn-login{background:linear-gradient(135deg,var(--accent),var(--accent3));color:var(--white);box-shadow:0 0 20px rgba(155,93,229,.35)}
.btn-login:hover{opacity:.9;color:var(--white)}
.btn-logout{background:rgba(192,132,252,.1);color:var(--accent2);border:1px solid rgba(192,132,252,.25)}
.btn-logout:hover{background:rgba(192,132,252,.2)}

/* ── POSTS SECTION ── */
.posts-section{position:relative;z-index:10;background:var(--bg);padding:5rem 1.5rem 5rem}
.posts-section::before{content:'';position:absolute;top:0;left:0;right:0;height:280px;background:linear-gradient(to bottom,transparent,var(--bg));pointer-events:none;z-index:1}

.section-header{text-align:center;max-width:1140px;margin:0 auto 3rem;position:relative;z-index:2}
.section-eyebrow{display:inline-flex;align-items:center;gap:.5rem;padding:.35rem 1rem;background:rgba(155,93,229,.1);border:1px solid rgba(155,93,229,.25);border-radius:20px;font-size:.67rem;font-weight:700;letter-spacing:.15em;text-transform:uppercase;color:var(--accent2);margin-bottom:1rem}
.section-eyebrow::before{content:'';width:5px;height:5px;border-radius:50%;background:var(--gold);box-shadow:0 0 6px var(--gold)}
.section-title{font-family:'Syne',sans-serif;font-size:clamp(2rem,4vw,3.2rem);font-weight:800;color:var(--white);margin-bottom:.75rem}
.section-sub{font-size:.9rem;color:var(--muted);max-width:460px;margin:0 auto;line-height:1.7}

.posts-wrapper{max-width:1140px;margin:0 auto;position:relative;z-index:2}
.posts-toolbar{display:flex;align-items:center;justify-content:space-between;margin-bottom:2rem;flex-wrap:wrap;gap:.75rem}
.posts-count{font-family:'Syne',sans-serif;font-size:.74rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:var(--muted)}
.posts-count span{color:var(--gold)}
.sort-tabs{display:flex;gap:.4rem}
.sort-tab{padding:.38rem .9rem;border-radius:8px;font-size:.74rem;font-weight:600;cursor:pointer;border:1px solid var(--border);background:transparent;color:var(--muted);font-family:'Karla',sans-serif;transition:all .18s}
.sort-tab.active,.sort-tab:hover{background:rgba(155,93,229,.12);border-color:rgba(155,93,229,.35);color:var(--accent2)}

/* ── POSTS GRID ── */
.posts-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:1.2rem}
.post-card:first-child{grid-column:span 2}
.post-card:first-child .post-image-wrap{height:260px}

.post-card{background:var(--surface);border:1px solid var(--border);border-radius:14px;overflow:hidden;display:flex;flex-direction:column;transition:transform .22s,border-color .22s,box-shadow .22s;opacity:0;transform:translateY(26px)}
.post-card.card-visible{animation:cReveal .65s cubic-bezier(.16,1,.3,1) forwards}
@keyframes cReveal{to{opacity:1;transform:translateY(0)}}
.post-card:nth-child(1){animation-delay:0s}.post-card:nth-child(2){animation-delay:.07s}.post-card:nth-child(3){animation-delay:.13s}.post-card:nth-child(4){animation-delay:.19s}.post-card:nth-child(5){animation-delay:.25s}.post-card:nth-child(6){animation-delay:.31s}
.post-card:hover{transform:translateY(-5px);border-color:rgba(155,93,229,.35);box-shadow:0 16px 50px rgba(0,0,0,.65),0 0 0 1px rgba(249,199,79,.05),0 0 30px rgba(155,93,229,.06)}

.post-image-wrap{position:relative;height:195px;overflow:hidden;background:var(--surface2);flex-shrink:0}
.post-image-wrap img{width:100%;height:100%;object-fit:cover;transition:transform .45s;display:block}
.post-card:hover .post-image-wrap img{transform:scale(1.06)}
.post-no-image{width:100%;height:100%;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:.5rem;background:linear-gradient(135deg,var(--surface2),#0d0820);font-size:2.2rem;opacity:.4}
.post-no-image span{font-size:.62rem;font-weight:600;color:var(--muted);letter-spacing:.12em;text-transform:uppercase}
.post-tag{position:absolute;top:.75rem;left:.75rem;padding:.18rem .6rem;background:rgba(6,6,14,.88);backdrop-filter:blur(8px);border:1px solid rgba(249,199,79,.28);border-radius:20px;font-size:.58rem;font-weight:700;color:var(--gold);letter-spacing:.1em;text-transform:uppercase}

.post-body{padding:1.1rem;display:flex;flex-direction:column;gap:.68rem;flex:1}
.post-meta{display:flex;align-items:center;gap:.6rem}
.author-avatar{width:28px;height:28px;border-radius:7px;background:linear-gradient(135deg,var(--accent),var(--accent3));display:flex;align-items:center;justify-content:center;font-family:'Syne',sans-serif;font-size:.6rem;font-weight:700;color:var(--white);flex-shrink:0}
.author-info{flex:1;min-width:0}
.author-name{font-size:.78rem;font-weight:600;color:var(--text);line-height:1.2}
.post-date{font-size:.67rem;color:var(--muted)}
.post-title{font-family:'Syne',sans-serif;font-size:.9rem;font-weight:700;color:var(--white);line-height:1.4;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden}
.post-card:first-child .post-title{font-size:1.12rem}
.post-description{font-size:.79rem;color:var(--muted);line-height:1.55;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden}
.post-divider{height:1px;background:var(--border)}
.post-stats{display:flex;align-items:center;gap:1rem}
.stat-chip{display:flex;align-items:center;gap:.3rem;font-size:.72rem;color:var(--muted);font-weight:500}
.post-actions{display:flex;align-items:center;gap:.5rem;margin-top:auto}
.btn-like{display:inline-flex;align-items:center;gap:.4rem;padding:.42rem .85rem;background:rgba(155,93,229,.1);color:var(--accent2);border:1px solid rgba(155,93,229,.25);border-radius:8px;font-family:'Karla',sans-serif;font-size:.77rem;font-weight:600;cursor:pointer;transition:all .2s}
.btn-like:hover:not([disabled]){background:rgba(155,93,229,.22);border-color:rgba(155,93,229,.5)}
.btn-like[disabled]{opacity:.35;cursor:not-allowed}
.like-count{padding:.42rem .65rem;background:var(--surface2);border:1px solid var(--border);border-radius:8px;font-size:.74rem;color:var(--muted);font-weight:500}

/* ── COMMENTS ── */
.comment-section{border-top:1px solid var(--border);padding:.82rem 1.1rem .95rem}
.comment-toggle{display:inline-flex;align-items:center;gap:.4rem;background:none;border:none;color:var(--muted);font-family:'Karla',sans-serif;font-size:.74rem;font-weight:600;cursor:pointer;padding:0;transition:color .2s}
.comment-toggle:hover{color:var(--gold)}
.comment-area{display:none;margin-top:.78rem}
.comment-area.open{display:block}
.comment-form{display:flex;gap:.5rem;margin-bottom:.82rem}
.comment-form input{flex:1;padding:.46rem .78rem;background:var(--surface2);border:1.5px solid var(--border);border-radius:8px;color:var(--text);font-family:'Karla',sans-serif;font-size:.79rem;outline:none;transition:border-color .2s}
.comment-form input:focus{border-color:var(--accent2)}
.comment-form input::placeholder{color:var(--muted)}
.comment-form input[disabled]{opacity:.4;cursor:not-allowed}
.comment-form button{padding:.46rem .88rem;background:var(--accent);color:var(--white);border:none;border-radius:8px;font-family:'Karla',sans-serif;font-size:.77rem;font-weight:700;cursor:pointer;transition:all .2s;white-space:nowrap;flex-shrink:0}
.comment-form button:hover:not([disabled]){background:var(--accent2)}
.comment-form button[disabled]{opacity:.35;cursor:not-allowed}
.comments-list{display:flex;flex-direction:column;gap:.5rem;max-height:300px;overflow-y:auto;padding-right:.2rem}
.comments-list::-webkit-scrollbar{width:2px}
.comments-list::-webkit-scrollbar-thumb{background:var(--border);border-radius:2px}
.comment-item{display:flex;align-items:flex-start;gap:.52rem}
.c-avatar{width:24px;height:24px;border-radius:6px;background:linear-gradient(135deg,var(--accent),var(--accent3));display:flex;align-items:center;justify-content:center;font-family:'Syne',sans-serif;font-size:.5rem;font-weight:700;color:var(--white);flex-shrink:0;margin-top:2px}
.r-avatar{width:20px;height:20px;border-radius:5px;background:linear-gradient(135deg,var(--accent2),var(--accent));display:flex;align-items:center;justify-content:center;font-family:'Syne',sans-serif;font-size:.44rem;font-weight:700;color:var(--white);flex-shrink:0;margin-top:2px}
.comment-content{flex:1;min-width:0}
.comment-bubble{background:var(--surface2);border:1px solid var(--border);border-radius:0 10px 10px 10px;padding:.48rem .68rem;margin-bottom:.26rem}
.reply-bubble{background:rgba(155,93,229,.05);border:1px solid rgba(155,93,229,.14);border-radius:0 9px 9px 9px;padding:.38rem .58rem;margin-bottom:.24rem}
.c-name{font-size:.67rem;font-weight:700;color:var(--gold);margin-bottom:.14rem;font-family:'Syne',sans-serif}
.reply-bubble .c-name{color:var(--accent2)}
.c-text{font-size:.76rem;color:var(--text);line-height:1.45;word-break:break-word}
.comment-actions{display:flex;align-items:center;gap:.22rem;margin-bottom:.32rem}
.c-action{display:inline-flex;align-items:center;gap:.2rem;padding:.17rem .48rem;background:none;border:1px solid transparent;border-radius:6px;font-family:'Karla',sans-serif;font-size:.67rem;font-weight:600;color:var(--muted);cursor:pointer;transition:all .18s}
.c-action:hover{background:var(--surface2);border-color:var(--border);color:var(--text)}
.c-action.like-btn:hover{color:var(--gold);border-color:rgba(249,199,79,.3)}
.c-action.reply-btn:hover{color:var(--accent2);border-color:rgba(192,132,252,.3)}
.reply-form{display:none;gap:.4rem;margin-bottom:.42rem}
.reply-form.open{display:flex}
.reply-form input{flex:1;padding:.38rem .68rem;background:var(--surface2);border:1.5px solid rgba(155,93,229,.25);border-radius:7px;color:var(--text);font-family:'Karla',sans-serif;font-size:.75rem;outline:none;transition:border-color .2s}
.reply-form input:focus{border-color:var(--accent)}
.reply-form input::placeholder{color:var(--muted)}
.reply-form input[disabled]{opacity:.4;cursor:not-allowed}
.reply-form button{padding:.38rem .78rem;background:var(--accent);color:var(--white);border:none;border-radius:7px;font-family:'Karla',sans-serif;font-size:.73rem;font-weight:700;cursor:pointer;transition:background .2s;flex-shrink:0}
.reply-form button:hover{background:var(--accent2)}
.reply-form button[disabled]{opacity:.35;cursor:not-allowed}
.replies-list{display:flex;flex-direction:column;gap:.36rem;padding-left:.88rem;border-left:2px solid rgba(155,93,229,.18);margin-top:.1rem}
.reply-item{display:flex;align-items:flex-start;gap:.42rem}

/* ── EMPTY STATE ── */
.empty-state{grid-column:1/-1;text-align:center;padding:5rem 2rem;color:var(--muted)}
.empty-icon{font-size:3rem;margin-bottom:1rem;opacity:.3;display:block}
.empty-state p{font-size:1rem;margin-bottom:.4rem;color:var(--text);font-weight:500}

/* ── FOOTER ── */
.site-footer{background:var(--surface);border-top:1px solid var(--border);position:relative;z-index:10;overflow:hidden}
.site-footer::before{content:'';position:absolute;top:-80px;left:50%;transform:translateX(-50%);width:500px;height:180px;background:radial-gradient(ellipse,rgba(155,93,229,.05) 0%,transparent 70%);pointer-events:none}
.footer-top{max-width:1140px;margin:0 auto;padding:3rem 1.5rem 2rem;display:grid;grid-template-columns:1.6fr 1fr 1fr 1fr;gap:2.5rem}
.footer-brand .brand-logo{font-family:'Syne',sans-serif;font-weight:800;font-size:1.3rem;color:var(--white);display:flex;align-items:center;gap:.5rem;margin-bottom:.9rem;text-decoration:none}
.footer-brand p{font-size:.81rem;color:var(--muted);line-height:1.7;max-width:250px;margin-bottom:1.4rem}
.footer-socials{display:flex;gap:.6rem}
.social-btn{width:34px;height:34px;border-radius:8px;background:var(--surface2);border:1px solid var(--border);display:flex;align-items:center;justify-content:center;color:var(--muted);font-size:.85rem;cursor:pointer;transition:all .2s;text-decoration:none}
.social-btn:hover{background:rgba(155,93,229,.12);border-color:rgba(155,93,229,.35);color:var(--accent2)}
.footer-col h4{font-family:'Syne',sans-serif;font-size:.67rem;font-weight:700;letter-spacing:.18em;text-transform:uppercase;color:var(--muted);margin-bottom:1rem}
.footer-col ul{list-style:none}
.footer-col ul li{margin-bottom:.55rem}
.footer-col ul li a{font-size:.82rem;color:var(--text);text-decoration:none;opacity:.6;transition:opacity .2s,color .2s;display:inline-flex;align-items:center;gap:.3rem}
.footer-col ul li a:hover{opacity:1;color:var(--gold)}
.footer-newsletter h4{font-family:'Syne',sans-serif;font-size:.67rem;font-weight:700;letter-spacing:.18em;text-transform:uppercase;color:var(--muted);margin-bottom:1rem}
.footer-newsletter p{font-size:.79rem;color:var(--muted);margin-bottom:.8rem;line-height:1.55}
.newsletter-form{display:flex;flex-direction:column;gap:.5rem}
.newsletter-form input{padding:.56rem .88rem;background:var(--surface2);border:1.5px solid var(--border);border-radius:8px;color:var(--text);font-family:'Karla',sans-serif;font-size:.81rem;outline:none;transition:border-color .2s}
.newsletter-form input:focus{border-color:var(--gold)}
.newsletter-form input::placeholder{color:var(--muted)}
.newsletter-form button{padding:.56rem;background:linear-gradient(135deg,var(--accent),var(--accent3));color:var(--white);border:none;border-radius:8px;font-family:'Karla',sans-serif;font-size:.81rem;font-weight:600;cursor:pointer;transition:opacity .2s}
.newsletter-form button:hover{opacity:.88}
.footer-divider{max-width:1140px;margin:0 auto;height:1px;background:var(--border)}
.footer-bottom{max-width:1140px;margin:0 auto;padding:1.2rem 1.5rem;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:.75rem}
.footer-copy{font-size:.75rem;color:var(--muted)}
.footer-copy span{color:var(--gold)}
.footer-tags{display:flex;gap:.5rem;flex-wrap:wrap}
.footer-tag{padding:.15rem .55rem;border-radius:20px;font-size:.61rem;font-weight:600;letter-spacing:.06em;background:rgba(155,93,229,.1);color:var(--accent2);border:1px solid rgba(155,93,229,.2)}

@media(max-width:960px){.posts-grid{grid-template-columns:repeat(2,1fr)}.post-card:first-child{grid-column:span 2}.footer-top{grid-template-columns:1fr 1fr}}
@media(max-width:640px){.posts-grid{grid-template-columns:1fr}.post-card:first-child{grid-column:span 1}.footer-top{grid-template-columns:1fr;gap:2rem}.navbar{padding:0 1rem;gap:.75rem}.nav-search{display:none}.footer-bottom{flex-direction:column;align-items:flex-start}}
@media(max-width:400px){.nav-username{display:none}}
</style>
</head>
<body>

<div class="cursor" id="cursor"></div>
<div class="cursor-ring" id="cursorRing"></div>
<div class="fog-vignette"></div>
<div class="depth-rays"></div>
<div class="scroll-progress" id="scrollProgress"></div>
<canvas id="hero-canvas"></canvas>

<!-- NAVBAR -->
<nav class="navbar">
  <a href="/" class="nav-logo">Blog<span style="color:var(--gold)">Site</span><span class="logo-dot"></span></a>
  <div class="nav-search">
    <form action="{{ route('home') }}" method="GET">
      <svg class="search-icon" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
      <input type="text" name="search" id="search" placeholder="Search stories..." value="{{ request('search') }}">
    </form>
  </div>
  <div class="nav-actions">
    @auth
      <a href="{{ route('profile') }}" class="nav-profile">
        <div class="nav-avatar">{{ strtoupper(substr(Auth::user()->first_name ?? 'U', 0, 2)) }}</div>
        <span class="nav-username">{{ Auth::user()->first_name ?? 'User' }}</span>
      </a>
      <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn-nav btn-logout">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>Logout
        </button>
      </form>
    @else
      <a href="{{ route('login') }}" class="btn-nav btn-login">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/></svg>Login
      </a>
    @endauth
  </div>
</nav>

<!-- SCROLL DRIVER -->
<div id="scroll-driver">
  <div class="hero-sticky">
    <div class="hero-label" id="heroLabel">Where Stories Take Shape</div>
    <h1 class="hero-main-title">
      <span class="line"><span class="word" id="w1">Every</span> <span class="word" id="w2">Story</span></span>
      <span class="line"><span class="word gradient-text" id="w3">Lives Here</span></span>
    </h1>
    <p class="hero-sub" id="heroSub">Ideas that refuse to stay still</p>

    <div class="scroll-heading" id="sh1">
      The <span>Void Stirs</span>
      <span class="sub">Your next story is taking shape</span>
    </div>
    <div class="scroll-heading" id="sh2">
      Words <span>Take Form</span>
      <span class="sub">Ideas morphing into something real</span>
    </div>
    <div class="scroll-heading" id="sh3">
      Stories <span>Break Free</span>
      <span class="sub">Each drop carries a universe inside</span>
    </div>
    <div class="scroll-heading" id="sh4">
      Read the <span>Feed</span> ↓
      <span class="sub">Stories waiting for you below</span>
    </div>

    <div class="blob-stats" id="blobStats">
      <div class="bstat"><div class="bstat-num" id="sMass">0</div><div class="bstat-label">Blob Mass</div></div>
      <div class="bstat"><div class="bstat-num" id="sDrops">0</div><div class="bstat-label">Drops Free</div></div>
      <div class="bstat"><div class="bstat-num" id="sGlow">0%</div><div class="bstat-label">Void Glow</div></div>
    </div>

    <div class="scroll-hint" id="scrollHint">
      <div class="scroll-mouse"></div>
      <span>Scroll to shatter the void</span>
    </div>
  </div>
</div>

<!-- POSTS -->
<div class="posts-section">
  <div class="section-header">
    <div class="section-eyebrow">Void Stories</div>
    <h2 class="section-title">Explore <span class="gradient-text">All Posts</span></h2>
    <p class="section-sub">Stories that broke free from the void — read them all.</p>
  </div>
  <div class="posts-wrapper">
    <div class="posts-toolbar">
      <div class="posts-count"><span>{{ $posts->count() }}</span> post{{ $posts->count() !== 1 ? 's' : '' }} available</div>
      <div class="sort-tabs">
        <button class="sort-tab active">Latest</button>
        <button class="sort-tab">Popular</button>
        <button class="sort-tab">With Images</button>
      </div>
    </div>
    <div class="posts-grid">
      @forelse($posts as $post)
      <div class="post-card">
        <div class="post-image-wrap">
          @if($post->image)
            <img src="{{ asset('storage/'.$post->image) }}" alt="{{ $post->title }}">
            <span class="post-tag">✦ Post</span>
          @else
            <div class="post-no-image">🫧<span>Void Story</span></div>
          @endif
        </div>
        <div class="post-body">
          <div class="post-meta">
            <div class="author-avatar">{{ strtoupper(substr($post->user->first_name ?? '?', 0, 2)) }}</div>
            <div class="author-info">
              <div class="author-name">{{ $post->user->first_name ?? 'Unknown' }}</div>
              <div class="post-date">{{ $post->created_at->format('d M, Y') }}</div>
            </div>
          </div>
          <h2 class="post-title">{{ $post->title }}</h2>
          <p class="post-description">{{ $post->description }}</p>
          <div class="post-divider"></div>
          <div class="post-stats">
            <div class="stat-chip">
              <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
              {{ $post->likes->count() }} likes
            </div>
            <div class="stat-chip">
              <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
              {{ $post->comments->count() }} comments
            </div>
          </div>
          <div class="post-actions">
            <form action="{{ route('post.like', $post->id) }}" method="POST">
              @csrf
              <button type="submit" class="btn-like" @guest disabled @endguest>
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>Like
              </button>
            </form>
            <span class="like-count">{{ $post->likes->count() }}</span>
          </div>
        </div>
        <div class="comment-section">
          <button class="comment-toggle" onclick="toggleComments(this)">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
            {{ $post->comments->count() }} comment{{ $post->comments->count() !== 1 ? 's' : '' }} ▾
          </button>
          <div class="comment-area">
            <form action="{{ route('post.comment', $post->id) }}" method="POST" class="comment-form">
              @csrf
              <input type="text" name="comment" placeholder="Write a comment..." @guest disabled @endguest>
              <button type="submit" @guest disabled @endguest>Send</button>
            </form>
            <div class="comments-list">
              @foreach($post->comments->whereNull('parent_id') as $comment)
              <div class="comment-item">
                <div class="c-avatar">{{ strtoupper(substr($comment->user->first_name ?? '?', 0, 2)) }}</div>
                <div class="comment-content">
                  <div class="comment-bubble">
                    <div class="c-name">{{ $comment->user->first_name ?? 'User' }}</div>
                    <div class="c-text">{{ $comment->comment }}</div>
                  </div>
                  <div class="comment-actions">
                    <form action="{{ route('comment.like', $comment->id) }}" method="POST" style="display:inline">
                      @csrf
                      <button type="submit" class="c-action like-btn">❤️ {{ $comment->likes->count() }}</button>
                    </form>
                    @auth
                    <button type="button" class="c-action reply-btn" onclick="toggleReplyBox({{ $comment->id }})">↩ Reply</button>
                    @endauth
                  </div>
                  @auth
                  <form action="{{ route('comment.reply', $comment->id) }}" method="POST" class="reply-form" id="reply-box-{{ $comment->id }}">
                    @csrf
                    <input type="text" name="comment" placeholder="Write a reply..." required>
                    <button type="submit">Send</button>
                  </form>
                  @endauth
                  @if($comment->replies->count() > 0)
                  <div class="replies-list">
                    @foreach($comment->replies as $reply)
                    <div class="reply-item">
                      <div class="r-avatar">{{ strtoupper(substr($reply->user->first_name ?? '?', 0, 2)) }}</div>
                      <div class="comment-content">
                        <div class="reply-bubble">
                          <div class="c-name">{{ $reply->user->first_name ?? 'User' }}</div>
                          <div class="c-text">{{ $reply->comment }}</div>
                        </div>
                        <div class="comment-actions">
                          <form action="{{ route('comment.like', $reply->id) }}" method="POST" style="display:inline">
                            @csrf
                            <button type="submit" class="c-action like-btn">❤️ {{ $reply->likes->count() }}</button>
                          </form>
                        </div>
                      </div>
                    </div>
                    @endforeach
                  </div>
                  @endif
                </div>
              </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
      @empty
      <div class="empty-state">
        <span class="empty-icon">🫧</span>
        <p>No void stories yet.</p>
        <span>Be the first to break through!</span>
      </div>
      @endforelse
    </div>
  </div>
</div>

<!-- FOOTER -->
<footer class="site-footer">
  <div class="footer-top">
    <div class="footer-brand">
      <a href="/" class="brand-logo">Blog<span style="color:var(--gold)">Site</span><span class="logo-dot"></span></a>
      <p>Stories that broke free from the void — a space for ideas that refuse to stay still.</p>
      <div class="footer-socials">
        <a href="#" class="social-btn">𝕏</a>
        <a href="#" class="social-btn"><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0 0 24 12c0-6.63-5.37-12-12-12z"/></svg></a>
        <a href="#" class="social-btn">in</a>
      </div>
    </div>
    <div class="footer-col"><h4>Explore</h4><ul>
      <li><a href="{{ route('posts.index') }}">All Posts</a></li>
      <li><a href="#">Trending</a></li>
      <li><a href="#">Featured</a></li>
      <li><a href="#">Archive</a></li>
    </ul></div>
    <div class="footer-col"><h4>Account</h4><ul>
      @auth
        <li><a href="#">My Profile</a></li>
        <li><a href="#">My Posts</a></li>
        <li><a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('fl').submit();">Logout</a></li>
        <form id="fl" action="{{ route('logout') }}" method="POST" style="display:none">@csrf</form>
      @else
        <li><a href="{{ route('login') }}">Login</a></li>
        <li><a href="#">Register</a></li>
      @endauth
    </ul></div>
    <div class="footer-newsletter"><h4>Newsletter</h4>
      <p>Get void stories delivered fresh.</p>
      <div class="newsletter-form">
        <input type="email" placeholder="your@email.com">
        <button type="button">Subscribe →</button>
      </div>
    </div>
  </div>
  <div class="footer-divider"></div>
  <div class="footer-bottom">
    <div class="footer-copy">© {{ date('Y') }} <span>BlogSite</span> — Shaped from the void ✦</div>
    <div class="footer-tags">
      <span class="footer-tag">Void Purple</span>
      <span class="footer-tag">Dark Mode</span>
      <span class="footer-tag">Community</span>
    </div>
  </div>
</footer>

<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>

<script>

gsap.registerPlugin(ScrollTrigger);

/* ── CURSOR ── */
const curDot=document.getElementById('cursor'),curRing=document.getElementById('cursorRing');
let mx=0,my=0,rx=0,ry=0;
document.addEventListener('mousemove',e=>{mx=e.clientX;my=e.clientY;});
(function ac(){requestAnimationFrame(ac);
  curDot.style.left=mx+'px';curDot.style.top=my+'px';
  rx+=(mx-rx)*.12;ry+=(my-ry)*.12;
  curRing.style.left=rx+'px';curRing.style.top=ry+'px';
})();
document.querySelectorAll('a,button,.post-card').forEach(el=>{
  el.addEventListener('mouseenter',()=>{curRing.style.width='46px';curRing.style.height='46px';curRing.style.borderColor='rgba(249,199,79,.7)';});
  el.addEventListener('mouseleave',()=>{curRing.style.width='32px';curRing.style.height='32px';curRing.style.borderColor='rgba(192,132,252,.4)';});
});

/* ════════════════════════════════════════
   THREE.JS — VOID PURPLE LIQUID BLOB
════════════════════════════════════════ */
const canvas=document.getElementById('hero-canvas');
const renderer=new THREE.WebGLRenderer({canvas,antialias:true,alpha:true});
renderer.setPixelRatio(Math.min(devicePixelRatio,2));
renderer.setSize(innerWidth,innerHeight);
const scene=new THREE.Scene();
const camera=new THREE.PerspectiveCamera(55,innerWidth/innerHeight,.1,100);
camera.position.set(0,0,6);

/* Lighting */
scene.add(new THREE.AmbientLight(0xffffff,.1));
const lA=new THREE.PointLight(0x9b5de5,6,16);lA.position.set(3,3,3);scene.add(lA);
const lB=new THREE.PointLight(0xf9c74f,3,12);lB.position.set(-2,-2,2);scene.add(lB);
const lC=new THREE.PointLight(0xe879f9,2.5,10);lC.position.set(0,0,5);scene.add(lC);
const lD=new THREE.PointLight(0xc084fc,2,10);lD.position.set(-4,2,1);scene.add(lD);

/* ── MAIN BLOB ── */
const blobGeo=new THREE.IcosahedronGeometry(1.7,5);
const blobMat=new THREE.MeshPhongMaterial({
  color:0x4c1d95,specular:0xc084fc,shininess:240,
  emissive:0x2e1065,emissiveIntensity:.45,
  transparent:true,opacity:0,
});
const blob=new THREE.Mesh(blobGeo,blobMat);
scene.add(blob);

/* Wireframe rim */
const rimMat=new THREE.MeshBasicMaterial({color:0x9b5de5,wireframe:true,transparent:true,opacity:0});
scene.add(new THREE.Mesh(blobGeo,rimMat));

/* Inner gold glow */
const glowMat=new THREE.MeshBasicMaterial({color:0xf9c74f,transparent:true,opacity:0,side:THREE.BackSide});
const glowSphere=new THREE.Mesh(new THREE.SphereGeometry(1.2,16,16),glowMat);
scene.add(glowSphere);

/* Original positions for noise deformation */
const origPos=new Float32Array(blobGeo.attributes.position.array);
const blobPos=blobGeo.attributes.position;

/* ── TEAR DROPS ── */
const DROP_COUNT=10;
const drops=[];
const dropGroup=new THREE.Group();
scene.add(dropGroup);

const dropColors=[0x9b5de5,0xc084fc,0xe879f9,0xf9c74f,0xddd6fe,0x818cf8,0x9b5de5,0xe879f9,0xc084fc,0xf9c74f];
const dropData=[];

for(let i=0;i<DROP_COUNT;i++){
  const size=.1+Math.random()*.15;
  const dGeo=new THREE.SphereGeometry(size,12,12);
  const col=dropColors[i];
  const dMat=new THREE.MeshPhongMaterial({
    color:col,emissive:col,emissiveIntensity:.5,
    shininess:200,specular:0xffffff,transparent:true,opacity:0
  });
  const d=new THREE.Mesh(dGeo,dMat);
  // Teardrop elongation
  d.scale.set(.65,1.5,.65);
  const angle=(i/DROP_COUNT)*Math.PI*2;
  const orbitR=1.6+Math.random()*.9;
  dropData.push({
    angle,orbitR,
    speed:.006+Math.random()*.008,
    yOff:(Math.random()-.5)*.7,
    phase:Math.random()*Math.PI*2,
    ySpeed:.003+Math.random()*.004,
    startAngle:angle,
  });
  dropGroup.add(d);
  drops.push(d);
}

/* Connecting threads blob→drop */
const threads=drops.map((_,i)=>{
  const tg=new THREE.BufferGeometry().setFromPoints([new THREE.Vector3(),new THREE.Vector3()]);
  const tm=new THREE.LineBasicMaterial({color:0x7c3aed,transparent:true,opacity:0});
  const line=new THREE.Line(tg,tm);
  scene.add(line);return line;
});

/* ── FOG PARTICLE CLOUD ── */
const fogCount=400;
const fogGeo=new THREE.BufferGeometry();
const fogPos=new Float32Array(fogCount*3);
const fogCols=new Float32Array(fogCount*3);
const fogColors2=[new THREE.Color(0x4c1d95),new THREE.Color(0x7c3aed),new THREE.Color(0x9b5de5),new THREE.Color(0x2e1065)];
for(let i=0;i<fogCount;i++){
  fogPos[i*3]=(Math.random()-.5)*22;
  fogPos[i*3+1]=(Math.random()-.5)*16;
  fogPos[i*3+2]=(Math.random()-.5)*10;
  const fc=fogColors2[Math.floor(Math.random()*fogColors2.length)];
  fogCols[i*3]=fc.r;fogCols[i*3+1]=fc.g;fogCols[i*3+2]=fc.b;
}
fogGeo.setAttribute('position',new THREE.BufferAttribute(fogPos,3));
fogGeo.setAttribute('color',new THREE.BufferAttribute(fogCols,3));
const fogPts=new THREE.Points(fogGeo,new THREE.PointsMaterial({vertexColors:true,size:.04,transparent:true,opacity:.3}));
scene.add(fogPts);

/* ── BURST PARTICLES (on load) ── */
const burstCount=280;
const burstGeo=new THREE.BufferGeometry();
const burstPos=new Float32Array(burstCount*3);
const burstVel=[];
const burstCols=new Float32Array(burstCount*3);
const burstCols2=[new THREE.Color(0x9b5de5),new THREE.Color(0xf9c74f),new THREE.Color(0xe879f9),new THREE.Color(0xc084fc)];
for(let i=0;i<burstCount;i++){
  burstPos[i*3]=0;burstPos[i*3+1]=0;burstPos[i*3+2]=0;
  const theta=Math.random()*Math.PI*2,phi=Math.acos(2*Math.random()-1),spd=.03+Math.random()*.1;
  burstVel.push({vx:Math.sin(phi)*Math.cos(theta)*spd,vy:Math.sin(phi)*Math.sin(theta)*spd,vz:Math.cos(phi)*spd});
  const bc=burstCols2[Math.floor(Math.random()*burstCols2.length)];
  burstCols[i*3]=bc.r;burstCols[i*3+1]=bc.g;burstCols[i*3+2]=bc.b;
}
burstGeo.setAttribute('position',new THREE.BufferAttribute(burstPos,3));
burstGeo.setAttribute('color',new THREE.BufferAttribute(burstCols,3));
const burstMat=new THREE.PointsMaterial({vertexColors:true,size:.07,transparent:true,opacity:1});
const burstPts=new THREE.Points(burstGeo,burstMat);
scene.add(burstPts);
let burstTimer=0,burstDone=false;

/* ════════════════════════════════════════
   NOISE FUNCTION
════════════════════════════════════════ */
function noise3(x,y,z,t){
  return Math.sin(x*1.9+t)*Math.cos(y*1.7+t*.8)*Math.sin(z*2.1+t*.6)
        +Math.sin(x*3.1+t*1.2)*Math.cos(z*2.6+t*.9)*.35
        +Math.cos(y*2.4+t*.5)*Math.sin(x*1.3+t*.7)*.2;
}

/* ════════════════════════════════════════
   SCROLL PHASES
════════════════════════════════════════ */
let SP=0;
const phases=[{s:0,e:.10},{s:.10,e:.30},{s:.30,e:.58},{s:.58,e:.78},{s:.78,e:1.0}];
function pp(idx,raw){const p=phases[idx];return Math.max(0,Math.min(1,(raw-p.s)/(p.e-p.s)));}
function lerp(a,b,t){return a+(b-a)*t;}

ScrollTrigger.create({
  trigger:'#scroll-driver',start:'top top',end:'bottom bottom',scrub:.4,
  onUpdate(self){SP=self.progress;updateScene(SP);document.getElementById('scrollProgress').style.width=(SP*100)+'%';}
});
ScrollTrigger.create({
  trigger:'#scroll-driver',start:'10% top',end:'42% top',scrub:true,
  onUpdate(self){
    const el=document.querySelector('.hero-main-title'),sub=document.getElementById('heroSub');
    el.style.opacity=1-self.progress;
    sub.style.opacity=Math.max(0,.7-self.progress*2);
    el.style.transform=`translate(-50%,calc(-50% + ${self.progress*-55}px))`;
  }
});

function updateScene(p){
  const p0=pp(0,p),p1=pp(1,p),p2=pp(2,p),p3=pp(3,p),p4=pp(4,p);
  const T=Date.now()*.001;

  /* ── Title words ── */
  if(p0>.15)document.getElementById('w1').classList.add('up');
  if(p0>.48)document.getElementById('w2').classList.add('up');
  if(p0>.76)document.getElementById('w3').classList.add('up');
  if(p0>.06){document.getElementById('heroLabel').classList.add('visible');document.getElementById('heroSub').classList.add('visible');}
  p>.03?document.getElementById('scrollHint').classList.add('hide'):document.getElementById('scrollHint').classList.remove('hide');

  /* ── Phase headings ── */
  const hR=[[.10,.28],[.28,.50],[.50,.68],[.68,.88]];
  ['sh1','sh2','sh3','sh4'].forEach((id,i)=>{
    const el=document.getElementById(id);const[s,e]=hR[i];
    p>=s&&p<e?el.classList.add('show'):el.classList.remove('show');
  });

  /* ── Phase 1: Blob fades in + breathes ── */
  const blobOp=p4>0?lerp(p1*.95,0,p4):p1*.95;
  blobMat.opacity=blobOp;
  rimMat.opacity=blobOp*.1;
  glowMat.opacity=blobOp*(.08+Math.sin(T*1.8)*.04);

  /* Noise morphing */
  const morphStrength=.28+p1*.12;
  for(let i=0;i<blobPos.count;i++){
    const ox=origPos[i*3],oy=origPos[i*3+1],oz=origPos[i*3+2];
    const n=noise3(ox,oy,oz,T)*morphStrength;
    const len=Math.sqrt(ox*ox+oy*oy+oz*oz);
    const sc=(len+n)/len;
    blobPos.array[i*3]=ox*sc;blobPos.array[i*3+1]=oy*sc;blobPos.array[i*3+2]=oz*sc;
  }
  blobPos.needsUpdate=true;blobGeo.computeVertexNormals();
  blobMat.emissiveIntensity=.3+Math.sin(T*1.5)*.18;

  /* Shrink blob as drops separate */
  const blobScale=lerp(1.0,.35,p3);
  blob.scale.setScalar(p4>0?lerp(blobScale,0,p4):blobScale);
  glowSphere.scale.setScalar(p4>0?lerp(blobScale,0,p4):blobScale);

  /* ── Phase 2+3: Tear drops emerge ── */
  let activeDrops=0;
  drops.forEach((d,i)=>{
    const dd=dropData[i];
    const thr=i/DROP_COUNT;
    const dP=Math.max(0,Math.min(1,(p2-thr*.55)/(1-thr*.55)));
    const op=p4>0?lerp(dP*.92,0,p4):dP*.92;
    d.material.opacity=op;
    if(op>.05)activeDrops++;

    /* Orbit outward as p3 grows */
    const orbitOut=dd.orbitR*(1+p3*1.2);
    dd.angle+=dd.speed*(1+p3*.5);
    const x=Math.cos(dd.angle)*orbitOut;
    const z=Math.sin(dd.angle)*orbitOut*.7;
    const y=dd.yOff+Math.sin(T*dd.ySpeed*2+dd.phase)*.3*(1+p3);
    d.position.set(x,y,z);
    d.rotation.z=dd.angle+Math.PI/2;
    d.rotation.x=Math.sin(T+dd.phase)*.3;
    d.material.emissiveIntensity=.3+Math.sin(T*2.5+dd.phase)*.3*dP;

    /* Thread opacity — fades as drops fly away */
    const tp=threads[i].geometry.attributes.position;
    tp.array[0]=0;tp.array[1]=0;tp.array[2]=0;
    tp.array[3]=x;tp.array[4]=y;tp.array[5]=z;
    tp.needsUpdate=true;
    threads[i].material.opacity=Math.max(0,dP*.2*(1-p3*.8))*(p4>0?1-p4:1);
  });

  /* ── BURST ── */
  if(!burstDone){
    burstTimer+=.016;
    const bp=burstGeo.attributes.position.array;
    for(let i=0;i<burstCount;i++){
      bp[i*3]+=burstVel[i].vx;bp[i*3+1]+=burstVel[i].vy;bp[i*3+2]+=burstVel[i].vz;
      burstVel[i].vx*=.96;burstVel[i].vy*=.96;burstVel[i].vz*=.96;
    }
    burstGeo.attributes.position.needsUpdate=true;
    burstMat.opacity=Math.max(0,1-burstTimer*.35);
    if(burstTimer>3.5){burstDone=true;burstMat.opacity=0;}
  }

  /* ── Stats ── */
  if(p>=.28){
    document.getElementById('blobStats').classList.add('show');
    document.getElementById('sMass').textContent=Math.round(100-p3*65);
    document.getElementById('sDrops').textContent=activeDrops;
    document.getElementById('sGlow').textContent=Math.round(blobMat.emissiveIntensity*100)+'%';
  } else document.getElementById('blobStats').classList.remove('show');

  /* ── Scene rotation + camera ── */
  blob.rotation.y+=.004;blob.rotation.x+=.002;
  dropGroup.rotation.y+=.003;
  canvas.style.opacity=p4>0?lerp(1,0,p4):1;
  fogPts.rotation.y+=.0002;fogPts.rotation.x+=.0001;
  lA.position.x=Math.cos(T*.35)*5;lA.position.z=Math.sin(T*.35)*5;
  lB.position.x=Math.cos(T*.35+Math.PI)*4;lB.position.z=Math.sin(T*.35+Math.PI)*4;
  camera.position.x=Math.sin(T*.14)*.3;
  camera.position.y=Math.cos(T*.1)*.2;
}

/* ── Render loop ── */
(function animate(){requestAnimationFrame(animate);renderer.render(scene,camera);})();
window.addEventListener('resize',()=>{camera.aspect=innerWidth/innerHeight;camera.updateProjectionMatrix();renderer.setSize(innerWidth,innerHeight);});

/* ── Post cards ── */
new IntersectionObserver(entries=>{entries.forEach(e=>{if(e.isIntersecting)e.target.classList.add('card-visible');});},{threshold:.1})
  .observe=function(){};
const io=new IntersectionObserver(entries=>{entries.forEach(e=>{if(e.isIntersecting)e.target.classList.add('card-visible');});},{threshold:.1});
document.querySelectorAll('.post-card').forEach(c=>io.observe(c));

/* ── UI ── */
function toggleComments(btn){const a=btn.nextElementSibling;const open=a.classList.toggle('open');btn.innerHTML=btn.innerHTML.replace(open?'▾':'▴',open?'▴':'▾');}
function toggleReplyBox(id){document.getElementById('reply-box-'+id).classList.toggle('open');}
document.getElementById('search').addEventListener('blur',function(){this.form.submit();});
</script>
</body>
</html>
