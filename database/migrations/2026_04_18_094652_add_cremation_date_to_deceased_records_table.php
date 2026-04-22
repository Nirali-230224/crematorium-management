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
        Schema::table('deceased_records', function (Blueprint $table) {
            $table->date('cremation_date')->nullable()->after('date_of_death');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('deceased_records', function (Blueprint $table) {
            $table->dropColumn('cremation_date');
        });
    }
};
