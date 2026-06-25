<div>
    <div class="bg-gray-200 text-gray-700 px-4 py-2.5 rounded font-bold uppercase text-xs tracking-wider mb-6 shadow-sm flex justify-between items-center">
        <span>Relatórios e Pesquisas</span>
        <span class="text-[11px] text-gray-500 font-medium lowercase">Estatísticas em tempo real</span>
    </div>

    <form wire:submit.prevent="filtrar" class="bg-white border border-gray-200 rounded-2xl p-5 mb-6 shadow-sm">
        <h3 class="text-xs font-extrabold text-gray-400 uppercase tracking-wider mb-4 flex items-center gap-2">
            📅 Pesquisas por Período
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
            <div>
                <label class="block text-xs font-bold text-gray-600 mb-1.5 uppercase">Data Inicial</label>
                <input wire:model="data_inicial" type="date" class="w-full px-4 py-2 border border-gray-300 rounded-xl text-xs shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none bg-gray-50/50 text-gray-600 font-medium">
                @error('data_inicial') <span class="text-red-500 text-[11px] mt-1 block font-semibold">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-600 mb-1.5 uppercase">Data Final</label>
                <input wire:model="data_final" type="date" class="w-full px-4 py-2 border border-gray-300 rounded-xl text-xs shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none bg-gray-50/50 text-gray-600 font-medium">
                @error('data_final') <span class="text-red-500 text-[11px] mt-1 block font-semibold">{{ $message }}</span> @enderror
            </div>
            <div class="flex gap-2">
                @if($filtrado)
                    <button type="button" wire:click="limparFiltro" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2.5 rounded-xl text-xs font-bold shadow-md transition uppercase tracking-wider">
                        Limpar
                    </button>
                @endif
                <button type="submit" class="w-full bg-[#1e40af] hover:bg-blue-800 text-white px-5 py-2.5 rounded-xl text-xs font-bold shadow-md transition uppercase tracking-wider">
                    🔍 Filtrar Período
                </button>
            </div>
        </div>
    </form>

    @if($filtrado)
        <div class="bg-blue-50 border border-blue-200 rounded-2xl p-5 mb-6 shadow-sm">
            <h3 class="text-xs font-extrabold text-blue-700 uppercase tracking-wider mb-3">
                📌 Resultados do Período Selecionado
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-white p-4 rounded-xl border border-blue-100 flex justify-between items-center shadow-sm">
                    <span class="text-xs font-bold text-gray-700 uppercase">Empresas cadastradas no período:</span>
                    <span class="px-3 py-1 bg-blue-600 text-white font-black rounded-lg text-sm">{{ $empresasNoPeriodo }}</span>
                </div>
                <div class="bg-white p-4 rounded-xl border border-blue-100 flex justify-between items-center shadow-sm">
                    <span class="text-xs font-bold text-gray-700 uppercase">Alunos que iniciaram estágio no período:</span>
                    <span class="px-3 py-1 bg-indigo-600 text-white font-black rounded-lg text-sm">{{ $alunosEstagioNoPeriodo }}</span>
                </div>
            </div>
        </div>
    @endif

    <div class="mb-8">
        <h2 class="text-sm font-black text-gray-700 uppercase tracking-wide mb-4 flex items-center gap-2 border-b border-gray-200 pb-2">
            🏢 Relatórios de Empresas
        </h2>
        
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-4">
            <div class="bg-white border border-gray-200 p-4 rounded-2xl shadow-sm flex items-center justify-between">
                <div>
                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Cadastradas (Total)</p>
                    <h3 class="text-2xl font-black text-gray-800 mt-1">{{ $totalEmpresas }}</h3>
                </div>
                <span class="text-2xl bg-blue-50 p-2 rounded-xl text-blue-600">🏢</span>
            </div>
            <div class="bg-white border border-gray-200 p-4 rounded-2xl shadow-sm flex items-center justify-between">
                <div>
                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Empresas Ativas</p>
                    <h3 class="text-2xl font-black text-green-600 mt-1">{{ $empresasAtivas }}</h3>
                </div>
                <span class="text-2xl bg-green-50 p-2 rounded-xl text-green-600">🟢</span>
            </div>
            <div class="bg-white border border-gray-200 p-4 rounded-2xl shadow-sm flex items-center justify-between">
                <div>
                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Empresas Inativas</p>
                    <h3 class="text-2xl font-black text-red-600 mt-1">{{ $empresasInativas }}</h3>
                </div>
                <span class="text-2xl bg-red-50 p-2 rounded-xl text-red-600">🔴</span>
            </div>
        </div>

        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
            <div class="bg-gray-50 px-5 py-3 border-b border-gray-200">
                <span class="text-xs font-extrabold text-gray-500 uppercase tracking-wider">Empresas Conveniadas por Curso</span>
            </div>
            <div class="p-4 grid grid-cols-1 md:grid-cols-2 gap-3">
                @forelse($empresasPorCurso as $curso => $total)
                    <div class="flex justify-between items-center bg-gray-50 p-3 rounded-xl border border-gray-100">
                        <span class="text-xs font-bold text-gray-700">{{ $curso }}</span>
                        <span class="px-2.5 py-1 bg-blue-100 text-blue-800 text-xs font-black rounded-lg">{{ $total }} {{ $total > 1 ? 'empresas' : 'empresa' }}</span>
                    </div>
                @empty
                    <div class="col-span-2 text-center text-gray-400 text-xs py-4 font-medium">Nenhum convênio vinculado a cursos ainda.</div>
                @endforelse
            </div>
        </div>
    </div>

    <div class="mb-8">
        <h2 class="text-sm font-black text-gray-700 uppercase tracking-wide mb-4 flex items-center gap-2 border-b border-gray-200 pb-2">
            🎓 Relatórios de Estágio
        </h2>
        
        <div class="grid grid-cols-1 sm:grid-cols-4 gap-4 mb-4">
            <div class="bg-white border border-gray-200 p-4 rounded-2xl shadow-sm">
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Estágios Obrigatórios</p>
                <h3 class="text-xl font-black text-gray-800 mt-1">{{ $estagiosObrigatorios }}</h3>
            </div>
            <div class="bg-white border border-gray-200 p-4 rounded-2xl shadow-sm">
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Não Obrigatórios</p>
                <h3 class="text-xl font-black text-gray-800 mt-1">{{ $estagiosNaoObrigatorios }}</h3>
            </div>
            <div class="bg-white border border-gray-200 p-4 rounded-2xl shadow-sm">
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Estágios Ativos</p>
                <h3 class="text-xl font-black text-green-600 mt-1">{{ $estagiosAtivos }}</h3>
            </div>
            <div class="bg-white border border-gray-200 p-4 rounded-2xl shadow-sm">
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Estágios Finalizados</p>
                <h3 class="text-xl font-black text-blue-600 mt-1">{{ $estagiosFinalizados }}</h3>
            </div>
        </div>

        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
            <div class="bg-gray-50 px-5 py-3 border-b border-gray-200">
                <span class="text-xs font-extrabold text-gray-500 uppercase tracking-wider">Quantidade de Estagiários por Curso</span>
            </div>
            <div class="p-4 grid grid-cols-1 md:grid-cols-2 gap-3">
                @forelse($estagiariosPorCurso as $curso => $total)
                    <div class="flex justify-between items-center bg-gray-50 p-3 rounded-xl border border-gray-100">
                        <span class="text-xs font-bold text-gray-700">{{ $curso }}</span>
                        <span class="px-2.5 py-1 bg-indigo-100 text-indigo-800 text-xs font-black rounded-lg">{{ $total }} {{ $total > 1 ? 'Alunos' : 'Aluno' }}</span>
                    </div>
                @empty
                    <div class="col-span-2 text-center text-gray-400 text-xs py-4 font-medium">Nenhum estágio vinculado a alunos atualmente.</div>
                @endforelse
            </div>
        </div>
    </div>
</div>