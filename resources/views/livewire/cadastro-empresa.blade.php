<div class="flex h-screen bg-gray-100 font-sans overflow-hidden">
    <div class="w-64 bg-[#1e40af] text-white flex flex-col justify-between shadow-xl">
        <div>
            <div class="p-6 flex justify-center">
                <div class="w-24 h-24 bg-gray-300 rounded-2xl flex items-center justify-center shadow-inner">
                    <span class="text-gray-500 text-xs font-bold uppercase tracking-wider">Logo</span>
                </div>
            </div>
            <div class="px-6 py-2 text-center border-b border-blue-700/50 font-semibold uppercase tracking-wider text-sm">
                Menu
            </div>
            <nav class="mt-6 px-4 space-y-3">
                <a href="#" class="flex items-center justify-center w-full px-4 py-2.5 bg-white text-[#1e40af] round-lg shadow-md font-bold text-sm tracking-wide border border-gray-200 transition">
                    Painel Geral
                </a>
                <a href="/empresas" class="flex items-center justify-center w-full px-4 py-2.5 bg-white text-[#1e40af] round-lg shadow-md font-bold text-sm tracking-wide border border-gray-200 transition">
                    Empresas
                </a>
                <a href="#" class="flex items-center justify-center w-full px-4 py-2.5 bg-white text-[#1e40af] round-lg shadow-md font-bold text-sm tracking-wide border border-gray-200 transition">
                    Alunos
                </a>
                <a href="#" class="flex items-center justify-center w-full px-4 py-2.5 bg-white text-[#1e40af] round-lg shadow-md font-bold text-sm tracking-wide border border-gray-200 transition">
                    Vínculos de Estágios
                </a>
                <a href="#" class="flex items-center justify-center w-full px-4 py-2.5 bg-white text-[#1e40af] round-lg shadow-md font-bold text-sm tracking-wide border border-gray-200 transition">
                    Relatório
                </a>
            </nav>
        </div>
    </div>
    <div class="flex-1 flex flex-col overflow-hidden">
        <header class="bg-white border-b border-gray-200 h-20 flex items-center justify-between px-8 shadow-sm">
            <h1 class="text-2xl font-extrabold text-[#1e40af] tracking-widset uppercase">
                ESTÁGIOS E CONVÊNIOS
            </h1>
            <div class="flex items-center gap-4 border-l border-gray-200 pl-6">
                <div class="text-right">
                    <div class="text-xs text-gray-400 font-medium">Usuário Local</div>
                    <div class="text-sm font-bold text-gray-700">Jéferson Alves</div>
                </div>
                <div class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center font-bold text-gray-600 shadow-inner">
                    👤
                </div>
            </div>
        </header>
        <main class="flex-1 overflow-y-auto bg-gray-50 p-8">
            @if (session()->has('message'))
            <div class="mg-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded-xl shadow-sm font-medium">
                ✅ {{ session('message') }}
            </div>
            @endif
            <div class="bg-gray-200 text-gray-700 px-4 py-2.5 rounded font-bold uppercase text-xs tracking-wider mb-6 shadow-sm">
                Cadastro de Empresas e Convênio
            </div>
            <form wire:submit.prevent="save" class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8 space-y-6">
                <h2 class="text-xl font-extrabold text-gray-900 tracking-tight">Identificação</h2>
                <div class="bg-gray-50 text-gray-500 px-4 py-1.5 rounded-lg font-bold uppercase text-[11px] tracking-wider border border-gray-100">
                    Dados Jurídicos
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-xs font-extrabold text-gray-700 uppercase tracking-wider mb-2">Razão Social:</label>
                        <input wire:model="name" type="text" class="w-full px-4 py-2 border border-gray-300 round-2xl text-sm shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none transition">
                        @error('name') <span classs="text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-extrabold text-gray-700 uppercase tracking-wider mb-2">Nome Fantasia:</label>
                        <input wire:model="trading_name" type="text" class="w-full px-4 py-2 border border-gray-300 round-2xl text-sm shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none transition">
                        @error('trading_name') <span classs="text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-extrabold text-gray-700 uppercase tracking-wider mb-2">CNPJ:</label>
                        <input wire:model="cnpj" type="text" placeholder="00.000.000/0001-00" class="w-full px-4 py-2 border border-gray-300 round-2xl text-sm shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none transition font-mono">
                        @error('cnpj') <span classs="text-red-500">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="col-span-1 md:col-span-2">
                        <label class="block text-xs font-extrabold tex-gray-700 uppercase tracking-wider mb-2">Representante Legal:</label>
                        <input wire:model="representative" type="text" class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none transition">
                        @error('representative') <span class="text-red-500 text-xs mt-1 block font-medium">{{ $message }}</span>@enderror
                    </div>
                    <div>
                        <label class="block text-xs font-extrabold text-gray-700 uppercase tracking-wider mb-2">Contato Adicional:</label>
                        <input type="text" placeholder="(38) 99999-9999" class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none transition">
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-5 gap-4 pt-2">
                    <div>
                        <label class="block text-xs font-extrabold text-gray-700 uppercase tracking-wider mb-2">Status de Vínculo:</label>
                        <select wire:model="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm shadow-sm bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none transition font-medium">
                            <option value="active">Ativo</option>
                            <option value="inactive">Inativo</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-extrabold text-gray-700 uppercase tracking-wider mb-2">Tipo de Estágio:</label>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm shadow-sm bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none transition font-medium">
                            <option value="mandatory">Obrigatório</option>
                            <option value="non_mandatory">Não Obrigatório</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-extrabold text-gray-700 uppercase tracking-wider mb-2">Modalidade:</label>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm shadow-sm bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none transition font-medium">
                            <option value="on_site">Presencial</option>
                            <option value="remote">Remoto</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-extrabold text-gray-600 uppercase tracking-wider mb-2">Data de Início:</label>
                        <input wire:model="relationship_start_date" type="date" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none transition">
                        @error('relationship_start_date') <span class="text-red-500 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-extrabold text-gray-600 uppercase tracking-wider mb-2">Data de Término:</label>
                        <input wire:model="relationship_end_date" type="date" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none transition">
                        @error('relationship_end_date') <span class="text-red-500 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="space-y-2 pt-2 relative">
                    <label class="block text-xs font-extrabold text-gray-700 uppercase tracking-wider">Cursos com estágios autorizados:</label>

                    <button type="button" wire:click="$toggle('showCoursesDropdown')" class="w-full flex items-center justify-between px-4 py-2.5 bg-white border border-gray-300 rounded-xl text-sm shadow-sm text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 transition font-medium">
                        <span>
                            @if(count($select_courses) === 0)
                            Selecionar Cursos...
                            @else
                            {{ count($select_courses) }} curso(s) selecionado(s)
                            @endif
                        </span>
                        <svg class="w-5 h-5 text-gray-400 transition-transform {{ $showCoursesDropdown ? 'rotate-180' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>

                    @if($showCoursesDropdown)
                    <div class="absolute z-50 w-full mt-1 bg-white p-4 rounded-xl border border-gray-200 shadow-xl max-h-60 overflow-y-auto animate-fadeIn">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                            @foreach($avaliable_courses as $course)
                            <label class="flex items-center space-x-3 text-xs text-gray-700 cursor-pointer p-2 bg-gray-50 hover:bg-blue-50 rounded-lg shadow-sm border border-gray-100 hover:border-blue-200 transition font-medium">
                                <input type="checkbox" wire:model="select_courses" value="{{ $course }}" class="rounded text-blue-600 focus:ring-blue-500 h-4 w-4 border-gray-300">
                                <span>{{ $course }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    @error('select_courses') <span class="text-red-500 text-xs font-medium block">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-xs font-extrabold text-gray-700 uppercase tracking-wider mb-2">Observações Gerais:</label>
                    <textarea wire:model="observations" rows="4" placeholder="Insira observações adicionais sobre o convênio da empresa..." class="w-full px-4 py-3 border border-gray-300 rounded-xl text-sm shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none transition resize-none"></textarea>
                    @error('observations') <span class="text-red-500 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
                </div>
                <div class="flex justify-end gap-4 pt-4 border-t border-gray-100">
                    <button type="button" class="px-6 py-2.5 border border-gray-300 text-gray-700 text-sm rounded-xl hover:bg-gray-50 transition font-bold uppercase tracking-wider">
                        Limpar
                    </button>
                    <button type="submit" class="px-8 py-2.5 bg-[#1e40af] text-white text-sm rounded-xl hover:bg-blue-800 transition font-bold uppercase tracking-wider shadow-md">
                        Salvar Dados
                    </button>
                </div>
            </form>
        </main>
    </div>
</div>