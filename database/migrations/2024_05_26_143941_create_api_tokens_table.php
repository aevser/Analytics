<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('api_tokens', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Companies\Account::class, 'account_id')
                ->constrained()->onDelete('cascade');
            $table->foreignIdFor(\App\Models\Companies\Services\ApiService::class, 'api_service_id')
                ->constrained()->onDelete('cascade');
            $table->foreignIdFor(\App\Models\Companies\Services\ApiType::class, 'api_type_id')
                ->constrained()->onDelete('cascade');
            $table->string('api_token')->unique();
            $table->timestamp('expires_at');
            $table->boolean('active');
            $table->timestamps();

            // Индексация
            $table->index([
                'account_id',
                'api_service_id',
                'api_type_id'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('api_tokens');
    }
};
