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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger("category_id")->nullable();
            $table->foreignId(column: 'category_id')->nullable()->constrained(table: 'categories')->onDelete('set null');
            $table->string("product_name")->nullable();
            $table->string("photo")->nullable();
            $table->decimal("price", 10, 2)->nullable();
            $table->text("product_description")->nullable();
            $table->tinyInteger("is_active");
            $table->timestamp(column: 'delete_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
