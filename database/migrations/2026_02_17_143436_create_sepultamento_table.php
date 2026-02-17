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
        Schema::create('sepultamento', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jazigo_id')->constrained('jazigo');
            $table->string('nome_falecido');
            $table->date('data_nascimento')->nullable();
            $table->date('data_falecimento');
            $table->text('observacoes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sepultamento');
    }
};
