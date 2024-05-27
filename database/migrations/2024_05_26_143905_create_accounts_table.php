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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Companies\Cabinet::class, 'cabinet_id')
                ->constrained()
                ->onDelete('cascade');
            $table->foreignIdFor(\App\Models\User::class, 'user_id')
                ->constrained()
                ->onDelete('cascade');
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->timestamp('last_login_at');
            $table->timestamps();

            // Индексация
            $table->index([
                'cabinet_id',
                'user_id'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
