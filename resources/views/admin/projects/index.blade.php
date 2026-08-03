<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin — Projects | De Knest</title>
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

        /* SIDEBAR */
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
        .sidebar-logo span{
            font-size:1.2rem;font-weight:600;
            letter-spacing:0.04em;color:#fff;
        }
        .sidebar-logo span b{color:var(--gold)}
        .sidebar-logo p{
            font-size:0.6rem;letter-spacing:0.2em;
            text-transform:uppercase;
            color:rgba(255,255,255,0.3);
            margin-top:3px;
        }
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
        .sidebar-back{
            margin-top:auto;padding:0 16px;
        }
        .sidebar-back a{
            display:flex;align-items:center;gap:10px;
            padding:10px 14px;
            font-size:0.82rem;font-weight:500;
            color:rgba(255,255,255,0.35);
            transition:color 0.2s;
        }
        .sidebar-back a:hover{color:#fff}

        /* MAIN */
        .main{margin-left:240px;min-height:100vh;padding:48px}

        /* TOPBAR */
        .topbar{
            display:flex;align-items:center;
            justify-content:space-between;
            margin-bottom:40px;
        }
        .topbar h1{
            font-size:1.6rem;font-weight:600;
            letter-spacing:-0.01em;color:var(--text);
        }
        .topbar p{font-size:0.85rem;color:var(--text-mid);margin-top:3px}
        .btn-add{
            display:inline-flex;align-items:center;gap:8px;
            padding:12px 24px;background:var(--green);color:#fff;
            font-size:0.78rem;font-weight:600;
            letter-spacing:0.1em;text-transform:uppercase;
            transition:opacity 0.2s;
        }
        .btn-add:hover{opacity:0.88}
        .btn-add svg{width:16px;height:16px}

        /* ALERT */
        .alert{
            padding:14px 18px;margin-bottom:24px;
            border-radius:2px;font-size:0.85rem;
        }
        .alert-success{background:rgba(27,58,38,0.08);border:1px solid var(--green);color:var(--green)}

        /* TABLE */
        .table-wrap{
            background:var(--white);
            border:1px solid var(--border);
            overflow:hidden;
        }
        table{width:100%;border-collapse:collapse}
        thead{background:var(--dark)}
        thead th{
            padding:14px 20px;text-align:left;
            font-size:0.65rem;font-weight:600;
            letter-spacing:0.16em;text-transform:uppercase;
            color:rgba(255,255,255,0.5);
        }
        tbody tr{border-bottom:1px solid var(--border);transition:background 0.2s}
        tbody tr:last-child{border-bottom:none}
        tbody tr:hover{background:#FAFAF8}
        tbody td{padding:16px 20px;font-size:0.85rem;vertical-align:middle}

        .proj-cover{
            width:56px;height:40px;
            object-fit:cover;
            background:var(--bg);
            border:1px solid var(--border);
            flex-shrink:0;
        }
        .proj-cover-placeholder{
            width:56px;height:40px;
            background:var(--bg);
            border:1px solid var(--border);
            display:flex;align-items:center;justify-content:center;
            font-size:0.55rem;color:var(--text-mid);
            text-align:center;
        }
        .proj-name{font-weight:500;color:var(--text);margin-bottom:2px}
        .proj-location{font-size:0.78rem;color:var(--text-mid)}

        .badge{
            display:inline-block;
            padding:3px 10px;border-radius:20px;
            font-size:0.65rem;font-weight:600;
            letter-spacing:0.08em;text-transform:uppercase;
        }
        .badge-green{background:rgba(27,58,38,0.1);color:var(--green)}
        .badge-gold{background:rgba(184,137,42,0.1);color:var(--gold)}
        .badge-grey{background:rgba(0,0,0,0.06);color:var(--text-mid)}

        .featured-dot{
            width:8px;height:8px;border-radius:50%;
            display:inline-block;
        }
        .featured-dot.yes{background:var(--gold)}
        .featured-dot.no{background:var(--border)}

        .actions{display:flex;gap:8px;align-items:center}
        .btn-edit{
            padding:7px 16px;
            background:transparent;
            border:1px solid var(--border);
            color:var(--text-mid);
            font-size:0.72rem;font-weight:500;
            cursor:pointer;transition:border-color 0.2s,color 0.2s;
        }
        .btn-edit:hover{border-color:var(--green);color:var(--green)}
        .btn-delete{
            padding:7px 16px;
            background:transparent;
            border:1px solid var(--border);
            color:var(--text-mid);
            font-size:0.72rem;font-weight:500;
            cursor:pointer;transition:border-color 0.2s,color 0.2s;
        }
        .btn-delete:hover{border-color:var(--red);color:var(--red)}

        /* EMPTY STATE */
        .empty-state{
            padding:80px 40px;text-align:center;
        }
        .empty-state p{color:var(--text-mid);font-size:0.9rem;margin-bottom:20px}

        /* DELETE FORM */
        .delete-form{display:inline}
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
        <div>
            <h1>Projects</h1>
            <p>Manage all your featured and portfolio projects</p>
        </div>
        <a href="{{ route('admin.projects.create') }}" class="btn-add">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Add Project
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-wrap">
        @if($projects->count())
        <table>
            <thead>
                <tr>
                    <th>Cover</th>
                    <th>Project</th>
                    <th>Category</th>
                    <th>Year</th>
                    <th>Status</th>
                    <th>Featured</th>
                    <th>Images</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($projects as $project)
                <tr>
                    <td>
                        @if($project->cover_image)
                            <img class="proj-cover" src="{{ asset('storage/' . $project->cover_image) }}" alt="{{ $project->name }}">
                        @else
                            <div class="proj-cover-placeholder">No Cover</div>
                        @endif
                    </td>
                    <td>
                        <p class="proj-name">{{ $project->name }}</p>
                        <p class="proj-location">{{ $project->location }}</p>
                    </td>
                    <td><span class="badge badge-gold">{{ $project->category }}</span></td>
                    <td>{{ $project->year ?? '—' }}</td>
                    <td>
                        @if($project->status === 'completed')
                            <span class="badge badge-green">Completed</span>
                        @else
                            <span class="badge badge-grey">{{ ucfirst($project->status) }}</span>
                        @endif
                    </td>
                    <td>
                        <span class="featured-dot {{ $project->featured ? 'yes' : 'no' }}"></span>
                    </td>
                    <td>{{ $project->images->count() }}</td>
                    <td>
                        <div class="actions">
                            <a href="{{ route('admin.projects.edit', $project) }}" class="btn-edit">Edit</a>
                            <form class="delete-form" action="{{ route('admin.projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Delete {{ $project->name }}? This cannot be undone.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="empty-state">
            <p>No projects yet. Add your first one.</p>
            <a href="{{ route('admin.projects.create') }}" class="btn-add">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                Add Project
            </a>
        </div>
        @endif
    </div>
</div>

</body>
</html>