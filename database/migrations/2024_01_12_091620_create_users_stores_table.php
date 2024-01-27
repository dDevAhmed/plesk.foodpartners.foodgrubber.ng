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
        Schema::create('users_stores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('phone');
            $table->string('address');
            $table->string('city');
            $table->string('state');
            $table->string('postcode')->nullable();
            $table->string('current_location')->nullable();
            $table->string('description');
            
            $table->string('food_cert_number')->nullable();
            $table->string('food_cert')->nullable();
            $table->string('account_number')->nullable();
            $table->string('sort_code')->nullable();
            $table->string('bank')->nullable();
            $table->boolean('availability')->default(1);     //0 = away, 1 = available
            $table->string('logo')->nullable();
            $table->string('cover_image')->nullable();
            
            $table->string('status')->default('p');   //p = pending, s = suspended, a = accepted
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_stores');
    }
};
