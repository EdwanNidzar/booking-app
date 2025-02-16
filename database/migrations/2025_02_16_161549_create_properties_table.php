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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->enum('jenis', ['penginapan', 'aula']);
            $table->foreignId('penginapan_id')->nullable()->constrained('penginapans')->onDelete('cascade');
            $table->foreignId('aula_id')->nullable()->constrained('aulas')->onDelete('cascade');
            $table->enum('type', ['kamar', 'villa', 'apartemen'])->nullable();
            $table->integer('beds')->nullable();
            $table->integer('bathrooms')->nullable();
            $table->text('facilities');
            $table->integer('max_guest');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
