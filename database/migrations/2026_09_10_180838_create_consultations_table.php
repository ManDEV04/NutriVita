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
    Schema::create('consultations', function (Blueprint $table) {

        $table->id();

        $table->foreignId('user_id')
            ->constrained()
            ->cascadeOnDelete();

        $table->foreignId('patient_id')
            ->constrained()
            ->cascadeOnDelete();

        $table->foreignId('appointment_id')
            ->nullable()
            ->constrained()
            ->nullOnDelete();

        $table->dateTime('consultation_at');

        $table->string('reason')->nullable();

        $table->text('observations')->nullable();

        $table->text('recommendations')->nullable();

        $table->date('next_visit')->nullable();

        $table->timestamps();

        $table->softDeletes();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultations');
    }
};
