<?php

namespace App\Models\Companies\Services;

use App\Models\Companies\Account;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ApiToken extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_id',
        'api_service_id',
        'api_type_id',
        'api_token',
        'expires_at',
        'active'
    ];

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    public function apiService(): BelongsTo
    {
        return $this->belongsTo(ApiService::class);
    }

    public function tokenType(): BelongsTo
    {
        return $this->belongsTo(ApiType::class);
    }
}
