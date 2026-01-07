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
        Schema::create('financial_reports', function (Blueprint $table) {
            $table->id();
            $table->enum('report_type', ['financial_summary','profit_loss','balance_sheet']);
            $table->date('from');
            $table->date('to');
            $table->decimal('total_income', 10,2)->default(0);
            $table->decimal('total_expense', 10,2)->default(0);
            $table->decimal('total_withdrawal', 10,2)->default(0);
            $table->decimal('net_result', 10,2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('financial_reports');
    }
};
