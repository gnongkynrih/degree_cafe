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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->date('invoice_date');
            $table->string('invoice_number',20)->nullable();
            $table->string('table_no',3);
            $table->integer('amount')->default(0);
            $table->integer('discount')->default(0);
            $table->integer('total')->default(0);
            $table->string('status',10)->default('pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
