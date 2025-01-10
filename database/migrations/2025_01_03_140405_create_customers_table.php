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
        Schema::create('customers', function (Blueprint $table) {
            $table->id('customer_id');  
            $table->string('username', 255);  
            $table->string('password', 255);
            $table->string('email', 255);  
            $table->string('gender', 255);
            $table->string('hobby', 500);
            $table->string('instagram', 255);
            $table->string('phone', 20);
            $table->integer('price');
            $table->integer('coin')->default(100);
            $table->string('photo')->nullable();
            $table->boolean('is_hidden')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
