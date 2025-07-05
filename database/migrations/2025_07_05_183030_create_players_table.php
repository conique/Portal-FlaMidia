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
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('sobrenome')->nullable();
            $table->string('posicao'); // Ex: Goleiro, Zagueiro, Meio-campo, Atacante
            $table->integer('numero_camisa')->nullable()->unique(); // Número da camisa, opcional e único
            $table->string('nacionalidade')->nullable();
            $table->date('data_nascimento')->nullable();
            $table->text('descricao')->nullable(); // Pequena biografia ou descrição
            $table->string('foto')->nullable(); // Caminho para a foto do jogador
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('players');
    }
};
