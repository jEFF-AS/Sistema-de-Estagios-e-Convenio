<div>
    <div class="bg-gray-200 text-gray-700 px-4 py-2.5 rounded font-bold uppercase text-xs tracking-wider mb-6 shadow-sm flex justify-between items-center">
        <span>Empresas Conveniadas</span>
        <span class="text-[11px] text-gray-500 font-medium lowercase">{{ $companies->count() }} empresa(s) cadastrada(s)</span>
    </div>

    <div class="flex justify-end mb-4">
        <a href="/empresas/novo" class="bg-[#1e40af] hover:bg-blue-800 text-white px-5 py-2 rounded-xl text-sm font-bold shadow-md transition flex items-center gap-2">
            <span class="text-base font-black">+</span> Nova Empresa
        </a>
    </div>

    <div class="bg-white border border-gray-200 rounded-2xl p-4 mb-6 shadow-sm grid grid-cols-1 md:grid-cols-5 gap-4 items-center">
        <div>
            <input wire:model.live="search" type="text" placeholder="🔍 Buscar empresas..." class="w-full pl-4 pr-3 py-2 border border-gray-300 rounded-xl text-xs shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none bg-gray-50/50">
        </div>
        
        <select wire:model.live="status" class="w-full px-3 py-2 border border-gray-300 rounded-xl text-xs shadow-sm bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none text-gray-600 font-medium">
            <option value="">Todos os status</option>
            <option value="active">Ativo</option>
            <option value="inactive">Inativo</option>
        </select>

        <select wire:model.live="course_filter" class="w-full px-3 py-2 border border-gray-300 rounded-xl text-xs shadow-sm bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none text-gray-600 font-medium">
            <option value="">Todos os cursos</option>
            @foreach($availableCourses as $course)
                <option value="{{ $course }}">{{ $course }}</option>
            @endforeach
        </select>

        <input wire:model.live="start_date" type="date" class="w-full px-3 py-1.5 border border-gray-300 rounded-xl text-xs shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none text-gray-500">

        <input wire:model.live="end_date" type="date" class="w-full px-3 py-1.5 border border-gray-300 rounded-xl text-xs shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none text-gray-500">
    </div>

    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-100/75 border-b border-gray-200 text-[11px] font-extrabold text-gray-500 uppercase tracking-wider">
                    <th class="px-6 py-3.5">Empresa</th>
                    <th class="px-6 py-3.5">CNPJ</th>
                    <th class="px-6 py-3.5">Responsável</th>
                    <th class="px-6 py-3.5 text-center">Vínculo</th>
                    <th class="px-6 py-3.5 text-center">Cursos</th>
                    <th class="px-6 py-3.5 text-center">Status</th>
                    <th class="px-6 py-3.5 text-center">Ações</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-sm">
                @forelse($companies as $company)
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="px-6 py-4">
                            <div class="font-bold text-gray-800">{{ $company->name }}</div>
                            @if($company->trading_name)
                                <div class="text-[11px] text-gray-400 font-medium">{{ $company->trading_name }}</div>
                            @endif
                        </td>
                        
                        <td class="px-6 py-4 font-medium text-gray-600 font-mono text-xs">{{ $company->cnpj }}</td>
                        
                        <td class="px-6 py-4 text-gray-700 font-semibold">{{ $company->representative }}</td>
                        
                        <td class="px-6 py-4 text-center font-mono text-gray-600 text-xs whitespace-nowrap">
                            <div>{{ $company->relationship_start_date ? $company->relationship_start_date->format('d/m/Y') : '--' }}</div>
                            <div class="text-[10px] text-gray-400 font-sans font-medium">até</div>
                            <div class="font-bold text-gray-700">{{ $company->relationship_end_date ? $company->relationship_end_date->format('d/m/Y') : '--' }}</div>
                        </td>
                        
                        <td class="px-6 py-4 text-center">
                            @if(is_array($company->courses) && count($company->courses) > 0)
                                <div class="flex justify-center items-center gap-1.5">
                                    <span class="px-2 py-0.5 bg-gray-100 text-gray-700 border border-gray-200 rounded text-[11px] font-medium max-w-[120px] truncate" title="{{ $company->courses[0] }}">
                                        {{ $company->courses[0] }}
                                    </span>

                                    @if(count($company->courses) > 1)
                                        <div class="relative group inline-block">
                                            <span class="px-1.5 py-0.5 bg-blue-50 text-blue-700 border border-blue-200 rounded text-[11px] font-bold cursor-pointer hover:bg-blue-100">
                                                +{{ count($company->courses) - 1 }}
                                            </span>
                                            
                                            <div class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 w-48 bg-gray-900 text-white text-[11px] rounded-lg p-2 shadow-xl opacity-0 scale-95 pointer-events-none group-hover:opacity-100 group-hover:scale-100 transition-all duration-200 z-50 text-left space-y-1">
                                                <div class="font-bold border-b border-gray-700 pb-1 mb-1 text-blue-400">Outros Cursos:</div>
                                                @foreach(array_slice($company->courses, 1) as $otherCourse)
                                                    <div class="truncate">• {{ $otherCourse }}</div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @else
                                <span class="text-xs text-gray-400">Nenhum</span>
                            @endif
                        </td>

                        <td class="px-6 py-4 text-center">
                            @if($company->status == 'active' || $company->status == 'Ativo')
                                <span class="px-3 py-1 bg-green-100 text-green-700 border border-green-300 rounded-full text-xs font-bold shadow-sm">Ativo</span>
                            @else
                                <span class="px-3 py-1 bg-gray-100 text-gray-600 border border-gray-300 rounded-full text-xs font-bold shadow-sm">Inativo</span>
                            @endif
                        </td>

                        <td class="px-6 py-4 text-center">
                            <div class="flex justify-center gap-3 text-gray-500">
                                <button wire:click="edit({{ $company->id }})" type="button" class="hover:text-blue-600 transition text-base">✏️</button>
                                <button wire:click="delete({{ $company->id }})" wire:confirm="Tem certeza que deseja remover este convênio?" type="button" class="hover:text-red-600 transition text-base">🗑️</button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-gray-400 font-medium">
                            🏢 Nenhuma empresa conveniada encontrada com os critérios informados.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>