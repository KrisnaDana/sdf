<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProgramStudi extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function users(): HasMany {
        return $this->hasMany(User::class);
    }

    public function periode_pendaftarans(): HasMany {
        return $this->hasMany(PeriodePendaftarans::class);
    }
}
