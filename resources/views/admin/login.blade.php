<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | De Knest Construction</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root{
            --bg:#F7F5F0;
            --dark:#111008;
            --gold:#B8892A;
            --green:#1B3A26;
            --text:#1A1714;
            --text-mid:#6B6560;
            --border:rgba(0,0,0,0.08);
            --font-display:'Cormorant Garamond',serif;
            --font:'DM Sans',sans-serif;
        }
        *,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
        html,body{height:100%}
        body{background:var(--dark);font-family:var(--font);color:var(--text);-webkit-font-smoothing:antialiased;display:flex;align-items:center;justify-content:center;min-height:100vh;position:relative;overflow:hidden}

        /* background dot grid */
        body::before{
            content:'';position:absolute;inset:0;
            background-image:radial-gradient(circle,rgba(184,137,42,0.1) 1px,transparent 1px);
            background-size:32px 32px;pointer-events:none;
        }
        /* background circles */
        body::after{
            content:'';position:absolute;
            right:-200px;bottom:-200px;
            width:600px;height:600px;border-radius:50%;
            border:1px solid rgba(184,137,42,0.08);
            pointer-events:none;
        }

        .login-wrap{
            position:relative;z-index:1;
            width:100%;max-width:420px;
            padding:0 24px;
        }

        .login-logo{
            text-align:center;
            margin-bottom:48px;
        }
        .login-logo img{
            height:56px;width:auto;
            object-fit:contain;
            margin:0 auto 16px;
        }
        .login-logo-text{
            font-family:var(--font-display);
            font-size:1.8rem;font-weight:600;
            color:#fff;letter-spacing:0.04em;
        }
        .login-logo-text span{color:var(--gold)}
        .login-logo-sub{
            font-size:0.62rem;letter-spacing:0.22em;
            text-transform:uppercase;
            color:rgba(255,255,255,0.3);
            margin-top:4px;
        }

        .login-card{
            background:rgba(255,255,255,0.03);
            border:1px solid rgba(255,255,255,0.08);
            padding:40px;
            backdrop-filter:blur(10px);
        }

        .login-title{
            font-family:var(--font-display);
            font-size:1.6rem;font-weight:400;
            color:#fff;margin-bottom:6px;
        }
        .login-title em{font-style:italic;color:var(--gold)}
        .login-subtitle{
            font-size:0.8rem;color:rgba(255,255,255,0.35);
            margin-bottom:32px;line-height:1.6;
        }

        .fg{display:flex;flex-direction:column;gap:8px;margin-bottom:18px}
        .fg label{
            font-size:0.65rem;font-weight:600;
            letter-spacing:0.18em;text-transform:uppercase;
            color:rgba(255,255,255,0.4);
        }
        .fg input{
            background:rgba(255,255,255,0.05);
            border:1px solid rgba(255,255,255,0.1);
            color:#fff;
            font-family:var(--font);
            font-size:0.9rem;font-weight:300;
            padding:13px 16px;outline:none;
            transition:border-color 0.25s,background 0.25s;
            width:100%;
        }
        .fg input:focus{
            border-color:var(--gold);
            background:rgba(255,255,255,0.08);
        }
        .fg input::placeholder{color:rgba(255,255,255,0.2)}

        .error-msg{
            background:rgba(192,57,43,0.1);
            border:1px solid rgba(192,57,43,0.3);
            color:#e88;
            font-size:0.82rem;
            padding:12px 16px;
            margin-bottom:20px;
        }

        .btn-login{
            width:100%;padding:14px;
            background:var(--gold);color:#fff;
            font-family:var(--font);font-size:0.78rem;font-weight:600;
            letter-spacing:0.14em;text-transform:uppercase;
            border:none;cursor:pointer;
            transition:opacity 0.25s,transform 0.25s;
            margin-top:8px;
        }
        .btn-login:hover{opacity:0.88;transform:translateY(-1px)}

        .login-footer{
            text-align:center;
            margin-top:32px;
            font-size:0.72rem;
            color:rgba(255,255,255,0.2);
        }
        .login-footer a{
            color:rgba(255,255,255,0.4);
            transition:color 0.2s;
        }
        .login-footer a:hover{color:var(--gold)}
    </style>
</head>
<body>

<div class="login-wrap">
    <div class="login-logo">
        <img src="{{ asset('images/logo.jpeg') }}" alt="De Knest Construction">
        <div class="login-logo-sub">Admin Panel</div>
    </div>

    <div class="login-card">
        <h1 class="login-title">Welcome <em>Back.</em></h1>
        <p class="login-subtitle">Sign in to manage your projects and content.</p>

        @if($errors->any())
            <div class="error-msg">{{ $errors->first() }}</div>
        @endif

        <form action="{{ route('admin.login.post') }}" method="POST">
            @csrf
            <div class="fg">
                <label>Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="admin@deknest.com" required autofocus>
            </div>
            <div class="fg">
                <label>Password</label>
                <input type="password" name="password" placeholder="••••••••" required>
            </div>
            <button type="submit" class="btn-login">Sign In</button>
        </form>
    </div>

    <div class="login-footer">
        <a href="{{ route('home') }}">← Back to Website</a>
    </div>
</div>

</body>
</html>