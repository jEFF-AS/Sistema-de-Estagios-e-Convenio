<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layouts;
use App\Models\Company;

class CadastroEmpresa extends Component
{
    // 1. PROPRIEDADES 
    public $companyId = null;
    public $name = ''; 
    public $trading_name = '';
    public $cnpj = '';
    public $representative = '';
    public $phone = '';
    public $relationship_start_date = '';
    public $relationship_end_date = '';
    public $select_courses = []; // Mapeia o campo 'courses' do banco nesta propriedade
    public $status = 'active';
    public $observations = '';
    public $showCoursesDropdown = false;

    public $avaliable_courses = [
        'Administração',
        'Agronomia',
        'Análise e Desenvolvimento de Sistemas',
        'Contabilidade',
        'Direito',
        'Engenharia Civil',
        'Medicina',
        'Odontologia',
        'Sistemas de Informação',
    ];

    // GATILHO DE CARREGAMENTO (Essencial para a Edição funcionar!)
    public function mount($companyId = null)
    {
        if ($companyId) {
            $this->companyId = $companyId;
            
            // Busca a empresa existente no banco
            $company = Company::findOrFail($companyId);
            
            // Popula os campos do formulário para edição
            $this->name = $company->name;
            $this->trading_name = $company->trading_name;
            $this->cnpj = $company->cnpj;
            $this->representative = $company->representative;
            $this->phone = $company->phone;
            
            // Converte os objetos de data do Carbon para texto no formato aceito pelo input HTML (ano-mes-dia)
            $this->relationship_start_date = $company->relationship_start_date ? $company->relationship_start_date->format('Y-m-d') : '';
            $this->relationship_end_date = $company->relationship_end_date ? $company->relationship_end_date->format('Y-m-d') : '';
            
            // Garante que os cursos venham como array para o formulário
            $this->select_courses = is_array($company->courses) ? $company->courses : [];
            $this->status = $company->status;
            $this->observations = $company->observations;
        }
    }

    // 2. REGRAS DE VALIDAÇÃO E SALVAMENTO
public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'trading_name' => 'required|string|max:255',
            // CNPJ ÚNICO INTELIGENTE: Ignora o ID atual caso seja uma edição de cadastro
            'cnpj' => 'required|string|max:25|unique:companies,cnpj,' . ($this->companyId ?? 'NULL'),
            'representative' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'relationship_start_date' => 'required|date',
            'relationship_end_date' => 'required|date|after_or_equal:relationship_start_date',
            'select_courses' => 'required|array|min:1', 
            'status' => 'required|in:active,inactive',
            'observations' => 'nullable|string|max:1000',
        ], [
            // Mensagens customizadas que aparecem na tela para o usuário
            'cnpj.unique' => 'Este CNPJ já está cadastrado para outra empresa conveniada.',
            'cnpj.required' => 'O campo CNPJ é obrigatório.',
            'select_courses.required' => 'Selecione pelo menos um curso vinculado ao convênio.',
            'relationship_end_date.after_or_equal' => 'A data de término deve ser igual ou posterior à data de início.',
        ]);

        Company::updateOrCreate(
            ['id' => $this->companyId],
            [
                'name' => $this->name,
                'trading_name' => $this->trading_name,
                'cnpj' => $this->cnpj, 
                'representative' => $this->representative,
                'phone' => $this->phone,
                'relationship_start_date' => $this->relationship_start_date,   
                'relationship_end_date' => $this->relationship_end_date,
                'courses' => $this->select_courses, 
                'status' => $this->status,
                'observations' => $this->observations,
            ]
        );
        
        // Mensagem dinâmica baseada na ação executada
        session()->flash('message', $this->companyId ? 'Convênio atualizado com sucesso!' : 'Empresa cadastrada com sucesso!');

        // Em vez de só resetar, redireciona o usuário de volta para a listagem principal
        return redirect()->to('/empresas');
    }

    // Função auxiliar interna (mantida caso precise usar)
    private function resetForm()
    {
        $this->companyId = null;
        $this->name = '';
        $this->trading_name = '';
        $this->cnpj = '';
        $this->representative = '';
        $this->phone = '';
        $this->relationship_start_date = '';
        $this->relationship_end_date = '';
        $this->select_courses = [];
        $this->status = 'active';
        $this->observations = '';
    }

    // 3. RENDERIZAÇÃO
    public function render()
    {
        return view('livewire.cadastro-empresa');
    }
}