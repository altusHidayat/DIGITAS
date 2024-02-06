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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->integer("product_id")->nullable();
            $table->integer("quantity")->nullable();
            $table->integer("sale_value")->nullable();
            $table->integer("total_value")->nullable();
            $table->integer("customer_id")->nullable();
            $table->integer("month")->nullable();
            $table->integer("year")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};