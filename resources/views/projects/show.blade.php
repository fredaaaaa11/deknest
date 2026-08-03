@extends('layouts.app')

@section('title', $project->name . ' — De Knest Construction')

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

/* NAV */
#navbar{position:fixed;top:0;left:0;right:0;z-index:1000;padding:22px 0;transition:background 0.4s ease,box-shadow 0.4s ease}
#navbar.scrolled{background:rgba(250,250,248,0.95);backdrop-filter:blur(20px);box-shadow:0 1px 0 var(--border)}
.nav-inner{display:flex;align-items:center;justify-content:space-between}
.nav-logo img{height:48px;width:auto;object-fit:contain}
.nav-back{
    display:flex;align-items:center;gap:8px;
    font-size:0.72rem;font-weight:500;
    letter-spacing:0.13em;text-transform:uppercase;
    color:var(--text-mid);transition:color var(--transition);
}
.nav-back:hover{color:var(--gold)}
.nav-back svg{width:16px;height:16px}
.nav-cta-btn{
    padding:11px 26px;background:var(--bg-dark);color:#fff;
    font-size:0.7rem;font-weight:600;
    letter-spacing:0.14em;text-transform:uppercase;
    transition:background 0.25s;
}
.nav-cta-btn:hover{background:#222}

/* HERO */
.project-hero{
    height:70vh;min-height:500px;
    position:relative;overflow:hidden;margin-top:0;
}
.project-hero-img{
    position:absolute;inset:0;
    background-size:cover;background-position:center;
    transition:transform 8s ease;
}
.project-hero:hover .project-hero-img{transform:scale(1.04)}
.project-hero-overlay{
    position:absolute;inset:0;
    background:linear-gradient(to top,rgba(17,16,8,0.85) 0%,rgba(17,16,8,0.2) 60%,transparent 100%);
}
.project-hero-content{
    position:absolute;bottom:0;left:0;right:0;padding:56px 64px;
}
.project-hero-tag{
    display:inline-flex;align-items:center;gap:10px;
    font-size:0.65rem;font-weight:500;letter-spacing:0.22em;
    text-transform:uppercase;color:var(--gold);margin-bottom:14px;
}
.project-hero-tag::before{content:'';width:24px;height:1px;background:var(--gold)}
.project-hero-title{
    font-family:var(--font-display);
    font-size:clamp(2.4rem,5vw,5rem);
    font-weight:400;line-height:1.05;
    letter-spacing:-0.01em;color:#fff;margin-bottom:20px;
}
.project-hero-title em{font-style:italic;color:var(--gold)}
.project-hero-meta{display:flex;align-items:center;gap:28px;flex-wrap:wrap}
.project-hero-meta-item{
    display:flex;align-items:center;gap:8px;
    font-size:0.78rem;color:rgba(255,255,255,0.55);
}
.project-hero-meta-item svg{width:14px;height:14px;color:var(--gold);flex-shrink:0}
.status-badge{
    display:inline-block;padding:4px 12px;
    font-size:0.62rem;font-weight:600;letter-spacing:0.12em;text-transform:uppercase;
    border:1px solid rgba(184,137,42,0.4);color:var(--gold);
}

/* BREADCRUMB */
.breadcrumb{padding:20px 0;border-bottom:1px solid var(--border)}
.breadcrumb-inner{display:flex;align-items:center;gap:8px;font-size:0.72rem;color:var(--text-light)}
.breadcrumb-inner a{transition:color var(--transition)}
.breadcrumb-inner a:hover{color:var(--gold)}
.breadcrumb-inner svg{width:12px;height:12px;flex-shrink:0}
.breadcrumb-inner span{color:var(--text-mid)}

/* LAYOUT */
.project-body{
    display:grid;grid-template-columns:1fr 340px;
    gap:64px;padding:72px 0 120px;align-items:start;
}

/* GALLERY TABS */
.gallery-section{margin-bottom:60px}
.gallery-tabs{
    display:flex;gap:0;margin-bottom:28px;
    border-bottom:1px solid var(--border);
}
.gallery-tab{
    padding:12px 24px;
    font-size:0.72rem;font-weight:600;
    letter-spacing:0.14em;text-transform:uppercase;
    color:var(--text-light);cursor:pointer;
    border-bottom:2px solid transparent;margin-bottom:-1px;
    transition:color var(--transition),border-color var(--transition);
    background:none;border-top:none;border-left:none;border-right:none;
    font-family:var(--font-body);
}
.gallery-tab:hover{color:var(--text-mid)}
.gallery-tab.active{color:var(--gold);border-bottom-color:var(--gold)}

.gallery-panel{display:none}
.gallery-panel.active{display:block}

.gallery-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:12px}
.gallery-grid-item{
    position:relative;overflow:hidden;cursor:pointer;
    aspect-ratio:4/3;background:var(--bg-off);
}
.gallery-grid-item:first-child{grid-column:1/3;aspect-ratio:16/8}
.gallery-grid-item img{width:100%;height:100%;object-fit:cover;transition:transform 0.6s ease}
.gallery-grid-item:hover img{transform:scale(1.04)}
.gallery-grid-item-overlay{
    position:absolute;inset:0;
    background:rgba(17,16,8,0);transition:background 0.3s ease;
    display:flex;align-items:center;justify-content:center;
}
.gallery-grid-item:hover .gallery-grid-item-overlay{background:rgba(17,16,8,0.25)}
.gallery-zoom-icon{
    width:44px;height:44px;border:1px solid #fff;
    display:flex;align-items:center;justify-content:center;
    color:#fff;opacity:0;transform:scale(0.8);
    transition:opacity 0.3s ease,transform 0.3s ease;
}
.gallery-grid-item:hover .gallery-zoom-icon{opacity:1;transform:scale(1)}
.gallery-zoom-icon svg{width:18px;height:18px}
.no-images-msg{padding:60px 40px;text-align:center;background:var(--bg-off);font-size:0.9rem;color:var(--text-light)}

/* DESCRIPTION */
.project-description{margin-bottom:48px}
.section-heading{font-family:var(--font-display);font-size:1.8rem;font-weight:400;color:var(--text);margin-bottom:16px}
.section-heading em{font-style:italic;color:var(--gold)}
.project-description p{color:var(--text-mid);font-size:0.95rem;line-height:1.85;margin-bottom:14px}

/* SIDEBAR */
.sidebar-card{background:var(--bg-off);border:1px solid var(--border);padding:28px;margin-bottom:20px}
.sidebar-card:last-child{margin-bottom:0}
.sidebar-card-title{
    font-size:0.65rem;font-weight:600;letter-spacing:0.18em;text-transform:uppercase;
    color:var(--text-light);margin-bottom:20px;padding-bottom:14px;border-bottom:1px solid var(--border);
}
.detail-row{
    display:flex;align-items:flex-start;justify-content:space-between;
    gap:12px;padding:10px 0;border-bottom:1px solid var(--border);font-size:0.85rem;
}
.detail-row:last-child{border-bottom:none;padding-bottom:0}
.detail-label{color:var(--text-light);font-size:0.78rem;flex-shrink:0}
.detail-value{color:var(--text);font-weight:500;text-align:right}

.btn-quote{
    display:flex;align-items:center;justify-content:center;gap:10px;
    width:100%;padding:14px;background:var(--gold);color:#fff;
    font-family:var(--font-body);font-size:0.75rem;font-weight:600;
    letter-spacing:0.14em;text-transform:uppercase;border:none;cursor:pointer;
    transition:opacity 0.25s,transform 0.25s;margin-bottom:10px;
}
.btn-quote:hover{opacity:0.88;transform:translateY(-1px)}
.btn-back-projects{
    display:flex;align-items:center;justify-content:center;gap:8px;
    width:100%;padding:13px;background:transparent;color:var(--text-mid);
    font-family:var(--font-body);font-size:0.75rem;font-weight:500;
    letter-spacing:0.14em;text-transform:uppercase;
    border:1px solid var(--border);cursor:pointer;
    transition:border-color 0.25s,color 0.25s;
}
.btn-back-projects:hover{border-color:var(--gold);color:var(--gold)}
.btn-back-projects svg,.btn-quote svg{width:14px;height:14px}

/* LIGHTBOX */
.lightbox{
    position:fixed;inset:0;z-index:9999;
    background:rgba(0,0,0,0.95);
    display:none;align-items:center;justify-content:center;
}
.lightbox.open{display:flex}
.lightbox-img{max-width:90vw;max-height:88vh;object-fit:contain;border:1px solid rgba(255,255,255,0.08)}
.lightbox-close{
    position:absolute;top:24px;right:28px;
    width:44px;height:44px;border:1px solid rgba(255,255,255,0.2);
    background:none;cursor:pointer;
    display:flex;align-items:center;justify-content:center;
    color:#fff;transition:border-color 0.2s;
}
.lightbox-close:hover{border-color:var(--gold);color:var(--gold)}
.lightbox-close svg{width:18px;height:18px}
.lightbox-prev,.lightbox-next{
    position:absolute;top:50%;transform:translateY(-50%);
    width:48px;height:48px;border:1px solid rgba(255,255,255,0.15);
    background:none;cursor:pointer;
    display:flex;align-items:center;justify-content:center;
    color:rgba(255,255,255,0.6);transition:border-color 0.2s,color 0.2s;
}
.lightbox-prev{left:24px}
.lightbox-next{right:24px}
.lightbox-prev:hover,.lightbox-next:hover{border-color:var(--gold);color:var(--gold)}
.lightbox-prev svg,.lightbox-next svg{width:20px;height:20px}
.lightbox-counter{
    position:absolute;bottom:24px;left:50%;transform:translateX(-50%);
    font-size:0.72rem;letter-spacing:0.2em;
    color:rgba(255,255,255,0.35);font-family:var(--font-body);
}

/* RELATED */
.related-section{padding:80px 0;background:var(--bg-off);border-top:1px solid var(--border)}
.related-header{display:flex;align-items:flex-end;justify-content:space-between;margin-bottom:40px}
.related-title{font-family:var(--font-display);font-size:2.2rem;font-weight:400;color:var(--text)}
.related-title em{font-style:italic;color:var(--gold)}
.related-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:16px}
.related-card{
    position:relative;overflow:hidden;cursor:pointer;
    background:var(--bg);border:1px solid var(--border);
    transition:box-shadow var(--transition);
}
.related-card:hover{box-shadow:0 8px 30px rgba(0,0,0,0.1)}
.related-card-img{
    width:100%;aspect-ratio:4/3;
    background-size:cover;background-position:center;
    background-color:var(--bg-off);
    transition:transform 0.5s ease;
}
.related-card:hover .related-card-img{transform:scale(1.04)}
.related-card-body{padding:18px 20px}
.related-card-cat{font-size:0.6rem;font-weight:500;letter-spacing:0.18em;text-transform:uppercase;color:var(--gold);margin-bottom:6px}
.related-card-name{font-family:var(--font-display);font-size:1.2rem;font-weight:500;color:var(--text);margin-bottom:4px}
.related-card-loc{font-size:0.78rem;color:var(--text-light)}

/* FOOTER */
footer{background:var(--bg-dark);padding:40px 0}
.footer-mini{display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:16px}
.footer-mini-logo{font-family:var(--font-display);font-size:1.4rem;font-weight:600;color:#fff;letter-spacing:0.04em}
.footer-mini-logo span{color:var(--gold)}
.footer-mini p{font-size:0.72rem;color:rgba(255,255,255,0.25)}

/* RESPONSIVE */
@media(max-width:1024px){
    .container{padding:0 32px}
    .project-hero-content{padding:40px 32px}
    .project-body{grid-template-columns:1fr;gap:40px}
    .project-sidebar{display:grid;grid-template-columns:1fr 1fr;gap:16px}
    .sidebar-card{margin-bottom:0}
    .related-grid{grid-template-columns:1fr 1fr}
}
@media(max-width:768px){
    .container{padding:0 24px}
    .project-hero{height:55vh}
    .project-hero-content{padding:32px 24px}
    .gallery-grid{grid-template-columns:1fr}
    .gallery-grid-item:first-child{grid-column:1}
    .project-sidebar{grid-template-columns:1fr}
    .related-grid{grid-template-columns:1fr}
    .related-header{flex-direction:column;align-items:flex-start;gap:16px}
    .nav-back span{display:none}
}
</style>
@endsection

@section('content')

<!-- NAV -->
<nav id="navbar">
    <div class="container">
        <div class="nav-inner">
            <a href="{{ route('home') }}" class="nav-logo">
                <img src="{{ asset('images/logo.jpeg') }}" alt="De Knest Construction">
            </a>
            <a href="{{ route('projects.index') }}" class="nav-back">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                <span>All Projects</span>
            </a>
            <a href="{{ route('home') }}#contact" class="nav-cta-btn">Get a Quote</a>
        </div>
    </div>
</nav>

<!-- HERO -->
<div class="project-hero">
    <div class="project-hero-img" style="background-image:url('{{ $project->cover_image ? asset('storage/' . $project->cover_image) : asset('images/project-1.jpeg') }}');"></div>
    <div class="project-hero-overlay"></div>
    <div class="project-hero-content">
        <p class="project-hero-tag">{{ $project->category }}</p>
        <h1 class="project-hero-title">{{ $project->name }}</h1>
        <div class="project-hero-meta">
            <div class="project-hero-meta-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                {{ $project->location }}
            </div>
            @if($project->year)
            <div class="project-hero-meta-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                {{ $project->year }}
            </div>
            @endif
            <span class="status-badge">{{ ucfirst($project->status) }}</span>
        </div>
    </div>
</div>

<!-- BREADCRUMB -->
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <a href="{{ route('home') }}">Home</a>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
            <a href="{{ route('projects.index') }}">Projects</a>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
            <span>{{ $project->name }}</span>
        </div>
    </div>
</div>

<!-- BODY -->
<div class="container">
    <div class="project-body">

        <!-- MAIN CONTENT -->
        <div>
            <div class="gallery-section">
                <div class="gallery-tabs">
                    @if($completed->count())
                        <button class="gallery-tab active" data-tab="completed">
                            Completed ({{ $completed->count() }})
                        </button>
                    @endif
                    @if($renders->count())
                        <button class="gallery-tab {{ !$completed->count() ? 'active' : '' }}" data-tab="renders">
                            3D Renders ({{ $renders->count() }})
                        </button>
                    @endif
                    @php $others = $project->images->whereIn('type', ['progress','other']); @endphp
                    @if($others->count())
                        <button class="gallery-tab" data-tab="others">
                            More Photos ({{ $others->count() }})
                        </button>
                    @endif
                </div>

                @if($completed->count())
                <div class="gallery-panel active" id="tab-completed">
                    <div class="gallery-grid">
                        @foreach($completed as $img)
                        <div class="gallery-grid-item" onclick="openLightbox({{ $loop->index }}, 'completed')">
                            <img src="{{ asset('storage/' . $img->image_path) }}" alt="{{ $img->caption ?: $project->name }}">
                            <div class="gallery-grid-item-overlay">
                                <div class="gallery-zoom-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/><line x1="11" y1="8" x2="11" y2="14"/><line x1="8" y1="11" x2="14" y2="11"/></svg>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                @if($renders->count())
                <div class="gallery-panel {{ !$completed->count() ? 'active' : '' }}" id="tab-renders">
                    <div class="gallery-grid">
                        @foreach($renders as $img)
                        <div class="gallery-grid-item" onclick="openLightbox({{ $loop->index }}, 'renders')">
                            <img src="{{ asset('storage/' . $img->image_path) }}" alt="{{ $img->caption ?: '3D Render' }}">
                            <div class="gallery-grid-item-overlay">
                                <div class="gallery-zoom-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/><line x1="11" y1="8" x2="11" y2="14"/><line x1="8" y1="11" x2="14" y2="11"/></svg>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                @if($others->count())
                <div class="gallery-panel" id="tab-others">
                    <div class="gallery-grid">
                        @foreach($others as $img)
                        <div class="gallery-grid-item" onclick="openLightbox({{ $loop->index }}, 'others')">
                            <img src="{{ asset('storage/' . $img->image_path) }}" alt="{{ $img->caption ?: 'Project Photo' }}">
                            <div class="gallery-grid-item-overlay">
                                <div class="gallery-zoom-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/><line x1="11" y1="8" x2="11" y2="14"/><line x1="8" y1="11" x2="14" y2="11"/></svg>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                @if($project->images->count() === 0)
                    <div class="no-images-msg">No images uploaded for this project yet.</div>
                @endif
            </div>

            @if($project->description)
            <div class="project-description">
                <h2 class="section-heading">About This <em>Project</em></h2>
                <p>{{ $project->description }}</p>
            </div>
            @endif
        </div>

        <!-- SIDEBAR -->
        <div class="project-sidebar">
            <div class="sidebar-card">
                <p class="sidebar-card-title">Project Details</p>
                <div class="detail-row">
                    <span class="detail-label">Category</span>
                    <span class="detail-value">{{ $project->category }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Location</span>
                    <span class="detail-value">{{ $project->location }}</span>
                </div>
                @if($project->year)
                <div class="detail-row">
                    <span class="detail-label">Year</span>
                    <span class="detail-value">{{ $project->year }}</span>
                </div>
                @endif
                <div class="detail-row">
                    <span class="detail-label">Status</span>
                    <span class="detail-value">{{ ucfirst($project->status) }}</span>
                </div>
                @if($project->images->count())
                <div class="detail-row">
                    <span class="detail-label">Photos</span>
                    <span class="detail-value">{{ $project->images->count() }}</span>
                </div>
                @endif
            </div>

            <div class="sidebar-card">
                <p class="sidebar-card-title">Interested in a Similar Project?</p>
                <a href="{{ route('home') }}#contact" class="btn-quote">
                    Get a Quote
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                </a>
                <a href="{{ route('projects.index') }}" class="btn-back-projects">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                    All Projects
                </a>
            </div>
        </div>

    </div>
</div>

<!-- RELATED PROJECTS -->
@php
    $related = \App\Models\Project::where('id', '!=', $project->id)
        ->where('category', $project->category)
        ->limit(3)->get();
    if($related->count() < 3){
        $more = \App\Models\Project::where('id', '!=', $project->id)
            ->whereNotIn('id', $related->pluck('id'))
            ->limit(3 - $related->count())->get();
        $related = $related->merge($more);
    }
@endphp

@if($related->count())
<div class="related-section">
    <div class="container">
        <div class="related-header">
            <h2 class="related-title">More <em>Projects</em></h2>
            <a href="{{ route('projects.index') }}" style="font-size:0.75rem;font-weight:500;letter-spacing:0.14em;text-transform:uppercase;color:var(--text-mid);display:flex;align-items:center;gap:8px;transition:color 0.25s">
                View All
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </a>
        </div>
        <div class="related-grid">
            @foreach($related as $rel)
            <a href="{{ route('projects.show', $rel) }}" class="related-card">
                <div class="related-card-img" style="{{ $rel->cover_image ? 'background-image:url(' . asset('storage/' . $rel->cover_image) . ')' : '' }}"></div>
                <div class="related-card-body">
                    <p class="related-card-cat">{{ $rel->category }}</p>
                    <h3 class="related-card-name">{{ $rel->name }}</h3>
                    <p class="related-card-loc">{{ $rel->location }}</p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</div>
@endif

<!-- FOOTER -->
<footer>
    <div class="container">
        <div class="footer-mini">
            <div class="footer-mini-logo">De <span>Knest</span></div>
            <p>&copy; {{ date('Y') }} De Knest Construction Ltd. All rights reserved.</p>
        </div>
    </div>
</footer>

<!-- LIGHTBOX -->
<div class="lightbox" id="lightbox">
    <button class="lightbox-close" onclick="closeLightbox()">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
    </button>
    <button class="lightbox-prev" onclick="prevImage()">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
    </button>
    <img class="lightbox-img" id="lightbox-img" src="" alt="">
    <button class="lightbox-next" onclick="nextImage()">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
    </button>
    <div class="lightbox-counter" id="lightbox-counter"></div>
</div>

@endsection

@section('scripts')
<script>
const navbar = document.getElementById('navbar');
window.addEventListener('scroll', () => {
    navbar.classList.toggle('scrolled', window.scrollY > 60);
});

/* GALLERY TABS */
document.querySelectorAll('.gallery-tab').forEach(tab => {
    tab.addEventListener('click', function() {
        document.querySelectorAll('.gallery-tab').forEach(t => t.classList.remove('active'));
        document.querySelectorAll('.gallery-panel').forEach(p => p.classList.remove('active'));
        this.classList.add('active');
        const panel = document.getElementById('tab-' + this.dataset.tab);
        if(panel) panel.classList.add('active');
    });
});

/* LIGHTBOX */
let allImages = {};

@if($renders->count())
allImages['renders'] = [
    @foreach($renders as $img)
    '{{ asset('storage/' . $img->image_path) }}',
    @endforeach
];
@endif

@if($completed->count())
allImages['completed'] = [
    @foreach($completed as $img)
    '{{ asset('storage/' . $img->image_path) }}',
    @endforeach
];
@endif



@if($others->count())
allImages['others'] = [
    @foreach($others as $img)
    '{{ asset('storage/' . $img->image_path) }}',
    @endforeach
];
@endif

let currentTab = '';
let currentIndex = 0;

function openLightbox(index, tab) {
    currentTab = tab;
    currentIndex = index;
    document.getElementById('lightbox').classList.add('open');
    document.body.style.overflow = 'hidden';
    updateLightbox();
}

function updateLightbox() {
    const imgs = allImages[currentTab] || [];
    document.getElementById('lightbox-img').src = imgs[currentIndex] || '';
    document.getElementById('lightbox-counter').textContent = (currentIndex + 1) + ' / ' + imgs.length;
}

function closeLightbox() {
    document.getElementById('lightbox').classList.remove('open');
    document.body.style.overflow = '';
}

function prevImage() {
    const imgs = allImages[currentTab] || [];
    currentIndex = (currentIndex - 1 + imgs.length) % imgs.length;
    updateLightbox();
}

function nextImage() {
    const imgs = allImages[currentTab] || [];
    currentIndex = (currentIndex + 1) % imgs.length;
    updateLightbox();
}

document.getElementById('lightbox').addEventListener('click', function(e) {
    if(e.target === this) closeLightbox();
});

document.addEventListener('keydown', function(e) {
    if(!document.getElementById('lightbox').classList.contains('open')) return;
    if(e.key === 'Escape') closeLightbox();
    if(e.key === 'ArrowLeft') prevImage();
    if(e.key === 'ArrowRight') nextImage();
});
</script>
@endsection