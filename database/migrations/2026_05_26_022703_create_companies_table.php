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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nome da empresa
            $table->string('trading_name'); // Nome fantasia
            $table->string('cnpj')->unique(); // CNPJ
            $table->string('representative'); // Responsável pela empresa
            $table->date('relationship_start_date'); //Início do vínculo
            $table->date('relationship_end_date'); //Términio do vínculo
            $table->json('courses'); // Cursos autorizados (ex: [Sistemas de Informação] etc)
            $table->enum('status', ['active', 'inactive'])->default('active'); // Status do vínculo
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
