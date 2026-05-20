<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard - Iron Gym') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <section class="hero" style="margin-bottom:24px; background-image: url('{{ asset('images/bg-gym.jpg') }}'); background-size: cover; background-position: center;">
                <picture class="hero-bg" aria-hidden="true">
                    <source srcset="{{ asset('images/bg-gym.webp') }}" type="image/webp">
                    <img src="{{ asset('images/bg-gym.jpg') }}" alt="Iron Gym background" class="responsive-img">
                </picture>

                <div class="hero-content">
                    <h2 style="color:var(--amarelo-vibrante); font-size:2rem; margin-bottom:12px;">Painel Central</h2>

                    <div style="display:flex;flex-direction:column;gap:18px;max-width:520px;margin:0 auto;">
                        <div class="panel" style="text-align:center;padding:18px;">
                            <h3 style="color:var(--amarelo-vibrante);font-size:1.3rem;margin:0;">Alunos Registrados</h3>
                            <p style="font-size:2rem;margin:12px 0 0 0;">{{ $totalAlunos }}</p>
                        </div>

                        <div class="panel" style="text-align:center;padding:18px;">
                            <h3 style="color:var(--amarelo-vibrante);font-size:1.3rem;margin:0;">Aulas Hoje</h3>
                            <p style="font-size:2rem;margin:12px 0 0 0;">{{ $totalAulas }}</p>
                        </div>
                    </div>

                    <div style="margin-top:20px;display:flex;gap:12px;justify-content:center;">
                        <a href="{{ route('alunos.create') }}" class="primary-button">Cadastrar Alunos</a>
                        <a href="{{ route('aulas.index') }}" class="primary-button">Gerenciar Aulas</a>
                        <a href="{{ route('pagamentos.index') }}" class="primary-button">Planos</a>
                    </div>
                </div>
            </section>

            <div class="mt-8">
                <div class="panel">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Ações Rápidas</h3>
                        <div class="flex flex-wrap" style="gap:12px;">
                            <a href="{{ route('alunos.create') }}" class="primary-button">Adicionar Aluno</a>
                            <a href="{{ route('aulas.create') }}" class="primary-button">Adicionar Aula</a>
                            <a href="{{ route('pagamentos.create') }}" class="primary-button">Registrar Pagamento</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
