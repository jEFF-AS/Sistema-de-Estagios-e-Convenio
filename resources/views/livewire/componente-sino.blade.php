<div class="relative" x-data="{ open: false }">
    <button x-on:click="open = !open" type="button" class="relative p-2 text-gray-600 hover:text-blue-600 transition focus:outline-none flex items-center justify-center">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
        </svg>

        @if($totalNaoLidas > 0)
            <span class="absolute top-0 right-0 inline-flex items-center justify-center px-1.5 py-0.5 text-[10px] font-black leading-none text-white bg-amber-500 rounded-full shadow-sm transform translate-x-1 -translate-y-1">
                {{ $totalNaoLidas }}
            </span>
        @endif
    </button>

    <div x-show="open" 
         x-on:click.outside="open = false"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-75"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="absolute right-0 mt-3 w-80 bg-white border border-gray-200 rounded-2xl shadow-xl overflow-hidden z-50 transform origin-top-right"
         style="display: none;">
        
        <div class="bg-gray-50 px-4 py-3 border-b border-gray-100 flex justify-between items-center">
            <span class="text-xs font-extrabold text-gray-500 uppercase tracking-wider">Notificações</span>
            <span class="px-2 py-0.5 bg-gray-200 text-[10px] font-bold text-gray-600 rounded-md">{{ $totalNaoLidas }} novas</span>
        </div>

        <div class="divide-y divide-gray-50 max-h-64 overflow-y-auto">
            @forelse($notificacoes as $notificacao)
                <div class="p-4 hover:bg-gray-50/70 transition flex flex-col gap-1.5 relative group">
                    <div class="flex justify-between items-start gap-2">
                        <span class="text-xs font-black text-gray-800 leading-tight">
                            {{ $notificacao->title }}
                        </span>
                        <button wire:click="marcarComoLida({{ $notificacao->id }})" title="Marcar como lida" class="text-gray-400 hover:text-green-600 transition text-sm focus:outline-none">
                            ✓
                        </button>
                    </div>
                    <p class="text-[11px] text-gray-500 font-medium leading-normal">
                        {{ $notificacao->message }}
                    </p>
                    <span class="text-[9px] text-gray-400 font-semibold font-mono">
                        {{ $notificacao->created_at->diffForHumans() }}
                    </span>
                </div>
            @empty
                <div class="p-6 text-center text-gray-400 text-xs font-medium">
                    🎉 Nenhuma notificação pendente!
                </div>
            @endforelse
        </div>
    </div>
</div>