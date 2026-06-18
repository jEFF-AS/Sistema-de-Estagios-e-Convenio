<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Student;

class CadastroAluno extends Component
{
    // Propiedades do Formulário.
    public $studentId = null;
    public $name = '';
    public $registration_number = '';
    public $course = '';
    public $period = '';
    public $course_start_date = '';

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

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            // Garante que a matrícula seja única, ignorando o próprio ID caso seja edição
            'registration_number' => 'required|string|max:50|unique:students,registration_number',
            'course' => 'required|string',
            'period' => 'required|integer|min:1|max:12',
            'course_start_date' => 'required|date',
        ]);

        // gravação e atualização no MySQL
        Student::updateOrCreate(
            ['id' => $this->studentId],
            [
                'name' => $this->name,
                'registration_number' => $this->registration_number,
                'course' => $this->course,
                'period' => $this->period,
                'course_start_date' => $this->course_start_date,
            ]
        );

        session()->flash('message', 'Aluno resgitrado com sucesso no sistema!');
    }

    private function resetForm()
    {
        $this->studentId = null;
        $this->name = '';
        $this->registration_number = '';
        $this->course = '';
        $this->period = '';
        $this->course_start_date = '';
    }

    public function render()
    {
        return view('livewire.cadastro-aluno');
    }
}
?>