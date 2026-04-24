<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Laravel') }}</title>

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/css/home.css', 'resources/js/app.js'])
        @else
            <style>
                :root {
                  --preto-intenso: #020202;
                  --preto-suave: #181818;
                  --amarelo-vibrante: #F6E71D;
                  --amarelo-metalico: #F5D10D;
                  --cinza-claro: #ccc;
                }

                * {
                  box-sizing: border-box;
                  margin: 0;
                  padding: 0;
                }

                body {
                  font-family: 'Segoe UI', sans-serif;
                  background-color: var(--preto-intenso);
                  color: #fff;
                }

                header {
                  background-color: var(--preto-suave);
                  padding: 20px;
                  text-align: center;
                }

                header h1 {
                  color: var(--amarelo-vibrante);
                  margin-bottom: 10px;
                }

                main {
                  padding: 40px 20px;
                  text-align: center;
                }

                .hero {
                  background-color: var(--preto-suave);
                  padding: 60px 20px;
                  border-radius: 10px;
                  box-shadow: 0 0 10px rgba(246, 231, 29, 0.2);
                }

                .hero h2 {
                  color: var(--amarelo-vibrante);
                  margin-bottom: 20px;
                  font-size: 2em;
                }

                .hero p {
                  color: var(--cinza-claro);
                  margin-bottom: 30px;
                  font-size: 1.2em;
                }

                .botoes {
                  display: flex;
                  justify-content: center;
                  gap: 20px;
                  flex-wrap: wrap;
                }

                .btn {
                  padding: 15px 30px;
                  background-color: var(--amarelo-vibrante);
                  border: none;
                  border-radius: 5px;
                  color: var(--preto-intenso);
                  font-weight: bold;
                  text-decoration: none;
                  transition: background-color 0.3s ease;
                }

                .btn:hover {
                  background-color: var(--amarelo-metalico);
                }

                footer {
                  background-color: var(--preto-suave);
                  text-align: center;
                  padding: 20px;
                  margin-top: 40px;
                  color: var(--cinza-claro);
                }
            </style>
        @endif
    </head>
    <body>
        <div class="home-wrapper">
            <header>
                <h1>Iron Gym</h1>
            </header>

            <main>
                <section class="hero">
                    <h2>Bem-vindo à Iron Gym</h2>
                    <p>Transforme seu corpo e mente com nossos treinos personalizados.</p>
                    <div class="botoes">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="btn">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="btn">Login</a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="btn">Criar Conta</a>
                                @endif
                            @endauth
                        @else
                            <a href="/login" class="btn">Login</a>
                            <a href="/register" class="btn">Criar Conta</a>
                        @endif
                    </div>
                </section>
            </main>

            <footer>
                <p>&copy; 2025 Iron Gym. Todos os direitos reservados.</p>
            </footer>
        </div>
    </body>
</html>
