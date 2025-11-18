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
        Schema::create('donos', function (Blueprint $table) {
            $table->id();
            $table->string('foto')->nullable();
            $table->string('nome');
            $table->enum('tipo', ['cliente', 'fornecedor', 'prestador_servico', 'outros'])->default('cliente');
            $table->string('cpf_cnpj', 18)->nullable()->unique();
            $table->string('email')->nullable();
            $table->string('telefone', 20)->nullable();
            $table->string('whatsapp', 20)->nullable();
            $table->text('endereco')->nullable();
            $table->string('categoria')->nullable();
            $table->boolean('ativo')->default(true);
            $table->decimal('saldo_total', 15, 2)->default(0);
            $table->timestamps();
            $table->softDeletes();
            
            $table->index('nome');
            $table->index('tipo');
            $table->index('ativo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donos');
    }
};
