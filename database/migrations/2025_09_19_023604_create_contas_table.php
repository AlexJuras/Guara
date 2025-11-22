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
        Schema::create('contas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('dono_id')->constrained('donos')->onDelete('cascade');
            $table->string('nome');
            $table->enum('tipo', ['receita', 'despesa', 'transferencia'])->default('despesa');
            $table->string('categoria')->nullable();
            $table->decimal('valor', 12, 2);
            $table->decimal('saldo', 12, 2)->default(0);
            $table->enum('status', ['pendente', 'pago', 'parcial', 'cancelado'])->default('pendente');
            $table->date('data_vencimento');
            $table->date('data_pagamento')->nullable();
            $table->boolean('recorrente')->default(false);
            $table->string('metodo_pagamento')->nullable();
            $table->text('descricao')->nullable();
            $table->timestamps();
            
            $table->index('user_id');
            $table->index('dono_id');
            $table->index('tipo');
            $table->index('status');
            $table->index('data_vencimento');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contas');
    }
};
