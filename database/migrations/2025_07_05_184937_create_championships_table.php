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
        Schema::create('championships', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('ano')->nullable(); // Ano da edição do campeonato
            $table->string('status')->nullable(); // Ex: Em Andamento, Finalizado, Próximos Jogos
            $table->text('descricao')->nullable(); // Breve descrição do campeonato
            $table->string('logo')->nullable(); // Caminho para o logo do campeonato
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('championships');
    }
};
