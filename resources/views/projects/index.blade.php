@extends('layouts.app')

@section('title', 'Our Projects — De Knest Construction')

@section('styles')
<style>
:root{
    --bg:#FAFAF8;
    --bg-off:#F2EFE9;
    --bg-dark:#111008;
    --gold:#B8892A;
    --gold-light:#D4A84C;
    --gold-muted:rgba(184,137,42,0.10);
    --text:#1A1714;
    --text-mid:#6B6560;
    --text-light:#A8A49F;
    --border:rgba(0,0,0,0.07);
    --border-gold:rgba(184,137,42,0.25);
    --font-display:'Cormorant Garamond',serif;
    --font-body:'DM Sans',sans-serif;
    --transition:0.35s cubic-bezier(0.4,0,0.2,1);
}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
html{scroll-behavior:smooth}
body{background:var(--bg);color:var(--text);font-family:var(--font-body);font-weight:300;line-height:1.7;-webkit-font-smoothing:antialiased}
a{text-decoration:none;color:inherit}
img{display:block;max-width:100%}

.container{width:100%;max-width:1240px;margin:0 auto;padding:0 48px}

#navbar{position:fixed;top:0;left:0;right:0;z-index:1000;padding:22px 0;transition:background 0.4s ease,box-shadow 0.4s ease}
#navbar.scrolled{background:rgba(250,250,248,0.95);backdrop-filter:blur(20px);box-shadow:0 1px 0 var(--border)}
.nav-inner{display:flex;align-items:center;justify-content:space-between}
.nav-logo img{height:48px;width:auto;object-fit:contain}
.nav-links{display:flex;align-items:center;gap:36px}
.nav-links a{font-size:0.72rem;font-weight:500;letter-spacing:0.13em;text-transform:uppercase;color:var(--text-mid);transition:color var(--transition);position:relative}
.nav-links a::after{content:'';position:absolute;bottom:-3px;left:0;right:0;height:1px;background:var(--gold);transform:scaleX(0);transition:transform var(--transition);transform-origin:right}
.nav-links a:hover{color:var(--text)}
.nav-links a:hover::after{transform:scaleX(1);transform-origin:left}
.nav-cta-btn{padding:11px 26px;background:var(--bg-dark);color:#fff;font-size:0.7rem;font-weight:600;letter-spacing:0.14em;text-transform:uppercase;transition:background 0.25s}
.nav-cta-btn:hover{background:#222}

.hamburger{display:none;flex-direction:column;gap:5px;cursor:pointer;background:none;border:none;padding:4px}
.hamburger span{display:block;width:24px;height:1.5px;background:var(--text);transition:var(--transition)}
.hamburger.open span:nth-child(1){transform:translateY(6.5px) rotate(45deg)}
.hamburger.open span:nth-child(2){opacity:0}
.hamburger.open span:nth-child(3){transform:translateY(-6.5px) rotate(-45deg)}
.mobile-nav{display:none;position:fixed;inset:0;background:var(--bg-dark);z-index:999;flex-direction:column;justify-content:center;align-items:center;gap:32px;opacity:0;pointer-events:none;transition:opacity 0.3s ease}
.mobile-nav.open{opacity:1;pointer-events:all;display:flex}
.mobile-nav a{font-family:var(--font-display);font-size:2.8rem;font-weight:400;color:#fff;letter-spacing:0.04em;transition:color 0.2s}
.mobile-nav a:hover{color:var(--gold)}

.page-header{padding:160px 0 80px;background:var(--bg-dark);position:relative;overflow:hidden}
.page-header::before{content:'';position:absolute;right:-200px;top:-200px;width:600px;height:600px;border-radius:50%;border:1px solid rgba(184,137,42,0.08)}
.page-header-inner{position:relative;z-index:1}
.page-tag{display:inline-flex;align-items:center;gap:10px;font-size:0.65rem;font-weight:500;letter-spacing:0.22em;text-transform:uppercase;color:var(--gold);margin-bottom:20px}
.page-tag::before{content:'';width:24px;height:1px;background:var(--gold)}
.page-title{font-family:var(--font-display);font-size:clamp(3rem,6vw,6rem);font-weight:300;line-height:1.0;letter-spacing:-0.02em;color:#fff;margin-bottom:20px}
.page-title em{font-style:italic;color:var(--gold)}
.page-title strong{font-weight:600}
.page-subtitle{font-size:0.95rem;color:rgba(255,255,255,0.45);max-width:480px;line-height:1.8;font-style:italic}

.filter-bar{background:var(--bg-off);border-bottom:1px solid var(--border);padding:0;position:sticky;top:72px;z-index:100}
.filter-inner{display:flex;align-items:center;overflow-x:auto;scrollbar-width:none}
.filter-inner::-webkit-scrollbar{display:none}
.filter-btn{padding:18px 24px;font-family:var(--font-body);font-size:0.68rem;font-weight:600;letter-spacing:0.16em;text-transform:uppercase;color:var(--text-light);background:none;border:none;border-bottom:2px solid transparent;cursor:pointer;white-space:nowrap;transition:color var(--transition),border-color var(--transition);margin-bottom:-1px}
.filter-btn:hover{color:var(--text-mid)}
.filter-btn.active{color:var(--gold);border-bottom-color:var(--gold)}
.filter-count{display:inline-flex;align-items:center;justify-content:center;width:18px;height:18px;border-radius:50%;background:var(--gold-muted);font-size:0.55rem;color:var(--gold);margin-left:6px;font-weight:700}

.projects-section{padding:72px 0 120px}
.projects-count{font-size:0.78rem;color:var(--text-light);margin-bottom:40px;letter-spacing:0.06em}
.projects-count span{color:var(--gold);font-weight:600}

.projects-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:16px}

.proj-card{position:relative;overflow:hidden;background:var(--bg-off);border:1px solid var(--border);cursor:pointer;transition:box-shadow var(--transition),transform var(--transition)}
.proj-card:hover{box-shadow:0 12px 40px rgba(0,0,0,0.1);transform:translateY(-2px)}
.proj-card.hidden{display:none}

.proj-card-img{
    width:100%;aspect-ratio:4/3;
    background-size:cover;background-position:center;
    background-color:var(--bg-off);
    transition:transform 0.65s ease;
    position:relative;
}
.proj-card:hover .proj-card-img{transform:scale(1.04)}
.proj-card-overlay{position:absolute;inset:0;background:linear-gradient(to top,rgba(17,16,8,0.88) 0%,rgba(17,16,8,0.1) 55%,transparent 100%);opacity:0;transition:opacity 0.4s ease}
.proj-card:hover .proj-card-overlay{opacity:1}
.proj-card-hover-info{position:absolute;bottom:0;left:0;right:0;padding:20px;transform:translateY(8px);opacity:0;transition:transform 0.4s ease,opacity 0.4s ease;z-index:2}
.proj-card:hover .proj-card-hover-info{transform:translateY(0);opacity:1}
.proj-card-hover-cat{font-size:0.6rem;font-weight:500;letter-spacing:0.2em;text-transform:uppercase;color:var(--gold);margin-bottom:4px}
.proj-card-hover-name{font-family:var(--font-display);font-size:1.2rem;font-weight:500;color:#fff;line-height:1.2}

.proj-card-body{padding:18px 20px;border-top:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;background:var(--bg)}
.proj-card-name{font-family:var(--font-display);font-size:1.1rem;font-weight:500;color:var(--text);margin-bottom:2px}
.proj-card-sub{font-size:0.68rem;font-weight:500;letter-spacing:0.1em;text-transform:uppercase;color:var(--text-light)}
.proj-card-arrow{width:32px;height:32px;flex-shrink:0;border:1px solid var(--border);display:flex;align-items:center;justify-content:center;color:var(--text-light);transition:border-color var(--transition),color var(--transition),background var(--transition)}
.proj-card:hover .proj-card-arrow{border-color:var(--gold);color:var(--gold);background:var(--gold-muted)}
.proj-card-arrow svg{width:14px;height:14px}

.empty-state{grid-column:1/4;padding:80px 40px;text-align:center}
.empty-state p{color:var(--text-light);font-size:0.9rem}

.cta-banner{background:var(--bg-dark);padding:80px 0;margin-top:80px;position:relative;overflow:hidden}
.cta-banner::before{content:'';position:absolute;right:-200px;bottom:-200px;width:500px;height:500px;border-radius:50%;border:1px solid rgba(184,137,42,0.08)}
.cta-inner{display:flex;align-items:center;justify-content:space-between;gap:40px;flex-wrap:wrap;position:relative;z-index:1}
.cta-text h2{font-family:var(--font-display);font-size:clamp(1.8rem,3vw,2.8rem);font-weight:400;color:#fff;line-height:1.15;margin-bottom:10px}
.cta-text h2 em{font-style:italic;color:var(--gold)}
.cta-text p{font-size:0.9rem;color:rgba(255,255,255,0.4);max-width:400px;line-height:1.8}
.btn-cta-gold{display:inline-flex;align-items:center;gap:10px;padding:16px 40px;background:var(--gold);color:#fff;font-family:var(--font-body);font-size:0.75rem;font-weight:600;letter-spacing:0.14em;text-transform:uppercase;white-space:nowrap;transition:opacity 0.25s,transform 0.25s}
.btn-cta-gold:hover{opacity:0.88;transform:translateY(-2px)}
.btn-cta-gold svg{width:14px;height:14px}

footer{background:var(--bg-dark);padding:40px 0;border-top:1px solid rgba(255,255,255,0.06)}
.footer-mini{display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:16px}
.footer-mini-logo{font-family:var(--font-display);font-size:1.4rem;font-weight:600;color:#fff;letter-spacing:0.04em}
.footer-mini-logo span{color:var(--gold)}
.footer-mini p{font-size:0.72rem;color:rgba(255,255,255,0.25)}

@media(max-width:1024px){
    .container{padding:0 32px}
    .projects-grid{grid-template-columns:repeat(2,1fr)}
    .empty-state{grid-column:1/3}
}
@media(max-width:768px){
    .container{padding:0 24px}
    .nav-links{display:none}
    .hamburger{display:flex}
    .projects-grid{grid-template-columns:1fr}
    .empty-state{grid-column:1}
    .cta-inner{flex-direction:column;align-items:flex-start}
    .footer-mini{flex-direction:column}
}
</style>
@endsection

@section('content')

<nav id="navbar">
    <div class="container">
        <div class="nav-inner">
            <a href="{{ route('home') }}" class="nav-logo">
                <img src="{{ asset('images/logo.jpeg') }}" alt="De Knest Construction">
            </a>
            <ul class="nav-links">
                <li><a href="{{ route('home') }}#about">About</a></li>
                <li><a href="{{ route('projects.index') }}" style="color:var(--gold)">Projects</a></li>
                <li><a href="{{ route('home') }}#services">Services</a></li>
                <li><a href="{{ route('home') }}#why">Why Us</a></li>
                <li><a href="{{ route('home') }}#contact" class="nav-cta-btn">Get a Quote</a></li>
            </ul>
            <button class="hamburger" id="hamburger"><span></span><span></span><span></span></button>
        </div>
    </div>
</nav>

<div class="mobile-nav" id="mobileNav">
    <a href="{{ route('home') }}#about" class="mobile-link">About</a>
    <a href="{{ route('projects.index') }}" class="mobile-link">Projects</a>
    <a href="{{ route('home') }}#services" class="mobile-link">Services</a>
    <a href="{{ route('home') }}#why" class="mobile-link">Why Us</a>
    <a href="{{ route('home') }}#contact" class="mobile-link">Get a Quote</a>
</div>

<div class="page-header">
    <div class="container">
        <div class="page-header-inner">
            <p class="page-tag">De Knest Construction</p>
            <h1 class="page-title">Our <em>Work</em><br><strong>Speaks</strong> For Itself.</h1>
            <p class="page-subtitle">From residential villas to commercial complexes — every project we deliver is a testament to our commitment to quality.</p>
        </div>
    </div>
</div>

<div class="filter-bar">
    <div class="container">
        <div class="filter-inner">
            <button class="filter-btn active" data-filter="all">
                All <span class="filter-count">{{ $projects->count() }}</span>
            </button>
            @foreach($projects->groupBy('category') as $category => $group)
                <button class="filter-btn" data-filter="{{ $category }}">
                    {{ $category }} <span class="filter-count">{{ $group->count() }}</span>
                </button>
            @endforeach
        </div>
    </div>
</div>

<div class="projects-section">
    <div class="container">

        <p class="projects-count">
            Showing <span id="visible-count">{{ $projects->count() }}</span> of <span>{{ $projects->count() }}</span> projects
        </p>

        <div class="projects-grid" id="projects-grid">
            @forelse($projects as $project)
                <a href="{{ route('projects.show', $project) }}"
                   class="proj-card"
                   data-category="{{ $project->category }}">
                    <div class="proj-card-img" style="{{ $project->cover_image ? 'background-image:url(' . asset('storage/' . $project->cover_image) . ')' : '' }}">
                        <div class="proj-card-overlay"></div>
                        <div class="proj-card-hover-info">
                            <p class="proj-card-hover-cat">{{ $project->category }} · {{ $project->location }}</p>
                            <h3 class="proj-card-hover-name">{{ $project->name }}</h3>
                        </div>
                    </div>
                    <div class="proj-card-body">
                        <div>
                            <p class="proj-card-name">{{ $project->name }}</p>
                            <p class="proj-card-sub">{{ $project->category }} · {{ $project->location }}</p>
                        </div>
                        <div class="proj-card-arrow">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                        </div>
                    </div>
                </a>
            @empty
                <div class="empty-state">
                    <p>No projects have been added yet. Check back soon.</p>
                </div>
            @endforelse
        </div>

    </div>
</div>

<div class="cta-banner">
    <div class="container">
        <div class="cta-inner">
            <div class="cta-text">
                <h2>Ready to Build Your<br><em>Dream Project?</em></h2>
                <p>Let's discuss your vision and bring it to life with the precision and quality De Knest is known for.</p>
            </div>
            <a href="{{ route('home') }}#contact" class="btn-cta-gold">
                Get a Free Quote
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </a>
        </div>
    </div>
</div>

<footer>
    <div class="container">
        <div class="footer-mini">
            <div class="footer-mini-logo">De <span>Knest</span></div>
            <p>&copy; {{ date('Y') }} De Knest Construction Ltd. All rights reserved.</p>
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

const filterBtns = document.querySelectorAll('.filter-btn');
const cards = document.querySelectorAll('.proj-card');
const visibleCount = document.getElementById('visible-count');

filterBtns.forEach(btn => {
    btn.addEventListener('click', function() {
        filterBtns.forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        const filter = this.dataset.filter;
        let count = 0;
        cards.forEach(card => {
            if(filter === 'all' || card.dataset.category === filter){
                card.classList.remove('hidden');
                count++;
            } else {
                card.classList.add('hidden');
            }
        });
        if(visibleCount) visibleCount.textContent = count;
    });
});
</script>
@endsection