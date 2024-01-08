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
        Schema::table('tokens', function (Blueprint $table) {
            //add source of funds column before interacted_with
            $table->json('contract_source_code')->nullable()->default(null)->after('bytecode');
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
