<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('internships', function (Blueprint $table) {
            $table->id();
            // Chaves estrangeiras com exclusão em cascata para manter a integridade
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->foreignId('company_id')->constrained()->onDelete('cascade');

            $table->enum('type', ['mandatory', 'non_mandatory']); // Obrigatório / Não obrigatório
            $table->enum('modality', ['on_site', 'remote']); // Presencial / Remoto

            $table->date('start_date'); // Data de início do estágio
            $table->date('estimated_end_date'); // Data prevista para o término
            $table->date('real_end_date')->nullable(); // Data real do término

            $table->enum('status', ['active', 'finished'])->default('active'); // Status do estágio
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('internships');
    }
};
