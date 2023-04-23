<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PeriodePendaftaran extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function program_studi(): BelongsTo {
        return $this->belongsTo(ProgramStudi::class);
    }

    public function jalur_pendaftaran(): BelongsTo {
        return $this->belongsTo(JalurPendaftaran::class);
    }
}
