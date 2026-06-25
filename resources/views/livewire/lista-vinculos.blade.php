<div>
    <div class="bg-gray-200 text-gray-700 px-4 py-2.5 rounded font-bold uppercase text-xs tracking-wider mb-6 shadow-sm flex justify-between items-center">
        <span>Vínculos de Estágio</span>
        <span class="text-[11px] text-gray-500 font-medium lowercase">{{ $internships->count() }} vínculo(s) registrado(s)</span>
    </div>

    <div class="flex justify-end mb-4">
        <a href="/vinculos/novo" class="bg-[#1e40af] hover:bg-blue-800 text-white px-5 py-2 rounded-xl text-sm font-bold shadow-md transition flex items-center gap-2">
            <span class="text-base font-black">+</span> Novo Vínculo
        </a>
    </div>

    <div class="bg-white border border-gray-200 rounded-2xl p-4 mb-6 shadow-sm grid grid-cols-1 md:grid-cols-5 gap-4 items-center">
        <div class="relative md:col-span-1.5">
            <input wire:model.live="search" type="text" placeholder="🔍 Buscar por aluno ou empresas..." class="w-full pl-4 pr-3 py-2 border border-gray-300 rounded-xl text-xs shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none bg-gray-50/50">
        </div>
        
        <select wire:model.live="status" class="w-full px-3 py-2 border border-gray-300 rounded-xl text-xs shadow-sm bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none text-gray-600 font-medium">
            <option value="">Todos status</option>
            <option value="active">Ativo</option>
            <option value="finished">Finalizado</option>
        </select>

        <select wire:model.live="type" class="w-full px-3 py-2 border border-gray-300 rounded-xl text-xs shadow-sm bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none text-gray-600 font-medium">
            <option value="">Todas as modalidades</option>
            <option value="mandatory">Obrigatório</option>
            <option value="non_mandatory">Não Obrigatório</option>
        </select>

        <input wire:model.live="start_date" type="date" class="w-full px-3 py-1.5 border border-gray-300 rounded-xl text-xs shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none text-gray-500">

        <input wire:model.live="end_date" type="date" class="w-full px-3 py-1.5 border border-gray-300 rounded-xl text-xs shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none text-gray-500">
    </div>

    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-100/75 border-b border-gray-200 text-[11px] font-extrabold text-gray-500 uppercase tracking-wider">
                    <th class="px-6 py-3.5">Aluno</th>
                    <th class="px-6 py-3.5">Empresa</th>
                    <th class="px-6 py-3.5 text-center">Modalidade</th>
                    <th class="px-6 py-3.5 text-center">Atuação</th>
                    <th class="px-6 py-3.5 text-center">Início</th>
                    <th class="px-6 py-3.5 text-center">Término Previsto</th>
                    <th class="px-6 py-3.5 text-center">Status</th>
                    <th class="px-6 py-3.5 text-center">Ações</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-sm">
                
                @php $linhasRenderizadas = 0; @endphp

                @foreach($internships as $internship)
                    {{-- 🌟 SÓ INSERE A LINHA SE OS DOIS LADOS DO RELACIONAMENTO EXISTIREM NO BANCO --}}
                    @if($internship->student && $internship->company)
                        @php $linhasRenderizadas++; @endphp
                        <tr class="hover:bg-gray-50/50 transition">
                            <td class="px-6 py-4">
                                <div class="font-bold text-gray-800">{{ $internship->student->name }}</div>
                                <div class="text-[11px] text-gray-400 font-medium">{{ $internship->student->course ?? '--'}}</div>
                            </td>
                            
                            <td class="px-6 py-4 font-semibold text-gray-700">{{ $internship->company->name }}</td>
                            
                            <td class="px-6 py-4 text-center">
                                <span class="px-3 py-1 bg-gray-200 text-gray-700 rounded-lg text-xs font-bold border border-gray-300/50">
                                    {{ $internship->type == 'mandatory' ? 'Obrigatório' : 'Não Obrigatório' }}
                                </span>
                            </td>
                            
                            <td class="px-6 py-4 text-center font-medium text-gray-600">
                                {{ $internship->modality == 'on_site' ? 'Presencial' : 'Remoto' }}
                            </td>
                            
                            <td class="px-6 py-4 text-center font-mono text-gray-600 text-xs">
                                {{ \Carbon\Carbon::parse($internship->start_date)->format('d/m/Y') }}
                            </td>
                            
                            <td class="px-6 py-4 text-center font-mono text-gray-700 font-bold text-xs">
                                <div>{{ \Carbon\Carbon::parse($internship->estimated_end_date)->format('d/m/Y') }}</div>
        
                                @if($internship->real_end_date)
                                    <div class="text-[11px] text-green-600 font-semibold mt-0.5 tracking-wide">
                                        Real: {{ \Carbon\Carbon::parse($internship->real_end_date)->format('d/m/Y') }}
                                    </div>
                                @endif
                            </td>
                            
                            <td class="px-6 py-4 text-center">
                                @if($internship->status == 'active')
                                    <span class="px-3 py-1 bg-green-100 text-green-700 border border-green-300 rounded-full text-xs font-bold shadow-sm">Ativo</span>
                                @else
                                    <span class="px-3 py-1 bg-gray-100 text-gray-600 border border-gray-300 rounded-full text-xs font-bold shadow-sm">Finalizado</span>
                                @endif
                            </td>
                            
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center gap-3 text-gray-500">
                                    <button wire:click="edit({{ $internship->id }})" type="button" class="hover:text-blue-600 transition text-base">✏️</button>
                                    
                                    <button wire:click="delete({{ $internship->id }})" wire:confirm="Tem certeza que deseja excluir este vínculo?" type="button" class="hover:text-red-600 transition text-base">🗑️</button>
                                </div>
                            </td>
                        </tr>
                    @endif
                @endforeach

                {{-- Se nenhuma linha foi renderizada (ou porque a tabela está vazia ou porque os dados eram órfãos) --}}
                @if($linhasRenderizadas === 0)
                    <tr>
                        <td colspan="8" class="px-6 py-12 text-center text-gray-400 font-medium">
                            📭 Nenhum vínculo de estágio válido ou cadastrado no sistema até o momento.
                        </td>
                    </tr>
                @endif

            </tbody>
        </table>
    </div>
</div>