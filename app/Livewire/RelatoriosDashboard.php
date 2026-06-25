<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Company;
use App\Models\Student;
use App\Models\Internship;
use Illuminate\Support\Facades\DB;

class RelatoriosDashboard extends Component
{
    // Propriedades dos filtros por período
    public $data_inicial = '';
    public $data_final = '';

    // Propriedades para armazenar os dados do banco
    public $totalEmpresas = 0;
    public $empresasAtivas = 0;
    public $empresasInativas = 0;
    public $empresasPorCurso = [];

    public $estagiosObrigatorios = 0;
    public $estagiosNaoObrigatorios = 0;
    public $estagiosAtivos = 0;
    public $estagiosFinalizados = 0;
    public $estagiariosPorCurso = [];

    // Propriedades para os resultados específicos do filtro de período
    public $empresasNoPeriodo = 0;
    public $alunosEstagioNoPeriodo = 0;
    public $filtrado = false;

    public function mount()
    {
        $this->carregarDadosGerais();
    }

    public function carregarDadosGerais()
    {
        // --- RELATÓRIOS DE EMPRESAS ---
        $this->totalEmpresas = Company::count();
        $this->empresasAtivas = Company::where('status', 'active')->count();
        $this->empresasInativas = Company::where('status', 'inactive')->count();

        // Como 'courses' é um JSON na tabela de empresas, precisamos ler e contar no PHP
        $empresas = Company::all();
        $contagemCursosEmpresa = [];
        foreach ($empresas as $empresa) {
            $cursos = is_array($empresa->courses) ? $empresa->courses : json_decode($empresa->courses, true);
            if ($cursos) {
                foreach ($cursos as $curso) {
                    $contagemCursosEmpresa[$curso] = ($contagemCursosEmpresa[$curso] ?? 0) + 1;
                }
            }
        }
        arsort($contagemCursosEmpresa); // Ordena do maior para o menor
        $this->empresasPorCurso = $contagemCursosEmpresa;

        // --- RELATÓRIOS DE ESTÁGIO ---
        $this->estagiosObrigatorios = Internship::where('type', 'mandatory')->count();
        $this->estagiosNaoObrigatorios = Internship::where('type', 'non_mandatory')->count();
        $this->estagiosAtivos = Internship::where('status', 'active')->count();
        $this->estagiosFinalizados = Internship::where('status', 'completed')->count();

        // Conta estagiários fazendo o Join com a tabela de alunos para pegar o curso deles
        $this->estagiariosPorCurso = Internship::join('students', 'internships.student_id', '=', 'students.id')
            ->select('students.course', DB::raw('count(internships.id) as total'))
            ->groupBy('students.course')
            ->orderBy('total', 'desc')
            ->pluck('total', 'students.course')
            ->toArray();
    }

    public function filtrar()
    {
        // Valida se as duas datas foram preenchidas
        $this->validate([
            'data_inicial' => 'required|date',
            'data_final' => 'required|date|after_or_equal:data_inicial',
        ]);

        // 1. Contar Empresas criadas entre as datas (pelo created_at)
        $this->empresasNoPeriodo = Company::whereBetween('created_at', [
            $this->data_inicial . ' 00:00:00',
            $this->data_final . ' 23:59:59'
        ])->count();

        // 2. Contar Alunos que iniciaram estágio entre as datas (pela start_date do vínculo)
        $this->alunosEstagioNoPeriodo = Internship::whereBetween('start_date', [
            $this->data_inicial,
            $this->data_final
        ])->count();

        $this->filtrado = true;
    }

    public function limparFiltro()
    {
        $this->data_inicial = '';
        $this->data_final = '';
        $this->filtrado = false;
    }

    public function render()
    {
        return view('livewire.relatorios-dashboard');
    }
}