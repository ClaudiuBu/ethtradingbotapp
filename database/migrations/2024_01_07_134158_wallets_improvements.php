<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //add columns in tokens table
        Schema::table('wallets', function (Blueprint $table) {
            //add source of funds column before interacted_with
            $table->string('source_of_funds')->nullable()->default(null)->after('interacted_with'); //exchange, airdrop, presale, private sale, public sale, other - to think about this
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
