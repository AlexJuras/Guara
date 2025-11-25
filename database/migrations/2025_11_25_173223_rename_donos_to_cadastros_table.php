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
        // Rename the donos table to cadastros
        Schema::rename('donos', 'cadastros');
        
        // Update the foreign key column name in contas table
        Schema::table('contas', function (Blueprint $table) {
            $table->dropForeign(['dono_id']);
            $table->renameColumn('dono_id', 'cadastro_id');
        });
        
        // Re-add the foreign key constraint with the new column name
        Schema::table('contas', function (Blueprint $table) {
            $table->foreign('cadastro_id')
                ->references('id')
                ->on('cadastros')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the foreign key constraint
        Schema::table('contas', function (Blueprint $table) {
            $table->dropForeign(['cadastro_id']);
        });
        
        // Rename the column back
        Schema::table('contas', function (Blueprint $table) {
            $table->renameColumn('cadastro_id', 'dono_id');
        });
        
        // Re-add the foreign key with the old column name
        Schema::table('contas', function (Blueprint $table) {
            $table->foreign('dono_id')
                ->references('id')
                ->on('cadastros')
                ->onDelete('cascade');
        });
        
        // Rename the table back
        Schema::rename('cadastros', 'donos');
    }
};
