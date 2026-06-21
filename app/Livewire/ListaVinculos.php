<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Internship;
class ListaVinculos extends Component
{
    // Função para deletar o vínculo direto da tabela
    public function delete($id)
    {
        $vinculo = Internship::findOrFail($id);
        $vinculo->delete();
        session()->flash('message', 'Vínculo removido com sucesso');
    }

    // Função para redirecionar para a edição
    public function edit($id)
    {
        return redirect()->to('/vinculos/editar/' . $id);
    }

    public function render()
    {
        return view('livewire.lista-vinculos', [

            'internships' => Internship::with(['student', 'company'])->get()
        ]);
    }
}