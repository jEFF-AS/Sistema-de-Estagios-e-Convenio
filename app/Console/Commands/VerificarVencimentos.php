<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Company;
use App\Models\Internship;
use App\Models\Notification;
use Carbon\Carbon;

class VerificarVencimentos extends Command
{
    // O comando que será executado no terminal: php artisan app:verificar-vencimentos
    protected $signature = 'app:verificar-vencimentos';
    protected $description = 'Verifica convênios de empresas e estágios que vencem em 30 dias e gera notificações';

    public function handle()
    {
        // Define o alvo exato: daqui a exatamente 30 dias
        $alvo30Dias = Carbon::now()->addDays(30)->format('Y-m-d');

        // 1. Verificar Vencimento de Convênio de Empresas
        // Ajuste 'relationship_end_date' para o nome correto da sua coluna de término de convênio
        $empresas = Company::whereDate('relationship_end_date', $alvo30Dias)->get();

        foreach ($empresas as $empresa) {
            Notification::firstOrCreate([
                'type' => 'company_expiration',
                'title' => '⚠️ Convênio Próximo do Vencimento',
                'message' => "O convênio com a empresa {$empresa->trading_name} vencerá em 30 dias (" . Carbon::parse($empresa->relationship_end_date)->format('d/m/Y') . ").",
                'is_read' => false
            ]);
        }

        // 2. Verificar Término de Estágio de Alunos
        $estagios = Internship::with('student')->whereDate('end_date', $alvo30Dias)->get();

        foreach ($estagios as $estagio) {
            $nomeAluno = $estagio->student->name ?? 'Aluno não identificado';
            Notification::firstOrCreate([
                'type' => 'internship_end',
                'title' => '🎓 Término de Estágio Próximo',
                'message' => "O contrato de estágio do aluno(a) {$nomeAluno} terminará em 30 dias (" . Carbon::parse($estagio->end_date)->format('d/m/Y') . ").",
                'is_read' => false
            ]);
        }

        $this->info('Varredura de vencimentos concluída com sucesso!');
    }
}