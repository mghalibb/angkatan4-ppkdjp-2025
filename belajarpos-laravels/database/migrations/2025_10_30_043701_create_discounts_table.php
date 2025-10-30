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
        Schema::create('discounts', function (Blueprint $table) {
            $table->id();
            $table->string(column: 'code', length: 50)->nullable()->unique();
            $table->enum(column: 'type', allowed: ['fixed', 'percent'])->nullable();
            $table->decimal(column: 'value', total: 10, places: 2)->nullable();
            $table->boolean(column: 'is_active')->default(true);
            $table->dateTime(column: 'expires_at')->nullable();
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discounts');
    }
};
