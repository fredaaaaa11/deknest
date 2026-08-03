<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings | De Knest Admin</title>
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

        .topbar{margin-bottom:40px}
        .topbar h1{font-size:1.6rem;font-weight:600;letter-spacing:-0.01em}
        .topbar p{font-size:0.85rem;color:var(--text-mid);margin-top:4px}

        .settings-wrap{
            display:grid;
            grid-template-columns:1fr 1fr;
            gap:24px;
            max-width:900px;
        }

        .card{background:var(--white);border:1px solid var(--border);padding:32px;margin-bottom:24px}
        .card:last-child{margin-bottom:0}
        .card-title{font-size:0.72rem;font-weight:600;letter-spacing:0.16em;text-transform:uppercase;color:var(--text-mid);margin-bottom:24px;padding-bottom:16px;border-bottom:1px solid var(--border)}

        .fg{display:flex;flex-direction:column;gap:7px;margin-bottom:18px}
        .fg:last-child{margin-bottom:0}
        .fg label{font-size:0.68rem;font-weight:600;letter-spacing:0.14em;text-transform:uppercase;color:var(--text-mid)}
        .fg input{background:var(--bg);border:1px solid var(--border);color:var(--text);font-family:var(--font);font-size:0.88rem;font-weight:300;padding:12px 14px;outline:none;transition:border-color 0.25s;width:100%}
        .fg input:focus{border-color:var(--gold);background:#fff}
        .fg-hint{font-size:0.72rem;color:var(--text-mid);margin-top:4px}

        .btn-submit{width:100%;padding:14px;background:var(--green);color:#fff;font-family:var(--font);font-size:0.78rem;font-weight:600;letter-spacing:0.12em;text-transform:uppercase;border:none;cursor:pointer;transition:opacity 0.2s;margin-top:8px}
        .btn-submit:hover{opacity:0.88}

        .alert{padding:14px 18px;margin-bottom:24px;font-size:0.85rem;max-width:900px}
        .alert-success{background:rgba(27,58,38,0.08);border:1px solid var(--green);color:var(--green)}

        .error-list{background:rgba(192,57,43,0.06);border:1px solid rgba(192,57,43,0.2);padding:14px 18px;margin-bottom:24px;font-size:0.83rem;color:var(--red);max-width:900px}
        .error-list ul{padding-left:16px;margin-top:6px}
        .error-list li{margin-bottom:4px}

        .admin-info{
            display:flex;align-items:center;gap:16px;
            padding:20px 24px;
            background:var(--bg);
            border:1px solid var(--border);
            margin-bottom:32px;
            max-width:900px;
        }
        .admin-avatar{
            width:48px;height:48px;border-radius:50%;
            background:var(--gold);
            display:flex;align-items:center;justify-content:center;
            font-size:1.2rem;font-weight:600;color:#fff;
            flex-shrink:0;
        }
        .admin-name{font-size:0.95rem;font-weight:500;color:var(--text)}
        .admin-email{font-size:0.78rem;color:var(--text-mid);margin-top:2px}
        .admin-badge{
            margin-left:auto;
            padding:4px 12px;
            background:rgba(184,137,42,0.1);
            border:1px solid rgba(184,137,42,0.25);
            font-size:0.62rem;font-weight:600;
            letter-spacing:0.12em;text-transform:uppercase;
            color:var(--gold);
        }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="sidebar-logo">
        <span>De <b>Knest</b></span>
        <p>Admin Panel</p>
    </div>
    <nav class="sidebar-nav">
        <a href="{{ route('admin.projects.index') }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
            Projects
        </a>
        <a href="{{ route('admin.settings') }}" class="active">
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
        <h1>Settings</h1>
        <p>Manage your admin account credentials</p>
    </div>

    <!-- CURRENT ADMIN INFO -->
    <div class="admin-info">
        <div class="admin-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
        <div>
            <p class="admin-name">{{ auth()->user()->name }}</p>
            <p class="admin-email">{{ auth()->user()->email }}</p>
        </div>
        <span class="admin-badge">Admin</span>
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

    <form action="{{ route('admin.settings.update') }}" method="POST">
        @csrf
        <div class="settings-wrap">

            <!-- ACCOUNT INFO -->
            <div class="card">
                <p class="card-title">Account Information</p>
                <div class="fg">
                    <label>Full Name</label>
                    <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" required>
                </div>
                <div class="fg">
                    <label>Email Address</label>
                    <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" required>
                    <span class="fg-hint">This is used to log in to the admin panel</span>
                </div>
                <button type="submit" class="btn-submit">Save Changes</button>
            </div>

            <!-- CHANGE PASSWORD -->
            <div class="card">
                <p class="card-title">Change Password</p>
                <div class="fg">
                    <label>Current Password</label>
                    <input type="password" name="current_password" placeholder="Enter current password">
                </div>
                <div class="fg">
                    <label>New Password</label>
                    <input type="password" name="new_password" placeholder="Min. 8 characters">
                </div>
                <div class="fg">
                    <label>Confirm New Password</label>
                    <input type="password" name="new_password_confirmation" placeholder="Repeat new password">
                    <span class="fg-hint">Leave blank if you don't want to change your password</span>
                </div>
                <button type="submit" class="btn-submit">Update Password</button>
            </div>

        </div>
    </form>
</div>

</body>
</html>