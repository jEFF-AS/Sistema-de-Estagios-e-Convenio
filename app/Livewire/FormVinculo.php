<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Student;
use App\Models\Company;
use App\Models\Internship;

class FormVinculo extends Component
{
    public $internshipId = null;

    // Propriedades do Formulário 
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

    public function mount($internshipId = null)
    {
        if ($internshipId) {
            $this->internshipId = $internshipId;
            
            // Busca o vínculo existente no banco
            $vinculo = Internship::findOrFail($internshipId);
            
            // Popula os campos do formulário para edição
            $this->student_id = $vinculo->student_id;
            $this->company_id = $vinculo->company_id;
            $this->status = $vinculo->status;
            $this->type = $vinculo->type;
            $this->modality = $vinculo->modality;
            $this->start_date = $vinculo->start_date;
            $this->estimated_end_date = $vinculo->estimated_end_date;
            $this->real_end_date = $vinculo->real_end_date;

            // Já engatilha o carregamento das observações na edição
            $this->updatedStudentId($this->student_id);
            $this->updatedCompanyId($this->company_id);
        }
    }

    // GATILHO: Busca observações do Aluno em tempo real
    public function updatedStudentId($value)
    {
        if ($value) {
            $student = Student::find($value);
            $this->student_observations = $student && !empty($student->observations) 
                ? $student->observations 
                : 'Sem observações cadastradas para este aluno.';
        } else {
            $this->student_observations = '';
        }
    }

    // GATILHO: Busca observações da Empresa em tempo real
    public function updatedCompanyId($value)
    {
        if ($value) {
            $company = Company::find($value);
            $this->company_observations = $company && !empty($company->observations) 
                ? $company->observations 
                : 'Sem observações cadastradas para esta empresa.';
        } else {
            $this->company_observations = '';
        }
    }

    public function save()
    {
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

        Internship::updateOrCreate(
            ['id' => $this->internshipId],
            [
                'student_id' => $this->student_id,
                'company_id' => $this->company_id,
                'status' => $this->status,
                'type' => $this->type,
                'modality' => $this->modality,
                'start_date' => $this->start_date,
                'estimated_end_date' => $this->estimated_end_date,
                'real_end_date' => $this->real_end_date ?: null,
            ]
        );

        session()->flash('message', $this->internshipId ? 'Vínculo atualizado com sucesso!' : 'Vínculo criado com sucesso!');
        
        return redirect()->to('/vinculos');
    }

    public function render()
    {
        return view('livewire.form-vinculo', [
            'students' => Student::orderBy('name')->get(),
            'companies' => Company::orderBy('name')->get(),
        ]);
    }
}