<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Student;
use App\Models\Company;
use App\Models\Internship;

class FormVinculo extends Component
{
    // ID para controle Hibrido (Cadastro vc Edição)
    public $internshipId = null;
    // propriedades do Formulário 
    public $student_id;
    public $company_id;
    public $status = 'active';
    public $type = 'mandatory';
    public $modality = 'on_site';
    public $start_date;
    public $estimated_end_date;
    public $real_end_date;

    // Propriedades de leitura Dinâmica 
    public $student_observations = '';
    public $company_observations = '';

    // Roda automaticamente ao carregar o componente
    public function mount($internshipId = null)
    {
        if ($internshipId) {
            $this->internshipId = $internshipId;
            // Quando formos fazer a edição, os dados serão carregados aqui
            $vinculo = Internship::findOrFail($internshipId);
            $this->student_id = $vinculo->student_id;
        }
    }

    // GATILHO: Roda toda vez que o 'student_id' mudar no select
    public function updateStudentId($value)
    {
        if ($value) {
            $student = Student::find($value);
            $this->student_observations = $student && $student->observations ? $student->observations : 'Sem observações cadastradas para este aluno.';
        } else {
            $this->student_observations = '';
        }
    }

    // GATILHO: Roda toda vez que o 'company_id' mudar no select
    public function updateCompanyId($value)
    {
        if ($value) {
            $company = Company::find($value);
            $this->company_observations = $company && $company->observations ? $company->observations : 'Sem observações cadastradas para esta empresa.';
        } else {
            $this->company_observations = '';
        }
    }

    public function save() {
        // Validação dos dados informados no formulário
        $this->validate([
            'student_id' => 'required|exists:students,id',
            'company_id' => 'required|exists:companies,id',
            'status' => 'required|in:active,finished',
            'type' => 'required|in:mandatory,non_mandatory',
            'modality' => 'required|in:on_site,remote',
            'start_date' => 'required|date',
            'estimated_end_date' => 'required|date|after_or_equal:start_date',
            'real_end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        // Gravação híbrida inteligente (Se tiver ID atualiza, se não, cria um novo)
        \App\Models\Internship::updateOrCreate(
            ['id' => $this->internshipId], // Condição de busca para atualização
            [
                'student_id' => $this->student_id,
                'company_id' => $this->company_id,
                'status' => $this->status,
                'type' => $this->type,
                'modality' => $this->modality,
                'start_date' => $this->start_date,
                'estimated_end_date' => $this->estimated_end_date,
                'real_end_date' => $this->real_end_date ?: null, // Salva nulo se estiver em branco
            ]
        );


        session()->flash('message', $this->internshipId ? 'Vínculo atualizado com sucesso!' : 'Vínculo criado com sucesso!');
        return redirect()->to('/vinculos'); 
    }

    public function render()
    {
        return view('livewire.form-vinculo', [
            // passamos os alunos e empresas cadastradas para popular os selects
            'students' => Student::orderBy('name')->get(),
            'companies' => Company::orderBy('name')->get(),
        ]);
    }
}
?>