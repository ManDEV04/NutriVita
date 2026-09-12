<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Appointment extends Model
{
    protected $fillable = [
        'user_id',
        'patient_id',
        'appointment_at',
        'reason',
        'status',
        'notes',
    ];
public function consultation()
{
    return $this->hasOne(Consultation::class);
}
    public function payments(): HasMany
{
    return $this->hasMany(Payment::class);
}
    
    protected function casts(): array
    {
        return [
            'appointment_at' => 'datetime',
        ];
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}