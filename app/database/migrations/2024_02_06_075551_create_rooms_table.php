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
        Schema::create('rooms', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('house_id');
            $table->string('name', 100)->nullable();
            $table->text('description')->nullable();
            $table->string('floor')->nullable();
            $table->text('images')->nullable();
            $table->double('price');
            $table->integer('capacity');
            $table->integer('status')
                ->default(0)
                ->comment('0: Unavailable; 1: Available; 2: Rented');
            $table->json('tags');
            $table->tinyInteger('created_by')->nullable();
            $table->tinyInteger('updated_by')->nullable();
            $table->tinyInteger('deleted_by')->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
