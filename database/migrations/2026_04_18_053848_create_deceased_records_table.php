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
        Schema::create('deceased_records', function (Blueprint $table) {
            $table->id();

             // Deceased person details
            $table->string('deathperson_name');
            $table->integer('age')->nullable();
            $table->text('address');

            // Death details
            $table->date('date_of_death');
            $table->time('death_time')->nullable();

            // Relative details
            $table->string('relative_name');
            $table->text('relative_address')->nullable();
            $table->string('mobile', 15);

            // Cremation details
            $table->string('receipt_no')->unique();
            $table->string('cremation_type'); // wood / electric etc
            $table->text('remarks')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deceased_records');
    }
};
