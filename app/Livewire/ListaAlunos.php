<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Student;

class ListaAlunos extends Component
{
    public $search = '';
    public $course_filter = '';

    public function delete($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();
        session()->flash('message', 'Aluno removido com sucesso!');
    }

    public function edit($id)
    {
        return redirect()->to('/alunos/editar/' . $id);
    }

    public function render()
    {
        $query = Student::query();

        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('registration_number', 'like', '%' . $this->search . '%');
            });
        }

        if (!empty($this->course_filter)) {
            $query->where('course', $this->course_filter);
        }

        // Cursos estáticos ou baseados nos cadastros existentes para o select
        $availableCourses = Student::select('course')
            ->whereNotNull('course')
            ->distinct()
            ->orderBy('course')
            ->pluck('course');

        return view('livewire.lista-alunos', [
            'students' => $query->orderBy('name', 'asc')->get(),
            'availableCourses' => $availableCourses
        ]);
    }
}