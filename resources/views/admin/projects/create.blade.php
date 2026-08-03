<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Project | De Knest Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root{
            --bg:#F7F5F0;
            --white:#FFFFFF;
            --dark:#111008;
            --gold:#B8892A;
            --green:#1B3A26;
            --text:#1A1714;
            --text-mid:#6B6560;
            --border:rgba(0,0,0,0.08);
            --red:#C0392B;
            --font:'DM Sans',sans-serif;
        }
        *,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
        body{background:var(--bg);font-family:var(--font);color:var(--text);font-weight:300}
        a{text-decoration:none;color:inherit}

        .sidebar{
            position:fixed;top:0;left:0;bottom:0;
            width:240px;background:var(--dark);
            display:flex;flex-direction:column;
            padding:32px 0;z-index:100;
        }
        .sidebar-logo{
            padding:0 28px 32px;
            border-bottom:1px solid rgba(255,255,255,0.06);
            margin-bottom:24px;
        }
        .sidebar-logo span{font-size:1.2rem;font-weight:600;letter-spacing:0.04em;color:#fff}
        .sidebar-logo span b{color:var(--gold)}
        .sidebar-logo p{font-size:0.6rem;letter-spacing:0.2em;text-transform:uppercase;color:rgba(255,255,255,0.3);margin-top:3px}
        .sidebar-nav{display:flex;flex-direction:column;gap:4px;padding:0 16px}
        .sidebar-nav a{
            display:flex;align-items:center;gap:12px;
            padding:10px 14px;border-radius:4px;
            font-size:0.82rem;font-weight:500;
            color:rgba(255,255,255,0.5);
            transition:background 0.2s,color 0.2s;
        }
        .sidebar-nav a:hover{background:rgba(255,255,255,0.05);color:#fff}
        .sidebar-nav a.active{background:rgba(184,137,42,0.15);color:var(--gold)}
        .sidebar-nav a svg{width:16px;height:16px;flex-shrink:0}
        .sidebar-back{margin-top:auto;padding:0 16px}
        .sidebar-back a{
            display:flex;align-items:center;gap:10px;
            padding:10px 14px;
            font-size:0.82rem;font-weight:500;
            color:rgba(255,255,255,0.35);transition:color 0.2s;
        }
        .sidebar-back a:hover{color:#fff}

        .main{margin-left:240px;min-height:100vh;padding:48px}

        .topbar{display:flex;align-items:center;gap:16px;margin-bottom:40px}
        .topbar-back{
            display:flex;align-items:center;gap:8px;
            font-size:0.78rem;color:var(--text-mid);
            transition:color 0.2s;
        }
        .topbar-back:hover{color:var(--text)}
        .topbar-back svg{width:16px;height:16px}
        .topbar h1{font-size:1.6rem;font-weight:600;letter-spacing:-0.01em}

        .form-wrap{
            display:grid;
            grid-template-columns:1.4fr 1fr;
            gap:24px;
            align-items:start;
        }

        .card{
            background:var(--white);
            border:1px solid var(--border);
            padding:32px;
            margin-bottom:24px;
        }
        .card:last-child{margin-bottom:0}
        .card-title{
            font-size:0.72rem;font-weight:600;
            letter-spacing:0.16em;text-transform:uppercase;
            color:var(--text-mid);margin-bottom:24px;
            padding-bottom:16px;border-bottom:1px solid var(--border);
        }

        .fg{display:flex;flex-direction:column;gap:7px;margin-bottom:18px}
        .fg:last-child{margin-bottom:0}
        .fg label{
            font-size:0.68rem;font-weight:600;
            letter-spacing:0.14em;text-transform:uppercase;
            color:var(--text-mid);
        }
        .fg input,.fg select,.fg textarea{
            background:var(--bg);
            border:1px solid var(--border);
            color:var(--text);
            font-family:var(--font);
            font-size:0.88rem;font-weight:300;
            padding:12px 14px;outline:none;
            transition:border-color 0.25s;
            width:100%;-webkit-appearance:none;
        }
        .fg input:focus,.fg select:focus,.fg textarea:focus{
            border-color:var(--gold);background:#fff;
        }
        .fg textarea{resize:vertical;min-height:100px}
        .fg select option{background:#fff}
        .fg-hint{font-size:0.72rem;color:var(--text-mid);margin-top:4px}

        .frow{display:grid;grid-template-columns:1fr 1fr;gap:14px}

        /* IMAGE UPLOAD */
        .upload-zone{
            border:2px dashed var(--border);
            padding:32px 20px;
            text-align:center;
            cursor:pointer;
            transition:border-color 0.2s,background 0.2s;
            position:relative;
        }
        .upload-zone:hover{border-color:var(--gold);background:rgba(184,137,42,0.03)}
        .upload-zone input[type="file"]{
            position:absolute;inset:0;opacity:0;cursor:pointer;width:100%;height:100%;
        }
        .upload-zone svg{width:28px;height:28px;color:var(--text-mid);margin:0 auto 10px}
        .upload-zone p{font-size:0.82rem;color:var(--text-mid)}
        .upload-zone span{font-size:0.72rem;color:var(--text-mid);opacity:0.6}

        /* IMAGES LIST */
        #images-list{margin-top:20px;display:flex;flex-direction:column;gap:12px}
        .image-row{
            display:grid;
            grid-template-columns:60px 1fr 1fr;
            gap:12px;align-items:center;
            padding:12px;
            background:var(--bg);
            border:1px solid var(--border);
        }
        .image-preview{
            width:60px;height:44px;
            object-fit:cover;
            border:1px solid var(--border);
        }
        .image-row select,.image-row input{
            background:#fff;
            border:1px solid var(--border);
            color:var(--text);
            font-family:var(--font);
            font-size:0.82rem;
            padding:8px 10px;outline:none;
            transition:border-color 0.2s;
            width:100%;
        }
        .image-row select:focus,.image-row input:focus{border-color:var(--gold)}

        /* TOGGLE */
        .toggle-wrap{display:flex;align-items:center;gap:12px}
        .toggle{
            position:relative;width:44px;height:24px;
            cursor:pointer;
        }
        .toggle input{opacity:0;width:0;height:0;position:absolute}
        .toggle-slider{
            position:absolute;inset:0;
            background:var(--border);border-radius:24px;
            transition:background 0.25s;
        }
        .toggle-slider::before{
            content:'';
            position:absolute;
            width:18px;height:18px;border-radius:50%;
            background:#fff;top:3px;left:3px;
            transition:transform 0.25s;
            box-shadow:0 1px 3px rgba(0,0,0,0.15);
        }
        .toggle input:checked + .toggle-slider{background:var(--gold)}
        .toggle input:checked + .toggle-slider::before{transform:translateX(20px)}
        .toggle-label{font-size:0.85rem;color:var(--text-mid)}

        /* SUBMIT */
        .btn-submit{
            width:100%;padding:14px;
            background:var(--green);color:#fff;
            font-family:var(--font);font-size:0.78rem;font-weight:600;
            letter-spacing:0.12em;text-transform:uppercase;
            border:none;cursor:pointer;
            transition:opacity 0.2s;margin-top:8px;
        }
        .btn-submit:hover{opacity:0.88}

        .error-list{
            background:rgba(192,57,43,0.06);
            border:1px solid rgba(192,57,43,0.2);
            padding:14px 18px;margin-bottom:24px;
            font-size:0.83rem;color:var(--red);
        }
        .error-list ul{padding-left:16px;margin-top:6px}
        .error-list li{margin-bottom:4px}
    </style>
</head>
<body>

<!-- SIDEBAR -->
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

<!-- MAIN -->
<div class="main">
    <div class="topbar">
        <a href="{{ route('admin.projects.index') }}" class="topbar-back">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
            Back
        </a>
        <h1>Add New Project</h1>
    </div>

    @if($errors->any())
        <div class="error-list">
            Something went wrong. Please fix the errors below:
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-wrap">

            <!-- LEFT COLUMN -->
            <div>
                <!-- PROJECT DETAILS -->
                <div class="card">
                    <p class="card-title">Project Details</p>

                    <div class="fg">
                        <label>Project Name *</label>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="e.g. Luxury 3-Storey Residence" required>
                    </div>

                    <div class="frow">
                        <div class="fg">
                            <label>Location *</label>
                            <input type="text" name="location" value="{{ old('location') }}" placeholder="e.g. East Legon, Accra" required>
                        </div>
                        <div class="fg">
                            <label>Year Completed</label>
                            <input type="text" name="year" value="{{ old('year') }}" placeholder="e.g. 2024">
                        </div>
                    </div>

                    <div class="frow">
                        <div class="fg">
                            <label>Category *</label>
                            <select name="category" required>
                                <option value="" disabled selected>Select...</option>
                                <option value="Residential" {{ old('category') == 'Residential' ? 'selected' : '' }}>Residential</option>
                                <option value="Commercial" {{ old('category') == 'Commercial' ? 'selected' : '' }}>Commercial</option>
                                <option value="Renovation" {{ old('category') == 'Renovation' ? 'selected' : '' }}>Renovation</option>
                                <option value="Mixed Use" {{ old('category') == 'Mixed Use' ? 'selected' : '' }}>Mixed Use</option>
                                <option value="Other" {{ old('category') == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>
                        <div class="fg">
                            <label>Status *</label>
                            <select name="status" required>
                                <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="ongoing" {{ old('status') == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                                <option value="upcoming" {{ old('status') == 'upcoming' ? 'selected' : '' }}>Upcoming</option>
                            </select>
                        </div>
                    </div>

                    <div class="fg">
                        <label>Description</label>
                        <textarea name="description" placeholder="Brief description of the project...">{{ old('description') }}</textarea>
                    </div>

                    <div class="fg">
                        <label>Sort Order</label>
                        <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" placeholder="0">
                        <span class="fg-hint">Lower number = appears first on the website</span>
                    </div>

                    <div class="toggle-wrap">
                        <label class="toggle">
                            <input type="checkbox" name="featured" value="1" {{ old('featured', true) ? 'checked' : '' }}>
                            <span class="toggle-slider"></span>
                        </label>
                        <span class="toggle-label">Show on homepage featured projects</span>
                    </div>
                </div>

                <!-- PROJECT IMAGES -->
                <div class="card">
                    <p class="card-title">Project Images</p>

                    <div class="upload-zone">
                        <input type="file" name="images[]" id="images-input" multiple accept="image/*">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                        <p>Click to upload project images</p>
                        <span>JPG, JPEG, PNG, WEBP — max 5MB each</span>
                    </div>

                    <div id="images-list"></div>
                </div>
            </div>

            <!-- RIGHT COLUMN -->
            <div>
                <!-- COVER IMAGE -->
                <div class="card">
                    <p class="card-title">Cover Image</p>
                    <div class="upload-zone">
                        <input type="file" name="cover_image" id="cover-input" accept="image/*">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                        <p>Upload cover image</p>
                        <span>This shows on the projects grid</span>
                    </div>
                    <div id="cover-preview" style="margin-top:14px;display:none">
                        <img id="cover-preview-img" style="width:100%;height:180px;object-fit:cover;border:1px solid var(--border);">
                    </div>
                </div>

                <!-- SUBMIT -->
                <div class="card">
                    <button type="submit" class="btn-submit">
                        Save Project
                    </button>
                    <div style="text-align:center;margin-top:14px">
                        <a href="{{ route('admin.projects.index') }}" style="font-size:0.78rem;color:var(--text-mid)">Cancel</a>
                    </div>
                </div>
            </div>

        </div>
    </form>
</div>

<script>
// Cover image preview
document.getElementById('cover-input').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = function(ev) {
        document.getElementById('cover-preview-img').src = ev.target.result;
        document.getElementById('cover-preview').style.display = 'block';
    };
    reader.readAsDataURL(file);
});

// Project images preview with type selector
document.getElementById('images-input').addEventListener('change', function(e) {
    const list = document.getElementById('images-list');
    list.innerHTML = '';
    Array.from(e.target.files).forEach((file, index) => {
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