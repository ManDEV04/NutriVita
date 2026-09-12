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
    Schema::create('payments', function (Blueprint $table) {

        $table->id();

        // Nutriólogo propietario del pago
        $table->foreignId('user_id')
            ->constrained()
            ->cascadeOnDelete();

        // Paciente que realizó el pago
        $table->foreignId('patient_id')
            ->constrained()
            ->cascadeOnDelete();

        // Cita relacionada (opcional)
        $table->foreignId('appointment_id')
            ->nullable()
            ->constrained()
            ->nullOnDelete();

        // Información del pago
        $table->decimal('amount', 10, 2);

        $table->dateTime('paid_at');

        $table->string('concept')->nullable();

        $table->string('payment_method')
            ->default('Efectivo');

        $table->string('status')
            ->default('Pagado');

        $table->string('reference')->nullable();

        $table->text('notes')->nullable();

        $table->timestamps();

        $table->softDeletes();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
