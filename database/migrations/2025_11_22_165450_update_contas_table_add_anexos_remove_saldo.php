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
            // Adiciona campo para armazenar anexos (JSON array de caminhos)
            $table->json('anexos')->nullable()->after('descricao');
            
            // Remove o campo saldo
            $table->dropColumn('saldo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contas', function (Blueprint $table) {
            // Restaura o campo saldo
            $table->decimal('saldo', 12, 2)->default(0)->after('valor');
            
            // Remove o campo anexos
            $table->dropColumn('anexos');
        });
    }
};
