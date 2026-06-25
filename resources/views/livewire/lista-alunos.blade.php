<div>
    <div class="bg-gray-200 text-gray-700 px-4 py-2.5 rounded font-bold uppercase text-xs tracking-wider mb-6 shadow-sm flex justify-between items-center">
        <span>Alunos</span>
        <span class="text-[11px] text-gray-500 font-medium lowercase">{{ $students->count() }} Alunos registrados</span>
    </div>

    <div class="flex justify-end mb-4">
        <a href="/alunos/novo" class="bg-[#1e40af] hover:bg-blue-800 text-white px-5 py-2 rounded-xl text-sm font-bold shadow-md transition flex items-center gap-2">
            <span class="text-base font-black">+</span> Novo Aluno
        </a>
    </div>

    <div class="bg-white border border-gray-200 rounded-2xl p-4 mb-6 shadow-sm flex gap-4 items-center">
        <div class="flex-1 relative">
            <input wire:model.live="search" type="text" placeholder="🔍 Buscar por nome ou matrícula..." class="w-full pl-4 pr-3 py-2 border border-gray-300 rounded-xl text-xs shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none bg-gray-50/50 text-gray-600 font-medium">
        </div>
        
        <div class="w-64">
            <select wire:model.live="course_filter" class="w-full px-3 py-2 border border-gray-300 rounded-xl text-xs shadow-sm bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none text-gray-600 font-medium">
                <option value="">Todos os cursos</option>
                @foreach($availableCourses as $course)
                    <option value="{{ $course }}">{{ $course }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden mb-8">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-100/75 border-b border-gray-200 text-[11px] font-extrabold text-gray-500 uppercase tracking-wider">
                    <th class="px-6 py-3.5">Aluno</th>
                    <th class="px-6 py-3.5">Matrícula</th>
                    <th class="px-6 py-3.5">Curso</th>
                    <th class="px-6 py-3.5 text-center">Período</th>
                    <th class="px-6 py-3.5 text-center">Início do Curso</th>
                    <th class="px-6 py-3.5 text-center">Ações</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-sm">
                @forelse($students as $student)
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="px-6 py-4 font-bold text-gray-800">{{ $student->name }}</td>
                        <td class="px-6 py-4 font-mono text-xs text-gray-600 font-semibold">{{ $student->registration_number }}</td>
                        <td class="px-6 py-4 font-semibold text-gray-700">{{ $student->course }}</td>
                        <td class="px-6 py-4 text-center">
                            <span class="px-2.5 py-1 bg-gray-100 border border-gray-200 rounded-lg text-xs font-bold text-gray-600 shadow-sm">
                                {{ $student->period }}º Período
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center font-mono text-gray-600 text-xs">
                            {{ $student->course_start_date ? $student->course_start_date->format('d/m/Y') : '--' }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex justify-center gap-3 text-gray-500">
                                <button wire:click="edit({{ $student->id }})" type="button" class="hover:text-blue-600 transition text-base">✏️</button>
                                <button wire:click="delete({{ $student->id }})" wire:confirm="Tem certeza que deseja remover este aluno?" type="button" class="hover:text-red-600 transition text-base">🗑️</button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-400 font-medium">
                            🎓 Nenhum aluno cadastrado ou encontrado com esses filtros.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>