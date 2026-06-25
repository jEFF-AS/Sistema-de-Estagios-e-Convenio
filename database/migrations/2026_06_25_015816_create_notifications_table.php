<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // Identifica o tipo: 'company_expiration' ou 'internship_end'
            $table->string('title'); // Título do alerta (ex: "⚠️ Convênio Próximo do Vencimento")
            $table->text('message'); // Descrição do aviso com o nome da empresa ou aluno
            $table->boolean('is_read')->default(false); // Controle para saber se você já clicou e leu
            $table->timestamps(); // Registra a data e hora em que o alerta foi gerado
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};