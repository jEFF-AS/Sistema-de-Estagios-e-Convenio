<?php

namespace App\Livewire;
use Livewire\Component;
use Livewire\Attributes\Layouts;
use App\Models\Company;

class CadastroEmpresa extends Component
{
    // 1. PROPRIEDADES 
    // No Livewire v3 tradicional, toda propriedade pública vira uma variável reativa.
    // O que o usuário digita no HTML altera essas variáveis em tempo real.

    public $companyId = null;
    public $name = ''; 
    public $trading_name = '';
    public $cnpj = '';
    public $representative = '';
    public $phone = '';
    public $relationship_start_date = '';
    public $relationship_end_date = '';
    public $select_courses = [];
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

    // 2. REGRAS DE VALIDAÇÃO E SALVAMENTO
    // Esta função sera chamada quando o botão "Salvar Dados" for clicado
    public function save()
    {
        // O método $this->validate intercepta o envio se houver campos em branco
        // Ou regras desrespeitadas, devolvendo erros especificos para a tela.
        $this->validate([
            'name' => 'required|string|max:255',
            'trading_name' => 'required|string|max:255',
            'cnpj' => 'required|string|max:18',
            'representative' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'relationship_start_date' => 'required|date',
            // Garante que o convênio não termine antes de começar
            'relationship_end_date' => 'required|date|after_or_equal:relationship_start_date',
            'select_courses' => 'required|array|min:1', // Exige pelo menos 1 curso
            'status' => 'required|in:active,inactive',
            'observations' => 'nullable|string|max:1000',
        ]);

        // Se  $this->companyId for nulo, ele executa um "INSERT INTO companies..."
        // Se contiver um número, ele faz um "UPDATE companies SET ... WHERE id = X"
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
                'courses' => $this->select_courses, // O Laravel convertera o array em texto/json para o banco
                'status' => $this->status,
                'observations' => $this->observations,
            ]
        );
        
        // Guarda uma mensagem tempóraria na sessão para exibir o alerta verde de sucesso
        session()->flash('message', 'Empresa salva com sucesso no banco de dados!');

        // Limpa os campos do formulário para o próximo cadastro
        $this->resetForm();
    }

    // Função auxiliar interna para limpar os estados das variáveis
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
    // Este método indica ao Laravel qual é o arquivo visual que representa este componente.
    public function render()
    {
        return view('livewire.cadastro-empresa');
    }
}