<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Student;
use Carbon\Carbon;

class CadastroAluno extends Component
{
    public $studentId = null;

    // Propriedades do Formulário
    public $name = '';
    public $registration_number = '';
    public $course = '';
    public $period = '';
    public $phone = ''; 
    public $course_start_date = '';
    public $observations = '';

    public $available_courses = [
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

    public function mount($studentId = null)
    {
        if ($studentId) {
            $this->studentId = $studentId;
            
            // Busca o aluno diretamente no banco de dados
            $student = Student::findOrFail($studentId);
            
            $this->name = $student->name;
            $this->registration_number = $student->registration_number;
            $this->course = $student->course;
            $this->period = $student->period;
            $this->phone = $student->phone;
            
            if ($student->course_start_date) {
                $this->course_start_date = Carbon::parse($student->course_start_date)->format('Y-m-d');
            } else {
                $this->course_start_date = '';
            }
            
            $this->observations = $student->observations;
        }
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'registration_number' => 'required|string|max:50',
            'course' => 'required|string',
            'period' => 'required',
            'phone' => 'nullable|string|max:20',
            'course_start_date' => 'required|date',
            'observations' => 'nullable|string|max:1000',
        ]);

        Student::updateOrCreate(
            ['id' => $this->studentId],
            [
                'name' => $this->name,
                'registration_number' => $this->registration_number,
                'course' => $this->course,
                'period' => $this->period,
                'phone' => $this->phone,
                'course_start_date' => $this->course_start_date,
                'observations' => $this->observations,
            ]
        );

        session()->flash('message', $this->studentId ? 'Dados do aluno atualizados com sucesso!' : 'Aluno registrado com sucesso no sistema!');

        return redirect()->to('/alunos');
    }

    public function render()
    {
        return view('livewire.cadastro-aluno');
    }
}