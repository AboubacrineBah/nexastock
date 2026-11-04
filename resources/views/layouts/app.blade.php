<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Tableau de bord') · NexaStock</title>
    <link rel="icon" href="{{ asset('nexastock-logo.svg') }}" type="image/svg+xml">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Lora:wght@500;600;700&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --green: #155b45;
            --green-dark: #104735;
            --lime: #d5e9a4;
            --ink: #172b25;
            --muted: #74817b;
            --line: #e7ece8;
            --bg: #f6f8f5;
            --cream: #fbfaf4
        }

        * {
            box-sizing: border-box
        }

        body {
            background: var(--bg);
            color: var(--ink);
            font-family: 'DM Sans', sans-serif;
            font-size: 14px
        }

        .sidebar {
            width: 248px;
            position: fixed;
            inset: 0 auto 0 0;
            background: #fff;
            border-right: 1px solid var(--line);
            padding: 26px 18px;
            z-index: 20;
            display: flex;
            flex-direction: column
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 0 8px 36px;
            text-decoration: none;
            color: var(--ink)
        }

        .brand img {
            width: 42px;
            height: 42px
        }

        .brand strong {
            font: 700 20px 'Lora', serif;
            display: block
        }

        .brand small {
            color: var(--muted);
            font-size: 11px
        }

        .nav-label {
            font-size: 10px;
            letter-spacing: .12em;
            color: #9ba6a0;
            font-weight: 700;
            margin: 19px 11px 8px
        }

        .side-link {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 10px 12px;
            border-radius: 9px;
            color: #53625a;
            text-decoration: none;
            font-weight: 600;
            margin: 2px 0
        }

        .side-link:hover,
        .side-link.active {
            background: #edf5ef;
            color: var(--green)
        }

        .side-link .glyph {
            font-size: 17px;
            width: 20px;
            text-align: center
        }

        .account {
            margin-top: auto;
            border-top: 1px solid var(--line);
            padding: 18px 4px 0;
            display: flex;
            align-items: center;
            gap: 10px
        }

        .avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #e8f0e8;
            color: var(--green);
            display: grid;
            place-items: center;
            font-weight: 700
        }

        .account small {
            display: block;
            color: var(--muted)
        }

        .main {
            margin-left: 248px;
            min-height: 100vh
        }

        .topbar {
            height: 72px;
            background: rgba(255, 255, 255, .9);
            border-bottom: 1px solid var(--line);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 38px;
            position: sticky;
            top: 0;
            z-index: 10
        }

        .crumb {
            color: var(--muted)
        }

        .crumb b {
            color: var(--ink)
        }

        .content {
            padding: 34px 38px;
            max-width: 1450px;
            margin: auto
        }

        .eyebrow {
            font-size: 10px;
            letter-spacing: .13em;
            color: #87948d;
            font-weight: 700;
            margin-bottom: 8px
        }

        .page-title {
            font: 600 30px 'Lora', serif;
            margin: 0 0 5px
        }

        .subtitle {
            color: var(--muted);
            margin: 0
        }

        .page-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            margin-bottom: 26px
        }

        .btn-brand {
            background: var(--green);
            border-color: var(--green);
            color: white;
            font-weight: 600
        }

        .btn-brand:hover {
            background: var(--green-dark);
            color: white
        }

        .btn-soft {
            background: #edf4ee;
            color: var(--green);
            border: 1px solid #e2ece4;
            font-weight: 600
        }

        .btn-soft:hover {
            background: #e2eee4;
            color: var(--green-dark)
        }

        .panel {
            border: 1px solid var(--line);
            border-radius: 14px;
            background: #fff;
            box-shadow: 0 3px 12px #15271c05
        }

        .stat-card {
            padding: 19px 20px;
            height: 100%
        }

        .stat-card .label {
            color: var(--muted);
            font-weight: 600
        }

        .stat-card .value {
            font: 600 28px 'Lora', serif;
            margin: 9px 0 3px
        }

        .stat-card .hint {
            font-size: 12px;
            color: var(--muted)
        }

        .stat-icon {
            float: right;
            width: 38px;
            height: 38px;
            border-radius: 11px;
            background: #edf5ef;
            color: var(--green);
            display: grid;
            place-items: center;
            font-size: 17px
        }

        .panel-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 19px 20px;
            border-bottom: 1px solid var(--line)
        }

        .panel-head h2 {
            font: 600 17px 'Lora', serif;
            margin: 0
        }

        .table {
            margin: 0
        }

        .table thead th {
            font-size: 10px;
            letter-spacing: .08em;
            color: #89968f;
            font-weight: 700;
            background: #fafbf9;
            border-bottom-color: var(--line);
            padding: 13px 16px;
            white-space: nowrap
        }

        .table td {
            padding: 14px 16px;
            border-color: #eef1ee;
            vertical-align: middle
        }

        .table tbody tr:last-child td {
            border-bottom: 0
        }

        .item-name {
            font-weight: 700;
            color: var(--ink);
            text-decoration: none
        }

        .item-sub {
            font-size: 11px;
            color: var(--muted);
            display: block;
            margin-top: 3px
        }

        .pill {
            display: inline-block;
            background: #edf5ef;
            color: var(--green);
            border-radius: 30px;
            padding: 5px 9px;
            font-size: 11px;
            font-weight: 700
        }

        .pill-warning {
            background: #fff4df;
            color: #916400
        }

        .pill-danger {
            background: #fff0ed;
            color: #b34632
        }

        .form-shell {
            max-width: 870px
        }

        .form-panel {
            padding: 24px
        }

        .form-label {
            font-weight: 700;
            font-size: 12px
        }

        .form-control,
        .form-select {
            border-color: #dfe6e1;
            border-radius: 8px;
            padding: 10px 12px
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #70a08a;
            box-shadow: 0 0 0 .2rem #155b4517
        }

        .form-text {
            color: var(--muted)
        }

        .alert {
            border: 0;
            border-radius: 10px
        }

        .auth-bg {
            min-height: 100vh;
            background: linear-gradient(135deg, #edf4e9, #fbfaf4);
            display: grid;
            place-items: center;
            padding: 24px
        }

        .auth-card {
            width: min(100%, 430px);
            padding: 36px;
            background: #fff;
            border: 1px solid var(--line);
            border-radius: 18px;
            box-shadow: 0 16px 50px #12241a12
        }

        .auth-logo {
            width: 60px;
            margin-bottom: 20px
        }

        .pagination {
            --bs-pagination-color: var(--green);
            --bs-pagination-active-bg: var(--green);
            --bs-pagination-active-border-color: var(--green)
        }

        @media(max-width:900px) {
            .sidebar {
                width: 74px;
                padding: 20px 10px
            }

            .brand {
                margin: 0 auto 25px
            }

            .brand>span,
            .nav-label,
            .side-link .nav-text,
            .account>div:last-child {
                display: none
            }

            .side-link {
                justify-content: center;
                padding: 12px
            }

            .account {
                justify-content: center
            }

            .main {
                margin-left: 74px
            }

            .topbar {
                padding: 0 20px
            }

            .content {
                padding: 25px 20px
            }
        }

        @media(max-width:575px) {
            .sidebar {
                width: 58px;
                padding: 16px 5px
            }

            .side-link {
                padding: 11px 7px
            }

            .main {
                margin-left: 58px
            }

            .topbar {
                height: 60px;
                padding: 0 13px
            }

            .content {
                padding: 22px 13px
            }

            .page-head {
                align-items: flex-start;
                flex-direction: column
            }

            .page-title {
                font-size: 25px
            }

            .table {
                min-width: 680px
            }

            .form-panel {
                padding: 17px
            }
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>

<body>
    @auth
        <aside class="sidebar">
            <a class="brand" href="{{ route('dashboard') }}"><img src="{{ asset('logo-mark.svg') }}"
                    alt=""><span><strong>NexaStock</strong><small>par NexaWeb Mali</small></span></a>
            <div class="nav-label">ESPACE DE TRAVAIL</div>
            <a class="side-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}"><span
                    class="glyph"><i class="bi bi-speedometer2" aria-hidden="true"></i></span><span class="nav-text">Tableau de bord</span></a>
            <a class="side-link {{ request()->routeIs('articles.*') ? 'active' : '' }}"
                href="{{ route('articles.index') }}"><span class="glyph"><i class="bi bi-box-seam"
                        aria-hidden="true"></i></span><span class="nav-text">Articles</span></a>
            <a class="side-link {{ request()->routeIs('categories.*') ? 'active' : '' }}"
                href="{{ route('categories.index') }}"><span class="glyph"><i class="bi bi-list"
                        aria-hidden="true"></i></span><span class="nav-text">Catégories</span></a>
            <a class="side-link {{ request()->routeIs('mouvements.*') ? 'active' : '' }}"
                href="{{ route('mouvements.index') }}"><span class="glyph"><i class="bi bi-arrow-left-right"
                        aria-hidden="true"></i></span><span class="nav-text">Mouvements</span></a>
            <a class="side-link {{ request()->routeIs('fournisseurs.*') ? 'active' : '' }}"
                href="{{ route('fournisseurs.index') }}"><span class="glyph"><i class="bi bi-truck"
                        aria-hidden="true"></i></span><span class="nav-text">Fournisseurs</span></a>
            <a class="side-link {{ request()->routeIs('rapports') ? 'active' : '' }}" href="{{ route('rapports') }}"><span
                    class="glyph"><i class="bi bi-file-earmark-bar-graph" aria-hidden="true"></i></span><span
                    class="nav-text">Rapports</span></a>
            <div class="account"><span class="avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                <div class="flex-grow-1"><strong>{{ auth()->user()->name }}</strong><small>Administrateur</small></div>
                <form method="post" action="{{ route('logout') }}">@csrf<button class="btn btn-sm text-secondary"
                        title="Se déconnecter"><i class="bi bi-box-arrow-left" aria-hidden="true"></i></button></form>
            </div>
        </aside>
        <div class="main">
            <header class="topbar">
                <div class="crumb">NexaStock <span class="mx-2">/</span> <b>@yield('title', 'Tableau de bord')</b></div>
                <div class="small text-secondary d-none d-sm-block">{{ now()->locale('fr')->translatedFormat('l d F Y') }}
                </div>
            </header>
            <main class="content">
                @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>@endif
                @if($errors->any())
                <div class="alert alert-danger">Veuillez corriger les champs signalés.</div>@endif
                @yield('content')
            </main>
        </div>
    @else @yield('guest-content') @endauth
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>
