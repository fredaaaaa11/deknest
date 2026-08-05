@extends('layouts.app')

@section('title', 'De Knest Construction Ltd — Building Dreams, Crafting Legacies')

@section('styles')
<style>
:root {
    --bg:           #FAFAF8;
    --bg-off:       #F2EFE9;
    --bg-dark:      #111008;
    --gold:         #B8892A;
    --gold-light:   #D4A84C;
    --gold-muted:   rgba(184,137,42,0.10);
    --text:         #1A1714;
    --text-mid:     #6B6560;
    --text-light:   #A8A49F;
    --border:       rgba(0,0,0,0.07);
    --border-gold:  rgba(184,137,42,0.25);
    --font-display: 'Cormorant Garamond', serif;
    --font-body:    'DM Sans', sans-serif;
    --ease:         cubic-bezier(0.4,0,0.2,1);
    --transition:   0.35s cubic-bezier(0.4,0,0.2,1);
}

*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
html{scroll-behavior:smooth;font-size:16px}
body{background:var(--bg);color:var(--text);font-family:var(--font-body);font-weight:300;line-height:1.7;overflow-x:hidden;-webkit-font-smoothing:antialiased}
a{text-decoration:none;color:inherit}
ul{list-style:none}
img{display:block;width:100%;height:100%;object-fit:cover}

.container{width:100%;max-width:1240px;margin:0 auto;padding:0 48px}

.tag{
    display:inline-flex;align-items:center;gap:12px;
    font-family:var(--font-body);font-size:0.68rem;font-weight:500;
    letter-spacing:0.22em;text-transform:uppercase;color:var(--gold);
    margin-bottom:20px;
}
.tag::before{content:'';width:28px;height:1px;background:var(--gold);flex-shrink:0}

.section-title{
    font-family:var(--font-display);
    font-size:clamp(2.2rem,4vw,3.6rem);
    font-weight:400;line-height:1.1;
    letter-spacing:-0.01em;color:var(--text);
}
.section-title em{font-style:italic;color:var(--gold)}

.gold-bar{width:48px;height:2px;background:var(--gold);margin:28px 0}

.btn-gold{
    display:inline-flex;align-items:center;gap:10px;
    padding:14px 36px;background:var(--gold);color:#fff;
    font-family:var(--font-body);font-size:0.75rem;font-weight:600;
    letter-spacing:0.14em;text-transform:uppercase;border:none;cursor:pointer;
    transition:opacity 0.25s ease, transform 0.25s ease;
}
.btn-gold:hover{opacity:0.88;transform:translateY(-2px)}

.btn-ghost-light{
    display:inline-flex;align-items:center;gap:10px;
    padding:13px 36px;background:transparent;
    color:rgba(255,255,255,0.65);
    font-family:var(--font-body);font-size:0.75rem;font-weight:500;
    letter-spacing:0.14em;text-transform:uppercase;
    border:1px solid rgba(255,255,255,0.18);cursor:pointer;
    transition:border-color 0.25s ease,color 0.25s ease;
}
.btn-ghost-light:hover{border-color:var(--gold);color:#fff}

.btn-ghost-dark{
    display:inline-flex;align-items:center;gap:10px;
    padding:13px 36px;background:transparent;color:var(--text-mid);
    font-family:var(--font-body);font-size:0.75rem;font-weight:500;
    letter-spacing:0.14em;text-transform:uppercase;
    border:1px solid var(--border);cursor:pointer;
    transition:border-color 0.25s ease,color 0.25s ease;
}
.btn-ghost-dark:hover{border-color:var(--gold);color:var(--gold)}

.reveal{opacity:0;transform:translateY(26px);transition:opacity 0.7s ease,transform 0.7s ease}
.reveal.visible{opacity:1;transform:translateY(0)}
.reveal-delay-1{transition-delay:.1s}
.reveal-delay-2{transition-delay:.2s}
.reveal-delay-3{transition-delay:.3s}
.reveal-delay-4{transition-delay:.4s}

/* ── NAVBAR ── */
#navbar{
    position:fixed;top:0;left:0;right:0;z-index:1000;
    padding:28px 0;
    transition:background 0.4s ease,padding 0.4s ease,box-shadow 0.4s ease;
}
#navbar.scrolled{
    background:rgba(250,250,248,0.95);
    backdrop-filter:blur(20px);
    -webkit-backdrop-filter:blur(20px);
    padding:18px 0;
    box-shadow:0 1px 0 var(--border);
}
.nav-inner{display:flex;align-items:center;justify-content:flex-start;gap:40px}
.nav-logo{display:flex;align-items:center}
.nav-links{display:flex;align-items:center;gap:24px;margin-left:auto}
.nav-links a{
    font-size:0.62rem;font-weight:500;letter-spacing:0.13em;
    text-transform:uppercase;color:var(--text-mid);
    transition:color var(--transition);position:relative;
}
.nav-links a::after{
    content:'';position:absolute;
    bottom:-3px;left:0;right:0;height:1px;
    background:var(--gold);transform:scaleX(0);
    transition:transform var(--transition);transform-origin:right;
}
.nav-links a:hover{color:var(--text)}
.nav-links a:hover::after{transform:scaleX(1);transform-origin:left}
.nav-quote{
    padding:11px 26px;
    background:var(--bg-dark);color:#fff !important;
    font-size:0.7rem !important;font-weight:600;
    letter-spacing:0.14em;text-transform:uppercase;
    transition:background 0.25s ease;
}
.nav-quote:hover{background:#222 !important}
.nav-quote::after{display:none !important}

.hamburger{display:none;flex-direction:column;gap:5px;cursor:pointer;background:none;border:none;padding:4px}
.hamburger span{display:block;width:24px;height:1.5px;background:var(--text);transition:var(--transition)}
.hamburger.open span:nth-child(1){transform:translateY(6.5px) rotate(45deg)}
.hamburger.open span:nth-child(2){opacity:0}
.hamburger.open span:nth-child(3){transform:translateY(-6.5px) rotate(-45deg)}

.mobile-nav{
    display:none;position:fixed;inset:0;
    background:var(--bg-dark);z-index:999;
    flex-direction:column;justify-content:center;align-items:center;
    gap:36px;opacity:0;pointer-events:none;transition:opacity 0.3s ease;
}
.mobile-nav.open{opacity:1;pointer-events:all;display:flex}
.mobile-nav a{
    font-family:var(--font-display);font-size:2.8rem;font-weight:400;
    color:#fff;letter-spacing:0.04em;transition:color 0.2s ease;
}
.mobile-nav a:hover{color:var(--gold)}

/* ── HERO ── */
#hero{
    position:relative;
    display:grid;
    grid-template-columns:1fr 1fr;
    min-height:100vh;
    overflow:hidden;
}
.hero-left{
    background:var(--bg-dark);
    display:flex;flex-direction:column;
    justify-content:flex-end;
    padding:160px 64px 88px;
    position:relative;overflow:hidden;
}
.hero-left::before{
    content:'';
    position:absolute;inset:0;
    background-image:radial-gradient(circle,rgba(184,137,42,0.12) 1px,transparent 1px);
    background-size:32px 32px;
    pointer-events:none;
}
.hero-eyebrow{
    display:flex;align-items:center;gap:12px;
    margin-bottom:32px;position:relative;z-index:1;
}
.hero-eyebrow-dot{width:7px;height:7px;border-radius:50%;background:var(--gold);flex-shrink:0}
.hero-eyebrow-text{
    font-size:0.65rem;font-weight:500;letter-spacing:0.24em;
    text-transform:uppercase;color:rgba(255,255,255,0.4);
}
.hero-title{
    font-family:var(--font-display);
    font-size:clamp(3.8rem,6.5vw,6.8rem);
    font-weight:300;line-height:0.95;
    letter-spacing:-0.02em;color:#fff;
    margin-bottom:32px;position:relative;z-index:1;
}
.hero-title em{font-style:italic;color:var(--gold)}
.hero-title strong{font-weight:600}
.hero-tagline{
    font-size:0.95rem;font-weight:300;font-style:italic;
    color:rgba(255,255,255,0.45);max-width:380px;
    line-height:1.8;margin-bottom:48px;
    position:relative;z-index:1;
}
.hero-btns{
    display:flex;gap:14px;flex-wrap:wrap;
    align-items:center;position:relative;z-index:1;
}
.hero-scroll{
    position:absolute;bottom:40px;left:50%;
    transform:translateX(-50%);
    display:flex;flex-direction:column;align-items:center;gap:8px;
    font-size:0.58rem;letter-spacing:0.22em;text-transform:uppercase;
    color:rgba(255,255,255,0.25);z-index:2;
    animation:scrollFloat 2s ease-in-out infinite;
}
.hero-scroll::after{content:'';width:1px;height:36px;background:linear-gradient(to bottom,var(--gold),transparent)}
@keyframes scrollFloat{
    0%,100%{transform:translateX(-50%) translateY(0)}
    50%{transform:translateX(-50%) translateY(5px)}
}
.hero-right{position:relative;background:var(--bg-off);overflow:hidden}
.hero-right-img{position:absolute;inset:0;background-size:cover;background-position:center center;background-repeat:no-repeat}
.hero-right::before{
    content:'DE KNEST';
    position:absolute;bottom:-20px;left:-10px;
    font-family:var(--font-display);font-size:9rem;font-weight:700;
    -webkit-text-stroke:1px rgba(184,137,42,0.08);color:transparent;
    letter-spacing:0.06em;white-space:nowrap;
    pointer-events:none;user-select:none;z-index:2;
}
.hero-badge{
    position:absolute;bottom:40px;left:-28px;
    background:var(--gold);color:#fff;padding:22px 26px;z-index:3;
}
.hero-badge .num{font-family:var(--font-display);font-size:2rem;font-weight:700;line-height:1;display:block}
.hero-badge .lbl{font-size:0.58rem;font-weight:600;letter-spacing:0.14em;text-transform:uppercase;opacity:0.8;margin-top:4px;display:block}

/* ── MARQUEE ── */
.marquee-wrap{
    background:var(--bg-off);
    border-top:1px solid var(--border-gold);
    border-bottom:1px solid var(--border-gold);
    padding:16px 0;overflow:hidden;
}
.marquee-track{display:flex;animation:marqueeScroll 28s linear infinite;width:max-content;white-space:nowrap}
.marquee-item{
    font-family:var(--font-display);font-size:0.95rem;font-weight:400;font-style:italic;
    color:var(--text-light);letter-spacing:0.06em;padding:0 40px;
    display:flex;align-items:center;gap:40px;
}
.marquee-item::after{content:'✦';font-style:normal;color:var(--gold);font-size:0.5rem}
@keyframes marqueeScroll{from{transform:translateX(0)}to{transform:translateX(-50%)}}

/* ── ABOUT ── */
#about{display:grid;grid-template-columns:1fr 1fr;min-height:680px;overflow:hidden}
.about-img-side{
    position:relative;overflow:hidden;min-height:580px;
    background-size:cover;background-position:center;background-repeat:no-repeat;
}
.about-img-overlay{position:absolute;inset:0;background:linear-gradient(to right,transparent 60%,rgba(250,250,248,0.3) 100%);pointer-events:none}
.about-years{position:absolute;bottom:32px;right:-24px;background:var(--gold);color:#fff;padding:20px 24px;z-index:2}
.about-years .num{font-family:var(--font-display);font-size:2rem;font-weight:700;line-height:1;display:block}
.about-years .lbl{font-size:0.58rem;font-weight:600;letter-spacing:0.14em;text-transform:uppercase;opacity:0.85;margin-top:3px;display:block}
.about-text-side{
    padding:100px 72px;background:var(--bg);
    display:flex;flex-direction:column;justify-content:center;
    position:relative;overflow:hidden;
}
.about-watermark{
    position:absolute;right:-16px;top:50%;transform:translateY(-50%) rotate(90deg);
    font-family:var(--font-display);font-size:11rem;font-weight:700;
    color:rgba(0,0,0,0.03);white-space:nowrap;pointer-events:none;user-select:none;
}
.about-text-side p{color:var(--text-mid);font-size:0.95rem;line-height:1.85;margin-bottom:18px;position:relative;z-index:1}
.about-checklist{margin-top:32px;border-top:1px solid var(--border);position:relative;z-index:1}
.about-check-item{
    display:flex;align-items:center;gap:14px;
    padding:13px 0;border-bottom:1px solid var(--border);
    font-size:0.82rem;font-weight:500;letter-spacing:0.04em;color:var(--text);
    transition:color var(--transition),padding-left var(--transition);
}
.about-check-item:hover{color:var(--gold);padding-left:8px}
.about-check-dot{width:5px;height:5px;border-radius:50%;background:var(--gold);flex-shrink:0}

/* ── STATS ── */
#stats{background:var(--bg-dark);padding:0}
.stats-grid{display:grid;grid-template-columns:repeat(4,1fr)}
.stat-cell{
    padding:72px 40px;border-right:1px solid rgba(255,255,255,0.06);
    position:relative;overflow:hidden;transition:background 0.3s ease;
}
.stat-cell:last-child{border-right:none}
.stat-cell:hover{background:rgba(184,137,42,0.05)}
.stat-cell::after{content:'';position:absolute;bottom:0;left:0;width:0;height:2px;background:var(--gold);transition:width 0.5s ease}
.stat-cell:hover::after{width:100%}
.stat-num{font-family:var(--font-display);font-size:5rem;font-weight:500;color:var(--gold);line-height:1;display:block;letter-spacing:-0.02em;margin-bottom:12px}
.stat-unit{font-size:2.4rem;color:var(--gold-light)}
.stat-label{font-size:0.65rem;font-weight:500;letter-spacing:0.2em;text-transform:uppercase;color:rgba(255,255,255,0.3)}

/* ── SERVICES ── */
#services{padding:140px 0;background:var(--bg)}
.services-layout{display:grid;grid-template-columns:1fr 2fr;gap:80px;align-items:start}
.services-sticky{position:sticky;top:120px}
.services-body-text{color:var(--text-mid);font-size:0.95rem;line-height:1.85;margin-top:20px;margin-bottom:36px}
.services-list{border-top:1px solid var(--border)}
.service-row{
    display:grid;grid-template-columns:60px 1fr 40px;
    align-items:center;gap:28px;
    padding:30px 0;border-bottom:1px solid var(--border);
    cursor:default;position:relative;transition:padding-left var(--transition);
}
.service-row::before{content:'';position:absolute;left:0;top:0;bottom:0;width:0;background:var(--gold);transition:width var(--transition)}
.service-row:hover{padding-left:18px}
.service-row:hover::before{width:2px}
.service-row:hover .svc-num{color:var(--gold)}
.service-row:hover .svc-name{color:var(--gold)}
.svc-num{font-family:var(--font-display);font-size:1.6rem;font-weight:400;font-style:italic;color:rgba(0,0,0,0.12);transition:color var(--transition);line-height:1}
.svc-name{font-family:var(--font-display);font-size:1.7rem;font-weight:500;letter-spacing:0.01em;color:var(--text);margin-bottom:4px;transition:color var(--transition)}
.svc-desc{font-size:0.82rem;color:var(--text-light);line-height:1.6}
.svc-icon{width:38px;height:38px;border:1px solid var(--border);display:flex;align-items:center;justify-content:center;color:var(--text-light);opacity:0;transform:translateX(-6px);transition:opacity var(--transition),transform var(--transition),border-color var(--transition),color var(--transition);flex-shrink:0}
.svc-icon svg{width:16px;height:16px}
.service-row:hover .svc-icon{opacity:1;transform:translateX(0);border-color:var(--gold);color:var(--gold)}

/* ── PROJECTS ── */
#projects{padding:140px 0;background:var(--bg-off)}
.projects-header{display:flex;align-items:flex-end;justify-content:space-between;margin-bottom:56px;gap:24px;flex-wrap:wrap}
.projects-heading{font-family:var(--font-display);font-size:clamp(2.2rem,4vw,3.6rem);font-weight:400;line-height:1.1;letter-spacing:-0.01em;color:var(--text)}
.projects-heading em{font-style:italic;color:var(--gold)}
.projects-mosaic{display:grid;grid-template-columns:repeat(12,1fr);gap:14px}
.proj{position:relative;overflow:hidden;cursor:pointer;text-decoration:none}
.proj:nth-child(1){grid-column:1/8}
.proj:nth-child(2){grid-column:8/13}
.proj:nth-child(3){grid-column:1/5}
.proj:nth-child(4){grid-column:5/9}
.proj:nth-child(5){grid-column:9/13}
.proj:nth-child(n+6){grid-column:span 4}
.proj-img{width:100%;aspect-ratio:4/3;background-size:cover;background-position:center center;background-repeat:no-repeat;background-color:var(--bg-off);transition:transform 0.65s var(--ease)}
.proj:nth-child(1) .proj-img,.proj:nth-child(2) .proj-img{aspect-ratio:16/9}
.proj:hover .proj-img{transform:scale(1.04)}
.proj-overlay{position:absolute;inset:0;background:linear-gradient(to top,rgba(17,16,8,0.88) 0%,rgba(17,16,8,0.1) 55%,transparent 100%);opacity:0;transition:opacity 0.4s ease}
.proj:hover .proj-overlay{opacity:1}
.proj-info{position:absolute;bottom:0;left:0;right:0;padding:24px;transform:translateY(10px);opacity:0;transition:transform 0.4s ease,opacity 0.4s ease;z-index:2}
.proj:hover .proj-info{transform:translateY(0);opacity:1}
.proj-cat{font-size:0.6rem;font-weight:500;letter-spacing:0.2em;text-transform:uppercase;color:var(--gold);margin-bottom:5px}
.proj-title-overlay{font-family:var(--font-display);font-size:1.35rem;font-weight:500;color:#fff;line-height:1.2}
.proj-meta{padding:14px 16px;display:flex;align-items:center;justify-content:space-between;background:var(--bg);border-top:1px solid var(--border)}
.proj-meta-name{font-family:var(--font-display);font-size:1.05rem;font-weight:500;color:var(--text)}
.proj-meta-tag{font-size:0.6rem;font-weight:500;letter-spacing:0.15em;text-transform:uppercase;color:var(--text-light)}
.proj-meta-btn{width:30px;height:30px;border:1px solid var(--border);display:flex;align-items:center;justify-content:center;color:var(--text-light);flex-shrink:0;transition:border-color var(--transition),color var(--transition)}
.proj:hover .proj-meta-btn{border-color:var(--gold);color:var(--gold)}

/* ── WHY US ── */
#why{padding:140px 0;background:var(--bg)}
.why-layout{display:grid;grid-template-columns:1fr 1fr;gap:100px;align-items:start}
.why-pull{margin-top:36px;padding:32px 36px;border-left:3px solid var(--gold);background:var(--bg-off)}
.why-pull p{font-family:var(--font-display);font-size:1.5rem;font-weight:400;font-style:italic;color:var(--text);line-height:1.45}
.why-left-body{color:var(--text-mid);font-size:0.95rem;line-height:1.85;margin-top:20px}
.why-items{border-top:1px solid var(--border)}
.why-item{display:flex;gap:18px;padding:28px 0;border-bottom:1px solid var(--border);position:relative;transition:padding-left var(--transition)}
.why-item::before{content:'';position:absolute;left:0;top:0;bottom:0;width:0;background:var(--gold);transition:width var(--transition)}
.why-item:hover{padding-left:16px}
.why-item:hover::before{width:2px}
.why-item:hover .why-ico{background:var(--gold-muted);border-color:var(--border-gold)}
.why-ico{width:42px;height:42px;flex-shrink:0;border:1px solid var(--border);display:flex;align-items:center;justify-content:center;color:var(--gold);margin-top:2px;transition:background var(--transition),border-color var(--transition)}
.why-ico svg{width:18px;height:18px}
.why-item h4{font-family:var(--font-display);font-size:1.2rem;font-weight:500;color:var(--text);margin-bottom:6px}
.why-item p{font-size:0.82rem;color:var(--text-light);line-height:1.7}

/* ── CONTACT ── */
#contact{display:grid;grid-template-columns:1fr 1.2fr;min-height:640px}
.contact-dark{background:var(--bg-dark);padding:100px 64px;display:flex;flex-direction:column;justify-content:space-between;position:relative;overflow:hidden}
.contact-dark::before{content:'';position:absolute;bottom:-180px;right:-180px;width:480px;height:480px;border-radius:50%;border:1px solid rgba(184,137,42,0.08)}
.contact-dark::after{content:'';position:absolute;bottom:-100px;right:-100px;width:280px;height:280px;border-radius:50%;border:1px solid rgba(184,137,42,0.06)}
.contact-dark-title{font-family:var(--font-display);font-size:clamp(2.2rem,3.5vw,3.4rem);font-weight:400;line-height:1.1;color:#fff;margin-bottom:16px}
.contact-dark-title em{font-style:italic;color:var(--gold)}
.contact-dark-sub{color:rgba(255,255,255,0.4);font-size:0.9rem;line-height:1.8;margin-bottom:52px}
.contact-info-list{display:flex;flex-direction:column;gap:24px}
.contact-info-row{display:flex;gap:16px;align-items:flex-start}
.contact-info-ico{width:40px;height:40px;flex-shrink:0;border:1px solid rgba(184,137,42,0.25);display:flex;align-items:center;justify-content:center;color:var(--gold)}
.contact-info-ico svg{width:16px;height:16px}
.contact-info-lbl{font-size:0.6rem;font-weight:500;letter-spacing:0.18em;text-transform:uppercase;color:rgba(255,255,255,0.3);margin-bottom:3px}
.contact-info-val{font-size:0.9rem;color:rgba(255,255,255,0.65);line-height:1.5}
.contact-light{padding:100px 64px;background:var(--bg-off);display:flex;flex-direction:column;justify-content:center}
.cform-title{font-family:var(--font-display);font-size:1.5rem;font-weight:500;font-style:italic;color:var(--text);margin-bottom:36px}
.cform{display:flex;flex-direction:column;gap:18px}
.frow{display:grid;grid-template-columns:1fr 1fr;gap:14px}
.fg{display:flex;flex-direction:column;gap:7px}
.fg label{font-size:0.62rem;font-weight:500;letter-spacing:0.18em;text-transform:uppercase;color:var(--text-mid)}
.fg input,.fg select,.fg textarea{background:#fff;border:1px solid var(--border);color:var(--text);font-family:var(--font-body);font-size:0.9rem;font-weight:300;padding:13px 16px;outline:none;transition:border-color var(--transition);width:100%;-webkit-appearance:none}
.fg input:focus,.fg select:focus,.fg textarea:focus{border-color:var(--gold)}
.fg textarea{resize:vertical;min-height:120px}
.fg select option{background:#fff}
.form-success{padding:13px 16px;background:var(--gold-muted);border:1px solid var(--border-gold);color:var(--gold);font-size:0.83rem}

/* ── FOOTER ── */
footer{background:var(--bg-dark);padding:72px 0 36px}
.footer-top{display:grid;grid-template-columns:1.5fr 1fr 1fr 1fr;gap:48px;padding-bottom:56px;border-bottom:1px solid rgba(255,255,255,0.06);margin-bottom:32px}
.fbrand-name{font-family:var(--font-display);font-size:1.8rem;font-weight:600;letter-spacing:0.04em;color:#fff;margin-bottom:4px}
.fbrand-name span{color:var(--gold)}
.fbrand-sub{font-size:0.56rem;letter-spacing:0.24em;text-transform:uppercase;color:rgba(255,255,255,0.25);margin-bottom:18px}
.fbrand p{font-size:0.82rem;color:rgba(255,255,255,0.35);line-height:1.8;max-width:250px;margin-bottom:22px}
.fsocials{display:flex;gap:10px}
.fsocial{width:34px;height:34px;border:1px solid rgba(255,255,255,0.1);display:flex;align-items:center;justify-content:center;color:rgba(255,255,255,0.3);transition:border-color var(--transition),color var(--transition)}
.fsocial:hover{border-color:var(--gold);color:var(--gold)}
.fsocial svg{width:14px;height:14px}
.fcol h5{font-size:0.6rem;font-weight:600;letter-spacing:0.2em;text-transform:uppercase;color:#fff;margin-bottom:18px}
.fcol ul{display:flex;flex-direction:column;gap:10px}
.fcol ul a{font-size:0.82rem;color:rgba(255,255,255,0.35);transition:color var(--transition)}
.fcol ul a:hover{color:var(--gold)}
.footer-bottom{display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px}
.footer-bottom p{font-size:0.7rem;color:rgba(255,255,255,0.2)}
.footer-bottom span{color:var(--gold)}

/* ── RESPONSIVE ── */
@media(max-width:1024px){
    .container{padding:0 32px}
    #hero{grid-template-columns:1fr}
    .hero-right{display:none}
    .hero-left{padding:140px 40px 80px}
    #about{grid-template-columns:1fr}
    .about-text-side{padding:72px 40px}
    .stats-grid{grid-template-columns:repeat(2,1fr)}
    .stat-cell:nth-child(2){border-right:none}
    .stat-cell:nth-child(3),.stat-cell:nth-child(4){border-top:1px solid rgba(255,255,255,0.06)}
    .services-layout{grid-template-columns:1fr;gap:32px}
    .services-sticky{position:static}
    .proj:nth-child(1){grid-column:1/13}
    .proj:nth-child(2){grid-column:1/7;grid-row:2}
    .proj:nth-child(3){grid-column:7/13;grid-row:2}
    .proj:nth-child(4){grid-column:1/7;grid-row:3}
    .proj:nth-child(5){grid-column:7/13;grid-row:3}
    .proj:nth-child(n+6){grid-column:span 6}
    .why-layout{grid-template-columns:1fr;gap:48px}
    #contact{grid-template-columns:1fr}
    .contact-dark{padding:72px 40px}
    .contact-light{padding:72px 40px}
    .footer-top{grid-template-columns:1fr 1fr}
}
@media(max-width:768px){
    .container{padding:0 24px}
    .nav-links{display:none}
    .hamburger{display:flex}
    .hero-left{padding:120px 28px 72px}
    .service-row{grid-template-columns:50px 1fr}
    .svc-icon{display:none}
    .projects-mosaic{grid-template-columns:1fr}
    .proj:nth-child(n){grid-column:1;grid-row:auto}
    .frow{grid-template-columns:1fr}
    .footer-top{grid-template-columns:1fr;gap:28px}
    .footer-bottom{flex-direction:column;text-align:center}
}
@media(max-width:480px){
    .container{padding:0 20px}
    .hero-btns{flex-direction:column;align-items:flex-start}
}
</style>
@endsection

@section('content')

<!-- NAV -->
<nav id="navbar">
    <div class="container">
        <div class="nav-inner">
            <a href="#" class="nav-logo">
                <img src="{{ asset('images/logo.jpeg') }}" alt="De Knest Construction" style="height:52px;width:auto;object-fit:contain;">
            </a>
            <ul class="nav-links">
                <li><a href="#about">About us</a></li>
                <li><a href="#services">Services</a></li>
                <li><a href="#projects">Projects</a></li>
                <li><a href="#why">Why Us</a></li>
                <li><a href="#standards">Standards</a></li>
                <li><a href="#contact" class="nav-quote">Get a Quote</a></li>
            </ul>
            <button class="hamburger" id="hamburger"><span></span><span></span><span></span></button>
        </div>
    </div>
</nav>

<!-- MOBILE NAV -->
<div class="mobile-nav" id="mobileNav">
    <a href="#about" class="mobile-link">About</a>
    <a href="#services" class="mobile-link">Services</a>
    <a href="#projects" class="mobile-link">Projects</a>
    <a href="#why" class="mobile-link">Why Us</a>
    <a href="#standards" class="mobile-link">Standards</a>
    <a href="#contact" class="mobile-link">Get a Quote</a>
</div>

<!-- HERO -->
<section id="hero">
    <div class="hero-left">
        <div class="hero-eyebrow">
            <div class="hero-eyebrow-dot"></div>
            <span class="hero-eyebrow-text">Dzorwulu, Accra — Est. 2022</span>
        </div>
        <h1 class="hero-title">
            Building<br>
            <em>Dreams,</em><br>
            <strong>Crafting</strong><br>
            Legacies.
        </h1>
        <p class="hero-tagline">Dedicated to delivering high-quality, luxurious homes through passion, precision, and excellence.
            We aim to earn lasting trust and secure opportunities to develop estates and communities that stand the test of time.
        </p>
        <div class="hero-btns">
            <a href="#projects" class="btn-gold">
                View Projects
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </a>
            <a href="#contact" class="btn-ghost-light">Get a Quote</a>
        </div>
        <div class="hero-scroll">Scroll</div>
    </div>
    <div class="hero-right">
        <div class="hero-right-img" style="background-image:url('{{ asset('images/project-6.jpeg') }}');background-position:20% center;"></div>
       
    </div>
</section>

<!-- MARQUEE -->
<div class="marquee-wrap">
    <div class="marquee-track">
        <span class="marquee-item">Residential Construction</span>
        <span class="marquee-item">Commercial Projects</span>
        <span class="marquee-item">Real Estate Development</span>
        <span class="marquee-item">Infrastructure Development</span>
        <span class="marquee-item">Design & Build</span>
        <span class="marquee-item">Property Management</span>
        <span class="marquee-item">Residential Construction</span>
        <span class="marquee-item">Commercial Projects</span>
        <span class="marquee-item">Real Estate Development</span>
        <span class="marquee-item">Infrastructure Development</span>
        <span class="marquee-item">Design & Build</span>
        <span class="marquee-item">Property Management</span>
    </div>
</div>

<!-- ABOUT -->
<section id="about">
    <div class="about-img-side reveal" style="background-image:url('{{ asset('images/workers-on-site.jpeg') }}');">
        <div class="about-img-overlay"></div>
        <div class="about-years">
            <span class="num">Est.</span>
            <span class="lbl">Feb<br>2022</span>
        </div>
    </div>
    <div class="about-text-side">
        <span class="tag reveal">About De Knest</span>
        <h2 class="section-title reveal reveal-delay-1">We Build More<br>Than <em>Structures.</em></h2>
        <div class="gold-bar reveal reveal-delay-2"></div>
        <p class="reveal reveal-delay-2">De Knest Construction is a leading construction and engineering firm specializing in delivering high-quality infrastructure, residential, and commercial projects. Established on 15th February 2022, the company has built a reputation for excellence, innovation, and reliability in the construction industry.</p>
        <p class="reveal reveal-delay-3">We are committed to shaping skylines and communities with sustainable and innovative solutions — delivering projects that combine quality, safety, and efficiency beyond client expectations.</p>
        <ul class="about-checklist reveal reveal-delay-3">
            <li class="about-check-item"><span class="about-check-dot"></span>Quality Assured on Every Build</li>
            <li class="about-check-item"><span class="about-check-dot"></span>Licensed & Fully Insured</li>
            <li class="about-check-item"><span class="about-check-dot"></span>On-Time Delivery, Every Time</li>
            <li class="about-check-item"><span class="about-check-dot"></span>Expert Engineers & Craftspeople</li>
        </ul>
        <div class="about-watermark">KNEST</div>
    </div>
</section>

<!-- CORE BUSINESS AREAS -->
<div style="background:var(--bg-off);padding:56px 0;border-top:1px solid var(--border);border-bottom:1px solid var(--border)">
    <div class="container">
        <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:32px">
            <div style="flex-shrink:0">
                <p style="font-size:0.62rem;font-weight:600;letter-spacing:0.22em;text-transform:uppercase;color:var(--gold);margin-bottom:6px">Core Business Areas</p>
                <p style="font-size:0.82rem;color:var(--text-light)">What we specialise in</p>
            </div>
            <div style="display:flex;flex-wrap:wrap;gap:12px;flex:1;justify-content:flex-end">
                <div style="display:flex;align-items:center;gap:10px;padding:12px 20px;border:1px solid var(--border);background:#fff">
                    <span style="width:5px;height:5px;border-radius:50%;background:var(--gold);flex-shrink:0"></span>
                    <span style="font-size:0.78rem;font-weight:500;color:var(--text);letter-spacing:0.04em">Real Estate Development</span>
                </div>
                <div style="display:flex;align-items:center;gap:10px;padding:12px 20px;border:1px solid var(--border);background:#fff">
                    <span style="width:5px;height:5px;border-radius:50%;background:var(--gold);flex-shrink:0"></span>
                    <span style="font-size:0.78rem;font-weight:500;color:var(--text);letter-spacing:0.04em">Construction of Private Roads</span>
                </div>
                <div style="display:flex;align-items:center;gap:10px;padding:12px 20px;border:1px solid var(--border);background:#fff">
                    <span style="width:5px;height:5px;border-radius:50%;background:var(--gold);flex-shrink:0"></span>
                    <span style="font-size:0.78rem;font-weight:500;color:var(--text);letter-spacing:0.04em">Residential Construction</span>
                </div>
                <div style="display:flex;align-items:center;gap:10px;padding:12px 20px;border:1px solid var(--border);background:#fff">
                    <span style="width:5px;height:5px;border-radius:50%;background:var(--gold);flex-shrink:0"></span>
                    <span style="font-size:0.78rem;font-weight:500;color:var(--text);letter-spacing:0.04em">Design & Build Services</span>
                </div>
                <div style="display:flex;align-items:center;gap:10px;padding:12px 20px;border:1px solid var(--border);background:#fff">
                    <span style="width:5px;height:5px;border-radius:50%;background:var(--gold);flex-shrink:0"></span>
                    <span style="font-size:0.78rem;font-weight:500;color:var(--text);letter-spacing:0.04em">Property Management</span>
                </div>
                <div style="display:flex;align-items:center;gap:10px;padding:12px 20px;border:1px solid var(--border);background:#fff">
                    <span style="width:5px;height:5px;border-radius:50%;background:var(--gold);flex-shrink:0"></span>
                    <span style="font-size:0.78rem;font-weight:500;color:var(--text);letter-spacing:0.04em">Procurement & Logistics</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- STATS -->
<section id="stats">
    <div class="stats-grid">
        <div class="stat-cell reveal">
            <span class="stat-num"><span class="counter" data-target="50">0</span><span class="stat-unit">+</span></span>
            <span class="stat-label">Projects Completed</span>
        </div>
        <div class="stat-cell reveal reveal-delay-1">
            <span class="stat-num" style="font-size:3.5rem">2022</span>
            <span class="stat-label">Year Established</span>
        </div>
        <div class="stat-cell reveal reveal-delay-2">
            <span class="stat-num"><span class="counter" data-target="98">0</span><span class="stat-unit">%</span></span>
            <span class="stat-label">Client Satisfaction</span>
        </div>
        <div class="stat-cell reveal reveal-delay-3">
            <span class="stat-num"><span class="counter" data-target="40">0</span><span class="stat-unit">+</span></span>
            <span class="stat-label">Expert Team Members</span>
        </div>
    </div>
</section>

<!-- SERVICES -->
<section id="services">
    <div class="container">
        <div class="services-layout">
            <div class="services-sticky">
                <span class="tag reveal">What We Do</span>
                <h2 class="section-title reveal reveal-delay-1">Our Core<br><em>Services</em></h2>
                <p class="services-body-text reveal reveal-delay-2">From concept to completion — a comprehensive range of construction, design, and property services tailored to your vision.</p>
                <a href="#contact" class="btn-gold reveal reveal-delay-3">
                    Start a Project
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                </a>
            </div>
            <div class="services-list">
                <div class="service-row reveal">
                    <span class="svc-num">01</span>
                    <div class="svc-content">
                        <h3 class="svc-name">Residential Construction</h3>
                        <p class="svc-desc">Housing developments, apartments, and luxury homes crafted with precision — from foundation to finishing.</p>
                    </div>
                    <div class="svc-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></div>
                </div>
                <div class="service-row reveal reveal-delay-1">
                    <span class="svc-num">02</span>
                    <div class="svc-content">
                        <h3 class="svc-name">Commercial Projects</h3>
                        <p class="svc-desc">Office complexes, retail spaces, and industrial facilities built for functionality and long-term integrity.</p>
                    </div>
                    <div class="svc-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></div>
                </div>
                <div class="service-row reveal reveal-delay-2">
                    <span class="svc-num">03</span>
                    <div class="svc-content">
                        <h3 class="svc-name">Real Estate Development</h3>
                        <p class="svc-desc">High-quality luxury estates and communities designed to retain value and endure for generations.</p>
                    </div>
                    <div class="svc-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></div>
                </div>
                <div class="service-row reveal">
                    <span class="svc-num">04</span>
                    <div class="svc-content">
                        <h3 class="svc-name">Infrastructure Development</h3>
                        <p class="svc-desc">Roads, bridges, drainage systems, and public works delivered with precision and strict safety standards.</p>
                    </div>
                    <div class="svc-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></div>
                </div>
                <div class="service-row reveal reveal-delay-1">
                    <span class="svc-num">05</span>
                    <div class="svc-content">
                        <h3 class="svc-name">Rennovation & Remodeling</h3>
                        <p class="svc-desc">Mordenizing existing structures with sustainable solutions.</p>
                    </div>
                    <div class="svc-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></div>
                </div>
                <div class="service-row reveal reveal-delay-2">
                    <span class="svc-num">06</span>
                    <div class="svc-content">
                        <h3 class="svc-name">Property Management</h3>
                        <p class="svc-desc">Professional management of residential and commercial properties with a focus on value preservation and client peace of mind.</p>
                    </div>
                    <div class="svc-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- PROJECTS -->
<section id="projects">
    <div class="container">
        <div class="projects-header">
            <div>
                <span class="tag reveal">Our Portfolio</span>
                <h2 class="projects-heading reveal reveal-delay-1">Featured<br><em>Projects</em></h2>
            </div>
            <a href="{{ route('projects.index') }}" class="btn-ghost-dark reveal">
                View All Projects
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </a>
        </div>

        @if($projects->count())
            <div class="projects-mosaic">
                @foreach($projects as $project)
                    <a href="{{ route('projects.show', $project) }}" class="proj reveal">
                        <div class="proj-img" style="{{ $project->cover_image ? 'background-image:url(' . asset('storage/' . $project->cover_image) . ')' : '' }}"></div>
                        <div class="proj-overlay"></div>
                        <div class="proj-info">
                            <p class="proj-cat">{{ $project->category }} · {{ $project->location }}</p>
                            <h3 class="proj-title-overlay">{{ $project->name }}</h3>
                        </div>
                        <div class="proj-meta">
                            <div>
                                <p class="proj-meta-name">{{ $project->name }}</p>
                                <p class="proj-meta-tag">{{ $project->category }} · {{ $project->location }}</p>
                            </div>
                            <div class="proj-meta-btn">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div style="text-align:center;padding:80px 0">
                <p style="color:var(--text-light);font-size:0.9rem">No projects added yet.</p>
            </div>
        @endif
    </div>
</section>

<!-- WHY US -->
<section id="why">
    <div class="container">
        <div class="why-layout">
            <div class="why-left">
                <span class="tag reveal">Why Choose Us</span>
                <h2 class="section-title reveal reveal-delay-1">The <em>Knest</em><br>Difference</h2>
                <p class="why-left-body reveal reveal-delay-2">At De Knest Construction, we combine expertise, innovation, and integrity to deliver projects that exceed expectations. Our focus on quality, professionalism, and customer satisfaction makes us a trusted partner for all your construction needs.</p>
                <div class="why-pull reveal reveal-delay-3">
                    <p>"To be a trusted leader in developing high-quality luxury homes and estates that retain value and endure for generations."</p>
                </div>
            </div>
            <div class="why-items reveal">
    <div class="why-item">
        <div class="why-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></div>
        <div>
            <h4>Quality Policy</h4>
            <p>Total commitment to getting it right first time, every time — achieving specified requirements through effective planning, preparation, and rigorous supervision on every project.</p>
        </div>
    </div>
    <div class="why-item">
        <div class="why-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/></svg></div>
        <div>
            <h4>Business & Leadership</h4>
            <p>Our highly trained professionals demonstrate outstanding leadership — ensuring strict adherence to standards, rules, and regulations while guaranteeing on-time project delivery at every stage.</p>
        </div>
    </div>
    <div class="why-item">
        <div class="why-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 9v4m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/></svg></div>
        <div>
            <h4>Health & Safety</h4>
            <p>The well-being of every worker is non-negotiable. We enforce strict on-site safety protocols, provide all required protective equipment, and maintain thorough incident reporting at all times.</p>
        </div>
    </div>
    <div class="why-item">
        <div class="why-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg></div>
        <div>
            <h4>Quality Assurance Plan</h4>
            <p>Every project begins with a tailored QAP — setting out quality management requirements, verifying task execution against client standards, and planning systematic audits throughout the build.</p>
        </div>
    </div>
</div>
        </div>
    </div>
</section>

<!-- STANDARDS & SAFETY -->
<section id="standards" style="padding:140px 0;background:var(--bg-dark);position:relative;overflow:hidden">
    <div style="position:absolute;right:-200px;top:-200px;width:600px;height:600px;border-radius:50%;border:1px solid rgba(184,137,42,0.06);pointer-events:none"></div>
    <div style="position:absolute;left:-100px;bottom:-100px;width:400px;height:400px;border-radius:50%;border:1px solid rgba(184,137,42,0.04);pointer-events:none"></div>
    <div class="container" style="position:relative;z-index:1">

        <div style="display:grid;grid-template-columns:1fr 2fr;gap:80px;align-items:start;margin-bottom:80px">
            <div>
                <span class="tag reveal" style="color:var(--gold)">How We Work</span>
                <h2 class="section-title reveal reveal-delay-1" style="color:#fff">Our <em>Standards</em><br>&amp; Practices</h2>
                <div class="gold-bar reveal reveal-delay-2"></div>
                <p class="reveal reveal-delay-2" style="color:rgba(255,255,255,0.4);font-size:0.92rem;line-height:1.85">Every De Knest project is governed by strict quality, safety, and environmental standards — ensuring every build is delivered with integrity from the first day to the last.</p>
            </div>

            <!-- QAP PURPOSE -->
            <div class="reveal reveal-delay-1">
                <p style="font-size:0.65rem;font-weight:600;letter-spacing:0.2em;text-transform:uppercase;color:var(--gold);margin-bottom:16px">Quality Assurance Plan — Purpose</p>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px">
                    <div style="padding:18px 20px;border:1px solid rgba(255,255,255,0.07);background:rgba(255,255,255,0.02)">
                        <p style="font-size:0.82rem;color:rgba(255,255,255,0.5);line-height:1.7">Set out quality management requirements for every project we undertake.</p>
                    </div>
                    <div style="padding:18px 20px;border:1px solid rgba(255,255,255,0.07);background:rgba(255,255,255,0.02)">
                        <p style="font-size:0.82rem;color:rgba(255,255,255,0.5);line-height:1.7">Provide services that meet all contractual obligations to the client.</p>
                    </div>
                    <div style="padding:18px 20px;border:1px solid rgba(255,255,255,0.07);background:rgba(255,255,255,0.02)">
                        <p style="font-size:0.82rem;color:rgba(255,255,255,0.5);line-height:1.7">Verify that all tasks are performed in accordance with specified requirements.</p>
                    </div>
                    <div style="padding:18px 20px;border:1px solid rgba(255,255,255,0.07);background:rgba(255,255,255,0.02)">
                        <p style="font-size:0.82rem;color:rgba(255,255,255,0.5);line-height:1.7">Plan and detail systematic auditing activities throughout the project lifecycle.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- PROJECT TEAM -->
        <div style="margin-bottom:80px" class="reveal">
            <p style="font-size:0.65rem;font-weight:600;letter-spacing:0.2em;text-transform:uppercase;color:var(--gold);margin-bottom:24px">Project Team Personnel</p>
            <div style="display:grid;grid-template-columns:repeat(6,1fr);gap:12px">
                @foreach([
                    ['Project Manager', 'M'],
                    ['Project Engineer', 'E'],
                    ['Quantity Surveyor', 'Q'],
                    ['Quality Control Engineer', 'QC'],
                    ['Safety & Environmental Officer', 'S'],
                    ['Discipline Supervisors', 'DS'],
                ] as $member)
                <div style="padding:24px 16px;border:1px solid rgba(255,255,255,0.07);background:rgba(255,255,255,0.02);text-align:center">
                    <div style="width:44px;height:44px;border-radius:50%;background:rgba(184,137,42,0.15);border:1px solid rgba(184,137,42,0.3);display:flex;align-items:center;justify-content:center;margin:0 auto 12px;font-family:var(--font-display);font-size:0.85rem;font-weight:600;color:var(--gold)">{{ $member[1] }}</div>
                    <p style="font-size:0.72rem;color:rgba(255,255,255,0.5);line-height:1.5;text-align:center">{{ $member[0] }}</p>
                </div>
                @endforeach
            </div>
        </div>

        <!-- HEALTH SAFETY & SITE STANDARDS GRID -->
        <div>
            <p style="font-size:0.65rem;font-weight:600;letter-spacing:0.2em;text-transform:uppercase;color:var(--gold);margin-bottom:24px">Health, Safety &amp; Site Standards</p>
            <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:16px">

                <div class="reveal" style="padding:28px;border:1px solid rgba(255,255,255,0.07);background:rgba(255,255,255,0.02)">
                    <div style="width:36px;height:36px;border:1px solid rgba(184,137,42,0.3);display:flex;align-items:center;justify-content:center;color:var(--gold);margin-bottom:16px">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 9v4m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/></svg>
                    </div>
                    <h4 style="font-family:var(--font-display);font-size:1.1rem;font-weight:500;color:#fff;margin-bottom:8px">First Aid & Welfare</h4>
                    <p style="font-size:0.82rem;color:rgba(255,255,255,0.4);line-height:1.7">First aid is readily available on site. Adequate sanitation and washing facilities are provided for the comfort and wellbeing of all site personnel.</p>
                </div>

                <div class="reveal reveal-delay-1" style="padding:28px;border:1px solid rgba(255,255,255,0.07);background:rgba(255,255,255,0.02)">
                    <div style="width:36px;height:36px;border:1px solid rgba(184,137,42,0.3);display:flex;align-items:center;justify-content:center;color:var(--gold);margin-bottom:16px">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M17.5 19H9a7 7 0 1 1 6.71-9h1.79a4.5 4.5 0 1 1 0 9Z"/></svg>
                    </div>
                    <h4 style="font-family:var(--font-display);font-size:1.1rem;font-weight:500;color:#fff;margin-bottom:8px">Fire Procedure</h4>
                    <p style="font-size:0.82rem;color:rgba(255,255,255,0.4);line-height:1.7">All on-site personnel are familiarised with the site evacuation procedure — including alarm methods, escape routes, and designated assembly points.</p>
                </div>

                <div class="reveal reveal-delay-2" style="padding:28px;border:1px solid rgba(255,255,255,0.07);background:rgba(255,255,255,0.02)">
                    <div style="width:36px;height:36px;border:1px solid rgba(184,137,42,0.3);display:flex;align-items:center;justify-content:center;color:var(--gold);margin-bottom:16px">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    </div>
                    <h4 style="font-family:var(--font-display);font-size:1.1rem;font-weight:500;color:#fff;margin-bottom:8px">Safety Equipment</h4>
                    <p style="font-size:0.82rem;color:rgba(255,255,255,0.4);line-height:1.7">All personal protective equipment is assigned, maintained in clean usable condition, and worn whenever required on site — no exceptions.</p>
                </div>

                <div class="reveal" style="padding:28px;border:1px solid rgba(255,255,255,0.07);background:rgba(255,255,255,0.02)">
                    <div style="width:36px;height:36px;border:1px solid rgba(184,137,42,0.3);display:flex;align-items:center;justify-content:center;color:var(--gold);margin-bottom:16px">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 7V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v2"/></svg>
                    </div>
                    <h4 style="font-family:var(--font-display);font-size:1.1rem;font-weight:500;color:#fff;margin-bottom:8px">Plant & Machinery</h4>
                    <p style="font-size:0.82rem;color:rgba(255,255,255,0.4);line-height:1.7">Only trained and competent personnel operate plant and equipment. All machinery is maintained in safe condition and used strictly for its intended purpose.</p>
                </div>

                <div class="reveal reveal-delay-1" style="padding:28px;border:1px solid rgba(255,255,255,0.07);background:rgba(255,255,255,0.02)">
                    <div style="width:36px;height:36px;border:1px solid rgba(184,137,42,0.3);display:flex;align-items:center;justify-content:center;color:var(--gold);margin-bottom:16px">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M13 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V9z"/><polyline points="13 2 13 9 20 9"/></svg>
                    </div>
                    <h4 style="font-family:var(--font-display);font-size:1.1rem;font-weight:500;color:#fff;margin-bottom:8px">Electrical Equipment</h4>
                    <p style="font-size:0.82rem;color:rgba(255,255,255,0.4);line-height:1.7">All electrical equipment is regularly tested, visually inspected before use, and repaired only by competent personnel with proper isolation and lockout procedures.</p>
                </div>

                <div class="reveal reveal-delay-2" style="padding:28px;border:1px solid rgba(255,255,255,0.07);background:rgba(255,255,255,0.02)">
                    <div style="width:36px;height:36px;border:1px solid rgba(184,137,42,0.3);display:flex;align-items:center;justify-content:center;color:var(--gold);margin-bottom:16px">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
                    </div>
                    <h4 style="font-family:var(--font-display);font-size:1.1rem;font-weight:500;color:#fff;margin-bottom:8px">Working at Height</h4>
                    <p style="font-size:0.82rem;color:rgba(255,255,255,0.4);line-height:1.7">Safe working platforms with proper access are provided for all height work. Safety harnesses are mandatory where scaffolding is impractical, with full protection for workers below.</p>
                </div>

                <div class="reveal" style="padding:28px;border:1px solid rgba(255,255,255,0.07);background:rgba(255,255,255,0.02)">
                    <div style="width:36px;height:36px;border:1px solid rgba(184,137,42,0.3);display:flex;align-items:center;justify-content:center;color:var(--gold);margin-bottom:16px">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a1 1 0 011-1h4a1 1 0 011 1v2"/></svg>
                    </div>
                    <h4 style="font-family:var(--font-display);font-size:1.1rem;font-weight:500;color:#fff;margin-bottom:8px">Waste & Environment</h4>
                    <p style="font-size:0.82rem;color:rgba(255,255,255,0.4);line-height:1.7">No burning on site. All waste is stockpiled at designated areas and legally disposed of. Recyclable materials are segregated and transported to approved recycling facilities.</p>
                </div>

                <div class="reveal reveal-delay-1" style="padding:28px;border:1px solid rgba(255,255,255,0.07);background:rgba(255,255,255,0.02)">
                    <div style="width:36px;height:36px;border:1px solid rgba(184,137,42,0.3);display:flex;align-items:center;justify-content:center;color:var(--gold);margin-bottom:16px">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 2a10 10 0 0 1 10 10c0 5.52-4.48 10-10 10S2 17.52 2 12a10 10 0 0 1 10-10z"/><path d="M12 6v6l4 2"/></svg>
                    </div>
                    <h4 style="font-family:var(--font-display);font-size:1.1rem;font-weight:500;color:#fff;margin-bottom:8px">Noise, Vibration & Odours</h4>
                    <p style="font-size:0.82rem;color:rgba(255,255,255,0.4);line-height:1.7">Any operations causing high levels of noise, vibration, or odour are communicated to all relevant parties before commencement to minimise disruption.</p>
                </div>

                <div class="reveal reveal-delay-2" style="padding:28px;border:1px solid rgba(255,255,255,0.07);background:rgba(255,255,255,0.02)">
                    <div style="width:36px;height:36px;border:1px solid rgba(184,137,42,0.3);display:flex;align-items:center;justify-content:center;color:var(--gold);margin-bottom:16px">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                    </div>
                    <h4 style="font-family:var(--font-display);font-size:1.1rem;font-weight:500;color:#fff;margin-bottom:8px">Housekeeping</h4>
                    <p style="font-size:0.82rem;color:rgba(255,255,255,0.4);line-height:1.7">A high standard of housekeeping is maintained throughout every site. Waste goes in designated containers, spillages are dealt with immediately, and contractors manage their own waste removal.</p>
                </div>

            </div>
        </div>

    </div>
</section>

<!-- CONTACT -->
<section id="contact">
    <div class="contact-dark">
        <div>
            <span class="tag reveal" style="color:rgba(184,137,42,0.7)">Get In Touch</span>
            <h2 class="contact-dark-title reveal reveal-delay-1">
                Let's Build<br>Something <em>Great.</em>
            </h2>
            <p class="contact-dark-sub reveal reveal-delay-2">Whether it's a new home, a commercial build, or a renovation — our team is ready to bring your vision to life with passion, precision, and excellence.</p>
        </div>
        <div class="contact-info-list reveal reveal-delay-2">
            <div class="contact-info-row">
                <div class="contact-info-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg></div>
                <div>
                    <p class="contact-info-lbl">Location</p>
                    <p class="contact-info-val">Sir Emmanuel Quist Street, Nako House<br>Dzorwulu, Accra</p>
                </div>
            </div>
            <div class="contact-info-row">
                <div class="contact-info-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.5a2 2 0 012-2.18h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L9.09 14a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/></svg></div>
                <div>
                    <p class="contact-info-lbl">Phone</p>
                    <p class="contact-info-val">0545852345 / 0547018313</p>
                </div>
            </div>
            <div class="contact-info-row">
                <div class="contact-info-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg></div>
                <div>
                    <p class="contact-info-lbl">Email</p>
                    <p class="contact-info-val">info@deknestconstruction.com</p>
                </div>
            </div>
            <div class="contact-info-row">
                <div class="contact-info-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="2" y="2" width="20" height="20" rx="5"/><path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg></div>
                <div>
                    <p class="contact-info-lbl">Instagram</p>
                    <p class="contact-info-val">@de_knestconstruction</p>
                </div>
            </div>
        </div>
    </div>
    <div class="contact-light reveal reveal-delay-1">
        <h3 class="cform-title">Send an Enquiry</h3>
        <form action="{{ route('contact.send') }}" method="POST" class="cform">
            @csrf
            @if(session('success'))
                <div class="form-success">{{ session('success') }}</div>
            @endif
            <div class="frow">
                <div class="fg"><label>Full Name</label><input type="text" name="name" placeholder="John Doe" value="{{ old('name') }}" required></div>
                <div class="fg"><label>Phone</label><input type="tel" name="phone" placeholder="0545852345" value="{{ old('phone') }}"></div>
            </div>
            <div class="fg"><label>Email Address</label><input type="email" name="email" placeholder="john@example.com" value="{{ old('email') }}" required></div>
            <div class="fg">
                <label>Service Interested In</label>
                <select name="service">
                    <option value="" disabled selected>Select a service...</option>
                    <option value="Residential Construction">Residential Construction</option>
                    <option value="Commercial Projects">Commercial Projects</option>
                    <option value="Real Estate Development">Real Estate Development</option>
                    <option value="Infrastructure Development">Infrastructure Development</option>
                    <option value="Renovation & Remodeling">Renovation & Remodeling</option>
                    <option value="Property Management">Property Management</option>
                    <option value="Procurement & Logistics">Procurement & Logistics</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="fg"><label>Tell Us About Your Project</label><textarea name="message" placeholder="Describe your project, location, timeline...">{{ old('message') }}</textarea></div>
            <div>
                <button type="submit" class="btn-gold">
                    Send Enquiry
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                </button>
            </div>
        </form>
    </div>
</section>

<!-- FOOTER -->
<footer>
    <div class="container">
        <div class="footer-top">
            <div class="fbrand">
                <div class="fbrand-name">De <span>Knest</span></div>
                <div class="fbrand-sub">Construction Ltd</div>
                <p>Dedicated to delivering high-quality, luxurious homes through passion, precision, and excellence — since February 2022.</p>
                <div class="fsocials">
                    <a href="https://www.instagram.com/de_knestconstruction" target="_blank" class="fsocial"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="2" y="2" width="20" height="20" rx="5"/><path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg></a>
                    <a href="#" class="fsocial"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/></svg></a>
                    <a href="#" class="fsocial"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"/></svg></a>
                </div>
            </div>
            <div class="fcol">
                <h5>Quick Links</h5>
                <ul>
                    <li><a href="#about">About Us</a></li>
                    <li><a href="#services">Services</a></li>
                    <li><a href="#projects">Projects</a></li>
                    <li><a href="#why">Why Choose Us</a></li>
                    <li><a href="#standards">Standards</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </div>
            <div class="fcol">
                <h5>Services</h5>
                <ul>
                    <li><a href="#services">Residential Construction</a></li>
                    <li><a href="#services">Commercial Projects</a></li>
                    <li><a href="#services">Real Estate Development</a></li>
                    <li><a href="#services">Infrastructure Development</a></li>
                    <li><a href="#services">Renovation & Remodeling</a></li>
                    <li><a href="#services">Property Management</a></li>
                </ul>
            </div>
            <div class="fcol">
                <h5>Contact</h5>
                <ul>
                    <li><a href="#">Sir Emmanuel Quist Street</a></li>
                    <li><a href="#">Nako House, Dzorwulu, Accra</a></li>
                    <li><a href="tel:0545852345">0545852345</a></li>
                    <li><a href="tel:0547018313">0547018313</a></li>
                    <li><a href="mailto:info@deknestconstruction.com">info@deknestconstruction.com</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} De Knest Construction Ltd. All rights reserved.</p>
            <div style="display:flex;align-items:center;gap:20px;">
                <p>Real Estate • Construction • Design & Build • <span>Property Management</span></p>
                @auth
                    @if(auth()->user()->is_admin)
                        <a href="{{ route('admin.projects.index') }}" style="font-size:0.7rem;color:rgba(255,255,255,0.2);letter-spacing:0.14em;text-transform:uppercase;transition:color 0.2s;" onmouseover="this.style.color='var(--gold)'" onmouseout="this.style.color='rgba(255,255,255,0.2)'">Dashboard</a>
                        <form action="{{ route('admin.logout') }}" method="POST" style="display:inline">
                            @csrf
                            <button type="submit" style="background:none;border:none;font-size:0.7rem;color:rgba(255,255,255,0.2);letter-spacing:0.14em;text-transform:uppercase;cursor:pointer;font-family:var(--font-body);transition:color 0.2s;" onmouseover="this.style.color='var(--gold)'" onmouseout="this.style.color='rgba(255,255,255,0.2)'">Logout</button>
                        </form>
                    @endif
                @else
                    <a href="{{ route('admin.login') }}" style="font-size:0.7rem;color:rgba(255,255,255,0.15);letter-spacing:0.14em;text-transform:uppercase;transition:color 0.2s;" onmouseover="this.style.color='rgba(255,255,255,0.4)'" onmouseout="this.style.color='rgba(255,255,255,0.15)'">Admin</a>
                @endauth
            </div>
        </div>
    </div>
</footer>

@endsection

@section('scripts')
<script>
const navbar = document.getElementById('navbar');
window.addEventListener('scroll', () => {
    navbar.classList.toggle('scrolled', window.scrollY > 60);
});

const hamburger = document.getElementById('hamburger');
const mobileNav = document.getElementById('mobileNav');
hamburger.addEventListener('click', () => {
    hamburger.classList.toggle('open');
    mobileNav.classList.toggle('open');
    document.body.style.overflow = mobileNav.classList.contains('open') ? 'hidden' : '';
});
document.querySelectorAll('.mobile-link').forEach(link => {
    link.addEventListener('click', () => {
        hamburger.classList.remove('open');
        mobileNav.classList.remove('open');
        document.body.style.overflow = '';
    });
});

const revealObserver = new IntersectionObserver((entries) => {
    entries.forEach(e => {
        if (e.isIntersecting) {
            e.target.classList.add('visible');
            revealObserver.unobserve(e.target);
        }
    });
}, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });
document.querySelectorAll('.reveal').forEach(el => revealObserver.observe(el));

function animateCounter(el, target, duration = 1800) {
    let start = 0;
    const step = (ts) => {
        if (!start) start = ts;
        const p = Math.min((ts - start) / duration, 1);
        const eased = 1 - Math.pow(1 - p, 3);
        el.textContent = Math.floor(eased * target);
        if (p < 1) requestAnimationFrame(step);
        else el.textContent = target;
    };
    requestAnimationFrame(step);
}
const counterObserver = new IntersectionObserver((entries) => {
    entries.forEach(e => {
        if (e.isIntersecting) {
            e.target.querySelectorAll('.counter').forEach(c => animateCounter(c, parseInt(c.dataset.target)));
            counterObserver.unobserve(e.target);
        }
    });
}, { threshold: 0.3 });
const statsEl = document.getElementById('stats');
if (statsEl) counterObserver.observe(statsEl);

const sections = document.querySelectorAll('section[id]');
const navAs = document.querySelectorAll('{.nav-links} a[href^="#"]');
window.addEventListener('scroll', () => {
    let cur = '';
    sections.forEach(s => { if (window.scrollY >= s.offsetTop - 120) cur = s.id; });
    navAs.forEach(a => {
        a.style.color = a.getAttribute('href') === `#${cur}` ? 'var(--text)' : '';
    });
});
</script>
@endsection