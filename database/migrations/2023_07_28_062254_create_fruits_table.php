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
        Schema::create('fruits', function (Blueprint $table) {
            $table->increments('id');
            // $table->unsignedInteger('Categoryid');
            // $table->foreign('Categoryid')->references('id')->on('categories');
            $table->string('FruitName')->unique();
            $table->enum('Unit', ['kg', 'pcs', 'pack', null])->default(null)->unique()->nullable();
            $table->float('Price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fruits');
    }
};
