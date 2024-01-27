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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->constrained('users_stores')->onDelete('cascade');
            $table->string('name')->nullable();
            $table->string('price')->nullable();
            $table->string('cuisine')->nullable();
            $table->string('category')->nullable();
            $table->string('description')->nullable();
            $table->string('measurement')->nullable();      //wrap, bottle, pack, kg...
            $table->text('image1')->nullable();
            $table->text('image2')->nullable();
            $table->boolean('availability')->default(1);     //0 = not available, 1 = available
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
