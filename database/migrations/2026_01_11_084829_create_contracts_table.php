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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();
            $table->string('contract_number')->unique();
            $table->decimal('amount', 10,2);
            $table->enum('currency', ['AFN', 'USD']);
            $table->enum('payment_type', ['full', 'installment']);
            $table->date('signed_date');
            $table->enum('status', ['active', 'expired', 'terminated'])->default('active');
            $table->string('contract_file')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};
