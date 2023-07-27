<?php

namespace App\Models;

use App\Models\User;
use App\Models\DetailGugus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gugus extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function users(): hasMany
    {
        return $this->hasMany(User::class);
    }
    public function detailguguses(): hasMany
    {
        return $this->hasMany(DetailGugus::class);
    }
}
