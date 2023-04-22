<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PeriodePendaftaran extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function program_studi(): BelongsTo {
        return $this->belongsTo(ProgramStudi::class);
    }
}
