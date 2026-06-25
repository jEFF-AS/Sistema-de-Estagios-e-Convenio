<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Notification;

class ComponenteSino extends Component
{
    // Escuta eventos caso outras telas queiram atualizar o sino
    protected $listeners = ['atualizarSino' => '$refresh'];

    public function marcarComoLida($id)
    {
        $notificacao = Notification::findOrFail($id);
        $notificacao->update(['is_read' => true]);
        
        // Emite um evento global para atualizar o Painel Geral também se necessário
        $this->dispatch('notificacaoLida');
    }

    public function render()
    {
        return view('livewire.componente-sino', [
            'notificacoes' => Notification::where('is_read', false)->latest()->get(),
            'totalNaoLidas' => Notification::where('is_read', false)->count()
        ]);
    }
}