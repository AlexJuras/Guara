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
        Schema::table('contas', function (Blueprint $table) {
            // Tipo de recorrência: diaria, semanal, mensal, anual
            $table->enum('recorrencia_tipo', ['diaria', 'semanal', 'mensal', 'anual'])->nullable()->after('recorrente');
            
            // Número de vezes que a conta se repete
            $table->integer('recorrencia_repeticoes')->nullable()->after('recorrencia_tipo');
            
            // ID da conta mãe (primeira conta da série recorrente)
            // Se for NULL, é uma conta única ou a primeira da série
            $table->foreignId('conta_recorrente_id')->nullable()->after('recorrencia_repeticoes')->constrained('contas')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contas', function (Blueprint $table) {
            $table->dropForeign(['conta_recorrente_id']);
            $table->dropColumn(['recorrencia_tipo', 'recorrencia_repeticoes', 'conta_recorrente_id']);
        });
    }
};
