<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->string(column: 'order_code', length: 255);
            $table->timestamp(column: 'order_date')->useCurrent();
            $table->decimal(column: 'total_amount', total: 10, places: 2)->nullable();
            $table->string(column: 'payment_method', length: 50)->nullable();
            $table->decimal(column: 'payment_amount', total: 10, places: 2)->nullable();
            $table->decimal(column: 'payment_change', total: 10, places: 2)->nullable();
            $table->string(column: 'discount_code', length: 50)->nullable();
            $table->decimal(column: 'discount_amount', total: 10, places: 2)->nullable();
            $table->tinyInteger(column: 'order_status')->default(0);
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order');
    }
};
