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
            $table->dateTime('verified_at')->nullable();
            $table->integer('status')
                ->default(0)
                ->comment('0: Inactive; 1: Active');
            $table->tinyInteger('created_by')->nullable();
            $table->tinyInteger('updated_by')->nullable();
            $table->tinyInteger('deleted_by')->nullable();
            $table->tinyInteger('approve_by')->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->softDeletes();
            $table->text('reason_delete')->nullable();
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
