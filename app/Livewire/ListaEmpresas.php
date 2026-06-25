<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Company;

class ListaEmpresas extends Component
{
    // Propriedades dos Filtros reativos
    public $search = '';
    public $status = '';
    public $course_filter = '';
    public $start_date = '';
    public $end_date = '';

    public function delete($id)
    {
        $company = Company::findOrFail($id);
        $company->delete();
        session()->flash('message', 'Empresa removida com sucesso!');
    }

    public function edit($id)
    {
        return redirect()->to('/empresas/editar/' . $id);
    }

    public function render()
    {
        $query = Company::query();

        // Busca por Nome, Nome Fantasia, CNPJ ou Responsável
        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('trading_name', 'like', '%' . $this->search . '%')
                  ->orWhere('cnpj', 'like', '%' . $this->search . '%')
                  ->orWhere('representative', 'like', '%' . $this->search . '%');
            });
        }

        // Filtro de Status
        if (!empty($this->status)) {
            $query->where('status', $this->status);
        }

        // Filtro de Cursos (Como está salvo em JSON/Array no banco, usamos o JSON_CONTAINS do MySQL)
        if (!empty($this->course_filter)) {
            $query->whereJsonContains('courses', $this->course_filter);
        }

        // Filtro por Período de Convênio (Início e Término)
        if (!empty($this->start_date)) {
            $query->whereDate('relationship_start_date', '>=', $this->start_date);
        }
        if (!empty($this->end_date)) {
            $query->whereDate('relationship_end_date', '<=', $this->end_date);
        }

        // Extrai uma lista limpa de cursos únicos cadastrados para popular o select de filtro
        // Faz uma varredura simples nos arrays de empresas para o select não ficar vazio
        $allCompanies = Company::all();
        $availableCourses = [];
        foreach ($allCompanies as $c) {
            if (is_array($c->courses)) {
                $availableCourses = array_merge($availableCourses, $c->courses);
            }
        }
        $availableCourses = array_unique($availableCourses);
        sort($availableCourses);

        return view('livewire.lista-empresas', [
            'companies' => $query->orderBy('name', 'asc')->get(),
            'availableCourses' => $availableCourses
        ]);
    }
}