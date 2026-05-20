<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Laravel') }}</title>

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/css/dashboard.css', 'resources/js/app.js'])
        @else
           
        @endif
    </head>
    <body class="hero-page">
        <div class="home-wrapper">
            <header>
                <h1>Iron Gym</h1>
            </header>

            <main>
                <section class="hero" style="background-image: url('{{ asset('images/bg-gym.jpg') }}'); background-size: cover; background-position: center;">
                    <picture class="hero-bg" aria-hidden="true">
                        <source srcset="{{ asset('images/bg-gym.webp') }}" type="image/webp">
                        <img src="{{ asset('images/bg-gym.jpg') }}" alt="" class="responsive-img">
                    </picture>

                    <div class="hero-content">
                        <h2>Bem-vindo à Iron Gym</h2>
                        <p>Transforme seu corpo e mente com nossos treinos personalizados.</p>

                        <div class="botoes">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="btn">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-accent">Login</a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="btn btn-accent">Criar Conta</a>
                                @endif
                            @endauth
                        @else
                            <a href="/login" class="btn btn-accent">Login</a>
                            <a href="/register" class="btn btn-accent">Criar Conta</a>
                        @endif
                        </div>
                    </div>
                </section>
            </main>

            <footer>
                <p>&copy; 2025 Iron Gym. Todos os direitos reservados.</p>
            </footer>
        </div>
    </body>
</html>
