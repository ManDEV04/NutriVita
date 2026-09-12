<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Patient extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'birth_date',
        'sex',
        'phone',
        'email',
        'occupation',
        'goal',
        'active',
    ];

    public function evaluations(): HasMany  
    {
    return $this->hasMany(Evaluation::class);
    }

    protected function casts(): array
    {
        return [
            'birth_date' => 'date',
            'active' => 'boolean',
        ];
    }

    public function consultations(): HasMany
{
    return $this->hasMany(Consultation::class);
}

    public function payments(): HasMany
{
    return $this->hasMany(Payment::class);
}

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}