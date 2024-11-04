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
        Schema::create('translated_relations', function (Blueprint $table) {
            $table->foreignId('language_id')->constrained()->cascadeOnDelete();
            $table->foreignId('relation_id')->constrained()->cascadeOnDelete();
            $table->text('translated_relation');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('translated_relations');
    }
};
