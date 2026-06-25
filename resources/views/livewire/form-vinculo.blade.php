<div>
    <div class="bg-gray-200 text-gray-700 px-4 py-2.5 rounded font-bold uppercase text-xs tracking-wider mb-6 shadow-sm">
        {{ $internshipId ? 'Editar Vínculo de Estágio' : 'Novo Vínculo de Estágio' }}
    </div>

    <form wire:submit.prevent="save" class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8 space-y-6">
        <h2 class="text-xl font-extrabold text-gray-900 tracking-tight">Identificação</h2>

        <div class="grid grid-cols-1 md:grid-cols-5 gap-6">
            <div class="md:col-span-2">
                <label class="block text-xs font-extrabold text-gray-700 uppercase tracking-wider mb-2">Aluno:</label>
                <select wire:model.live="student_id" class="w-full px-3 py-2 border border-gray-300 !rounded-xl text-sm shadow-sm bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none transition font-medium text-gray-600">
                    <option value="">Selecionar aluno...</option>
                    @foreach($students as $student)
                        <option value="{{ $student->id }}" wire:key="select-student-{{ $student->id }}">
                            {{ $student->name }} ({{ $student->registration_number }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="md:col-span-2">
                <label class="block text-xs font-extrabold text-gray-700 uppercase tracking-wider mb-2">Empresa:</label>
                <select wire:model.live="company_id" class="w-full px-3 py-2 border border-gray-300 !rounded-xl text-sm shadow-sm bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none transition font-medium text-gray-600">
                    <option value="">Selecionar empresa...</option>
                    @foreach($companies as $company)
                        <option value="{{ $company->id }}" wire:key="select-company-{{ $company->id }}">
                            {{ $company->trading_name ?? $company->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-xs font-extrabold text-gray-700 uppercase tracking-wider mb-2">Status:</label>
                <select wire:model="status" class="w-full px-3 py-2 border border-gray-300 !rounded-xl text-sm shadow-sm bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none transition font-medium text-gray-600">
                    <option value="active">Ativo</option>
                    <option value="finished">Finalizado</option>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
            <div>
                <label class="block text-xs font-extrabold text-gray-700 uppercase tracking-wider mb-2">Modalidade:</label>
                <select wire:model="type" class="w-full px-3 py-2 border border-gray-300 !rounded-xl text-sm shadow-sm bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none transition font-medium text-gray-600">
                    <option value="mandatory">Obrigatório</option>
                    <option value="non_mandatory">Não Obrigatório</option>
                </select>
            </div>

            <div>
                <label class="block text-xs font-extrabold text-gray-700 uppercase tracking-wider mb-2">Atuação:</label>
                <select wire:model="modality" class="w-full px-3 py-2 border border-gray-300 !rounded-xl text-sm shadow-sm bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none transition font-medium text-gray-600">
                    <option value="on_site">Presencial</option>
                    <option value="remote">Remoto</option>
                </select>
            </div>

            <div>
                <label class="block text-xs font-extrabold text-gray-600 uppercase tracking-wider mb-2">Início:</label>
                <input wire:model="start_date" type="date" class="w-full px-3 py-2 border border-gray-300 !rounded-xl text-sm shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none transition text-gray-600">
            </div>

            <div>
                <label class="block text-xs font-extrabold text-gray-600 uppercase tracking-wider mb-2">Término Previsto:</label>
                <input wire:model="estimated_end_date" type="date" class="w-full px-3 py-2 border border-gray-300 !rounded-xl text-sm shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none transition text-gray-600">
            </div>

            <div>
                <label class="block text-xs font-extrabold text-gray-600 uppercase tracking-wider mb-2">Data Real de Término:</label>
                <input wire:model="real_end_date" type="date" class="w-full px-3 py-2 border border-gray-300 !rounded-xl text-sm shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none transition text-gray-600">
            </div>
        </div>

        <div>
            <label class="block text-xs font-extrabold text-gray-700 uppercase tracking-wider mb-2">Observações Gerais:</label>
            <div class="w-full min-h-[120px] px-5 py-4 border border-gray-300 !rounded-xl text-sm shadow-inner bg-gray-50/50 space-y-3 text-gray-600 font-medium">
                <div>
                    <span class="text-xs font-extrabold text-blue-700 uppercase tracking-wide block mb-0.5">Observações do Aluno:</span>
                    <p class="text-gray-700 italic bg-white p-2 rounded-lg border border-gray-100">{{ $student_observations ?: 'Selecione um aluno para ler suas observações...' }}</p>
                </div>
                <div>
                    <span class="text-xs font-extrabold text-blue-700 uppercase tracking-wide block mb-0.5">Observações da Empresa:</span>
                    <p class="text-gray-700 italic bg-white p-2 rounded-lg border border-gray-100">{{ $company_observations ?: 'Selecione uma empresa para ler suas observações...' }}</p>
                </div>
            </div>
        </div>

        <div class="flex justify-end gap-4 pt-4 border-t border-gray-100">
            <a href="/vinculos" class="px-6 py-2.5 border border-gray-300 text-gray-700 text-sm rounded-xl hover:bg-gray-50 transition font-bold uppercase tracking-wider text-center">
                Cancelar
            </a>
            <button type="submit" class="px-8 py-2.5 bg-[#1e40af] text-white text-sm rounded-xl hover:bg-blue-800 transition font-bold uppercase tracking-wider shadow-md">
                {{ $internshipId ? 'Atualizar Vínculo' : 'Salvar Vínculo' }}
            </button>
        </div>
    </form>
</div>