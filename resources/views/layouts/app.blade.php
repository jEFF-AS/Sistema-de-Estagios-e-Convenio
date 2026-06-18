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
                    <div class="w-24 h-24 bg-gray-300 rounded-2xl flex items-center justify-center shadow-inner">
                        <span class="text-gray-500 text-xs font-bold uppercase tracking-wider">Logo</span>
                    </div>
                </div>
                <div class="px-6 py-2 text-center border-b border-blue-700/50 font-semibold uppercase tracking-wider text-sm">Menu</div>
                <nav class="mt-6 px-4 space-y-3">
                    <a href="#" class="flex items-center justify-center w-full px-4 py-2.5 rounded-lg shadow-md font-bold text-sm tracking-wide border transition {{ request()->is('painel*') ? 'bg-blue-800 text-white border-blue-600' : 'bg-white text-[#1e40af] border-gray-200' }}">Painel Geral</a>
                    <a href="/empresas" class="flex items-center justify-center w-full px-4 py-2.5 rounded-lg shadow-md font-bold text-sm tracking-wide border transition {{ request()->is('empresas*') ? 'bg-blue-800 text-white border-blue-600' : 'bg-white text-[#1e40af] border-gray-200' }}">Empresas</a>
                    <a href="/alunos" class="flex items-center justify-center w-full px-4 py-2.5 rounded-lg shadow-md font-bold text-sm tracking-wide border transition {{ request()->is('alunos*') ? 'bg-blue-800 text-white border-blue-600' : 'bg-white text-[#1e40af] border-gray-200' }}">Alunos</a>
                    <a href="#" class="flex items-center justify-center w-full px-4 py-2.5 rounded-lg shadow-md font-bold text-sm tracking-wide border transition {{ request()->is('vinculos*') ? 'bg-blue-800 text-white border-blue-600' : 'bg-white text-[#1e40af] border-gray-200' }}">Vínculos</a>
                </nav>
            </div>
        </div>

        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="bg-white border-b border-gray-200 h-20 flex items-center justify-between px-8 shadow-sm">
                <h1 class="text-2xl font-extrabold text-[#1e40af] tracking-widest uppercase">ESTÁGIOS E CONVÊNIOS ATENAS</h1>
                <div class="flex items-center gap-4 border-l border-gray-200 pl-6">
                    <div class="text-right">
                        <div class="text-xs text-gray-400 font-medium">Usuário Local</div>
                        <div class="text-sm font-bold text-gray-700">Jéferson Alves</div>
                    </div>
                    <div class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center font-bold text-gray-600 shadow-inner">👤</div>
                </div>
            </header>

            <main class="flex-1 overflow-y-auto bg-gray-50 p-8">
                @if (session()->has('message'))
                    <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded-xl shadow-sm font-medium">
                        ✅ {{ session('message') }}
                    </div>
                @endif 

                @yield('conteudo')

            </main>
        </div>
    </div>

    @livewireScripts
</body>
</html>