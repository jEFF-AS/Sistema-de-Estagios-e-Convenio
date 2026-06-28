<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estágios e Convênios Atenas</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="bg-gray-100 antialiased font-sans overflow-hidden">

    <div class="flex h-screen w-screen bg-gray-100 font-sans overflow-hidden">

        <div class="w-64 bg-[#1e40af] text-white flex flex-col justify-between shadow-xl">
            <div>
                <div class="p-6 flex justify-center">
                    <div class="w-30 h-30 flex items-center justify-center">
                        <img src="{{ asset('img/atenas.png') }}" alt ="Logo Estágios e Convênios" class="w-full h-full object-contain filter drop-shadow-sm rounded-3xl">
                    </div>
                </div>
                <div class="px-6 py-2 text-center border-b border-blue-700/50 font-semibold uppercase tracking-wider text-sm">Menu</div>
                <nav class="mt-6 px-4 space-y-3">
                    <a href="/relatorios" class="flex items-center justify-center w-full px-4 py-2.5 rounded-lg shadow-md font-bold text-sm tracking-wide border transition {{ request()->is('relatorios*') ? 'bg-blue-800 text-white border-blue-600' : 'bg-white text-[#1e40af] border-gray-200' }}">Painel Geral</a>
                    <a href="/empresas" class="flex items-center justify-center w-full px-4 py-2.5 rounded-lg shadow-md font-bold text-sm tracking-wide border transition {{ request()->is('empresas*') ? 'bg-blue-800 text-white border-blue-600' : 'bg-white text-[#1e40af] border-gray-200' }}">Empresas</a>
                    <a href="/alunos" class="flex items-center justify-center w-full px-4 py-2.5 rounded-lg shadow-md font-bold text-sm tracking-wide border transition {{ request()->is('alunos*') ? 'bg-blue-800 text-white border-blue-600' : 'bg-white text-[#1e40af] border-gray-200' }}">Alunos</a>
                    <a href="/vinculos" class="flex items-center justify-center w-full px-4 py-2.5 rounded-lg shadow-md font-bold text-sm tracking-wide border transition {{ request()->is('vinculos*') ? 'bg-blue-800 text-white border-blue-600' : 'bg-white text-[#1e40af] border-gray-200' }}">Vínculos</a>
                </nav>
            </div>
        </div>

        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="bg-white border-b border-gray-200 h-20 flex items-center justify-between px-8 shadow-sm">
                <h1 class="text-2xl font-extrabold text-[#1e40af] tracking-widest uppercase">ESTÁGIOS E CONVÊNIOS ATENAS</h1>

                <div class="flex items-center gap-4 border-l border-gray-200 pl-6">

                    @livewire('componente-sino')

                    <div class="flex items-center gap-3 relative" x-data="{ userMenuOpen: false }">

                        <div class="text-right cursor-pointer select-none" x-on:click="userMenuOpen = !userMenuOpen">
                            <div class="text-xs text-gray-400 font-medium">Usuário Conectado</div>
                            <div class="text-sm font-bold text-gray-700 hover:text-blue-600 transition">
                                {{ Auth::user()->name ?? 'Funcionário' }}
                            </div>
                        </div>

                        <button x-on:click="userMenuOpen = !userMenuOpen" type="button" class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center font-bold text-gray-600 shadow-inner hover:bg-gray-300 transition focus:outline-none">
                            👤
                        </button>

                        <div x-show="userMenuOpen"
                            x-on:click.outside="userMenuOpen = false"
                            x-transition:enter="transition ease-out duration-150"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-100"
                            x-transition:leave-start="opacity-100 scale-100"
                            x-transition:leave-end="opacity-0 scale-95"
                            class="absolute right-0 top-12 w-48 bg-white border border-gray-200 rounded-2xl shadow-xl overflow-hidden z-50 transform origin-top-right"
                            style="display: none;">

                            <div class="px-4 py-2.5 border-b border-gray-50 bg-gray-50/50">
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Acessado como</p>
                                <p class="text-xs font-semibold text-gray-600 truncate">{{ Auth::user()->email ?? '' }}</p>
                            </div>

                            <div class="p-1.5 space-y-0.5">
                                <a href="#" class="flex items-center gap-2 px-3 py-2 text-xs font-bold text-gray-600 hover:bg-gray-50 rounded-xl transition">
                                    <span>👤</span> Meu Perfil
                                </a>
                                <a href="#" class="flex items-center gap-2 px-3 py-2 text-xs font-bold text-gray-600 hover:bg-gray-50 rounded-xl transition">
                                    <span>⚙️</span> Configurações
                                </a>

                                <hr class="border-gray-100 my-1">

                                <form action="{{ route('logout') }}" method="POST" class="w-full">
                                    @csrf
                                    <button type="submit" class="w-full flex items-center gap-2 px-3 py-2 text-xs font-bold text-red-600 hover:bg-red-50 rounded-xl transition text-left">
                                        <span>🚪</span> Sair do Sistema
                                    </button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-y-auto bg-gray-50 p-8">
                @if (session()->has('message'))
                <div x-data="{ show: true }"
                    x-show="show"
                    x-init="setTimeout(() => show = false, 4000)"
                    x-transition:leave="transition ease-in duration-500"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95"
                    class="mb-4 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded-xl text-sm font-semibold shadow-sm flex items-center gap-2">
                    <span>✅</span>
                    <div>{{ session('message') }}</div>
                </div>
                @endif

                @yield('conteudo')

            </main>
        </div>
    </div>

    @livewireScripts
</body>

</html>