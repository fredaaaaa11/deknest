<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Project | De Knest Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root{
            --bg:#F7F5F0;--white:#FFFFFF;--dark:#111008;
            --gold:#B8892A;--green:#1B3A26;--text:#1A1714;
            --text-mid:#6B6560;--border:rgba(0,0,0,0.08);
            --red:#C0392B;--font:'DM Sans',sans-serif;
        }
        *,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
        body{background:var(--bg);font-family:var(--font);color:var(--text);font-weight:300}
        a{text-decoration:none;color:inherit}

        .sidebar{position:fixed;top:0;left:0;bottom:0;width:240px;background:var(--dark);display:flex;flex-direction:column;padding:32px 0;z-index:100}
        .sidebar-logo{padding:0 28px 32px;border-bottom:1px solid rgba(255,255,255,0.06);margin-bottom:24px}
        .sidebar-logo span{font-size:1.2rem;font-weight:600;letter-spacing:0.04em;color:#fff}
        .sidebar-logo span b{color:var(--gold)}
        .sidebar-logo p{font-size:0.6rem;letter-spacing:0.2em;text-transform:uppercase;color:rgba(255,255,255,0.3);margin-top:3px}
        .sidebar-nav{display:flex;flex-direction:column;gap:4px;padding:0 16px}
        .sidebar-nav a{display:flex;align-items:center;gap:12px;padding:10px 14px;border-radius:4px;font-size:0.82rem;font-weight:500;color:rgba(255,255,255,0.5);transition:background 0.2s,color 0.2s}
        .sidebar-nav a:hover{background:rgba(255,255,255,0.05);color:#fff}
        .sidebar-nav a.active{background:rgba(184,137,42,0.15);color:var(--gold)}
        .sidebar-nav a svg{width:16px;height:16px;flex-shrink:0}
        .sidebar-back{margin-top:auto;padding:0 16px}
        .sidebar-back a{display:flex;align-items:center;gap:10px;padding:10px 14px;font-size:0.82rem;font-weight:500;color:rgba(255,255,255,0.35);transition:color 0.2s}
        .sidebar-back a:hover{color:#fff}

        .main{margin-left:240px;min-height:100vh;padding:48px}

        .topbar{display:flex;align-items:center;gap:16px;margin-bottom:40px}
        .topbar-back{display:flex;align-items:center;gap:8px;font-size:0.78rem;color:var(--text-mid);transition:color 0.2s}
        .topbar-back:hover{color:var(--text)}
        .topbar-back svg{width:16px;height:16px}
        .topbar h1{font-size:1.6rem;font-weight:600;letter-spacing:-0.01em}

        .layout{display:grid;grid-template-columns:1.4fr 1fr;gap:24px;align-items:start}

        .card{background:var(--white);border:1px solid var(--border);padding:32px;margin-bottom:24px}
        .card:last-child{margin-bottom:0}
        .card-title{font-size:0.72rem;font-weight:600;letter-spacing:0.16em;text-transform:uppercase;color:var(--text-mid);margin-bottom:24px;padding-bottom:16px;border-bottom:1px solid var(--border)}

        .fg{display:flex;flex-direction:column;gap:7px;margin-bottom:18px}
        .fg:last-child{margin-bottom:0}
        .fg label{font-size:0.68rem;font-weight:600;letter-spacing:0.14em;text-transform:uppercase;color:var(--text-mid)}
        .fg input,.fg select,.fg textarea{background:var(--bg);border:1px solid var(--border);color:var(--text);font-family:var(--font);font-size:0.88rem;font-weight:300;padding:12px 14px;outline:none;transition:border-color 0.25s;width:100%;-webkit-appearance:none}
        .fg input:focus,.fg select:focus,.fg textarea:focus{border-color:var(--gold);background:#fff}
        .fg textarea{resize:vertical;min-height:100px}
        .fg-hint{font-size:0.72rem;color:var(--text-mid);margin-top:4px}
        .frow{display:grid;grid-template-columns:1fr 1fr;gap:14px}

        .toggle-wrap{display:flex;align-items:center;gap:12px}
        .toggle{position:relative;width:44px;height:24px;cursor:pointer}
        .toggle input{opacity:0;width:0;height:0;position:absolute}
        .toggle-slider{position:absolute;inset:0;background:var(--border);border-radius:24px;transition:background 0.25s}
        .toggle-slider::before{content:'';position:absolute;width:18px;height:18px;border-radius:50%;background:#fff;top:3px;left:3px;transition:transform 0.25s;box-shadow:0 1px 3px rgba(0,0,0,0.15)}
        .toggle input:checked + .toggle-slider{background:var(--gold)}
        .toggle input:checked + .toggle-slider::before{transform:translateX(20px)}
        .toggle-label{font-size:0.85rem;color:var(--text-mid)}

        .upload-zone{border:2px dashed var(--border);padding:28px 20px;text-align:center;cursor:pointer;transition:border-color 0.2s,background 0.2s;position:relative}
        .upload-zone:hover{border-color:var(--gold);background:rgba(184,137,42,0.03)}
        .upload-zone input[type="file"]{position:absolute;inset:0;opacity:0;cursor:pointer;width:100%;height:100%}
        .upload-zone svg{width:24px;height:24px;color:var(--text-mid);margin:0 auto 8px}
        .upload-zone p{font-size:0.82rem;color:var(--text-mid)}
        .upload-zone span{font-size:0.72rem;color:var(--text-mid);opacity:0.6}

        /* EXISTING IMAGES GRID */
        .existing-images{display:grid;grid-template-columns:repeat(3,1fr);gap:12px;margin-bottom:8px}
        .existing-img-card{border:1px solid var(--border);overflow:hidden;background:var(--bg)}
        .existing-img-card img{width:100%;height:90px;object-fit:cover;display:block}
        .existing-img-info{padding:7px 10px}
        .existing-img-type{font-size:0.6rem;font-weight:600;letter-spacing:0.12em;text-transform:uppercase;color:var(--gold);margin-bottom:2px}
        .existing-img-caption{font-size:0.7rem;color:var(--text-mid)}
        .btn-remove-img{width:100%;padding:7px;background:transparent;border:none;border-top:1px solid var(--border);color:var(--red);font-family:var(--font);font-size:0.7rem;font-weight:500;cursor:pointer;transition:background 0.2s}
        .btn-remove-img:hover{background:rgba(192,57,43,0.05)}

        #new-images-list{margin-top:16px;display:flex;flex-direction:column;gap:10px}
        .image-row{display:grid;grid-template-columns:56px 1fr 1fr;gap:10px;align-items:center;padding:10px;background:var(--bg);border:1px solid var(--border)}
        .image-preview{width:56px;height:40px;object-fit:cover;border:1px solid var(--border)}
        .image-row select,.image-row input{background:#fff;border:1px solid var(--border);color:var(--text);font-family:var(--font);font-size:0.82rem;padding:8px 10px;outline:none;width:100%}
        .image-row select:focus,.image-row input:focus{border-color:var(--gold)}

        .current-cover{width:100%;height:180px;object-fit:cover;border:1px solid var(--border);margin-bottom:14px;display:block}
        .cover-label{font-size:0.68rem;font-weight:600;letter-spacing:0.14em;text-transform:uppercase;color:var(--text-mid);margin-bottom:10px}

        .btn-submit{width:100%;padding:14px;background:var(--green);color:#fff;font-family:var(--font);font-size:0.78rem;font-weight:600;letter-spacing:0.12em;text-transform:uppercase;border:none;cursor:pointer;transition:opacity 0.2s;margin-top:8px}
        .btn-submit:hover{opacity:0.88}
        .btn-danger{width:100%;padding:12px;background:transparent;color:var(--red);font-family:var(--font);font-size:0.78rem;font-weight:500;letter-spacing:0.1em;text-transform:uppercase;border:1px solid rgba(192,57,43,0.2);cursor:pointer;transition:background 0.2s,border-color 0.2s;margin-top:10px}
        .btn-danger:hover{background:rgba(192,57,43,0.05);border-color:var(--red)}

        .alert{padding:14px 18px;margin-bottom:24px;border-radius:2px;font-size:0.85rem}
        .alert-success{background:rgba(27,58,38,0.08);border:1px solid var(--green);color:var(--green)}
        .error-list{background:rgba(192,57,43,0.06);border:1px solid rgba(192,57,43,0.2);padding:14px 18px;margin-bottom:24px;font-size:0.83rem;color:var(--red)}
        .error-list ul{padding-left:16px;margin-top:6px}
        .error-list li{margin-bottom:4px}
        .no-images{font-size:0.82rem;color:var(--text-mid);text-align:center;padding:20px 0}
    </style>
</head>
<body>

<div class="sidebar">
    <div class="sidebar-logo">
        <span>De <b>Knest</b></span>
        <p>Admin Panel</p>
    </div>
    <nav class="sidebar-nav">
        <a href="{{ route('admin.projects.index') }}" class="active">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
            Projects
        </a>
        <a href="{{ route('admin.settings') }}">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 010 2.83 2 2 0 01-2.83 0l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-4 0v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83 0 2 2 0 010-2.83l.06-.06A1.65 1.65 0 004.68 15a1.65 1.65 0 00-1.51-1H3a2 2 0 010-4h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 010-2.83 2 2 0 012.83 0l.06.06A1.65 1.65 0 009 4.68a1.65 1.65 0 001-1.51V3a2 2 0 014 0v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 0 2 2 0 010 2.83l-.06.06A1.65 1.65 0 0019.4 9a1.65 1.65 0 001.51 1H21a2 2 0 010 4h-.09a1.65 1.65 0 00-1.51 1z"/></svg>
    Settings
</a>
    </nav>
    <div class="sidebar-back">
        <a href="{{ route('home') }}">
            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.5"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
            View Website
        </a>
    </div>
</div>

<div class="main">
    <div class="topbar">
        <a href="{{ route('admin.projects.index') }}" class="topbar-back">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
            Back
        </a>
        <h1>Edit — {{ $project->name }}</h1>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="error-list">
            Please fix the errors below:
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="layout">

        <!-- LEFT COLUMN -->
        <div>

            {{-- ═══════════════════════════════════════════
                 SECTION 1 — EXISTING IMAGES (standalone forms, no nesting)
                 ═══════════════════════════════════════════ --}}
            <div class="card">
                <p class="card-title">Current Images ({{ $project->images->count() }})</p>

                @if($project->images->count())
                    <div class="existing-images">
                        @foreach($project->images as $image)
                        <div class="existing-img-card">
                            <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $image->caption }}">
                            <div class="existing-img-info">
                                <p class="existing-img-type">{{ ucfirst($image->type) }}</p>
                                <p class="existing-img-caption">{{ $image->caption ?: 'No caption' }}</p>
                            </div>
                            {{-- Standalone form — NOT nested inside the main save form --}}
                            <form action="{{ route('admin.projects.images.destroy', $image) }}"
                                  method="POST"
                                  onsubmit="return confirm('Remove this image?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-remove-img">Remove</button>
                            </form>
                        </div>
                        @endforeach
                    </div>
                @else
                    <p class="no-images">No images uploaded yet.</p>
                @endif
            </div>

            {{-- ═══════════════════════════════════════════
                 SECTION 2 — MAIN SAVE FORM (project details + new images)
                 ═══════════════════════════════════════════ --}}
            <form action="{{ route('admin.projects.update', $project) }}"
                  method="POST"
                  enctype="multipart/form-data"
                  id="save-form">
                @csrf
                @method('PUT')

                <!-- PROJECT DETAILS -->
                <div class="card">
                    <p class="card-title">Project Details</p>

                    <div class="fg">
                        <label>Project Name *</label>
                        <input type="text" name="name" value="{{ old('name', $project->name) }}" required>
                    </div>

                    <div class="frow">
                        <div class="fg">
                            <label>Location *</label>
                            <input type="text" name="location" value="{{ old('location', $project->location) }}" required>
                        </div>
                        <div class="fg">
                            <label>Year Completed</label>
                            <input type="text" name="year" value="{{ old('year', $project->year) }}" placeholder="e.g. 2024">
                        </div>
                    </div>

                    <div class="frow">
                        <div class="fg">
                            <label>Category *</label>
                            <select name="category" required>
                                @foreach(['Residential','Commercial','Renovation','Mixed Use','Other'] as $cat)
                                    <option value="{{ $cat }}" {{ old('category', $project->category) == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="fg">
                            <label>Status *</label>
                            <select name="status" required>
                                @foreach(['completed','ongoing','upcoming'] as $st)
                                    <option value="{{ $st }}" {{ old('status', $project->status) == $st ? 'selected' : '' }}>{{ ucfirst($st) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="fg">
                        <label>Description</label>
                        <textarea name="description">{{ old('description', $project->description) }}</textarea>
                    </div>

                    <div class="fg">
                        <label>Sort Order</label>
                        <input type="number" name="sort_order" value="{{ old('sort_order', $project->sort_order) }}">
                        <span class="fg-hint">Lower number = appears first</span>
                    </div>

                    <div class="toggle-wrap">
                        <label class="toggle">
                            <input type="checkbox" name="featured" value="1" {{ old('featured', $project->featured) ? 'checked' : '' }}>
                            <span class="toggle-slider"></span>
                        </label>
                        <span class="toggle-label">Show on homepage featured projects</span>
                    </div>
                </div>

                <!-- ADD NEW IMAGES -->
                <div class="card">
                    <p class="card-title">Add More Images</p>
                    <div class="upload-zone">
                        <input type="file" name="images[]" id="images-input" multiple accept="image/*">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                        <p>Click to upload more images</p>
                        <span>JPG, JPEG, PNG, WEBP — max 5MB each</span>
                    </div>
                    <div id="new-images-list"></div>
                </div>

            </form>
            {{-- End of main save form left column content --}}

        </div>

        <!-- RIGHT COLUMN -->
        <div>

            <!-- COVER IMAGE — inside the save form via JS submit -->
            <div class="card">
                <p class="card-title">Cover Image</p>

                @if($project->cover_image)
                    <p class="cover-label">Current Cover</p>
                    <img class="current-cover" src="{{ asset('storage/' . $project->cover_image) }}" alt="Cover">
                    <p class="fg-hint" style="margin-bottom:14px">Upload below to replace</p>
                @endif

                {{-- This upload zone is outside the form tag but we submit via button below --}}
                <div class="upload-zone" onclick="document.getElementById('cover-input').click()">
                    <input type="file" id="cover-input" accept="image/*" style="display:none">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                    <p>{{ $project->cover_image ? 'Replace cover image' : 'Upload cover image' }}</p>
                    <span>Shows on the projects grid</span>
                </div>
                <div id="cover-preview" style="margin-top:14px;display:none">
                    <img id="cover-preview-img" style="width:100%;height:180px;object-fit:cover;border:1px solid var(--border);">
                </div>
            </div>

            <!-- SAVE BUTTON -->
            <div class="card">
                <button type="submit" form="save-form" class="btn-submit">Save Changes</button>
                <div style="text-align:center;margin-top:14px">
                    <a href="{{ route('admin.projects.index') }}" style="font-size:0.78rem;color:var(--text-mid)">Cancel</a>
                </div>
            </div>

            <!-- DANGER ZONE — completely separate standalone form -->
            <div class="card">
                <p class="card-title">Danger Zone</p>
                <form action="{{ route('admin.projects.destroy', $project) }}"
                      method="POST"
                      onsubmit="return confirm('Delete {{ addslashes($project->name) }}? This cannot be undone.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-danger">Delete This Project</button>
                </form>
            </div>

        </div>

    </div>
</div>

<script>
/* Cover image preview */
document.getElementById('cover-input').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (!file) return;

    /* Inject a hidden file input into the save form */
    const existing = document.getElementById('cover-hidden-input');
    if (existing) existing.remove();

    const dt = new DataTransfer();
    dt.items.add(file);

    const hiddenInput = document.createElement('input');
    hiddenInput.type = 'file';
    hiddenInput.name = 'cover_image';
    hiddenInput.id = 'cover-hidden-input';
    hiddenInput.style.display = 'none';
    hiddenInput.files = dt.files;
    document.getElementById('save-form').appendChild(hiddenInput);

    /* Show preview */
    const reader = new FileReader();
    reader.onload = function(ev) {
        document.getElementById('cover-preview-img').src = ev.target.result;
        document.getElementById('cover-preview').style.display = 'block';
    };
    reader.readAsDataURL(file);
});

/* New images preview with type selector */
document.getElementById('images-input').addEventListener('change', function(e) {
    const list = document.getElementById('new-images-list');
    list.innerHTML = '';
    Array.from(e.target.files).forEach((file) => {
        const reader = new FileReader();
        reader.onload = function(ev) {
            const row = document.createElement('div');
            row.className = 'image-row';
            row.innerHTML = `
                <img class="image-preview" src="${ev.target.result}" alt="Preview">
                <select name="image_types[]">
                   <option value="render">3D Render</option>
                   <option value="progress">Ongoing / In Progress</option>
                   <option value="completed">Completed</option>
    <option value="other">Other</option>
</select>
                <input type="text" name="captions[]" placeholder="Caption (optional)">
            `;
            list.appendChild(row);
        };
        reader.readAsDataURL(file);
    });
});
</script>

</body>
</html>