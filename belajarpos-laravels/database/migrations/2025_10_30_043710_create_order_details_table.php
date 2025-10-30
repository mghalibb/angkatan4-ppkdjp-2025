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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId(column: 'order_id')->constrained(table: 'order')->cascadeOnDelete();
            $table->foreignId(column: 'product_id')->constrained(table: 'products')->cascadeOnDelete();
            $table->integer(column: 'qty');
            $table->decimal(column: 'price_at_sale', total: 10, places: 2);
            $table->decimal(column: 'subtotal', total: 10, places: 2);
            $table->timestamps();

            // $table->foreign("order_id")->references("id")->on("order")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
