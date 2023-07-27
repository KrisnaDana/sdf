<?php

namespace App\Models;

use App\Models\User;
use App\Models\Gugus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class DetailGugus extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
    public function gugus(): BelongsTo
    {
        return $this->belongsTo(Gugus::class);
    }
}
