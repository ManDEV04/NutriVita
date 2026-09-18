<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {

            // Prueba gratuita
            $table->timestamp('trial_started_at')->nullable();
            $table->timestamp('trial_ends_at')->nullable();

            // Suscripción
            $table->string('subscription_status')
                ->default('trial');

            $table->string('plan')
                ->nullable();

            $table->timestamp('subscription_started_at')
                ->nullable();

            $table->timestamp('subscription_ends_at')
                ->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->dropColumn([
                'trial_started_at',
                'trial_ends_at',
                'subscription_status',
                'plan',
                'subscription_started_at',
                'subscription_ends_at',
            ]);

        });
    }
};