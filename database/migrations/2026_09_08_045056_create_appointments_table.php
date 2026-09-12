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
    Schema::create('appointments', function (Blueprint $table) {

        $table->id();

        // Nutriólogo
        $table->foreignId('user_id')
            ->constrained()
            ->cascadeOnDelete();

        // Paciente
        $table->foreignId('patient_id')
            ->constrained()
            ->cascadeOnDelete();

        // Día y hora de la cita
        $table->dateTime('appointment_at');

        // Motivo
        $table->string('reason')->nullable();

        // Estado
        $table->string('status')->default('Pendiente');

        // Notas adicionales
        $table->text('notes')->nullable();

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
