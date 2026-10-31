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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
            
            $table->string('employee_id')->unique(); // e.g. TCH-001
            $table->string('qualification'); // e.g. BSc, MSc
            $table->string('specialization'); // e.g. Mathematics, Physics
            $table->date('hire_date'); // Date of employment
            $table->decimal('salary', 10, 2)->nullable(); // Monthly salary
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
