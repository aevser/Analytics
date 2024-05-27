<?php

namespace App\Models\Companies\Services;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ApiType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description'
    ];

    public function tokens(): HasMany
    {
        return $this->hasMany(ApiToken::class);
    }
}
