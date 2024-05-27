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
        Schema::create('incomes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Companies\Account::class, 'account_id')
                ->constrained()
                ->onDelete('cascade');
            $table->unsignedBigInteger('income_id');
            $table->string('number')->nullable();
            $table->date('date');
            $table->date('last_change_date');
            $table->string('supplier_article')->nullable();
            $table->string('tech_size')->nullable();
            $table->string('barcode')->nullable();
            $table->integer('quantity');
            $table->decimal('total_price', 10, 2);
            $table->date('date_close');
            $table->string('warehouse_name');
            $table->unsignedBigInteger('nm_id');
            $table->string('status');
            $table->timestamps();

            // Индексация
            $table->index([
                'account_id',
                'income_id',
                'date',
                'nm_id',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incomes');
    }
};
