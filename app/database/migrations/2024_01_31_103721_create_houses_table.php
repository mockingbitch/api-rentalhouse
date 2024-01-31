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
        Schema::create('houses', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('lessor_id');
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->string('province_code');
            $table->string('district_code');
            $table->string('ward_code');
            $table->string('full_address')->nullable();
            $table->string('thumbnail')->nullable();
            $table->integer('category_id');
            $table->string('verified_at')->nullable();
            $table->integer('status')
                ->default(0)
                ->comment('0: Inactive; 1: Active');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('houses');
    }
};
