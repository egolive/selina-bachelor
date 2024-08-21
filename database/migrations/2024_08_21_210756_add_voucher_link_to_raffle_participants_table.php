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
        Schema::table('raffle_participants', function (Blueprint $table) {
            $table->string('voucher_link')->nullable()->after('winner');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('raffle_participants', function (Blueprint $table) {
            $table->dropColumn('voucher_link');
        });
    }
};
