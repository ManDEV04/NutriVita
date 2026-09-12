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
    Schema::create('evaluations', function (Blueprint $table) {

        $table->id();

        $table->foreignId('patient_id')
            ->constrained()
            ->cascadeOnDelete();

        $table->date('evaluation_date');

        // Composición corporal
        $table->decimal('weight', 6, 2)->nullable();
        $table->decimal('height', 5, 2)->nullable();
        $table->decimal('bmi', 5, 2)->nullable();

        $table->decimal('body_fat', 5, 2)->nullable();
        $table->decimal('muscle_mass', 6, 2)->nullable();

        // Medidas corporales
        $table->decimal('waist', 6, 2)->nullable();
        $table->decimal('hip', 6, 2)->nullable();
        $table->decimal('chest', 6, 2)->nullable();

        $table->decimal('arm', 6, 2)->nullable();
        $table->decimal('thigh', 6, 2)->nullable();

        // Información adicional
        $table->text('notes')->nullable();

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluations');
    }
};
