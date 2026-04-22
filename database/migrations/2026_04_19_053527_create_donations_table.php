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
        Schema::create('donations', function (Blueprint $table) {
            $table->id();

            $table->string('receipt_no')->unique(); // important
            $table->decimal('amount', 10, 2);
            $table->string('amount_in_word');

            $table->enum('type', ['after_death', 'open']);

            $table->foreignId('deceased_id')->nullable()->constrained('deceased')->nullOnDelete();

            $table->string('donor_name');
            $table->string('mobile')->nullable();

            $table->text('remarks')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
