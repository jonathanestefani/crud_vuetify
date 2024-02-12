<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cliente', function (Blueprint $table) {
            $table->bigInteger('recnum')->length(20)->unique();
            $table->decimal('empresa', 4, 0);
            $table->decimal('codigo', 14, 0);
            $table->string('razao_social', 255);
            $table->enum('tipo', ['PJ', 'PF']);
            $table->string('cpf_cnpj', 14);

            $table->primary(['empresa', 'codigo']);
            $table->foreign('empresa')->references('codigo')->on('empresa');
        });

        DB::statement('ALTER TABLE cliente MODIFY COLUMN recnum bigint AUTO_INCREMENT;');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cliente');
    }
};
