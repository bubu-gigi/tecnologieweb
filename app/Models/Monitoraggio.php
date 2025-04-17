<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Monitoraggio extends Model
{
    use HasFactory;

    protected $table = 'monitoraggi';

    protected $fillable = [
        'user_id',
        'prestazione_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function prestazione(): BelongsTo
    {
        return $this->belongsTo(Prestazione::class);
    }
}
