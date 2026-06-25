<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Internship;

class ListaVinculos extends Component
{
    // Propriedades para ligar aos inputs de filtro da tela
    public $search = '';
    public $status = '';
    public $type = '';
    public $start_date = '';
    public $end_date = '';

    public function delete($id)
    {
        $vinculo = Internship::findOrFail($id);
        $vinculo->delete();
        session()->flash('message', 'Vínculo removido com sucesso!');
    }

    public function edit($id)
    {
        return redirect()->to('/vinculos/editar/' . $id);
    }

    public function render()
    {
        // Cria a query base trazendo os relacionamentos
        $query = Internship::with(['student', 'company']);

        // Filtro por nome do Aluno ou da Empresa (Busca textual)
        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->whereHas('student', function ($sub) {
                    $sub->where('name', 'like', '%' . $this->search . '%');
                })->orWhereHas('company', function ($sub) {
                    $sub->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('trading_name', 'like', '%' . $this->search . '%');
                });
            });
        }

        // Filtro por Status
        if (!empty($this->status) && $this->status !== 'Todos status') {
            $query->where('status', $this->status);
        }

        // Filtro por Modalidade (Type no banco)
        if (!empty($this->type) && $this->type !== 'Todas as modalidades') {
            $query->where('type', $this->type);
        }

        // Filtro por intervalo de datas (Se preenchidas)
        if (!empty($this->start_date)) {
            $query->whereDate('start_date', '>=', $this->start_date);
        }
        if (!empty($this->end_date)) {
            $query->whereDate('estimated_end_date', '<=', $this->end_date);
        }

        // LOGICA NOVA: Ordena pelo nome do aluno usando Subquery segura (substitui o join antigo)
        $query->orderBy(
            \App\Models\Student::select('name')
                ->whereColumn('students.id', 'internships.student_id')
                ->take(1),
            'asc'
        );

        return view('livewire.lista-vinculos', [
            'internships' => $query->get()
        ]);
    }
}
