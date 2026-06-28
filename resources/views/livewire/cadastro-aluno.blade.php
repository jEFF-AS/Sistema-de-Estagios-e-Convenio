<div>
    <div class="bg-gray-200 text-gray-700 px-4 py-2.5 rounded font-bold uppercase text-xs tracking-wider mb-6 shadow-sm">
        Cadastro de Aluno
    </div>

    <form wire:submit.prevent="save" class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8 space-y-6">

        <h2 class="text-xl font-extrabold text-gray-900 tracking-tight">Identificação</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <label class="block text-xs font-extrabold text-gray-700 uppercase tracking-wider mb-2">Nome do Aluno:</label>
                <input wire:model="name" type="text" class="w-full px-4 py-2 border border-gray-300 !rounded-xl text-sm shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none transition">
                @error('name') <span class="text-red-500 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-xs font-extrabold text-gray-700 uppercase tracking-wider mb-2">Matrícula:</label>
                <input wire:model="registration_number" type="text" class="w-full px-4 py-2 border border-gray-300 !rounded-xl text-sm shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none transition font-mono">
                @error('registration_number') <span class="text-red-500 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-xs font-extrabold text-gray-700 uppercase tracking-wider mb-2">Curso:</label>
                <select wire:model="course" class="w-full px-3 py-2 border border-gray-300 !rounded-xl text-sm shadow-sm bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none transition font-medium text-gray-600">
                    <option value="">Selecione o curso</option>
                    @foreach($available_courses as $available_course)
                    <option value="{{ $available_course }}">{{ $available_course }}</option>
                    @endforeach
                </select>
                @error('course') <span class="text-red-500 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <label class="block text-xs font-extrabold text-gray-700 uppercase tracking-wider mb-2">Período:</label>
                <select wire:model="period" class="w-full px-3 py-2 border border-gray-300 !rounded-xl text-sm shadow-sm bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none transition font-medium text-gray-600">
                    <option value="">Selecione...</option>
                    @for ($i = 1; $i <= 12; $i++)
                        <option value="{{ $i }}">{{ $i }}º Período</option>
                        @endfor
                </select>
                @error('period') <span class="text-red-500 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
            </div>

            <div class="flex flex-col">
                <label class="block text-xs font-bold text-gray-600 mb-1.5 uppercase">Contato Adicional:</label>
                <div x-data="{
                    mask(value) {
                        if (!value) return '';
                        value = value.replace(/\D/g, '');
                        if (value.length <= 10) {
                            return value.replace(/^(\d{2})(\d{4})(\d{0,4})$/, '($1) $2-$3');
                        }
                        return value.replace(/^(\d{2})(\d{5})(\d{0,4})$/, '($1) $2-$3');
                    }
                }">
                    <input
                        wire:model.blur="phone"
                        type="text"
                        x-on:input="$el.value = mask($el.value)"
                        placeholder="(38) 99999-9999"
                        maxlength="15"
                        class="w-full px-4 py-2 border border-gray-300 rounded-xl text-xs shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none bg-gray-50/50 text-gray-600 font-medium">
                </div>
                @error('phone') <span class="text-red-500 text-[11px] mt-1 block font-semibold">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-xs font-extrabold text-gray-600 uppercase tracking-wider mb-2">Data de Início do Curso:</label>
                <input wire:model="course_start_date" type="date" class="w-full px-3 py-2 border border-gray-300 !rounded-xl text-sm shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none transition">
                @error('course_start_date') <span class="text-red-500 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
            </div>
        </div>

        <div>
            <label class="block text-xs font-extrabold text-gray-700 uppercase tracking-wider mb-2">Observações Gerais:</label>
            <textarea
                wire:model="observations"
                rows="4"
                class="w-full px-4 py-3 border border-gray-300 !rounded-xl text-sm shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none transition resize-none bg-gray-50/50 text-gray-600 font-medium"
                placeholder="Digite observações adicionais sobre o aluno se necessário..."></textarea>
            @error('observations')
            <span class="text-red-500 text-[11px] mt-1 block font-semibold">{{ $message }}</span>
            @enderror
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
</div>