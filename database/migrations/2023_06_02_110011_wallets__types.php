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
        Schema::create('wallets_types', function (Blueprint $table) {
            $table->id('id');
            $table->string('wallet_address', 42);
            $table->string('wallet_type')->default('unknown'); //contract, contract_owner, liquidity_provider,smart_contract, bot,whale
            //$table->string('reference', 42)->nullable(); //in reference to what wallet address ? de gandit mai bine la ce serveste coloana asta,relatii etc.
            $table->timestamps();
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
