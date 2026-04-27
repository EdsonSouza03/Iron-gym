<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name'))</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="app-body">
    <header class="topbar">
        <div class="topbar-inner">
            <div class="brand-group">
                <a href="{{ route('aulas.index') }}" class="brand">
                    <img src="{{ asset('images/iron-gym-logo.svg') }}" alt="Iron Gym Logo" class="brand-logo">
                    Iron Gym
                </a>
                <p class="brand-subtitle">CRUD acadêmico de controle de aulas e pagamentos</p>
            </div>
            <nav class="main-nav">
                <a href="{{ route('aulas.index') }}" class="{{ request()->routeIs('aulas.*') ? 'active' : '' }}">Aulas</a>
                <a href="{{ route('pagamentos.index') }}" class="{{ request()->routeIs('pagamentos.*') ? 'active' : '' }}">Pagamentos</a>
                <a href="{{ route('alunos.index') }}" class="{{ request()->routeIs('alunos.*') ? 'active' : '' }}">Alunos</a>
                <a href="{{ route('alunos.register') }}" class="register-link">Cadastrar-se</a>
            </nav>
        </div>
    </header>

    <main class="page-shell">
        @yield('content')
    </main>

    <script>
        window.csrfToken = '{{ csrf_token() }}';
    </script>
    @yield('scripts')
    <script src="{{ asset('js/crud.js') }}"></script>
</body>
</html>
