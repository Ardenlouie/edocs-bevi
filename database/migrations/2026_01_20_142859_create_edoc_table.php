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
        Schema::create('edocs', function (Blueprint $table) {
            $table->id();
            $table->string('control_number')->nullable();
            $table->string('reference_number')->nullable();
            $table->foreignId('type_id')->nullable();
            $table->foreignId('company_id')->nullable();
            $table->foreignId('department_id')->nullable();
            $table->string('revision_number')->nullable();
            $table->string('file_name')->nullable();
            $table->string('path')->nullable();
            $table->dateTime('date_effectivity')->nullable();
            $table->dateTime('validity_date')->nullable();
            $table->string('status')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('edocs');
    }
};
