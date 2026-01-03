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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('job_title');
            $table->decimal('salary', 10,2)->nullable();
            $table->string('employee_code')->unique();
            $table->date('hire_date');
            $table->text('address')->nullable();
            $table->string('phone', 15);
            $table->string('emergency_phone', 15)->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('national_id')->nullable()->unique();
            $table->enum('employment_type', ['full_time', 'part_time', 'project_base', 'contract'])->default('full_time');
            $table->enum('status', ['active','inactive'])->default('active');
            $table->timestamps();

            $table->index(['first_name', 'last_name', 'job_title']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
