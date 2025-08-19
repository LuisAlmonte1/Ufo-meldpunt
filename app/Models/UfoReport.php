<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UfoReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'reporter_name', 'reporter_email', 'incident_datetime',
        'location', 'description', 'category', 'photo_path', 'status',
        'is_paid', 'support_fee'
    ];

protected $casts = [
    'incident_datetime' => 'datetime',
    'is_paid' => 'boolean',
    'support_fee' => 'decimal:2'
];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function getReporterDisplayNameAttribute(): string
    {
        return $this->user ? $this->user->name : $this->reporter_name;
    }
}